<?php

namespace App\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Utils\ArrayFilter\ArrayFilterInterface;
use App\Utils\ArrayFilter\ComparisonOperator;
use Illuminate\Support\Facades\Log;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends BaseController
{
    private EmailService $service;
    private ArrayFilterInterface $arrayFilter;
    private $messagesAfterStore = [
        [

            "language" => "en",
            "message" => "Message Sent Successfully"
        ],
        [
            "language" => "zh",
            "message" => "消息发送成功,"
        ],
        [
            "language" => "pt",
            "message" => "Mensagem Enviada com sucesso"
        ]
    ];
    private $messagesToEmail = [
        [

            "language" => "en",
            "message" => "Thank you for contacting Great Wall Linguistic Solutions, one of our representatives will contact you shortly. Best regards, see you soon!"
        ],
        [
            "language" => "zh",
            "message" => "感谢您联系长城语言解决方案，我们的代表将很快与您联系。此致，期待与您再次相见！,"
        ],
        [
            "language" => "pt",
            "message" => "Obrigado por entrar em contato com a Great Wall Soluções Linguisticas, em breve uns de nossos representantes irá entrar em contato com você. Abraços, até mais!"
        ]
    ];
    public function __construct(EmailService $service, ArrayFilterInterface $arrayFilter)
    {
        $this->service = $service;
        $this->arrayFilter = $arrayFilter;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        $email = $this->service->getById((int)$id);
        return $email ? response()->json($email) : response()->json(['message' => 'Not found'], 404);
    }
    function store(array $data): bool
    {
        try {
            $this->service->create($data);
            return true;
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
    function getSendRequest(Request $request): array
    {
        $data = $request->only(['recipient_email', 'subject', 'body', 'name']);
        return $data;
    }
    function getMessageSendResponse(Request $request): string
    {
        try {
            $messagesAfterStore = $this->arrayFilter->filter($this->messagesAfterStore, "language", $request->language, ComparisonOperator::EQUAL->value);
            return $messagesAfterStore[0]["message"];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->messagesAfterStore[0]["message"];
        }
    }
    function getMessageToEmail(Request $request): string
    {
        try {
            $messagesToEmail = $this->arrayFilter->filter($this->messagesToEmail, "language", $request->language, ComparisonOperator::EQUAL->value);
            if (count($messagesToEmail) === 0) {
                return $this->messagesToEmail[0]["message"];
            }
            return $messagesToEmail[0]["message"];
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->messagesToEmail[0]["message"];
        }
    }
    public function send(Request $request)
    {
        try {
            $this->validate($request, [
                'recipient_email' => 'required|string',
                'subject' => 'required|string',
                'body' => 'required|string',
                'language' => 'required|string'
            ]);

            $data = $this->getSendRequest($request);
            Mail::to($data["recipient_email"])->send(new WelcomeMail([
                'name' => isset($data["name"]) ? $data["name"] : $data["recipient_email"],
                'message' => $this->getMessageToEmail($request)
            ]));
            return response()->json(["message" => $this->getMessageSendResponse($request)], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->errors()], 422);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            $this->store($this->getSendRequest($request));
            return response()->json(["message" => $this->getMessageSendResponse($request)], 200);
        }
    }


    public function update(Request $request, $id)
    {
        $data = $request->only(['recipient_email', 'subject', 'body', 'status', 'sent_at', 'error_message']);
        $email = $this->service->update((int)$id, $data);
        return $email ? response()->json($email) : response()->json(['message' => 'Not found'], 404);
    }

    public function destroy($id)
    {
        return $this->service->delete((int)$id)
            ? response()->json(['message' => 'Deleted successfully'])
            : response()->json(['message' => 'Not found'], 404);
    }
}

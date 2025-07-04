<?php

namespace App\Console\Commands;

use App\Mail\WelcomeMail;
use App\Models\Email;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class RetrySendEmails extends Command
{
    /** 
     * O nome e a assinatura do comando do console. 
     * 
     * @var string 
     */
    protected $signature = 'retrisend:emails';

    /** 
     * A descrição do comando do console. 
     * 
     * @var string 
     */
    protected $description = 'Esse comando reenvia os emails que não deram certo o envio.';

    /** 
     * Cria uma nova instância de comando. 
     * 
     * @return void 
     */
    public function __construct()
    {
        parent::__construct();
    }

    /** 
     * Executa o comando do console. 
     * 
     * @return mixed 
     */
    public function handle()
    {
        $emails = Email::whereNull('sent_at')->get();
        Log::info("Iniciando o comando que reenvia os emails");
        if (count($emails) === 0) {
            return Log::info("Não há emails para serem reenviados");
        }
        foreach ($emails as $email) {
            try {
                Mail::to($email->recipient_email)->send(new WelcomeMail([
                    'name' => $email->recipient_email,
                    'message' => $email->body
                ]));
                Log::info("Email {$email->id} re-enviado");
                $email->delete();
            } catch (Throwable $th) {
                Log::error("Falha ao reenviar email ID {$email->id}: {$th->getMessage()}");
            }
        }
        Log::info("Finalizado");
    }
}

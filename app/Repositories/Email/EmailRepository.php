<?php

namespace App\Repositories\Email;

use App\Models\Email;
use App\Repositories\BaseRepository;
use App\Repositories\Email\EmailRepositoryInterface;
use App\Utils\Dates\DateValidator;
use App\Utils\PaginationHelper;

class EmailRepository extends BaseRepository implements EmailRepositoryInterface
{

    /**
     * @param array<string, mixed> $filters Optional simple filters
     * @param array<int, ResultSpecification>  $resultSpecs Result transformers (e.g., date formatting)
     * @return array<int, array<string, mixed>>
     */
    public function all(array $filters = [], array $resultSpecs = []): array
    {
        $query = Email::select(
            'emails.recipient_email',
            'emails.subject',
            'emails.body',
            'emails.status',
            'emails.sent_at',
            'emails.error_message',
            'emails.created_at',
            'emails.updated_at',
            'users.name',
        )
            ->join('users', 'users.id', '=', 'emails.user_id');
        foreach ($filters as $field => $value) {
            if (in_array($field, [
                'emails.recipient_email',
                'emails.subject',
                'emails.body',
                'emails.status',
                'emails.sent_at',
                'emails.error_message',
                'emails.created_at',
                'emails.updated_at',
                'users.name'
            ], true)) {
                $query->when(is_string($value) && (!DateValidator::isValidDate($value)), function ($query) use ($field, $value) {
                    return $query->where($field, "LIKE", "%$value%");
                })
                    ->when(is_numeric($value), function ($query) use ($field, $value) {
                        return $query->where($field, $value);
                    });
            }
        }
        $result = $query->paginate()->toArray();
        return array_merge(
            ["data" => $this->applyResultSpecs($result["data"], $resultSpecs)],
            PaginationHelper::extract($result)
        );
    }
    public function find(int $id, ?int $user_id): ?Email
    {
        return Email::find($id);
    }

    public function create(array $data): Email
    {
        return Email::create($data);
    }

    public function update(int $id, array $data): ?Email
    {
        $email = Email::find($id);
        if (!$email) {
            return null;
        }

        $email->update($data);
        return $email;
    }

    public function delete(int $id): bool
    {
        $email = Email::find($id);
        return $email ? $email->delete() : false;
    }
}

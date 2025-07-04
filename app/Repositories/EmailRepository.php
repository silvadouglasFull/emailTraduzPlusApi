<?php

namespace App\Repositories;

use App\Models\Email;

class EmailRepository implements EmailRepositoryInterface
{
    public function all(): array
    {
        return Email::all()->toArray();
    }

    public function find(int $id): ?Email
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

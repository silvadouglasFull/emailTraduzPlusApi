<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Email
 *
 * @property int $email_id
 * @property string $recipient_email
 * @property string $subject
 * @property string $body
 * @property string $status
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon|null $sent_at
 * @property string|null $error_message
 * @property int $user_id
 */
class Email extends Model
{
    protected $table = 'emails';
    protected $primaryKey = 'email_id';
    public $timestamps = true;
    protected $fillable = [
        'recipient_email',
        'subject',
        'body',
        'status',
        'sent_at',
        'error_message',
        'user_id'
    ];
    protected $casts = [
        'sent_at' => 'datetime',
        'created_at' => 'datetime',
    ];
}

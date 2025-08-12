<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class RoleUserTable
 *
 * @property int $id
 * @property int $users_id
 * @property string $role
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class RoleUser extends Model
{
    use HasFactory;

    protected $table = 'role_users';

    protected $fillable = [
        'users_id',
        'role',
    ];

    /**
     * Relacionamento com User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

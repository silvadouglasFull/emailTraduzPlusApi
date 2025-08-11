<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 *
 * @property int $id
 * @property string $title
 * @property string $route
 * @property string|null $name
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Page extends Model
{
    /**
     * Nome da tabela associada.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * Atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'route',
        'name',
        'user_id'
    ];
}

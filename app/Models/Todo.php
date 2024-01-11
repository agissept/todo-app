<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Todo
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $owner
 * @property string $deadline
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Todo newModelQuery()

 * @method static \Illuminate\Database\Eloquent\Builder|Todo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Todo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Todo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';
    protected $fillable = ['name', 'description', 'deadline', 'owner', 'board_id'];

    protected $attributes = [
        'status' => false
    ];


}

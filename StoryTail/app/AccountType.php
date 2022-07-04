<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\AccountType
 *
 * @property int $id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AccountType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AccountType extends Model
{

    protected $fillable = [
        'type',
    ];



    public function setTypeAttribute($value)
    {
        $this->attributes['type'] = strtolower($value);
    }





    public function users(){

        return $this->hasMany(User::class);
    }
}

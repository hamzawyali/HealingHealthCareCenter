<?php

namespace App\Http\Controllers\Api\Agents\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Agents extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $table = 'agents';

    protected $fillable = [
        'id', 'name', 'email', 'password'
    ];

    /**
     * change column name from mail to phone
     *
     * @param $username
     * @return mixed
     */
    public function findForPassport($username)
    {
        return self::where('email', $username)->first(); // change column name whatever you use in credentials
    }


}

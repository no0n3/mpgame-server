<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getUserData($id) {
        $result = User::find($id);

        if ($result) {
            if ('' === trim($result->token)) {
                $result->token = static::randomStr(50);

                $result->save();
            }

            $data = [
                'id' => $result->id,
                'name' => $result->name,
                'email' => $result->email,
                'token' => $result->token,
            ];

            return $data;
        } else {
            return [];
        }
    }

    public function getToken() {
        
    }

    protected static function randomStr(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i = 0; $i < $length; $i++) {
            $str .= $keyspace[random_int(0, $max)];
        }

        return $str;
    }
}

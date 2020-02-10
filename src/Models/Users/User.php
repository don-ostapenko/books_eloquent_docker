<?php

namespace App\Models\Users;

use Exception;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users\UserInterface;

class User extends Model implements UserInterface
{
    /**
     * @var array
     */
    protected $fillable = ['nickname', 'email', 'role', 'password_hash', 'auth_token', 'created_at'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return User
     * @throws Exception
     */
    public function refreshAuthToken(): User
    {
        $this->auth_token = sha1(random_bytes(100));
        $this->save();
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 1;
    }
}
<?php

namespace App\Support;

use App\Exceptions\InvalidArgumentException;
use App\Models\Users\UserInterface;
use App\Models\Users\User;

class UsersAuth
{
    /**
     * @param array $data
     * @return UserInterface
     * @throws InvalidArgumentException
     */
    public static function login(array $data): UserInterface
    {
        $user = User::where('email', $data['email'])->first();

        if ($user === null) {
            throw new InvalidArgumentException('User by received email was not found');
        }

        if (!self::checkPass($data['pass'], $user)) {
            throw new InvalidArgumentException('Password is invalid');
        }

        return $user->refreshAuthToken();
    }

    /**
     * @param UserInterface $user
     */
    public static function createToken(UserInterface $user): void
    {
        $token = $user->id . ':' . $user->auth_token;
        Cookie::set('auth_token', $token);
    }

    /**
     * @param string $pass
     * @param UserInterface $user
     * @return bool
     */
    protected static function checkPass(string $pass, UserInterface $user): bool
    {
        return password_verify($pass, $user->password_hash);
    }

    /**
     * @return UserInterface|null
     */
    public static function getUserByToken(): ?UserInterface
    {
        $token = Cookie::get('auth_token') ?? '';
        if (empty($token)) {
            return null;
        }

        [$userId, $authToken] = explode(':', $token, 2);
        $user = User::where('id', (int)$userId)->first();

        if ($user === null) {
            return null;
        }
        if ($user->auth_token !== $authToken) {
            return null;
        }

        return $user;
    }
}
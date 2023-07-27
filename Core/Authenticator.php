<?php

namespace Core;

class Authenticator
{
    protected array $errors = [];
    public function attempt($email, $password): bool
    {
        // check if email exists
        $user = APP::resolve(Database::class)->query("Select * From users Where email = :email", [
            'email' => $email
        ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email,
                    'id' => $user['id']
                ]);
                return true;
            }
        }
        return false;
    }

    /**
     * @param $user
     * @return void
     */
    public function login ($user): void
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
            'id' => $user['id']
        ];
        session_regenerate_id(true);
    }

    /**
     * @return void
     */
    public function logout(): void
    {
        Session::destroy();
    }
}
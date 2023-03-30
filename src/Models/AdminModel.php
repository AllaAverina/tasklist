<?php

namespace Models;

use Database\Connection;
use Exceptions\InvalidArgumentException;

class AdminModel
{
    public function auth(array $data): void
    {
        if (isset($data['login']) && !empty($data['login']) && isset($data['password']) && !empty($data['password'])) {
            $login = trim(strval($data['login']));
            $password = trim(strval($data['password']));
            $connection = Connection::getInstance();
            $admin = $connection->getRow('SELECT * FROM `admin` WHERE `login`=:login', params: [':login' => $login]);
            if ($admin && password_verify($password, $admin['password'])) {
                if (password_needs_rehash($admin['password'], PASSWORD_DEFAULT)) {
                    $newPassword = password_hash($password, PASSWORD_DEFAULT);
                    $connection->runQuery(
                        'UPDATE `admin` SET `password`=:password WHERE `login`=:login',
                        [':password' => $newPassword, ':login' => $login]
                    );
                }
                return;
            }
            throw new InvalidArgumentException('Неверный логин или пароль');
        }
        throw new InvalidArgumentException('Заполните все поля');
    }
}

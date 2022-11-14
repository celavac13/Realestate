<?php

namespace App\Actions;

use App\Core\Database\Connection;
use App\Core\Request;
use PDO;

class LoginUser
{
    protected Connection $connection;
    protected Request $request;
    public function __construct(Connection $connection, Request $request)
    {
        $this->connection = $connection;
        $this->request = $request;
    }

    public function validate($params)
    {
        extract($params);
        $result = [];
        if (isset($email, $password) && !empty($email) && !empty($password)) {
            $email = trim($email);
            $password = trim($password);

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT * FROM users WHERE email = :email";
                $handle = $this->connection->pdo->prepare($sql);
                $params = ['email' => $email];
                $handle->execute($params);

                if ($handle->rowCount() > 0) {
                    $getRow = $handle->fetch(PDO::FETCH_ASSOC);

                    if ($password == $getRow['password']) {
                        $result['data'] = $getRow;

                        return $result;
                    } else {
                        $result['errors'] = 'Email or password are not correct';
                        return $result;
                    }
                } else {
                    $result['errors'] = 'Email or password are not correct';
                    return $result;
                }
            } else {
                $result['errors'] = 'Email or password are not correct';
                return $result;
            }
        } else {
            $result['errors'] = 'You must provide email and password';
            return $result;
        }
    }

    public function login($userInfo)
    {
        unset($userInfo['password']);
        $_SESSION['user'] = $userInfo;
    }
}

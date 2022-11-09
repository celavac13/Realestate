<?php

namespace App\Actions;

use App\Core\Database\QueryBuilder;
use PDO;

class LoginUser
{
    protected QueryBuilder $query;
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
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
                $handle = $this->query->pdo->prepare($sql);
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

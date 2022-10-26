<?php

class LoginUser
{
    protected QueryBuilder $query;
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    public function login($email, $password)
    {
        session_start();

        $errors = [];

        if (isset($_POST['submit'])) {
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
                            unset($getRow['password']);
                            $_SESSION = $getRow;
                            header('location: http://www.realestate.local');
                            exit();
                        } else {
                            $errors[] = "Wrong Email or Password";
                        }
                    } else {
                        $errors[] = "Wrong Email or Password";
                    }
                } else {
                    $errors[] = "Email address is not valid";
                }
            } else {
                $errors[] = "Email and Password are required";
            }
        }

        return $errors;
    }
}

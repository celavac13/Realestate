<?php

class RegisterUser
{
    protected QueryBuilder $query;
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    public function validate(string $username, string $name, string $email, string $password)
    {
        $result = [];

        if (
            isset($username, $name, $email, $password)
            && !empty($username)
            && !empty($name)
            && !empty($email)
            && !empty($password)
        ) {
            $username = trim($username);
            $name = trim($name);
            $email = trim($email);
            $password = trim($password);

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $query = 'SELECT * FROM users WHERE email = :email';
                $handle = $this->query->pdo->prepare($query);
                $params = ['email' => $email];
                $handle->execute($params);

                if ($handle->rowCount() == 0) {
                    $result['params'] = [
                        'username' => $username,
                        'name' => $name,
                        'email' => $email,
                        'password' => $password
                    ];

                    return $result;
                } else {
                    $result['errors'] = 'Email address already registered';

                    return $result;
                }
            } else {
                $result['errors'] = 'Email address is not valid';

                return $result;
            }
        } else {
            if (!isset($username) || empty($username)) {
                $result['errors'] = 'Username is required';

                return $result;
            }
            if (!isset($name) || empty($name)) {
                $result['errors'] = 'Name is required';

                return $result;
            }
            if (!isset($email) || empty($email)) {
                $result['errors'] = 'Email is required';

                return $result;
            }
            if (!isset($password) || empty($password)) {
                $result['errors'] = 'Password is required';

                return $result;
            }
        }
    }

    public function register(array $params)
    {
        extract($params);
        $query = "INSERT into users (username, name, email, password) VALUES (:username, :name, :email, :password)";

        try {
            $handle = $this->query->pdo->prepare($query);
            $params = [
                ':username' => $username,
                ':name' => $name,
                ':email' => $email,
                ':password' => $password
            ];

            $handle->execute($params);
            header('location: http://www.realestate.local');
        } catch (PDOException $e) {
            $errors[] = $e->getMessage();
        }
    }
}

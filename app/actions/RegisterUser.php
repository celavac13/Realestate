<?php

class RegisterUser
{
    protected QueryBuilder $query;
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }
    public function register($username, $name, $email, $password)
    {
        session_start();

        $errors = [];

        if (isset($_POST['submit'])) {
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
                    $sql = 'SELECT * FROM users WHERE email = :email';
                    $stmt = $this->query->pdo->prepare($sql);
                    $p = ['email' => $email];
                    $stmt->execute($p);

                    if ($stmt->rowCount() == 0) {
                        $sql = "INSERT into users (username, name, email, password) VALUES (:username, :name, :email, :password)";

                        try {
                            $handle = $this->query->pdo->prepare($sql);
                            $params = [
                                ':username' => $username,
                                ':name' => $name,
                                ':email' => $email,
                                ':password' => $password
                            ];

                            $handle->execute($params);

                            $success = 'User has been created successfully';
                        } catch (PDOException $e) {
                            $e->getMessage();
                        }
                    } else {
                        // $valUsername = $username;
                        // $valName = $name;
                        // $valEmail = '';
                        // $varPassword = $password;

                        $errors[] = 'Email address already registered';
                    }
                } else {
                    $errors[] = 'Email address is not valid';
                }
            } else {
                if (!isset($username) || empty($username)) {
                    $errors[] = 'Username is required';
                }
                if (!isset($name) || empty($name)) {
                    $errors[] = 'Name is required';
                }
                if (!isset($email) || empty($email)) {
                    $errors[] = 'Email is required';
                }
                if (!isset($password) || empty($password)) {
                    $errors[] = 'Password is required';
                }
            }
        }

        return $errors;
    }
}

<?php

namespace App\Controllers;

use App\Core\Database\QueryBuilder;
use App\Actions\AddNewRealestate;
use PDOException;
use FFI\Exception;

class AddRealestateController
{
    //store
    public function store(QueryBuilder $query)
    {
        $addNewAction = new AddNewRealestate($query);
        // dodati errore u sessiju
        $errors = [];

        if ($_POST) {
            $params = [
                'userId' => $_SESSION['user']['id'],
                'cityId' => $_POST['estate'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'image' => $_FILES['image']
            ];
            $result = $addNewAction->validate($params);

            if (array_key_exists('validate', $result)) {

                try {
                    $errors[] = $addNewAction->addRealestate($_SESSION['user']['id'], $_POST['estate'], $_POST['title'], $_POST['description'], $_POST['price'], $_FILES['image']);
                    header('location: http://www.realestate.local');
                } catch (PDOException | Exception $e) {

                    $errors[] = $e->getMessage();
                }
            } else {

                $errors[] = $result['errors'];
            }
        }

        $_SESSION['errors'] = $errors;
    }

    public function create($cities)
    {
        $errors = $_SESSION['errors'];
        require 'views/addrealestate.view.php';
    }
    // ovde posle prikazati te errore
    // napravi create
}

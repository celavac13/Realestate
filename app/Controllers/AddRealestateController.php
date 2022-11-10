<?php

namespace App\Controllers;

use App\Actions\AddNewRealestate;
use App\Models\City;
use App\Models\User;
use PDOException;
use FFI\Exception;

class AddRealestateController extends Controller
{
    //store
    public function store()
    {
        $user = $this->getLoggedInUser();

        if (!$user) {
            header('location: http://www.realestate.local');
        }

        $addNewAction = new AddNewRealestate;
        $errors = [];

        if ($_POST) {
            $params = [
                'user' => User::find($this->getLoggedInUser()),
                'cityId' => $_POST['estate'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'image' => $_FILES['image']
            ];
            $result = $addNewAction->validate($params);

            if (array_key_exists('validate', $result)) {

                try {
                    $errors[] = $addNewAction->addRealestate(User::find($this->getLoggedInUser()), $_POST['estate'], $_POST['title'], $_POST['description'], $_POST['price'], $_FILES['image']);
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

    public function create()
    {
        $cities = City::all();
        $errors = $_SESSION['errors'];
        require 'views/addrealestate.view.php';
    }
}

<?php

require 'app/actions/AddNewRealestate.php';

class AddRealestateController
{
    public function show(QueryBuilder $query, $cities)
    {
        $addNewAction = new AddNewRealestate($query);
        $errors = [];

        if ($_POST) {
            $params = [
                'userId' => $_SESSION['id'],
                'cityId' => $_POST['estate'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'image' => $_FILES['image']
            ];
            $result = $addNewAction->validate($params);

            if (array_key_exists('validate', $result)) {

                try {
                    $errors[] = $addNewAction->addRealestate($_SESSION['id'], $_POST['estate'], $_POST['title'], $_POST['description'], $_POST['price'], $_FILES['image']);
                    header('location: http://www.realestate.local');
                } catch (PDOException $e) {

                    $errors[] = $e->getMessage();
                }
            } else {

                $errors[] = $result['errors'];
            }
        }

        require 'app/views/addrealestate.view.php';
    }
}

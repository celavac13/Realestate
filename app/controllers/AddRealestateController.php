<?php

require 'app/actions/AddNewRealestate.php';

class AddRealestateController
{
    public function show(QueryBuilder $query, $cities)
    {
        $addNewAction = new AddNewRealestate($query);
        $result = [];
        $errors = [];


        if ($_POST) {
            $result = $addNewAction->validate($_SESSION['id'], $_POST['estate'], $_POST['title'], $_POST['description'], $_POST['price'], $_FILES['image']);
            if (array_key_exists(
                'params',
                $result
            )) {
                $addNewAction->addRealestate($result['params']);
            } else {
                $errors[] = $result['errors'];
            }
        }


        require 'app/views/addrealestate.view.php';
    }
}

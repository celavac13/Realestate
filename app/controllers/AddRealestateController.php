<?php

require 'app/actions/AddNewRealestate.php';

class AddRealestateController
{
    public function show(QueryBuilder $query, $cities)
    {
        session_start();
        $addNewAction = new AddNewRealestate($query);
        // var_dump($_FILES['image']['name']);

        if ($_POST) {
            $addNewAction->addRealestate($_SESSION['id'], $_POST['estate'], $_POST['title'], $_POST['description'], $_POST['price'], $_FILES['image']);
        }

        require 'app/views/addrealestate.view.php';
    }
}

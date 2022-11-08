<?php

// if ($_POST['delete'] == 0) {
$sql = 'INSERT INTO favourites (user_id, realestate_id) VALUES(:user_id, :realestate_id)';
$handle = $this->query->pdo->prepare($query);
$params = [
    ':user_id' => $_POST['userId'],
    ':realestate_id' => $_POST['realestateId']
];
$handle->execute($params);
// }

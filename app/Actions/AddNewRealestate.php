<?php

namespace App\Actions;

use App\Models\Realestate;
use App\Models\User;

class AddNewRealestate
{
    public function validate($params)
    {
        extract($params);
        $result = [];
        if (
            isset($user, $cityId, $title, $description, $price, $image)
            && !empty($user)
            && !empty($cityId)
            && !empty($title)
            && !empty($description)
            && !empty($price)
            && !empty($image)
        ) {
            $result = [
                'validate' => true
            ];

            return $result;
        } else {
            $result['errors'] = 'Fields must be fullfiled';
            return $result;
        }
    }

    public function addRealestate(User $user, int $cityId, string $title, string $description, int $price, array $image)
    {
        $realestate = new Realestate;

        $realestate->setUser($user);
        $realestate->setCityId($cityId);
        $realestate->setTitle($title);
        $realestate->setDescription($description);
        $realestate->setPrice($price);
        $realestate->setImage($image);

        $realestate->save();
    }
}

<?php

namespace App\Actions;

use App\Models\Realestate;

class EditRealestate
{
    public function validate(array $params, Realestate $realestate): array
    {
        extract($params);
        $result = [];

        if (
            isset($cityId, $title, $description, $price)
            && !empty($cityId)
            && !empty($title)
            && !empty($description)
            && !empty($price)
        ) {
            if (
                $realestate->getCityId() == $cityId
                && $realestate->getTitle() == $title
                && $realestate->getDescription() == $description
                && $realestate->getPrice() == $price
            ) {
                $result = [
                    'errors' => 'Values are same as before'
                ];
            } else {
                $result = [
                    'validate' => true
                ];
            }
        } else {
            $result = [
                'errors' => 'Fields must be fulfiled'
            ];
        }

        return $result;
    }

    public function editRealestate(int $cityId, string $title, string $description, int $price, Realestate $realestate)
    {
        $realestate->setCityId($cityId);
        $realestate->setTitle($title);
        $realestate->setDescription($description);
        $realestate->setPrice($price);

        $realestate->update();
    }
}

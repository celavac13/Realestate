<?php

namespace App\Actions;

use App\Core\Database\QueryBuilder;
use App\Models\Realestate;
use FFI\Exception;

class AddNewRealestate
{
    protected QueryBuilder $query;
    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    public function validate($params)
    {
        extract($params);
        $result = [];
        if (
            isset($userId, $cityId, $title, $description, $price, $image)
            && !empty($userId)
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

    public function addRealestate(int $userId, int $cityId, string $title, string $description, int $price, array $image)
    {
        $realestate = new Realestate;

        $realestate->setUserId($userId);
        $realestate->setCityId($cityId);
        $realestate->setTitle($title);
        $realestate->setDescription($description);
        $realestate->setPrice($price);
        $realestate->setImage($image);

        $realestate->save();
    }
}

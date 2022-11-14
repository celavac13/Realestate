<?php

namespace App\Controllers;

use App\Actions\AddNewRealestate;
use App\Actions\EditRealestate;
use App\Cache\CacheInterface;
use App\Core\Request;
use App\Models\City;
use App\Models\Realestate;
use Exception;
use PDOException;

class RealestateController extends Controller
{
    public function store(CacheInterface $cache, Request $request)
    {
        $user = $this->getLoggedInUser();

        if ($user === NULL) {
            return $this->redirect('/');
        }

        $addNewAction = new AddNewRealestate;
        $errors = [];

        if ($_POST) {
            $params = [
                'user' => $this->getLoggedInUser(),
                'cityId' => $request->post('city'),
                'title' => $request->post('title'),
                'description' => $request->post('description'),
                'price' => $request->post('price'),
                'image' => $request->files('image')
            ];
            $result = $addNewAction->validate($params);

            if (array_key_exists('validate', $result)) {

                try {
                    $errors[] = $addNewAction->addRealestate($this->getLoggedInUser(), $request->post('city'), $request->post('title'), $request->post('description'), $request->post('price'), $request->files('image'));
                    //brisemo ovaj key iz cache-a
                    $cache->del(Realestate::CACHE_KEY_ALL);
                    return $this->redirect('/');
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
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
        } else {
            $errors = [];
        }
        require '../views/addrealestate.view.php';
    }

    public function show(CacheInterface $cache, Request $request)
    {
        // set data for page
        $realestate = $cache->get(str_replace('{id}', $request->get('estate'), Realestate::CACHE_KEY_SINGLE));

        if (!$realestate) {
            $realestate = Realestate::find($request->get('estate'));
            $cache->set(str_replace('{id}', $request->get('estate'), Realestate::CACHE_KEY_SINGLE), $realestate, Realestate::CACHE_EXPIRATION);
        }
        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        // check if realestate is favourite
        if (NULL !== $this->getLoggedInUser()) {
            $isFavourite = $this->getLoggedInUser()->isFavourite(Realestate::find($realestate->getId()));
        }

        require '../views/singleRealestate.view.php';
    }

    public function update(CacheInterface $cache, Request $request)
    {
        $editRealestate = new EditRealestate;
        $realestate = Realestate::find($request->get('estate'));
        $errors = [];

        if ($_POST) {
            $params = [
                'cityId' => $request->post('city'),
                'title' => $request->post('title'),
                'description' => $request->post('description'),
                'price' => $request->post('price')
            ];
            $result = $editRealestate->validate($params, $realestate);

            if (array_key_exists('validate', $result)) {
                try {
                    $editRealestate->editRealestate($request->post('city'), $request->post('title'), $request->post('description'), $request->post('price'), $realestate);
                    $cache->del(Realestate::CACHE_KEY_ALL);
                    $cache->del(str_replace('{id}', $request->get('estate'), Realestate::CACHE_KEY_SINGLE));
                    return $this->redirect('/');
                } catch (PDOException | Exception $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $errors[] = $result['errors'];
            }
        }

        $_SESSION['errors'] = $errors;
        return $this->redirect("/edit?estate={$realestate->getId()}");
    }

    public function edit(Request $request)
    {
        $cities = City::all();
        $realestate = Realestate::find($request('estate'));
        $errors = $_SESSION['errors'];

        require '../views/editRealestate.view.php';
    }
}

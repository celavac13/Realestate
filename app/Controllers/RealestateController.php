<?php

namespace App\Controllers;

use App\Actions\AddNewRealestate;
use App\Actions\EditRealestate;
use App\Cache\CacheInterface;
use App\Core\Request;
use App\Core\Response;
use App\Models\City;
use App\Models\Realestate;
use Exception;
use PDOException;

class RealestateController extends Controller
{
    public function store(CacheInterface $cache, Request $request, Response $response): ?Response
    {
        $user = $this->getLoggedInUser();

        if ($user === NULL) {
            return $response->redirect('/');
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
                    $cache->del(Realestate::CACHE_KEY_ALL);
                    return $response->redirect('/');
                } catch (PDOException | Exception $e) {

                    $errors[] = $e->getMessage();
                }
            } else {

                $errors[] = $result['errors'];
            }
        }

        $_SESSION['errors'] = $errors;
    }

    public function create(Request $request, Response $response): Response
    {
        $cities = City::all();
        isset($_SESSION['errors']) ? $errors = $_SESSION['errors'] : $errors = [];

        return $response->data(['cities' => $cities, 'errors' => $errors, 'loggedInUser' => $this->getLoggedInUser()])->view('addrealestate');
    }

    public function show(CacheInterface $cache, Request $request, Response $response): Response
    {
        $realestate = $cache->get(str_replace('{id}', $request->get('estate'), Realestate::CACHE_KEY_SINGLE));

        if (!$realestate) {
            $realestate = Realestate::find($request->get('estate'));
            $cache->set(str_replace('{id}', $request->get('estate'), Realestate::CACHE_KEY_SINGLE), $realestate, Realestate::CACHE_EXPIRATION);
        }
        $cities = City::all();
        $totalInCity = fn ($slug) => City::findBySlug($slug)->getRealestates();

        if (NULL !== $this->getLoggedInUser()) {
            $isFavourite = $this->getLoggedInUser()->isFavourite(Realestate::find($realestate->getId()));
        }

        return $response->data(['realestate' => $realestate, '$cities' => $cities, 'totalInCity' => $totalInCity, 'isFavourite' => $isFavourite, 'loggedInUser' => $this->getLoggedInUser()])->view('singleRealestate');
    }

    public function update(CacheInterface $cache, Request $request, Response $response): Response
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
                    return $response->redirect('/');
                } catch (PDOException | Exception $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $errors[] = $result['errors'];
            }
        }

        $_SESSION['errors'] = $errors;
        return $response->redirect("/edit?estate={$realestate->getId()}");
    }

    public function edit(Request $request, Response $response): Response
    {
        $cities = City::all();
        $realestate = Realestate::find($request->get('estate'));
        isset($_SESSION['errors']) ? $errors = $_SESSION['errors'] : $errors = [];

        return $response->data(['cities' => $cities, 'realestate' => $realestate, 'errors' => $errors, 'loggedInUser' => $this->getLoggedInUser()])->view('editRealestate');
    }
}

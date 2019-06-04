<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function animals(Request $request, $type = null, $numberOfAnimals = 0)
    {
        $data = 'Hello World';
        return response()->json($data);
    }

    public function buy(Request $request)
    {
        return $request->get('data');
    }

    private function allAnimals() : array
    {
        return [
            [
                "id"   => 1,
                "price" => 5,
                "type" => 'dog',
                'name' => 'bulldog'
            ],
            [
                "id"   => 2,
                "price" => 10,
                "type" => 'dog',
                'name' => 'poodle'
            ],
            [
                "id"   => 3,
                "price" => 15,
                "type" => 'dog',
                'name' => 'beagle'
            ],
            [
                "id"   => 4,
                "price" => 5,
                "type" => 'cat',
                'name' => 'persian'
            ],
            [
                "id"   => 5,
                "price" => 100,
                "type" => 'cat',
                'name' => 'russian blue'
            ],
            [
                "id"   => 6,
                "price" => 10,
                "type" => 'cat',
                'name' => 'scottish fold'
            ],
            [
                "id"   => 7,
                "price" => 15,
                "type" => 'cat',
                'name' => 'siamese'
            ],
            [
                "id"   => 8,
                "price" => 100,
                "type" => 'cow',
                'name' => 'angus'
            ],
            [
                "id"   => 9,
                "price" => 200,
                "type" => 'cow',
                'name' => 'hereford'
            ],
            [
                "id"   => 10,
                "price" => 1000,
                "type" => 'cow',
                'name' => 'guernsey'
            ]
        ];

    }
}

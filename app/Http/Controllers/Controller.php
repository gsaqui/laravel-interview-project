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

    private function allAnimals() : array
    {
        return [
            [
                "type" => 'dog',
                'name' => 'bulldog'
            ],
            [
                "type" => 'dog',
                'name' => 'poodle'
            ],
            [
                "type" => 'dog',
                'name' => 'beagle'
            ],
            [
                "type" => 'cat',
                'name' => 'persian'
            ],
            [
                "type" => 'cat',
                'name' => 'russian blue'
            ],
            [
                "type" => 'cat',
                'name' => 'scottish fold'
            ],
            [
                "type" => 'cat',
                'name' => 'siamese'
            ],
            [
                "type" => 'cow',
                'name' => 'angus'
            ],
            [
                "type" => 'cow',
                'name' => 'hereford'
            ],
            [
                "type" => 'cow',
                'name' => 'guernsey'
            ]
        ];
    }
}

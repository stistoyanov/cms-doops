<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TmpController extends Controller
{
    public function index()
    {
        $language = 'en';
        $post['id'] = 6;
        $post['inputs'] = [
            0 => [
                'id' => 'record_2_Phone',
                'value' => '5475475475475475475475',
            ],
            1 => [
                'id' => 'record_2_PetName',
                'value' => '',
            ],
            2 => [
                'id' => 'record_2_ContactEmail',
                'value' => 'test1@abvbg.com',
            ],
            3 => [
                'id' => 'record_2_FirstName',
                'value' => 'Stiliyan',
            ],
            4 => [
                'id' => 'record_2_LastName',
                'value' => 'Stoyanov',
            ],
            5 => [
                'id' => 'record_2_ValidFor',
                'value' => 'print',
            ],
        ];

        $url = 'https://be-chameleon-shop.st/api/campaign-update-record';

        dd($url);
    }
}
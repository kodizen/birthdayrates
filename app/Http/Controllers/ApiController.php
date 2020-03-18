<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $client = new Client();
        // $response = $client->request('GET', 'http://data.fixer.io/api/2020-12-24?access_key=API_KEY&base=GBP&symbols=USD,CAD,EUR');
        // $statusCode = $response->getStatusCode();
        // $body = $response->getBody()->getContents();

        return response()->json([
            'base' => 'GBP',
            'date' => '2020-02-02',
            'rates' => [
                'AUD' => 1.4324,
                'CAD' => 1.4324,
                'CHF' => 1.4324,
                'CNY' => 1.4324,
                'GBP' => 1.4324,
                'JPY' => 1.4324,
                'USD' => 1.4324,
                'EUR' => 1.4343
            ]
        ], 200);
    }
}

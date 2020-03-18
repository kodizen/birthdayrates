<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Util\Rate;
class ApiController extends Controller
{
    protected $rate;

    public function __construct(Rate $rate)
    {
    	$this->rate = $rate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rate = $this->rate->latest();
        return response()->json($rate, 200);
    }
}

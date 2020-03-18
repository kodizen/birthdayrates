<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Birthday;
use Illuminate\Support\Facades\Log;
use App\Util\Rate;

class BirthdaysController extends Controller
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
        // Return birthdays sorted by date.
        return Birthday::orderBy('birthday', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dateRequest = \Carbon\Carbon::createFromDate($request->birthday);

        if ($dateRequest->isFuture()) {
            return response()->json([
                'errors' => 'Sorry, No fate but what we make. Please submit a past date.',
                'request' => $request->all()
            ], 422);
        }

        if ($dateRequest->lt(\Carbon\Carbon::now()->subYear())) {
            return response()->json([
                'errors' => 'Sorry, We only accept birthdays in the last year',
                'request' => $request->all()
            ], 422);
        }

        try {
            $birthday = Birthday::where('birthday', '=', $request->birthday)->first();

            if ($birthday === null) {
                // Fetch from fixer.io
                try {
                    $rate = $this->rate->findByDate($dateRequest->format('Y-m-d'));
                } catch (\Throwable $th) {
                    return response()->json([
                        'errors' => $th
                    ], 400);
                }
                $birthday = new Birthday([
                    'birthday' => $rate->date,
                    'JPY' => $rate->rates->JPY,
                    'CAD' => $rate->rates->CAD,
                    'EUR' => $rate->rates->EUR,
                    'USD' => $rate->rates->USD,
                    'GBP' => $rate->rates->GBP,
                    'base' => $rate->base
                ]);
                $birthday->formatted_birthday = $birthday->getFormattedDate();
                $birthday->save();
            } else {
                $birthday->occurrences++;
                $birthday->save;
            }
            return response()->json($birthday, 201);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Birthday;
use Illuminate\Support\Facades\Log;

class BirthdaysController extends Controller
{
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
                $birthday = Birthday::create($request->all());
            } else {
                $birthday->occurrences++;
                $birthday->save;
            }
            return response()->json($birthday, 201);
        } catch (\Throwable $th) {
            Log::debug($th);
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

<?php

namespace App\Http\Controllers;

use App\Sap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $saps = Auth::user()->saps;
        return response()->json([
            'saps' => $saps
        ], 200);
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
        //
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'middleName' => 'required',
            'gender' => 'required',
            'birthDay' => 'required',
            'birthMonth' => 'required',
            'birthYear' => 'required',
            'received' => 'required',
            'receivedWhere' => 'required',
            'receivedWhen' => 'required'
        ]);

        $sap = $request->user()->saps()->create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'middleName' => $request->middleName,
            'gender' => $request->gender,
            'birthDay' => $request->birthDay,
            'birthMonth' => $request->birthMonth,
            'birthYear' => $request->birthYear,
            'received' => $request->received,
            'receivedWhere' => $request->receivedWhere,
            'receivedWhen' => $request->receivedWhen
        ]);

        return response()->json([
            'sap' => $sap,
            'message' => 'task has been created'
        ]);
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
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'middleName' => 'required',
            'gender' => 'required',
            'birthDay' => 'required',
            'birthMonth' => 'required',
            'birthYear' => 'required',
            'received' => 'required',
            'receivedWhere' => 'required',
            'receivedWhen' => 'required'
        ]);

        $sap = $request->user()->saps()->whereId($id)->update($request->all());

        return response()->json([
            'sap' => $sap,
            'message' => 'task has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sap $sap)
    {
        //
        $sap->delete();

        return response()->json([
            'sap' => $sap,
            'message' => 'task has been deleted'
        ]);
    }
}

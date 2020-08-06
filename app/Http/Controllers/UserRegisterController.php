<?php

namespace App\Http\Controllers;

use App\UserRegister;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ur = UserRegister::all();
        return response()->json($ur, 200);
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
        $ur = new UserRegister();
        $ur->email      = $request->data['email'];
        $ur->avatar     = $request->data['avatar'];
        $ur->first_name = $request->data['first_name'];
        $ur->last_name  = $request->data['last_name'];
        $ur->save();
        return response()->json(["message" => "Usuario agregado con éxito"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function show(UserRegister $userRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRegister $userRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRegister $userRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserRegister $userRegister)
    { 
        $ur = UserRegister::findOrFail($request->id);
        $ur->delete();
        return response()->json(["message" => "Eliminado con éxito"], 200);
    }
}

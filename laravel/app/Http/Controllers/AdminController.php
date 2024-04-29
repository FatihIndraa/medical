<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo "halo ";
        echo "<br> <a href='/logout'>logout</a>";
    }
    public function admin()
    {
        echo "halo admin";
        echo "<br> <a href='/logout'>logout</a>";
    }
    public function dokter()
    {
        echo "halo dokter";
        echo "<br> <a href='/logout'>logout</a>";
    }
    public function pasien()
    {
        echo "halo pasien";
        echo "<br> <a href='/logout'>logout</a>";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

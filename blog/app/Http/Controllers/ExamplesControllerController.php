<?php

namespace App\Http\Controllers;

use App\ExamplesController;
use Illuminate\Http\Request;

class ExamplesControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  /examples
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  /examples/create
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  POST/examples
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExamplesController  $examplesController
     * @return \Illuminate\Http\Response
     */
    public function show(ExamplesController $examplesController)
    {
        //  GET /examples/id
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExamplesController  $examplesController
     * @return \Illuminate\Http\Response
     */
    public function edit(ExamplesController $examplesController)
    {
        //  GET /examples/id/edit
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExamplesController  $examplesController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExamplesController $examplesController)
    {
        //  PATCH /examples/id
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExamplesController  $examplesController
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamplesController $examplesController)
    {
        //  DELETE examples/id
    }
}

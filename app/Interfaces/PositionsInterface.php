<?php

namespace App\Interfaces;

interface PositionsInterface
{
    public function index();

    /**
     * Show the form for creating a new resource.
     */
    public function create();

    /**
     * Store a newly created resource in storage.
     */
    public function store($request);

    /**
     * Display the specified resource.
     */
    public function show( $position);

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $position);

    /**
     * Update the specified resource in storage.
     */
    public function update($request,  $position);


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $position);

}

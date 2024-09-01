<?php

namespace App\Interfaces;

interface CommitteesInterface
{
    /**
     * Display a listing of the resource.
     */
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
    public function show($committee);

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($committee);

    /**
     * Update the specified resource in storage.
     */
    public function update($request,$committee);

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($committee);

}

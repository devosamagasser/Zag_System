<?php

namespace App\Interfaces;

interface MembersInterface
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
    public function show($member);

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($member);

    /**
     * Update the specified resource in storage.
     */
    public function update($request,$member);

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($member);

    public function export();

    public function import($request);


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Interfaces\PositionsInterface;
use App\Models\Position;

class PositionController extends Controller
{
    public $interface;

    public function __construct(PositionsInterface $interface)
    {
        $this->interface = $interface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->interface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->interface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        return $this->interface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return $this->interface->show($position);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return $this->interface->edit($position);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        return $this->interface->update($request,$position);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        return $this->interface->destroy($position);
    }
}

<?php

namespace App\Http\Controllers;

use App\Interfaces\CommitteesInterface;
use App\Models\Committee;
use App\Http\Requests\StoreCommitteeRequest;
use App\Http\Requests\UpdateCommitteeRequest;

class CommitteeController extends Controller
{
    public $interface;

    public function __construct(CommitteesInterface $interface)
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
    public function store(StoreCommitteeRequest $request)
    {
        return $this->interface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Committee $committee)
    {
        return $this->interface->show($committee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Committee $committee)
    {
        return $this->interface->edit($committee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommitteeRequest $request, Committee $committee)
    {
        return $this->interface->update($request,$committee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Committee $committee)
    {
        return $this->interface->destroy($committee);
    }
}

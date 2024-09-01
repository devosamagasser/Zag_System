<?php

namespace App\Http\Controllers;

use App\Interfaces\MembersInterface;
use App\Models\Members;
use App\Http\Requests\StoreMembersRequest;
use App\Http\Requests\UpdateMembersRequest;
use Illuminate\Http\Request;

class MembersController extends Controller
{

    public $interface;

    public function __construct(MembersInterface $interface)
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
    public function store(StoreMembersRequest $request)
    {
        return $this->interface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Members $members)
    {
        return $this->interface->show($members);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Members $members)
    {
        return $this->interface->edit($members);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMembersRequest $request, Members $members)
    {
        return $this->interface->update($request, $members);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Members $members)
    {
        return $this->interface->destroy($members);
    }

    /**
     * Export Members Data As Excel sheet.
     */
    public function export()
    {
        return $this->interface->export();
    }

    /**
     * Import Members Data From Excel sheet.
     */
    public function import(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        return $this->interface->import($request);
    }


}

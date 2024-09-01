<?php

namespace App\Repositories;
use  App\Interfaces\PositionsInterface;
use App\Models\Position;
use App\Traits\MainTrait;

class PositionsRepository implements PositionsInterface
{
    use MainTrait;

    public function __construct()
    {
        $this->section = 'positions';
    }

    // Define your repository methods here
    public function index()
    {
        $positions = Position::get();
        $data = array_merge($this->mainData('Data'),['positions'=>$positions]);
        return view($this->section.'.index',compact('data'));
    }

    public function create()
    {
        $data = $this->mainData('Create New Position');
        return view($this->section.'.create',compact('data'));
    }

    public function store($request)
    {
        Position::create([
            'name'=>trim($request->name)
        ]);

        return $this->backHome('Added Successfully');
    }

    public function show($committee)
    {

    }

    public function edit($position)
    {
        $data = array_merge($this->mainData('Edit '.$position->name),['position'=>$position]);
        return view($this->section.'.edit',compact('data'));
    }

    public function update($request,$position)
    {
        $position->update([
            'name' => $request->name,
        ]);
        return $this->backHome('updated successfully');
    }

    public function destroy($position)
    {
        $position->delete();
        return $this->backHome('Deleted Successfully');
    }
}

<?php

namespace App\Repositories;
use  App\Interfaces\CommitteesInterface;
use App\Models\Committee;
use App\Models\Section;
use App\Traits\MainTrait;

class CommitteesRepository implements CommitteesInterface
{

    use MainTrait;

    public function __construct()
    {
        $this->section = 'committees';
    }

    public function index()
    {
        $committees = (!request('filter')) ? Committee::with('section')->get() : Committee::with('section')->where('section_id',request('filter'))->get();
        $data = array_merge($this->mainData('Data'),['committees'=>$committees,]);
        return view('committees.index',compact('data'));
    }

    public function create()
    {
        $data = array_merge($this->mainData('Create New Committee'));
        return view('committees.create',compact('data'));
    }

    public function store($request)
    {
        $validatedData = $request->validated();
        Committee::create($validatedData);
        return $this->backHome('committee was added');
    }

    public function show($committee)
    {

    }

    public function edit($committee)
    {
        $data = array_merge($this->mainData('Edit '.$committee->name),['committee'=>$committee]);
        return view('committees.edit',compact('data'));
    }

    public function update($request,$committee)
    {
        $validatedData = $request->validated();
        $committee->update($validatedData);
        return $this->backHome('updated successfully');
    }

    public function destroy($committee)
    {
        $committee->delete();
        return $this->backHome('Deleted Successfully');
    }

}

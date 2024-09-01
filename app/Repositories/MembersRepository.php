<?php

namespace App\Repositories;
use App\Exports\MembersExport;
use App\Imports\MembersImport;
use App\Interfaces\MembersInterface;
use App\Models\MemberData;
use App\Models\Members;
use App\Traits\ImagesTrait;
use App\Traits\MainTrait;
use App\Traits\MembersTrait;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MembersRepository implements MembersInterface
{
    use MainTrait,ImagesTrait,MembersTrait;

    public $section;

    public function __construct()
    {
        $this->section = 'members';
    }

    // Define your repository methods here
    public function index()
    {
        $members = $this->filterConditions();
        $data = array_merge($this->mainData('Data'),['members'=>$members]);
        return view($this->section.'.index',compact('data'));
    }

    public function create()
    {
        $data = ['sections'=>getSections(),'committees'=>getCommittees()];
        $data = array_merge($this->mainData('Add New Member'),$data);
        return view($this->section.'.create',compact('data'));
    }

    public function store($request)
    {
        $validatedData = $request->validated();
        $image = $validatedData['image'];
        $imageName = $this->moveImage($image);
        DB::transaction(function() use($validatedData,$imageName){
            $member = Members::create([
                'name'=>trim($validatedData['name']),
                'email'=>trim($validatedData['email']),
                'phone'=>trim($validatedData['phone']),
                'images'=>$imageName,
                'city'=>trim($validatedData['city']),
                'faculty'=>trim($validatedData['faculty']),
                'year'=>$validatedData['year'],
                'department'=>trim($validatedData['department']),
                'position_id'=>$validatedData['position_id']
            ]);

            MemberData::create([
                'member_id' => $member->id,
                'section_id' => $validatedData['section_id'],
                'committee_id' => $validatedData['committee_id'],
            ]);

        });

        return $this->backHome('Added Successfully');
    }

    public function show($member)
    {

    }

    public function edit($member)
    {
        $data = array_merge($this->mainData('Edit '.$member->name),['member'=>$member]);
        return view($this->section.'.edit',compact('data'));
    }

    public function update($request,$member)
    {
        $member->update([
            'name' => $request->name,
        ]);
        return $this->backHome('Updated Successfully');
    }

    public function destroy($member)
    {
        DB::transaction(function() use($member){
            $this->deleteImage($member->images);
            $member->delete();
        });
        return $this->backHome('Deleted Successfully');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        return Excel::download(new MembersExport, 'Zag_Eng_Database.xlsx');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function import($request)
    {
//        dd($request->file);
        Excel::import(new MembersImport, $request->file);
        return $this->backHome('Data Added Successfully');
    }

 }

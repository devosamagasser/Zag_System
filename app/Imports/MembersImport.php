<?php

namespace App\Imports;

use App\Models\Committee;
use App\Models\MemberData;
use App\Models\Members;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\PersistRelations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Validators\ValidationException;

class MembersImport implements ToModel,WithHeadingRow,PersistRelations,WithValidation
{

    public $row = 0;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $this->row++;

        $membersData = DB::transaction(function () use ($row) {
            $members = Members::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'phone' => $row['phone'],
                'images' => $row['image'],
                'city' => $row['city'],
                'faculty' => $row['faculty'],
                'year' => $row['year'],
                'department' => $row['department'],
                'position_id' => getPositionsArray()[trim($row['position'])],
            ]);

            MemberData::create([
                'member_id' => $members->id,  // The ID of the newly created member
                'committee_id' => getCommitteesArray()[trim($row['committee'])],
                'section_id' => getSectionsArray()[trim($row['section'])],
            ]);

            return $members;
        });

        return $membersData;
    }

    public function rules(): array
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|string|unique:members,email|max:255',
            'phone'=>'required|string|unique:members,phone|max:255',
            'image'=>'required|url',
            'city'=>'required|string|max:255',
            'faculty'=>'required|string|max:255',
            'year'=>'required|integer|between:1,5',
            'department'=>'required|string|max:255',
            'section'=>'required|exists:sections,name',
            'position'=>'required|exists:positions,name',
            'committee'=>'nullable|exists:committees,name',
        ];
    }

    public function fail($key,$error,$row){
        $failures[] = new Failure($this->row,$key,$error,$row);
        Throw new ValidationException(\Illuminate\Validation\ValidationException::withMessages($error),$failures);
    }
}

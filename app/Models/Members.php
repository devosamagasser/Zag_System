<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'email',
            'phone',
            'images',
            'city',
            'faculty',
            'year',
            'department',
            'position_id',
        ];

    public function position()
    {
        return $this->belongsTo(Position::class,'position_id','id');
    }

    public function committee()
    {
        return $this->hasOne(MemberData::class,'member_id','id')->with(['committee','section']);
    }

//    public function images(): Attribute
//    {
//        return Attribute::make(
//            get: fn($value) => 'assets\images\members\\'.$value
//        );
//    }

    public function year(): Attribute
    {
        $year = ['1'=>'First Year','2'=>'Second Year','3'=>'Third Year','4'=>'Forth Year','5'=>'Fifth Year'];
        return Attribute::make(
            get: fn($value) => $year[$value]
        );
    }

    /**
     * @return string[]
     */
    public static function rules()
    {
        return [
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|unique:members,email|max:255',
            'phone'=>'required|string|unique:members,phone|max:255',
            'image'=>'required|file|image|max:10000',
            'city'=>'required|string|max:255',
            'faculty'=>'required|string|max:255',
            'year'=>'required|integer|between:1,5',
            'department'=>'required|string|max:255',
            'section_id'=>'required|integer|exists:sections,id',
            'position_id'=>'required|integer|exists:positions,id',
            'committee_id'=>'nullable|integer|exists:committees,id',
        ];
    }
}

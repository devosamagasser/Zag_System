<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberData extends Model
{
    use HasFactory;

    protected $fillable = ['member_id','section_id','committee_id'];

    public function committee()
    {
        return $this->belongsTo(Committee::class,'committee_id','id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class,'section_id','id');
    }
}

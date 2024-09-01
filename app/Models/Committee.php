<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = ['name','section_id'];

    public function section(){
        return $this->belongsTo(Section::class,'section_id','id');
    }

    public static function rules(){
        return [
            'name' => 'required|string|max:255',
            'section' => 'required|integer|exists:sections,id'
        ];
    }
}

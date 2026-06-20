<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category ()
    {
        return $this->belongsTo(category::class,'cat_id','id');
    }

    //subcategory belongsto category
    //belongsTo
    //hasMany
}

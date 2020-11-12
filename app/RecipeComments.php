<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeComments extends Model
{
    public static $rules = array(
        'body' => 'required',
    );
    
    protected $fillable = [
       'recipe_id',
       'body',
       'edited_at',
    ];
}

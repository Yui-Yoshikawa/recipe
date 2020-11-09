<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = array('id');
    protected $table = 'recipe';
    
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    public function histories()
    {
      return $this->hasMany('App\RecipeHistory');

    }
    
    public function comments()
    {
        return $this->hasMany('App\RecipeComment');
    }
}

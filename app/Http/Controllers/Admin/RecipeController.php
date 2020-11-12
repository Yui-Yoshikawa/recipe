<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Recipe;
use App\RecipeHistory;
use App\RecipeComments;
use Carbon\Carbon;


class RecipeController extends Controller
{
    public function add()
    {
        return view('admin.recipe.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, Recipe::$rules);
        
        $recipe = new Recipe;
        $form = $request->all();
        
        if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $recipe->image_path = basename($path);
        } else {
            $recipe->image_path = null;
        }
        
        unset($form['_token']);
        unset($form['image']);
        
        $recipe->fill($form);
        $recipe->save();
        
        return redirect('admin/recipe');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = Recipe::where('title', $cond_title)->get();
        } else {
            $posts = Recipe::all();
        }
        return view('admin.recipe.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function edit(Request $request)
    {
        $recipe = Recipe::find($request->id);
        if (empty($recipe)) {
          abort(404);    
        }
        return view('admin.recipe.edit', ['recipe_form' => $recipe]);
    }


    public function update(Request $request)
    {
        $this->validate($request, Recipe::$rules);
        $recipe = Recipe::find($request->id);
        $recipe_form = $request->all();
        if ($request->remove == 'true') {
            $recipe_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $recipe_form['image_path'] = basename($path);
        } else {
            // dd($recipe);
            $recipe_form['image_path'] = $recipe->image_path;
        }
        unset($recipe_form['image']);
        unset($recipe_form['remove']);
        unset($recipe_form['_token']);
  
        $recipe->fill($recipe_form)->save();
        
        $history = new RecipeHistory;
        $history->recipe_id = $recipe->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
        return redirect('admin/recipe');
    }
    
    public function delete(Request $request)
    {
        $recipe = Recipe::find($request->id);
        $recipe->delete();
        return redirect('admin/recipe/');
    }
    
    
    public function commentAdd(Request $request)
    {
        $form = $request->all();
        $recipe = Recipe::find($request->id);
        return view('admin.comment.create', ['form' => $form,'recipe' => $recipe]);
    }

    public function commentCreate(Request $request)
    {
        $this->validate($request, RecipeComments::$rules);
        
        $comment = new RecipeComments;
        $comment->edited_at = Carbon::now();
        $comment->user_id = Auth::id();
        $form = $request->all();
        
        unset($form['_token']);
        
        $comment->fill($form);
        $comment->save();
        
        return redirect('admin/recipe');
    }

}

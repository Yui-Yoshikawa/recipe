<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Recipe;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Recipe::all()->sortByDesc('updated_at');

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('recipe.index', ['headline' => $headline, 'posts' => $posts]);
    }
}

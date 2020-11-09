<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, Profiles::$rules);
        
        $profiles = new Profiles;
        $form = $request->all();
        
        unset($form['_token']);
        
        $profiles->fill($form);
        $profiles->save();
        
        return redirect('admin/profile/create');
    }

    public function edit()
    {
        $user_id = Auth::id();
        $user_form = User::find($user_id);
        return view('admin.profile.edit', ['user' => $user_form]);
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }
    
    public function index(Request $request)
    {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          $posts = Profile::where('title', $cond_title)->get();
      } else {
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
}

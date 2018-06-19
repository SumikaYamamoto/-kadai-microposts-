<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NanopostsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $nanoposts = $user->nanoposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'nanoposts' => $nanoposts,
            ];
            $data += $this->counts($user);
            return view('users.show', $data);
        }else {
            return view('welcome');
        }
    }
      public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->nanoposts()->create([
            'content' => $request->content,
        ]);

        return redirect('/');
    }
    
     public function destroy($id)
    {
        $nanopost = \App\Nanopost::find($id);

        if (\Auth::id() === $nanopost->user_id) {
            $nanopost->delete();
        }

        return redirect('/');
    }
}

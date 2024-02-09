<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // index
    public function index(){
        //get all users with pagination
        $users = DB::table('users')->paginate(10);
        return view('pages.users.index', compact('users'));
    }

    //create
    public function create(){
        return view('pages.user.create');
    }

    //store
    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'roles' => 'required|in:admin,staff,user',
        ]);

    }

    //show
    public function show($id){
        return view('pages.user.show');
    }

    //edit
    public function edit($id){
        return view('pages.user.edit');
    }

    //update
    public function update(){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . id,
            'roles' => 'required',
        ]);
    }

    //destroy
    public function destroy($id){

    }
}

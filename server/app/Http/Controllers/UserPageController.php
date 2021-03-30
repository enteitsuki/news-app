<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserPageController extends Controller
{
    function show($name)
    {
		$user = User::where("display_name", $name)->first();
		if(!$user){
			return abort(404);
		}
		return view("user_page", [
			"user" => $user
		]);
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsEntry;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$user = Auth::user();

		$news_list = $user->newsEntry()
            ->orderBy("id", "desc")
            ->paginate(10);

		return view("home", [
			"news_list" => $news_list,
			"user" => $user
		]);
    }
}

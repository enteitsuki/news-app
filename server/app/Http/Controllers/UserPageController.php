<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\NewsEntry;

class UserPageController extends Controller
{
	function show($name)
	{
		$user = User::where("display_name", $name)->first();
		if (!$user) {
			return abort(404);
		}

		$news_list = $user->newsEntry()
			->orderBy("id", "desc")
			->paginate(10);

		return view("user_page", [
			"news_list" => $news_list,
			"user" => $user
		]);
	}

	function showDetail($name, $id)
	{
		$news = NewsEntry::find($id);
		if (!$news) {
			return abort(404);
		}
		$user = $news->user()->first();

		//display_nameが違う(不正なアクセス！)
		if ($user->display_name != $name) {
			return abort(404);
		}

		return view("user_news_detail", [
			"news" => $news,
			"user" => $user
		]);
	}
}

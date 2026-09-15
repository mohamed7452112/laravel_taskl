<?php

use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
	return view('welcome');
});

$users = [
	[
		"id" => 1,
		"name" => "mohammed",
		"age" => 22
	],
	[
		"id" => 2,
		"name" => "mohammoud",
		"age" => 27
	],
	[
		"id" => 3,
		"name" => "malak",
		"age" => 24
	],
	[
		"id" => 4,
		"name" => "haneen",
		"age" => 23
	],
];

Route::get("/users", function () use ($users) {

	// var_dump($users);

	return view('allUsers', compact('users'));
});

Route::get("/users/{id}", function ($id) use ($users) {

	foreach ($users as $user) {

		if ($user["id"] == $id) {
			return view('user', compact('user'));
		}
	}
});


//! ************************************************** !//


$courses = [
	[
		"id" => 1,
		"name" => "php",
		"description" => " sql Lorem ipsum dolor sit amet consectetur adipisicing elit."
	],
	[
		"id" => 2,
		"name" => "sql",
		"description" => " sql Lorem ipsum dolor sit amet consectetur adipisicing elit."

	],
	[
		"id" => 3,
		"name" => "laravel",
		"description" => " laravel Lorem ipsum dolor sit amet consectetur adipisicing elit."

	],
	[
		"id" => 4,
		"name" => "js",
		"description" => " js Lorem ipsum dolor sit amet consectetur adipisicing elit."

	],
];


Route::get('/courses', function () use ($courses) {
	return view('courses', compact('courses'));
});


route::get("/courses/{id}/", function ($id) use ($courses) {

	foreach ($courses as $course) {

		if ($course["id"] == $id) {
			return view('course', compact('course'));
		}
	}
});

route::get('/categories',[Categorycontroller::class,'index'])->name('categories.index');
route::get('/categories/{id}',[Categorycontroller::class,'show'])->name('categories.show');
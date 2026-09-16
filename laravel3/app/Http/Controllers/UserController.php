<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('orders')->get();
        return response()->json($users); // هيرجع البيانات كـ JSON للاختبار السريع
    }

    public function show($id)
    {
        $user = User::with('orders')->findOrFail($id);
        return response()->json($user);
    }
}

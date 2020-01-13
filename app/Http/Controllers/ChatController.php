<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{

    public function index(Request $request)
    {
        return view('pages.chat', ['users' => $this->userList()]);
    }

    protected function userList()
    {

        return User::query()->orderBy('created_at', 'desc')->get();
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->session()->get("user")['id'];
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();

        $data = [
            'user' => $user,
            'notes' => $notes
        ];
        return view("home", $data);
    }
}

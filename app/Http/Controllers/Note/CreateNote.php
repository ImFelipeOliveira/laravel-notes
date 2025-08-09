<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\User;

class CreateNote extends Controller
{
    public function newNote(Request $request)
    {
        $id = $request->session()->get("user")['id'];
        $user = User::find($id)->toArray();
        $data = [
            'user' => $user
        ];
        return view('new_note', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            "text_title" => "required|string|max:3000",
            "text_note" => "required|string|max:10000"
        ], [
            "text_title.required" => "Please enter a title for your note.",
            "text_title.max" => "The title may not be greater than 3000 characters.",
            "text_note.required" => "Please enter the text for your note.",
            "text_note.max" => "The text may not be greater than 10000 characters."
        ]);
        $note = new Note();
        $note->title = $request->input('text_title');
        $note->content = $request->input('text_note');
        $user = $this->getUser($request);
        $note->user_id = $user->id;
        $note->save();
        return redirect()->route("home")->with("success", "Note created successfully.");
    }

    protected function getUser(Request $request)
    {
        try {
            $id = $request->session()->get("user")['id'];
            return User::find($id);
        } catch (\Exception $e) {
            return throw new \Exception("User not found or session expired.");
        }
    }
}

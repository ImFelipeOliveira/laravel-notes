<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Note;
use App\Models\User;

class EditNote extends Controller
{
    public function viewNote(Request $request)
    {
        $id = Crypt::decrypt($request->route('id'));
        $note = Note::findOrFail($id);
        $user = $this->getUser($request);
        $this->validateNoteOwnership($user, $note);
        $data = [
            'user' => $user,
            'note' => $note,
        ];

        return view('edit_note', $data);
    }

    public function update(Request $request)
    {
        $id = Crypt::decrypt($request->route('id'));
        $note = Note::findOrFail($id);

        $request->validate([
            "text_title" => "required|string|max:3000",
            "text_note" => "required|string|max:10000"
        ], [
            "text_title.required" => "Please enter a title for your note.",
            "text_title.max" => "The title may not be greater than 3000 characters.",
            "text_note.required" => "Please enter the text for your note.",
            "text_note.max" => "The text may not be greater than 10000 characters."
        ]);

        $note->title = $request->input('text_title');
        $note->content = $request->input('text_note');
        $note->save();

        return redirect()->route("home");
    }

    protected function getUser(Request $request)
    {
        $id = $request->session()->get("user")["id"];
        return User::findOrFail($id);
    }

    protected function validateNoteOwnership(User $user, Note $note)
    {
        if ($user->id != $note->user_id) {
            return redirect()->route("home")->with("error", "Unauthorized action.");
        }
    }
}

<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DeleteNote extends Controller
{
    public function __invoke(Request $request)
    {
        $id = Crypt::decrypt($request->route('id'));
        $note = Note::findOrFail($id);
        $note->delete();

        return redirect()->route('home')->with('success', 'Note deleted successfully.');
    }
}

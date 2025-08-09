@extends('layouts.main_layout')
@include('top_bar')
<div class="container mx-auto">
    <div class="row">
        <div class="col">
            <p class="display-6 mb-0">EDIT NOTE</p>
        </div>
        <div class="col text-end">
            <a href="#" class="btn btn-outline-danger btn-sm ">
                <i class="btn btn-close btn-sm"></i>
            </a>
        </div>
    </div>

    <!-- form -->
    <form action={{ route('updateNote', ['id' => Crypt::encrypt($note->id)]) }} method="post">
        @csrf
        <div class="row mt-3">
            <div class="col">
                <div class="mb-3">
                    <label class="form-label">Note Title</label>
                    <input type="text" class="form-control bg-primary text-white" name="text_title"
                        value="{{ $note['title'] }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Note Text</label>
                    <textarea class="form-control bg-primary text-white" name="text_note" rows="5">{{ $note['content'] }}</textarea>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col text-end">
                <a href={{ route('home') }} class="btn btn-primary px-5"><i class="fa-solid fa-ban me-2"></i>Cancel</a>
                <button type="submit" class="btn btn-secondary px-5"><i
                        class="fa-regular fa-circle-check me-2"></i>Save</button>
            </div>
        </div>
    </form>
</div>

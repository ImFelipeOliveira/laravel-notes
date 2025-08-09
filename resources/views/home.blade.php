@extends('layouts.main_layout')
@section('content')
    <div class="row justify-content-center">
        <div class="col">


            @include('top_bar')

            @if (!$notes)
                <!-- no notes available -->
                <div class="row mt-5">
                    <div class="col text-center">
                        <p class="display-6 mb-5 text-secondary opacity-50">You have no notes available!</p>
                        <form action={{ route('newNote') }} method="GET">
                            <button type="submit" class="btn btn-secondary btn-lg p-3 px-5">
                                <i class="fa-regular fa-pen-to-square me-3"></i>Create Your First Note
                            </button>
                        </form>

                    </div>
                </div>
            @else
                <!-- notes are available -->
                <div class="mx-2">
                    <div class="d-flex justify-content-end mb-3">
                        <a href={{ route('newNote') }} class="btn btn-secondary px-3">
                            <i class="fa-regular fa-pen-to-square me-2"></i>New Note
                        </a>
                    </div>

                    <div class="row">
                        @foreach ($notes as $note)
                            @include('note_card')
                        @endforeach
                    </div>
                </div>

        </div>
        @endif


    </div>
    </div>
@endsection

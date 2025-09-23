@extends("layouts.app")

    @section("content")
        @livewire('depenses', ['search' => $search])
    @endsection
   
@extends("layouts.app")

    @section("content")
        @livewire('depenses', ['user' => $user])
    @endsection
   
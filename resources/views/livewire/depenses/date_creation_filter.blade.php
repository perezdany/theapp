@extends("layouts.app")

    @section("content")
        @livewire('depenses', ['compare' => $compare, 'annee' => $annee])
    @endsection
   
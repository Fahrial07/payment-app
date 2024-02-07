@extends('layouts.app')

@section('title', $title)
@livewireStyles
@section('content')
    @livewire('withdrawal.withdrawal')
@endsection
@livewireStyles
@extends('layouts.app')

@section('title', $title)
@livewireStyles
@section('content')
    @livewire('deposit.deposit')
@endsection
@livewireStyles
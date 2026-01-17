@extends('layouts.appadmin')

@section('title', 'Dashboard')

@section('content')
<div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
        {{ __('Dashboard') }}
    </h2>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            {{ __("You're logged in!") }}
        </div>
    </div>
</div>
@endsection

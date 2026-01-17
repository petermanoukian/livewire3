@extends('layouts.appadmin')

@section('title', 'Create Cat')

@section('content')
<div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
        Add Category
    </h2>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">

             @livewire('admin.cats.create-component') 
        </div>
    </div>
</div>
@endsection

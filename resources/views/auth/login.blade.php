@extends('layouts.guest')

@section('title', 'Login')

@section('header')
    <h2 class="text-xl font-semibold mb-6 text-center">
        {{ __('Login') }}
    </h2>
@endsection

@section('content')
    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif

   <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="mb-6">
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
        <input id="email" type="email" name="email"
               value="{{ old('email') }}"
               required autofocus autocomplete="username"
               class="w-full h-12 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
        @error('email')
            <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
        <input id="password" type="password" name="password"
               required autocomplete="current-password"
               class="w-full h-12 px-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
        @error('password')
            <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="mb-6 flex items-center">
        <input id="remember_me" type="checkbox" name="remember"
               class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
        <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between">


        <button type="submit"
                class="h-12 px-6 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Log in
        </button>
    </div>
</form>

@endsection

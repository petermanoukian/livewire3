@extends('layouts.guest')

@section('title', 'Register')

@section('header', 'Create your account')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-[#1b1b18] shadow-sm focus:border-[#F53003] focus:ring focus:ring-[#F53003]/50">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-[#1b1b18] shadow-sm focus:border-[#F53003] focus:ring focus:ring-[#F53003]/50">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Password</label>
            <input id="password" type="password" name="password" required
                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-[#1b1b18] shadow-sm focus:border-[#F53003] focus:ring focus:ring-[#F53003]/50">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC]">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-[#1b1b18] shadow-sm focus:border-[#F53003] focus:ring focus:ring-[#F53003]/50">
        </div>

        <div class="flex items-center justify-between mt-8">
            <a href="{{ route('login') }}" class="text-sm text-[#F53003] hover:underline">
                Already have an account? Log in
            </a>

            <button type="submit" class="bg-[#F53003] hover:bg-[#d42a00] text-white font-semibold py-3 px-8 rounded-md transition transform hover:scale-105">
                Register
            </button>
        </div>
    </form>
@endsection
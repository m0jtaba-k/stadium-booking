@extends('layouts.app')

@section('title', 'Home')
@section('content')
<div class="text-center py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Welcome to StadiumBook</h1>
    <p class="text-xl text-gray-600 mb-8">Book your favorite football stadiums with ease</p>
    <a href="{{ route('stadiums.index') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors">
        Browse Stadiums
    </a>
</div>
@endsection
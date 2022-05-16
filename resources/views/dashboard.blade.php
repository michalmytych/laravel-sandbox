@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
                @foreach([
                    route('chat.index'),
                    route('cache.all'),
                ] as $link)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ $link }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Chats Module</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

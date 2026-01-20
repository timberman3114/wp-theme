@extends('layouts.default')

@section('content')
    <div class="error-404 text-center py-20">
        <div class="error-content max-w-2xl mx-auto">
            <h1 class="error-title text-9xl font-bold text-gray-200 mb-6">404</h1>
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-gray-900">{{ __('Page Not Found', 'dd-web') }}</h2>
            <p class="text-lg text-gray-600 mb-8">{{ __('Sorry, the page you are looking for does not exist.', 'dd-web') }}</p>
            
            <a href="{{ home_url() }}" class="btn btn-primary inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                {{ __('Go to Homepage', 'dd-web') }}
            </a>
            
            <div class="search-form mt-12">
                {{ get_search_form() }}
            </div>
        </div>
    </div>
@endsection

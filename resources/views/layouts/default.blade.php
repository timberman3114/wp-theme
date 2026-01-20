@include('partials.header')

<main class="site-main py-12 min-h-screen">
    <div class="container mx-auto px-4">
        @yield('content')
    </div>
</main>

@include('partials.footer')

<!DOCTYPE html>
<html {{ language_attributes() }}>
<head>
    <meta charset="{{ bloginfo('charset') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    @php wp_head(); @endphp
</head>
<body {{ body_class() }}>
    @php wp_body_open(); @endphp
    
    <header class="site-header bg-white shadow-md sticky top-0 z-50 transition-shadow duration-300">
        <div class="container mx-auto">
            <div class="header-content flex justify-between items-center py-4">
                <div class="site-branding">
                    @logo
                </div>
                
                <nav class="main-navigation hidden lg:block">
                    @menu(['theme_location' => 'primary', 'container' => false, 'menu_class' => 'primary-menu flex gap-8'])
                </nav>
                
                <button class="mobile-menu-toggle lg:hidden flex flex-col gap-1.5 p-2" aria-label="Toggle menu">
                    <span class="w-6 h-0.5 bg-gray-900 transition-all"></span>
                    <span class="w-6 h-0.5 bg-gray-900 transition-all"></span>
                    <span class="w-6 h-0.5 bg-gray-900 transition-all"></span>
                </button>
            </div>
        </div>
    </header>

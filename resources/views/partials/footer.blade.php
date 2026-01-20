    <footer class="site-footer bg-gray-50 pt-12 pb-6 mt-16">
        <div class="container mx-auto">
            <div class="footer-widgets grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                @if(is_active_sidebar('footer-1'))
                    <div class="footer-column">
                        @sidebar('footer-1')
                    </div>
                @endif
                
                @if(is_active_sidebar('footer-2'))
                    <div class="footer-column">
                        @sidebar('footer-2')
                    </div>
                @endif
                
                @if(is_active_sidebar('footer-3'))
                    <div class="footer-column">
                        @sidebar('footer-3')
                    </div>
                @endif
            </div>
            
            <div class="footer-bottom border-t border-gray-200 pt-8 text-center">
                <nav class="footer-navigation mb-4">
                    @menu(['theme_location' => 'footer', 'container' => false, 'menu_class' => 'footer-menu flex justify-center gap-6 flex-wrap'])
                </nav>
                
                <div class="copyright text-gray-600 text-sm">
                    <p>&copy; {{ date('Y') }} {{ bloginfo('name') }}. {{ __('All rights reserved.', 'dd-web') }}</p>
                </div>
            </div>
        </div>
    </footer>
    
    @php wp_footer(); @endphp
</body>
</html>

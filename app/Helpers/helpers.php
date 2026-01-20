<?php
/**
 * Helper Functions
 * 
 * @package DD_Web
 */

use DDWeb\Blade\BladeProvider;

if (!function_exists('blade')) {
    /**
     * Render a Blade view
     * 
     * @param string $view View name
     * @param array $data Data to pass to view
     * @return string
     */
    function blade($view, $data = []) {
        return BladeProvider::render($view, $data);
    }
}

if (!function_exists('view')) {
    /**
     * Alias for blade() function
     * 
     * @param string $view View name
     * @param array $data Data to pass to view
     * @return string
     */
    function view($view, $data = []) {
        return blade($view, $data);
    }
}

if (!function_exists('dd_asset')) {
    /**
     * Get asset URL from theme directory
     * 
     * @param string $path Path to asset
     * @return string
     */
    function dd_asset($path) {
        return get_template_directory_uri() . '/assets/' . ltrim($path, '/');
    }
}

if (!function_exists('dd_image')) {
    /**
     * Get image URL from theme directory
     * 
     * @param string $path Path to image
     * @return string
     */
    function dd_image($path) {
        return get_template_directory_uri() . '/assets/images/' . ltrim($path, '/');
    }
}

if (!function_exists('get_acf')) {
    /**
     * Get ACF field with fallback
     * 
     * @param string $field Field name
     * @param mixed $post_id Post ID or 'option'
     * @param mixed $default Default value
     * @return mixed
     */
    function get_acf($field, $post_id = null, $default = '') {
        if (!function_exists('get_field')) {
            return $default;
        }
        
        $value = get_field($field, $post_id);
        return $value !== false && $value !== null ? $value : $default;
    }
}

if (!function_exists('the_acf')) {
    /**
     * Echo ACF field with fallback
     * 
     * @param string $field Field name
     * @param mixed $post_id Post ID or 'option'
     * @param mixed $default Default value
     */
    function the_acf($field, $post_id = null, $default = '') {
        echo get_acf($field, $post_id, $default);
    }
}

if (!function_exists('dd_menu')) {
    /**
     * Get WordPress menu with default arguments
     * 
     * @param string $location Menu location
     * @param array $args Additional arguments
     * @return void
     */
    function dd_menu($location, $args = []) {
        $defaults = [
            'theme_location' => $location,
            'container'      => 'nav',
            'container_class' => 'menu-' . $location,
            'menu_class'     => 'menu',
            'fallback_cb'    => false,
            'echo'           => true,
        ];
        
        wp_nav_menu(array_merge($defaults, $args));
    }
}

if (!function_exists('dd_logo')) {
    /**
     * Display site logo or site name
     * 
     * @param array $args Arguments for custom logo
     * @return void
     */
    function dd_logo($args = []) {
        if (has_custom_logo()) {
            the_custom_logo();
        } else {
            echo '<a href="' . esc_url(home_url('/')) . '" class="site-name">' . get_bloginfo('name') . '</a>';
        }
    }
}

if (!function_exists('dd_breadcrumbs')) {
    /**
     * Display breadcrumbs navigation
     * 
     * @return void
     */
    function dd_breadcrumbs() {
        if (is_front_page()) {
            return;
        }
        
        echo '<nav class="breadcrumbs">';
        echo '<a href="' . home_url() . '">Home</a>';
        
        if (is_category() || is_single()) {
            echo ' / ';
            the_category(' / ');
            if (is_single()) {
                echo ' / ' . get_the_title();
            }
        } elseif (is_page()) {
            echo ' / ' . get_the_title();
        }
        
        echo '</nav>';
    }
}

if (!function_exists('dd_nbsp')) {
    /**
     * Replace spaces after orphan words (single letters and small prepositions)
     * Prevents "orphans" - small words at the end of lines
     * 
     * @param string $text Text to process
     * @return string Text with &nbsp; after orphan words
     * 
     * @example
     * dd_nbsp('Cześć z Polski');     // Cześć z&nbsp;Polski
     * dd_nbsp('Poszedł do domu');    // Poszedł do&nbsp;domu
     * dd_nbsp('Hello and goodbye');  // Hello and&nbsp;goodbye
     */
    function dd_nbsp($text) {
        if (empty($text)) {
            return $text;
        }
        
        // Polish orphan words (przedimki, przyimki, spójniki, zaimki)
        $polish_orphans = [
            'a', 'i', 'o', 'u', 'w', 'z', 'na', 'do', 'od', 'po', 'by', 'je',
            'to', 'nie', 'tak', 'już', 'też', 'lub', 'czy', 'ile', 'ani', 'czy',
            'godz', 'str', 'nr', 'pkt', 'tel', 'www'
        ];
        
        // English orphan words (articles, prepositions, conjunctions)
        $english_orphans = [
            'a', 'an', 'and', 'as', 'at', 'be', 'by', 'for', 'from', 'in',
            'is', 'it', 'of', 'on', 'or', 'so', 'to', 'up', 'we'
        ];
        
        // Combine all orphan words
        $all_orphans = array_merge($polish_orphans, $english_orphans);
        $orphans_pattern = implode('|', $all_orphans);
        
        // Replace space after orphan words with &nbsp;
        // Pattern matches: orphan word + space + next word
        $pattern = '/\b(' . $orphans_pattern . ')\s+/i';
        $replacement = '$1&nbsp;';
        
        return preg_replace($pattern, $replacement, $text);
    }
}

if (!function_exists('dd_nbsp_all')) {
    /**
     * Replace all spaces with &nbsp;
     * 
     * @param string $text Text to process
     * @return string Text with all spaces replaced with &nbsp;
     * 
     * @example
     * dd_nbsp_all('Hello World Test'); // Hello&nbsp;World&nbsp;Test
     */
    function dd_nbsp_all($text) {
        return str_replace(' ', '&nbsp;', $text);
    }
}

if (!function_exists('dd_nbsp_dash')) {
    /**
     * Replace spaces around dashes with &nbsp;
     * Keeps dashes from breaking to next line
     * 
     * @param string $text Text to process
     * @return string Text with dashes protected
     * 
     * @example
     * dd_nbsp_dash('Price - $50'); // Price&nbsp;-&nbsp;$50
     */
    function dd_nbsp_dash($text) {
        return preg_replace('/\s+-\s+/', '&nbsp;-&nbsp;', $text);
    }
}

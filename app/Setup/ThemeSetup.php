<?php
/**
 * Theme Setup Configuration
 * 
 * @package DD_Web
 */

namespace DDWeb\Setup;

class ThemeSetup {
    
    /**
     * Initialize theme setup
     */
    public static function init() {
        // Add theme support
        self::addThemeSupport();
        
        // Register menus
        self::registerMenus();
        
        // Register sidebars
        self::registerSidebars();
        
        // Disable WordPress editor
        self::disableEditor();
        
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueueAssets']);
        
        // ACF options page (if ACF is active)
        if (function_exists('acf_add_options_page')) {
            self::registerACFOptions();
        }
    }
    
    /**
     * Add theme support features
     */
    private static function addThemeSupport() {
        // Enable title tag support
        add_theme_support('title-tag');
        
        // Enable post thumbnails
        add_theme_support('post-thumbnails');
        
        // Enable custom logo
        add_theme_support('custom-logo', [
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
        ]);
        
        // Enable HTML5 support
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style'
        ]);
        
        // Enable custom header
        add_theme_support('custom-header');
        
        // Enable custom background
        add_theme_support('custom-background');
        
        // Enable automatic feed links
        add_theme_support('automatic-feed-links');
        
        // Enable responsive embeds
        add_theme_support('responsive-embeds');
        
        // Enable editor styles
        add_theme_support('editor-styles');
        
        // Enable wide alignment
        add_theme_support('align-wide');
    }
    
    /**
     * Register navigation menus
     */
    private static function registerMenus() {
        register_nav_menus([
            'primary'   => __('Primary Menu', 'dd-web'),
            'footer'    => __('Footer Menu', 'dd-web'),
            'mobile'    => __('Mobile Menu', 'dd-web'),
        ]);
    }
    
    /**
     * Register widget areas
     */
    private static function registerSidebars() {
        register_sidebar([
            'name'          => __('Primary Sidebar', 'dd-web'),
            'id'            => 'sidebar-1',
            'description'   => __('Main sidebar that appears on the right.', 'dd-web'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ]);
        
        register_sidebar([
            'name'          => __('Footer Area 1', 'dd-web'),
            'id'            => 'footer-1',
            'description'   => __('First footer widget area.', 'dd-web'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ]);
        
        register_sidebar([
            'name'          => __('Footer Area 2', 'dd-web'),
            'id'            => 'footer-2',
            'description'   => __('Second footer widget area.', 'dd-web'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ]);
        
        register_sidebar([
            'name'          => __('Footer Area 3', 'dd-web'),
            'id'            => 'footer-3',
            'description'   => __('Third footer widget area.', 'dd-web'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ]);
    }
    
    /**
     * Enqueue scripts and styles
     */
    public static function enqueueAssets() {
        $theme_version = wp_get_theme()->get('Version');
        
        // Check if we're in development mode (manifest doesn't exist)
        $manifest_path = get_template_directory() . '/dist/manifest.json';
        $is_dev = !file_exists($manifest_path);
        
        if ($is_dev) {
            // Development mode - load from Vite dev server
            wp_enqueue_script(
                'vite-client',
                'http://localhost:5173/@vite/client',
                [],
                null,
                false
            );
            wp_script_add_data('vite-client', 'type', 'module');
            
            wp_enqueue_script(
                'dd-web-script',
                'http://localhost:5173/assets/ts/main.ts',
                [],
                null,
                true
            );
            wp_script_add_data('dd-web-script', 'type', 'module');
            
            wp_enqueue_style(
                'dd-web-style',
                'http://localhost:5173/assets/css/main.css',
                [],
                null
            );
        } else {
            // Production mode - load compiled assets
            $manifest = json_decode(file_get_contents($manifest_path), true);
            
            // Enqueue compiled CSS
            if (isset($manifest['assets/css/main.css'])) {
                wp_enqueue_style(
                    'dd-web-style',
                    get_template_directory_uri() . '/dist/' . $manifest['assets/css/main.css']['file'],
                    [],
                    $theme_version
                );
            }
            
            // Enqueue compiled JavaScript
            if (isset($manifest['assets/ts/main.ts'])) {
                wp_enqueue_script(
                    'dd-web-script',
                    get_template_directory_uri() . '/dist/' . $manifest['assets/ts/main.ts']['file'],
                    ['jquery'],
                    $theme_version,
                    true
                );
            }
        }
        
        // Enqueue jQuery
        wp_enqueue_script('jquery');
        
        // Localize script with WordPress data
        wp_localize_script('dd-web-script', 'ddWebData', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('dd-web-nonce'),
            'siteUrl' => get_site_url(),
        ]);
    }
    
    /**
     * Register ACF Options pages
     */
    private static function registerACFOptions() {
        acf_add_options_page([
            'page_title'    => __('Theme General Settings', 'dd-web'),
            'menu_title'    => __('Theme Settings', 'dd-web'),
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ]);
        
        acf_add_options_sub_page([
            'page_title'    => __('Header Settings', 'dd-web'),
            'menu_title'    => __('Header', 'dd-web'),
            'parent_slug'   => 'theme-general-settings',
        ]);
        
        acf_add_options_sub_page([
            'page_title'    => __('Footer Settings', 'dd-web'),
            'menu_title'    => __('Footer', 'dd-web'),
            'parent_slug'   => 'theme-general-settings',
        ]);
    }
    
    /**
     * Disable WordPress editor for pages and posts
     */
    private static function disableEditor() {
        // Disable Gutenberg editor for all post types
        add_filter('use_block_editor_for_post_type', '__return_false', 100);
        
        // Disable Gutenberg editor completely
        add_filter('use_block_editor_for_post', '__return_false', 100);
        
        // Remove Gutenberg CSS
        add_action('wp_enqueue_scripts', function() {
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wp-block-library-theme');
            wp_dequeue_style('wc-blocks-style');
            wp_dequeue_style('global-styles');
        }, 100);
        
        // Remove classic editor for pages (use ACF instead)
        add_action('init', function() {
            remove_post_type_support('page', 'editor');
            remove_post_type_support('post', 'editor');
        });
        
        // Optional: Hide the content editor metabox
        add_action('admin_head', function() {
            echo '<style>
                #postdivrich { display: none; }
                .block-editor-page { display: none; }
            </style>';
        });
    }
}

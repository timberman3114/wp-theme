<?php
/**
 * Blade Template Provider
 * 
 * @package DD_Web
 */

namespace DDWeb\Blade;

use Jenssegers\Blade\Blade;

class BladeProvider {
    
    private static $blade;
    
    /**
     * Initialize Blade engine
     */
    public static function init() {
        $viewsPath = get_template_directory() . '/resources/views';
        $cachePath = get_template_directory() . '/cache';
        
        // Create directories if they don't exist
        if (!file_exists($viewsPath)) {
            mkdir($viewsPath, 0755, true);
        }
        
        if (!file_exists($cachePath)) {
            mkdir($cachePath, 0755, true);
        }
        
        self::$blade = new Blade($viewsPath, $cachePath);
        
        // Register custom directives
        self::registerDirectives();
    }
    
    /**
     * Get Blade instance
     */
    public static function getBlade() {
        if (!self::$blade) {
            self::init();
        }
        return self::$blade;
    }
    
    /**
     * Render a Blade view
     * 
     * @param string $view View name (without .blade.php)
     * @param array $data Data to pass to view
     * @return string Rendered HTML
     */
    public static function render($view, $data = []) {
        return self::getBlade()->make($view, $data)->render();
    }
    
    /**
     * Register custom Blade directives
     */
    private static function registerDirectives() {
        $blade = self::getBlade();
        
        // @acf directive for ACF fields
        $blade->directive('acf', function($expression) {
            return "<?php echo get_field({$expression}); ?>";
        });
        
        // @acfoption directive for ACF option fields
        $blade->directive('acfoption', function($expression) {
            return "<?php echo get_field({$expression}, 'option'); ?>";
        });
        
        // @menu directive for WordPress menus
        $blade->directive('menu', function($expression) {
            return "<?php wp_nav_menu({$expression}); ?>";
        });
        
        // @logo directive for site logo
        $blade->directive('logo', function() {
            return "<?php if (has_custom_logo()) { the_custom_logo(); } else { echo get_bloginfo('name'); } ?>";
        });
        
        // @sidebar directive for WordPress sidebars
        $blade->directive('sidebar', function($expression) {
            return "<?php if (is_active_sidebar({$expression})) { dynamic_sidebar({$expression}); } ?>";
        });
        
        // @nbsp directive for adding non-breaking spaces before orphan words
        $blade->directive('nbsp', function($expression) {
            return "<?php echo dd_nbsp({$expression}); ?>";
        });
        
        // @nbspall directive for replacing all spaces with &nbsp;
        $blade->directive('nbspall', function($expression) {
            return "<?php echo dd_nbsp_all({$expression}); ?>";
        });
        
        // @nbspdash directive for protecting dashes
        $blade->directive('nbspdash', function($expression) {
            return "<?php echo dd_nbsp_dash({$expression}); ?>";
        });
    }
}

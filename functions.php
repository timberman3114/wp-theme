<?php
/**
 * DD Web Theme Functions
 * 
 * @package DD_Web
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Load Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Load theme configuration and helpers
require_once __DIR__ . '/app/Setup/ThemeSetup.php';
require_once __DIR__ . '/app/Blade/BladeProvider.php';
require_once __DIR__ . '/app/Helpers/helpers.php';
require_once __DIR__ . '/app/ACF/FieldGroups.php';

// Initialize theme
add_action('after_setup_theme', function() {
    DDWeb\Setup\ThemeSetup::init();
});

// Initialize Blade
add_action('init', function() {
    DDWeb\Blade\BladeProvider::init();
});

// Register ACF Field Groups
add_action('acf/init', function() {
    DDWeb\ACF\FieldGroups::register();
});

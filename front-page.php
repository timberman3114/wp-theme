<?php
/**
 * Front Page Template (Strona główna)
 * 
 * @package DD_Web
 */

// Pobierz slug strony
$page_slug = get_post_field('post_name', get_the_ID());

// Ścieżka do pliku Blade bazowana na slug
$blade_file = "pages.{$page_slug}";
$blade_path = get_template_directory() . "/resources/views/pages/{$page_slug}.blade.php";

if (file_exists($blade_path)) {
    // Jeśli istnieje plik dla tego slug, użyj go
    echo blade($blade_file);
} else {
    // W przeciwnym razie użyj domyślnego page template
    echo blade('page');
}

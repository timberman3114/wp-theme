<?php
/**
 * ACF Field Groups Registration
 * 
 * @package DD_Web
 */

namespace DDWeb\ACF;

class FieldGroups {
    
    /**
     * Register ACF field groups
     */
    public static function register() {
        // Dodaj tutaj swoje field groups
        // self::registerYourFieldGroup();
    }
    
    /**
     * Register Homepage fields
     * 
     * Uncomment to use this field group
     */
    /*
    private static function registerHomePage() {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }
        
        acf_add_local_field_group([
            'key' => 'group_strona_glowna',
            'title' => 'Strona główna',
            'fields' => [
                [
                    'key' => 'field_naglowek',
                    'label' => 'Nagłówek',
                    'name' => 'naglowek',
                    'type' => 'text',
                    'instructions' => 'Główny nagłówek strony',
                    'required' => 0,
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                ],
                [
                    'key' => 'field_tresc',
                    'label' => 'Treść',
                    'name' => 'tresc',
                    'type' => 'wysiwyg',
                    'instructions' => 'Główna treść strony głównej',
                    'required' => 0,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ],
                [
                    'key' => 'field_link_lewo',
                    'label' => 'Link lewo',
                    'name' => 'link_lewo',
                    'type' => 'url',
                    'instructions' => 'URL linku po lewej stronie',
                    'required' => 0,
                    'placeholder' => 'https://',
                ],
                [
                    'key' => 'field_link_prawo',
                    'label' => 'Link prawo',
                    'name' => 'link_prawo',
                    'type' => 'url',
                    'instructions' => 'URL linku po prawej stronie',
                    'required' => 0,
                    'placeholder' => 'https://',
                ],
                [
                    'key' => 'field_zdjecie',
                    'label' => 'Zdjęcie',
                    'name' => 'zdjecie',
                    'type' => 'image',
                    'instructions' => 'Główne zdjęcie na stronie',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '',
                    'mime_types' => '',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => ['the_content'],
            'active' => true,
            'description' => 'Pola dla strony głównej',
        ]);
    }
    */
}

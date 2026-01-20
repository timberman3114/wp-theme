# DD Web Theme - ACF Configuration

This theme is built to work seamlessly with Advanced Custom Fields (ACF) free version.

## Installing ACF

1. Go to WordPress Admin > Plugins > Add New
2. Search for "Advanced Custom Fields"
3. Install and activate the free version

## Using ACF in Blade Templates

The theme includes custom Blade directives for working with ACF:

### @acf - Get ACF field
```blade
@acf('field_name')
@acf('field_name', $post_id)
```

### @acfoption - Get ACF option field
```blade
@acfoption('field_name')
```

### Helper Functions
```php
// Get ACF field with fallback
get_acf('field_name', $post_id, 'default value')

// Echo ACF field
the_acf('field_name', $post_id, 'default value')
```

## Recommended Field Groups

### Theme Options (Options Page)
Create a field group for theme-wide settings:
- Header settings (logo, contact info)
- Footer settings (copyright, social links)
- Global settings (colors, typography)

### Page Builder
Create flexible content fields for page building:
- Hero sections
- Content blocks
- Call-to-action sections
- Gallery sections

## Example Usage

### In Blade Templates
```blade
{{-- Display hero section from ACF --}}
@if(get_acf('show_hero'))
    <section class="hero">
        <h1>@acf('hero_title')</h1>
        <p>@acf('hero_description')</p>
    </section>
@endif

{{-- Display from theme options --}}
<div class="contact-info">
    Phone: @acfoption('contact_phone')
    Email: @acfoption('contact_email')
</div>
```

### Flexible Content Example
```blade
@if(have_rows('content_sections'))
    @while(have_rows('content_sections'))
        @php the_row() @endphp
        
        @if(get_row_layout() == 'text_section')
            <section class="text-section">
                <h2>@acf('title')</h2>
                <div>@acf('content')</div>
            </section>
        @endif
        
        @if(get_row_layout() == 'image_section')
            <section class="image-section">
                <img src="@acf('image')" alt="">
            </section>
        @endif
    @endwhile
@endif
```

## Theme Settings Pages

After activating ACF, you'll see new menu items in WordPress Admin:
- Theme Settings > General
- Theme Settings > Header
- Theme Settings > Footer

Create field groups assigned to these options pages for theme-wide configuration.

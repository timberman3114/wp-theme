@extends('layouts.default')

@section('content')
    @if(have_posts())
        @while(have_posts())
            @php the_post() @endphp
            
            <article id="post-{{ get_the_ID() }}" {{ post_class() }}>
                @if(has_post_thumbnail())
                    <div class="post-thumbnail">
                        {{ the_post_thumbnail('large') }}
                    </div>
                @endif
                
                <header class="entry-header">
                    <h1 class="entry-title">{{ get_the_title() }}</h1>
                    
                    <div class="entry-meta">
                        <span class="posted-on">{{ get_the_date() }}</span>
                        <span class="byline">{{ __('by', 'dd-web') }} {{ get_the_author() }}</span>
                        <span class="categories">{{ __('Posted in', 'dd-web') }} {{ the_category(', ') }}</span>
                    </div>
                </header>
                
                <div class="entry-content">
                    {{ the_content() }}
                    
                    {{ wp_link_pages([
                        'before' => '<div class="page-links">' . __('Pages:', 'dd-web'),
                        'after'  => '</div>',
                    ]) }}
                </div>
                
                <footer class="entry-footer">
                    {{ the_tags('<div class="tags-links">' . __('Tags:', 'dd-web') . ' ', ', ', '</div>') }}
                </footer>
            </article>
            
            @if(comments_open() || get_comments_number())
                <div class="comments-section">
                    {{ comments_template() }}
                </div>
            @endif
        @endwhile
    @endif
@endsection

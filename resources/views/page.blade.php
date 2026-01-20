@extends('layouts.default')

@section('content')
    @if(have_posts())
        @while(have_posts())
            @php the_post() @endphp
            
            <article id="post-{{ get_the_ID() }}" {{ post_class('max-w-4xl mx-auto') }}>
                @if(has_post_thumbnail())
                    <div class="page-thumbnail mb-8 rounded-xl overflow-hidden">
                        {{ the_post_thumbnail('full', ['class' => 'w-full h-auto']) }}
                    </div>
                @endif
                
                <header class="entry-header mb-8">
                    <h1 class="entry-title text-4xl md:text-5xl font-bold text-gray-900">{{ get_the_title() }}</h1>
                </header>
                
                <div class="entry-content prose prose-lg max-w-none">
                    {{ the_content() }}
                    
                    {{ wp_link_pages([
                        'before' => '<div class="page-links flex gap-2 mt-8">' . __('Pages:', 'dd-web'),
                        'after'  => '</div>',
                    ]) }}
                </div>
            </article>
        @endwhile
    @endif
@endsection

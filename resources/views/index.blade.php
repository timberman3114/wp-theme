@extends('layouts.default')

@section('content')
    @if(have_posts())
        <div class="posts-list space-y-12">
            @while(have_posts())
                @php the_post() @endphp
                
                <article id="post-{{ get_the_ID() }}" {{ post_class('bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300') }}>
                    @if(has_post_thumbnail())
                        <div class="post-thumbnail overflow-hidden">
                            <a href="{{ get_permalink() }}" class="block">
                                {{ the_post_thumbnail('large', ['class' => 'w-full h-auto object-cover transition-transform duration-300 hover:scale-105']) }}
                            </a>
                        </div>
                    @endif
                    
                    <div class="p-8">
                        <header class="entry-header mb-6">
                            <h2 class="entry-title text-3xl font-bold mb-3">
                                <a href="{{ get_permalink() }}" class="text-gray-900 hover:text-primary-600 transition-colors">
                                    {{ get_the_title() }}
                                </a>
                            </h2>
                            
                            <div class="entry-meta text-sm text-gray-600 flex flex-wrap gap-4">
                                <span class="posted-on">{{ get_the_date() }}</span>
                                <span class="byline">{{ __('by', 'dd-web') }} {{ get_the_author() }}</span>
                            </div>
                        </header>
                        
                        <div class="entry-content text-gray-700 leading-relaxed mb-6">
                            {{ the_excerpt() }}
                        </div>
                        
                        <footer class="entry-footer">
                            <a href="{{ get_permalink() }}" class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                {{ __('Read More', 'dd-web') }}
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </footer>
                    </div>
                </article>
            @endwhile
            
            <div class="pagination mt-12">
                {{ the_posts_pagination(['class' => 'flex justify-center gap-2']) }}
            </div>
        </div>
    @else
        <div class="no-posts text-center py-16">
            <h2 class="text-3xl font-bold mb-4 text-gray-900">{{ __('Nothing Found', 'dd-web') }}</h2>
            <p class="text-gray-600">{{ __('It seems we can\'t find what you\'re looking for.', 'dd-web') }}</p>
        </div>
    @endif
@endsection

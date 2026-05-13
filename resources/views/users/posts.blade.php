@extends('layouts.app')

@section('content')
<main class="bg-[#0d0f14] min-h-screen text-[#e2e2e9] font-[Inter,sans-serif]">
    <div class="flex max-w-[1440px] mx-auto pt-16 min-h-screen">
        
       
        <div class="flex-1 overflow-y-auto">
            
            
            <div class="relative">

                <div class="px-8 -mt-16 relative z-10">
                    <div class="flex gap-8 mt-8 py-6 border-y border-[#1e2330]">
                        <div class="flex items-baseline gap-1.5">
                            <span class="text-xl font-bold text-slate-50">{{ $posts->count() }}</span>
                            <span class="text-xs font-bold tracking-widest text-slate-500 uppercase">Stories</span>
                        </div>
                      
                    </div>
                </div>
            </div>
            
            
            <div class="px-8 mt-4 sticky top-16 bg-[#0d0f14]/80 backdrop-blur-md z-20">
                <div class="flex gap-10 border-b border-[#1e2330]">
                    <button class="py-4 text-primary font-bold border-b-2 border-primary text-sm tracking-wide active-tab" data-tab="posts">
                        My Posts
                    </button>
                   
                </div>
            </div>
            
            <div id="posts-tab" class="p-8">
                @if($posts->isEmpty())
                    <div class="text-center py-20">
                        <h3 class="text-2xl font-bold text-slate-300 mb-2">No posts yet</h3>
                        <p class="text-slate-500 mb-6">Start your writing journey today!</p>
                        <a href="{{ route('posts.create') }}" 
                           class="inline-block px-6 py-3 bg-primary text-white font-bold rounded-xl hover:brightness-110 transition-all">
                            Create Your First Post
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($posts as $post)
                            <article class="group bg-[#161b22] rounded-2xl overflow-hidden border border-white/5 hover:border-primary/30 transition-all duration-300 hover:transform hover:-translate-y-1">
                                
                                <!-- Post Image -->
                                @if($post->image)
                                    <div class="h-48 overflow-hidden">
                                        <img src="{{ asset('storage/' . $post->image) }}" 
                                             alt="{{ $post->title }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </div>
                                @else
                                    <div class="h-48 bg-linear-to-br from-primary/20 to-purple-500/20 flex items-center justify-center">
                                        <i class="fa-regular fa-image text-4xl text-slate-500"></i>
                                    </div>
                                @endif

                                

                                <!-- Post Content -->
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center gap-2 text-xs text-slate-500">
                                            <i class="fa-regular fa-calendar"></i>
                                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('posts.edit', $post->id) }}" 
                                                class="text-slate-500 hover:text-primary transition-colors">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-500 hover:text-red-500 transition-colors">
                                                <i class="fa-regular fa-trash-alt"></i>
                                            </button>
                                        </form>
                                        </div>
                                    </div>

                                    <h2 class="text-xl font-bold text-slate-50 mb-3 line-clamp-2 group-hover:text-primary transition-colors">
                                        {{ $post->title }}
                                    </h2>

                                    <p class="text-slate-400 text-sm line-clamp-3 mb-4">
                                        {{ Str::limit(strip_tags($post->description), 150) }}
                                    </p>

                                   
                                </div>
                            </article>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    {{-- <div class="mt-12">
                        {{ $posts->links() }}
                    </div> --}}
                @endif
            </div>
            
          
           
        </div>
    </div>
</main>



@endsection
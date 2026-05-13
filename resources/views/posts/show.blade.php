@extends('layouts.app')

@section('content')
{{-- REMOVED "hidden" --}}
<main id="single_post" class="bg-[#0d0f14] min-h-screen text-[#e2e2e9] font-[Inter,sans-serif]">
     <div class="max-w-[1536px] mx-auto pt-32 pb-24 px-6 lg:px-12">
        <div class="flex flex-col lg:flex-row gap-16">

            <article class="w-full lg:flex-1">
                <nav class="flex items-center gap-2 mb-6 text-sm text-slate-400">
                    <a href="/posts" class="hover:text-white">Home</a>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    <span class="text-indigo-400 font-semibold">Post</span>
                </nav>

                {{-- Use {{ }} to show dynamic data --}}
                <h1 class="text-4xl md:text-6xl font-black text-white leading-tight mb-4">
                    {{ $post->title }}
                </h1>

                <div class="flex items-center gap-3 mb-8 text-slate-400 text-sm">
                    <span class="font-semibold text-slate-200">{{ $post->user->name }}</span>
                    <span>·</span>
                    <span id="single-post-username">@ {{ $post->user->name }}</span>
                    <span>·</span>
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                </div>

                <div class="aspect-video rounded-2xl overflow-hidden mb-12 border border-white/5">
                    {{-- If you have an image column in your DB --}}
                    <img src="{{ asset('storage/' . ($post->image ?? 'https://via.placeholder.com/1200x800')) }}" class="w-full h-full object-cover">
                </div>

                <div class="text-lg leading-relaxed text-slate-300 space-y-6">
                    {{ $post->description }}
                </div>
            </article>

            <aside class="w-full lg:w-80 space-y-12">
                <div class="p-8 bg-white/5 rounded-2xl border border-white/5">
                    <h4 class="text-xs font-bold tracking-widest text-slate-500 uppercase mb-6">In this article</h4>
                    <ul class="space-y-4 text-sm">
                        <li class="text-indigo-400 font-bold">{{ $post->title }}</li>
                        {{-- You can add more dynamic links here later --}}
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</main>

@endsection
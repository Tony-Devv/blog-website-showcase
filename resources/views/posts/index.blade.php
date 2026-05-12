@extends('layouts.app')

@section('content')

<main class="main-container bg-[#0d0f14] min-h-screen text-white pt-10 px-6">

    <div class="feed-layout flex max-w-7xl mx-auto gap-8">

        <!-- POSTS SECTION -->

        <div class="flex-1 flex flex-col gap-8 pb-12">

            <!-- CREATE POST CARD -->

            <div class="bg-[#13161d] rounded-2xl p-6 border border-white/5 shadow-xl">

                <div class="flex gap-4">

                    <img class="w-12 h-12 rounded-full" src="https://i.pravatar.cc/100" alt="Profile">

                    <div class="flex-1">

                        <textarea
                            class="w-full bg-transparent border-none focus:ring-0 text-white text-lg resize-none placeholder:text-slate-500 min-h-[60px]"
                            placeholder="What's on your mind?" rows="2" readonly></textarea>

                        <div class="flex justify-between items-center mt-4 pt-4 border-t border-white/10">

                            <div class="flex pl-1 md:pl-5 gap-4 md:gap-8">

                                <span class="text-slate-500 text-xl">
                                    <i class="fa-regular fa-image"></i>
                                </span>

                                <span class="text-slate-500 text-xl">
                                    <i class="fa-solid fa-list"></i>
                                </span>

                                <span class="text-slate-500 text-xl">
                                    <i class="fa-solid fa-pen-clip"></i>
                                </span>

                            </div>

                            <a href="{{ route('posts.create') }}"
                                class="bg-blue-500 hover:bg-blue-600 transition px-5 py-2 rounded-full font-bold text-sm">

                                Publish

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <!-- TABS -->

            <div class="flex gap-8 border-b border-white/10 pb-4">

                <button class="text-blue-400 font-bold border-b-2 border-blue-400 pb-2">
                    For You
                </button>

                <button class="text-slate-400 hover:text-white transition">
                    Following
                </button>

                <button class="text-slate-400 hover:text-white transition">
                    Trending
                </button>

            </div>
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-600 text-white rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <!-- POSTS -->

            <div class="flex flex-col gap-6">

                @forelse($posts as $post)

                <article
                    class="group bg-[#13161d] rounded-2xl border border-white/5 overflow-hidden hover:border-blue-500/30 transition-all duration-300">

                    <!-- IMAGE -->

                    @if($post->image)

                    <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-64 object-cover" alt="Post Image">

                    @endif

                    <!-- CONTENT -->

                    <div class="p-8">

                        <!-- USER -->

                        <div class="flex items-center justify-between mb-6">

                            <div class="flex items-center gap-3">

                                <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/100" alt="User">

                                <div>

                                    <p class="text-sm font-bold text-white">
                                        {{ $post->user->name }}
                                    </p>

                                    <p class="text-[10px] text-slate-400 uppercase tracking-wider">

                                        {{ $post->created_at->format('d M Y') }}

                                    </p>

                                </div>

                            </div>

                            @auth

                            @if(auth()->id() === $post->user_id)

                            <div class="flex gap-3">

                                <a href="{{ route('posts.edit', $post->id) }}"
                                    class="text-sm text-yellow-400 hover:text-yellow-300">
                                    Edit
                                </a>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    onsubmit="return confirmDelete(event)">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-sm text-red-400 hover:text-red-300">
                                        Delete
                                    </button>

                                </form>

                            </div>

                            @endif

                            @endauth

                        </div>

                        <!-- TITLE -->

                        <h2 class="text-3xl font-bold text-white mb-4">

                            <a href="{{ route('posts.show', $post->id) }}" class="hover:text-blue-400 transition">

                                {{ $post->title }}

                            </a>

                        </h2>

                        <!-- DESCRIPTION -->

                        <p class="text-slate-300 leading-8">

                            {{ $post->description }}

                        </p>

                    </div>

                </article>

                @empty

                <div class="bg-[#13161d] rounded-2xl p-10 text-center border border-white/5">

                    <p class="text-slate-400 text-lg">
                        No posts yet.
                    </p>

                </div>

                @endforelse

            </div>

        </div>

        <!-- SIDEBAR -->

        <aside
            class="hidden lg:flex flex-col gap-10 sticky w-64 right-0 top-[88px] h-[calc(100vh-88px)] pb-8 border-l border-white/10 pl-6">

            <!-- SEARCH -->

            <div class="relative">

                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-xl">

                    <i class="fa-solid fa-magnifying-glass"></i>

                </span>

                <input
                    class="w-full bg-[#13161d] border border-white/5 rounded-full py-3 pl-12 pr-4 text-sm text-white placeholder:text-slate-500 focus:outline-none"
                    placeholder="Search InkWell..." type="text" />

            </div>

            <!-- TRENDING -->

            <div class="flex flex-col gap-6">

                <div class="flex items-center justify-between">

                    <h4 class="text-xs font-bold uppercase tracking-widest text-slate-500">

                        Trending Now

                    </h4>

                    <span class="text-lg text-slate-500">

                        <i class="fa-solid fa-arrow-trend-up"></i>

                    </span>

                </div>

                <div class="flex flex-col gap-5">

                    <div
                        class="bg-[#13161d] p-5 rounded-2xl border border-white/5 hover:border-blue-500/20 transition group cursor-pointer">

                        <p class="text-[10px] text-slate-500 uppercase tracking-wider mb-1">

                            Philosophy • Trending

                        </p>

                        <p class="font-bold text-white group-hover:text-blue-400 transition-colors">

                            The Ethics of AI Sentience

                        </p>

                        <p class="text-xs text-slate-400 mt-1">

                            42.5k stories

                        </p>

                    </div>

                </div>

            </div>

        </aside>

    </div>

</main>
<script>
function confirmDelete(e) {
    e.preventDefault();

    if (confirm("Are you sure you want to delete this post?")) {
        e.target.submit();
    }

    return false;
}
</script>

@endsection
@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/news.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<main id="explore" class="page text-on-surface [background-image:radial-gradient(rgba(255,255,255,0.04)_1px,transparent_1px)] [background-size:24px_24px] min-h-screen bg-[#0d0f14] font-[Inter,sans-serif]">

    <div class="pt-24 pb-12 px-24 mx-auto">

        <!-- HEADER -->
        <div class="flex flex-col items-center mb-16">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter mb-8 text-center">
                Explore <span class="text-tertiary">New Horizons</span>
            </h1>

            <div class="relative w-full max-w-[560px]">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                    <i class="fa-solid fa-magnifying-glass text-xl"></i>
                </span>

                <input id="query"
                    class="text-black w-full bg-surface-container-lowest border-none h-14 pl-12 pr-16 rounded-xl text-on-surface focus:ring-0 focus:border-b-2 focus:border-blue-500 transition-all text-lg shadow-2xl"
                    placeholder="Search for writers, topics, or stories..." type="text" />

                <button onclick="searchNews()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 px-4 py-2 bg-blue-500 text-on-blue-500 rounded-full text-sm font-bold hover:bg-blue-500/90 transition-colors">
                    Search
                </button>
            </div>

            <!-- FILTERS -->
            <div class="flex flex-row gap-4 mt-6 justify-center">

                <label class="mr-2 font-bold text-sm background-gradient-to-r from-primary to-secondary bg-clip-text">From:</label>
                <div class="relative w-full">
                    <input oninput="searchNews()" class="text-black bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20 transition-all w-full cursor-pointer"
                        type="date"
                        id="fromDate">
                    <i class="fas fa-calendar-alt absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                </div>

                <label class="mr-2 font-bold text-sm background-gradient-to-r from-primary to-secondary bg-clip-text">To:</label>

                <div class="relative w-full">
                    <input oninput="searchNews()" class="text-black bg-surface-container-lowest border border-outline-variant rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-primary/20 transition-all w-full cursor-pointer"
                        type="date"
                        id="toDate">
                    <i class="fas fa-calendar-alt absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                </div>

                <label class="font-bold text-sm">Language:</label>
                <select onchange="searchNews()" id="language"
                    class="text-black bg-surface-container-lowest border rounded-lg px-4 py-2 text-sm">
                    <option value="">Any</option>
                    <option value="en">English</option>
                    <option value="ar">Arabic</option>
                </select>

                <label class="font-bold text-sm">Sort By:</label>
                <select id="sortBy" onchange="searchNews()"
                    class="text-black bg-surface-container-lowest border rounded-lg px-4 py-2 text-sm">
                    <option value="publishedAt">Latest</option>
                    <option value="relevancy">Relevance</option>
                    <option value="popularity">Popularity</option>
                </select>

            </div>
        </div>

        <!-- TRENDING -->
        <section class="mb-16">
            <h2 class="text-2xl font-bold mb-8">Trending Topics</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <div onclick="showCategory('Philosophy')" class="topic-card">
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-blue-500">psychology</span>
                    </div>
                    <h3 class="text-lg font-bold mb-1">Philosophy</h3>
                    <p class="text-sm text-slate-500">12.4k stories this week</p>
                </div>
                <div onclick="showCategory('Technology')" class="topic-card">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-purple-500">rocket_launch</span>
                    </div>
                    <h3 class="text-lg font-bold mb-1">Tech Trends</h3>
                    <p class="text-sm text-slate-500">8.9k stories this week</p>
                </div>
                <div onclick="showCategory('Art')" class="topic-card">
                    <div
                        class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-green-500">palette</span>
                    </div>
                    <h3 class="text-lg font-bold mb-1">Art</h3>
                    <p class="text-sm text-slate-500">15.2k stories this week</p>
                </div>
                <div onclick="showCategory('Politics')" class="topic-card">
                   <div
                        class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-orange-500">gavel</span>
                    </div>
                    <h3 class="text-lg font-bold mb-1">Politics</h3>
                    <p class="text-sm text-slate-500">21.0k stories this week</p>
                </div>

            </div>
        </section>

        <!-- RESULTS -->
        <section>
            <h3 class="text-xl font-bold mb-6">Search Results</h3>
            <div id="results" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8"></div>
        </section>

    </div>

</main>

<script src="{{ asset('js/news.js') }}"></script>

@endsection
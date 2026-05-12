@extends('layouts.app')

@section('content')

<main class="min-h-screen bg-[#0d0f14] text-white">

    <form action="{{ isset($post)
        ? route('posts.update', $post->id)
        : route('posts.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @if(isset($post))
            @method('PUT')
        @endif

        <!-- HEADER -->
        <header class="fixed top-0 w-full h-[64px] z-50 bg-[#0d0f14]/60 backdrop-blur-xl border-b border-[#1e2330] flex justify-between items-center px-6">

            <div class="flex items-center gap-6">
                <span class="text-2xl font-black tracking-tighter text-slate-50">

                    {{ isset($post) ? 'Edit Post' : 'Add Post' }}

                </span>
            </div>

            <button type="submit"
                class="bg-blue-500 text-white font-bold text-sm px-6 py-2 rounded-full">

                {{ isset($post) ? 'Update' : 'Publish' }}

            </button>

        </header>

        <!-- CONTENT -->
        <section class="pt-[110px] flex justify-center w-full px-6">

            <div class="w-full max-w-[860px] py-12 flex flex-col gap-8">

                <!-- IMAGE -->
                <input type="file"
                       id="cover-upload"
                       name="image"
                       accept="image/*"
                       class="hidden" />

                <label for="cover-upload"
                    class="w-full h-[320px] border-2 border-dashed border-gray-700 rounded-xl flex flex-col items-center justify-center gap-4 cursor-pointer">

                    <span class="material-symbols-outlined text-5xl text-slate-400">
                        add_photo_alternate
                    </span>

                    <p class="text-slate-300">
                        {{ isset($post) ? 'Change Cover Image' : 'Add Cover Image' }}
                    </p>

                    @if(isset($post) && $post->image)
                        <img src="{{ asset('storage/' . $post->image) }}"
                             class="mt-4 w-full h-48 object-cover rounded-lg">
                    @endif

                </label>

                @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror


                <!-- TITLE -->
                <input
                    name="title"
                    type="text"
                    value="{{ old('title', $post->title ?? '') }}"
                    class="bg-transparent text-[42px] font-extrabold focus:outline-none w-full"
                    placeholder="Enter your title..."
                />

                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror


                <!-- DESCRIPTION -->
                <textarea
                    name="description"
                    class="w-full min-h-[500px] bg-transparent text-slate-300 focus:outline-none resize-none"
                    placeholder="Tell your story..."
                >{{ old('description', $post->description ?? '') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

            </div>

        </section>

    </form>

</main>

@endsection
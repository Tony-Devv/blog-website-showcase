@extends('layouts.app')

@section('content')

<main class="min-h-screen bg-[#0d0f14] text-white">

    <form id="post-form" action="{{ isset($post)
        ? route('posts.update', $post->id)
        : route('posts.store') }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf

        @if(isset($post))
            @method('PUT')
        @endif

        <!-- HEADER -->
        <header class="fixed top-0 w-full h-16 z-50 bg-[#0d0f14]/60 backdrop-blur-xl border-b border-[#1e2330] flex justify-between items-center px-6">

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

                <!-- IMAGE INPUT -->
                <input
                    type="file"
                    id="cover-upload"
                    name="image"
                    accept="image/*"
                    class="hidden" />

                <!-- IMAGE LABEL -->
                <label for="cover-upload"
                    class="w-full h-80 border-2 border-dashed border-gray-700 rounded-xl flex flex-col items-center justify-center gap-4 cursor-pointer overflow-hidden relative">

                    <!-- DEFAULT CONTENT -->
                    <div id="upload-placeholder"
                        class="flex flex-col items-center justify-center gap-4">

                        <span class="material-symbols-outlined text-5xl text-slate-400">
                            add_photo_alternate
                        </span>

                        <p class="text-slate-300">
                            {{ isset($post) ? 'Change Cover Image' : 'Add Cover Image' }}
                        </p>

                    </div>

                    <!-- IMAGE PREVIEW -->
                    <img
                        id="image-preview"
                        src="{{ isset($post) && $post->image
                                ? asset('storage/' . $post->image) . '?v=' . time()
                                : '' }}"
                        class="absolute inset-0 w-full h-full object-cover
                            {{ isset($post) && $post->image ? '' : 'hidden' }}"
                    >

                </label>

                @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
                <p id="image-error" class="text-red-500 text-sm hidden"></p>


                <!-- TITLE -->
                <input
                    id="title"
                    name="title"
                    type="text"
                    value="{{ old('title', $post->title ?? '') }}"
                    class="bg-transparent text-[42px] font-extrabold focus:outline-none w-full"
                    placeholder="Enter your title..."
                />

                <p id="title-error" class="text-red-500 text-sm hidden"></p>
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror


                <!-- DESCRIPTION -->
                <textarea
                    id="description"
                    name="description"
                    class="w-full min-h-[500px] bg-transparent text-slate-300 focus:outline-none resize-none"
                    placeholder="Tell your story..."
                >{{ old('description', $post->description ?? '') }}</textarea>

                <p id="description-error" class="text-red-500 text-sm hidden"></p>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

            </div>

        </section>

    </form>

</main>

<script>
(function() {
    const form = document.querySelector('form');
    const title = document.querySelector('[name="title"]');
    const description = document.querySelector('[name="description"]');
    const image = document.querySelector('[name="image"]');
    const preview = document.getElementById('image-preview');
    const placeholder = document.getElementById('upload-placeholder');

    // Error container
    const errBox = document.createElement('div');
    errBox.id = 'client-errors';
    errBox.className = 'hidden bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl text-sm mb-6';
    form.insertBefore(errBox, form.firstChild);

    function showErrors(errors) {
        errBox.innerHTML = '<ul class="list-disc pl-4">' + errors.map(function(e) {
            return '<li>' + e + '</li>';
        }).join('') + '</ul>';
        errBox.classList.remove('hidden');
    }

    function containsHTML(str) {
        return /<[^>]*>/g.test(str);
    }

    // Image validation on file select
    image.addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;

        const allowed = ['image/jpeg', 'image/png', 'image/webp'];
        if (!allowed.includes(file.type)) {
            alert('Invalid file type. Allowed: JPG, PNG, WEBP');
            this.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('File too large. Maximum size is 2MB');
            this.value = '';
            return;
        }
    });

    // Image preview
    image.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
    });

    // Form submit validation
    form.addEventListener('submit', function(e) {
        errBox.classList.add('hidden');

        var errors = [];

        if (!title.value.trim()) {
            errors.push('Title is required');
        } else if (containsHTML(title.value)) {
            errors.push('Title cannot contain HTML tags');
        }

        if (!description.value.trim()) {
            errors.push('Description is required');
        } else if (containsHTML(description.value)) {
            errors.push('Description cannot contain HTML tags');
        }

        if (errors.length > 0) {
            e.preventDefault();
            showErrors(errors);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
})();
</script>

@endsection
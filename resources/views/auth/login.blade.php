@extends('layouts.app')

@section('content')
    <main
        class="min-h-screen antialiased overflow-hidden
        bg-[radial-gradient(circle_at_top,#13203f_0%,#050816_40%,#02040b_100%)]
        text-[#e2e2e9] font-[Inter,sans-serif] relative">

        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-600/10 blur-[140px] rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-indigo-500/10 blur-[140px] rounded-full"></div>

        <section class="flex min-h-screen w-full relative">

            <section
                class="hidden lg:flex lg:w-1/2 min-h-screen relative overflow-hidden items-center justify-center border-r border-white/5">

                <div
                    class="absolute inset-0 [background-image:radial-gradient(rgba(255,255,255,0.04)_1px,transparent_1px)] [background-size:24px_24px] z-0">
                </div>

                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-transparent to-indigo-500/10">
                </div>

                <div class="relative z-20 p-16 flex flex-col justify-between h-full w-full">

                    <div class="flex items-center gap-3">
                        <div
                            class="w-11 h-11 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                            <i class="fa-solid fa-pen-clip text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tight text-white uppercase">InkWell</span>
                    </div>

                    <div>
                        <h1 class="text-7xl font-black tracking-tighter text-white leading-[0.9] max-w-md">
                            WELCOME <span class="text-indigo-400">BACK</span>
                        </h1>
                        <p class="mt-8 text-slate-400 text-lg max-w-sm leading-relaxed">
                            Continue your literary journey where modern architecture meets the obsidian glass.
                        </p>
                    </div>

                    <div class="text-[10px] text-slate-600 tracking-widest uppercase">
                        &copy; 2026 InkWell Editorial Systems
                    </div>
                </div>
            </section>

            <section class="w-full lg:w-1/2 min-h-screen flex items-center justify-center p-8 relative overflow-y-auto">

                <div
                    class="relative z-10 w-full max-w-md bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-[0_20px_80px_rgba(0,0,0,0.45)]">

                    <div class="space-y-4 mb-8">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/[0.03] border border-white/10">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-pulse"></span>
                            <span class="text-[10px] font-bold tracking-[0.2em] text-slate-400 uppercase">WELCOME BACK</span>
                        </div>
                        <h2 class="text-4xl font-black tracking-tight text-white">Sign In</h2>
                        <p class="text-slate-400 text-sm">Continue your journey with InkWell.</p>
                    </div>

                    <div id="login-error" class="hidden bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-xl text-sm mb-6"></div>

                    @if(session('success'))
                        <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-xl text-sm mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.check') }}" class="space-y-6">
                        @csrf

                        <div class="space-y-1">
                            <label class="text-[11px] font-black tracking-widest text-slate-400 uppercase ml-1">Email Address</label>
                            <input id="login-email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="name@domain.com"
                                class="w-full bg-white/[0.04] border border-white/5 rounded-2xl px-4 py-4 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/30 placeholder:text-slate-500 transition-all duration-300" />
                            @error('email')<p class="text-red-400 text-xs ml-1 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="space-y-1">
                            <div class="flex justify-between items-center px-1">
                                <label class="text-[11px] font-black tracking-widest text-slate-400 uppercase">Password</label>
                                <a href="#" class="text-[10px] font-bold text-blue-400 hover:text-blue-300 uppercase">Forgot?</a>
                            </div>
                            <input id="login-password" type="password" name="password" placeholder="••••••••"
                                class="w-full bg-white/[0.04] border border-white/5 rounded-2xl px-4 py-4 text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500/30 placeholder:text-slate-500 transition-all duration-300" />
                            @error('password')<p class="text-red-400 text-xs ml-1 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center gap-3">
                            <input id="remember" type="checkbox"
                                class="rounded border-white/10 bg-white/[0.04] text-blue-500 focus:ring-blue-500/20" />
                            <label class="text-xs text-slate-400" for="remember">Keep me signed in</label>
                        </div>

                        <button type="submit"
                            class="w-full py-4 rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-600 hover:scale-[1.01] hover:brightness-110 active:scale-[0.98] transition-all duration-300 font-black text-white shadow-[0_10px_40px_rgba(59,130,246,0.45)]">
                            Sign In
                        </button>
                    </form>

                    <p class="text-center text-slate-400 text-sm mt-8">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-blue-400 font-semibold hover:underline">Create one</a>
                    </p>
                </div>
            </section>
        </section>
    </main>

<script>
(function() {
    const form = document.querySelector('form');
    const email = document.getElementById('login-email');
    const password = document.getElementById('login-password');
    const errBox = document.getElementById('login-error');

    form.addEventListener('submit', function(e) {
        errBox.classList.add('hidden');
        var errors = [];

        if (!email.value.trim()) {
            errors.push('Email is required');
        }

        if (!password.value) {
            errors.push('Password is required');
        }

        if (errors.length > 0) {
            e.preventDefault();
            errBox.innerHTML = '<ul class="list-disc pl-4">' + errors.map(function(e) { return '<li>' + e + '</li>'; }).join('') + '</ul>';
            errBox.classList.remove('hidden');
        }
    });
})();
</script>
@endsection
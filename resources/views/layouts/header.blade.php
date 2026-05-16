@auth
   
    <nav class="fixed top-0 w-full z-50 bg-[#0d0f14]/90 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="text-2xl font-bold text-white">InkWell</a>
                
                <div class="flex items-center gap-6">

                    <a href="/news" class="text-slate-300 hover:text-white">News</a>
                    <a href="/posts" class="text-slate-300 hover:text-white">Home</a>
                    <a href="/user/posts" class="text-slate-300 hover:text-white">My Profile</a>
                    <a href="/posts/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Create Post</a>
                    
                 <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-slate-300 hover:text-white">Logout</button>
                    </form> 
                </div>
            </div>
        </div>
    </nav>
@else
  
    <nav class="fixed top-0 w-full z-50 bg-[#0d0f14]/90 backdrop-blur-md border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="text-2xl font-bold text-white">InkWell</a>
                
                <div class="flex items-center gap-6">
                  
                    <a href="/login" class="text-slate-300 hover:text-white">Login</a>
                    <a href="/register" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
@endauth
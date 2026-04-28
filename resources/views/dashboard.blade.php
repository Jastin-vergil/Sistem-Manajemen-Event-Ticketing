<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Tixly</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css?family=Mitr|Roboto+Slab|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'mitr': ['Mitr', 'sans-serif'],
                        'roboto-slab': ['"Roboto Slab"', 'serif'],
                        'source-sans': ['"Source Sans Pro"', 'sans-serif'],
                        'montserrat': ['Montserrat', 'sans-serif'],
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-[#0a0a2e] text-white font-source-sans min-h-screen">

    <div class="flex min-h-screen relative overflow-hidden">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-indigo-600/10 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-red-600/5 blur-[120px] pointer-events-none"></div>

        <aside class="w-64 bg-[#0a0a2e]/80 backdrop-blur-xl border-r border-white/5 fixed h-full z-50 hidden lg:block">
            <div class="p-8">
                <h2 class="font-roboto-slab text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-indigo-400">
                    Tixly.
                </h2>
            </div>

            <nav class="mt-4 px-4 space-y-2">
                <a href="#" class="flex items-center px-4 py-3 bg-indigo-600/20 text-indigo-400 rounded-xl border border-indigo-500/30">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-white/5 hover:text-white transition rounded-xl">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                    My Tickets
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-white/5 hover:text-white transition rounded-xl">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    Wishlist
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-white/5 hover:text-white transition rounded-xl">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                    Settings
                </a>
            </nav>

            <div class="absolute bottom-8 left-0 w-full px-8">
                <button class="flex items-center text-red-400 hover:text-red-300 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </div>
        </aside>

        <main class="flex-1 lg:ml-64 p-6 lg:p-10 relative z-10">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                <div>
                    <h1 class="font-mitr text-3xl">Hello, <span class="text-indigo-400">Alex!</span></h1>
                    <p class="text-gray-400">Ready for your next big event?</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-white/5 border border-white/10 p-2 rounded-full relative">
                        <div class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full border-2 border-[#0a0a2e]"></div>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Alex+Doe&background=4f46e5&color=fff" class="w-12 h-12 rounded-2xl border-2 border-indigo-500/50" alt="Avatar">
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-[2rem] hover:border-indigo-500/50 transition-all group">
                    <p class="text-gray-400 text-sm mb-1 uppercase tracking-wider">Active Tickets</p>
                    <h3 class="text-4xl font-mitr group-hover:text-indigo-400 transition">03</h3>
                </div>
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-[2rem] hover:border-red-500/50 transition-all group">
                    <p class="text-gray-400 text-sm mb-1 uppercase tracking-wider">Total Attended</p>
                    <h3 class="text-4xl font-mitr group-hover:text-red-400 transition">12</h3>
                </div>
                <div class="bg-white/5 backdrop-blur-md border border-white/10 p-6 rounded-[2rem] hover:border-white/50 transition-all group">
                    <p class="text-gray-400 text-sm mb-1 uppercase tracking-wider">Credits</p>
                    <h3 class="text-4xl font-mitr">IDR 250k</h3>
                </div>
            </div>

            <section class="mb-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-mitr text-xl uppercase tracking-widest text-indigo-400">Upcoming Tickets</h2>
                    <a href="#" class="text-sm text-gray-400 hover:text-white underline">View All</a>
                </div>

                <div class="space-y-4">
                    <div class="bg-white/5 border border-white/10 p-4 rounded-3xl flex flex-col md:flex-row items-center gap-6 hover:bg-white/[0.08] transition duration-300">
                        <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?q=80&w=200&h=200&fit=crop"
                             class="w-full md:w-32 h-32 object-cover rounded-2xl" alt="event">
                        <div class="flex-1 text-center md:text-left">
                            <h4 class="text-xl font-bold">Midnight Jazz Resonance</h4>
                            <p class="text-indigo-400">Saturday, 12 May 2026</p>
                            <div class="flex items-center justify-center md:justify-start mt-2 text-gray-400 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Grand Indonesia Hall, Jakarta
                            </div>
                        </div>
                        <div class="bg-indigo-600/20 border border-indigo-500/50 px-6 py-2 rounded-full font-mitr text-indigo-400">
                            VIP A-12
                        </div>
                        <button class="bg-white text-[#0a0a2e] px-6 py-3 rounded-2xl font-bold hover:bg-indigo-400 transition">
                            Show QR
                        </button>
                    </div>

                    <div class="bg-white/5 border border-white/10 p-4 rounded-3xl flex flex-col md:flex-row items-center gap-6 hover:bg-white/[0.08] transition duration-300 opacity-80">
                        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=200&h=200&fit=crop"
                             class="w-full md:w-32 h-32 object-cover rounded-2xl" alt="event">
                        <div class="flex-1 text-center md:text-left">
                            <h4 class="text-xl font-bold">Tech Innovators Summit</h4>
                            <p class="text-red-400">Monday, 20 May 2026</p>
                            <div class="flex items-center justify-center md:justify-start mt-2 text-gray-400 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Virtual Conference
                            </div>
                        </div>
                        <div class="bg-red-600/20 border border-red-500/50 px-6 py-2 rounded-full font-mitr text-red-400">
                            General
                        </div>
                        <button class="bg-white/10 text-white px-6 py-3 rounded-2xl font-bold hover:bg-white/20 transition border border-white/20">
                            Details
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </div>

</body>

</html>

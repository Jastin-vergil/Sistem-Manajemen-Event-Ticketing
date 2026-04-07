<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Mitr|Roboto+Slab|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="{{ asset('app.css') }}">

    <style>
        .font-mitr { font-family: 'Mitr', sans-serif; }
        .font-roboto-slab { font-family: 'Roboto Slab', serif; }
        .font-source-sans-pro { font-family: 'Source Sans Pro', sans-serif; }
    </style>
</head>
<div class="bg-indigo-900 relative overflow-hidden min-h-screen">
    <div class="inset-0 bg-black opacity-25 absolute"></div>

    <header class="absolute top-0 left-0 right-0 z-20">
        <nav class="container mx-auto px-6 md:px-12 py-4" x-data="{ open: false }">
            <div class="md:flex justify-between items-center">
                <div class="flex justify-between items-center">
                    <a href="#" class="text-white">
                        <svg class="w-8 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.16 12.57">
                            <path d="M14.02 4.77v7.8H9.33V8.8h-2.5v3.77H2.14v-7.8h11.88z"/><path d="M16.16 5.82H0L8.08 0l8.08 5.82z"/>
                        </svg>
                    </a>

                    <div class="md:hidden">
                        <button @click="open = !open" class="text-white focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="hidden md:flex items-center" style="font-family: 'Montserrat', sans-serif;">
                    <a class="text-sm uppercase mx-3 text-white cursor-pointer hover:text-indigo-400 transition">About us</a>
                    <a class="text-sm uppercase mx-3 text-white cursor-pointer hover:text-indigo-400 transition">Calendar</a>
                    <a class="text-sm uppercase mx-3 text-white cursor-pointer hover:text-indigo-400 transition">Contact us</a>
                </div>
            </div>

        </nav>
    </header>

    <div class="container mx-auto px-6 md:px-12 relative z-10 flex items-center py-24 xl:py-40">
        <div class="lg:w-3/5 xl:w-2/5 flex flex-col items-start relative z-10">
            <span class="font-mitr uppercase text-indigo-400 font-bold tracking-widest">Discover Your Next Great Experience</span>

            <h1 class="font-roboto-slab text-5xl sm:text-7xl text-red-400 leading-tight mt-4">
                Explore New Event  <br> and Get Your Tickets Now!
            </h1>

                       <a href="#" class="block bg-indigo-500 hover:bg-indigo-400 py-3 px-8 rounded-full text-md font-mitr text-white uppercase mt-10 shadow-lg transition-all transform hover:-translate-y-1">
                Find Event
            </a>
        </div>
        </div>
</div>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Tixly</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Mitr|Roboto+Slab|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'mitr': ['Mitr', 'sans-serif'],
                        'roboto-slab': ['"Roboto Slab"', 'serif'],
                        'source-sans': ['"Source Sans Pro"', 'sans-serif'],
                    },
                    animation: {
                        'text-slide-5': 'text-slide-5 12.5s cubic-bezier(0.83, 0, 0.17, 1) infinite',
                        'text-slide-5': 'text-slide-5 12.5s cubic-bezier(0.83, 0, 0.17, 1) infinite',
                    },
                    keyframes: {
                        'text-slide-5': {
                            '0%, 16%': {
                                transform: 'translateY(0%)'
                            },
                            '20%, 36%': {
                                transform: 'translateY(-16.66%)'
                            },
                            '40%, 56%': {
                                transform: 'translateY(-33.33%)'
                            },
                            '60%, 76%': {
                                transform: 'translateY(-50%)'
                            },
                            '80%, 96%': {
                                transform: 'translateY(-66.66%)'
                            },
                            '100%': {
                                transform: 'translateY(-83.33%)'
                            },
                        },
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-[#0a0a2e]">

    <div class="bg-indigo-900 relative">
        <div class="inset-0 bg-black opacity-25 absolute"></div>
        <header
            class="sticky top-0 left-0 right-0 z-[100] w-full bg-[#0a0a2e]/60 backdrop-blur-lg border-b border-white/5">
            @include('components.header')
        </header>

        <div class="relative overflow-hidden min-h-screen bg-[#0a0a2e] flex flex-col justify-center">

            <div
                class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none">
            </div>
            <div
                class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-red-600/10 blur-[120px] pointer-events-none">
            </div>

            <div class="absolute inset-0 z-0 opacity-20"
                style="background-image: radial-gradient(#4f46e5 0.5px, transparent 0.5px); background-size: 30px 30px;">
            </div>

            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#0a0a2e]/50 to-[#0a0a2e] z-0"></div>

            <div class="container mx-auto px-6 md:px-12 relative z-10 flex flex-col lg:flex-row items-center py-24 xl:py-40"
                x-data="{ activeStack: 1, total: 4, init() { setInterval(() => { this.activeStack = this.activeStack < this.total ? this.activeStack + 1 : 1; }, 3000); } }">

                <div class="lg:w-3/5 xl:w-2/5 flex flex-col items-start relative z-10 mb-20 lg:mb-0">
                    <span class="font-mitr text-sm uppercase text-indigo-400 font-bold tracking-[0.3em] mb-4">
                        Premium Event Experience
                    </span>

                    <h1 class="font-roboto-slab text-5xl sm:text-7xl leading-tight mt-4 relative inline-block">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-red-200 to-red-400">
                            Explore
                        </span>

                        <span
                            class="text-red-500 inline-flex flex-col h-[calc(theme(fontSize.5xl)*theme(lineHeight.tight))] sm:h-[calc(theme(fontSize.7xl)*theme(lineHeight.tight))] overflow-hidden">
                            <ul
                                class="block animate-text-slide-5 text-left leading-tight [&_li]:block
                             via-red-400
                                bg-[length:200%_auto] bg-clip-text">
                                <li>Concerts</li>
                                <li>Festivals</li>
                                <li>Workshops</li>
                                <li>Seminars</li>
                                <li>Meetups</li>
                                <li aria-hidden="true">Concerts</li>
                            </ul>
                        </span>

                        <br>

                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-red-300 to-red-400">
                            & Get Your Tickets
                        </span>

                        <div class="h-1 w-24 bg-red-500 mt-4 rounded-full"></div>
                    </h1>

                    <p class="text-gray-400 mt-6 text-lg font-source-sans-pro max-w-md">
                        Experience the ease of booking tickets for your favorite events with Tixly. Safe, fast, and
                        reliable.
                    </p>

                    <a href="#"
                        class="group relative px-10 py-4 mt-10 font-mitr text-white uppercase tracking-widest overflow-hidden rounded-full bg-indigo-600 transition-all duration-300 hover:bg-indigo-500 shadow-[0_0_20px_rgba(79,70,229,0.4)]">
                        <span class="relative z-10">Find Event</span>
                        <div class="absolute inset-0 w-0 bg-red-400 transition-all duration-300 group-hover:w-full">
                        </div>
                    </a>
                </div>

                <div
                    class="lg:w-1/3 w-full flex justify-center lg:justify-end lg:ml-auto relative h-[600px] md:h-[750px] items-center">
                    <div class="relative w-80 md:w-[450px] aspect-[3/4]">

                        <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 w-[90%] h-12 bg-black/60 blur-[40px] rounded-full z-0 transition-all duration-1000"
                            :class="activeStack ? 'scale-110 opacity-80' : 'scale-100 opacity-50'">
                        </div>

                        <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform-gpu"
                            :class="{
                                'z-30 opacity-100 scale-100 translate-x-0 translate-y-0 rotate-0 shadow-[20px_20px_60px_rgba(0,0,0,0.9)]': activeStack ===
                                    1,
                                'z-20 opacity-80 scale-95 translate-x-12 translate-y-6 rotate-3': activeStack ===
                                    2,
                                'z-10 opacity-60 scale-90 translate-x-24 translate-y-12 rotate-6': activeStack ===
                                    3,
                                'z-0 opacity-0 scale-80 translate-x-32 translate-y-16 rotate-12': activeStack ===
                                    4
                            }">
                            <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?q=80&w=800"
                                class="w-full h-full object-cover rounded-[3rem] border border-white/5">
                        </div>

                        <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform-gpu"
                            :class="{
                                'z-30 opacity-100 scale-100 translate-x-0 translate-y-0 rotate-0 shadow-[20px_20px_60px_rgba(0,0,0,0.9)]': activeStack ===
                                    2,
                                'z-20 opacity-80 scale-95 translate-x-12 translate-y-6 rotate-3': activeStack ===
                                    3,
                                'z-10 opacity-60 scale-90 translate-x-24 translate-y-12 rotate-6': activeStack ===
                                    4,
                                'z-0 opacity-0 scale-80 translate-x-32 translate-y-16 rotate-12': activeStack ===
                                    1
                            }">
                            <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800"
                                class="w-full h-full object-cover rounded-[3rem] border border-white/5">
                        </div>

                        <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform-gpu"
                            :class="{
                                'z-30 opacity-100 scale-100 translate-x-0 translate-y-0 rotate-0 shadow-[20px_20px_60px_rgba(0,0,0,0.9)]': activeStack ===
                                    3,
                                'z-20 opacity-80 scale-95 translate-x-12 translate-y-6 rotate-3': activeStack ===
                                    4,
                                'z-10 opacity-60 scale-90 translate-x-24 translate-y-12 rotate-6': activeStack ===
                                    1,
                                'z-0 opacity-0 scale-80 translate-x-32 translate-y-16 rotate-12': activeStack ===
                                    2
                            }">
                            <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?q=80&w=800"
                                class="w-full h-full object-cover rounded-[3rem] border border-white/5">
                        </div>

                        <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform-gpu"
                            :class="{
                                'z-30 opacity-100 scale-100 translate-x-0 translate-y-0 rotate-0 shadow-[20px_20px_60px_rgba(0,0,0,0.9)]': activeStack ===
                                    4,
                                'z-20 opacity-80 scale-95 translate-x-12 translate-y-6 rotate-3': activeStack ===
                                    1,
                                'z-10 opacity-60 scale-90 translate-x-24 translate-y-12 rotate-6': activeStack ===
                                    2,
                                'z-0 opacity-0 scale-80 translate-x-32 translate-y-16 rotate-12': activeStack ===
                                    3
                            }">
                            <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=800"
                                class="w-full h-full object-cover rounded-[3rem] border border-white/5">
                        </div>

                        <div class="absolute -bottom-24 left-[70%] -translate-x-1/2 flex space-x-3 items-center z-50">
                            <template x-for="i in total">
                                <div class="h-1.5 rounded-full transition-all duration-500"
                                    :class="activeStack === i ? 'w-10 bg-red-500' : 'w-4 bg-white/10'"></div>
                            </template>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <footer>
            @include('components.footer')
        </footer>

</body>

</html>

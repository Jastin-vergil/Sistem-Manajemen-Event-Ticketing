
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

</head>
<div class="bg-indigo-900 relative min-h-screen">
    <div class="inset-0 bg-black opacity-25 absolute"></div>

    <header class="sticky top-0 left-0 right-0 z-[100] w-full bg-[#0a0a2e]/60 backdrop-blur-lg border-b border-white/5">
        <nav
        class="flex items-center justify-between flex-wrap bg-white py-4 lg:px-12 shadow border-solid border-t-2 border-blue-700">
        <div class="flex justify-between lg:w-auto w-full lg:border-b-0 pl-6 pr-2 border-solid border-b-2 border-gray-300 pb-5 lg:pb-0">
            <div class="flex items-center flex-shrink-0 text-gray-800 mr-16">
                <span class="text-3xl tracking-tight font-black px-10" style="font-family: 'Montserrat', sans-serif;">Tixly</span>
            </div>
            <div class="block lg:hidden ">
                <button
                    id="nav"
                    class="flex items-center px-3 py-2 border-2 rounded text-blue-700 border-blue-700 hover:text-blue-700 hover:border-blue-700">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="menu w-full flex-grow lg:flex lg:items-center lg:w-auto lg:px-3 px-8">
            <div class="text-md font-bold text-blue-700 lg:flex-grow"style="font-family: 'Montserrat', sans-serif;">
                <a href="#responsive-header"
                   class="block mt-4 lg:inline-block lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-blue-700 mr-2">
                    Menu 1
                </a>
                <a href="#responsive-header"
                   class=" block mt-4 lg:inline-block lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-blue-700 mr-2">
                    Menu 2
                </a>
                <a href="#responsive-header"
                   class="block mt-4 lg:inline-block lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-blue-700 mr-2">
                    Menu 3
                </a>
            </div>
            <!-- This is an example component -->
            <div class="relative mx-auto text-gray-600 lg:block hidden">
                <input
                    class="border-2 border-gray-300 bg-white h-10 pl-2 pr-8 rounded-lg text-sm focus:outline-none"
                    type="search" name="search" placeholder="Search">
                <button type="submit" class="absolute right-0 top-0 mt-3 mr-2">
                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                         version="1.1" id="Capa_1" x="0px" y="0px"
                         viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                         xml:space="preserve"
                         width="512px" height="512px">
                <path
                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z"/>
              </svg>
                </button>
            </div>
            <div class="flex items-center lg:ml-6" style="font-family: 'Poppins', sans-serif;">

           </div>
        </div>

    </nav>
    </header>

<div class="relative overflow-hidden min-h-screen bg-[#0a0a2e] flex flex-col justify-center">

    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-indigo-600/20 blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-red-600/10 blur-[120px] pointer-events-none"></div>

    <div class="absolute inset-0 z-0 opacity-20"
         style="background-image: radial-gradient(#4f46e5 0.5px, transparent 0.5px); background-size: 30px 30px;">
    </div>

    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#0a0a2e]/50 to-[#0a0a2e] z-0"></div>

    <header class="absolute top-0 left-0 right-0 z-50">
        </header>

    <div class="container mx-auto px-6 md:px-12 relative z-10 flex flex-col lg:flex-row items-center py-24 xl:py-40"
         x-data="{
            activeStack: 1,
            total: 4,
            init() {
                setInterval(() => {
                    this.activeStack = this.activeStack < this.total ? this.activeStack + 1 : 1;
                }, 3000);
            }
         }">

        <div class="lg:w-3/5 xl:w-2/5 flex flex-col items-start relative z-10 mb-20 lg:mb-100">
            <span class="font-mitr text-sm uppercase text-indigo-400 font-bold tracking-[0.3em] mb-4">
                Premium Event Experience
            </span>

            <b>
                <h1 class="font-roboto-slab text-5xl sm:text-7xl leading-tight mt-4 relative inline-block">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-red-200 to-red-400">
                        Explore New Event <br> & Get Tickets.
                    </span>

                    <div class="h-1 w-24 bg-red-500 mt-4 rounded-full"></div>
                </h1>
            </b>

            <p class="text-gray-400 mt-6 text-lg font-source-sans-pro max-w-md">
                Experience the ease of booking tickets for your favorite events with Tixly. Safe, fast, and reliable.
            </p>

            <a href="#" class="group relative px-10 py-4 mt-10 font-mitr text-white uppercase tracking-widest overflow-hidden rounded-full bg-indigo-600 transition-all duration-300 hover:bg-indigo-500 shadow-[0_0_20px_rgba(79,70,229,0.4)]">
                <span class="relative z-10">Find Event</span>
                <div class="absolute inset-0 w-0 bg-red-400 transition-all duration-300 group-hover:w-full"></div>
            </a>
        </div>


        <div class="lg:w-1/2 w-full flex justify-center lg:justify-end lg:ml-auto relative h-[600px] md:h-[750px] items-center">

            <div class="relative w-80 md:w-[450px] aspect-[3/4]">

                <div class="absolute -bottom-12 left-1/2 -translate-x-1/2 w-[90%] h-12 bg-black/60 blur-[40px] rounded-full z-0 transition-all duration-1000"
                     :class="activeStack ? 'scale-110 opacity-80' : 'scale-100 opacity-50'">
                </div>

                <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform-gpu"
                     :class="{
                        'z-30 opacity-100 scale-100 translate-x-0 translate-y-0 rotate-0 shadow-[20px_20px_60px_rgba(0,0,0,0.9)]': activeStack === 1,
                        'z-20 opacity-80 scale-95 translate-x-12 translate-y-6 rotate-3': activeStack === 2,
                        'z-10 opacity-60 scale-90 translate-x-24 translate-y-12 rotate-6': activeStack === 3,
                        'z-0 opacity-0 scale-80 translate-x-32 translate-y-16 rotate-12': activeStack === 4
                     }">
                    <img src="https://images.unsplash.com/photo-1540039155733-5bb30b53aa14?q=80&w=800"
                         class="w-full h-full object-cover rounded-[3rem] border border-white/5">
                </div>

                <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform-gpu"
                     :class="{
                        'z-30 opacity-100 scale-100 translate-x-0 translate-y-0 rotate-0 shadow-[20px_20px_60px_rgba(0,0,0,0.9)]': activeStack === 2,
                        'z-20 opacity-80 scale-95 translate-x-12 translate-y-6 rotate-3': activeStack === 3,
                        'z-10 opacity-60 scale-90 translate-x-24 translate-y-12 rotate-6': activeStack === 4,
                        'z-0 opacity-0 scale-80 translate-x-32 translate-y-16 rotate-12': activeStack === 1
                     }">
                    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800"
                         class="w-full h-full object-cover rounded-[3rem] border border-white/5">
                </div>

                <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform-gpu"
                     :class="{
                        'z-30 opacity-100 scale-100 translate-x-0 translate-y-0 rotate-0 shadow-[20px_20px_60px_rgba(0,0,0,0.9)]': activeStack === 3,
                        'z-20 opacity-80 scale-95 translate-x-12 translate-y-6 rotate-3': activeStack === 4,
                        'z-10 opacity-60 scale-90 translate-x-24 translate-y-12 rotate-6': activeStack === 1,
                        'z-0 opacity-0 scale-80 translate-x-32 translate-y-16 rotate-12': activeStack === 2
                     }">
                    <img src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?q=80&w=800"
                         class="w-full h-full object-cover rounded-[3rem] border border-white/5">
                </div>

                <div class="absolute inset-0 transition-all duration-1000 ease-in-out transform-gpu"
                     :class="{
                        'z-30 opacity-100 scale-100 translate-x-0 translate-y-0 rotate-0 shadow-[20px_20px_60px_rgba(0,0,0,0.9)]': activeStack === 4,
                        'z-20 opacity-80 scale-95 translate-x-12 translate-y-6 rotate-3': activeStack === 1,
                        'z-10 opacity-60 scale-90 translate-x-24 translate-y-12 rotate-6': activeStack === 2,
                        'z-0 opacity-0 scale-80 translate-x-32 translate-y-16 rotate-12': activeStack === 3
                     }">
                    <img src="https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=800"
                         class="w-full h-full object-cover rounded-[3rem] border border-white/5">
                </div>

                <div class="absolute -bottom-24 left-[50%] -translate-x-1/2 flex space-x-3 items-center z-50">
                    <template x-for="i in total">
                        <div class="h-1.5 rounded-full transition-all duration-500"
                        :class="activeStack === i ? 'w-10 bg-red-500' : 'w-4 bg-white/10'"></div>
                    </template>
                </div>

            </div>
        </div>

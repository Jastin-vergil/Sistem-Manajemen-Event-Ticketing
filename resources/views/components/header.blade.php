  <script src="https://cdn.tailwindcss.com"></script>

 <header class="glass-effect fixed w-full z-[150] top-0 start-0 border-b border-white/10">
    <nav class="flex items-center justify-between py-4 lg:px-12 px-6 shadow-xl">

        <div class="flex items-center justify-between lg:w-auto w-full">
            <div class="flex items-center flex-shrink-0 text-indigo-700 mr-6">
                <span class="text-3xl tracking-tight font-black" style="font-family: 'Montserrat', sans-serif;">Tixly</span>
            </div>

            <div class="block lg:hidden">
                <button id="nav" class="flex items-center px-3 py-2 border-2 rounded text-indigo-400 border-indigo-700 hover:text-white hover:bg-indigo-700 transition-colors">
                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="menu w-full hidden lg:flex lg:items-center lg:w-auto flex-grow lg:justify-end">
            <div class="text-md font-bold text-indigo-300 lg:flex lg:flex-row space-x-2" style="font-family: 'Montserrat', sans-serif;">
                <a href="#responsive-header" class="block lg:inline-block mt-4 lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-indigo-700/50 transition-all">
                    Menu 1
                </a>
                <a href="#responsive-header" class="block lg:inline-block mt-4 lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-indigo-700/50 transition-all">
                    Menu 2
                </a>
                <a href="#responsive-header" class="block lg:inline-block mt-4 lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-indigo-700/50 transition-all">
                    Menu 3
                </a>
            </div>
        </div>
    </nav>
</header>

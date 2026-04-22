<script rel="stylesheet" src="https://cdn.tailwindcss.com"></script>
<header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <div class="text-2xl font-bold text-blue-600">
            <a href="/">BrandLogo</a>
        </div>

        <div class="hidden md:flex space-x-8 items-center">
            <a href="/" class="text-gray-600 hover:text-blue-600 transition">Home</a>
            <a href="/events" class="text-gray-600 hover:text-blue-600 transition">Events</a>
            <a href="/tickets" class="text-gray-600 hover:text-blue-600 transition">Tickets</a>
            <a href="/contact" class="text-gray-600 hover:text-blue-600 transition">Contact</a>
        </div>

        <div class="hidden md:block">
            <a href="/login" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </a>
        </div>

        <div class="md:hidden">
            <button class="text-gray-600 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </nav>
</header>

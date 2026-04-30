<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminDashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
</head>

<body class="bg-gradient-to-b from-[#0b0f2a] to-[#05071a] text-white">

<!-- NAVBAR -->
<nav class="bg-[#0b0f2a]/80 backdrop-blur-md fixed top-0 left-0 w-full z-50 h-16 border-b border-gray-700">
  <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">

    <!-- LOGO -->
    <a href="#" class="flex items-center space-x-3">
      <img src="https://www.polibatam.ac.id/wp-content/uploads/2021/09/logo.png" class="h-7" alt="logo" />
      <span class="text-xl font-bold bg-gradient-to-r from-indigo-400 via-purple-500 to-blue-500 bg-clip-text text-transparent">Admin Dashboard
</span>
    </a>

    <!-- USER -->
    <div class="flex items-center">
      <button type="button"
        class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300"
        id="user-menu-button"
        data-dropdown-toggle="user-dropdown">

        <img class="w-8 h-8 rounded-full"
          src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
          alt="user">
      </button>

      <!-- DROPDOWN -->
      <div class="hidden bg-[#0f1335] border border-gray-700 rounded-xl shadow w-44 mt-2"
        id="user-dropdown">

        <div class="px-4 py-3 text-sm border-b">
          <p class="font-medium">Admin</p>
          <p class="text-gray-500 text-xs">anisya17@email.com</p>
        </div>

        <ul class="text-sm">
          <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a></li>
          <li><a href="login" class="block px-4 py-2 hover:bg-gray-100">Logout</a></li>
        </ul>

      </div>
    </div>

  </div>
</nav>

<!-- SIDEBAR -->
<aside class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-[#0f1335] border-r border-gray-700">
    <div class="h-full px-3 py-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <a href="{{ url('/admindashboard') }}" 
            class="flex items-center px-3 py-2 hover:bg-gray-200 rounded">
             <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2L2 8h2v8h4v-5h4v5h4V8h2L10 2z"/>
            </svg>
            <span>Event List</span>
            </a>

            <a href="{{ url('/informasipembayaran') }}" 
            class="flex items-center px-3 py-2 hover:bg-gray-200 rounded">
            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v2H2V5zm0 4h16v6a2 2 0 01-2 2H4a2 2 0 01-2-2V9zm3 3h4v2H5v-2z"/>
            </svg>
            <span>Payment Information</span>
            </a>

            <a href="{{ url('/categories') }}" 
            class="flex items-center px-3 py-2 hover:bg-gray-200 rounded">
            <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 3h6v6H3V3zm8 0h6v6h-6V3zM3 11h6v6H3v-6zm8 0h6v6h-6v-6z"/>
            </svg>
            <span>Categories</span>
            </a>
    </div>
</aside>

<!-- CONTENT -->
<div class="ml-64 mt-16 p-6 text-white">
    <!-- Welcome Card -->
<div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 mb-6 border border-white/10">
    <h1 class="text-2xl font-bold text-white">
        Welcome, Admin!
    </h1>
    <p class="text-sm text-gray-300">
        Manage events and monitor orders easily through this dashboard. 
    </p>
    <p class="text-sm text-gray-300">
        Add new events, edit information, and track ticket orders efficiently.
    </p>
</div>

<!-- card event active and orders -->
    <div class="flex gap-6">
    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 border border-white/10 w-full">
        <h2 class="text-lg font-semibold text-gray-300">
            Event Active
        </h2>
        <p class="text-3xl font-bold text-blue-600 mt-2">
            {{ $eventActive ?? 4 }}
        </p>
        <p class="text-sm text-gray-400">
            Total events currently running
        </p>
    </div>

    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 border border-white/10 w-full">
        <h2 class="text-lg font-semibold text-gray-300">
            Orders
        </h2>
        <p class="text-3xl font-bold text-green-600 mt-2">
            {{ $orders ?? 3 }}
        </p>
        <p class="text-sm text-gray-400">
            Total ticket orders
        </p>
    </div>

</div>

<!-- HEADER TABLE -->
<div class="flex flex-col gap-3 p-4 border-b">
    <h2 class="text-lg font-semibold text-center m-4">
        Payment Information
    </h2>
</div>

<!-- TABLE -->
<div class="bg-[#0f1335] border border-gray-700 rounded mb-6 overflow-x-auto">
    <table class="w-full text-sm text-left">

        <thead class="bg-[#1a1f4a] text-gray-300">
            <tr>
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Email</th>
                <th class="px-6 py-3">Event Name</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Proof of Payment</th>
                <th class="px-6 py-3">Action</th>
            </tr>
        </thead>

        <tbody>
            <tr class="border-b border-gray-700 hover:bg-[#1a1f4a]">
                
                <td class="px-6 py-4 font-medium">Anisya</td>
                <td class="px-6 py-4">anisya@gmail.com</td>
                <td class="px-6 py-4">Festival Seni</td>
                <td class="px-6 py-4">Paid</td>
                <td class="px-6 py-4">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsvw0i3smzP3raqqKHNq-RKcxMZdLcNTW8sg&sh=1200" alt="proof of payment"
                        onclick="showImage(this.src)"
                        class="w-24 h-16 object-cover rounded cursor-pointer hover:scale-105 transition"></td>
                <td class="px-6 py-4">
                    <div class="flex gap-2">
                        <button class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">
                            Approved
                        </button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                            Rejected
                        </button>
                    </div>
                </td>

            </tr>
        </tbody>

    </table>
</div>

<!--Modal for Image-->
<div id="imageModal" 
     class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">

    <img id="modalImage" class="max-w-lg rounded-lg">

</div>

<script>
function showImage(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
}

document.getElementById('imageModal').onclick = function() {
    this.classList.add('hidden');
}
</script>       
</body>
</html>
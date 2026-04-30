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
        <h2 class="text-lg font-semibold text-center">Categories</h2>

    <div class="flex justify-end">
        <button 
            data-modal-target="crud-modal" 
            data-modal-toggle="crud-modal"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Create New Category
        </button>
    </div>
    <div class="flex flex-col gap-3 mb-4">

    <!-- ALL -->
    <div>
        <button onclick="filterCategory('all')" 
            class="px-5 py-2 bg-blue-600 text-white rounded-full">
            All Categories
        </button>
    </div>

    <!-- CATEGORY -->
    <div class="flex gap-3 flex-wrap">
        <button onclick="filterCategory('Technology')" 
            class="px-4 py-1 rounded-full bg-blue-500/20 text-blue-400">
            Technology
        </button>

        <button onclick="filterCategory('Art & Design')" 
            class="px-4 py-1 rounded-full bg-pink-500/20 text-pink-400">
            Art & Design
        </button>

        <button onclick="filterCategory('Music')" 
            class="px-4 py-1 rounded-full bg-purple-500/20 text-purple-400">
            Music
        </button>
    </div>
</div>
</div>
 <!-- TABLE -->
<div class="bg-[#0f1335] border border-gray-700 rounded mb-6 overflow-x-auto">
    <table class="w-full text-sm text-left">

        <thead class="bg-[#1a1f4a] text-gray-300">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Event Title</th>
                <th class="px-6 py-3">Category Name</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr data-category="Art & Design" class="border-b border-gray-700 hover:bg-[#1a1f4a]">
                <td class="px-6 py-4 font-medium text-gray-200">1</td>
                <td class="px-6 py-4 font-medium text-gray-200">Festival Seni</td>
                <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs font-medium rounded-full bg-pink-500/20 text-pink-400">Art & Design </span></td>
                <td class="px-6 py-4">
                
                    <div class="flex gap-2">
                        <!-- EDIT -->
                        <button 
                        class="flex items-center gap-1 bg-green-500 px-3 py-1 rounded hover:bg-green-600 text-white"
                        data-modal-target="edit-modal"
                        data-modal-toggle="edit-modal"
                        data-title="Festival Seni"
                        data-category="Art & Design">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2m-1-1v2m6.707 2.293a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-4 1a1 1 0 01-1.213-1.213l1-4a1 1 0 01.242-.39l9-9a1 1 0 011.414 0z"/>
                            </svg>
                            Edit
                        </button>

                        <!-- DELETE -->
                        <button 
                            class="flex items-center gap-1 bg-red-500 px-3 py-1 rounded hover:bg-red-600 text-white"
                            data-modal-target="popup-modal" 
                            data-modal-toggle="popup-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 7h12M9 7v12m6-12v12M10 4h4a1 1 0 011 1v2H9V5a1 1 0 011-1z"/>
                            </svg>
                            Delete
                        </button>

                    </div>
                </td>

            </tr>
            <tr data-category="Technology" class="border-b border-gray-700 hover:bg-[#1a1f4a]">
                <td class="px-6 py-4">2</td>
                <td class="px-6 py-4">Tech Conference 2025</td>
                <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs rounded-full bg-blue-500/20 text-blue-400">Technology</span></td>
                <td class="px-6 py-4">
                
                    <div class="flex gap-2">
                        <!-- EDIT -->
                        <button 
                            class="flex items-center gap-1 bg-green-500 px-3 py-1 rounded hover:bg-green-600 text-white"
                            data-modal-target="edit-modal"
                            data-modal-toggle="edit-modal"
                            data-title="Tech Conference 2025"
                            data-category="Technology">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2m-1-1v2m6.707 2.293a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-4 1a1 1 0 01-1.213-1.213l1-4a1 1 0 01.242-.39l9-9a1 1 0 011.414 0z"/>
                            </svg>
                            Edit
                        </button>

                        <!-- DELETE -->
                        <button 
                            class="flex items-center gap-1 bg-red-500 px-3 py-1 rounded hover:bg-red-600 text-white"
                            data-modal-target="popup-modal" 
                            data-modal-toggle="popup-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 7h12M9 7v12m6-12v12M10 4h4a1 1 0 011 1v2H9V5a1 1 0 011-1z"/>
                            </svg>
                            Delete
                        </button>

                    </div>
                </td>

            </tr>
            <tr data-category="Music" class="border-b border-gray-700 hover:bg-[#1a1f4a]">
                <td class="px-6 py-4">3</td>
                <td class="px-6 py-4">Music Festival Night</td>
                <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs rounded-full bg-purple-500/20 text-purple-400">Music</span></td>
                <td class="px-6 py-4">
                
                    <div class="flex gap-2">
                        <!-- EDIT -->
                       <button 
                            class="flex items-center gap-1 bg-green-500 px-3 py-1 rounded hover:bg-green-600 text-white"
                            data-modal-target="edit-modal"
                            data-modal-toggle="edit-modal"
                            data-title="Music Festival Night"
                            data-category="Music">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2m-1-1v2m6.707 2.293a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-4 1a1 1 0 01-1.213-1.213l1-4a1 1 0 01.242-.39l9-9a1 1 0 011.414 0z"/>
                            </svg>
                            Edit
                        </button>

                        <!-- DELETE -->
                        <button 
                            class="flex items-center gap-1 bg-red-500 px-3 py-1 rounded hover:bg-red-600 text-white"
                            data-modal-target="popup-modal" 
                            data-modal-toggle="popup-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 7h12M9 7v12m6-12v12M10 4h4a1 1 0 011 1v2H9V5a1 1 0 011-1z"/>
                            </svg>
                            Delete
                        </button>

                    </div>
                </td>

            </tr>
            <tr data-category="Technology" class="border-b border-gray-700 hover:bg-[#1a1f4a]">
                <td class="px-6 py-4">4</td>
                <td class="px-6 py-4">AI Workshop</td>
                <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs rounded-full bg-blue-500/20 text-blue-400">Technology</span></td>
                <td class="px-6 py-4">
                
                    <div class="flex gap-2">
                        <!-- EDIT -->
                        <button 
                        class="flex items-center gap-1 bg-green-500 px-3 py-1 rounded hover:bg-green-600 text-white"
                        data-modal-target="edit-modal"
                        data-modal-toggle="edit-modal"
                        data-title="AI Workshop"
                        data-category="Technology">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2m-1-1v2m6.707 2.293a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-4 1a1 1 0 01-1.213-1.213l1-4a1 1 0 01.242-.39l9-9a1 1 0 011.414 0z"/>
                            </svg>
                            Edit
                        </button>

                        <!-- DELETE -->
                        <button 
                            class="flex items-center gap-1 bg-red-500 px-3 py-1 rounded hover:bg-red-600 text-white"
                            data-modal-target="popup-modal" 
                            data-modal-toggle="popup-modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 7h12M9 7v12m6-12v12M10 4h4a1 1 0 011 1v2H9V5a1 1 0 011-1z"/>
                            </svg>
                            Delete
                        </button>

                    </div>
                </td>

            </tr>
        </tbody>

    </table>
</div>


<!-- MODAL CREATE -->
<div id="crud-modal" tabindex="-1"
class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/60 backdrop-blur-md">

    <div class="bg-[#0f1335] text-white rounded p-6 w-96 border border-gray-700">

        <h3 class="text-lg font-semibold mb-3">Add Category</h3>

        <form class="space-y-3">
            <input type="text" placeholder="Event Title"
                class="w-full p-2 rounded bg-gray-800 text-white">
            <input type="text" placeholder="Category Name"
                class="w-full p-2 rounded bg-gray-800 text-white">

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" data-modal-hide="crud-modal"
                    class="px-3 py-1 border rounded">Cancel</button>
                <button type="submit"
                    class="px-3 py-1 bg-blue-600 rounded">Submit</button>
            </div>
        </form>
    </div>
</div>


<!--MODAL EDIT -->
<div id="edit-modal" tabindex="-1"
class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black/60 backdrop-blur-md">

    <div class="bg-[#0f1335] text-white rounded p-6 w-96 border border-gray-700">

        <h3 class="text-lg font-semibold mb-3">Edit Category</h3>

        <form class="space-y-3">
            <input id="edit-title" type="text"
                class="w-full p-2 rounded bg-gray-800 text-white">
            <input id="edit-category" type="text"
                class="w-full p-2 rounded bg-gray-800 text-white">

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" data-modal-hide="edit-modal"
                    class="px-3 py-1 border rounded">Cancel</button>
                <button type="submit"
                    class="px-3 py-1 bg-green-600 rounded">Update</button>
            </div>
        </form>
    </div>
</div>


<!-- modal delete -->
<div id="popup-modal" tabindex="-1" class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/40 backdrop-blur-md">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-[#0f1335] border border-gray-700 rounded shadow p-4 md:p-6 text-white">
                <button type="button" class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-fg-disabled w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <h3 class="mb-6 text-body">Are you sure you want to delete this category from your website?</h3>
                <div class="flex items-center space-x-4 justify-center">
                    <button data-modal-hide="popup-modal" type="button" 
                        class="text-white bg-blue-500 box-border border border-transparent hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="popup-modal" type="button" 
                        class="text-white bg-red-500 box-border border border-transparent hover:bg-red-600 focus:ring-4 focus:ring-red-300 shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                        No, cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const editButtons = document.querySelectorAll("[data-modal-toggle='edit-modal']");

    editButtons.forEach(button => {
        button.addEventListener("click", function () {
            let title = this.getAttribute("data-title");
            let category = this.getAttribute("data-category");

            document.getElementById("edit-title").value = title;
            document.getElementById("edit-category").value = category;
        });
    });
});

function filterCategory(category) {
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        if (category === 'all') {
            row.style.display = '';
        } else {
            row.style.display = row.dataset.category === category ? '' : 'none';
        }
    });
}
</script>
</body>
</html>
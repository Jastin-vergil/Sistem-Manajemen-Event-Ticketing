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
        <h2 class="text-lg font-semibold text-center">Event List</h2>

    <div class="flex justify-end">
        <button 
            data-modal-target="crud-modal" 
            data-modal-toggle="crud-modal"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Create New Event
        </button>
    </div>
</div>

    <!-- TABLE -->
    <div class="bg-[#0f1335] border border-gray-700 rounded mb-6 overflow-x-auto">
        <table class="w-full text-sm text-left">
           <thead class="bg-[#1a1f4a] text-gray-300">
                <tr>
                    <th class="px-6 py-3">Event Title</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Time</th>
                    <th class="px-6 py-3">Location</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Photo</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-700 hover:bg-[#1a1f4a]">
                    <td class="px-6 py-4 font-medium text-gray-200">Festival Seni</td>
                    <td class="px-6 py-4 text-gray-200">Mari ramaikan festival seni, tempat berbagai karya mahasiswa Politeknik Negeri Batam </td>
                    <td class="px-6 py-4 text-gray-200">10-10-2026</td>
                    <td class="px-6 py-4 text-gray-200">18.30 WIB</td>
                    <td class="px-6 py-4 text-gray-200">Lapangan Politeknik Negeri Batam</td>
                    <td class="px-6 py-4 text-gray-200">Art & Design</td>
                    <td class="px-6 py-4 text-gray-200"><img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg" alt="Event Image" class="w-16 h-16 object-cover rounded-lg border border-gray-600"></td>
                    <td class="px-6 py-4 text-gray-200">
                        <div class="flex flex-col gap-2">
                        <div class="flex gap-2">
                        <button 
                            class="flex items-center gap-1 bg-green-500 px-3 py-1 rounded hover:bg-green-600 text-white"
                            data-modal-target="edit-modal"
                            data-modal-toggle="edit-modal"

                            data-judul="Festival Seni"
                            data-deskripsi="Mari ramaikan festival seni..."
                            data-tanggal="2026-10-10"
                            data-waktu="18:30"
                            data-lokasi="Lapangan Polibatam"
                            data-kategori="Art & Design"
                            data-foto="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2m-1-1v2m6.707 2.293a1 1 0 010 1.414l-9 9a1 1 0 01-.39.242l-4 1a1 1 0 01-1.213-1.213l1-4a1 1 0 01.242-.39l9-9a1 1 0 011.414 0z"/>
                            </svg>

                            Edit
                        </button>
                        <button 
                            data-modal-target="popup-modal" 
                            data-modal-toggle="popup-modal"
                            class="flex items-center gap-1 bg-red-500 px-3 py-1 rounded hover:bg-red-600 text-white">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 7h12M9 7v12m6-12v12M10 4h4a1 1 0 011 1v2H9V5a1 1 0 011-1z"/>
                            </svg>
                            Delete
                        </button>
                    </div>
                        <button 
                            data-modal-target="participant-modal" 
                            data-modal-toggle="participant-modal"
                            class="bg-blue-500 px-3 py-1 rounded hover:bg-blue-600 text-white text-sm">
                            Participant Details
                        </button>
                        <button 
                            data-modal-target="ticket-modal" 
                            data-modal-toggle="ticket-modal"
                            class="bg-yellow-400 px-3 py-1 rounded hover:bg-yellow-500 text-white text-sm">
                            Ticket Information
                        </button>
                    </div>
                    </td>
                    </div>
                </tr>
            </tbody>
        </table>
    </div>

<!-- MODAL -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/60 backdrop-blur-md">

    <div class="relative p-4 w-full max-w-md max-h-full">

        <!-- Modal content -->
        <div class="bg-[#0f1335] text-white rounded shadow-lg p-6 border border-gray-700">

            <!-- Header -->
            <div class="flex justify-between items-center border-b border-gray-700 pb-3">
                <h3 class="text-lg font-semibold text-white">
                    Add Event
                </h3>
                <button data-modal-hide="crud-modal" class="text-gray-500 hover:text-white">
                </button>
            </div>

            <!-- Body -->
            <form id="form-event" class="mt-4 space-y-3">
                <input id="judul" type="text" placeholder="Event Title"
                     class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <textarea id="deskripsi" placeholder="Description"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded"></textarea>
                <input id="tanggal" type="date" placeholder="Date"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <input id="waktu" type="time" placeholder="Time"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <input id="lokasi" type="text" placeholder="Location"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <select id="kategori" 
                class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                    <option>Select Category</option>
                    <option>Music</option>
                    <option>Technology</option>
                    <option>Art & Design</option>
                </select>
                <input type="file" placeholder="Photo"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <!-- Footer -->
                <div class="flex justify-end gap-2 pt-3">
                    <button type="button"
                        data-modal-hide="crud-modal"
                        class="px-4 py-2 border border-gray-600 rounded text-gray-300 hover:bg-gray-700">
                        Cancel
                    </button>

                    <button type="button"
                        data-modal-hide="crud-modal"
                        data-modal-target="crud-modal-2"
                        data-modal-toggle="crud-modal-2"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
      
<!-- MODAL 2 -->
<div id="crud-modal-2" tabindex="-1" aria-hidden="true"
class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/60 backdrop-blur-md">

    <div class="relative p-4 w-full max-w-md">
        <div class="bg-[#0f1335] text-white rounded shadow-lg p-6 border border-gray-700">

            <!-- HEADER -->
            <h3 class="text-lg font-semibold mb-3 text-white">
                Add Ticket
            </h3>

            <!-- FORM -->
            <form id="form-tiket" class="space-y-3">

                <input type="number" placeholder="Early Bird (Kuota)" min="0" required
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="text" placeholder="Rp 0"
                oninput="formatRupiah(this)"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="number" placeholder="Reguler (Kuota)" min="0" required
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="text" placeholder="Rp 0"
                oninput="formatRupiah(this)"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="number" placeholder="VIP (Kuota)" min="0" required
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="text" placeholder="Rp 0"
                oninput="formatRupiah(this)"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <!-- FOOTER -->
                <div class="flex justify-end gap-2 pt-3">

                    <button type="button"
                        data-modal-hide="crud-modal-2"
                        data-modal-target="crud-modal"
                        data-modal-toggle="crud-modal"
                        class="px-4 py-2 border border-gray-600 rounded text-gray-300 hover:bg-gray-700">
                        Back
                    </button>

                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Submit
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div id="edit-modal" tabindex="-1"
   class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-start overflow-y-auto w-full h-full bg-black/40 backdrop-blur-md">

  <div class="relative p-4 w-full max-w-md my-8">

   <div class="relative p-4 w-full max-w-md">
       <div class="bg-[#0f1335] text-white rounded shadow-lg p-6 border border-gray-700">
            <h3 class="text-lg font-semibold mb-3">Edit Ticket</h3>

            <form class="mt-4 space-y-3">
                <input id="edit-title" type="text" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <textarea id="edit-description" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded"></textarea>
                <input id="edit-date" type="date" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <input id="edit-time" type="time" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <input id="edit-location" type="text" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <select id="edit-category" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <option>Music</option>
                <option>Technology</option>
                <option>Art & Design</option>
                </select>

                <!-- Foto Lama -->
                <img id="preview-foto" src="" class="w-32 h-32 object-cover rounded mb-2">

                <!-- Upload Foto Baru -->
                <input id="edit-foto" type="file" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <!-- Footer -->
                <div class="flex justify-end gap-2 pt-3">
                    <button type="button"
                        data-modal-hide="edit-modal"
                        class="px-4 py-2 border rounded">
                        Cancel
                    </button>

                   <button type="button"
                        data-modal-hide="edit-modal"
                        data-modal-target="edit-ticket-modal"
                        data-modal-toggle="edit-ticket-modal"
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
      
<!-- MODAL EDIT TIKET -->
<div id="edit-ticket-modal" tabindex="-1"
class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full h-full bg-black/40 backdrop-blur-md">

    <div class="relative p-4 w-full max-w-md">
        <div class="bg-[#0f1335] text-white rounded shadow-lg p-6 border border-gray-700">
            <!-- HEADER -->
            <h3 class="text-lg font-semibold mb-3">Edit Ticket</h3>

            <!-- FORM -->
            <form class="space-y-3">

               <input type="number" placeholder="Early Bird (Kuota)" min="0" required 
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="text" placeholder="Rp 0" 
                oninput="formatRupiah(this)"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="number" placeholder="Reguler (Kuota)" min="0" required
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="text" placeholder="Rp 0" 
                oninput="formatRupiah(this)"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="number" placeholder="VIP (Kuota)" min="0" required
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <input type="text" placeholder="Rp 0" 
                oninput="formatRupiah(this)"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">

                <!-- FOOTER -->
                <div class="flex justify-end gap-2 pt-3">
                    <button type="button"
                        data-modal-hide="edit-ticket-modal"
                        class="px-4 py-2 border border-gray-600 bg-[#0b0f2a] text-white rounded">
                        Cancel
                    </button>

                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Update
                    </button>
                </div>

            </form>

        </div>
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
                <h3 class="mb-6 text-body">Are you sure you want to delete this event from your website?</h3>
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

<div id="participant-modal" tabindex="-1" aria-hidden="true"
class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full h-full bg-black/50 backdrop-blur-sm">

    <div class="relative w-full max-w-md p-4">

        <div class="bg-[#0f1335] text-white rounded-2xl shadow-lg border border-gray-700 p-4">

            <!-- HEADER -->
            <div class="flex justify-between items-center border-b border-gray-600 pb-2">
                <h3 class="text-lg font-semibold">Detail Peserta</h3>
                <button data-modal-hide="participant-modal" class="text-gray-400 hover:text-white">✕</button>
            </div>

            <!-- IMAGE -->
            <div class="flex justify-center mt-4">
                <div class="w-40 h-24 bg-gray-700 rounded-lg"></div>
            </div>

            <!-- EVENT INFO -->
            <div class="text-center mt-3">
                <p class="font-medium">Judul Event</p>
                <p class="text-sm text-gray-400">Total Peserta: 50</p>
            </div>

            <!-- SEARCH -->
            <div class="mt-4 relative">
                <input type="text" placeholder="Search Peserta"
                    class="w-full bg-gray-700 text-white rounded-full px-4 py-2 pr-10 outline-none">
                <span class="absolute right-3 top-2.5">🔍</span>
            </div>

            <!-- TABLE -->
            <div class="mt-4 max-h-48 overflow-y-auto rounded-lg border border-gray-600">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-700 text-gray-300">
                        <tr>
                            <th class="px-3 py-2">No</th>
                            <th class="px-3 py-2">Name</th>
                            <th class="px-3 py-2">Email</th>
                            <th class="px-3 py-2">Ticket</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-200">

                        <tr class="border-b border-gray-600">
                            <td class="px-3 py-2">1</td>
                            <td class="px-3 py-2">Anisya</td>
                            <td class="px-3 py-2">anisya@email.com</td>
                            <td class="px-3 py-2">VIP</td>
                        </tr>

                        <tr class="border-b border-gray-600">
                            <td class="px-3 py-2">2</td>
                            <td class="px-3 py-2">Reja</td>
                            <td class="px-3 py-2">reja@email.com</td>
                            <td class="px-3 py-2">Regular</td>
                        </tr>

                        <tr class="border-b border-gray-600">
                            <td class="px-3 py-2">3</td>
                            <td class="px-3 py-2">Ibnu</td>
                            <td class="px-3 py-2">ibnu@email.com</td>
                            <td class="px-3 py-2">Early Bird</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="flex flex-col items-center">
                <span class="text-sm text-body">
                    Showing <span class="font-semibold text-heading">1</span> to <span class="font-semibold text-heading">10</span> of <span class="font-semibold text-heading">100</span> Entries
                </span>
                <!-- Buttons -->
                <div class="inline-flex mt-4 -space-x-px">
                    <button type="button" class="inline-flex items-center text-body bg-neutral-secondary-medium border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading shadow-xs font-medium leading-5 rounded-s-base text-sm px-4 py-2.5 focus:outline-none">
                    <svg class="w-4 h-4 me-1.5 -ms-0.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4"/></svg>
                    Previous
                    </button>
                    <button type="button" class="inline-flex items-center text-body bg-neutral-secondary-medium border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading shadow-xs font-medium leading-5 rounded-e-base text-sm px-4 py-2.5 focus:outline-none">
                    Next
                    <svg class="w-4 h-4 ms-1.5 -me-0.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ticket-modal" tabindex="-1" aria-hidden="true"
class="hidden fixed top-0 left-0 right-0 z-50 flex justify-center items-center w-full h-full bg-black/50 backdrop-blur-sm">

    <div class="relative w-full max-w-md p-4">

        <div class="bg-[#0f1335] text-white rounded-2xl shadow-lg border border-gray-700 p-5">

            <!-- HEADER -->
            <div class="flex justify-between items-center border-b border-gray-600 pb-2">
                <h3 class="text-lg font-semibold">Informasi Tiket</h3>
                <button data-modal-hide="ticket-modal" class="text-gray-400 hover:text-white text-lg">✕</button>
            </div>

            <!-- IMAGE -->
            <div class="flex justify-center mt-4">
                <div class="w-40 h-24 bg-gray-700 rounded-lg"></div>
            </div>

            <!-- EVENT TITLE -->
            <div class="text-center mt-3">
                <p class="font-medium">Judul Event</p>
            </div>

            <!-- TICKET INFO -->
            <div class="mt-5 space-y-4">

                <!-- Early Bird -->
                <div class="bg-gray-800 rounded-lg p-3">
                    <p class="text-sm text-gray-400">Early Bird</p>
                    <p class="text-sm">Kuota: 50</p>
                    <p class="text-sm">Harga: Rp 50.000</p>
                </div>

                <!-- VIP -->
                <div class="bg-gray-800 rounded-lg p-3">
                    <p class="text-sm text-gray-400">VIP</p>
                    <p class="text-sm">Kuota: 20</p>
                    <p class="text-sm">Harga: Rp 150.000</p>
                </div>

                <!-- Regular -->
                <div class="bg-gray-800 rounded-lg p-3">
                    <p class="text-sm text-gray-400">Regular</p>
                    <p class="text-sm">Kuota: 100</p>
                    <p class="text-sm">Harga: Rp 75.000</p>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="flex justify-end mt-4">
                <button data-modal-hide="ticket-modal"
                    class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const editButtons = document.querySelectorAll('[data-modal-target="edit-modal"]');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {

            // ambil data dari button
            const judul = this.getAttribute('data-judul');
            const deskripsi = this.getAttribute('data-deskripsi');
            const tanggal = this.getAttribute('data-tanggal');
            const waktu = this.getAttribute('data-waktu');
            const lokasi = this.getAttribute('data-lokasi');
            const kategori = this.getAttribute('data-kategori');
            const foto = this.getAttribute('data-foto');

            // isi ke form modal
            document.getElementById('edit-title').value = judul;
            document.getElementById('edit-description').value = deskripsi;
            document.getElementById('edit-date').value = tanggal;
            document.getElementById('edit-time').value = waktu;
            document.getElementById('edit-location').value = lokasi;
            document.getElementById('edit-category').value = kategori;

            // preview foto
            document.getElementById('preview-foto').src = foto;
        });
    });

});
</script>
</body>
</html>
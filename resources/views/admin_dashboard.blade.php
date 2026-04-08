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

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-neutral-primary fixed w-full z-20 top-0 h-16 border-b border-default">
  <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">

    <!-- LOGO -->
    <a href="#" class="flex items-center space-x-3">
      <img src="https://www.polibatam.ac.id/wp-content/uploads/2021/09/logo.png" class="h-7" alt="logo" />
      <span class="text-xl font-semibold">Admin Dashboard</span>
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
      <div class="hidden bg-white border rounded shadow w-44 mt-2"
        id="user-dropdown">

        <div class="px-4 py-3 text-sm border-b">
          <p class="font-medium">Admin</p>
          <p class="text-gray-500 text-xs">anisya17@email.com</p>
        </div>

        <ul class="text-sm">
          <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a></li>
          <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Logout</a></li>
        </ul>

      </div>
    </div>

  </div>
</nav>


<!-- SIDEBAR -->
<aside class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-white border-r">
    <div class="h-full px-3 py-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <li><a href="#" class="block px-3 py-2 hover:bg-gray-200 rounded">Home</a></li>
            <li><a href="#" class="block px-3 py-2 hover:bg-gray-200 rounded">Daftar Event</a></li>
            <li><a href="#" class="block px-3 py-2 hover:bg-gray-200 rounded">Informasi Pembayaran</a></li>
        </ul>
    </div>
</aside>


<!-- CONTENT -->
<div class="ml-64 mt-16 p-6">

<!-- HEADER TABLE -->
    <div class="flex justify-between items-center p-4 border-b">
        <h2 class="text-lg font-semibold">Daftar Event</h2>
        <button 
                data-modal-target="crud-modal" 
                data-modal-toggle="crud-modal"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + Tambah Event
        </button>
    </div>

    <!-- TABLE -->
    <div class="bg-white shadow rounded border mb-6 overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3">Judul Event</th>
                    <th class="px-6 py-3">Deskripsi</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Waktu</th>
                    <th class="px-6 py-3">Lokasi</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Foto</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-6 py-4 font-medium">Festival Seni</td>
                    <td class="px-6 py-4">Mari ramaikan festival seni, tempat berbagai karya mahasiswa Politeknik Negeri Batam </td>
                    <td class="px-6 py-4">10-10-2026</td>
                    <td class="px-6 py-4">18.30 WIB</td>
                    <td class="px-6 py-4">Lapangan Politeknik Negeri Batam</td>
                    <td class="px-6 py-4">Non-Akademik</td>
                    <td class="px-6 py-4"><img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg" alt="Event Image" class="w-16 h-16 object-cover rounded"></td>
                    <td class="px-6 py-4">
                        <button class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Edit</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">Delete</button>
                    </td
                </tr>
            </tbody>
        </table>
    </div>

    <!-- CONTENT BOX -->
    <div class="p-4 border border-dashed rounded bg-white">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="h-24 bg-gray-200 rounded"></div>
            <div class="h-24 bg-gray-200 rounded"></div>
            <div class="h-24 bg-gray-200 rounded"></div>
        </div>

        <div class="h-48 bg-gray-200 rounded mb-4"></div>

        <div class="grid grid-cols-2 gap-4">
            <div class="h-24 bg-gray-200 rounded"></div>
            <div class="h-24 bg-gray-200 rounded"></div>
        </div>
    </div>

<!-- MODAL -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-white/80 backdrop-blur-sm">

    <div class="relative p-4 w-full max-w-md max-h-full">

        <!-- Modal content -->
        <div class="bg-white rounded shadow-lg p-6">

            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-3">
                <h3 class="text-lg font-semibold">
                    Tambah Event
                </h3>
                <button data-modal-hide="crud-modal" class="text-gray-500 hover:text-black">
                </button>
            </div>

            <!-- Body -->
            <form class="mt-4 space-y-3">
                <input type="text" placeholder="Nama Event"
                    class="w-full border p-2 rounded">

                <input type="number" placeholder="Harga"
                    class="w-full border p-2 rounded">

                <select class="w-full border p-2 rounded">
                    <option>Pilih Kategori</option>
                    <option>Seminar</option>
                    <option>Workshop</option>
                </select>

                <textarea placeholder="Deskripsi"
                    class="w-full border p-2 rounded"></textarea>

                <!-- Footer -->
                <div class="flex justify-end gap-2 pt-3">
                    <button type="button"
                        data-modal-hide="crud-modal"
                        class="px-4 py-2 border rounded">
                        Cancel
                    </button>

                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>div>

<!-- Modal toggle -->
<button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none" type="button">
  Toggle modal
</button>

<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-white/80 backdrop-blur-sm"></div>
    <div class="relative p-4 w-full max-w-md max-h-full">

        <!-- Modal content -->
        <div class="relative bg-white rounded shadow-lg p-4 md:p-6">

            <!-- Modal header -->
            <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-heading">
                    Create new product
                </h3>
                <button type="button" class="text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="crud-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form action="#">
                <div class="grid gap-4 grid-cols-2 py-4 md:py-6">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Name</label>
                        <input type="text" name="name" id="name" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="Type product name" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="price" class="block mb-2.5 text-sm font-medium text-heading">Price</label>
                        <input type="number" name="price" id="price" class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" placeholder="$2999" required="">
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="category" class="block mb-2.5 text-sm font-medium text-heading">Category</label>
                        <select id="category" class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body">
                            <option selected="">Select category</option>
                            <option value="TV">TV/Monitors</option>
                            <option value="PC">PC</option>
                            <option value="GA">Gaming/Console</option>
                            <option value="PH">Phones</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="description" class="block mb-2.5 text-sm font-medium text-heading">Product Description</label>
                        <textarea id="description" rows="4" class="block bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full p-3.5 shadow-xs placeholder:text-body" placeholder="Write product description here"></textarea>                    
                    </div>
                </div>
                <div class="flex items-center space-x-4 border-t border-default pt-4 md:pt-6">
                    <button type="submit" class="inline-flex items-center  text-white bg-brand hover:bg-brand-strong box-border border border-transparent focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                        <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/></svg>
                        Add new product
                    </button>
                    <button data-modal-hide="crud-modal" type="button" class="text-body bg-neutral-secondary-medium box-border border border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div> 
</div>

</body>
</html>
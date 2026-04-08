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
          <li><a href="login" class="block px-4 py-2 hover:bg-gray-100">Logout</a></li>
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
                <input type="text" placeholder="Judul Event"
                    class="w-full border p-2 rounded">
                <textarea placeholder="Deskripsi"
                    class="w-full border p-2 rounded"></textarea>
                <input type="date" placeholder="Tanggal"
                    class="w-full border p-2 rounded">
                <input type="time" placeholder="Waktu"
                    class="w-full border p-2 rounded">
                <input type="text" placeholder="Lokasi"
                    class="w-full border p-2 rounded">
                <select class="w-full border p-2 rounded">
                    <option>Pilih Kategori</option>
                    <option>Akademik</option>
                    <option>Non-Akademik</option>
                </select>
                <input type="file" placeholder="Foto"
                    class="w-full border p-2 rounded">
                </form>

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
</div>
</div>

</body>
</html>
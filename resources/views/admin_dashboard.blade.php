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
<nav class="bg-white fixed top-0 left-0 w-full z-50 h-16 shadow border-b border-default">
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
            <a href="{{ url('/admindashboard') }}" 
            class="block px-3 py-2 hover:bg-gray-200 rounded">
            Event List
            </a>
            <a href="{{ url('/informasipembayaran') }}" 
            class="block px-3 py-2 hover:bg-gray-200 rounded">
            Payment Information
            </a>
    </div>
</aside>


<!-- CONTENT -->
<div class="ml-64 mt-16 p-6">
    <!-- Welcome Card -->
<div class="bg-gray-200 rounded-2xl p-6 mb-6 shadow-sm">
    <h1 class="text-2xl font-bold text-gray-800">
        Welcome, Admin!
    </h1>
    <p class="text-sm text-gray-500 mt-1">
        Kelola event dan pantau pesanan dengan mudah melalui dashboard ini. 
    </p>
    <p class="text-sm text-gray-500 mt-1">
        Tambahkan event baru, edit informasi, dan pantau pesanan tiket dengan efisien.
    </p>
</div>

<!-- card event active and orders -->
    <div class="flex gap-6">
    <div class="bg-white rounded-2xl p-6 shadow w-full">
        <h2 class="text-lg font-semibold text-gray-700">
            Event Active
        </h2>
        <p class="text-3xl font-bold text-blue-600 mt-2">
            {{ $eventActive ?? 0 }}
        </p>
        <p class="text-sm text-gray-500">
            Total event yang sedang berjalan
        </p>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow w-full">
        <h2 class="text-lg font-semibold text-gray-700">
            Orders
        </h2>
        <p class="text-3xl font-bold text-green-600 mt-2">
            {{ $orders ?? 0 }}
        </p>
        <p class="text-sm text-gray-500">
            Jumlah pesanan tiket
        </p>
    </div>

</div>

<!-- HEADER TABLE -->
    <div class="flex justify-between items-center p-4 border-b">
        <h2 class="text-lg font-semibold">Daftar Event</h2>
        <button 
                data-modal-target="crud-modal" 
                data-modal-toggle="crud-modal"
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                + Create New Event
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
                         <div class="flex gap-2">
                        <button 
                            class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600"
                            data-modal-target="edit-modal"
                            data-modal-toggle="edit-modal"

                            data-judul="Festival Seni"
                            data-deskripsi="Mari ramaikan festival seni..."
                            data-tanggal="2026-10-10"
                            data-waktu="18:30"
                            data-lokasi="Lapangan Polibatam"
                            data-kategori="Non-Akademik"
                            data-foto="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg">
                            Edit
                        </button>
                        <button 
                            data-modal-target="popup-modal" 
                            data-modal-toggle="popup-modal"
                            class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                            Delete
                        </button>
                    </td>
                    </div>
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

                    <button type="button"
                        data-modal-hide="crud-modal"
                        data-modal-target="crud-modal-2"
                        data-modal-toggle="crud-modal-2"
                        class="bg-blue-500 text-white px-4 py-2 rounded">
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
      
<!-- MODAL 2 -->
<div id="crud-modal-2" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-white/80 backdrop-blur-sm">

    <div class="relative p-4 w-full max-w-md">
        <div class="bg-white rounded shadow-lg p-6">

            <h3 class="text-lg font-semibold mb-3">Tambah Tiket</h3>

            <form class="space-y-3">
                <input type="number" placeholder="Early Bird (Kuota)" class="w-full border p-2 rounded">
                <input type="number" placeholder="Harga Early Bird" class="w-full border p-2 rounded">

                <input type="number" placeholder="Reguler (Kuota)" class="w-full border p-2 rounded">
                <input type="number" placeholder="Harga Reguler" class="w-full border p-2 rounded">

                <input type="number" placeholder="VIP (Kuota)" class="w-full border p-2 rounded">
                <input type="number" placeholder="Harga VIP" class="w-full border p-2 rounded">

                <div class="flex justify-end gap-2 pt-3">
                    <button type="button"
                        data-modal-hide="crud-modal-2"
                        data-modal-target="crud-modal"
                        data-modal-toggle="crud-modal"
                        class="px-4 py-2 border rounded">
                        Back
                    </button>

                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded">
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
        <div class="bg-white rounded shadow-lg p-6">
            <h3 class="text-lg font-semibold mb-3">Edit Tiket</h3>

            <form class="mt-4 space-y-3">
                <input id="edit-judul" type="text" class="w-full border p-2 rounded">
                <textarea id="edit-deskripsi" class="w-full border p-2 rounded"></textarea>
                <input id="edit-tanggal" type="date" class="w-full border p-2 rounded">
                <input id="edit-waktu" type="time" class="w-full border p-2 rounded">
                <input id="edit-lokasi" type="text" class="w-full border p-2 rounded">
                <select id="edit-kategori" class="w-full border p-2 rounded">
                <option>Akademik</option>
                <option>Non-Akademik</option>
                </select>

                <!-- Foto Lama -->
                <img id="preview-foto" src="" class="w-32 h-32 object-cover rounded mb-2">

                <!-- Upload Foto Baru -->
                <input id="edit-foto" type="file" class="w-full border p-2 rounded">

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
        <div class="bg-white rounded shadow-lg p-6">

            <!-- HEADER -->
            <h3 class="text-lg font-semibold mb-3">Edit Tiket</h3>

            <!-- FORM -->
            <form class="space-y-3">

                <input type="number" placeholder="Early Bird (Kuota)"
                    class="w-full border p-2 rounded">

                <input type="number" placeholder="Harga Early Bird"
                    class="w-full border p-2 rounded">

                <input type="number" placeholder="Reguler (Kuota)"
                    class="w-full border p-2 rounded">

                <input type="number" placeholder="Harga Reguler"
                    class="w-full border p-2 rounded">

                <input type="number" placeholder="VIP (Kuota)"
                    class="w-full border p-2 rounded">

                <input type="number" placeholder="Harga VIP"
                    class="w-full border p-2 rounded">

                <!-- FOOTER -->
                <div class="flex justify-end gap-2 pt-3">
                    <button type="button"
                        data-modal-hide="edit-ticket-modal"
                        class="px-4 py-2 border rounded">
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
        <div class="relative bg-white border border-default rounded-base shadow-sm p-4 md:p-6">
                <button type="button" class="absolute top-3 end-2.5 text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading rounded-base text-sm w-9 h-9 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-fg-disabled w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                <h3 class="mb-6 text-body">Are you sure you want to delete this product from your account?</h3>
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

<!-- JS EDIT AUTO FILL -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-modal-target="edit-modal"]').forEach(button => {
        button.addEventListener('click', function () {

            document.getElementById('edit-judul').value = this.dataset.judul;
            document.getElementById('edit-deskripsi').value = this.dataset.deskripsi;
            document.getElementById('edit-tanggal').value = this.dataset.tanggal;
            document.getElementById('edit-waktu').value = this.dataset.waktu;
            document.getElementById('edit-lokasi').value = this.dataset.lokasi;
            document.getElementById('edit-kategori').value = this.dataset.kategori;

            document.getElementById('preview-foto').src = this.dataset.foto;
        });
    });
});
</script>

</body>
</html>
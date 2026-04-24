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
<aside class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-[#0f1335] border-r border-gray-700">
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
<div class="ml-64 mt-16 p-6 text-white">
    <!-- Welcome Card -->
<div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 mb-6 border border-white/10">
    <h1 class="text-2xl font-bold text-white">
        Welcome, Admin!
    </h1>
    <p class="text-sm text-gray-300">
        Kelola event dan pantau pesanan dengan mudah melalui dashboard ini. 
    </p>
    <p class="text-sm text-gray-300">
        Tambahkan event baru, edit informasi, dan pantau pesanan tiket dengan efisien.
    </p>
</div>

<!-- card event active and orders -->
    <div class="flex gap-6">
    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 border border-white/10 w-full">
        <h2 class="text-lg font-semibold text-gray-300">
            Event Active
        </h2>
        <p class="text-3xl font-bold text-blue-600 mt-2">
            {{ $eventActive ?? 0 }}
        </p>
        <p class="text-sm text-gray-400">
            Total event yang sedang berjalan
        </p>
    </div>

    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 border border-white/10 w-full">
        <h2 class="text-lg font-semibold text-gray-300">
            Orders
        </h2>
        <p class="text-3xl font-bold text-green-600 mt-2">
            {{ $orders ?? 0 }}
        </p>
        <p class="text-sm text-gray-400">
            Jumlah pesanan tiket
        </h2>
    </div>

</div>

<!-- HEADER TABLE -->
   <div class="flex flex-col gap-3 p-4 border-b">
    <h2 class="text-lg font-semibold text-center">Daftar Event</h2>

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
                <tr class="border-b border-gray-700 hover:bg-[#1a1f4a]">
                    <td class="px-6 py-4 font-medium text-gray-200">Festival Seni</td>
                    <td class="px-6 py-4 text-gray-200">Mari ramaikan festival seni, tempat berbagai karya mahasiswa Politeknik Negeri Batam </td>
                    <td class="px-6 py-4 text-gray-200">10-10-2026</td>
                    <td class="px-6 py-4 text-gray-200">18.30 WIB</td>
                    <td class="px-6 py-4 text-gray-200">Lapangan Politeknik Negeri Batam</td>
                    <td class="px-6 py-4 text-gray-200">Art & Design</td>
                    <td class="px-6 py-4 text-gray-200"><img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg" alt="Event Image" class="w-16 h-16 object-cover rounded-lg border border-gray-600"></td>
                    <td class="px-6 py-4 text-gray-200">
                         <div class="flex gap-2">
                        <button 
                            class="bg-green-500 px-3 py-1 rounded hover:bg-green-600 text-white"
                            data-modal-target="edit-modal"
                            data-modal-toggle="edit-modal"

                            data-judul="Festival Seni"
                            data-deskripsi="Mari ramaikan festival seni..."
                            data-tanggal="2026-10-10"
                            data-waktu="18:30"
                            data-lokasi="Lapangan Polibatam"
                            data-kategori="Art & Design"
                            data-foto="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg">
                            Edit
                        </button>
                        <button 
                            data-modal-target="popup-modal" 
                            data-modal-toggle="popup-modal"
                            class="bg-red-500 px-3 py-1 rounded hover:bg-red-600 text-white">
                            Delete
                        </button>
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
                    Tambah Event
                </h3>
                <button data-modal-hide="crud-modal" class="text-gray-500 hover:text-white">
                </button>
            </div>

            <!-- Body -->
            <form id="form-event" class="mt-4 space-y-3">
                <input id="judul" type="text" placeholder="Judul Event"
                     class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <textarea id="deskripsi" placeholder="Deskripsi"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded"></textarea>
                <input id="tanggal" type="date" placeholder="Tanggal"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <input id="waktu" type="time" placeholder="Waktu"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <input id="lokasi" type="text" placeholder="Lokasi"
                    class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <select id="kategori" 
                class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                    <option>Pilih Kategori</option>
                    <option>Music</option>
                    <option>Technology</option>
                    <option>Art & Design</option>
                </select>
                <input type="file" placeholder="Foto"
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
                Tambah Tiket
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
            <h3 class="text-lg font-semibold mb-3">Edit Tiket</h3>

            <form class="mt-4 space-y-3">
                <input id="edit-judul" type="text" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <textarea id="edit-deskripsi" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded"></textarea>
                <input id="edit-tanggal" type="date" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <input id="edit-waktu" type="time" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <input id="edit-lokasi" type="text" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <select id="edit-kategori" class="w-full border border-gray-600 bg-[#0b0f2a] text-white p-2 rounded">
                <option>Music</option>
                <option>Techonlogy</option>
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
            <h3 class="text-lg font-semibold mb-3">Edit Tiket</h3>

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

<script>
// FORMAT RUPIAH
function formatRupiah(el) {
    let value = el.value.replace(/[^0-9]/g, '');

    if (value === '') {
        el.value = '';
        return;
    }

    let rupiah = new Intl.NumberFormat('id-ID').format(value);
    el.value = 'Rp ' + rupiah;
}

// SIMPAN DATA EVENT
function saveEvent() {
    let event = {
        judul: document.querySelector('input[placeholder="Judul Event"]').value,
        deskripsi: document.querySelector('textarea[placeholder="Deskripsi"]').value,
        tanggal: document.querySelector('input[type="date"]').value,
        waktu: document.querySelector('input[type="time"]').value,
        lokasi: document.querySelector('input[placeholder="Lokasi"]').value,
    };

    localStorage.setItem('eventData', JSON.stringify(event));
}

// LOAD DATA KE FORM 
function loadEvent() {
    let data = localStorage.getItem('eventData');
    if (!data) return;

    let event = JSON.parse(data);

    document.querySelector('input[placeholder="Judul Event"]').value = event.judul;
    document.querySelector('textarea[placeholder="Deskripsi"]').value = event.deskripsi;
    document.querySelector('input[type="date"]').value = event.tanggal;
    document.querySelector('input[type="time"]').value = event.waktu;
    document.querySelector('input[placeholder="Lokasi"]').value = event.lokasi;
}

// AUTO FILL EDIT MODAL 
document.addEventListener('DOMContentLoaded', function () {

    // FORM EVENT
    const form = document.getElementById('form-event');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); 

        let eventData = {
            judul: document.getElementById('judul').value,
            deskripsi: document.getElementById('deskripsi').value,
            tanggal: document.getElementById('tanggal').value,
            waktu: document.getElementById('waktu').value,
            lokasi: document.getElementById('lokasi').value,
        };

        localStorage.setItem('eventData', JSON.stringify(eventData));
        console.log("Data tersimpan:", eventData);
        form.reset();
    });

    // FORM TIKET
    const formTiket = document.getElementById('form-tiket');

    formTiket.addEventListener('submit', function(e) {
        e.preventDefault();

        let eventData = {
            judul: document.getElementById('judul').value,
            deskripsi: document.getElementById('deskripsi').value,
            tanggal: document.getElementById('tanggal').value,
            waktu: document.getElementById('waktu').value,
            lokasi: document.getElementById('lokasi').value,
        };

        localStorage.setItem('eventData', JSON.stringify(eventData));

        console.log("Data tersimpan dari tiket:", eventData);
    });

});
</script>
</body>
</html>
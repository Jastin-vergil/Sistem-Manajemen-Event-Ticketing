<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('app.css') }}" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Event Ticketing System</title>
    <style>

        body{
            margin:0;
            font-family: Arial;
            background-color:#f4f4f4;
        }

        .navbar{
            background:#333;
            padding:15px;
        }

        .navbar a{
            color:white;
            text-decoration:none;
            margin-right:20px;
            font-weight:bold;
        }

        .container{
            padding:30px;
        }

    </style>

</head>

<body>

<div class="navbar">
    <a href="/">Home</a>
    <a href="/dashboard">Dashboard</a>
    <a href="/events">Events</a>
    <a href="/tickets">Tickets</a>
    <a href="/contact">Contact</a>
    <a href="/login">Login</a>
</div>

<div class="container">

    <h1>Dashboard Pengunjung</h1>
    <p>Selamat datang di Sistem Manajemen Event & Ticketing</p>

</div>

<div class="p-6">
  <div class="bg-white shadow-lg rounded-xl p-5 w-80">
    <h2 class="text-xl font-semibold">Music Festival 2026</h2>
    <p class="text-gray-500">12 Desember 2026</p>

    <button 
      onclick="openModal()" 
      class="mt-3 bg-blue-500 text-white px-4 py-2 rounded-lg">
      Lihat Detail
    </button>
  </div>
</div>

<div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
  <div class="bg-white rounded-xl p-6 w-96 relative">
    
    <!-- Tombol Close -->
    <button onclick="closeModal()" class="absolute top-2 right-3 text-gray-500 text-xl">
      &times;
    </button>

    <!-- Isi Modal -->
    <img src="{{ asset('img/oioioi.jpeg') }}">
    <h2 class="text-2xl font-bold mb-2 text-center">Music Festival 2026</h2>
    <p class="text-gray-500 mb-3 text-center">tanggal: 12 Desember 2026</p>
    <p class="text-gray-500 mb-3 text-center">Waktu: 10:00 AM</p>
    <p class="text-gray-500 mb-3 text-center">Lokasi: Lapangan Polibatam</p>

    <p class="mb-4 text-center">
      Event musik terbesar tahun ini dengan berbagai artis terkenal.
    </p>

    <button onclick="window.location='{{ route('ticket') }}'">
    Confirm
    </button>
  </div>
</div>

<script>
function openModal() {
  document.getElementById("modal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("modal").classList.add("hidden");
}
</script>

</body>
</html>
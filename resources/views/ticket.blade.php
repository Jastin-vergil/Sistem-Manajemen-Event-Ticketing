<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Form</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-r from-[#0f172a] to-[#020617] text-white min-h-screen">

    <!-- Navbar -->
    <div class="flex justify-between items-center px-10 py-5">
        <div class="text-xl font-bold text-purple-400">Tixly</div>
        <div class="space-x-8 text-gray-300">
            <a href="#" class="hover:text-white">Menu 1</a>
            <a href="#" class="hover:text-white">Menu 2</a>
            <a href="#" class="hover:text-white">Menu 3</a>
        </div>
    </div>

    <!-- Form -->
    <div class="flex justify-center items-center mt-20">
        <div class="bg-white/5 backdrop-blur-md border border-white/10 p-10 rounded-2xl shadow-xl w-full max-w-md">

            <h2 class="text-2xl font-semibold text-center mb-6">
                🎟 Ticket Form
            </h2>

            <form action="{{ route('payment') }}" method="GET" class="space-y-4">

                <!-- Name -->
                <input
                    type="text"
                    name="name"
                    placeholder="Enter Your Name"
                    class="w-full h-11 px-4 rounded-lg bg-transparent border border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 outline-none"
                    required
                >

                <!-- Email -->
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your E-Mail"
                    class="w-full h-11 px-4 rounded-lg bg-transparent border border-gray-600 text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 outline-none"
                    required
                >

                <!-- Ticket -->
                <select
                    name="ticket_type"
                    class="w-full h-11 px-4 rounded-lg bg-transparent border border-gray-600 text-gray-300 focus:ring-2 focus:ring-purple-500 outline-none"
                    required
                >
                    <option value="" class="text-black">Select Ticket Type</option>
                    <option value="early_bird" class="text-black">Early Bird - Rp 50.000</option>
                    <option value="regular" class="text-black">Regular - Rp 100.000</option>
                    <option value="vip" class="text-black">VIP - Rp 200.000</option>
                </select>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full h-11 bg-purple-600 hover:bg-purple-700 transition rounded-lg font-semibold"
                >
                    Confirm
                </button>

            </form>

        </div>
    </div>

</body>
</html>
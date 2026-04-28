<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

    <!-- Container -->
    <div class="flex justify-center items-center mt-16">
        <div class="bg-white/5 backdrop-blur-md border border-white/10 p-8 rounded-2xl shadow-xl w-full max-w-lg">

            <h2 class="text-xl font-semibold text-center mb-6">
                💳 Ticket Payment
            </h2>

            <form action="{{ route('payment.confirm') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Total Payment -->
                <input 
                    type="text" 
                    value="Total Payment: Rp {{ request('ticket_type') == 'vip' ? '200000' : '100000' }}"
                    class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200"
                    readonly
                >

                <!-- Payment Method -->
                <input 
                    type="text" 
                    value="Payment Method: QRIS"
                    class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200"
                    readonly
                >

                <!-- QR Code -->
                <div class="flex justify-center">
                    <div class="w-48 h-48 bg-white/10 border border-gray-600 flex items-center justify-center rounded-lg">
                        <span class="text-gray-400">QR Code</span>
                    </div>
                </div>

                <p class="text-center text-sm text-gray-400">
                    Scan QR with E-Wallet or Mobile Banking
                </p>

                <p class="text-xs text-center text-red-400">
                    Note: If the time limit is exceeded, the transaction will fail.
                </p>

                <p class="text-center font-semibold text-purple-400">
                    Remaining Time: 4:59 Minute(s)
                </p>

                <!-- Upload -->
                <div>
                    <label class="text-sm font-medium text-gray-300">
                        Upload Proof of Payment
                    </label>
                    <input 
                        type="file" 
                        name="proof"
                        class="w-full mt-1 text-sm border border-gray-600 rounded-lg p-2 bg-white/10 text-gray-300"
                        required
                    >
                </div>

                <!-- Button -->
                <button 
                    type="submit"
                    class="w-full h-11 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition"
                >
                    Confirm Payment
                </button>

            </form>

        </div>
    </div>

</body>
</html>
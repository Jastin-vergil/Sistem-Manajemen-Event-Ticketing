<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-[#0f172a] to-[#020617] text-white min-h-screen">

    <!-- Navbar -->
    <div>
        <header>
            @include('components.header')
        </header>
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
                    value="Payment Method: BCA - 8080123456"
                    class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200"
                    readonly
                >

                <div class="bg-indigo-900/40 border border-indigo-500/30 p-4 rounded-xl text-sm text-gray-300 text-center">
                    📌 Open your Mobile Banking, add this account to your transfer list, then transfer the exact amount and save the receipt.
                </div>

                <p class="text-center font-semibold text-purple-400">
                    Remaining Time: 4:59 Minute(s)
                </p>

                <div class="bg-red-900/30 border border-red-500/40 text-red-300 text-xs p-3 rounded-lg text-center mt-2">
                    ⚠️ Payment will be automatically cancelled if the time limit is exceeded.
                </div>

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

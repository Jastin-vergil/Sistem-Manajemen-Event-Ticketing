<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-400 to-cyan-400 min-h-screen">

    <!-- Navbar -->
    <div class="bg-white shadow-md flex justify-between px-10 py-4">
        <div class="font-bold">Event Polibatam</div>
        <div class="space-x-6">
            <a href="#" class="hover:text-blue-500">History</a>
            <a href="#" class="hover:text-blue-500">Home</a>
            <a href="#" class="hover:text-blue-500">Events</a>
            <a href="#" class="hover:text-blue-500">Contact</a>
        </div>
    </div>

    <!-- Container -->
    <div class="flex justify-center items-center mt-16">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">

            <h2 class="text-xl font-semibold text-center mb-6">
                💳 Ticket Payment
            </h2>

            <form action="{{ route('payment.confirm') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Total Payment -->
                <input 
                    type="text" 
                    value="Total Payment: Rp {{ request('ticket_type') == 'vip' ? '200000' : '100000' }}"
                    class="w-full h-11 px-4 rounded-lg border border-gray-300 bg-gray-100"
                    readonly
                >

                <!-- Payment Method -->
                <input 
                    type="text" 
                    value="Payment Method: QRIS"
                    class="w-full h-11 px-4 rounded-lg border border-gray-300 bg-gray-100"
                    readonly
                >

                <!-- QR Code -->
                <div class="flex justify-center">
                    <div class="w-48 h-48 bg-gray-300 flex items-center justify-center rounded-lg">
                        QR Code
                    </div>
                </div>

                <p class="text-center text-sm text-gray-600">
                    Scan QR with E-Wallet or Mobile Banking
                </p>

                <p class="text-xs text-center text-red-500">
                    Note: If the time limit is exceeded, the transaction will fail.
                </p>

                <p class="text-center font-semibold">
                    Remaining Time: 4:59 Minute(s)
                </p>

                <!-- Upload -->
                <div>
                    <label class="text-sm font-medium">Upload Proof of Payment</label>
                    <input 
                        type="file" 
                        name="proof"
                        class="w-full mt-1 text-sm border border-gray-300 rounded-lg p-2 bg-white"
                        required
                    >
                </div>

                <!-- Button -->
                <button 
                    type="submit"
                    class="w-full h-11 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition"
                >
                    Confirm Payment
                </button>

            </form>

        </div>
    </div>

</body>
</html>
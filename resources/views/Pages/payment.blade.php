<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-[#0f172a] to-[#020617] text-white min-h-screen overflow-y-auto">

    <!-- Navbar -->
    <div>
        <header>
            @include('components.navbar')
        </header>
    </div>

    <!-- Container -->
    <div class="flex justify-center items-center mt-16">
        <div class="bg-white/5 backdrop-blur-md border border-white/10 p-8 rounded-2xl shadow-xl w-full max-w-lg">

            <h2 class="text-xl font-semibold text-center mb-6">
                💳 Ticket Payment
            </h2>

            <!-- FORM -->
            <form id="paymentForm" class="space-y-4" enctype="multipart/form-data">
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

                <!-- Remaining Time -->
                <p class="text-center font-semibold text-purple-400">
                    Remaining Time: 4:59 Minute(s)
                </p>

                <!-- Warning -->
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
                        id="proof"
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

    <!-- SUCCESS MODAL -->
    <!-- SUCCESS MODAL -->
<div id="successModal"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden justify-center items-center z-50">

    <div class="bg-[#111827]/90 border border-purple-500/30 backdrop-blur-xl rounded-2xl p-8 w-[90%] max-w-md shadow-2xl text-center animate-fadeIn">

        <div class="text-5xl mb-4">
            ⏳
        </div>

        <h2 class="text-2xl font-bold text-white mb-2">
            Waiting for Admin Confirmation
        </h2>

        <p class="text-gray-300 text-sm mb-6">
            Your payment proof has been uploaded successfully. 
            Please wait while the admin verifies your payment transaction.
        </p>

        <div class="bg-yellow-900/30 border border-yellow-500/40 text-yellow-300 text-xs p-3 rounded-lg mb-5">
            📌 Ticket status will appear in your transaction history after admin confirmation.
        </div>

        <button
            onclick="closeModal()"
            class="w-full h-11 bg-purple-600 hover:bg-purple-700 transition rounded-lg font-semibold"
        >
            Close
        </button>

    </div>
</div>

    <!-- SCRIPT -->
    <script>
        const form = document.getElementById('paymentForm');
        const modal = document.getElementById('successModal');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const proof = document.getElementById('proof').files.length;

            if (proof > 0) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        });

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

    <!-- ANIMATION -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.25s ease;
        }
    </style>

</body>
</html>
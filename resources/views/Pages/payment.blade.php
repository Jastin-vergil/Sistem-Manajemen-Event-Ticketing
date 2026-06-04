<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Payment</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

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
</head>

<body class="bg-gradient-to-r from-[#0f172a] to-[#020617] text-white min-h-screen overflow-y-auto">

    <!-- Navbar -->
    <header>
        @include('components.navbar')
    </header>

    <!-- PRICE LOGIC -->
    @php

        $ticketType = request('ticket_type');

        $prices = [
            'early_bird' => 50000,
            'regular' => 100000,
            'vip' => 200000,
        ];

        $price = $prices[$ticketType] ?? 0;

    @endphp

    <!-- Container -->
    <div class="flex justify-center items-center mt-16 px-4">

        <div class="bg-white/5 backdrop-blur-md border border-white/10 p-8 rounded-2xl shadow-xl w-full max-w-lg">

            <h2 class="text-xl font-semibold text-center mb-6">
                💳 Ticket Payment
            </h2>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="bg-green-900/30 border border-green-500/40 text-green-300 text-sm p-3 rounded-lg mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FORM -->
            <form
    id="paymentForm"
    action="{{ route('payment.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-4"
>
    @csrf

    <div>
        <label class="text-xs text-gray-400 font-medium pl-1">Participant Name</label>
        <input
            type="text"
            name="nama_peserta"
            value="{{ request('name') }}"
            class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1"
            readonly
        >
    </div>

    <div>
        <label class="text-xs text-gray-400 font-medium pl-1">Email Address</label>
        <input
            type="text"
            name="email"
            value="{{ request('email') }}"
            class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1"
            readonly
        >
    </div>

    <div>
        <label class="text-xs text-gray-400 font-medium pl-1">Selected Ticket</label>
        <input
            type="text"
            value="{{ ucwords(str_replace('_', ' ', request('ticket_type'))) }}"
            class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1"
            readonly
        >
    </div>

    <div>
        <label class="text-xs text-gray-400 font-medium pl-1">Total Amount</label>
        <input
            type="text"
            value="Rp {{ number_format($price, 0, ',', '.') }}"
            class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1"
            readonly
        >
    </div>

    <div>
        <label class="text-xs text-gray-400 font-medium pl-1">Transfer Bank</label>
        <input
            type="text"
            value="BCA - 8080123456"
            class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1"
            readonly
        >
    </div>

    <div class="bg-indigo-900/40 border border-indigo-500/30 p-4 rounded-xl text-sm text-gray-300 text-center">
        📌 Open your Mobile Banking, add this account to your transfer list,
        then transfer the exact amount and save the receipt.
    </div>

    <p class="text-center font-semibold text-purple-400">
        Remaining Time:
        <span id="countdown">05:00</span>
    </p>

    <div class="bg-red-900/30 border border-red-500/40 text-red-300 text-xs p-3 rounded-lg text-center">
        ⚠️ Payment will be automatically cancelled if the time limit is exceeded.
    </div>

    <div>
        <label class="text-sm font-medium text-gray-300">
            Upload Proof of Payment
        </label>

        <input
            type="file"
            name="proof"
            id="proof"
            accept="image/*,.pdf"
            class="w-full mt-1 text-sm border border-gray-600 rounded-lg p-2 bg-white/10 text-gray-300"
            required
        >

        @error('proof')
            <p class="text-red-400 text-xs mt-1">
                {{ $message }}
            </p>
        @enderror
    </div>

    <input type="hidden" name="ticket_type" value="{{ request('ticket_type') }}">
    <input type="hidden" name="price" value="{{ $price }}">

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

        /*
        |--------------------------------------------------------------------------
        | Countdown Timer
        |--------------------------------------------------------------------------
        */

        let time = 300;

        const countdown = document.getElementById('countdown');

        const timer = setInterval(() => {

            let minutes = Math.floor(time / 60);
            let seconds = time % 60;

            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            countdown.innerHTML = `${minutes}:${seconds}`;

            time--;

            if (time < 0) {

                clearInterval(timer);

                alert('Payment time expired.');

                window.location.href = "/";
            }

        }, 1000);

        /*
        |--------------------------------------------------------------------------
        | Modal
        |--------------------------------------------------------------------------
        */

        const form = document.getElementById('paymentForm');
        const modal = document.getElementById('successModal');

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            const proof = document.getElementById('proof').files.length;

            if (proof > 0) {

                modal.classList.remove('hidden');
                modal.classList.add('flex');

                setTimeout(() => {
                    form.submit();
                }, 1000);
            }
        });

        function closeModal() {

            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

    </script>

</body>
</html>
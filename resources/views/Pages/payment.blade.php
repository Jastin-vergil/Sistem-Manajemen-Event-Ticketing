<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Payment</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fadeIn { animation: fadeIn 0.25s ease; }
    </style>
</head>

<body class="bg-gradient-to-r from-[#0f172a] to-[#020617] text-white min-h-screen overflow-y-auto">

    <!-- Navbar -->
    <header>
        @include('components.navbar')
    </header>

    <!-- PRICE LOGIC -->
    @php
        use App\Models\Tiket;
        $tiketId = request('ticket_type');
        $tiket = Tiket::find($tiketId);
        $price = $tiket ? $tiket->harga : 0;
        $namaTicket = $tiket ? $tiket->nama_tiket : '-';
    @endphp

    <!-- Container -->
    <div class="flex justify-center items-center mt-16 px-4">
        <div class="bg-white/5 backdrop-blur-md border border-white/10 p-8 rounded-2xl shadow-xl w-full max-w-lg">

            {{-- Title --}}
            <h2 class="text-xl font-semibold text-center mb-6 flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:22px;height:22px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
                Ticket Payment
            </h2>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="bg-green-900/30 border border-green-500/40 text-green-300 text-sm p-3 rounded-lg mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FORM -->
            <form id="paymentForm" action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="text-xs text-gray-400 font-medium pl-1">Participant Name</label>
                    <input type="text" name="nama_peserta" value="{{ request('name') }}"
                        class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1" readonly>
                </div>

                <div>
                    <label class="text-xs text-gray-400 font-medium pl-1">Email Address</label>
                    <input type="text" name="email" value="{{ request('email') }}"
                        class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1" readonly>
                </div>

                <div>
                    <label class="text-xs text-gray-400 font-medium pl-1">Selected Ticket</label>
                    <input type="text" value="{{ $namaTicket }}"
                        class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1" readonly>
                </div>

                <div>
                    <label class="text-xs text-gray-400 font-medium pl-1">Total Amount</label>
                    <input type="text" value="Rp {{ number_format($price, 0, ',', '.') }}"
                        class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1" readonly>
                </div>

                <div>
                    <label class="text-xs text-gray-400 font-medium pl-1">Transfer Bank</label>
                    <input type="text" value="BCA - 8080123456"
                        class="w-full h-11 px-4 rounded-lg bg-white/10 border border-gray-600 text-gray-200 mt-1" readonly>
                </div>

                {{-- Info box --}}
                <div class="bg-indigo-900/40 border border-indigo-500/30 p-4 rounded-xl text-sm text-gray-300 flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px;flex-shrink:0;margin-top:2px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <span>Open your Mobile Banking, add this account to your transfer list, then transfer the exact amount and save the receipt.</span>
                </div>

                <p class="text-center font-semibold text-indigo-400">
                    Remaining Time: <span id="countdown">05:00</span>
                </p>

                {{-- Warning box --}}
                <div class="bg-red-900/30 border border-red-500/40 text-red-300 text-xs p-3 rounded-lg flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;flex-shrink:0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                    Payment will be automatically cancelled if the time limit is exceeded.
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-300">Upload Proof of Payment</label>
                    <input type="file" name="proof" id="proof" accept="image/*,.pdf"
                        class="w-full mt-1 text-sm border border-gray-600 rounded-lg p-2 bg-white/10 text-gray-300" required>
                    @error('proof')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <input type="hidden" name="ticket_type" value="{{ request('ticket_type') }}">
                <input type="hidden" name="price" value="{{ $price }}">

                <button type="submit"
                    class="w-full h-11 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                    Confirm Payment
                </button>
            </form>
        </div>
    </div>

    <!-- SUCCESS MODAL -->
    <div id="successModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden justify-center items-center z-50">
        <div class="bg-[#111827]/90 border border-purple-500/30 backdrop-blur-xl rounded-2xl p-8 w-[90%] max-w-md shadow-2xl text-center animate-fadeIn">

            {{-- Clock icon --}}
            <div class="flex justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:52px;height:52px;color:#a78bfa" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-white mb-2">Waiting for Admin Confirmation</h2>

            <p class="text-gray-300 text-sm mb-6">
                Your payment proof has been uploaded successfully.
                Please wait while the admin verifies your payment transaction.
            </p>

            {{-- Info box modal --}}
            <div class="bg-yellow-900/30 border border-yellow-500/40 text-yellow-300 text-xs p-3 rounded-lg mb-5 flex items-start gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;flex-shrink:0;margin-top:1px" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                </svg>
                Ticket status will appear in your transaction history after admin confirmation.
            </div>

            <button onclick="closeModal()"
                class="w-full h-11 bg-indigo-600 hover:bg-indigo-700 transition rounded-lg font-semibold">
                Close
            </button>
        </div>
    </div>

    <script>
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
                window.location.href = "/userdashboard";
            }
        }, 1000);

        const form = document.getElementById('paymentForm');
        const modal = document.getElementById('successModal');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const proof = document.getElementById('proof').files.length;
            if (proof > 0) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                setTimeout(() => { form.submit(); }, 1000);
            }
        });

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>

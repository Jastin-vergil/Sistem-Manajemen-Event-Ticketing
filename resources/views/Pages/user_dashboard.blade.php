<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polibatam Event Hub - Global Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: #0b0e29;
            color: white;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

        #scroll-wrapper {
            display: flex;
            gap: 24px;
            padding: 20px;
            cursor: grab;
            overflow-x: auto;
            user-select: none;
            scroll-behavior: smooth;
        }

        #scroll-wrapper:active {
            cursor: grabbing;
        }

        .event-card {
            flex: 0 0 300px;
            min-width: 300px;
        }

        .glass {
            background: rgba(30, 27, 75, 0.4);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 24px;
            transition: border 0.3s ease;
        }

        .glass:hover {
            border-color: rgba(99, 102, 241, 0.5);
        }
    </style>
</head>

<body>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-bold">Latest Events</h2>
                <p class="text-indigo-400 italic">Click and drag to explore events</p>
            </div>
            <select id="filter"
                class="w-full md:w-64 bg-indigo-950 border border-indigo-800 text-white rounded-xl p-3 outline-none">
                <option value="all">All Categories</option>
                @foreach ($kategori as $kat)
                    <option value="{{ $kat->nama_kategori }}">
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="scroll-wrapper"></div>
    </main>

    <!-- MODAL -->
        <div id="modal" class="fixed inset-0 bg-black/70 hidden items-start justify-center z-[60] overflow-y-auto p-6 pt-24">
            <div class="glass w-full max-w-md p-6 relative my-auto">

                <!-- Close -->
                <button onclick="closeModal()" class="absolute top-3 right-4 text-gray-400 hover:text-white text-xl z-10">
                    ✕
                </button>

                <!-- Gambar -->
                <div
                    class="w-full max-h-[40vh] bg-black/30 rounded-xl mb-4 overflow-hidden flex items-center justify-center">
                    <img id="modal-img" class="max-w-full max-h-[40vh] object-contain">
                </div>

            <h2 id="modal-title" class="text-2xl font-bold mb-4"></h2>

            <div class="space-y-2 text-sm text-gray-300">
                <p class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;flex-shrink:0" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    <b>Date:</b> <span id="modal-date"></span>
                </p>
                <p class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;flex-shrink:0" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <b>Time:</b> <span id="modal-time"></span>
                </p>
                <p class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;height:16px;flex-shrink:0" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <b>Location:</b> <span id="modal-loc"></span>
                </p>
            </div>

            <p id="modal-desc" class="mt-4 text-gray-400 text-sm"></p>

            <div class="mt-4">
                <h4 class="text-sm font-semibold text-gray-300 mb-2">Jenis Tiket</h4>
                <div id="modal-tiket-list" class="space-y-2"></div>
            </div>

            <!-- BUY BUTTON -->
            <button onmousedown="goToTicket()"
                class="w-full mt-6 bg-purple-600 hover:bg-purple-700 transition py-2 rounded-xl font-semibold flex items-center justify-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:18px;height:18px" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
                Buy Ticket
            </button>

        </div>
    </div>

    <script>
        const eventData = @json($events);
        console.log(eventData);

        const wrapper = document.getElementById('scroll-wrapper');
        const filter = document.getElementById('filter');
        const modal = document.getElementById('modal');

        // RENDER
        const renderEvents = (category = 'all') => {
        const filteredData = eventData.filter(ev =>
            category === 'all' ||
            ev.kategori && ev.kategori.nama_kategori === category
        );

        wrapper.innerHTML = filteredData.map(ev => {
            const tikets = ev.tiket || [];

            // Total sisa kuota dari semua jenis tiket
            const totalSisa = tikets.reduce((sum, t) => sum + (t.kuota - t.terjual), 0);

            // Harga termurah (untuk ditampilkan "mulai dari")
            const hargaTermurah = tikets.length
                ? Math.min(...tikets.map(t => t.harga))
                : null;

            const hargaText = hargaTermurah !== null
                ? 'Start from Rp ' + hargaTermurah.toLocaleString('id-ID')
                : 'Price is not available';

            const kuotaText = tikets.length
                ? (totalSisa > 0 ? `Remaining ${totalSisa} ticket(s)` : 'Sold Out')
                : 'Ticket is not available';

            const kuotaBadgeClass = totalSisa > 0
                ? 'bg-emerald-600'
                : 'bg-red-600';

            return `
                <div class="event-card">
                    <div class="glass overflow-hidden h-full flex flex-col">

                        <img src="/storage/${ev.foto}"
                            class="w-full h-52 object-cover pointer-events-none">

                        <div class="p-6 flex-grow flex flex-col">

                            <div class="flex items-center justify-between gap-2">
                                <span class="text-[10px] font-bold bg-indigo-600 px-2 py-1 rounded uppercase w-fit">
                                    ${ev.kategori ? ev.kategori.nama_kategori : "-"}
                                </span>
                                <span class="text-[10px] font-bold ${kuotaBadgeClass} px-2 py-1 rounded uppercase w-fit">
                                    ${kuotaText}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold mt-3">
                                ${ev.nama}
                            </h3>

                            <p class="text-slate-400 text-sm mt-2">
                                ${ev.lokasi}
                            </p>

                            <p class="text-indigo-300 text-sm font-semibold mt-1">
                                ${hargaText}
                            </p>

                            <button onclick='openModal(${JSON.stringify(ev)})'
                                class="w-full mt-auto bg-white text-indigo-950 font-bold py-2 rounded-xl hover:bg-indigo-500 hover:text-white transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
    };

        // MODAL
        const openModal = (ev) => {
        document.getElementById('modal-title').innerText = ev.nama;
        const tanggal = new Date(ev.tanggal);
        document.getElementById('modal-date').innerText =
            tanggal.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });

        const start = ev.jam_mulai ? ev.jam_mulai.substring(0, 5) : 'WIB';
        const end = ev.jam_selesai ? ev.jam_selesai.substring(0, 5) : 'Selesai';
        document.getElementById('modal-time').innerText = `${start} - ${end} WIB`;

        document.getElementById('modal-loc').innerText = ev.lokasi;
        document.getElementById('modal-desc').innerText = ev.deskripsi;

        document.getElementById('modal-img').src =
            `/storage/${ev.foto}`;

        // Render jenis tiket
        const tikets = ev.tiket || [];
        const tiketList = document.getElementById('modal-tiket-list');
        if (tikets.length) {
            tiketList.innerHTML = tikets.map(t => {
                const sisa = t.kuota - t.terjual;
                const habis = sisa <= 0;
                return `
                    <div class="flex items-center justify-between border border-indigo-800 rounded-lg px-3 py-2">
                        <div>
                            <p class="font-semibold text-sm">${t.nama_tiket}</p>
                            <p class="text-xs text-gray-400">Rp ${Number(t.harga).toLocaleString('id-ID')}</p>
                        </div>
                        <span class="text-xs font-bold px-2 py-1 rounded ${habis ? 'bg-red-600' : 'bg-emerald-600'}">
                            ${habis ? 'Habis' : `Sisa ${sisa}`}
                        </span>
                    </div>
                `;
            }).join('');
        } else {
            tiketList.innerHTML = `<p class="text-sm text-gray-500">Belum ada tiket tersedia.</p>`;
        }

        window.selectedEvent = ev;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    };

        const closeModal = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };
        const goToTicket = () => {
            const eventId = window.selectedEvent.id_event
            window.location.href = `{{ route('ticket.form') }}?event=${eventId}`;
        };

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        // DRAG KIRI KANAN
        let isDown = false,
            startX, scrollLeft;

        const startDrag = (e) => {
            isDown = true;
            const pageX = e.pageX || e.touches[0].pageX;
            startX = pageX - wrapper.offsetLeft;
            scrollLeft = wrapper.scrollLeft;
            wrapper.style.scrollBehavior = 'auto';
        };

        const stopDrag = () => isDown = false;

        const moveDrag = (e) => {
            if (!isDown) return;
            e.preventDefault();
            const pageX = e.pageX || e.touches[0].pageX;
            const x = pageX - wrapper.offsetLeft;
            const walk = (x - startX) * 2;
            wrapper.scrollLeft = scrollLeft - walk;
        };

        wrapper.addEventListener('mousedown', startDrag);
        wrapper.addEventListener('touchstart', startDrag);
        window.addEventListener('mouseup', stopDrag);
        window.addEventListener('touchend', stopDrag);
        wrapper.addEventListener('mousemove', moveDrag);
        wrapper.addEventListener('touchmove', moveDrag);

        filter.addEventListener('change', (e) => {
            wrapper.style.scrollBehavior = 'smooth';
            wrapper.scrollLeft = 0;
            renderEvents(e.target.value);
        });

        renderEvents();
    </script>
</body>

</html>

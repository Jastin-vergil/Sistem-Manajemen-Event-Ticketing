<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polibatam Event Hub - Global Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: #0b0e29; color: white; overflow-x: hidden; font-family: 'Inter', sans-serif; }

        #scroll-wrapper {
            display: flex; gap: 24px; padding: 20px; cursor: grab;
            overflow-x: hidden; user-select: none; scroll-behavior: smooth;
        }
        #scroll-wrapper:active { cursor: grabbing; }

        .event-card { flex: 0 0 300px; min-width: 300px; }

        .glass {
            background: rgba(30, 27, 75, 0.4);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(99, 102, 241, 0.2);
            border-radius: 24px;
            transition: border 0.3s ease;
        }
        .glass:hover { border-color: rgba(99, 102, 241, 0.5); }
    </style>
</head>
<body>

    <main class="max-w-7xl mx-auto px-6 py-16">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-bold">Latest Events</h2>
                <p class="text-indigo-400 italic">Click and drag to explore events</p>
            </div>
            <select id="filter" class="w-full md:w-64 bg-indigo-950 border border-indigo-800 text-white rounded-xl p-3 outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="all">All Categories</option>
                <option value="music">Music</option>
                <option value="tech">Technology</option>
                <option value="art">Art & Design</option>
            </select>
        </div>

        <div id="scroll-wrapper"></div>
    </main>

    <!-- MODAL -->
    <div id="modal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50">
        <div class="glass w-full max-w-md p-6 relative">

            <!-- Close -->
            <button onclick="closeModal()" class="absolute top-3 right-4 text-gray-400 hover:text-white text-xl">
                ✕
            </button>

            <!-- Gambar -->
            <img id="modal-img" class="w-full h-48 object-cover rounded-xl mb-4">

            <h2 id="modal-title" class="text-2xl font-bold mb-4"></h2>

            <div class="space-y-2 text-sm text-gray-300">
                <p><b>📅 Date:</b> <span id="modal-date"></span></p>
                <p><b>⏰ Time:</b> <span id="modal-time"></span></p>
                <p><b>📍 Location:</b> <span id="modal-loc"></span></p>
            </div>

            <p id="modal-desc" class="mt-4 text-gray-400 text-sm"></p>

            <!-- BUY BUTTON -->
            <button onclick="goToTicket()"
                class="w-full mt-6 bg-purple-600 hover:bg-purple-700 transition py-2 rounded-xl font-semibold">
                🎟 Buy Ticket
            </button>

        </div>
    </div>

    <script>
        // DATA EVENT
        const eventData = [
            {
                title: "Batam Retro Night",
                cat: "music",
                img: "1470225620780-dba8ba36b745",
                loc: "Polibatam Plaza",
                date: "10 Mei 2026",
                time: "19:00 WIB",
                desc: "Nikmati malam penuh musik retro dengan DJ terbaik di Batam."
            },
            {
                title: "Laravel Workshop",
                cat: "tech",
                img: "1591453089816-0fbb971b454c",
                loc: "Tower Building, 3rd Floor",
                date: "12 Mei 2026",
                time: "09:00 WIB",
                desc: "Belajar Laravel dari dasar hingga membuat aplikasi nyata."
            },
            {
                title: "Creative Expo",
                cat: "art",
                img: "1547826039-bfc35e0f1ea8",
                loc: "Main Auditorium",
                date: "15 Mei 2026",
                time: "10:00 WIB",
                desc: "Pameran karya seni dan desain dari mahasiswa kreatif."
            },
            {
                title: "Cyber Security Talk",
                cat: "tech",
                img: "1550751827-4bd374c3f58b",
                loc: "Computer Lab",
                date: "18 Mei 2026",
                time: "13:00 WIB",
                desc: "Diskusi keamanan digital dan tren cyber security terbaru."
            },
            {
                title: "Midnight Jazz",
                cat: "music",
                img: "1511671782779-c97d3d27a1d4",
                loc: "Campus Hall",
                date: "20 Mei 2026",
                time: "20:00 WIB",
                desc: "Pertunjukan jazz malam hari dengan suasana santai dan elegan."
            }
        ];

        const wrapper = document.getElementById('scroll-wrapper');
        const filter = document.getElementById('filter');
        const modal = document.getElementById('modal');

        // RENDER
        const renderEvents = (category = 'all') => {
            const filteredData = eventData.filter(ev => category === 'all' || ev.cat === category);

            wrapper.innerHTML = filteredData.map(ev => `
                <div class="event-card">
                    <div class="glass overflow-hidden h-full flex flex-col">
                        <img src="https://images.unsplash.com/photo-${ev.img}?w=400" class="w-full h-52 object-cover pointer-events-none">
                        <div class="p-6 flex-grow flex flex-col">
                            <span class="text-[10px] font-bold bg-indigo-600 px-2 py-1 rounded uppercase w-fit">${ev.cat}</span>
                            <h3 class="text-xl font-bold mt-3">${ev.title}</h3>
                            <p class="text-slate-400 text-sm mt-2">${ev.loc}</p>
                            <button onclick='openModal(${JSON.stringify(ev)})'
                                class="w-full mt-auto bg-white text-indigo-950 font-bold py-2 rounded-xl hover:bg-indigo-500 hover:text-white transition-colors">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        };

        // MODAL
        const openModal = (ev) => {
            document.getElementById('modal-title').innerText = ev.title;
            document.getElementById('modal-date').innerText = ev.date;
            document.getElementById('modal-time').innerText = ev.time;
            document.getElementById('modal-loc').innerText = ev.loc;
            document.getElementById('modal-desc').innerText = ev.desc;

            document.getElementById('modal-img').src =
                `https://images.unsplash.com/photo-${ev.img}?w=600`;

            window.selectedEvent = ev;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };

        const closeModal = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };

        const goToTicket = () => {
            const eventName = encodeURIComponent(window.selectedEvent.title);
            window.location.href = `{{ route('ticket') }}?event=${eventName}`;
        };

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        // DRAG
        let isDown = false, startX, scrollLeft;

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

        // FILTER
        filter.addEventListener('change', (e) => {
            wrapper.style.scrollBehavior = 'smooth';
            wrapper.scrollLeft = 0;
            renderEvents(e.target.value);
        });

        // INIT
        renderEvents();
    </script>
</body>
</html>
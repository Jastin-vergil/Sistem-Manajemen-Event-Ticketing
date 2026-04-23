<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polibatam Event Hub - Global Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: #0b0e29; color: white; overflow-x: hidden; font-family: 'Inter', sans-serif; }

        /* Drag Container Styles */
        #scroll-wrapper {
            display: flex; gap: 24px; padding: 20px; cursor: grab;
            overflow-x: hidden; user-select: none; scroll-behavior: smooth;
        }
        #scroll-wrapper:active { cursor: grabbing; }

        /* Card Constraints */
        .event-card { flex: 0 0 300px; min-width: 300px; }

        /* Glassmorphism Effect */
        .glass {
            background: rgba(30, 27, 75, 0.4); backdrop-filter: blur(12px);
            border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 24px;
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

    <script>
        // 1. DATA CENTER
        const eventData = [
            { title: "Batam Retro Night", cat: "music", img: "1470225620780-dba8ba36b745", loc: "Polibatam Plaza" },
            { title: "Laravel Workshop", cat: "tech", img: "1591453089816-0fbb971b454c", loc: "Tower Building, 3rd Floor" },
            { title: "Creative Expo", cat: "art", img: "1547826039-bfc35e0f1ea8", loc: "Main Auditorium" },
            { title: "Cyber Security Talk", cat: "tech", img: "1550751827-4bd374c3f58b", loc: "Computer Lab" },
            { title: "Midnight Jazz", cat: "music", img: "1511671782779-c97d3d27a1d4", loc: "Campus Hall" }
        ];

        const wrapper = document.getElementById('scroll-wrapper');
        const filter = document.getElementById('filter');

        // 2. RENDER FUNCTION
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
                            <button class="w-full mt-auto bg-white text-indigo-950 font-bold py-2 rounded-xl hover:bg-indigo-500 hover:text-white transition-colors">View Details</button>
                        </div>
                    </div>
                </div>
            `).join('');
        };

        // 3. DRAG LOGIC (Optimized for Mouse & Touch)
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

        // Event Listeners
        wrapper.addEventListener('mousedown', startDrag);
        wrapper.addEventListener('touchstart', startDrag);
        window.addEventListener('mouseup', stopDrag);
        window.addEventListener('touchend', stopDrag);
        wrapper.addEventListener('mousemove', moveDrag);
        wrapper.addEventListener('touchmove', moveDrag);

        // Filter Logic
        filter.addEventListener('change', (e) => {
            wrapper.style.scrollBehavior = 'smooth';
            wrapper.scrollLeft = 0;
            renderEvents(e.target.value);
        });

        // Initial Load
        renderEvents();
    </script>
</body>
</html>

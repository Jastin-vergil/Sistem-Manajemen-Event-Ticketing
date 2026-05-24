<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminDashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
</head>
<body class="bg-[#05071a] text-white min-h-screen">

<!-- NAVBAR -->
<nav class="bg-[#0b0f2a] p-4 border-b border-gray-700">

    <div class="flex justify-between items-center">

        <h1 class="text-2xl font-bold">
            Admin Dashboard
        </h1>

        <a href="/login"
        class="bg-red-500 px-4 py-2 rounded">
            Logout
        </a>

    </div>

</nav>

<!-- CONTENT -->
<div class="p-6">

    <!-- CARD -->
    <div class="grid grid-cols-2 gap-6 mb-6">

        <div class="bg-[#0f1335] p-6 rounded-xl border border-gray-700">
            <h2 class="text-lg text-gray-300">
                Event Active
            </h2>

            <p class="text-3xl font-bold text-blue-500 mt-2">
                {{ $eventActive }}
            </p>
        </div>

        <div class="bg-[#0f1335] p-6 rounded-xl border border-gray-700">
            <h2 class="text-lg text-gray-300">
                Orders
            </h2>

            <p class="text-3xl font-bold text-green-500 mt-2">
                {{ $orders }}
            </p>
        </div>

    </div>

    <!-- BUTTON -->
    <div class="flex justify-end mb-4">

        <button
            onclick="document.getElementById('modal').classList.remove('hidden')"
            class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">

            + Create Event

        </button>

    </div>

    <!-- TABLE -->
    <div class="bg-[#0f1335] rounded-xl border border-gray-700 overflow-x-auto">

        <table class="w-full text-sm text-left">

            <thead class="bg-[#1a1f4a]">

                <tr>

                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Time</th>
                    <th class="px-6 py-3">Location</th>
                    <th class="px-6 py-3">Category</th>
                    <th class="px-6 py-3">Photo</th>

                </tr>

            </thead>

            <tbody>

                @foreach($events as $event)

                <tr class="border-b border-gray-700">

                    <td class="px-6 py-4">
                        {{ $event->title }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $event->description }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $event->date }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $event->time }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $event->location }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $event->category }}
                    </td>

                    <td class="px-6 py-4">

                        <img
                            src="{{ asset('images/'.$event->photo) }}"
                            class="w-20 h-20 rounded-lg object-cover">

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

<!-- MODAL -->
<div
id="modal"
class="hidden fixed inset-0 bg-black/70 flex justify-center items-center">

    <div class="bg-[#0f1335] p-6 rounded-xl w-[500px] border border-gray-700">

        <div class="flex justify-between items-center mb-4">

            <h2 class="text-xl font-bold">
                Add Event
            </h2>

            <button
            onclick="document.getElementById('modal').classList.add('hidden')">
                ✕
            </button>

        </div>

        <form
            action="{{ url('/events') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-4">

            @csrf

            <input
                type="text"
                name="title"
                placeholder="Event Title"
                class="w-full p-2 rounded bg-[#05071a] border border-gray-600">

            <textarea
                name="description"
                placeholder="Description"
                class="w-full p-2 rounded bg-[#05071a] border border-gray-600"></textarea>

            <input
                type="date"
                name="date"
                class="w-full p-2 rounded bg-[#05071a] border border-gray-600">

            <input
                type="time"
                name="time"
                class="w-full p-2 rounded bg-[#05071a] border border-gray-600">

            <input
                type="text"
                name="location"
                placeholder="Location"
                class="w-full p-2 rounded bg-[#05071a] border border-gray-600">

            <select
                name="category"
                class="w-full p-2 rounded bg-[#05071a] border border-gray-600">

                <option>Music</option>
                <option>Technology</option>
                <option>Art & Design</option>

            </select>

            <input
                type="file"
                name="photo"
                class="w-full p-2 rounded bg-[#05071a] border border-gray-600">

            <button
                type="submit"
                class="w-full bg-blue-500 py-2 rounded hover:bg-blue-600">

                Save Event

            </button>

        </form>

    </div>

</div>

</body>
</html>

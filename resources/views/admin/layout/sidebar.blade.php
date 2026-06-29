<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Tixly</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
@keyframes gradientMove {
            0% {
                background-position: 0% center;
            }

            100% {
                background-position: 200% center;
            }
            }
</style>
<body style="background:#0f1117; font-family:sans-serif; font-size:15px; color:#cbd5e1; min-height:100vh">

    <div style="display:flex; min-height:100vh">

        {{-- ===================== SIDEBAR ===================== --}}
        <aside style="
            width: 240px;
            background: #1a1d2e;
            border-right: 1px solid #2a2d3e;
            position: fixed;
            height: 100%;
            display: flex;
            flex-direction: column;
            z-index: 20;
        ">

            {{-- Logo --}}
            <div style="padding: 24px 20px; border-bottom: 1px solid #2a2d3e">
                <div style="display:flex; align-items:center; gap:12px">
                    <div>
                        <h1 class="font-bold text-3xl text-transparent bg-clip-text tracking-wide animate-[gradientMove_3s_ease_infinite]"
                            style="font-family: 'Montserrat', sans-serif; background-image: linear-gradient(90deg, #7e22ce, #4f46e5, #a855f7, #7e22ce); background-size: 200% auto; -webkit-background-clip: text;">
                            TIXLY
                        </h1>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <nav style="flex:1; padding: 16px 0">
                <p style="font-size 20px; text-transform:uppercase; letter-spacing:0.1em; color:#4b5563; padding: 16px 20px 8px">
                    Menu
                </p>

                {{-- Tickets --}}
                <a href="{{ route('admin.ticket.interface') }}"
                    class="flex items-center gap-3 border-l-2 transition-all duration-150 no-underline
                    {{ request()->routeIs('admin.ticket.*')
                        ? 'border-indigo-500 bg-indigo-500/10 text-indigo-400'
                        : 'border-transparent text-gray-400 hover:text-gray-200 hover:bg-white/5' }}"
                    style="padding: 12px 20px; font-size:15px">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:18px; height:18px; flex-shrink:0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                    </svg>
                    Tickets
                </a>

                {{-- Events --}}
                <a href="{{ route('admin.event.index') }}"
                    class="flex items-center gap-3 border-l-2 transition-all duration-150 no-underline
                    {{ request()->routeIs('admin.event.*')
                        ? 'border-indigo-500 bg-indigo-500/10 text-indigo-400'
                        : 'border-transparent text-gray-400 hover:text-gray-200 hover:bg-white/5' }}"
                    style="padding: 12px 20px; font-size:15px">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:18px; height:18px; flex-shrink:0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    Events
                </a>

                {{-- Categories --}}
                <a href="{{ route('admin.kategori.index') }}"
                    class="flex items-center gap-3 border-l-2 transition-all duration-150 no-underline
                    {{ request()->routeIs('admin.kategori.*')
                        ? 'border-indigo-500 bg-indigo-500/10 text-indigo-400'
                        : 'border-transparent text-gray-400 hover:text-gray-200 hover:bg-white/5' }}"
                    style="padding: 12px 20px; font-size:15px">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:18px; height:18px; flex-shrink:0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                    Categories
                </a>

                {{-- Payments --}}
                <a href="{{ route('admin.pembayaran.index') }}"
                    class="flex items-center gap-3 border-l-2 transition-all duration-150 no-underline
                    {{ request()->routeIs('admin.pembayaran.*')
                        ? 'border-indigo-500 bg-indigo-500/10 text-indigo-400'
                        : 'border-transparent text-gray-400 hover:text-gray-200 hover:bg-white/5' }}"
                    style="padding: 12px 20px; font-size:15px">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:18px; height:18px; flex-shrink:0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                    </svg>
                    Payments
                </a>
            </nav>

            {{-- Logout --}}
            <div style="padding: 16px 20px; border-top: 1px solid #2a2d3e">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        style="
                            width: 100%;
                            display: flex;
                            align-items: center;
                            gap: 10px;
                            padding: 10px 12px;
                            background: transparent;
                            border: none;
                            color: #f87171;
                            font-size: 15px;
                            cursor: pointer;
                            border-radius: 8px;
                            transition: all .15s;
                        "
                        onmouseover="this.style.background='rgba(248,113,113,0.1)'"
                        onmouseout="this.style.background='transparent'">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:18px; height:18px; flex-shrink:0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>

        </aside>
        {{-- ===================== END SIDEBAR ===================== --}}


        {{-- ===================== MAIN CONTENT ===================== --}}
        <main style="margin-left: 240px; flex:1; display:flex; flex-direction:column">

            {{-- Topbar --}}
            <div style="
                background: #1a1d2e;
                border-bottom: 1px solid #2a2d3e;
                padding: 18px 28px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                position: sticky;
                top: 0;
                z-index: 10;
            ">
                <h1 style="font-weight:600; color:#fff; font-size:17px">@yield('heading')</h1>
                <div style="display:flex; gap:8px">@yield('topbar-actions')</div>
            </div>

            {{-- Success Alert --}}
            @if (session('success'))
                <div style="
                    margin: 20px 28px 0;
                    padding: 14px 18px;
                    background: rgba(52,211,153,0.1);
                    border: 1px solid rgba(52,211,153,0.2);
                    border-radius: 12px;
                    color: #34d399;
                    font-size: 14px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                ">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:18px; height:18px; flex-shrink:0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Alert --}}
            @if ($errors->any())
                <div style="
                    margin: 20px 28px 0;
                    padding: 14px 18px;
                    background: rgba(248,113,113,0.1);
                    border: 1px solid rgba(248,113,113,0.2);
                    border-radius: 12px;
                    color: #f87171;
                    font-size: 14px;
                ">
                    <ul style="list-style:disc; padding-left:18px; margin:0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Page Content --}}
            <div style="padding: 28px; display:flex; flex-direction:column; gap:24px">
                @yield('content')
            </div>

        </main>
        {{-- ===================== END MAIN CONTENT ===================== --}}

    </div>

</body>

</html>

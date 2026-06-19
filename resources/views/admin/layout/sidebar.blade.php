<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Tixly</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body style="background:#0f1117;font-family:sans-serif;font-size:14px;color:#cbd5e1;min-height:100vh">

    <div style="display:flex;min-height:100vh">
        <aside
            style="width:210px;background:#1a1d2e;border-right:1px solid #2a2d3e;position:fixed;top:0;left:0;height:100%;display:flex;flex-direction:column;z-index:20">
            <div style="padding:20px;border-bottom:1px solid #2a2d3e">
                <p style="font-weight:600;color:#fff;font-size:15px">🎫 Tixly</p>
                <p style="font-size:11px;color:#4b5563;margin-top:2px">Admin Panel</p>
            </div>
            <nav style="flex:1;padding:12px 0">
                <p class="text-[10px] uppercase tracking-wider text-gray-600 px-5 pt-4 pb-1">
                    Menu
                </p>

                <a href="{{ route('admin.ticket.interface') }}"
                    class="flex items-center gap-2.5 px-5 py-2.5 border-l-2 transition-all duration-150 no-underline
    {{ request()->routeIs('admin.ticket.*')
        ? 'border-indigo-500 bg-indigo-500/10 text-indigo-400'
        : 'border-transparent text-gray-500 hover:text-gray-300' }}">
                    🎟️ Tickets
                </a>

                <a href="{{ route('admin.event.index') }}"
                    class="flex items-center gap-2.5 px-5 py-2.5 border-l-2 transition-all duration-150 no-underline
                    {{ request()->routeIs('admin.event.*')
                    ? 'border-indigo-500 bg-indigo-500/10 text-indigo-400'
                    : 'border-transparent text-gray-500 hover:text-gray-300' }}">
                    📅 Events
                </a>

                <a href="{{ route('admin.kategori.index') }}"
                    class="flex items-center gap-2.5 px-5 py-2.5 border-l-2 transition-all duration-150 no-underline
                    {{ request()->routeIs('admin.kategori.*')
                    ? 'border-indigo-500 bg-indigo-500/10 text-indigo-400'
                    : 'border-transparent text-gray-500 hover:text-gray-300' }}">
                    🏷️ Categories
                </a>

                <a href="{{ route('admin.pembayaran.index') }}"
                    class="flex items-center gap-2.5 px-5 py-2.5 border-l-2 transition-all duration-150 no-underline
                    {{ request()->routeIs('admin.pembayaran.*')
                    ? 'border-indigo-500 bg-indigo-500/10 text-indigo-400'
                    : 'border-transparent text-gray-500 hover:text-gray-300' }}">
                    💳 Payments
                </a>
            </nav>
            <div style="padding:16px 20px;border-top:1px solid #2a2d3e">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        style="width:100%;display:flex;align-items:center;gap:10px;padding:8px 12px;background:transparent;border:none;color:#f87171;font-size:13px;cursor:pointer;border-radius:8px;transition:all .15s"
                        onmouseover="this.style.background='rgba(248,113,113,0.1)'"
                        onmouseout="this.style.background='transparent'">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN -->
        <main style="margin-left:210px;flex:1;display:flex;flex-direction:column">
            <div
                style="background:#1a1d2e;border-bottom:1px solid #2a2d3e;padding:16px 24px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:10">
                <h1 style="font-weight:600;color:#fff;font-size:15px">@yield('heading')</h1>
                <div style="display:flex;gap:8px">@yield('topbar-actions')</div>
            </div>

            @if (session('success'))
                <div
                    style="margin:16px 24px 0;padding:12px 16px;background:rgba(52,211,153,0.1);border:1px solid rgba(52,211,153,0.2);border-radius:12px;color:#34d399;font-size:13px;display:flex;align-items:center;gap:8px">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    style="margin:16px 24px 0;padding:12px 16px;background:rgba(248,113,113,0.1);border:1px solid rgba(248,113,113,0.2);border-radius:12px;color:#f87171;font-size:13px">
                    <ul style="list-style:disc;padding-left:16px">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div style="padding:24px;display:flex;flex-direction:column;gap:24px">
                @yield('content')
            </div>
        </main>
    </div>

</body>

</html>

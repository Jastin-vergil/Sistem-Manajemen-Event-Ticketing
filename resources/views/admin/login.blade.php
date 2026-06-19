<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/app.css" rel="stylesheet" />
    <title>Admin Login - Tixly</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: radial-gradient(circle at 20% 20%, #1e1335 0%, #120b24 60%, #0a0617 100%);
        }

        .glow-border {
            background: linear-gradient(135deg, #a855f7 0%, #7c3aed 45%, #4c1d95 100%);
        }

        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.25);
        }

        .brand-panel {
            background: radial-gradient(circle at 30% 20%, #2a1a4a 0%, #1a1030 55%, #0f0820 100%);
        }
    </style>
</head>

<body class="flex font-poppins items-center justify-center min-w-screen min-h-screen px-4">

    <div class="grid gap-8 w-full max-w-3xl">
        <div id="back-div" class="glow-border rounded-[26px] m-2 shadow-2xl">
            <div class="border-[16px] border-transparent rounded-[20px] bg-[#150e28] shadow-lg overflow-hidden">
                <div class="flex flex-col md:flex-row">

                    <!--Branding -->
                    <div
                        class="brand-panel hidden md:flex md:w-2/5 flex-col items-center justify-center p-8 text-center">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 via-purple-600 to-violet-800 flex items-center justify-center shadow-lg mb-4">
                            <span class="text-white text-3xl font-bold"
                                style="font-family: 'Montserrat', sans-serif;">T</span>
                        </div>
                        <h1 class="font-bold text-2xl bg-gradient-to-r from-purple-300 to-violet-400 text-transparent bg-clip-text tracking-wide"
                            style="font-family: 'Montserrat', sans-serif;">
                            TIXLY
                        </h1>
                        <p class="text-gray-400 text-sm mt-2">
                            Kelola event, tiket, dan pembayaran dalam satu dashboard admin.
                        </p>
                    </div>

                    <!--Form Login -->
                    <div class="w-full md:w-3/5 p-8 sm:p-10">

                        <div class="mb-6 md:hidden flex flex-col items-center">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 via-purple-600 to-violet-800 flex items-center justify-center shadow-lg mb-3">
                                <span class="text-white text-2xl font-bold"
                                    style="font-family: 'Montserrat', sans-serif;">T</span>
                            </div>
                        </div>

                        <h2 class="font-bold text-2xl text-white mb-1" style="font-family: 'Montserrat', sans-serif;">
                            Admin Login
                        </h2>

                        @if (session('error'))
                            <div
                                class="mb-5 p-3 bg-red-500/10 border border-red-500/40 text-red-400 rounded-lg text-sm text-center font-medium">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.login.submit') }}" method="post" class="space-y-4">
                            @csrf

                            <div>
                                <label for="email" class="block mb-2 text-gray-300 text-sm font-medium">Email</label>
                                <input id="email" name="email" value="{{ old('email') }}"
                                    class="input-glow border @error('email') border-red-500 @else border-purple-900/40 @enderror bg-[#1d1438] text-gray-200 p-3 placeholder:text-gray-500 rounded-lg w-full focus:outline-none focus:border-purple-500 transition duration-300"
                                    type="email" placeholder="admin@tixly.com" required autofocus />
                                @error('email')
                                    <p class="mt-1.5 text-red-400 text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password"
                                    class="block mb-2 text-gray-300 text-sm font-medium">Password</label>
                                <div class="relative">
                                    <input id="password" name="password"
                                        class="input-glow border @error('password') border-red-500 @else border-purple-900/40 @enderror bg-[#1d1438] text-gray-200 pr-14 p-3 placeholder:text-gray-500 rounded-lg w-full focus:outline-none focus:border-purple-500 transition duration-300"
                                        type="password" placeholder="••••••••" required />
                                    <button type="button" id="togglePassword"
                                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-purple-400 text-xs font-semibold transition">
                                        <span id="toggleLabel">Show</span>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1.5 text-red-400 text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                class="bg-gradient-to-r from-purple-600 to-violet-700 shadow-lg mt-2 p-3 text-white font-semibold rounded-lg w-full hover:scale-[1.02] hover:from-violet-700 hover:to-purple-600 transition duration-300 ease-in-out tracking-wide"
                                type="submit" style="font-family: 'Montserrat', sans-serif;">
                                LOGIN
                            </button>

                            <a href="{{ route('user.dashboard') }}"
                                class="block text-center mt-2 text-sm text-gray-500 hover:text-purple-400 transition duration-300 ease-in-out">
                                ← Kembali ke User Dashboard
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleBtn.textContent = isPassword ? 'Hide' : 'Show';
        });
    </script>
</body>

</html>

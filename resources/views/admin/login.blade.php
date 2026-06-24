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
        @keyframes gradientMove {
            0% {
                background-position: 0% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        body {
            background: radial-gradient(circle at 20% 20%, #161b33 0%, #0d1024 60%, #080a18 100%);
        }

        .glow-border {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 45%, #312e81 100%);
        }

        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
        }

        .brand-panel {
            background: radial-gradient(circle at 30% 20%, #1c2347 0%, #12152e 55%, #0a0c1c 100%);
        }
    </style>
</head>

<body class="flex font-poppins items-center justify-center min-w-screen min-h-screen px-4">

    <div class="grid gap-8 w-full max-w-3xl">
        <div id="back-div" class="glow-border rounded-[26px] m-2 shadow-2xl">
            <div class="border-[16px] border-transparent rounded-[20px] bg-[#11142b] shadow-lg overflow-hidden">
                <div class="flex flex-col md:flex-row">

                    <!-- Kiri Branding -->
                    <div
                        class="brand-panel hidden md:flex md:w-2/5 flex-col items-center justify-center p-8 text-center">
                        <div
                            class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-500 via-indigo-600 to-blue-800 flex items-center justify-center shadow-lg mb-4">
                            <span class="text-white text-3xl font-bold"
                                style="font-family: 'Montserrat', sans-serif;">T</span>
                        </div>
                        <h1 class="font-bold text-2xl text-transparent bg-clip-text tracking-wide animate-[gradientMove_3s_ease_infinite]"
                            style="font-family: 'Montserrat', sans-serif; background-image: linear-gradient(90deg, #7e22ce, #4f46e5, #a855f7, #7e22ce); background-size: 200% auto; -webkit-background-clip: text;">
                            TIXLY
                        </h1>
                        <p class="text-gray-400 text-sm mt-2">
                            Manage events, tickets, and payments with ease.
                        </p>
                    </div>

                    <!-- Kanan Form Login -->
                    <div class="w-full md:w-3/5 p-8 sm:p-10">

                        <div class="mb-6 md:hidden flex flex-col items-center">
                            <div
                                class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 via-indigo-600 to-blue-800 flex items-center justify-center shadow-lg mb-3">
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
                                    class="input-glow border @error('email') border-red-500 @else border-indigo-900/40 @enderror bg-[#181c3a] text-gray-200 p-3 placeholder:text-gray-500 rounded-lg w-full focus:outline-none focus:border-indigo-500 transition duration-300"
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
                                        class="input-glow border @error('password') border-red-500 @else border-indigo-900/40 @enderror bg-[#181c3a] text-gray-200 pr-14 p-3 placeholder:text-gray-500 rounded-lg w-full focus:outline-none focus:border-indigo-500 transition duration-300"
                                        type="password" placeholder="••••••••" required />
                                    <button type="button" id="togglePassword"
                                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-indigo-400 text-xs font-semibold transition">
                                        <span id="toggleLabel">Show</span>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="mt-1.5 text-red-400 text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <button
                                class="relative overflow-hidden mt-2 p-3 text-white font-semibold rounded-lg w-full bg-indigo-600 shadow-[0_0_20px_rgba(79,70,229,0.4)] group"
                                type="submit" style="font-family: 'Montserrat', sans-serif;">
                                <span class="relative z-10">LOGIN</span>
                                <div
                                    class="absolute inset-0 w-0 bg-red-600 transition-all duration-500 group-hover:w-full rounded-lg">
                                </div>
                            </button>

                            <a href="{{ route('user.dashboard') }}"
                                class="block text-center mt-2 text-sm text-gray-500 hover:text-indigo-400 transition duration-300 ease-in-out">
                                ← Back to User Dashboard
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
        const toggleLabel = document.getElementById('toggleLabel');

        toggleBtn.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            toggleLabel.textContent = isPassword ? 'Hide' : 'Show';
        });
    </script>
</body>

</html>

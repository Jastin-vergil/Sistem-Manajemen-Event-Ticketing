<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ticket Form</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
        }

        /* Navbar */
        .navbar {
            background: white;
            display: flex;
            justify-content: space-between;
            padding: 15px 40px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .menu a {
            margin-left: 20px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: 0.3s;
        }

        .menu a:hover {
            color: #4facfe;
        }

        /* Container */
        .container {
            width: 400px;
            margin: 80px auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 30px;
            color: #333;
        }

        /* Input */
        .form-group {
    margin-bottom: 20px;
    text-align: left;
}

input, select {
    width: 100%;
    height: 45px;
    padding: 0 15px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 14px;
    box-sizing: border-box;
    outline: none;
    transition: 0.3s;
}

/* Biar dropdown panahnya sejajar */
select {
    appearance: none;
}

/* Fokus effect */
input:focus, select:focus {
    border-color: #4facfe;
    box-shadow: 0 0 5px rgba(79,172,254,0.4);
}

/* Placeholder lebih rapi */
input::placeholder {
    color: #999;
}

/* Button full & sejajar */
button {
    width: 100%;
    height: 45px;
    border-radius: 10px;
    background: #4facfe;
    color: white;
    border: none;
    font-weight: bold;
    cursor: pointer;
}
    </style>
</head>
<body>

    <!-- Navbar -->
<div class="min-h-screen bg-gradient-to-r from-blue-400 to-cyan-400">

    <!-- Navbar -->
    <div class="bg-white shadow-md flex justify-between px-10 py-4">
        <div class="font-bold">Event Polibatam</div>
        <div class="space-x-6">
            <a href="#" class="hover:text-blue-500">History</a>
            <a href="#" class="hover:text-blue-500">Home</a>
            <a href="#" class="hover:text-blue-500">Events</a>
            <a href="#" class="hover:text-blue-500">Contact</a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="flex justify-center items-center mt-20">
        <div class="bg-white p-10 rounded-2xl shadow-lg w-full max-w-md">

            <h2 class="text-xl font-semibold text-center mb-6">
                🎟 Ticket Form
            </h2>

            <form action="{{ route('payment') }}" method="GET" class="space-y-4">

                <input 
                    type="text" 
                    name="name" 
                    placeholder="Enter Your Name"
                    class="w-full h-11 px-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required
                >

                <input 
                    type="email" 
                    name="email" 
                    placeholder="Enter your E-Mail"
                    class="w-full h-11 px-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required
                >

                <select 
                    name="ticket_type"
                    class="w-full h-11 px-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required
                >
                    <option value="">Select Ticket Type</option>
                    <option value="regular">Regular - Rp 100.000</option>
                    <option value="vip">VIP - Rp 200.000</option>
                </select>

                <button 
                    type="submit"
                    class="w-full h-11 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition"
                >
                    Confirm
                </button>

            </form>

        </div>
    </div>

</div>
    </div>

</body>
</html>
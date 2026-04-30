<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Event Polibatam – Transaction History (Dark Mode)</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    theme: {
    extend: {
      colors: {
        indigo: {
          400: '#818cf8',
          500: '#6366f1',
          600: '#4f46e5',
          900: '#1e1b4b',
          950: '#0a0a2e',
        },
        cyber: {
          dark: '#0a0a2e',
          accent: '#ef4444',
          glow: 'rgba(79, 70, 229, 0.4)',
        }
      },
      fontFamily: {
        display: ['"Roboto Slab"', 'serif'],
        body: ['"Mitr"', 'sans-serif'],
      }
    }
  }

  </script>

  <!-- Flowbite -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet" />

  <style>
    <style>
  body {
    font-family: 'Mitr', sans-serif;
    background-color: #0a0a2e;
    color: #e2e8f0;
  }

  .hero-bg {
    background-color: #0a0a2e;
    background-image:
      radial-gradient(at 0% 0%, rgba(79, 70, 229, 0.15) 0px, transparent 50%),
      radial-gradient(at 100% 100%, rgba(239, 68, 68, 0.05) 0px, transparent 50%);
  }

  #email-input:focus {
    outline: none;
    box-shadow: 0 0 20px rgba(79, 70, 229, 0.3);
    border-color: #6366f1;
  }

  .result-card {
    border-left: 4px solid #4f46e5;
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(12px);
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    border-right: 1px solid rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
  }

  .result-card:hover {
    transform: translateY(-2px) scale(1.01);
    background: rgba(255, 255, 255, 0.07);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
  }

  /* Status Badges */
  .badge-success { background: rgba(34, 197, 94, 0.1); color: #4ade80; border: 1px solid rgba(74, 222, 128, 0.3); }
  .badge-pending { background: rgba(234, 179, 8, 0.1); color: #facc15; border: 1px solid rgba(250, 204, 21, 0.3); }
  .badge-failed  { background: rgba(239, 68, 68, 0.1); color: #f87171; border: 1px solid rgba(248, 113, 113, 0.3); }

  .navbar-glass {
      background: rgba(10, 10, 46, 0.8);
      backdrop-filter: blur(15px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  }
</style>

</head>
<body class="hero-bg min-h-screen text-slate-200">


  <div>
    
    @include('components.header')
    </div>

  <!-- HERO -->
  <section class="max-w-6xl mx-auto px-6 pt-20 pb-10 text-center">
    <div class="fade-up inline-flex items-center gap-2 bg-indigo-900/40 border border-indigo-500/30 text-indigo-300 text-xs font-medium px-4 py-1.5 rounded-full mb-6">
      <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
      Transaction Tracker
    </div>

    <h1 class="fade-up delay-1 font-display text-4xl md:text-5xl font-normal text-white leading-tight mb-4">
      Trace Your <span class="text-indigo-400">Transaction</span> History
    </h1>
    <p class="fade-up delay-2 text-slate-400 text-base md:text-lg max-w-md mx-auto mb-10">
      Enter your registered email address to instantly retrieve all your event transactions.
    </p>

    <div class="fade-up delay-3 flex flex-col sm:flex-row items-center justify-center gap-3 max-w-lg mx-auto">
      <div class="relative w-full">
        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
          <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
          </svg>
        </div>
        <input id="email-input" type="email" placeholder="Insert your Email"
          class="w-full pl-11 pr-4 py-3.5 bg-slate-800/50 border border-slate-700 rounded-xl text-sm text-slate-200 placeholder-slate-500 transition-all duration-200 shadow-inner" />
      </div>
      <button id="search-btn"
        class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3.5 bg-indigo-600 hover:bg-indigo-500 active:scale-95 text-white text-sm font-medium rounded-xl shadow-lg shadow-indigo-900/20 transition-all duration-200 whitespace-nowrap">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z"/>
        </svg>
        Search
      </button>
    </div>

    <p id="error-msg" class="hidden mt-3 text-xs text-red-400">Please enter a valid email address.</p>
  </section>

  <!-- RESULTS -->
  <section class="max-w-3xl mx-auto px-6 pb-20" id="results-section" style="display:none;">
    <div class="flex items-center justify-between mb-5">
      <h2 class="text-slate-300 font-semibold text-sm">Results for <span id="result-email" class="text-indigo-400"></span></h2>
      <span id="result-count" class="text-xs bg-indigo-900/50 text-indigo-300 px-3 py-1 rounded-full font-medium border border-indigo-500/20"></span>
    </div>
    <div id="result-list" class="space-y-4"></div>
  </section>

  <section class="max-w-6xl mx-auto px-6 pb-24">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
      <div class="card-float bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 shadow-xl">
        <div class="w-10 h-10 rounded-xl bg-indigo-900/50 flex items-center justify-center mb-4 border border-indigo-500/30">
          <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
          </svg>
        </div>
        <h3 class="font-semibold text-slate-100 mb-1 text-sm">Secure & Private</h3>
        <p class="text-xs text-slate-400 leading-relaxed">Your transaction data is encrypted and only accessible by you.</p>
      </div>

      <div class="card-float bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 shadow-xl" style="animation-delay:0.5s">
        <div class="w-10 h-10 rounded-xl bg-indigo-900/50 flex items-center justify-center mb-4 border border-indigo-500/30">
          <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
          </svg>
        </div>
        <h3 class="font-semibold text-slate-100 mb-1 text-sm">Instant Results</h3>
        <p class="text-xs text-slate-400 leading-relaxed">Get your full history in milliseconds, no login required.</p>
      </div>

      <div class="card-float bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 shadow-xl" style="animation-delay:1s">
        <div class="w-10 h-10 rounded-xl bg-indigo-900/50 flex items-center justify-center mb-4 border border-indigo-500/30">
          <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
          </svg>
        </div>
        <h3 class="font-semibold text-slate-100 mb-1 text-sm">Full Receipt</h3>
        <p class="text-xs text-slate-400 leading-relaxed">View detailed receipts and download PDF invoices anytime.</p>
      </div>
    </div>
  </section>


  <footer>
    @include('components.footer')
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

  <script>
    const mockData = {
      'jastinreja@gmail.com': [
        { id: 'TXN-2024-010', event: 'Tech Talk: AI & Machine Learning', date: '01 Feb 2024', amount: 'Rp 50.000', status: 'success', ticket: 'General' },
        { id: 'TXN-2024-011', event: 'Networking Night Polibatam', date: '14 Feb 2024', amount: 'Rp 25.000', status: 'failed', ticket: 'Regular' },
      ]
    };

    const statusClass = { success: 'badge-success', pending: 'badge-pending', failed: 'badge-failed' };
    const statusLabel = { success: '✓ Success', pending: '⏳ Pending', failed: '✕ Failed' };

    function renderResults(email, data) {
      const section = document.getElementById('results-section');
      const list     = document.getElementById('result-list');
      document.getElementById('result-email').textContent = email;
      document.getElementById('result-count').textContent = data.length + ' transaction' + (data.length !== 1 ? 's' : '') + ' found';
      list.innerHTML = '';
      data.forEach((tx, i) => {
        const card = document.createElement('div');
        card.className = 'result-card rounded-2xl p-5 cursor-default';
        card.style.animation = `fadeUp 0.5s ease both ${i * 0.1}s`;
        card.innerHTML = `
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
              <p class="text-[10px] text-indigo-400 font-mono mb-1 tracking-wider">${tx.id}</p>
              <h4 class="font-semibold text-slate-100 text-sm">${tx.event}</h4>
              <p class="text-xs text-slate-400 mt-1">${tx.date} · ${tx.ticket} Ticket</p>
            </div>
            <div class="flex sm:flex-col items-center sm:items-end gap-3 sm:gap-1.5">
              <span class="text-sm font-semibold text-white">${tx.amount}</span>
              <span class="text-[11px] font-medium px-2.5 py-1 rounded-full ${statusClass[tx.status]}">${statusLabel[tx.status]}</span>
            </div>
          </div>`;
        list.appendChild(card);
      });
      section.style.display = 'block';
      section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function renderEmpty(email) {
      const section = document.getElementById('results-section');
      const list     = document.getElementById('result-list');
      document.getElementById('result-email').textContent = email;
      document.getElementById('result-count').textContent = '0 transactions found';
      list.innerHTML = `
        <div class="text-center py-14 bg-slate-800/20 rounded-3xl border border-dashed border-slate-700">
          <svg class="w-12 h-12 mx-auto mb-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <p class="text-sm font-medium text-slate-400">No transactions found</p>
          <p class="text-xs mt-1 text-slate-500">Check your email address or try another one.</p>
        </div>`;
      section.style.display = 'block';
      section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    function doSearch() {
      const val = document.getElementById('email-input').value.trim();
      const errMsg = document.getElementById('error-msg');
      if (!val || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
        errMsg.classList.remove('hidden');
        return;
      }
      errMsg.classList.add('hidden');
      const data = mockData[val.toLowerCase()];
      if (data) renderResults(val, data);
      else renderEmpty(val);
    }

    document.getElementById('search-btn').addEventListener('click', doSearch);
    document.getElementById('email-input').addEventListener('keydown', e => {
      if (e.key === 'Enter') doSearch();
    });
    document.getElementById('email-input').addEventListener('input', () => {
      document.getElementById('error-msg').classList.add('hidden');
    });
  </script>
</body>
</html>

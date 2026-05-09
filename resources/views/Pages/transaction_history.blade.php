<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Event Polibatam – Transaction History</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flowbite -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'DM Sans', sans-serif;
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
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
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

    /* Invoice Button */
    .invoice-btn {
      margin-top: 10px;
      padding: 6px 14px;
      background: transparent;
      border: 1px solid rgba(99, 102, 241, 0.4);
      color: #a5b4fc;
      font-size: 11px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .invoice-btn:hover {
      background: rgba(99, 102, 241, 0.15);
      border-color: #6366f1;
      color: #c7d2fe;
    }

    /* Modal Overlay */
    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 10, 0.75);
      z-index: 999;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .modal-overlay.open {
      display: flex;
    }

    /* Modal Box */
    .modal-box {
      background: #12123a;
      border: 1px solid rgba(99, 102, 241, 0.25);
      border-radius: 18px;
      width: 100%;
      max-width: 420px;
      overflow: hidden;
      animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
      from { transform: translateY(30px); opacity: 0; }
      to   { transform: translateY(0);    opacity: 1; }
    }

    .modal-header {
      background: linear-gradient(135deg, #1e1b6e 0%, #1a1060 100%);
      padding: 20px 22px 16px;
      border-bottom: 1px solid rgba(99, 102, 241, 0.15);
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    .modal-title {
      font-family: 'DM Serif Display', serif;
      font-size: 1.4rem;
      color: #fff;
    }

    .modal-title small {
      display: block;
      font-family: 'DM Sans', sans-serif;
      font-size: 10px;
      color: #818cf8;
      font-weight: 400;
      letter-spacing: 0.08em;
      margin-bottom: 2px;
      text-transform: uppercase;
    }

    .modal-close-btn {
      background: rgba(255, 255, 255, 0.08);
      border: none;
      color: #94a3b8;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      flex-shrink: 0;
    }

    .modal-close-btn:hover {
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
    }

    .modal-body {
      padding: 20px 22px;
    }

    .inv-label {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: #818cf8;
      font-weight: 500;
      margin-bottom: 6px;
    }

    .inv-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 6px 0;
      border-bottom: 1px solid rgba(255, 255, 255, 0.04);
      font-size: 12px;
    }

    .inv-row:last-child { border-bottom: none; }
    .inv-row-key  { color: #64748b; }
    .inv-row-val  { color: #e2e8f0; font-weight: 500; text-align: right; max-width: 60%; }

    .inv-divider {
      height: 1px;
      background: rgba(255, 255, 255, 0.06);
      margin: 4px 0 14px;
    }

    .inv-total {
      background: rgba(79, 70, 229, 0.12);
      border: 1px solid rgba(99, 102, 241, 0.2);
      border-radius: 10px;
      padding: 12px 16px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 4px;
    }

    .inv-total-label { font-size: 12px; color: #94a3b8; font-weight: 500; }
    .inv-total-val   { font-size: 18px; font-weight: 600; color: #fff; }

    .inv-status-row {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-top: 14px;
    }

    .inv-status-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      flex-shrink: 0;
    }

    .dot-success { background: #4ade80; box-shadow: 0 0 6px rgba(74, 222, 128, 0.5); }
    .dot-pending { background: #facc15; box-shadow: 0 0 6px rgba(250, 204, 21, 0.5); }
    .dot-failed  { background: #f87171; box-shadow: 0 0 6px rgba(248, 113, 113, 0.5); }

    .inv-status-text        { font-size: 12px; color: #94a3b8; }
    .inv-status-text strong { color: #e2e8f0; }

    .modal-footer {
      padding: 0 22px 20px;
    }

    .modal-close-full {
      width: 100%;
      padding: 11px;
      background: #4f46e5;
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 13px;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.2s;
    }

    .modal-close-full:hover { background: #6366f1; }

    .navbar-glass {
      background: rgba(10, 10, 46, 0.8);
      backdrop-filter: blur(15px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body class="hero-bg min-h-screen text-slate-200">

  <!-- HEADER -->
  @include('components.header')

  <!-- HERO / SEARCH -->
  <section class="max-w-6xl mx-auto px-6 pt-20 pb-10 text-center">

    <div class="inline-flex items-center gap-2 bg-indigo-900/40 border border-indigo-500/30 text-indigo-300 text-xs font-medium px-4 py-1.5 rounded-full mb-6">
      <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
      Transaction Tracker
    </div>

    <h1 class="font-display text-4xl md:text-5xl font-normal text-white leading-tight mb-4" style="font-family:'DM Serif Display',serif;">
      Trace Your <span class="text-indigo-400">Transaction</span> History
    </h1>

    <p class="text-slate-400 text-base md:text-lg max-w-md mx-auto mb-10">
      Enter your registered email address to instantly retrieve all your event transactions.
    </p>

    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 max-w-lg mx-auto">
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
      <h2 class="text-slate-300 font-semibold text-sm">
        Results for <span id="result-email" class="text-indigo-400"></span>
      </h2>
      <span id="result-count" class="text-xs bg-indigo-900/50 text-indigo-300 px-3 py-1 rounded-full font-medium border border-indigo-500/20"></span>
    </div>
    <div id="result-list" class="space-y-4"></div>
  </section>

  <!-- FEATURE CARDS -->
  <section class="max-w-6xl mx-auto px-6 pb-24">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

      <div class="bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 shadow-xl">
        <div class="w-10 h-10 rounded-xl bg-indigo-900/50 flex items-center justify-center mb-4 border border-indigo-500/30">
          <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
          </svg>
        </div>
        <h3 class="font-semibold text-slate-100 mb-1 text-sm">Secure & Private</h3>
        <p class="text-xs text-slate-400 leading-relaxed">Your transaction data is encrypted and only accessible by you.</p>
      </div>

      <div class="bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 shadow-xl">
        <div class="w-10 h-10 rounded-xl bg-indigo-900/50 flex items-center justify-center mb-4 border border-indigo-500/30">
          <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
          </svg>
        </div>
        <h3 class="font-semibold text-slate-100 mb-1 text-sm">Instant Results</h3>
        <p class="text-xs text-slate-400 leading-relaxed">Get your full history in milliseconds, no login required.</p>
      </div>

      <div class="bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 shadow-xl">
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

  <!-- FOOTER -->
  <footer>
    @include('components.footer')
  </footer>

  <!--invoice modal-->
  <div class="modal-overlay" id="invoice-modal">
    <div class="modal-box">

<!--modal header-->
      <div class="modal-header">
        <div class="modal-title">
          <small>Event Polibatam</small>
          Invoice
        </div>
        <button class="modal-close-btn" onclick="closeInvoice()" aria-label="Close">&#x2715;</button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">

        <!-- Transaction Info -->
        <p class="inv-label">Transaction</p>
        <div class="inv-row">
          <span class="inv-row-key">Invoice ID</span>
          <span class="inv-row-val" id="inv-id"></span>
        </div>
        <div class="inv-row">
          <span class="inv-row-key">Transaction Date</span>
          <span class="inv-row-val" id="inv-date"></span>
        </div>

        <div class="inv-divider"></div>

        <!-- Event Detail -->
        <p class="inv-label">Event Detail</p>
        <div class="inv-row">
          <span class="inv-row-key">Event Name</span>
          <span class="inv-row-val" id="inv-event"></span>
        </div>
        <div class="inv-row">
          <span class="inv-row-key">Ticket Type</span>
          <span class="inv-row-val" id="inv-ticket"></span>
        </div>
        <div class="inv-row">
          <span class="inv-row-key">Date &amp; Time</span>
          <span class="inv-row-val" id="inv-datetime"></span>
        </div>

        <div class="inv-divider"></div>

        <!-- Total -->
        <div class="inv-total">
          <span class="inv-total-label">Total Payment</span>
          <span class="inv-total-val" id="inv-amount"></span>
        </div>

        <!-- Status -->
        <div class="inv-status-row">
          <div class="inv-status-dot" id="inv-dot"></div>
          <p class="inv-status-text">Payment status: <strong id="inv-status-text"></strong></p>
        </div>

      </div><!-- /modal-body -->

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button class="modal-close-full" onclick="closeInvoice()">Close</button>
      </div>

    </div><!-- /modal-box -->
  </div><!-- /modal-overlay -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

  <script>
   
    const mockData = {
      'jastinreja@gmail.com': [
        {
          id:           'TXN-2024-010',
          event:        'Tech Talk: AI & Machine Learning',
          date:         '01 Feb 2024',
          eventDatetime:'15 April 2026, 19:00',
          amount:       'Rp 50.000',
          status:       'success',
          ticket:       'General'
        },
        {
          id:           'TXN-2024-011',
          event:        'Networking Night Polibatam',
          date:         '14 Feb 2024',
          eventDatetime:'20 Maret 2024, 18:30',
          amount:       'Rp 25.000',
          status:       'failed',
          ticket:       'Regular'
        },
      ]
    };

    //status helpers
    const statusClass = {
      success: 'badge-success',
      pending: 'badge-pending',
      failed:  'badge-failed'
    };

    const statusLabel = {
      success: '✓ Success',
      pending: '⏳ Pending',
      failed:  '✕ Failed'
    };

    const dotClass = {
      success: 'dot-success',
      pending: 'dot-pending',
      failed:  'dot-failed'
    };

    const statusText = {
      success: 'Paid',
      pending: 'Pending',
      failed:  'Failed'
    };

    //invoice modal
    function openInvoice(tx) {
      document.getElementById('inv-id').textContent       = tx.id;
      document.getElementById('inv-date').textContent     = tx.date;
      document.getElementById('inv-event').textContent    = tx.event;
      document.getElementById('inv-ticket').textContent   = tx.ticket + ' Ticket';
      document.getElementById('inv-datetime').textContent = tx.eventDatetime;
      document.getElementById('inv-amount').textContent   = tx.amount;

      const dot = document.getElementById('inv-dot');
      dot.className = 'inv-status-dot ' + dotClass[tx.status];

      document.getElementById('inv-status-text').textContent = statusText[tx.status];
      document.getElementById('invoice-modal').classList.add('open');
    }

    function closeInvoice() {
      document.getElementById('invoice-modal').classList.remove('open');
    }

    // Close modal when clicking the backdrop
    document.getElementById('invoice-modal').addEventListener('click', function (e) {
      if (e.target === this) closeInvoice();
    });

    /* Close modal with Escape key */
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeInvoice();
    });

    //render results
    function renderResults(email, data) {
      const section = document.getElementById('results-section');
      const list    = document.getElementById('result-list');

      document.getElementById('result-email').textContent = email;
      document.getElementById('result-count').textContent =
        data.length + ' transaction' + (data.length !== 1 ? 's' : '') + ' found';

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
              <p class="text-xs text-slate-400 mt-1">${tx.date} &middot; ${tx.ticket} Ticket</p>
            </div>
            <div class="flex sm:flex-col items-center sm:items-end gap-3 sm:gap-1.5">
              <span class="text-sm font-semibold text-white">${tx.amount}</span>
              <span class="text-[11px] font-medium px-2.5 py-1 rounded-full ${statusClass[tx.status]}">${statusLabel[tx.status]}</span>
            </div>
          </div>

          <button class="invoice-btn" onclick='openInvoice(${JSON.stringify(tx)})'>
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/>
            </svg>
            View Invoice
          </button>`;

        list.appendChild(card);
      });

      section.style.display = 'block';
      section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    //render empty state
    function renderEmpty(email) {
      const section = document.getElementById('results-section');
      const list    = document.getElementById('result-list');

      document.getElementById('result-email').textContent = email;
      document.getElementById('result-count').textContent = '0 transactions found';

      list.innerHTML = `
        <div class="text-center py-14 bg-slate-800/20 rounded-3xl border border-dashed border-slate-700">
          <svg class="w-12 h-12 mx-auto mb-4 text-slate-700" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <p class="text-sm font-medium text-slate-400">No transactions found</p>
          <p class="text-xs mt-1 text-slate-500">Check your email address or try another one.</p>
        </div>`;

      section.style.display = 'block';
      section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

   //mockData
    function doSearch() {
      const val    = document.getElementById('email-input').value.trim();
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
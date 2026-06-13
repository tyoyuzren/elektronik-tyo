<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembelian Berhasil — Apple Store Elektronik Tyo</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:200,300,400,500,600,700,800|jetbrains-mono:400,500,600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #F5F5F7;
            color: #1D1D1F;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        .stage-receipt {
            width: 100%;
            max-width: 480px;
            padding: 2rem 1.5rem 160px;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stage-receipt.hidden {
            opacity: 0;
            transform: scale(0.96);
            filter: blur(6px);
            pointer-events: none;
        }

        .receipt-card {
            background: #FFFFFF;
            border-radius: 20px;
            padding: 2rem 1.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 8px 32px rgba(0,0,0,0.04);
            margin-bottom: 1rem;
        }

        .receipt-header {
            text-align: center;
            padding-bottom: 1.25rem;
            border-bottom: 1px solid #F0F0F2;
            margin-bottom: 1.25rem;
        }
        .receipt-header .store-name {
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            color: #1D1D1F;
        }
        .receipt-header .thanks {
            font-size: 0.8rem;
            font-weight: 400;
            color: #86868B;
            margin-top: 0.2rem;
        }

        .receipt-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.78rem;
            color: #86868B;
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }
        .receipt-meta span { font-weight: 600; color: #1D1D1F; }

        .divider-light {
            height: 1px;
            background: #F0F0F2;
            margin: 1rem 0;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
        }
        table.items thead th {
            text-align: left;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #86868B;
            padding: 0.5rem 0.25rem 0.75rem;
            border-bottom: 1px solid #F0F0F2;
        }
        table.items thead th:last-child { text-align: right; }
        table.items tbody td {
            padding: 0.65rem 0.25rem;
            font-size: 0.85rem;
            border-bottom: 1px solid #F5F5F7;
            color: #1D1D1F;
        }
        table.items tbody td:last-child {
            text-align: right;
            font-weight: 600;
        }
        table.items .qty-cell { text-align: center; color: #86868B; font-size: 0.8rem; }
        table.items .item-name { font-weight: 600; }
        table.items .item-price { font-size: 0.7rem; color: #86868B; margin-top: 0.1rem; }

        .receipt-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0.25rem 0;
            margin-top: 0.25rem;
        }
        .receipt-total .label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #86868B;
        }
        .receipt-total .amount {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.35rem;
            font-weight: 700;
            color: #1D1D1F;
        }

        .dana-section {
            margin-top: 1rem;
        }
        .dana-section .dana-title {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #86868B;
            margin-bottom: 1rem;
            text-align: center;
        }
        .dana-qr-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            padding: 1.5rem;
            background: #F8F8FA;
            border-radius: 16px;
            border: 1px dashed #D2D2D7;
        }
        .dana-qr-wrap img {
            width: 180px;
            height: 180px;
            border-radius: 12px;
            display: block;
        }
        .dana-qr-wrap .dana-label {
            font-size: 0.7rem;
            color: #86868B;
            text-align: center;
            line-height: 1.5;
        }
        .dana-qr-wrap .dana-label strong {
            color: #1D1D1F;
            font-weight: 600;
        }

        .actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.25rem;
        }
        .actions .btn {
            flex: 1;
            padding: 0.85rem;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.85rem;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
        }
        .actions .btn-primary {
            background: #1D1D1F;
            color: #FFFFFF;
        }
        .actions .btn-primary:hover {
            background: #000000;
            transform: scale(1.02);
        }
        .actions .btn-primary:active {
            transform: scale(0.98);
        }
        .actions .btn-outline {
            background: transparent;
            color: #1D1D1F;
            border: 1.5px solid #D2D2D7;
        }
        .actions .btn-outline:hover {
            background: #F5F5F7;
            border-color: #1D1D1F;
        }
        .actions .btn svg { width: 16px; height: 16px; flex-shrink: 0; }

        .stage-success {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #FAFAFA;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            padding: 2rem;
        }
        .light .stage-success { background: #FAFAFA; }
        .stage-success.active {
            opacity: 1;
            pointer-events: all;
        }
        .stage-success::before {
            content: '';
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(0,0,0,0.015) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -60%);
            pointer-events: none;
        }

        .success-content {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .success-logo {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: scale(0.4) translateY(20px);
            filter: blur(6px);
        }
        .success-logo.animate {
            animation: logoReveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .success-logo svg {
            width: 64px;
            height: 64px;
            color: #1D1D1F;
        }
        @keyframes logoReveal {
            0% { opacity: 0; transform: scale(0.4) translateY(20px); filter: blur(6px); }
            50% { transform: scale(1.1) translateY(-4px); filter: blur(0); }
            100% { opacity: 1; transform: scale(1) translateY(0); filter: blur(0); }
        }

        .checkmark-ring {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #E8F5E9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            opacity: 0;
            transform: scale(0.5);
        }
        .checkmark-ring.animate {
            animation: checkReveal 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) 0.3s forwards;
        }
        .checkmark-ring svg {
            width: 32px;
            height: 32px;
            color: #34C759;
        }
        @keyframes checkReveal {
            0% { opacity: 0; transform: scale(0.5) rotate(-15deg); }
            60% { transform: scale(1.15) rotate(3deg); }
            100% { opacity: 1; transform: scale(1) rotate(0deg); }
        }

        .success-title {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: #1D1D1F;
            text-align: center;
            margin-bottom: 0.3rem;
            opacity: 0;
            transform: translateY(12px);
        }
        .success-title.animate {
            animation: textSlideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.7s forwards;
        }
        .success-sub {
            font-size: 0.9rem;
            font-weight: 400;
            color: #86868B;
            text-align: center;
            margin-bottom: 1.75rem;
            opacity: 0;
            transform: translateY(12px);
        }
        .success-sub.animate {
            animation: textSlideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) 0.9s forwards;
        }
        @keyframes textSlideUp {
            0% { opacity: 0; transform: translateY(12px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .success-items {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
        .success-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1rem;
            background: #FFFFFF;
            border-radius: 14px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03), 0 4px 12px rgba(0,0,0,0.03);
            border: 1px solid #F0F0F2;
            opacity: 0;
            transform: translateY(16px) scale(0.97);
        }
        .success-item.animate {
            animation: itemSlide 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .success-item .item-info {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
        }
        .success-item .item-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #1D1D1F;
        }
        .success-item .item-sub {
            font-size: 0.7rem;
            color: #86868B;
        }
        .success-item .item-qty {
            font-size: 0.85rem;
            font-weight: 600;
            color: #86868B;
            white-space: nowrap;
            margin-left: 1rem;
        }
        .success-item .item-total {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
            font-weight: 700;
            color: #1D1D1F;
            white-space: nowrap;
            margin-left: 1rem;
        }
        @keyframes itemSlide {
            0% { opacity: 0; transform: translateY(16px) scale(0.97); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }

        .success-total {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.85rem 1rem;
            margin-top: 0.75rem;
            border-top: 1px solid #F0F0F2;
            opacity: 0;
        }
        .success-total.animate {
            animation: textSlideUp 0.5s ease-out forwards;
        }
        .success-total .label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #86868B;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }
        .success-total .amount {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.15rem;
            font-weight: 700;
            color: #1D1D1F;
        }

        .success-btn {
            margin-top: 1.5rem;
            padding: 0.85rem 2.5rem;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            background: #1D1D1F;
            color: #FFFFFF;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            opacity: 0;
            transform: translateY(10px);
        }
        .success-btn.animate {
            animation: textSlideUp 0.5s ease-out forwards;
        }
        .success-btn:hover {
            background: #000000;
            transform: scale(1.02);
        }
        .success-btn:active {
            transform: scale(0.98);
        }

        .receipt-footer-note {
            text-align: center;
            margin-top: 1.25rem;
            padding-top: 1rem;
            font-size: 0.7rem;
            color: #A1A1A6;
            line-height: 1.6;
        }

        @media print {
            body { background: white; padding: 0.3in; }
            .stage-receipt { max-width: 100%; padding: 0; }
            .receipt-card { box-shadow: none; border-radius: 0; padding: 0; }
            .receipt-header { border-color: #ccc; }
            .dana-section { display: none; }
            .actions { display: none; }
            .receipt-footer-note { color: #999; }
            table.items thead th { border-color: #ccc; }
            table.items tbody td { border-color: #eee; }
            .divider-light { background: #ccc; }
            .stage-success { display: none !important; }
        }
        @page { margin: 0; }
    </style>
</head>
<body>

    {{-- STAGE 1: Receipt + Dana QR --}}
    <div class="stage-receipt" id="stageReceipt">
        <div class="receipt-card">
            <div class="receipt-header">
                <div class="store-name">Apple Store Elektronik Tyo</div>
                <div class="thanks">Terima kasih atas pesanan Anda</div>
            </div>

            <div class="receipt-meta">
                <div>Invoice: <span>INV-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</span></div>
                <div>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y H:i') }}</div>
            </div>
            <div class="receipt-meta">
                <div>Kasir: <span>{{ $transaksi->user->name ?? '-' }}</span></div>
            </div>

            <div class="divider-light"></div>

            <table class="items">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th class="qty-cell">Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->detail as $d)
                    <tr>
                        <td>
                            <div class="item-name">{{ $d->produk->nama_produk ?? '-' }}</div>
                            <div class="item-price">Rp {{ number_format($d->harga, 0, ',', '.') }}</div>
                        </td>
                        <td class="qty-cell">{{ $d->qty }}</td>
                        <td>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="receipt-total">
                <span class="label">Total</span>
                <span class="amount">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Dana QR Payment Section --}}
        <div class="receipt-card dana-section">
            <div class="dana-title">Scan untuk membayar</div>
            <div class="dana-qr-wrap">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode('https://qr.dana.id/' . $transaksi->id) }}" alt="QR Dana" crossorigin="anonymous">
                <div class="dana-label">
                    Scan QR ini dengan <strong>Aplikasi Dana</strong><br>
                    atau aplikasi perbankan yang mendukung QRIS
                </div>
            </div>
        </div>

        <div class="actions">
            <button onclick="handlePrint()" class="btn btn-primary">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                Cetak Resi
            </button>
            <button onclick="showSuccess()" class="btn btn-outline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                Selesai
            </button>
        </div>

        <div class="receipt-footer-note">
            Barang yang sudah dibeli tidak dapat dikembalikan<br>
            Simpan resi ini sebagai bukti pembelian yang sah
        </div>
    </div>

    {{-- STAGE 2: Success Animation --}}
    <div class="stage-success" id="stageSuccess">
        <div class="success-content">

            <div class="success-logo" id="elLogo">
                <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                </svg>
            </div>

            <div class="checkmark-ring" id="elCheck">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>

            <h1 class="success-title" id="elTitle">Pembelian Berhasil</h1>
            <p class="success-sub" id="elSub">Terima kasih, {{ $transaksi->user->name ?? '-' }}</p>

            <div class="success-items" id="elItems">
                @foreach ($transaksi->detail as $d)
                <div class="success-item" data-delay="{{ $loop->index * 0.12 }}">
                    <div class="item-info">
                        <span class="item-name">{{ $d->produk->nama_produk ?? '-' }}</span>
                        <span class="item-sub">Rp {{ number_format($d->harga, 0, ',', '.') }}</span>
                    </div>
                    <span class="item-qty">{{ $d->qty }}x</span>
                    <span class="item-total">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            <div class="success-total" id="elTotal">
                <span class="label">Total Pembayaran</span>
                <span class="amount">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
            </div>

            <a href="{{ route('transaksi.index') }}" class="success-btn" id="elBtn">Kembali ke Dashboard</a>
        </div>
    </div>

    <script>
        function handlePrint() {
            window.print();
        }

        function showSuccess() {
            const receipt = document.getElementById('stageReceipt');
            const overlay = document.getElementById('stageSuccess');

            receipt.classList.add('hidden');

            setTimeout(function() {
                overlay.classList.add('active');

                setTimeout(function() {
                    animateIn();
                }, 100);
            }, 500);
        }

        function animateIn() {
            var logo = document.getElementById('elLogo');
            logo.classList.add('animate');

            setTimeout(function() {
                document.getElementById('elCheck').classList.add('animate');
            }, 200);

            setTimeout(function() {
                document.getElementById('elTitle').classList.add('animate');
            }, 500);

            setTimeout(function() {
                document.getElementById('elSub').classList.add('animate');
            }, 700);

            var items = document.querySelectorAll('.success-item');
            items.forEach(function(el, i) {
                var delay = parseFloat(el.getAttribute('data-delay')) || (i * 0.12);
                setTimeout(function() {
                    el.classList.add('animate');
                }, 950 + delay * 1000);
            });

            var lastItemDelay = items.length > 0
                ? 950 + (parseFloat(items[items.length-1].getAttribute('data-delay')) || ((items.length-1) * 0.12)) * 1000
                : 950;

            setTimeout(function() {
                document.getElementById('elTotal').classList.add('animate');
            }, lastItemDelay + 200);

            setTimeout(function() {
                document.getElementById('elBtn').classList.add('animate');
            }, lastItemDelay + 450);
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                var overlay = document.getElementById('stageSuccess');
                if (!overlay.classList.contains('active')) {
                    showSuccess();
                }
            }
        });
    </script>

</body>
</html>

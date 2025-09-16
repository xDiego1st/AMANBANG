{{-- Template dinamis untuk berbagai HTTP error code --}}
@php
    // Ambil status code dari parameter, exception, atau default 500
    $status =
        $code ??
        ((isset($exception) && method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : null) ?? 500);

    // Peta konten per kode
    $meta = [
        401 => [
            'emoji' => '🔒',
            'title' => 'Tidak Terautentikasi',
            'subtitle' => 'Silakan login terlebih dahulu.',
            'joke' => 'Kayaknya kamu butuh kartu member dulu buat masuk ke sini 😅',
            'badge' => 'warning',
            'tips' => ['Coba login ulang', 'Pastikan sesi belum kedaluwarsa'],
        ],
        402 => [
            'emoji' => '💳',
            'title' => 'Pembayaran Diperlukan',
            'subtitle' => 'Fitur ini memerlukan pembayaran/upgrade.',
            'joke' => 'Dompet siap, hati senang, akses pun terbuka 🤑',
            'badge' => 'warning',
            'tips' => ['Cek paket/keanggotaan', 'Hubungi admin untuk aktivasi'],
        ],
        403 => [
            'emoji' => '🚫',
            'title' => 'Akses Ditolak',
            'subtitle' => 'Kamu tidak punya izin untuk halaman ini.',
            'joke' => 'Coba decrypt perasaan doi dulu, baru payload-nya 💘',
            'badge' => 'danger',
            'tips' => ['Minta akses ke admin', 'Pastikan role/izin sudah benar'],
        ],
        404 => [
            'emoji' => '🕵️‍♂️',
            'title' => 'Halaman Tidak Ditemukan',
            'subtitle' => 'Link mungkin salah atau konten sudah pindah.',
            'joke' => 'Yang kamu cari hilang… seperti chat lama dengan mantan 😬',
            'badge' => 'ghost',
            'tips' => ['Periksa URL', 'Kembali ke beranda'],
        ],
        419 => [
            'emoji' => '⏳',
            'title' => 'Sesi Kedaluwarsa',
            'subtitle' => 'Silakan refresh halaman atau login ulang.',
            'joke' => 'Sesi berakhir. Hubungan juga kadang begitu 😌',
            'badge' => 'warning',
            'tips' => ['Refresh halaman', 'Login ulang'],
        ],
        429 => [
            'emoji' => '🐢',
            'title' => 'Terlalu Banyak Permintaan',
            'subtitle' => 'Coba lagi beberapa saat.',
            'joke' => 'Pelan-pelan aja… biar nggak dikira spammer 🐌',
            'badge' => 'warning',
            'tips' => ['Kurangi frekuensi request', 'Tunggu cooldown'],
        ],
        500 => [
            'emoji' => '💥',
            'title' => 'Kesalahan Server',
            'subtitle' => 'Terjadi masalah pada server.',
            'joke' => 'Server lagi drama. Tenang, kita peluk dulu 🤗',
            'badge' => 'danger',
            'tips' => ['Coba beberapa saat lagi', 'Laporkan ke admin jika berulang'],
        ],
        503 => [
            'emoji' => '🛠️',
            'title' => 'Sedang Perawatan',
            'subtitle' => 'Layanan sementara tidak tersedia.',
            'joke' => 'Lagi dandan dulu biar makin cakep 💅',
            'badge' => 'ghost',
            'tips' => ['Coba beberapa saat lagi', 'Pantau pengumuman maintenance'],
        ],
    ];

    $cfg = $meta[$status] ?? $meta[500];

    // util untuk badge style
    $badgeStyles = [
        'danger' => 'background:rgba(239,68,68,.12); color:#fecaca; border:1px solid rgba(239,68,68,.25);',
        'warning' => 'background:rgba(245,158,11,.12); color:#fde68a; border:1px solid rgba(245,158,11,.25);',
        'ghost' => 'background:rgba(148,163,184,.12); color:#e5e7eb; border:1px solid rgba(148,163,184,.25);',
    ];
    $badgeStyle = $badgeStyles[$cfg['badge']] ?? $badgeStyles['ghost'];
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $status }} | {{ $cfg['title'] }}</title>
    <style>
        :root {
            --bg: #0f172a;
            --card: #111827;
            --muted: #9ca3af;
            --primary: #6366f1;
            --ring: rgba(99, 102, 241, .35);
            --shadow: 0 10px 30px rgba(0, 0, 0, .35);
        }

        * {
            box-sizing: border-box
        }

        html,
        body {
            height: 100%
        }

        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Arial;
            background:
                radial-gradient(60vmax 60vmax at 10% -10%, rgba(34, 211, 238, .08), transparent 40%),
                radial-gradient(60vmax 60vmax at 110% 10%, rgba(99, 102, 241, .08), transparent 40%),
                var(--bg);
            color: #e5e7eb;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .card {
            width: min(720px, 100%);
            background: linear-gradient(180deg, rgba(255, 255, 255, .02), transparent 40%),
                linear-gradient(0deg, rgba(255, 255, 255, .02), transparent 40%), var(--card);
            border: 1px solid rgba(255, 255, 255, .06);
            border-radius: 20px;
            padding: 28px;
            position: relative;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 14px;
        }

        .title {
            margin: 18px 0 8px;
            font-size: 42px;
            line-height: 1.1;
            letter-spacing: -.02em;
            background: linear-gradient(90deg, #fff, #c7d2fe 60%, #a5f3fc);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .subtitle {
            color: var(--muted);
            font-size: 16px;
            margin: 0 0 18px
        }

        .joke {
            margin: 14px 0 24px;
            color: #cbd5e1;
            font-size: 15px
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 6px
        }

        .btn {
            appearance: none;
            border: none;
            cursor: pointer;
            user-select: none;
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: .2s transform, .2s box-shadow, .2s background;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 8px 20px var(--ring)
        }

        .btn-primary:hover {
            transform: translateY(-1px)
        }

        .btn-ghost {
            background: transparent;
            color: #e5e7eb;
            border: 1px solid rgba(255, 255, 255, .12)
        }

        .btn-ghost:hover {
            background: rgba(255, 255, 255, .04)
        }

        .hint {
            margin-top: 18px;
            color: #94a3b8;
            font-size: 13px
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 16px
        }

        .chip {
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            color: #c7d2fe;
            background: rgba(99, 102, 241, .12);
            border: 1px solid rgba(99, 102, 241, .25)
        }

        .watermark {
            position: absolute;
            inset: auto -20px -20px auto;
            opacity: .08;
            font-size: 140px;
            font-weight: 900;
            letter-spacing: -.06em;
            transform: rotate(-12deg);
            pointer-events: none;
            color: white;
        }

        .emoji {
            font-size: 24px
        }

        @media (max-width: 480px) {
            .title {
                font-size: 32px
            }
        }
    </style>
</head>

<body>
    <main class="card" role="main" aria-labelledby="err-title">
        <div class="badge" style="{{ $badgeStyle }}" aria-hidden="true">
            <span class="emoji">{{ $cfg['emoji'] }}</span> {{ $status }}
        </div>

        <h1 class="title" id="err-title">{{ $cfg['title'] }}</h1>

        <p class="subtitle">{{ $cfg['subtitle'] }}</p>

        <p class="joke">{{ $cfg['joke'] }}</p>

        <div class="actions">
            <a href="{{ url()->previous() ?: url('/') }}" class="btn btn-ghost" aria-label="Kembali">← Kembali</a>
            <a href="{{ url('/') }}" class="btn btn-primary" aria-label="Ke Beranda">Ke Beranda</a>
        </div>

        <div class="chips" aria-hidden="true">
            @foreach ($cfg['tips'] ?? [] as $tip)
                <span class="chip">{{ $tip }}</span>
            @endforeach
            <span class="chip">Method: {{ request()->method() }}</span>
        </div>

        <p class="hint">
            Jika menurutmu ini kesalahan, hubungi admin dan sertakan waktu kejadian:
            {{ now()->timezone(config('app.timezone', 'Asia/Jakarta'))->format('d M Y H:i:s') }}
            ({{ config('app.timezone', 'Asia/Jakarta') }}).
        </p>

        <div class="watermark">{{ $status }}</div>
    </main>
</body>

</html>

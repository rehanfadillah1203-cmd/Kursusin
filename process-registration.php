<?php

session_start();

require __DIR__ . '/helpers.php';
require __DIR__ . '/data.php';

$siteName = 'KursusKu';

/**
 * Kerangka halaman: head + navigasi + hero. Dipakai oleh halaman error dan halaman sukses.
 */
function pageStart(string $title, string $siteName, string $eyebrow, string $heading, string $sub): void
{
    ?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?> - <?= e($siteName) ?></title>
<style>
    :root {
        --peel-950: #170e06;
        --peel-900: #1f1308;
        --peel-800: #2e1d0d;
        --peel-700: #43290f;
        --peel-line: #5c3d1b;
        --banana: #ffd23f;
        --banana-deep: #f2a900;
        --banana-soft: #fff1b8;
        --stem: #a8c256;
        --spot: #ff8a5b;
        --text: #f7ebc8;
        --muted: #c9b27a;
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        min-height: 100vh;
        background:
            radial-gradient(ellipse at 50% -10%, rgba(255, 210, 63, 0.16), transparent 55%),
            var(--peel-900);
        color: var(--text);
        font-family: "Trebuchet MS", "Segoe UI", system-ui, sans-serif;
        font-size: 15px;
        line-height: 1.6;
    }

    .container { width: min(720px, 100% - 32px); margin-inline: auto; }

    /* ---------- Navigasi ---------- */
    .site-header {
        background: rgba(23, 14, 6, 0.9);
        border-bottom: 1px solid var(--peel-line);
    }

    .site-nav {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 16px 0 14px;
    }

    .brand {
        font-size: 22px;
        font-weight: 800;
        color: var(--banana);
        text-decoration: none;
    }

    .nav-links { display: flex; flex-wrap: wrap; justify-content: center; gap: 4px; }

    .nav-links a {
        padding: 4px 12px;
        border-radius: 999px;
        color: var(--muted);
        text-decoration: none;
        font-size: 13px;
    }

    .nav-links a:hover { color: var(--banana-soft); }

    .nav-links a.active {
        background: var(--peel-700);
        color: var(--banana);
        box-shadow: inset 0 -2px 0 var(--banana);
    }

    a:focus-visible, button:focus-visible { outline: 2px solid var(--banana); outline-offset: 2px; }

    /* ---------- Hero ---------- */
    .hero { padding: 64px 0 36px; text-align: center; }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 18px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--banana);
    }

    .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--banana);
        box-shadow: 0 0 0 3px rgba(255, 210, 63, 0.22);
    }

    .hero h1 {
        margin: 0 auto 14px;
        max-width: 14ch;
        font-size: clamp(30px, 8vw, 46px);
        line-height: 1.12;
        color: var(--banana-soft);
    }

    .hero p.sub {
        margin: 0 auto;
        max-width: 38ch;
        color: var(--muted);
    }

    /* ---------- Kartu ---------- */
    main { padding-bottom: 48px; }

    .card {
        margin-bottom: 18px;
        padding: 22px;
        background: linear-gradient(180deg, var(--peel-800), var(--peel-900));
        border: 1px solid var(--peel-line);
        border-top: 3px solid var(--banana);
        border-radius: 14px;
    }

    .card h2 {
        margin: 0 0 14px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--banana);
    }

    dl.summary { display: grid; grid-template-columns: 130px 1fr; gap: 8px 14px; margin: 0; }
    dl.summary dt { color: var(--muted); }
    dl.summary dd { margin: 0; color: var(--banana-soft); word-break: break-word; }

    table.cost { width: 100%; border-collapse: collapse; }
    table.cost td { padding: 8px 0; border-bottom: 1px dashed var(--peel-line); }
    table.cost td:last-child { text-align: right; }
    table.cost tr.total td {
        border-bottom: 0;
        padding-top: 14px;
        font-size: 18px;
        font-weight: 800;
        color: var(--banana);
    }

    .chips { display: flex; flex-wrap: wrap; gap: 8px; margin: 0; padding: 0; list-style: none; }
    .chip {
        padding: 3px 12px;
        border-radius: 999px;
        background: var(--banana);
        color: var(--peel-900);
        font-weight: 700;
        font-size: 13px;
    }
    .empty { color: var(--muted); font-style: italic; }

    .errors { margin: 0 0 16px; padding-left: 20px; color: var(--spot); }

    .actions { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 4px; }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        border-radius: 999px;
        font-weight: 800;
        text-decoration: none;
        border: 1px solid var(--banana);
    }
    .btn-primary { background: var(--banana); color: var(--peel-900); }
    .btn-primary:hover { background: var(--banana-soft); }
    .btn-secondary { background: transparent; color: var(--banana); }
    .btn-secondary:hover { background: var(--peel-700); }
    .btn-link { border-color: transparent; color: var(--muted); }
    .btn-link:hover { color: var(--banana-soft); }

    @media (max-width: 480px) {
        dl.summary { grid-template-columns: 1fr; gap: 0; }
        dl.summary dd { margin-bottom: 10px; }
    }
</style>
</head>
<body>

<header class="site-header">
    <nav class="site-nav container" aria-label="Navigasi utama">
        <a class="brand" href="index.php"><?= e($siteName) ?></a>
        <div class="nav-links">
            <a href="index.php">Beranda</a>
            <a href="index.php#katalog">Katalog</a>
            <a href="registration.php" class="active" aria-current="page">Daftar</a>
            <a href="fee-calculator.php">Test Matrix</a>
        </div>
    </nav>
</header>

<section class="hero container">
    <p class="eyebrow"><span class="dot"></span><?= e($eyebrow) ?></p>
    <h1><?= e($heading) ?></h1>
    <p class="sub"><?= e($sub) ?></p>
</section>

<main class="container">
<?php
}

function pageEnd(string $siteName): void
{
    ?>
</main>

<footer class="container" style="padding:0 0 28px;text-align:center;font-size:13px;color:#c9b27a;">
    <small>&copy; <?= e(date('Y')) ?> <?= e($siteName) ?> Pisang Pride</small>
</footer>

</body>
</html>
<?php
}

// Tolak akses langsung (GET) -> kembali ke form
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registration.php');
    exit;
}

// 1. Baca data POST dengan aman
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$courseCode = $_POST['course_code'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$learningMode = $_POST['learning_mode'] ?? '';
$packageCount = (int) ($_POST['package_count'] ?? 1);
$notes = trim($_POST['notes'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$studyProgram = trim($_POST['study_program'] ?? '');
$interests = $_POST['interests'] ?? [];

if (!is_array($interests)) {
    $interests = [];
}

$allowedInterestKeys = array_keys($interestOptions);
$interests = array_values(array_intersect($interests, $allowedInterestKeys));

// 2. Validasi fundamental
$errors = [];

if ($name === '') {
    $errors[] = 'Nama wajib diisi.';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
}

$course = findCourse($courses, (string) $courseCode);

if ($course === null) {
    $errors[] = 'Kursus tidak ditemukan.';
}

if (!in_array($participantType, ['mahasiswa', 'guru', 'umum'], true)) {
    $errors[] = 'Tipe peserta tidak valid.';
}

if (!in_array($learningMode, ['offline', 'online', 'hybrid'], true)) {
    $errors[] = 'Metode belajar tidak valid.';
}

if (!in_array($packageCount, [1, 2, 3], true)) {
    $errors[] = 'Jumlah paket tidak valid.';
}

if ($phone !== '' && !preg_match('/^[0-9+\-\s]{8,15}$/', $phone)) {
    $errors[] = 'Nomor HP tidak valid.';
}

// 3. Tampilkan error lalu hentikan proses
if ($errors !== []) {
    // 422 Unprocessable Content: data terkirim, tetapi isinya tidak valid
    http_response_code(422);

    pageStart('Data Belum Valid', $siteName, 'Validasi gagal', 'Data belum dapat diproses', 'Perbaiki isian berikut lalu kirim ulang formulirnya.');
    ?>
    <div class="card">
        <h2>Yang perlu diperbaiki</h2>
        <ul class="errors">
            <?php foreach ($errors as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
        <div class="actions">
            <a class="btn btn-primary" href="registration.php">Kembali ke form</a>
        </div>
    </div>
    <?php
    pageEnd($siteName);
    exit;
}

// 4. Hitung biaya: satuan -> jumlah paket -> subtotal -> persen -> nilai diskon -> total
$discountPercent = getDiscountPercent($participantType);
$grossTotal = $course['fee'] * $packageCount;
$discountAmount = intdiv($grossTotal * $discountPercent, 100);
$finalTotal = $grossTotal - $discountAmount;

// 5. Label metode belajar (switch)
$learningModeLabel = getLearningModeLabel($learningMode);

// 6. Simpan ke history sementara (session), cegah dobel saat halaman di-refresh
$entry = [
    'name' => $name,
    'course' => $course['name'],
    'learning_mode' => $learningMode,
    'total' => $finalTotal,
];

$_SESSION['history'] = $_SESSION['history'] ?? [];
$lastEntry = $_SESSION['history'] === [] ? null : end($_SESSION['history']);

if ($lastEntry !== $entry) {
    $_SESSION['history'][] = $entry;
}

pageStart('Ringkasan Pendaftaran', $siteName, 'Ringkasan pendaftaran', 'Pendaftaran Berhasil Diproses', 'Periksa kembali pilihan kursus dan rincian biaya Anda.');
?>
    <div class="card">
        <h2>Data pendaftaran</h2>
        <dl class="summary">
            <dt>Nama</dt> <dd><?= e($name) ?></dd>
            <dt>Email</dt> <dd><?= e($email) ?></dd>
            <?php if ($phone !== ''): ?>
                <dt>Nomor HP</dt> <dd><?= e($phone) ?></dd>
            <?php endif; ?>
            <?php if ($studyProgram !== ''): ?>
                <dt>Program Studi</dt> <dd><?= e($studyProgram) ?></dd>
            <?php endif; ?>
            <dt>Kursus</dt> <dd><?= e($course['name']) ?></dd>
            <dt>Tipe peserta</dt> <dd><?= e(ucfirst($participantType)) ?></dd>
            <dt>Metode</dt> <dd><?= e($learningModeLabel) ?></dd>
            <dt>Jumlah paket</dt> <dd><?= $packageCount ?></dd>
            <?php if ($notes !== ''): ?>
                <dt>Catatan</dt> <dd><?= e($notes) ?></dd>
            <?php endif; ?>
        </dl>
    </div>

    <div class="card">
        <h2>Rincian biaya</h2>
        <table class="cost">
            <tr><td>Subtotal</td><td><?= formatRupiah($grossTotal) ?></td></tr>
            <tr><td>Diskon <?= $discountPercent ?>%</td><td>-<?= formatRupiah($discountAmount) ?></td></tr>
            <tr class="total"><td>Total akhir</td><td><?= formatRupiah($finalTotal) ?></td></tr>
        </table>
    </div>

    <div class="card">
        <h2>Minat</h2>
        <?php if ($interests === []): ?>
            <p class="empty">Belum memilih minat.</p>
        <?php else: ?>
            <ul class="chips">
                <?php foreach ($interests as $interest): ?>
                    <?php $label = $interestOptions[$interest] ?? $interest; ?>
                    <li class="chip"><?= e($label) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="actions">
        <a class="btn btn-primary" href="registration.php">Daftar lagi</a>
        <a class="btn btn-secondary" href="history.php">Lihat history</a>
        <a class="btn btn-link" href="index.php">Kembali ke beranda</a>
    </div>
<?php
pageEnd($siteName);
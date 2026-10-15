<?php
// Loop Lab - katalog kursus dirender dengan foreach (tema Pisang Pride)

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/data.php';

$siteName = 'KursusKu';

// Jumlah paket yang tersedia per kursus (sesuai tampilan Loop Lab).
// Ubah angkanya di sini kalau perhitungan di projectmu berbeda.
$packagesAvailable = [
    'WEB-01' => 2,
    'PHP-01' => 3,
    'PHP-02' => 3,
    'LAR-01' => 3,
    'DB-01'  => 2,
    'UI-01'  => 2,
];
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Loop Lab - <?= e($siteName) ?></title>
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
        --text: #f7ebc8;
        --muted: #c9b27a;
    }

    * { box-sizing: border-box; }

    html { scroll-behavior: smooth; }

    body {
        margin: 0;
        min-height: 100vh;
        background:
            radial-gradient(ellipse at 12% 0%, rgba(255, 210, 63, 0.12), transparent 50%),
            radial-gradient(ellipse at 90% 100%, rgba(242, 169, 0, 0.08), transparent 45%),
            var(--peel-900);
        color: var(--text);
        font-family: "Trebuchet MS", "Segoe UI", system-ui, sans-serif;
        font-size: 15px;
        line-height: 1.6;
    }

    .container {
        width: min(1080px, 100% - 40px);
        margin-inline: auto;
    }

    /* ---------- Navigasi ---------- */
    .site-header {
        position: sticky;
        top: 0;
        z-index: 10;
        background: rgba(23, 14, 6, 0.88);
        backdrop-filter: blur(8px);
        border-bottom: 1px solid var(--peel-line);
    }

    .site-nav {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 14px 0;
    }

    .brand {
        margin-right: auto;
        font-size: 20px;
        font-weight: 800;
        color: var(--banana);
        text-decoration: none;
        letter-spacing: 0.2px;
    }

    .site-nav a.link {
        padding: 6px 12px;
        border-radius: 8px;
        color: var(--muted);
        text-decoration: none;
        font-size: 14px;
    }

    .site-nav a.link:hover { color: var(--banana-soft); }

    .site-nav a.link.active {
        background: var(--peel-700);
        color: var(--banana);
        box-shadow: inset 0 -2px 0 var(--banana);
    }

    a:focus-visible, button:focus-visible {
        outline: 2px solid var(--banana);
        outline-offset: 2px;
    }

    /* ---------- Judul ---------- */
    .page-head {
        padding: 56px 0 26px;
    }

    .page-head h1 {
        margin: 0 0 8px;
        font-size: clamp(28px, 5vw, 40px);
        line-height: 1.15;
        color: var(--banana);
    }

    .page-head p {
        margin: 0;
        max-width: 56ch;
        color: var(--muted);
    }

    /* ---------- Grid kartu ---------- */
    .course-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding-bottom: 40px;
    }

    .course-card {
        position: relative;
        padding: 22px 22px 20px;
        background: linear-gradient(180deg, var(--peel-800), var(--peel-900));
        border: 1px solid var(--peel-line);
        border-radius: 14px;
        overflow: hidden;
    }

    .course-card::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 3px;
        background: linear-gradient(90deg, var(--banana-deep), var(--banana), var(--stem));
    }

    .package-badge {
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 0 0 12px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--banana);
    }

    .dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--banana);
        box-shadow: 0 0 0 3px rgba(255, 210, 63, 0.2);
    }

    .course-card h3 {
        margin: 0 0 14px;
        text-align: center;
        font-size: 20px;
        color: var(--banana-soft);
    }

    .facility-title {
        margin: 0 0 8px;
        font-size: 14px;
        font-weight: 700;
        color: var(--banana-soft);
    }

    .facility-list {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px 14px;
        margin: 0;
        padding: 0;
        list-style: none;
        font-size: 14px;
    }

    .facility-list li {
        display: flex;
        gap: 6px;
        align-items: flex-start;
    }

    .facility-list .check {
        color: var(--stem);
        font-weight: 700;
    }

    /* ---------- Tombol bawah ---------- */
    .page-foot {
        display: flex;
        justify-content: center;
        padding: 0 0 48px;
    }

    .btn {
        display: inline-block;
        padding: 10px 22px;
        border-radius: 999px;
        background: var(--banana);
        color: var(--peel-900);
        font-weight: 800;
        text-decoration: none;
    }

    .btn:hover { background: var(--banana-soft); }

    footer {
        padding: 18px 0 28px;
        border-top: 1px solid var(--peel-line);
        text-align: center;
        font-size: 13px;
        color: var(--muted);
    }

    @media (max-width: 900px) {
        .course-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 600px) {
        .course-grid { grid-template-columns: 1fr; }
        .site-nav { flex-wrap: wrap; }
        .brand { width: 100%; }
    }

    @media (prefers-reduced-motion: reduce) {
        html { scroll-behavior: auto; }
    }
</style>
</head>
<body>

<header class="site-header">
    <nav class="site-nav container" aria-label="Navigasi utama">
        <a class="brand" href="index.php"><?= e($siteName) ?></a>
        <a class="link" href="index.php">Beranda</a>
        <a class="link" href="registration.php">Daftar</a>
        <a class="link" href="history.php">History</a>
        <a class="link active" href="loop-lab.php" aria-current="page">Loop Lab</a>
    </nav>
</header>

<main class="container">
    <div class="page-head">
        <h1>Loop Lab</h1>
        <p>Daftar kursus dan fasilitasnya dirender memakai perulangan <code>foreach</code> dari data di <code>data.php</code>.</p>
    </div>

    <div class="course-grid">
        <?php foreach ($courses as $course): ?>
            <?php $paket = $packagesAvailable[$course['code']] ?? 1; ?>
            <article class="course-card">
                <p class="package-badge"><span class="dot"></span><?= $paket ?> paket tersedia</p>
                <h3><?= e($course['name']) ?></h3>
                <p class="facility-title">Fasilitas</p>
                <ul class="facility-list">
                    <?php foreach ($facilities as $facility): ?>
                        <li><span class="check" aria-hidden="true">&#10003;</span> <?= e($facility) ?></li>
                    <?php endforeach; ?>
                </ul>
            </article>
        <?php endforeach; ?>
    </div>

    <div class="page-foot">
        <a class="btn" href="index.php">Kembali ke Beranda</a>
    </div>
</main>

<footer>
    <small>&copy; <?= e(date('Y')) ?> <?= e($siteName) ?> Pisang Pride</small>
</footer>

</body>
</html>
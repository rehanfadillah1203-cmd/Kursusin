<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/data.php';

$siteName = 'KursusKu Pisang Pride';

// Fungsi hitung biaya: subtotal - diskon + biaya admin
function hitungBiaya(int $fee, int $peserta, int $diskonPersen, int $admin): array
{
    $subtotal = $fee * $peserta;
    $diskon   = intdiv($subtotal * $diskonPersen, 100);
    $total    = $subtotal - $diskon + $admin;

    return [
        'subtotal' => $subtotal,
        'diskon'   => $diskon,
        'total'    => $total,
    ];
}

// Data contoh (Laravel Fundamental diambil dari data.php)
$course = findCourse($courses, 'LAR-01');
$fee          = $course['fee'];
$peserta      = 2;
$diskonPersen = 10;
$admin        = 25000;
$status       = 'Aktif';

$hasil = hitungBiaya($fee, $peserta, $diskonPersen, $admin);

// Test matrix: Expected diisi manual, Actual dihitung program
$tests = [
    ['fee' => 350000, 'peserta' => 1, 'diskon' => 0,  'admin' => 25000, 'expected' => 375000],
    ['fee' => 350000, 'peserta' => 1, 'diskon' => 10, 'admin' => 25000, 'expected' => 340000],
    ['fee' => 350000, 'peserta' => 2, 'diskon' => 10, 'admin' => 25000, 'expected' => 655000],
    ['fee' => 350000, 'peserta' => 3, 'diskon' => 10, 'admin' => 25000, 'expected' => 970000],
];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kalkulator Estimasi Biaya - <?= e($siteName) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/polish.css">
</head>
<body>
  <header class="site-header">
    <nav class="site-nav container" aria-label="Navigasi utama">
      <a class="brand" href="index.php"><?= e($siteName) ?></a>
      <a href="index.php">Beranda</a>
      <a href="registration.php">Daftar Kursus</a>
      <a href="history.php">History</a>
    </nav>
  </header>

  <main class="container">
    <section>
      <p><a href="index.php">&larr; Kembali ke Beranda</a></p>
      <h2>Kalkulator Estimasi Biaya</h2>
      <p>Hitung estimasi biaya kursus berdasarkan jumlah peserta dan diskon.</p>

      <div class="summary-card">
        <dl class="summary-list">
          <dt>Nama Kursus</dt> <dd><b><?= e($course['name']) ?></b></dd>
          <dt>Status</dt>      <dd><b><?= e($status) ?></b></dd>
        </dl>

        <table>
          <thead>
            <tr><th>Komponen</th><th>Nilai</th></tr>
          </thead>
          <tbody>
            <tr><td>Biaya per peserta</td><td><?= formatRupiah($fee) ?></td></tr>
            <tr><td>Jumlah peserta</td><td><?= $peserta ?> orang</td></tr>
            <tr><td>Subtotal</td><td><?= formatRupiah($hasil['subtotal']) ?></td></tr>
            <tr><td>Diskon (<?= $diskonPersen ?>%)</td><td>- <?= formatRupiah($hasil['diskon']) ?></td></tr>
            <tr><td>Biaya admin</td><td><?= formatRupiah($admin) ?></td></tr>
            <tr><td><b>Total Akhir</b></td><td><b><?= formatRupiah($hasil['total']) ?></b></td></tr>
          </tbody>
        </table>
      </div>
    </section>

    <section>
      <h2>Rumus Perhitungan</h2>
      <div class="summary-card">
        <p>Subtotal = Biaya &times; Jumlah Peserta</p>
        <p>Diskon = Subtotal &times; Persentase Diskon &divide; 100</p>
        <p>Total = Subtotal - Diskon + Biaya Admin</p>
      </div>
    </section>

    <section>
      <h2>Test Matrix</h2>
      <p>Pengujian dilakukan dengan membandingkan hasil yang diharapkan dengan hasil perhitungan program.</p>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Biaya/Peserta</th>
            <th>Peserta</th>
            <th>Diskon</th>
            <th>Admin</th>
            <th>Expected</th>
            <th>Actual</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tests as $index => $t): ?>
            <?php
              $actual = hitungBiaya($t['fee'], $t['peserta'], $t['diskon'], $t['admin'])['total'];
              $pass   = $actual === $t['expected'];
            ?>
            <tr>
              <td><?= $index + 1 ?></td>
              <td><?= formatRupiah($t['fee']) ?></td>
              <td><?= $t['peserta'] ?></td>
              <td><?= $t['diskon'] ?>%</td>
              <td><?= formatRupiah($t['admin']) ?></td>
              <td><?= formatRupiah($t['expected']) ?></td>
              <td><?= formatRupiah($actual) ?></td>
              <td><span class="badge <?= $pass ? 'badge-available' : 'badge-full' ?>"><?= $pass ? 'PASS' : 'FAIL' ?></span></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>
  </main>

  <footer>
    <small>&copy; <?= e(date('Y')) ?> <?= e($siteName) ?></small>
  </footer>
</body>
</html>
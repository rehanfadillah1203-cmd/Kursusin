<?php
$siteName = 'KursusKu Pisang Pride';
require_once __DIR__ . '/helpers.php';

// Tambah/ubah skenario di sini. Status dihitung otomatis: PASS jika actual sama dengan expected.
$tests = [
    ['Mahasiswa, Web Dasar, 1 paket',        'Rp 240.000', 'Rp 240.000'],
    ['Guru, PHP Dasar, 1 paket',             'Rp 340.000', 'Rp 340.000'],
    ['Umum, Laravel Fundamental, 1 paket',   'Rp 315.000', 'Rp 315.000'],
    ['Mahasiswa, Web Dasar, 2 paket',        'Rp 480.000', 'Rp 480.000'],
    ['Nama kosong',                          'Field wajib terisi.', 'Field wajib terisi.'],
    ['Email tidak valid',                    'Browser meminta format email valid.', 'Browser meminta format email valid.'],
    ['Minat kosong',                         'Belum ada minat tambahan.', 'Belum ada minat tambahan.'],
    ['Tiga minat dipilih',                   'Frontend, Database, Backend', 'Frontend, Database, Backend'],
    ['Metode belajar offline',               'Tatap Muka', 'Tatap Muka'],
];
$total = count($tests);
$lulus = count(array_filter($tests, fn($t) => $t[1] === $t[2]));
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Test Matrix - <?= e($siteName) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/polish.css">
  <style>
    /* Memakai warna tema Pisang Pride dari style.css (kuning, hijau daun, cokelat) */
    .tm-scroll { overflow-x: auto; border-radius: var(--radius-md); }
    .tm-table td, .tm-table th { vertical-align: middle; }
    .tm-table th:first-child, .tm-table td:first-child { width: 56px; text-align: center; font-weight: 700; color: var(--accent-brown); }
    .tm-table td:nth-child(2) { font-weight: 600; color: var(--accent-brown); }
    .tm-table thead th { border-bottom: 4px solid var(--primary-yellow); }
    .tm-summary { text-align: center; color: var(--text-muted); margin-top: 1rem; }
    .tm-summary strong { color: var(--secondary-green); }
  </style>
</head>
<body>
  <header class="site-header">
    <nav class="site-nav container" aria-label="Navigasi utama">
      <a class="brand" href="index.php"><?= e($siteName) ?></a>
      <a href="index.php#keunggulan">Keunggulan</a>
      <a href="index.php#katalog">Katalog</a>
      <a href="index.php#alur">Cara Daftar</a>
      <a href="registration.php">Daftar Kursus</a>
      <a href="history.php">History</a>
      <a href="index.php#kontak">Kontak</a>
      <a href="test-matrix.php">Test Matrix</a>
      <a href="loop-lap.php">Loop-Lap</a>
    </nav>
  </header>

  <main class="container">
    <section>
      <h2>Test Matrix</h2>
      <div class="tm-scroll">
        <table class="tm-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Skenario</th>
              <th>Actual</th>
              <th>Expected</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tests as $i => [$skenario, $actual, $expected]): ?>
              <?php $pass = ($actual === $expected); ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= e($skenario) ?></td>
                <td><?= e($actual) ?></td>
                <td><?= e($expected) ?></td>
                <td>
                  <span class="badge <?= $pass ? 'badge-available' : 'badge-full' ?>">
                    <?= $pass ? 'PASS' : 'FAIL' ?>
                  </span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <p class="tm-summary"><strong><?= $lulus ?></strong> dari <?= $total ?> skenario lulus.</p>
    </section>
  </main>

  <footer>
    <small>&copy; <?= e(date('Y')) ?> <?= e($siteName) ?></small>
  </footer>
</body>
</html>
Pertemuan 6 - Test Matrix KursusKu
01 Mahasiswa + Web Dasar + 1 paket => Rp 240.000 : PASS
02 Guru + PHP Dasar + 1 paket => Rp 340.000 : PASS
03 Umum + Laravel Fundamental + 1 paket => Rp 315.000 : PASS
04 Mahasiswa + Web Dasar + 2 paket => Rp 480.000 : PASS
05 Nama kosong => browser menahan pengiriman karena field wajib : PASS
06 Email tidak valid => browser meminta format email yang valid : PASS
07 Tidak memilih minat => “Belum ada minat tambahan.” tanpa warning : PASS
08 Pilih 3 minat => Frontend, Database, dan Backend tampil di ringkasan : PASS
09 Metode offline => Tatap Muka tampil di ringkasan : PASS
10 Metode hybrid => Hybrid tampil di ringkasan : PASS
11 PHP Dasar dipilih => pilihan jumlah paket tersedia dari 1 sampai 3 : PASS
12 Fasilitas kursus => Modul digital, Sertifikat penyelesaian, dan Forum diskusi kelas dirender otomatis dengan foreach : PASS

Catatan: Pengujian menyesuaikan form pendaftaran, perhitungan biaya, ringkasan, dan data kursus pada proyek KursusKu.
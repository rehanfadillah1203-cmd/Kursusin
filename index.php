<?php
$siteName = 'KursusKu Pisang Pride';
$tagline  = 'Belajar, daftar, dan kelola kursus dalam satu tempat.';
$year     = date('Y');

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/data.php';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($siteName) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/polish.css">
</head>

<body class="home-page">
  <header class="site-header">
    <nav class="site-nav container" aria-label="Navigasi utama">
      <a class="brand" href="index.php"><?= e($siteName) ?></a>
      <a href="#keunggulan">Keunggulan</a>
      <a href="#katalog">Katalog</a>
      <a href="#alur">Cara Daftar</a>
      <a href="registration.php">Daftar Kursus</a>
      <a href="history.php">History</a>
      <a href="#kontak">Kontak</a>
    </nav>
  </header>

  <main class="container">
    <section id="hero" class="page-intro">
      <p class="eyebrow">Platform Belajar Teknologi</p>
      <h1><?= e($tagline) ?></h1>
      <p>Temukan kursus teknologi yang relevan untuk meningkatkan keterampilan Anda.</p>
      <div class="hero-buttons">
        <a href="#katalog" class="btn-primary">Lihat Kursus</a>
        <a href="fee-calculator.php" class="calculator-link">Lihat Estimasi Biaya <span aria-hidden="true">→</span></a>
      </div>
      <div class="hero-highlights" aria-label="Keunggulan singkat KursusKu">
        <div><strong><?= count($courses) ?></strong><span>Kursus pilihan</span></div>
        <div><strong>3</strong><span>Metode belajar</span></div>
        <div><strong>100%</strong><span>Fokus praktik</span></div>
      </div>
    </section>

    <section id="keunggulan">
      <h2>Mengapa Memilih KursusKu?</h2>
      <div class="feature-grid">
        <article class="feature-card">
          <h3>Materi Terarah</h3>
          <p>Materi disusun bertahap dari dasar hingga praktik.</p>
        </article>
        <article class="feature-card">
          <h3>Belajar dengan Proyek</h3>
          <p>Setiap tahap menghasilkan bagian nyata dari aplikasi.</p>
        </article>
        <article class="feature-card">
          <h3>Pendampingan Praktik</h3>
          <p>Mahasiswa belajar melalui demonstrasi, latihan, dan evaluasi.</p>
        </article>
      </div>

      <h3>Fasilitas</h3>
      <ul>
        <?php foreach ($facilities as $facility): ?>
          <li><?= e($facility) ?></li>
        <?php endforeach; ?>
      </ul>
    </section>

    <section id="katalog">
      <h2>Katalog Kursus</h2>
      <table>
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama Kursus</th>
            <th>Biaya</th>
            <th>Mulai</th>
            <th>Sisa Kursi</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($courses as $course): ?>
            <?php
              $status = statusKursus($course['quota'], $course['registered']);
              $class  = $status === 'Penuh' ? 'badge-full' : 'badge-available';
            ?>
            <tr>
              <td><?= e($course['code']) ?></td>
              <td><?= e($course['name']) ?></td>
              <td><?= formatRupiah($course['fee']) ?></td>
              <td><?= e(formatTanggal($course['start_date'])) ?></td>
              <td><?= sisaKursi($course['quota'], $course['registered']) ?></td>
              <td><span class="badge <?= $class ?>"><?= e($status) ?></span></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>

    <section id="alur">
      <h2>Cara Mendaftar</h2>
      <ol>
        <li>Pilih kursus yang diminati.</li>
        <li>Isi form pendaftaran.</li>
        <li>Periksa kembali data.</li>
        <li>Kirim pendaftaran dan tunggu konfirmasi.</li>
      </ol>
    </section>

    <section id="media">
      <h2>Kenali Program Kami</h2>
      <img src="assets/images/hero-kursus.jpg" alt="Mahasiswa sedang mengikuti kegiatan kursus komputer" width="640">
      <h3>Video Singkat</h3>
      <video controls width="640">
        <source src="assets/video/intro-kursus.mp4" type="video/mp4">
        Browser Anda tidak mendukung video HTML5.
      </video>
      <p><a href="https://www.php.net/" target="_blank" rel="noopener">Dokumentasi PHP</a></p>
    </section>

    <section id="kontak">
      <h2>Kontak</h2>
      <p>Email: rehanfadillah1203@gmail.com</p>
      <p>Alamat: Pisang Pride</p>
    </section>
  </main>

  <footer>
    <small>&copy; <?= e($year) ?> <?= e($siteName) ?></small>
  </footer>
</body>
</html>
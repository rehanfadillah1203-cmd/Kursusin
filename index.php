<?php
require_once __DIR__ . '/helpers.php';

$siteName = 'KursusKu Pisang Pride';
$tagline = 'Belajar, daftar, dan kelola kursus dalam satu tempat.';
$year = date('Y');

$courses = [
  [
    'code' => 'KBT-01',
    'name' => 'Kabataku Dasar',
    'fee' => 150000,
    'quota' => 30,
    'registered' => 12,
    'start_date' => '2026-09-21',
  ],
  [
    'code' => 'KBT-02',
    'name' => 'Menghitung',
    'fee' => 150000,
    'quota' => 25,
    'registered' => 25,
    'start_date' => '2026-09-24',
  ],
  [
    'code' => 'KBT-03',
    'name' => 'Penjumlahan dan Pengurangan',
    'fee' => 175000,
    'quota' => 30,
    'registered' => 18,
    'start_date' => '2026-09-28',
  ],
  [
    'code' => 'KBT-04',
    'name' => 'Mengenal Huruf',
    'fee' => 150000,
    'quota' => 25,
    'registered' => 0,
    'start_date' => '2026-10-01',
  ],
  [
    'code' => 'KBT-05',
    'name' => 'Membaca Dasar',
    'fee' => 175000,
    'quota' => 20,
    'registered' => 9,
    'start_date' => '2026-10-03',
  ],
  [
    'code' => 'KBT-06',
    'name' => 'Menulis Dasar',
    'fee' => 175000,
    'quota' => 25,
    'registered' => 24,
    'start_date' => '2026-10-05',
  ],
];
?>
<?php $siteName = 'KursusKu Pisang Pride';
$tagline = 'Belajar, daftar, dan kelola kursus dalam satu tempat.';
$year = date('Y'); ?>
<!doctype html>
<html lang="id">
  
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($siteName) ?></title>

  <!-- HUBUNGKAN FILE CSS DI SINI -->
  <link rel="stylesheet" href="style.css">
</head>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($siteName) ?></title>
</head>

<body> 
  <header>
    <nav aria-label="Navigasi utama"> <a href="index.php"> <strong><?= htmlspecialchars($siteName) ?></strong> </a> <a href="#keunggulan">Keunggulan</a> <a href="#katalog">Katalog</a> <a href="#alur">Cara Daftar</a> <a href="#kontak">Kontak</a> </nav>
  </header>
  <main>
    <section id="hero">
      <h1><?= htmlspecialchars($tagline) ?></h1>
      <p> Temukan kursus teknologi yang relevan untuk meningkatkan keterampilan Anda. </p> <a href="#katalog"> Lihat Katalog Kursus </a>
    </section>
    <section id="keunggulan">
      <h2>Mengapa Memilih KursusKu?</h2>
      <article>
        <h3>Materi Terarah</h3>
        <p> Materi disusun bertahap dari dasar hingga praktik. </p>
      </article>
      <article>
        <h3>Belajar dengan Proyek</h3>
        <p> Setiap tahap menghasilkan hasil nyata. </p>
      </article>
      <article>
        <h3>Pendampingan Praktik</h3>
        <p> siswa belajar melalui demonstrasi, latihan, dan evaluasi. </p>
      </article>
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
          $statusClass = $status === 'Penuh' ? 'badge-full' : 'badge-available';
        ?>
        <tr>
          <td><?= htmlspecialchars($course['code']) ?></td>
          <td><?= htmlspecialchars(trim($course['name'])) ?></td>
          <td><?= rupiah($course['fee']) ?></td>
          <td><?= formatTanggal($course['start_date']) ?></td>
          <td><?= sisaKursi($course['quota'], $course['registered']) ?></td>
          <td><span class="<?= $statusClass ?>"><?= $status ?></span></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>
    <a href="fee-calculator.php">Lihat Estimasi Biaya</a>
    <section id="alur">
      <h2>Cara Mendaftar</h2>
      <ol>
        <li>Pilih kursus yang diminati.</li>
        <li>Isi form pendaftaran dengan benar.</li>
        <li>Periksa kembali data.</li>
        <li> Kirim pendaftaran dan tunggu konfirmasi admin. </li>
      </ol>
    </section>
    <section id="media">
      <h2>Kenali Program Kami</h2> <img src="aseets/images/hero-kursus.jpg" alt="Siswa sedang mengikuti kegiatan kursus komputer" width="640">
      <h3>Video Singkat</h3> <video controls width="640">
        <source src="aseets/video/intro-kursus.mp4" type="video/mp4"> Browser Anda tidak mendukung video HTML5.
      </video>
      <p> <a href="https://www.php.net/" target="_blank" rel="noopener"> Dokumentasi PHP </a> </p>
    </section>
    <section id="kontak">
      <h2>Kontak</h2>
      <p> Email: rehanfadillah1203@gmail.com </p>
      <p> Alamat:Pisang Pride cuy </p>
    </section>
  </main>
  <footer> <small> &copy; <?= $year ?> <?= htmlspecialchars($siteName) ?> </small> </footer>
</body>

</html>
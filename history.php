<?php
session_start();

require_once __DIR__ . '/helpers.php';

$siteName = 'KursusKu Pisang Pride';

// History otomatis dari pendaftar di session (pastikan selalu array)
$history = $_SESSION['history'] ?? [];
if (!is_array($history)) {
  $history = [];
}

// Label metode belajar (sesuai value di form registration.php)
$modeLabels = [
  'offline' => 'Tatap muka',
  'online'  => 'Online',
  'hybrid'  => 'Hybrid',
];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>History Pendaftaran - <?= e($siteName) ?></title>
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
      <h2>History Pendaftaran</h2>
      <p>Daftar pendaftaran yang kamu lakukan pada sesi ini.</p>
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kursus</th>
            <th>Metode Belajar</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($history)): ?>
            <tr>
              <td colspan="5">Belum ada data pendaftaran.</td>
            </tr>
          <?php else: ?>
            <?php foreach ($history as $index => $item): ?>
              <?php
                // Coba beberapa kemungkinan key yang dipakai di process-registration.php
                $mode = $item['learning_mode'] ?? $item['method'] ?? $item['metode'] ?? '';
              ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= e($item['name'] ?? '-') ?></td>
                <td><?= e($item['course'] ?? '-') ?></td>
                <td><?= e($modeLabels[$mode] ?? ($mode !== '' ? $mode : '-')) ?></td>
                <td><?= formatRupiah($item['total'] ?? 0) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>
<?php
$courseName = 'Laravel Fundamental';
$fee = 3500000;
$participantCount = 5;
$discountPercent = 20;
$adminFee = 70000;
$isActive = true;

$subtotal = $fee * $participantCount;
$discount = intdiv($subtotal * $discountPercent, 100);
$total = $subtotal - $discount + $adminFee;
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kalkulator Biaya - KursusKu</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav aria-label="Navigasi utama">
      <a href="index.php"><strong>KursusKu Pisang Pride</strong></a>
      <a href="index.php#katalog">Katalog</a>
      <a href="index.php#kontak">Kontak</a>
    </nav>
  </header>

  <main>
    <section id="kalkulator">
      <h2>Kalkulator Estimasi Biaya</h2>
      <p>Kursus: <strong><?= htmlspecialchars($courseName) ?></strong></p>
      <table>
        <tr><th>Komponen</th><th>Nilai</th></tr>
        <tr><td>Biaya per peserta</td><td>Rp <?= number_format($fee, 0, ',', '.') ?></td></tr>
        <tr><td>Jumlah peserta</td><td><?= $participantCount ?></td></tr>
        <tr><td>Subtotal</td><td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td></tr>
        <tr><td>Diskon (<?= $discountPercent ?>%)</td><td>- Rp <?= number_format($discount, 0, ',', '.') ?></td></tr>
        <tr><td>Biaya admin</td><td>Rp <?= number_format($adminFee, 0, ',', '.') ?></td></tr>
        <tr class="badge-available"><td><strong>Total akhir</strong></td><td><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td></tr>
      </table>
      <p style="margin-top:20px;"><a href="index.php" class="btn-estimasi">Kembali ke Beranda KursusKu</a></p>
    </section>
  </main>

  <footer>
    <small>&copy; <?= date('Y') ?> KursusKu Pisang Pride</small>
  </footer>
</body>
</html>
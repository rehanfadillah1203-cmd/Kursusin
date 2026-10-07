<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Loop Lab - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/polish.css">
</head>
<body>
  <header class="site-header">
    <nav class="site-nav container" aria-label="Navigasi utama">
      <a class="brand" href="index.php">KursusKu Pisang Pride</a>
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
    <h2>Loop Lab</h2>

    <h3>A. for</h3>
    <?php
    for ($i = 1; $i <= 5; $i++) {
        echo "Pertemuan ke-$i<br>";
    }
    ?>

    <h3>B. while</h3>
    <?php
    $i = 1;
    while ($i <= 5) {
        echo "Nomor antrean: $i<br>";
        $i++;
    }
    ?>

    <h3>C. do-while</h3>
    <?php
    $i = 1;
    do {
        echo "Percobaan ke-$i<br>";
        $i++;
    } while ($i <= 5);
    ?>

    <h3>Perbandingan: kondisi salah sejak awal ($i = 10)</h3>
    <?php
    $i = 10;
    echo '<b>while:</b> ';
    while ($i <= 5) {
        echo 'tidak pernah tampil';
        $i++;
    }
    echo '(tidak ada output)<br>';

    $i = 10;
    echo '<b>do-while:</b> ';
    do {
        echo "tampil sekali (i=$i)";
        $i++;
    } while ($i <= 5);
    ?>
  </section>
</main>

<footer>
  <small>&copy; <?= date('Y') ?> KursusKu Pisang Pride</small>
</footer>
</body>
</html>
<?php
session_start();

require __DIR__ . '/helpers.php';
require __DIR__ . '/data.php';

// Tolak akses langsung (GET) -> kembali ke form
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registration.php');
    exit;
}

// 1. Baca data POST dengan aman
$name            = trim($_POST['name'] ?? '');
$email           = trim($_POST['email'] ?? '');
$courseCode      = $_POST['course_code'] ?? '';
$participantType = $_POST['participant_type'] ?? '';
$learningMode    = $_POST['learning_mode'] ?? '';
$packageCount    = (int) ($_POST['package_count'] ?? 1);
$notes           = trim($_POST['notes'] ?? '');
$phone           = trim($_POST['phone'] ?? '');
$studyProgram    = trim($_POST['study_program'] ?? '');
$interests       = $_POST['interests'] ?? [];

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
    ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Belum Valid - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main class="container">
    <section>
      <h2>Data belum dapat diproses</h2>
      <div class="summary-card">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?= e($error) ?></li>
          <?php endforeach; ?>
        </ul>
        <p><a class="btn-link" href="registration.php">Kembali ke form</a></p>
      </div>
    </section>
  </main>
</body>
</html>
    <?php
    exit;
}

// 4. Hitung biaya: satuan -> jumlah paket -> subtotal -> persen -> nilai diskon -> total
$discountPercent = getDiscountPercent($participantType);
$grossTotal      = $course['fee'] * $packageCount;
$discountAmount  = intdiv($grossTotal * $discountPercent, 100);
$finalTotal      = $grossTotal - $discountAmount;

// 5. Label metode belajar (switch)
$learningModeLabel = getLearningModeLabel($learningMode);

// 6. Simpan ke history sementara (session), cegah dobel saat halaman di-refresh
$entry = [
    'name'          => $name,
    'course'        => $course['name'],
    'learning_mode' => $learningMode,   // <-- ini yang sebelumnya tidak disimpan
    'total'         => $finalTotal,
];
$_SESSION['history'] = $_SESSION['history'] ?? [];
$lastEntry = $_SESSION['history'] === [] ? null : end($_SESSION['history']);
if ($lastEntry !== $entry) {
    $_SESSION['history'][] = $entry;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Ringkasan Pendaftaran - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <main class="container">
    <div class="alert-success">Pendaftaran Berhasil Diproses</div>

    <div class="summary-card">
      <dl class="summary-list">
        <dt>Nama</dt>            <dd><?= e($name) ?></dd>
        <dt>Email</dt>           <dd><?= e($email) ?></dd>
        <?php if ($phone !== ''): ?>
          <dt>Nomor HP</dt>      <dd><?= e($phone) ?></dd>
        <?php endif; ?>
        <?php if ($studyProgram !== ''): ?>
          <dt>Program Studi</dt> <dd><?= e($studyProgram) ?></dd>
        <?php endif; ?>
        <dt>Kursus</dt>          <dd><?= e($course['name']) ?></dd>
        <dt>Tipe peserta</dt>    <dd><?= e($participantType) ?></dd>
        <dt>Metode</dt>          <dd><?= e($learningModeLabel) ?></dd>
        <dt>Jumlah paket</dt>    <dd><?= $packageCount ?></dd>
        <?php if ($notes !== ''): ?>
          <dt>Catatan</dt>       <dd><?= e($notes) ?></dd>
        <?php endif; ?>
      </dl>

      <h3>Rincian Biaya</h3>
      <p>Subtotal: <?= formatRupiah($grossTotal) ?></p>
      <p>Diskon: <?= $discountPercent ?>% (-<?= formatRupiah($discountAmount) ?>)</p>
      <p><b>Total akhir: <?= formatRupiah($finalTotal) ?></b></p>

      <h3>Minat</h3>
      <ul>
        <?php if ($interests === []): ?>
          <li>Belum memilih minat.</li>
        <?php else: ?>
          <?php foreach ($interests as $interest): ?>
            <?php $label = $interestOptions[$interest] ?? $interest; ?>
            <li><?= e($label) ?></li>
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>

      <p>
        <a class="btn-link" href="registration.php">Daftar lagi</a>
        <a class="btn-secondary" href="history.php">Lihat history</a>
        <a class="btn-link" href="index.php">Kembali ke beranda</a>
      </p>
    </div>
  </main>
</body>
</html>
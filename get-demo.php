<?php

declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Halaman hasil hanya menerima POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registration.php');
    exit;
}

$name            = trim($_POST['name'] ?? '');
$email           = trim($_POST['email'] ?? '');
$phone           = trim($_POST['phone'] ?? '');
$studyProgram    = trim($_POST['study_program'] ?? '');
$course          = trim($_POST['course'] ?? '');
$participantType = trim($_POST['participant_type'] ?? '');
$source          = trim($_POST['source'] ?? '');   // input hidden
$notes           = trim($_POST['notes'] ?? '');

// Checkbox name="interests[]" dikirim sebagai array
$interestsRaw = $_POST['interests'] ?? [];
$interests = is_array($interestsRaw)
    ? implode(', ', array_map('strval', $interestsRaw))
    : '';

$items = [
    'Nama'          => $name,
    'Email'         => $email,
    'Telepon'       => $phone,
    'Program studi' => $studyProgram,
    'Kursus'        => $course,
    'Jenis peserta' => $participantType,
    'Minat'         => $interests,
    'Sumber hidden' => $source,
];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hasil POST - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="utility-page">
  <main class="utility-card">
    <span class="eyebrow">MILESTONE 5 · HASIL POST</span>
    <h1>Data latihan diterima</h1>

    <div class="result-grid">
      <?php foreach ($items as $label => $value): ?>
        <div class="result-item">
          <strong><?= e($label) ?>:</strong>
          <span><?= e($value) ?></span>
        </div>
      <?php endforeach; ?>

      <div class="result-item result-item--full">
        <strong>Catatan</strong>
        <span><?= nl2br(e($notes)) ?></span>
      </div>
    </div>

    <div class="result-actions">
      <a class="button" href="registration.php">Isi Lagi</a>
      <a class="button button--outline" href="index.php">Beranda</a>
    </div>
  </main>
</body>
</html>
<?php
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/data.php';

$siteName = 'KursusKu Pisang Pride';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Kursus - <?= e($siteName) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/polish.css">
  <link rel="stylesheet" href="assets/css/form-dark.css">
</head>
<body class="form-page">
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
      <h2>Form Pendaftaran</h2>
      <p class="page-sub">Lengkapi data berikut untuk mendaftar kursus.</p>

      <form class="form-card" method="POST" action="process-registration.php">

        <div class="form-grid">
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input id="name" name="name" type="text" required>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" required>
          </div>

          <div class="form-group">
            <label for="phone">Nomor HP</label>
            <input id="phone" name="phone" type="tel" placeholder="Contoh: 081234567890">
          </div>

          <div class="form-group">
            <label for="study_program">Program Studi</label>
            <input id="study_program" name="study_program" type="text">
          </div>

          <div class="form-group full">
            <label for="course_code">Kursus yang Dipilih</label>
            <select id="course_code" name="course_code" required>
              <option value="">-- Pilih kursus --</option>
              <?php foreach ($courses as $course): ?>
                <option value="<?= e($course['code']) ?>">
                  <?= e($course['name']) ?> - <?= formatRupiah($course['fee']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="learning_mode">Metode Belajar</label>
            <select id="learning_mode" name="learning_mode" required>
              <option value="">-- Pilih metode belajar --</option>
              <option value="offline">Tatap muka</option>
              <option value="online">Online</option>
              <option value="hybrid">Hybrid</option>
            </select>
          </div>

          <div class="form-group">
            <label for="package_count">Jumlah Paket</label>
            <select id="package_count" name="package_count" required>
              <?php for ($i = 1; $i <= 3; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?> paket</option>
              <?php endfor; ?>
            </select>
          </div>
        </div>

        <fieldset>
          <legend>Jenis Peserta</legend>
          <div class="choice-grid">
            <label class="choice-card">
              <input type="radio" name="participant_type" value="mahasiswa" required>
              Mahasiswa
            </label>
            <label class="choice-card">
              <input type="radio" name="participant_type" value="guru">
              Guru
            </label>
            <label class="choice-card">
              <input type="radio" name="participant_type" value="umum">
              Umum
            </label>
          </div>
        </fieldset>

        <fieldset>
          <legend>Minat Tambahan</legend>
          <div class="choice-grid">
            <?php foreach ($interestOptions as $value => $label): ?>
              <label class="choice-card">
                <input type="checkbox" name="interests[]" value="<?= e($value) ?>">
                <?= e($label) ?>
              </label>
            <?php endforeach; ?>
          </div>
        </fieldset>

        <div class="form-group">
          <label for="notes">Catatan</label>
          <textarea id="notes" name="notes" rows="4" maxlength="300"
                    placeholder="Tulis catatan tambahan (opsional)"></textarea>
        </div>

        <button type="submit" class="btn-primary">Proses Pendaftaran</button>
      </form>
    </section>
  </main>

  <footer>
    <small>&copy; <?= e(date('Y')) ?> <?= e($siteName) ?></small>
  </footer>

  <script>
    // Jumlah paket baru aktif setelah kursus dipilih
    (function () {
      var course = document.getElementById('course_code');
      var pkg = document.getElementById('package_count');
      var placeholder = document.createElement('option');
      placeholder.value = '';
      placeholder.textContent = '-- Pilih kursus terlebih dahulu --';

      function sync() {
        if (course.value === '') {
          if (!placeholder.parentNode) { pkg.insertBefore(placeholder, pkg.firstChild); }
          pkg.value = '';
          pkg.disabled = true;
        } else {
          if (placeholder.parentNode) { pkg.removeChild(placeholder); }
          pkg.disabled = false;
          if (pkg.value === '') { pkg.value = '1'; }
        }
      }

      course.addEventListener('change', sync);
      sync();
    })();
  </script>
</body>
</html>
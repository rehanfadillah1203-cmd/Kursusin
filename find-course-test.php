<?php
// Simulasi findCourse() - KursusKu Pisang Pride
// File ini berdiri sendiri (tidak butuh helpers.php / data.php).

$siteName = 'KursusKu Pisang Pride';

$courses = [
    [
        'code' => 'WEB-01',
        'name' => 'Web Dasar',
        'fee' => 200000,
    ],
    [
        'code' => 'PHP-01',
        'name' => 'PHP Dasar',
        'fee' => 250000,
    ],
    [
        'code' => 'PHP-02',
        'name' => 'PHP Lanjutan',
        'fee' => 300000,
    ],
    [
        'code' => 'LAR-01',
        'name' => 'Laravel Fundamental',
        'fee' => 350000,
    ],
    [
        'code' => 'DB-01',
        'name' => 'MySQL Dasar',
        'fee' => 275000,
    ],
    [
        'code' => 'UI-01',
        'name' => 'UI Web Dasar',
        'fee' => 225000,
    ],
];

function findCourse(array $courses, string $code): ?array
{
    foreach ($courses as $course) {
        if ($course['code'] === $code) {
            return $course;
        }
    }

    return null;
}

$searchCode = 'laravel';
$result = findCourse($courses, $searchCode);

// Tangkap output var_dump supaya bisa ditampilkan di dalam kotak
ob_start();
var_dump($result);
$dumpOutput = trim(ob_get_clean());

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simulasi findCourse() - <?= h($siteName) ?></title>
  <style>
    :root {
      --peel-900: #1f1308;
      --peel-800: #2e1d0d;
      --peel-700: #43290f;
      --peel-line: #5c3d1b;
      --banana: #ffd23f;
      --banana-soft: #fff1b8;
      --spot: #ff8a5b;
      --spot-deep: #d9482b;
      --stem: #a8c256;
      --text: #f7ebc8;
      --muted: #c9b27a;
    }

    * { box-sizing: border-box; }

    body {
      margin: 0;
      min-height: 100vh;
      padding: 40px 16px;
      background:
        radial-gradient(circle at 15% 10%, rgba(255, 210, 63, 0.10), transparent 45%),
        var(--peel-900);
      color: var(--text);
      font-family: Consolas, "Courier New", monospace;
      font-size: 15px;
      line-height: 1.6;
    }

    .card {
      max-width: 680px;
      margin: 0 auto;
      padding: 26px 28px 28px;
      background: var(--peel-800);
      border: 1px solid var(--peel-line);
      border-top: 6px solid var(--banana);
      border-radius: 14px 14px 10px 10px;
    }

    .brand {
      margin: 0 0 6px;
      font-size: 12px;
      color: var(--muted);
    }

    h1 {
      margin: 0 0 18px;
      font-size: 20px;
      line-height: 1.4;
      color: var(--banana);
    }

    p { margin: 8px 0; }

    strong { color: var(--banana-soft); }

    code { color: var(--banana); }

    ul.codes {
      margin: 8px 0 0;
      padding: 0;
      list-style: none;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 6px 14px;
    }

    ul.codes li { display: flex; align-items: center; gap: 8px; }

    .chip {
      min-width: 70px;
      padding: 0 10px;
      border-radius: 999px;
      background: var(--banana);
      color: var(--peel-900);
      font-weight: 700;
      font-size: 13px;
      text-align: center;
    }

    hr {
      margin: 18px 0;
      border: 0;
      border-top: 1px dashed var(--peel-line);
    }

    .badge-null {
      padding: 2px 10px;
      border-radius: 4px;
      background: var(--spot-deep);
      color: #fff6e0;
      font-weight: 700;
    }

    .badge-found {
      padding: 2px 10px;
      border-radius: 4px;
      background: var(--stem);
      color: var(--peel-900);
      font-weight: 700;
    }

    pre {
      margin: 8px 0 0;
      padding: 14px 16px;
      background: var(--peel-700);
      border: 1px solid var(--peel-line);
      border-left: 4px solid var(--spot);
      border-radius: 8px;
      color: var(--banana-soft);
      font-family: inherit;
      overflow-x: auto;
    }

    pre.found { border-left-color: var(--stem); }

    @media (max-width: 480px) {
      body { padding: 24px 12px; }
      .card { padding: 20px 18px 22px; }
      h1 { font-size: 17px; }
    }
  </style>
</head>
<body>
  <div class="card">
    <p class="brand"><?= h($siteName) ?></p>
    <h1>Simulasi Fungsi findCourse($courses, "<?= h($searchCode) ?>")</h1>

    <p><strong>Daftar Kode Kursus yang Tersedia:</strong></p>
    <ul class="codes">
      <?php foreach ($courses as $course): ?>
        <li><span class="chip"><?= h($course['code']) ?></span> <?= h($course['name']) ?></li>
      <?php endforeach; ?>
    </ul>

    <hr>

    <p><strong>Pencarian:</strong> <code>findCourse($courses, "<?= h($searchCode) ?>")</code></p>
    <p>
      Hasil:
      <?php if ($result === null): ?>
        <span class="badge-null">NULL</span>
        (karena code "<?= h($searchCode) ?>" tidak tersedia di daftar kursus)
      <?php else: ?>
        <span class="badge-found"><?= h($result['name']) ?></span>
        (code "<?= h($searchCode) ?>" ditemukan di daftar kursus)
      <?php endif; ?>
    </p>

    <hr>

    <p><strong>Output var_dump(findCourse($courses, '<?= h($searchCode) ?>')):</strong></p>
    <pre class="<?= $result === null ? '' : 'found' ?>"><?= h($dumpOutput) ?></pre>
  </div>
</body>
</html>
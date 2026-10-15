<?php
// Uji coba operator identik (===) - KursusKu Pisang Pride

$siteName = 'KursusKu Pisang Pride';

// Deklarasi variabel
$fee = 350000;

// Perbandingan identik: nilai DAN tipe data harus sama
$isIdentical = $fee === 350000;

// Tangkap output var_dump supaya bisa ditampilkan di dalam kotak
ob_start();
var_dump($fee === 350000);
$dumpOutput = trim(ob_get_clean());
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Operator Test - <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></title>
<style>
    :root {
        --peel-900: #1f1308;
        --peel-800: #2e1d0d;
        --peel-700: #43290f;
        --peel-line: #5c3d1b;
        --banana: #ffd23f;
        --banana-soft: #fff1b8;
        --spot: #ff8a5b;
        --stem: #a8c256;
        --text: #f7ebc8;
        --muted: #c9b27a;
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        min-height: 100vh;
        padding: 40px 20px;
        background:
            radial-gradient(circle at 15% 10%, rgba(255, 210, 63, 0.10), transparent 45%),
            var(--peel-900);
        color: var(--text);
        font-family: Consolas, "Courier New", monospace;
        font-size: 14px;
        line-height: 1.6;
    }

    .panel {
        max-width: 640px;
        margin: 0 auto;
        padding: 28px 30px 30px;
        background: var(--peel-800);
        border: 1px solid var(--peel-line);
        border-top: 6px solid var(--banana);
        border-radius: 14px 14px 10px 10px;
    }

    h1 {
        margin: 0 0 22px;
        font-size: 19px;
        line-height: 1.35;
        color: var(--banana);
    }

    .brand {
        display: block;
        margin-bottom: 4px;
        font-size: 12px;
        font-weight: 400;
        color: var(--muted);
    }

    section {
        padding: 16px 0;
        border-top: 1px dashed var(--peel-line);
    }

    section:first-of-type { border-top: 0; padding-top: 0; }

    p { margin: 6px 0; }

    .label {
        font-weight: 700;
        color: var(--banana-soft);
    }

    code { color: var(--banana); }

    .value-true  { color: var(--stem); font-weight: 700; }
    .value-false { color: var(--spot); font-weight: 700; }

    .types {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        flex-wrap: wrap;
    }

    .type-card {
        flex: 1 1 200px;
        padding: 8px 12px;
        background: var(--peel-700);
        border: 1px solid var(--peel-line);
        border-radius: 8px;
    }

    .type-card small {
        display: block;
        color: var(--muted);
        font-size: 12px;
    }

    .type-card strong { color: var(--banana); }

    pre.dump {
        margin: 8px 0 0;
        padding: 14px 16px;
        background: var(--peel-700);
        border: 1px solid var(--peel-line);
        border-left: 4px solid var(--banana);
        border-radius: 8px;
        color: var(--banana-soft);
        font-family: inherit;
        overflow-x: auto;
    }

    .result-true  { border-left-color: var(--stem); }
    .result-false { border-left-color: var(--spot); }

    footer {
        max-width: 640px;
        margin: 14px auto 0;
        text-align: center;
        font-size: 12px;
        color: var(--muted);
    }
</style>
</head>
<body>

<main class="panel">
    <h1>
        <span class="brand"><?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></span>
        Uji Coba Operator Identik === (operator-test.php)
    </h1>

    <section>
        <p><span class="label">Deklarasi Variabel:</span> <code>$fee = <?= $fee ?>;</code></p>
    </section>

    <section>
        <p><span class="label">Ekspresi Perbandingan:</span> <code>$fee === 350000</code></p>
        <p>
            Hasil:
            <span class="<?= $isIdentical ? 'value-true' : 'value-false' ?>"><?= $isIdentical ? 'true' : 'false' ?></span>
            <?php if ($isIdentical): ?>
                (karena nilai dan tipe data sama-sama <?= gettype($fee) ?> <?= $fee ?>)
            <?php else: ?>
                (karena nilai atau tipe data tidak sama)
            <?php endif; ?>
        </p>
        <div class="types">
            <div class="type-card">
                <small>Sisi kiri: $fee</small>
                <strong><?= gettype($fee) ?></strong> (<?= $fee ?>)
            </div>
            <div class="type-card">
                <small>Sisi kanan: 350000</small>
                <strong><?= gettype(350000) ?></strong> (350000)
            </div>
        </div>
    </section>

    <section>
        <p><span class="label">Output var_dump($fee === 350000):</span></p>
        <pre class="dump <?= $isIdentical ? 'result-true' : 'result-false' ?>"><?= htmlspecialchars($dumpOutput, ENT_QUOTES, 'UTF-8') ?></pre>
    </section>
</main>

<footer>&copy; <?= date('Y') ?> <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></footer>

</body>
</html>
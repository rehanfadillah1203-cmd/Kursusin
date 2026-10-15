<?php
// Uji coba logika kursus - KursusKu Pisang Pride

$siteName = 'KursusKu Pisang Pride';

// Nilai variabel
$quota = 30;
$registered = 18;

// 1. Apakah kursus sudah penuh?
$isFull = $registered >= $quota;

// 2. Apakah masih ada kursi?
$hasSeat = $registered < $quota;

// Tangkap output var_dump supaya bisa ditampilkan di dalam kotak
function dumpToString($value): string
{
    ob_start();
    var_dump($value);
    return trim(ob_get_clean());
}

$isFullDump  = dumpToString($isFull);
$hasSeatDump = dumpToString($hasSeat);
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Logic Test - <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></title>
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

    h2 {
        margin: 0 0 8px;
        font-size: 14px;
        color: var(--banana-soft);
    }

    section {
        padding: 16px 0;
        border-top: 1px dashed var(--peel-line);
    }

    section:first-of-type { border-top: 0; padding-top: 0; }

    p { margin: 6px 0; }

    code { color: var(--banana); }

    ul.vars {
        margin: 8px 0 0;
        padding: 0;
        list-style: none;
    }

    ul.vars li {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 4px 0;
    }

    .chip {
        min-width: 104px;
        padding: 1px 10px;
        border-radius: 999px;
        background: var(--banana);
        color: var(--peel-900);
        font-weight: 700;
        text-align: center;
    }

    .meter {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 10px 0 0;
        color: var(--muted);
        font-size: 12px;
    }

    .meter-track {
        flex: 1;
        height: 10px;
        border-radius: 999px;
        background: var(--peel-700);
        border: 1px solid var(--peel-line);
        overflow: hidden;
    }

    .meter-fill {
        height: 100%;
        background: var(--banana);
    }

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
        Uji Coba Logika Kursus (logic-test.php)
    </h1>

    <section>
        <h2>Nilai Variabel:</h2>
        <ul class="vars">
            <li><span class="chip">$quota</span> = <?= $quota ?></li>
            <li><span class="chip">$registered</span> = <?= $registered ?></li>
        </ul>
        <div class="meter" aria-label="Kursi terisi <?= $registered ?> dari <?= $quota ?>">
            <span>Terisi</span>
            <div class="meter-track">
                <div class="meter-fill" style="width: <?= min(100, (int) round($registered / $quota * 100)) ?>%"></div>
            </div>
            <span><?= $registered ?>/<?= $quota ?></span>
        </div>
    </section>

    <section>
        <h2>1. Evaluasi <code>$isFull</code> (apakah $registered &gt;= $quota):</h2>
        <p>Output var_dump($isFull):</p>
        <pre class="dump <?= $isFull ? 'result-true' : 'result-false' ?>"><?= htmlspecialchars($isFullDump, ENT_QUOTES, 'UTF-8') ?></pre>
    </section>

    <section>
        <h2>2. Evaluasi <code>$hasSeat</code> (apakah $registered &lt; $quota):</h2>
        <p>Output var_dump($hasSeat):</p>
        <pre class="dump <?= $hasSeat ? 'result-true' : 'result-false' ?>"><?= htmlspecialchars($hasSeatDump, ENT_QUOTES, 'UTF-8') ?></pre>
    </section>
</main>

<footer>&copy; <?= date('Y') ?> <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></footer>

</body>
</html>
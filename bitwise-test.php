<?php
// Uji coba bitwise permission - KursusKu Pisang Pride

$siteName = 'KursusKu Pisang Pride';

// Definisi flag permission
$READ   = 1; // 001
$WRITE  = 2; // 010
$DELETE = 4; // 100

// Penggabungan izin dengan operator OR
$permission = $READ | $WRITE;

// Pengecekan izin delete dengan operator AND
$canDelete = ($permission & $DELETE) === $DELETE;

// Helper kecil: angka -> biner 3 digit
function bin3(int $n): string
{
    return str_pad(decbin($n), 3, '0', STR_PAD_LEFT);
}

// Tangkap output var_dump supaya bisa ditampilkan di dalam kotak
ob_start();
var_dump($canDelete);
$dumpOutput = trim(ob_get_clean());

$flags = [
    'READ'   => $READ,
    'WRITE'  => $WRITE,
    'DELETE' => $DELETE,
];
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bitwise Test - <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></title>
<style>
    :root {
        --peel-900: #1f1308;   /* kulit pisang gelap, latar halaman */
        --peel-800: #2e1d0d;   /* panel */
        --peel-700: #43290f;   /* kotak kode */
        --peel-line: #5c3d1b;  /* garis pemisah */
        --banana: #ffd23f;     /* kuning pisang matang */
        --banana-soft: #fff1b8;
        --spot: #ff8a5b;       /* bintik cokelat-oranye pada kulit pisang */
        --stem: #a8c256;       /* hijau tangkai */
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

    code {
        color: var(--banana);
    }

    ul.flags {
        margin: 8px 0 0;
        padding: 0;
        list-style: none;
    }

    ul.flags li {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 4px 0;
    }

    .chip {
        min-width: 78px;
        padding: 1px 10px;
        border-radius: 999px;
        background: var(--banana);
        color: var(--peel-900);
        font-weight: 700;
        text-align: center;
    }

    .bits {
        display: inline-flex;
        gap: 4px;
        vertical-align: middle;
    }

    .bit {
        width: 22px;
        height: 22px;
        border-radius: 6px;
        border: 1px solid var(--peel-line);
        text-align: center;
        line-height: 20px;
        font-weight: 700;
        color: var(--muted);
    }

    .bit.on {
        background: var(--banana);
        border-color: var(--banana);
        color: var(--peel-900);
    }

    .bit-labels {
        display: inline-flex;
        gap: 4px;
        margin-left: 2px;
        color: var(--muted);
        font-size: 12px;
    }

    .bit-labels span { width: 22px; text-align: center; }

    .value-true  { color: var(--stem); font-weight: 700; }
    .value-false { color: var(--spot); font-weight: 700; }

    .note {
        font-style: italic;
        color: var(--muted);
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
        Uji Coba Bitwise Permission (bitwise-test.php)
    </h1>

    <section>
        <h2>Definisi Nilai Flag:</h2>
        <ul class="flags">
            <?php foreach ($flags as $label => $value): ?>
                <li>
                    <span class="chip">$<?= $label ?></span>
                    = <?= $value ?> (biner: <?= bin3($value) ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <section>
        <h2>Penggabungan Izin: <code>$permission = $READ | $WRITE;</code></h2>
        <p>
            Nilai $permission: <strong><?= $permission ?></strong>
            (biner: <?= bin3($permission) ?>)
        </p>
        <p>
            <span class="bits" aria-label="Bit izin aktif">
                <?php foreach (array_reverse($flags, true) as $label => $value): ?>
                    <span class="bit <?= ($permission & $value) === $value ? 'on' : '' ?>">
                        <?= ($permission & $value) === $value ? '1' : '0' ?>
                    </span>
                <?php endforeach; ?>
            </span>
            <span class="bit-labels">
                <?php foreach (array_reverse($flags, true) as $label => $value): ?>
                    <span><?= substr($label, 0, 1) ?></span>
                <?php endforeach; ?>
            </span>
        </p>
    </section>

    <section>
        <h2>Pengecekan Izin Delete: <code>$canDelete = ($permission &amp; $DELETE) === $DELETE;</code></h2>
        <p>
            Nilai $canDelete:
            <span class="<?= $canDelete ? 'value-true' : 'value-false' ?>">
                <?= $canDelete ? 'true' : 'false' ?>
            </span>
        </p>
        <p class="note">
            <?php if ($canDelete): ?>
                (Alasan: true karena flag DELETE bernilai <?= $DELETE ?> ikut tergabung di dalam $permission)
            <?php else: ?>
                (Alasan: false karena flag DELETE bernilai <?= $DELETE ?> tidak digabungkan ke dalam $permission)
            <?php endif; ?>
        </p>
    </section>

    <section>
        <h2>Output var_dump($canDelete):</h2>
        <pre class="dump"><?= htmlspecialchars($dumpOutput, ENT_QUOTES, 'UTF-8') ?></pre>
    </section>
</main>

<footer>&copy; <?= date('Y') ?> <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></footer>

</body>
</html>
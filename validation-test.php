<?php
// Uji coba HTTP status code 422 - KursusKu Pisang Pride
// http_response_code() harus dipanggil SEBELUM ada output apa pun (HTML/echo).

http_response_code(422);

$siteName = 'KursusKu Pisang Pride';
$statusCode = http_response_code(); // baca kembali kode yang sedang aktif
$statusText = 'Unprocessable Entity';
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $statusCode ?> <?= $statusText ?> - Validation Test - <?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></title>
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
        font-size: 14px;
        line-height: 1.6;
    }

    .panel {
        max-width: 640px;
        margin: 0 auto;
        padding: 26px 28px 28px;
        background: var(--peel-800);
        border: 1px solid var(--peel-line);
        border-top: 6px solid var(--spot-deep);
        border-radius: 14px 14px 10px 10px;
    }

    .brand {
        margin: 0 0 6px;
        font-size: 12px;
        color: var(--muted);
    }

    h1 {
        margin: 0 0 18px;
        font-size: 19px;
        line-height: 1.5;
        color: var(--banana);
    }

    .badge {
        display: inline-block;
        padding: 1px 12px;
        border-radius: 999px;
        background: var(--spot-deep);
        color: #fff6e0;
        font-weight: 700;
        white-space: nowrap;
    }

    section {
        padding: 14px 0;
        border-top: 1px dashed var(--peel-line);
    }

    section:first-of-type { border-top: 0; padding-top: 0; }

    p { margin: 6px 0; }

    .label {
        font-weight: 700;
        color: var(--banana-soft);
    }

    code { color: var(--banana); }

    pre.dump {
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

    .hint {
        font-style: italic;
        color: var(--muted);
    }

    @media (max-width: 480px) {
        body { padding: 24px 12px; }
        .panel { padding: 20px 18px 22px; }
        h1 { font-size: 17px; }
    }
</style>
</head>
<body>

<main class="panel">
    <p class="brand"><?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?></p>

    <h1>
        HTTP Response Code:
        <span class="badge"><?= $statusCode ?> <?= htmlspecialchars($statusText, ENT_QUOTES, 'UTF-8') ?></span>
    </h1>

    <section>
        <p>
            Ketika backend error validasi (misalnya pada <code>process-registration.php</code>),
            server mengirimkan HTTP status code <?= $statusCode ?>.
        </p>
    </section>

    <section>
        <p><span class="label">Fungsi PHP:</span> <code>http_response_code(422);</code></p>
    </section>

    <section>
        <p><span class="label">Hasil pemeriksaan fungsi:</span></p>
        <pre class="dump">http_response_code() =&gt; <?= $statusCode ?></pre>
    </section>

    <section>
        <p class="hint">
            (Silakan: buka Inspect Element / F12 &gt; tab Network untuk melihat
            status code <?= $statusCode ?> secara langsung)
        </p>
    </section>
</main>

</body>
</html>
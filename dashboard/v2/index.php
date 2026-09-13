<?php
declare(strict_types=1);

session_start();
require_once __DIR__ . '/../../config/connection.php';
require_once __DIR__ . '/../../incl/lib/mainLib.php';

$gs = new mainLib();
$accountId = (int)($_SESSION['accountID'] ?? 0);
$name = $accountId > 0 ? (string)$gs->getAccountName($accountId) : 'Guest';
$levels = 0;
$songs = 0;

try {
    if (isset($db)) {
        $levels = (int)$db->query('SELECT COUNT(*) FROM levels')->fetchColumn();
        $songs = (int)$db->query('SELECT COUNT(*) FROM songs')->fetchColumn();
    }
} catch (Throwable $e) {
    // Dashboard remains usable when optional statistics are unavailable.
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>PulseGDPS Dashboard</title>
    <link rel="stylesheet" href="assets/pulse.css">
</head>
<body>
<header class="topbar">
    <a class="brand" href="./">Pulse<span>GDPS</span></a>
    <nav>
        <a href="../">Classic dashboard</a>
        <?php if ($accountId): ?><a href="../logout.php">Log out</a><?php else: ?><a href="../login/login.php">Log in</a><?php endif; ?>
    </nav>
</header>
<main class="shell">
    <section class="hero">
        <div>
            <p class="eyebrow">GEOMETRY DASH PRIVATE SERVER</p>
            <h1>Welcome back, <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>.</h1>
            <p class="muted">A new, cleaner PulseGDPS dashboard is being built alongside the core rewrite.</p>
        </div>
        <a class="button" href="../stats/levelsList.php">Browse levels</a>
    </section>

    <section class="grid">
        <article class="card"><span class="icon">◆</span><div><strong><?= number_format($levels) ?></strong><small>Levels</small></div></article>
        <article class="card"><span class="icon">♫</span><div><strong><?= number_format($songs) ?></strong><small>Custom songs</small></div></article>
        <article class="card"><span class="icon">◎</span><div><strong>2</strong><small>Database drivers</small></div></article>
    </section>

    <section class="panel">
        <div><p class="eyebrow">PULSE CORE</p><h2>Everything in one place.</h2><p class="muted">The new dashboard is designed for fast navigation, responsive layouts, and a future API-first PulseGDPS core.</p></div>
        <div class="links">
            <a href="../stats/levelsList.php">Levels <span>→</span></a>
            <a href="../stats/songList.php">Songs <span>→</span></a>
            <a href="../clans.php">Clans <span>→</span></a>
            <?php if ($accountId): ?><a href="../profile/<?= rawurlencode($name) ?>">Your profile <span>→</span></a><?php endif; ?>
        </div>
    </section>
</main>
<footer>PulseGDPS · Core rewrite in progress</footer>
</body>
</html>

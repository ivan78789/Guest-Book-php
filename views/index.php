<?php
$TitleName = 'Гостевая книга';
require_once __DIR__ . '/../config/db.php';

$messages = [];
$limit = 5;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;


$total = $conn->query('SELECT COUNT(*) FROM messages')->fetchColumn();
$pages = ceil($total / $limit);


$stmt = $conn->prepare("SELECT * FROM messages ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/nav.php'; ?>
<?php require_once __DIR__ . '/../include/create.php'; ?>

<div class="messages wrapper">
    <?php foreach ($messages as $message): ?>
        <div class="message">
            <div class="message-header">
                <strong><?= htmlspecialchars($message['name']) ?></strong>
                <a href="mailto:<?= htmlspecialchars($message['email']) ?>" class="message-email">
                    (<?= htmlspecialchars($message['email']) ?>)
                </a>
            </div>
            <p class="message-text"><?= nl2br(htmlspecialchars($message['message'])) ?></p>
            <div class="message-footer">
                <small><?= date('d.m.Y H:i', strtotime($message['created_at'])) ?></small>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="pagination">
    <?php for ($i = 1; $i <= $pages; $i++): ?>
        <a href="?page=<?= $i ?>" <?= $page === $i ? 'class="active"' : '' ?>><?= $i ?></a>
    <?php endfor; ?>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
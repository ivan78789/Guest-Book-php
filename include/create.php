<?php
$TitleName = 'Гостевая книга - Создать сообщение';
require_once __DIR__ . '/../config/db.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (trim($name == '') || trim($email) == '' || trim($message) == '') {
        $errors[] = "Заполните все поля!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный формат email!";
    } else {
        try {
            $stmt = $conn->prepare("INSERT INTO messages (`name`, `email`, `message`) VALUES (:name, :email, :message)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);
            $stmt->execute();
            header('Location: /');
            exit;
        } catch (PDOException $e) {
            $errors[] = "Error: " . $e->getMessage();
        }
    }
}
?>


<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/nav.php'; ?>



<?php if (!empty($errors)): ?>
    <?php foreach ($errors as $error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endforeach;?>
<?php endif; ?>

<form action="" method="post" class="guestbook-form">
    <h2 class="messageg">Оставьте свое сообщение в гостевую книгу</h2>
    <div class="form-group">
        <input type="text" 
               name="name" 
               value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" 
               placeholder="Введите своё имя"
               required>
               
        <input type="email" 
               name="email" 
               value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" 
               placeholder="Введите свою почту"
               required>
               
        <textarea name="message" 
                  placeholder="Введите своё сообщение"
                  required><?= isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '' ?></textarea>
                  
        <button type="submit">Отправить сообщение</button>
    </div>
</form>


<?php require_once __DIR__ . '/../layout/footer.php'; ?>
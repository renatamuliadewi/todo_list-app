<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $stmt = $pdo->prepare('INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)');
    $stmt->execute([$user_id, $title, $description, $due_date]);

    header('Location: dashboard.php');
    exit;
}
?>
<?php include 'templates/header.php'; ?>
<div class="container">
    <header>
        <h1>Add Task</h1>
    </header>
    <form method="post" action="add_task.php">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="datetime-local" name="due_date" required>
        <button type="submit">Add Task</button>
    </form>
</div>
<?php include 'templates/footer.php'; ?>
</body>
</html>

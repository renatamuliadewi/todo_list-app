<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
$stmt->execute([$id]);
$task = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $stmt = $pdo->prepare('UPDATE tasks SET title = ?, description = ?, due_date = ? WHERE id = ?');
    $stmt->execute([$title, $description, $due_date, $id]);

    header('Location: dashboard.php');
    exit;
}
?>
<?php include 'templates/header.php'; ?>
<div class="container">
    <header>
        <h1>Edit Task</h1>
    </header>
    <form method="post" action="edit_task.php?id=<?php echo $task['id']; ?>">
        <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
        <textarea name="description" required><?php echo htmlspecialchars($task['description']); ?></textarea>
        <input type="datetime-local" name="due_date" value="<?php echo $task['due_date']; ?>" required>
        <button type="submit">Save Changes</button>
    </form>
</div>
<?php include 'templates/footer.php'; ?>
</body>
</html>

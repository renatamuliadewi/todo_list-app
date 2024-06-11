<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare('SELECT * FROM tasks WHERE user_id = ?');
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll();
?>
<?php include 'templates/header.php'; ?>
<div class="container">
    <header>
        <h1>My Tasks</h1>
    </header>
    <nav>
        <a href="add_task.php">Add Task</a>
        <a href="logout.php">Logout</a>
    </nav>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <strong><?php echo htmlspecialchars($task['title']); ?></strong>
                <p><?php echo htmlspecialchars($task['description']); ?></p>
                <p>Due: <?php echo htmlspecialchars($task['due_date']); ?></p>
                <a href="edit_task.php?id=<?php echo $task['id']; ?>">Edit</a>
                <a href="delete_task.php?id=<?php echo $task['id']; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php include 'templates/footer.php'; ?>
</body>
</html>

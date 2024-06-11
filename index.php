<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List App</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Todo List App</h1>
    </header>
    <div class="container">
        <nav>
            <a href="index.php">Home</a>
            <a href="tasks.php">Tasks</a>
            <a href="logout.php">Logout</a>
        </nav>
        <div class="form-container">
            <form action="process.php" method="POST">
                <h2>Add New Task</h2>
                <input type="text" name="title" placeholder="Task Title" required>
                <textarea name="description" placeholder="Task Description" required></textarea>
                <input type="datetime-local" name="due_date" required>
                <button type="submit">Add Task</button>
            </form>
        </div>
        <div class="tasks-list">
            <h2>Your Tasks</h2>
            <ul id="task-list">
                <!-- Tasks will be dynamically loaded here -->
            </ul>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Todo List App. All rights reserved.</p>
    </footer>
    <script src="script.js" defer></script>
</body>
</html>

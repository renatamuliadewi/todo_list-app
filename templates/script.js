document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const tasksList = document.getElementById('task-list');

    // Function to load tasks from the server
    const loadTasks = async () => {
        try {
            const response = await fetch('tasks.php');
            const tasks = await response.json();
            tasksList.innerHTML = '';
            tasks.forEach(task => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <strong>${task.title}</strong><br>
                    ${task.description}<br>
                    Due: ${task.due_date}<br>
                    <a href="edit.php?id=${task.id}">Edit</a>
                    <a href="delete.php?id=${task.id}" onclick="return confirm('Are you sure you want to delete this task?')">Delete</a>
                `;
                tasksList.appendChild(li);
            });
        } catch (error) {
            console.error('Error loading tasks:', error);
        }
    };

    // Load tasks on page load
    loadTasks();

    // Handle form submission
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(form);
        try {
            const response = await fetch('process.php', {
                method: 'POST',
                body: formData
            });
            if (response.ok) {
                form.reset();
                loadTasks();
            } else {
                alert('Failed to add task');
            }
        } catch (error) {
            console.error('Error submitting form:', error);
        }
    });
});

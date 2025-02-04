
// assets/js/script.js

// Fonction d'ajout de tâche
document.addEventListener('DOMContentLoaded', function () {
    const taskForm = document.querySelector('#task-form');
    const taskInput = document.querySelector('#task-input');
    const taskList = document.querySelector('#task-list');

    // Ajouter une tâche
    taskForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const taskText = taskInput.value.trim();
        if (taskText === '') return; // Ne pas ajouter de tâche vide

        const taskItem = document.createElement('div');
        taskItem.classList.add('task-item');

        const taskTextElement = document.createElement('span');
        taskTextElement.textContent = taskText;

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Supprimer';
        deleteButton.addEventListener('click', function () {
            taskItem.remove(); // Supprimer la tâche
        });

        taskItem.appendChild(taskTextElement);
        taskItem.appendChild(deleteButton);

        taskList.appendChild(taskItem);

        // Réinitialiser le champ de saisie
        taskInput.value = '';
    });

    // Formulaire d'inscription
    const registerForm = document.querySelector('#register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const username = document.querySelector('input[name="username"]').value;
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;

            // Vérification basique
            if (username === '' || email === '' || password === '') {
                alert('Tous les champs doivent être remplis.');
                return;
            }

            // Envoyer les données au serveur via AJAX (si nécessaire)
            console.log('Nom:', username, 'Email:', email, 'Mot de passe:', password);
            alert('Inscription réussie');
        });
    }
});

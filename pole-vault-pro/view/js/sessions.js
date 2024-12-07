document.addEventListener('DOMContentLoaded', function() {
    // Load initial data
    loadSessions();

    // Add event listeners
    const addSessionButton = document.getElementById('addSessionButton');
    if (addSessionButton) {
        addSessionButton.addEventListener('click', addSession);
    }
});

// Load all sessions
async function loadSessions() {
    try {
        const response = await fetch('controller/sessions.php');
        const sessions = await response.json();
        displaySessions(sessions);
    } catch (error) {
        console.error('Error loading sessions:', error);
        showError('Failed to load sessions');
    }
}

// Display sessions in the list
function displaySessions(sessions) {
    const sessionsList = document.getElementById('sessionsList');
    sessionsList.innerHTML = '';

    if (sessions.length === 0) {
        sessionsList.innerHTML = '<p>No sessions exist yet.</p>';
        return;
    }

    sessions.forEach(session => {
        const sessionRow = document.createElement('div');
        sessionRow.className = 'list__row';
        sessionRow.innerHTML = `
            <div class="list__item">
                <p class="bold">${session.sessionName}</p>
            </div>
            <div class="list__removeItem">
                <button class="remove-button" onclick="deleteSession(${session.sessionID})">❌</button>
            </div>
        `;
        sessionsList.appendChild(sessionRow);
    });
}

// Add a new session
async function addSession(event) {
    event.preventDefault();
    
    const sessionData = {
        session_name: document.getElementById('sessionName').value
    };

    try {
        const response = await fetch('controller/sessions.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(sessionData)
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to add session');
        }

        // Reload sessions and reset form
        loadSessions();
        event.target.reset();
    } catch (error) {
        console.error('Error adding session:', error);
        showError(error.message);
    }
}

// Delete a session
async function deleteSession(sessionId) {
    if (!confirm('Are you sure you want to delete this session?')) {
        return;
    }

    try {
        const response = await fetch('controller/sessions.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ session_id: sessionId })
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to delete session');
        }

        loadSessions();
    } catch (error) {
        console.error('Error deleting session:', error);
        showError(error.message || 'Cannot delete session with existing jumps');
    }
}

// Show error message
function showError(message) {
    alert(message); // For now, using simple alert. Can be enhanced with better UI
}

// Event listeners
document.getElementById('addSessionForm').addEventListener('submit', addSession);

// Initial load
loadSessions();
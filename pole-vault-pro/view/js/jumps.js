document.addEventListener('DOMContentLoaded', function() {
    // Load initial data
    loadJumps();
    loadSessionsForSelect();

    // Add event listeners
    const filterButton = document.getElementById('filterButton');
    const addJumpButton = document.getElementById('addJumpButton');
    
    if (filterButton) {
        filterButton.addEventListener('click', loadJumps);
    }
    
    if (addJumpButton) {
        addJumpButton.addEventListener('click', addJump);
    }
});

// Global state
let currentSessionId = 0;

// Fetch all sessions for dropdowns
async function loadSessions() {
    try {
        const response = await fetch('controller/sessions.php');
        const sessions = await response.json();
        
        // Populate both dropdowns
        const filterSelect = document.getElementById('sessionFilter');
        const jumpSelect = document.getElementById('jumpSession');
        
        sessions.forEach(session => {
            // Add to filter dropdown
            const filterOption = new Option(session.sessionName, session.sessionID);
            filterSelect.add(filterOption);
            
            // Add to add jump form dropdown
            const jumpOption = new Option(session.sessionName, session.sessionID);
            jumpSelect.add(jumpOption);
        });
    } catch (error) {
        console.error('Error loading sessions:', error);
        showError('Failed to load sessions');
    }
}

// Load jumps based on selected session
async function loadJumps(sessionId = 0) {
    try {
        const response = await fetch(`controller/jumps.php?session_id=${sessionId}`);
        const jumps = await response.json();
        displayJumps(jumps);
    } catch (error) {
        console.error('Error loading jumps:', error);
        showError('Failed to load jumps');
    }
}

// Display jumps in the list
function displayJumps(jumps) {
    const jumpsList = document.getElementById('jumpsList');
    jumpsList.innerHTML = '';

    if (jumps.length === 0) {
        jumpsList.innerHTML = '<p>No jumps exist for this session yet.</p>';
        return;
    }

    jumps.forEach(jump => {
        const jumpRow = document.createElement('div');
        jumpRow.className = 'list__row';
        jumpRow.innerHTML = `
            <div class="list__item">
                <p class="bold">${jump.sessionName}</p>
                <p>Height: ${jump.Height}</p>
                <p>Attempts: ${jump.Attempts}</p>
            </div>
            <div class="list__removeItem">
                <button class="remove-button" onclick="deleteJump(${jump.ID}, ${jump.sessionID})">❌</button>
            </div>
        `;
        jumpsList.appendChild(jumpRow);
    });
}

// Filter jumps based on selected session
function filterJumps() {
    const sessionId = document.getElementById('sessionFilter').value;
    currentSessionId = sessionId;
    loadJumps(sessionId);
}

// Add a new jump
async function addJump(event) {
    event.preventDefault();
    
    const jumpData = {
        session_id: document.getElementById('jumpSession').value,
        height: document.getElementById('jumpHeight').value,
        attempts: document.getElementById('jumpAttempts').value
    };

    try {
        const response = await fetch('controller/jumps.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jumpData)
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to add jump');
        }

        // Reload jumps and reset form
        loadJumps(currentSessionId);
        event.target.reset();
    } catch (error) {
        console.error('Error adding jump:', error);
        showError(error.message);
    }
}

// Delete a jump
async function deleteJump(jumpId, sessionId) {
    if (!confirm('Are you sure you want to delete this jump?')) {
        return;
    }

    try {
        const response = await fetch('controller/jumps.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ jump_id: jumpId })
        });

        if (!response.ok) {
            throw new Error('Failed to delete jump');
        }

        loadJumps(currentSessionId);
    } catch (error) {
        console.error('Error deleting jump:', error);
        showError('Failed to delete jump');
    }
}

// Show error message
function showError(message) {
    alert(message); // For now, using simple alert. Can be enhanced with better UI
}

// Event listeners
document.getElementById('addJumpForm').addEventListener('submit', addJump);

// Initial load
loadSessions();
loadJumps();
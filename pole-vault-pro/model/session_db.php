<?php
function get_sessions()
{
    global $db;
    $query = 'SELECT * FROM sessions ORDER BY sessionID';
    $stmt = $db->prepare($query);
    $stmt->execute();
    $sessions = $stmt->fetchAll();
    $stmt->closeCursor();
    return $sessions;
}

function get_session_name($session_id)
{
    if (!$session_id)
    {
        return "All Sessions";
    }

    global $db;
    $query = 'SELECT * FROM sessions WHERE sessionID = :session_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':session_id', $session_id);
    $stmt->execute();
    $session = $stmt->fetch();
    $stmt->closeCursor();
    $session_name = $session['sessionName'];
    return $session_name;
}

function delete_session($session_id)
{
    global $db;
    $query = 'DELETE FROM sessions WHERE sessionID = :session_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':session_id', $session_id);
    $stmt->execute();
    $stmt->closeCursor();
}

function add_session($session_name)
{
    global $db;
    $query = 'INSERT INTO sessions (sessionName) VALUES (:sessionName)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':sessionName', $session_name);
    $stmt->execute();
    $stmt->closeCursor();
}
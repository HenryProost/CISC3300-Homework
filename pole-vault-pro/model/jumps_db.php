<?php

function get_jumps_by_session($session_id)
{
    global $db;
    if ($session_id)
    {
        $query = 'SELECT J.ID, J.Attempts, J.Height, S.sessionName FROM jumps J LEFT JOIN
                  sessions S ON J.sessionID = S.sessionID WHERE J.sessionID = :session_id ORDER BY J.ID';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':session_id', $session_id);
    } else
    {
        $query = 'SELECT J.ID, J.Attempts, J.Height, S.sessionName FROM jumps J LEFT JOIN
                  sessions S ON J.sessionID = S.sessionID ORDER BY S.sessionID';
        $stmt = $db->prepare($query);
    }

    $stmt->execute();
    $jumps = $stmt->fetchAll();
    $stmt->closeCursor();
    return $jumps;
}

function delete_jump($jump_id)
{
    global $db;
    $query = 'DELETE FROM jumps WHERE ID = :jump_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':jump_id', $jump_id);
    $stmt->execute();
    $stmt->closeCursor();
}

function add_jump($session_id, $height, $attempts)
{
    global $db;
    $query = 'INSERT INTO jumps (Height, Attempts, sessionID) VALUES (:height, :attempt, :sessionID)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':height', $height);
    $stmt->bindValue(':attempt', $attempts);
    $stmt->bindValue(':sessionID', $session_id);
    $stmt->execute();
    $stmt->closeCursor();
}


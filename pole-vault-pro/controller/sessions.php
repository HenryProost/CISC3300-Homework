<?php
require_once '../model/database.php';
require_once '../model/session_db.php';

// Set JSON content type
header('Content-Type: application/json');

// Handle CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Get the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($method) {
        case 'GET':
            $sessions = get_sessions();
            echo json_encode($sessions);
            break;

        case 'POST':
            // Get POST data
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            // Validate input
            $session_name = filter_var($data['session_name'], FILTER_SANITIZE_STRING);

            if (!$session_name) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid session name']);
                exit();
            }

            // Add session
            add_session($session_name);
            echo json_encode(['message' => 'Session added successfully']);
            break;

        case 'DELETE':
            // Get DELETE data
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            // Validate input
            $session_id = filter_var($data['session_id'], FILTER_VALIDATE_INT);

            if (!$session_id) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid session ID']);
                exit();
            }

            try {
                // Delete session
                delete_session($session_id);
                echo json_encode(['message' => 'Session deleted successfully']);
            } catch (PDOException $e) {
                http_response_code(400);
                echo json_encode(['error' => 'Cannot delete session with existing jumps']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}
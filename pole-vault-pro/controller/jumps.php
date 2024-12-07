<?php
require_once '../model/database.php';
require_once '../model/jumps_db.php';
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
            // Get session_id from query parameters
            $session_id = filter_input(INPUT_GET, 'session_id', FILTER_VALIDATE_INT);
            $jumps = get_jumps_by_session($session_id);
            echo json_encode($jumps);
            break;

        case 'POST':
            // Get POST data
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            // Validate input
            $session_id = filter_var($data['session_id'], FILTER_VALIDATE_INT);
            $height = filter_var($data['height'], FILTER_VALIDATE_FLOAT);
            $attempts = filter_var($data['attempts'], FILTER_VALIDATE_INT);

            if (!$session_id || !$height || !$attempts) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid input data']);
                exit();
            }

            // Add jump
            add_jump($session_id, $height, $attempts);
            echo json_encode(['message' => 'Jump added successfully']);
            break;

        case 'DELETE':
            // Get DELETE data
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            // Validate input
            $jump_id = filter_var($data['jump_id'], FILTER_VALIDATE_INT);

            if (!$jump_id) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid jump ID']);
                exit();
            }

            // Delete jump
            delete_jump($jump_id);
            echo json_encode(['message' => 'Jump deleted successfully']);
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
<?php
include 'db.php';

// Decode the JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Check if data and 'id' are valid
$tableId = isset($data['id']) ? intval($data['id']) : 0;

if ($tableId > 0) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("DELETE FROM tables WHERE id = ?");
    $stmt->bind_param("i", $tableId);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Table deleted successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete table.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid table ID.']);
}

// Close the database connection
$conn->close();
?>

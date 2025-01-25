<?php
include "db.php";

// json file bata order load garx
$ordersFile = 'orders.json';
if (file_exists($ordersFile)) {
    $fileContents = file_get_contents($ordersFile);
    $orders = json_decode($fileContents, true);

    if (!$orders) {
        echo json_encode(['error' => 'Failed to decode orders.json']);
        exit;
    }

    // Check if a specific table ID is provided for fetching past orders
    if (isset($_GET['table'])) {
        $table = $_GET['table'];
        $existingOrder = [];

        // Look for the order of the specific table
        foreach ($orders as $order) {
            if (isset($order['table']) && $order['table'] == $table) {
                $existingOrder = $order['order']; // Assign order of the specific table
                break;
            }
        }

        // Return the existing order for the specified table
        echo json_encode($existingOrder);
    } else {
        // Aggregate orders by table as you had before
        $aggregatedOrders = [];
        foreach ($orders as $order) {
            // order structure validate gareko
            if (!isset($order['table'], $order['order'], $order['total'])) {
                continue; //invalid entries skip gareko
            }

            $table = $order['table'];
            if (!isset($aggregatedOrders[$table])) {
                $aggregatedOrders[$table] = [
                    'table' => $table,
                    'orders' => [],
                    'total' => 0
                ];
            }
            $aggregatedOrders[$table]['orders'][] = $order['order'];
            $aggregatedOrders[$table]['total'] += $order['total'];
        }

        // Return the aggregated orders for all tables
        echo json_encode(array_values($aggregatedOrders));
    }
} else {
    error_log("Orders file not found: $ordersFile");
    echo json_encode([]);
}
?>

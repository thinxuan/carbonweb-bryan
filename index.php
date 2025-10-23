<?php
// Simple test page to verify Render is working
echo "CarbonWallet is working!<br>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Current time: " . date('Y-m-d H:i:s') . "<br>";

// Test if we can connect to the main app
try {
    require_once __DIR__ . '/public/index.php';
} catch (Exception $e) {
    echo "Error loading Laravel app: " . $e->getMessage() . "<br>";
    echo "This is a fallback page to show the server is working.";
}
?>

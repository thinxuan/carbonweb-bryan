<?php
// Simple PHP entry point to force Render to detect PHP
echo "PHP is working! Redirecting to Laravel...";

// Redirect to the main Laravel app
header('Location: /public/index.php');
exit;
?>

#!/bin/bash
echo "Starting CarbonWallet application..."

# Since we're in Node.js environment, let's use a simple Node.js server
echo "Starting simple Node.js server for Laravel..."

# Create a simple server.js file
cat > server.js << 'EOF'
const express = require('express');
const path = require('path');
const { exec } = require('child_process');

const app = express();
const port = process.env.PORT || 3000;

// Serve static files from public directory
app.use(express.static('public'));

// Handle all routes by serving index.php
app.get('*', (req, res) => {
    // For now, just serve a simple message
    res.send(`
        <html>
            <head><title>CarbonWallet</title></head>
            <body>
                <h1>CarbonWallet is running!</h1>
                <p>PHP is not available in this environment.</p>
                <p>Please update Render dashboard to use Docker mode for full Laravel functionality.</p>
                <p>Visit: <a href="/waitlist">Waitlist</a></p>
            </body>
        </html>
    `);
});

app.listen(port, '0.0.0.0', () => {
    console.log(`Server running on port ${port}`);
});
EOF

# Install express if not available
npm install express

# Start the server
node server.js

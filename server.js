const express = require('express');
const path = require('path');

const app = express();
const port = process.env.PORT || 3000;

// Serve static files from public directory
app.use(express.static('public'));

// Handle all routes by serving a simple response
app.get('*', (req, res) => {
    res.send(`
        <!DOCTYPE html>
        <html>
            <head>
                <title>CarbonWallet</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 40px; }
                    h1 { color: #333; }
                    .container { max-width: 600px; margin: 0 auto; }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>🚀 CarbonWallet is Running!</h1>
                    <p>Your application has been successfully deployed to Render!</p>
                    <p><strong>Note:</strong> This is a Node.js fallback server. For full Laravel functionality, consider switching to Docker mode.</p>
                    <p>Visit: <a href="/waitlist">Waitlist Page</a></p>
                </div>
            </body>
        </html>
    `);
});

app.listen(port, '0.0.0.0', () => {
    console.log(`🚀 CarbonWallet server running on port ${port}`);
    console.log(`📍 Access your app at: http://localhost:${port}`);
});

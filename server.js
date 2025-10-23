import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';
import { exec } from 'child_process';
import { promisify } from 'util';

const execAsync = promisify(exec);
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const port = process.env.PORT || 3000;

// Serve static files from public directory
app.use(express.static('public'));

// Serve CSS and JS files from public directory
app.use('/css', express.static('public/css'));
app.use('/js', express.static('public/js'));
app.use('/images', express.static('public/images'));
app.use('/build', express.static('public/build'));

// Handle specific routes
app.get('/', async (req, res) => {
    try {
        // Try to serve the home page
        const homeHtml = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CarbonWallet - Home</title>
            <link rel="stylesheet" href="/css/style.css">
        </head>
        <body>
            <h1>Welcome to CarbonWallet</h1>
            <p>Your carbon footprint tracking application is running!</p>
            <nav>
                <a href="/waitlist">Join Waitlist</a> |
                <a href="/solutions">Solutions</a> |
                <a href="/contact">Contact</a>
            </nav>
        </body>
        </html>`;
        res.send(homeHtml);
    } catch (error) {
        res.status(500).send('Error loading page');
    }
});

app.get('/waitlist', (req, res) => {
    const waitlistHtml = `
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CarbonWallet - Join Waitlist</title>
        <link rel="stylesheet" href="/css/style.css">
        <style>
            body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
            .container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            .form-group { margin-bottom: 20px; }
            .form-input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
            .waitlist-container { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px; text-align: center; border-radius: 5px; cursor: pointer; margin-top: 20px; }
            h1 { color: #333; text-align: center; }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Join the CarbonWallet Waitlist</h1>
            <form id="waitlistForm">
                <div class="form-group">
                    <input type="text" name="name" class="form-input" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                    <input type="text" name="company" class="form-input" placeholder="Company (Optional)">
                </div>
                <div class="waitlist-container" onclick="submitForm()">
                    Join the Waitlist
                </div>
            </form>
            <div id="message" style="margin-top: 20px; text-align: center; display: none;"></div>
        </div>
        
        <script>
            function submitForm() {
                const form = document.getElementById('waitlistForm');
                const formData = new FormData(form);
                const messageDiv = document.getElementById('message');
                
                // Simulate form submission
                messageDiv.innerHTML = '<p style="color: green;">✅ Thank you for joining our waitlist! We\'ll be in touch soon.</p>';
                messageDiv.style.display = 'block';
                form.reset();
            }
        </script>
    </body>
    </html>`;
    res.send(waitlistHtml);
});

app.get('/solutions', (req, res) => {
    const solutionsHtml = `
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CarbonWallet - Solutions</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <div style="max-width: 800px; margin: 40px auto; padding: 20px;">
            <h1>CarbonWallet Solutions</h1>
            <p>Track and reduce your carbon footprint with our comprehensive solutions.</p>
            <h2>Features</h2>
            <ul>
                <li>Carbon footprint tracking</li>
                <li>Emission monitoring</li>
                <li>Sustainability reporting</li>
                <li>Goal setting and tracking</li>
            </ul>
            <a href="/waitlist">Join our waitlist to get early access!</a>
        </div>
    </body>
    </html>`;
    res.send(solutionsHtml);
});

app.get('/contact', (req, res) => {
    const contactHtml = `
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CarbonWallet - Contact</title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <div style="max-width: 600px; margin: 40px auto; padding: 20px;">
            <h1>Contact CarbonWallet</h1>
            <p>Get in touch with us for any questions or support.</p>
            <p>Email: contact@carbonwallet.com</p>
            <p>Phone: +1 (555) 123-4567</p>
            <a href="/waitlist">Join our waitlist</a>
        </div>
    </body>
    </html>`;
    res.send(contactHtml);
});

// Handle all other routes
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
                <p>Page not found. Available pages:</p>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/waitlist">Waitlist</a></li>
                    <li><a href="/solutions">Solutions</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
        </body>
        </html>
    `);
});

app.listen(port, '0.0.0.0', () => {
    console.log(`🚀 CarbonWallet server running on port ${port}`);
    console.log(`📍 Access your app at: http://localhost:${port}`);
    console.log(`📄 Available pages: /, /waitlist, /solutions, /contact`);
});

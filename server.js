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
        // Read the actual home Blade template
        const homeTemplate = fs.readFileSync(path.join(__dirname, 'resources/views/home.blade.php'), 'utf8');
        const layoutTemplate = fs.readFileSync(path.join(__dirname, 'resources/views/layouts/app.blade.php'), 'utf8');
        
        // Replace Blade syntax with static content
        let html = homeTemplate
            .replace(/@extends\('layouts\.app'\)/g, '')
            .replace(/@section\('title',\s*'([^']+)'\)/g, '<title>$1</title>')
            .replace(/@section\('content'\)/g, '')
            .replace(/@endsection/g, '')
            .replace(/{{ asset\('([^']+)'\) }}/g, '/$1')
            .replace(/{{ url\('([^']+)'\) }}/g, '/$1');
        
        // Combine with layout
        let layoutHtml = layoutTemplate
            .replace(/@yield\('title',\s*'([^']+)'\)/g, '<title>$1</title>')
            .replace(/{{ asset\('([^']+)'\) }}/g, '/$1')
            .replace(/{{ url\('([^']+)'\) }}/g, '/$1');
        
        res.send(layoutHtml.replace('@yield(\'content\')', html));
    } catch (error) {
        console.error('Error reading home template:', error);
        res.status(500).send('Error loading page');
    }
});

app.get('/waitlist', (req, res) => {
    try {
        // Read the actual Blade template
        const waitlistTemplate = fs.readFileSync(path.join(__dirname, 'resources/views/waitlist.blade.php'), 'utf8');
        
        // Replace Blade syntax with static content
        let html = waitlistTemplate
            .replace(/{{ csrf_token\(\) }}/g, 'static-token')
            .replace(/{{ old\('([^']+)',\s*'([^']+)'\) }}/g, '$2')
            .replace(/{{ old\('([^']+)'\) }}/g, '')
            .replace(/{{ route\('([^']+)'\) }}/g, '/$1');
        
        res.send(html);
    } catch (error) {
        console.error('Error reading waitlist template:', error);
        res.status(500).send('Error loading waitlist page');
    }
});

app.get('/solutions', (req, res) => {
    try {
        // Read the actual solutions Blade template
        const solutionsTemplate = fs.readFileSync(path.join(__dirname, 'resources/views/solutions.blade.php'), 'utf8');
        const layoutTemplate = fs.readFileSync(path.join(__dirname, 'resources/views/layouts/app.blade.php'), 'utf8');
        
        // Replace Blade syntax with static content
        let html = solutionsTemplate
            .replace(/@extends\('layouts\.app'\)/g, '')
            .replace(/@section\('title',\s*'([^']+)'\)/g, '<title>$1</title>')
            .replace(/@section\('content'\)/g, '')
            .replace(/@endsection/g, '')
            .replace(/{{ asset\('([^']+)'\) }}/g, '/$1')
            .replace(/{{ url\('([^']+)'\) }}/g, '/$1');
        
        // Combine with layout
        let layoutHtml = layoutTemplate
            .replace(/@yield\('title',\s*'([^']+)'\)/g, '<title>$1</title>')
            .replace(/{{ asset\('([^']+)'\) }}/g, '/$1')
            .replace(/{{ url\('([^']+)'\) }}/g, '/$1');
        
        res.send(layoutHtml.replace('@yield(\'content\')', html));
    } catch (error) {
        console.error('Error reading solutions template:', error);
        res.status(500).send('Error loading page');
    }
});

app.get('/contact', (req, res) => {
    try {
        // Read the actual contact Blade template
        const contactTemplate = fs.readFileSync(path.join(__dirname, 'resources/views/contact.blade.php'), 'utf8');
        const layoutTemplate = fs.readFileSync(path.join(__dirname, 'resources/views/layouts/app.blade.php'), 'utf8');
        
        // Replace Blade syntax with static content
        let html = contactTemplate
            .replace(/@extends\('layouts\.app'\)/g, '')
            .replace(/@section\('title',\s*'([^']+)'\)/g, '<title>$1</title>')
            .replace(/@section\('content'\)/g, '')
            .replace(/@endsection/g, '')
            .replace(/{{ asset\('([^']+)'\) }}/g, '/$1')
            .replace(/{{ url\('([^']+)'\) }}/g, '/$1');
        
        // Combine with layout
        let layoutHtml = layoutTemplate
            .replace(/@yield\('title',\s*'([^']+)'\)/g, '<title>$1</title>')
            .replace(/{{ asset\('([^']+)'\) }}/g, '/$1')
            .replace(/{{ url\('([^']+)'\) }}/g, '/$1');
        
        res.send(layoutHtml.replace('@yield(\'content\')', html));
    } catch (error) {
        console.error('Error reading contact template:', error);
        res.status(500).send('Error loading page');
    }
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

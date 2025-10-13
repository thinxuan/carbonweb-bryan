# CarbonWallet - Render Deployment Guide

## 🚀 Quick Deployment

This project is configured for easy deployment on Render.com using Docker.

### Prerequisites
- GitHub account with this repository
- Render.com account (free tier available)

### Deployment Steps

1. **Sign up/Login to Render.com**
   - Go to [render.com](https://render.com)
   - Sign in with GitHub

2. **Create New Web Service**
   - Click "New +" → "Web Service"
   - Connect your GitHub repository
   - Render will auto-detect the Dockerfile

3. **Configure Settings**
   - **Build Command:** `echo "Using Dockerfile"`
   - **Start Command:** `echo "Using Dockerfile CMD"`
   - These are placeholders; Docker handles the actual build

4. **Add Environment Variables**

   Required variables:
   ```
   APP_NAME=CarbonWallet
   APP_ENV=production
   APP_KEY=base64:YOUR_APP_KEY_HERE
   APP_DEBUG=false
   APP_URL=https://your-app.onrender.com
   DB_CONNECTION=sqlite
   DB_DATABASE=/var/www/html/database/database.sqlite
   SESSION_DRIVER=file
   CACHE_STORE=file
   QUEUE_CONNECTION=database
   LOG_CHANNEL=stack
   LOG_LEVEL=error
   ```

   **Generate APP_KEY locally:**
   ```bash
   php artisan key:generate --show
   ```

5. **Deploy**
   - Click "Create Web Service" or "Deploy"
   - Wait 10-15 minutes for first deployment
   - Your app will be live at: `https://your-app.onrender.com`

## 📁 Project Structure

- `Dockerfile` - Docker configuration for production deployment
- `render.yaml` - Render Blueprint configuration (optional)
- `render-build.sh` - Build script (backup, Docker handles most)

## 🔧 Local Development

```bash
# Install dependencies
composer install
npm install

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Build assets
npm run build

# Start dev server
php artisan serve
```

## 🌐 Accessing Your App

After deployment:
- **Homepage:** `https://your-app.onrender.com`
- **Admin Dashboard:** `https://your-app.onrender.com/admin`
- **Health Check:** `https://your-app.onrender.com/health`

## 📝 Notes

- First deployment takes 10-15 minutes (Docker image build)
- Subsequent deployments are faster (~5-8 minutes)
- Free tier may spin down after inactivity (restarts on first request)
- SQLite database is used (persists in container volume)

## 🆘 Troubleshooting

**Build fails?**
- Check that all environment variables are set
- Ensure `APP_KEY` is set correctly with `base64:` prefix

**App doesn't start?**
- Check Render logs for errors
- Verify `APP_URL` matches your Render domain

**500 errors?**
- Set `APP_DEBUG=true` temporarily to see errors
- Check storage permissions in logs

## 📚 Additional Resources

- [Render Documentation](https://render.com/docs)
- [Laravel Deployment](https://laravel.com/docs/deployment)
- [Docker Best Practices](https://docs.docker.com/develop/dev-best-practices/)


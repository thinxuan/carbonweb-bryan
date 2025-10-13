# Railway Deployment Guide for CarbonWallet

## 🚂 Current Issue: Page Not Found

If you're seeing "Page Not Found" on Railway, follow these steps:

## ✅ Required Files Created

1. ✅ **Procfile** - Created
2. ✅ **nixpacks.toml** - Created with proper Laravel configuration

## 📝 Railway Environment Variables

Go to your Railway project settings and add these environment variables:

### Required Variables:
```
APP_NAME=CarbonWallet
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://carbonwallet.up.railway.app

DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database

LOG_CHANNEL=stack
LOG_LEVEL=error
```

### Generate APP_KEY:
Run this command locally:
```bash
php artisan key:generate --show
```
Copy the output and paste it as the `APP_KEY` value in Railway.

## 🔧 Railway Configuration Steps

### 1. In Railway Dashboard:

1. Go to your project: **carbonwallet**
2. Click on **Settings** tab
3. Add all the environment variables listed above
4. Make sure **Start Command** is empty (nixpacks.toml handles this)
5. **Root Directory**: `/` (leave empty if already at root)

### 2. Database Setup:

Since you're using SQLite, you need to ensure the database file persists:

1. In Railway, go to **Variables**
2. Make sure `DB_DATABASE` is set to `/app/database/database.sqlite`
3. The database will be created automatically on first deploy

### 3. Storage Directory:

Railway's filesystem is ephemeral. For production, you should:
- Use Railway's **Volume** feature for persistent storage
- Or switch to a cloud storage service (S3, etc.)

## 🐛 Common Issues & Fixes

### Issue 1: "Page Not Found" or 404
**Solution:**
- Check if `APP_KEY` is set in Railway environment variables
- Make sure `APP_URL` matches your Railway domain
- Verify the start command is working

### Issue 2: "500 Internal Server Error"
**Solution:**
- Set `APP_DEBUG=true` temporarily to see the error
- Check Railway logs: `railway logs`
- Make sure all environment variables are set

### Issue 3: Routes not working
**Solution:**
- Clear the route cache by redeploying
- Or remove `php artisan route:cache` from nixpacks.toml temporarily

### Issue 4: Database errors
**Solution:**
- Make sure migrations ran successfully
- Check Railway logs for migration errors
- SQLite file might not persist between deploys (use Railway Volume)

## 🚀 Deployment Commands

### Push to Railway:
```bash
# Make sure you've committed the new files
git add Procfile nixpacks.toml
git commit -m "Add Railway deployment configuration"
git push origin main
```

Railway will automatically deploy when you push to your connected branch.

### Check Logs:
```bash
railway logs
```

### Manual Redeploy:
In Railway dashboard, click **Deploy** → **Redeploy**

## 📋 Pre-Deployment Checklist

- [ ] `Procfile` exists in project root
- [ ] `nixpacks.toml` exists in project root
- [ ] `APP_KEY` is generated and added to Railway environment variables
- [ ] `APP_URL` is set to your Railway domain
- [ ] All required environment variables are set in Railway
- [ ] Database configuration is correct
- [ ] Code is pushed to GitHub/connected repository
- [ ] Railway is set to auto-deploy from your branch

## 🎯 Quick Fix for Current Issue

1. **Check Railway Logs First:**
   - Go to Railway dashboard → Your project → Logs
   - Look for any error messages

2. **Verify Environment Variables:**
   - Settings → Variables
   - Make sure `APP_KEY` is set
   - Make sure `APP_URL` matches: `https://carbonwallet.up.railway.app`

3. **Redeploy:**
   - Settings → Redeploy
   - Wait for deployment to complete

4. **Check Build Logs:**
   - Make sure all commands in `nixpacks.toml` ran successfully
   - Look for any PHP or Composer errors

## 📞 If Still Not Working

Share the Railway deployment logs with me. To get them:
```bash
railway logs
```

Or in Railway dashboard: Project → Logs tab

Copy and paste the relevant error messages.


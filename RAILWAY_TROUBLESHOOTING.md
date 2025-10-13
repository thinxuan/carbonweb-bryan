# 🚨 Railway Troubleshooting - Page Not Found

## ✅ Changes Just Made

I've updated your configuration:
- ✅ Fixed `Procfile` to use `php artisan serve` instead of Heroku buildpack
- ✅ Removed route/view caching that can cause issues
- ✅ Added `/health` endpoint to test if app is running
- ✅ Committed and pushed to GitHub

Railway should now redeploy automatically (wait 2-3 minutes).

---

## 🔍 Step-by-Step Debugging

### Step 1: Verify Railway Environment Variables

Go to **Railway Dashboard → Your Project → Variables**

**Make sure these are ALL set:**

```
APP_NAME=CarbonWallet
APP_ENV=production
APP_KEY=base64:ZdoWE9EGrVbNIu4bZ3bWWktww0F2UgSv5yi5up/10W8=
APP_DEBUG=true
APP_URL=https://carbonwallet.up.railway.app
DB_CONNECTION=sqlite
DB_DATABASE=/app/database/database.sqlite
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=database
LOG_CHANNEL=stack
LOG_LEVEL=debug
```

**IMPORTANT:** I changed `APP_DEBUG=true` temporarily so you can see errors!

### Step 2: Test Health Check Endpoint

Once Railway finishes deploying, try:
```
https://carbonwallet.up.railway.app/health
```

**Expected Result:**
```json
{
  "status": "ok",
  "app": "CarbonWallet",
  "env": "production",
  "url": "https://carbonwallet.up.railway.app",
  "database": "sqlite"
}
```

**If this works:** Your app is running! The issue is with routes or views.
**If this doesn't work:** Your app isn't starting - check Railway logs.

### Step 3: Check Railway Logs

In Railway Dashboard:
1. Click on your project
2. Go to **Logs** tab
3. Look for these messages:

**✅ Good Signs:**
- `Server running on http://0.0.0.0:XXXX`
- `Laravel development server started`
- `INFO Server running on`

**❌ Bad Signs:**
- `No application encryption key`
- `Class not found`
- `could not find driver`
- `permission denied`

### Step 4: Check Build Logs

In Railway Dashboard:
1. Click **Deployments**
2. Click on the latest deployment
3. Check if all these completed:
   - ✅ `composer install` completed
   - ✅ `npm install` completed
   - ✅ `npm run build` completed
   - ✅ `php artisan migrate` completed

---

## 🔥 Common Issues & Solutions

### Issue 1: "No application encryption key has been specified"

**Railway Logs Show:**
```
RuntimeException: No application encryption key has been specified
```

**Solution:**
1. Railway Variables → Check if `APP_KEY` exists
2. Must include `base64:` prefix
3. Value: `base64:ZdoWE9EGrVbNIu4bZ3bWWktww0F2UgSv5yi5up/10W8=`

---

### Issue 2: "500 Internal Server Error" on homepage

**What you see:** White page or "Whoops, something went wrong"

**Solution:**
1. Set `APP_DEBUG=true` in Railway Variables
2. Redeploy
3. Visit the site again - you'll see the actual error
4. Share the error with me

---

### Issue 3: "/health works but / shows 404"

**What this means:** App is running but views aren't loading

**Solution:**
```bash
# In Railway Variables, add:
VIEW_COMPILED_PATH=/tmp/views
```

Then redeploy.

---

### Issue 4: "Could not find driver (SQL)"

**Railway Logs Show:**
```
could not find driver (SQL: PRAGMA foreign_keys = ON)
```

**Solution:** Switch to PostgreSQL (SQLite might not work on Railway)

1. Railway Dashboard → **+ New** → **Database** → **PostgreSQL**
2. Railway auto-adds database variables
3. In Variables, change:
   ```
   DB_CONNECTION=pgsql
   ```
4. Remove or comment out `DB_DATABASE` variable
5. Redeploy

---

### Issue 5: "npm run build failed"

**Build Logs Show:** Error during `npm run build`

**Solution:**
```bash
# Update nixpacks.toml, in [phases.install] section, change to:
cmds = [
    'composer install --no-dev --optimize-autoloader --no-interaction',
    'npm install || true',
    'npm run build || true'
]
```

This makes npm errors non-fatal.

---

## 📊 Debug Checklist

Work through this in order:

- [ ] **Step 1:** All environment variables added to Railway
- [ ] **Step 2:** `APP_KEY` is set correctly (with `base64:` prefix)
- [ ] **Step 3:** `APP_DEBUG=true` is set (temporary for debugging)
- [ ] **Step 4:** Code pushed to Git and Railway deployed
- [ ] **Step 5:** Check Railway Logs for errors
- [ ] **Step 6:** Test `/health` endpoint - does it work?
  - [ ] YES → App is running, issue is with routes/views
  - [ ] NO → App isn't starting, check logs
- [ ] **Step 7:** Visit main page `/` - what do you see?
  - [ ] 404 Not Found
  - [ ] 500 Internal Server Error
  - [ ] White/blank page
  - [ ] Actual error message (if `APP_DEBUG=true`)

---

## 🆘 What to Send Me

If still not working, send me:

### 1. Railway Deployment Logs:
Railway Dashboard → Deployments → Latest → View Logs
Copy the **last 30-50 lines**

### 2. Railway Runtime Logs:
Railway Dashboard → Logs tab
Copy the **last 20-30 lines**

### 3. What URL Shows:
- `/health` → What response?
- `/` → What error?
- Screenshot if possible

### 4. Environment Variables:
Railway Dashboard → Variables
List which ones you have (hide the values)

---

## 🎯 Expected Working State

When everything works:

1. `/health` → Returns JSON with `"status": "ok"`
2. `/` → Shows your CarbonWallet homepage
3. `/admin` → Shows admin dashboard
4. No errors in Railway logs
5. "Server running" message in logs

---

## 💡 Alternative: Use Railway's PostgreSQL

SQLite doesn't persist on Railway. For a proper deployment:

1. **Add PostgreSQL Database:**
   - Railway → **+ New** → **Database** → **PostgreSQL**
   
2. **Update Variables:**
   - `DB_CONNECTION=pgsql`
   - Railway auto-configures: `PGHOST`, `PGPORT`, `PGUSER`, `PGPASSWORD`, `PGDATABASE`

3. **Railway will auto-run migrations!**

This is more reliable for production use.

---

**After Railway finishes deploying (2-3 minutes), try:**
1. `https://carbonwallet.up.railway.app/health`
2. `https://carbonwallet.up.railway.app/`

Let me know what you see! 🚀


# 🔍 Railway Debug Checklist - Page Not Found

## ⚠️ CRITICAL: Check These First

### 1. Environment Variables in Railway Dashboard

Go to: **Railway Dashboard → Your Project → Variables Tab**

**YOU MUST HAVE THESE - ADD IF MISSING:**

```bash
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

**🚨 MOST CRITICAL:** `APP_KEY` - Without this, nothing works!

### 2. Check Railway Logs

**Railway Dashboard → Logs Tab**

**Look for these GOOD signs:**
- ✅ `Server running on http://0.0.0.0:XXXX`
- ✅ `Laravel development server started`
- ✅ `INFO  Server running on`
- ✅ `Development Server started`

**Look for these BAD signs:**
- ❌ `No application encryption key has been specified`
- ❌ `RuntimeException`
- ❌ `could not find driver`
- ❌ `Class not found`
- ❌ `Connection refused`

### 3. Check Build Logs

**Railway Dashboard → Deployments → Latest Deployment → View Logs**

**Must complete successfully:**
- ✅ `composer install` - No errors
- ✅ `npm run build` - Completed
- ✅ `php artisan migrate` - Ran (may show no migrations, that's OK)
- ✅ Build status: "Success" or "Deployed"

---

## 🛠️ Step-by-Step Fixes

### Fix #1: Add APP_KEY (MOST COMMON ISSUE)

**In Railway Dashboard → Variables:**

1. Click **+ New Variable**
2. Name: `APP_KEY`
3. Value: `base64:ZdoWE9EGrVbNIu4bZ3bWWktww0F2UgSv5yi5up/10W8=`
4. Click **Add**
5. **Redeploy** (Railway should auto-redeploy)

**Wait 3-5 minutes and try again.**

---

### Fix #2: Set APP_DEBUG=true

**In Railway Dashboard → Variables:**

1. Find `APP_DEBUG`
2. Change value to: `true`
3. **Redeploy**

This will show you the actual error message instead of "Not Found"

---

### Fix #3: Check if Service is Running

**In Railway Dashboard → Logs:**

Search for text: `Server running`

**If you see:** `Server running on http://0.0.0.0:8080`
- ✅ **App is running!** Issue is with routes or configuration

**If you DON'T see this:**
- ❌ **App is NOT starting** - Check for error messages above

---

### Fix #4: Verify Domain is Correct

**In Railway Dashboard → Settings:**

1. Check "Domains" section
2. Make sure domain is: `carbonwallet.up.railway.app`
3. Status should be: "Active" or "Ready"

**If domain is different or missing:**
1. Click "Generate Domain"
2. Update `APP_URL` variable to match the new domain
3. Redeploy

---

### Fix #5: Try PostgreSQL Instead of SQLite

SQLite might not work well on Railway. Try PostgreSQL:

**In Railway Dashboard:**

1. Click **+ New** → **Database** → **Add PostgreSQL**
2. Wait for it to provision (30 seconds)
3. Railway automatically adds these variables:
   - `DATABASE_URL`
   - `PGHOST`, `PGPORT`, `PGUSER`, `PGPASSWORD`, `PGDATABASE`

4. **Update Variables:**
   - Delete `DB_DATABASE` variable (or set to empty)
   - Change `DB_CONNECTION` to: `pgsql`
   
5. **Redeploy**

---

## 📊 What to Send Me If Still Broken

### 1. Railway Deployment Logs

**How to get:**
1. Railway Dashboard → Deployments
2. Click latest deployment
3. Copy **last 50 lines** of build logs

### 2. Railway Runtime Logs

**How to get:**
1. Railway Dashboard → Logs tab
2. Copy **last 30 lines**

### 3. Environment Variables List

**How to get:**
1. Railway Dashboard → Variables
2. List all variable NAMES (not values)
3. Example:
   ```
   APP_NAME
   APP_ENV
   APP_KEY  ← Do you have this?
   APP_URL
   DB_CONNECTION
   ```

### 4. What You See in Browser

- `/health` → What error/response?
- `/` → What error/response?
- Screenshot if possible

---

## 🎯 Common Error Messages & Solutions

### Error: "No application encryption key has been specified"

**Solution:** Add `APP_KEY` to Railway Variables (see Fix #1)

---

### Error: "404 | NOT FOUND" on all pages

**Possible causes:**
1. App isn't starting - Check Railway logs
2. Routes not loading - Try removing route cache
3. Wrong PORT - Check if PORT environment variable is set by Railway

**Solution:**
1. Check Railway Logs for "Server running"
2. If not running, check for error messages
3. Make sure `APP_KEY` is set

---

### Error: "500 | SERVER ERROR"

**Solution:**
1. Set `APP_DEBUG=true` in Railway Variables
2. Redeploy
3. Visit site again - you'll see the actual error
4. Send me the error message

---

### Error: Blank/White Page

**Solution:**
1. Set `APP_DEBUG=true`
2. Check Railway Logs
3. Usually means PHP fatal error

---

## 🔄 Force Redeploy

If nothing works, try forcing a fresh deploy:

**In Railway Dashboard:**
1. Click **Settings**
2. Scroll to "Danger Zone"
3. Click **Redeploy**
4. Wait 3-5 minutes

---

## ✅ Success Checklist

When everything works, you'll see:

- [ ] Railway deployment status: "Active" or "Success"
- [ ] Railway logs show: "Server running on..."
- [ ] `/health` returns JSON: `{"status":"ok"...}`
- [ ] `/` shows your homepage
- [ ] `/admin` shows admin dashboard
- [ ] No errors in browser console

---

## 🆘 Emergency Alternative

If Railway continues to fail, here are alternatives:

### Option 1: Try Heroku
- Similar to Railway
- Might have better PHP support
- Free tier available

### Option 2: Try Render
- Better Laravel support
- Free tier available
- PostgreSQL included

### Option 3: DigitalOcean App Platform
- $5/month but more reliable
- Good Laravel support
- PostgreSQL included

**But let's get Railway working first!**

---

**Next Steps:**

1. ✅ Check Railway Dashboard Logs NOW
2. ✅ Make sure `APP_KEY` is in Variables
3. ✅ Wait for deployment to finish (3-5 min)
4. ✅ Try `/health` endpoint again
5. ✅ Send me the logs if still not working

**I'm here to help!** 🚀


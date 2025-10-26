# Production Configuration Summary

## ✅ Updated Configuration

Your production deployment configuration has been updated to match your existing GCP service.

### Existing Service Details
- **Service Name:** carbonwallet-prod
- **Project:** carbonwallet-prod-476112
- **Region:** asia-southeast1
- **URL:** https://carbonwallet-prod-486326684341.asia-southeast1.run.app
- **Status:** ✅ Running

### Configuration Changes Made
1. **Region:** Updated from `us-central1` to `asia-southeast1` ✅
2. **Port:** Configured for port `8080` (Cloud Run compatible) ✅
3. **Environment Variables:** Configured to match existing service:
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_KEY=base64:h9mEjSzE6+zkxaKeWAHvc5NO7y5/gedKTPpWy/WNhFw=`
4. **Resources:** 2Gi memory, 2 CPU, 10 max instances ✅
5. **Concurrency:** 160 ✅

### Files Updated
- `cloudbuild-production.yaml` - Production build config (asia-southeast1 region)
- `Dockerfile` - Updated to use PHP built-in server on port 8080
- `deploy-production.sh` - Updated script with correct region
- `DEPLOYMENT_SUMMARY.md` - Updated with correct URLs

## 🚀 How to Deploy

### Option 1: Use the Deployment Script
```bash
./deploy-production.sh
```

### Option 2: Manual Deployment
```bash
# Set the production project
gcloud config set project carbonwallet-prod-476112

# Deploy using Cloud Build
gcloud builds submit --config cloudbuild-production.yaml
```

## 📊 Current Service Status

**Production Service:**
- URL: https://carbonwallet-prod-5argpeh6mq-as.a.run.app
- Region: asia-southeast1
- Last Deployed: Check GCP Console for latest deployment time

## 🔍 Check Service Status

```bash
# View service details
gcloud run services describe carbonwallet-prod \
  --region=asia-southeast1 \
  --project=carbonwallet-prod-476112

# View logs
gcloud run services logs read carbonwallet-prod \
  --region=asia-southeast1 \
  --project=carbonwallet-prod-476112 \
  --limit=50
```

## 📝 Important Notes

1. **Your existing service** at `carbonwallet-prod` in `asia-southeast1` remains unchanged
2. **Future deployments** will now use the correct region and configuration
3. **Environment variables** are now included in the Cloud Build config
4. **Port configuration** is set to 8080 for Cloud Run compatibility

## ✅ All Configuration Complete

Your GitHub repository (https://github.com/thinxuan/carbonweb-bryan) now contains:
- ✅ Correct production region (asia-southeast1)
- ✅ Correct port configuration (8080)
- ✅ Environment variables matching your existing service
- ✅ Updated deployment scripts
- ✅ All documentation updated

---

**Ready to deploy!** Run `./deploy-production.sh` when you want to update your production service.


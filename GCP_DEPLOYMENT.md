# Google Cloud Platform (GCP) Deployment Guide

This guide will help you deploy CarbonWallet to GCP without needing Docker or Composer installed locally.

## 📋 Prerequisites

- Google Cloud SDK (gcloud) installed
- GitHub account access
- GCP projects created:
  - Production: `carbonwallet-prod-476112`
  - Staging: `carbonwallet-staging`

## 🚀 Quick Start

### Step 1: Install Google Cloud SDK

```bash
# Download and install gcloud CLI
# Visit: https://cloud.google.com/sdk/docs/install

# Verify installation
gcloud --version
```

### Step 2: Authenticate with Google Cloud

```bash
# Login to GCP
gcloud auth login

# Set default project for staging
gcloud config set project carbonwallet-staging

# Verify current project
gcloud config get-value project
```

### Step 3: Enable Required APIs

Enable necessary Google Cloud APIs:

```bash
# For Staging Project
gcloud config set project carbonwallet-staging
gcloud services enable cloudbuild.googleapis.com
gcloud services enable run.googleapis.com
gcloud services enable artifactregistry.googleapis.com

# For Production Project
gcloud config set project carbonwallet-prod-476112
gcloud services enable cloudbuild.googleapis.com
gcloud services enable run.googleapis.com
gcloud services enable artifactregistry.googleapis.com
```

### Step 4: Configure GitHub Remote

Push code to your GitHub repository:

```bash
# Check current remotes
git remote -v

# Update origin to point to your repo (if needed)
git remote set-url origin https://github.com/thinxuan/carbonweb-bryan.git

# Add all changes
git add .

# Commit (if you have changes)
git commit -m "Initial commit for GCP deployment"

# Push to your GitHub
git push origin main
```

## 🌍 Deploy to Staging Environment

### Deploy from Local Machine

```bash
# Set staging project
gcloud config set project carbonwallet-staging

# Build and deploy to staging
gcloud builds submit --config cloudbuild-staging.yaml

# Get the deployed URL
gcloud run services describe carbonwallet-staging --region=us-central1 --format="value(status.url)"
```

### Set Environment Variables for Staging

```bash
gcloud run services update carbonwallet-staging \
  --region=us-central1 \
  --update-env-vars="APP_ENV=staging,APP_DEBUG=true"
```

## 🚀 Deploy to Production Environment

### Deploy from Local Machine

```bash
# Set production project
gcloud config set project carbonwallet-prod-476112

# Build and deploy to production
gcloud builds submit --config cloudbuild-production.yaml

# Get the deployed URL
gcloud run services describe carbonwallet-prod --region=us-central1 --format="value(status.url)"
```

### Set Environment Variables for Production

```bash
gcloud run services update carbonwallet-prod \
  --region=us-central1 \
  --update-env-vars="APP_ENV=production,APP_DEBUG=false"
```

## 🔄 Automated Deployments with Cloud Build Triggers

### Set up Automatic Deployment from GitHub

#### For Staging:

```bash
# Set staging project
gcloud config set project carbonwallet-staging

# Connect GitHub repository
gcloud builds triggers create github \
  --repo-name=carbonweb-bryan \
  --repo-owner=thinxuan \
  --branch-pattern="^main$" \
  --build-config=cloudbuild-staging.yaml \
  --name=deploy-staging
```

#### For Production:

```bash
# Set production project
gcloud config set project carbonwallet-prod-476112

# Create production branch trigger
gcloud builds triggers create github \
  --repo-name=carbonweb-bryan \
  --repo-owner=thinxuan \
  --branch-pattern="^production$" \
  --build-config=cloudbuild-production.yaml \
  --name=deploy-production
```

## 📝 Deployment Commands Reference

### Manual Deployment

```bash
# Deploy to staging
gcloud builds submit --config cloudbuild-staging.yaml --project=carbonwallet-staging

# Deploy to production
gcloud builds submit --config cloudbuild-production.yaml --project=carbonwallet-prod-476112
```

### View Build History

```bash
# View staging builds
gcloud builds list --project=carbonwallet-staging

# View production builds
gcloud builds list --project=carbonwallet-prod-476112
```

### View Service Logs

```bash
# Staging logs
gcloud run services logs read carbonwallet-staging --region=us-central1

# Production logs
gcloud run services logs read carbonwallet-prod --region=us-central1
```

### Update Service Configuration

```bash
# Update staging
gcloud run services update carbonwallet-staging --region=us-central1 --memory=1Gi

# Update production
gcloud run services update carbonwallet-prod --region=us-central1 --memory=2Gi
```

## 🔐 Managing Secrets (Optional)

For sensitive data like API keys:

```bash
# Create a secret
gcloud secrets create app-key --data-file=secret.txt

# Grant access
gcloud secrets add-iam-policy-binding app-key \
  --member=serviceAccount:<SERVICE_ACCOUNT> \
  --role=roles/secretmanager.secretAccessor
```

## 📊 Monitoring

### View Service Status

```bash
gcloud run services list
```

### Check Service Details

```bash
# Staging
gcloud run services describe carbonwallet-staging --region=us-central1

# Production
gcloud run services describe carbonwallet-prod --region=us-central1
```

## 🔍 Troubleshooting

### Build Failures

```bash
# View detailed build logs
gcloud builds log <BUILD_ID> --project=<PROJECT_ID>
```

### Container Issues

```bash
# Check container logs
gcloud logging read "resource.type=cloud_run_revision" --limit=50
```

### Database Issues

If using SQLite (current setup):
- The database file is stored in `/tmp/database.sqlite` (ephemeral)
- For production, consider migrating to Cloud SQL

## 💰 Cost Management

Monitor costs:

```bash
# View billing
gcloud billing accounts list

# Set up budget alerts in GCP Console
```

**Estimated Monthly Costs:**
- Cloud Run: ~$10-30 (pay per request)
- Cloud Build: ~$5-15 (per build)
- Total: ~$15-45/month for small to medium traffic

## 🎯 Next Steps

1. ✅ Push code to GitHub
2. ✅ Enable Cloud APIs
3. ✅ Deploy to staging
4. ✅ Test staging environment
5. ✅ Deploy to production
6. ✅ Set up monitoring and alerts
7. ✅ Configure custom domain (optional)
8. ✅ Set up database backups (if using Cloud SQL)

## 🌐 Custom Domain Setup (Optional)

```bash
# Map custom domain to Cloud Run service
gcloud run domain-mappings create \
  --service=carbonwallet-prod \
  --domain=yourdomain.com \
  --region=us-central1
```

SSL certificates are managed automatically by Cloud Run.

## 📞 Support

For issues:
1. Check Cloud Build logs
2. Check Cloud Run service logs
3. Review GCP Console for errors

---

**Note:** Since you can't use Docker or Composer locally, Cloud Build handles all the building in the cloud. You only need to:
1. Push code to GitHub
2. Run `gcloud builds submit` commands
3. Cloud Build will build the Docker image and deploy it automatically


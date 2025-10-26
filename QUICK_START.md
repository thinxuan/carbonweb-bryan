# 🚀 Quick Start Guide - Deploy CarbonWallet to GCP

## ✅ What's Been Done

1. ✅ GitHub repository configured: https://github.com/thinxuan/carbonweb-bryan
2. ✅ GCP deployment files created
3. ✅ Code pushed to your GitHub repository
4. ✅ Deployment scripts created

## 🎯 Next Steps

### Prerequisites

Install Google Cloud SDK if you haven't already:

**Option 1: Direct Download (Recommended for macOS without Homebrew)**
```bash
# Download the package
curl -O https://dl.google.com/dl/cloudsdk/channels/rapid/downloads/google-cloud-cli-darwin-arm64.tar.gz

# Extract
tar -xf google-cloud-cli-darwin-arm64.tar.gz

# Run the installer
./google-cloud-cli-darwin-arm64/install.sh

# Reload shell
source ~/.zshrc  # or source ~/.bash_profile

# Verify installation
gcloud --version
```

**Option 2: Download from Website**
1. Visit: https://cloud.google.com/sdk/docs/install
2. Download Google Cloud SDK for your system
3. Follow the installation instructions

**Note:** The direct download works without requiring Homebrew or any package manager

### Step 1: Login to GCP

```bash
# Authenticate with Google Cloud
gcloud auth login

# Set default project for staging
gcloud config set project carbonwallet-staging
```

### Step 2: Enable Required APIs

```bash
# Enable APIs for staging
gcloud services enable cloudbuild.googleapis.com
gcloud services enable run.googleapis.com
gcloud services enable artifactregistry.googleapis.com

# Enable APIs for production
gcloud config set project carbonwallet-prod-476112
gcloud services enable cloudbuild.googleapis.com
gcloud services enable run.googleapis.com
gcloud services enable artifactregistry.googleapis.com
```

### Step 3: Deploy to Staging

```bash
# Option 1: Use the deployment script (easiest)
./deploy-staging.sh

# Option 2: Manual deployment
gcloud config set project carbonwallet-staging
gcloud builds submit --config cloudbuild-staging.yaml
```

### Step 4: Deploy to Production

```bash
# Option 1: Use the deployment script (easiest)
./deploy-production.sh

# Option 2: Manual deployment
gcloud config set project carbonwallet-prod-476112
gcloud builds submit --config cloudbuild-production.yaml
```

### Step 5 (Optional): Set Up Automatic Deployments

If you want automatic deployments when you push code to GitHub:

```bash
./setup-gcp-triggers.sh
```

This will create Cloud Build triggers that automatically deploy when you:
- Push to `main` branch → Deploys to staging
- Push to `production` branch → Deploys to production

## 📊 Check Deployment Status

```bash
# Check staging
gcloud run services list --project=carbonwallet-staging

# Check production
gcloud run services list --project=carbonwallet-prod-476112

# Get service URLs
gcloud run services describe carbonwallet-staging --region=us-central1 --format="value(status.url)"
gcloud run services describe carbonwallet-prod --region=us-central1 --format="value(status.url)"
```

## 📝 Important Notes

1. **No Local Docker/Composer Required**: Cloud Build handles all the building in the cloud
2. **First Deployment**: Takes 5-10 minutes to build the Docker image
3. **Environment Variables**: You may need to set environment variables after deployment
4. **Storage**: Currently using SQLite (ephemeral). For production, consider Cloud SQL

## 🔍 Troubleshooting

### Check Build Logs

```bash
# Check recent builds for staging
gcloud builds list --project=carbonwallet-staging --limit=5

# Check recent builds for production
gcloud builds list --project=carbonwallet-prod-476112 --limit=5

# View detailed build logs
gcloud builds log <BUILD_ID> --project=<PROJECT_ID>
```

### Check Service Logs

```bash
# Staging logs
gcloud run services logs read carbonwallet-staging --region=us-central1 --limit=50

# Production logs
gcloud run services logs read carbonwallet-prod --region=us-central1 --limit=50
```

## 📖 Full Documentation

For detailed information, see [GCP_DEPLOYMENT.md](./GCP_DEPLOYMENT.md)

## 💰 Cost Estimation

- **Cloud Run**: ~$10-30/month (pay per request)
- **Cloud Build**: ~$5-15/month (per build)
- **Total**: ~$15-45/month for small to medium traffic

## 🎉 You're Ready!

You can now deploy to GCP without needing Docker or Composer locally. Just run the deployment scripts!


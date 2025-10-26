#!/bin/bash

# Deploy CarbonWallet to GCP Staging Environment
# This script deploys to the staging project without requiring Docker/Composer locally

set -e

echo "🚀 Deploying CarbonWallet to GCP Staging..."
echo "Project: carbonwallet-staging"
echo ""

# Set the staging project
gcloud config set project carbonwallet-staging

# Submit build to Cloud Build
echo "📦 Submitting build to Cloud Build..."
gcloud builds submit --config cloudbuild-staging.yaml

# Get the service URL
echo ""
echo "✅ Deployment complete!"
echo ""
echo "Getting service URL..."
SERVICE_URL=$(gcloud run services describe carbonwallet-staging --region=us-central1 --format="value(status.url)")

echo ""
echo "🌐 Your application is live at:"
echo "$SERVICE_URL"
echo ""
echo "To view logs, run:"
echo "gcloud run services logs read carbonwallet-staging --region=us-central1"


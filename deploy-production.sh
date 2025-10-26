#!/bin/bash

# Deploy CarbonWallet to GCP Production Environment
# This script deploys to the production project without requiring Docker/Composer locally

set -e

echo "🚀 Deploying CarbonWallet to GCP Production..."
echo "Project: carbonwallet-prod-476112"
echo ""

# Set the production project
gcloud config set project carbonwallet-prod-476112

# Submit build to Cloud Build
echo "📦 Submitting build to Cloud Build..."
gcloud builds submit --config cloudbuild-production.yaml

# Get the service URL
echo ""
echo "✅ Deployment complete!"
echo ""
echo "Getting service URL..."
SERVICE_URL=$(gcloud run services describe carbonwallet-prod --region=us-central1 --format="value(status.url)")

echo ""
echo "🌐 Your application is live at:"
echo "$SERVICE_URL"
echo ""
echo "To view logs, run:"
echo "gcloud run services logs read carbonwallet-prod --region=us-central1"


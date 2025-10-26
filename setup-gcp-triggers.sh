#!/bin/bash

# Setup automated Cloud Build Triggers for GitHub integration
# This allows automatic deployment when you push to GitHub

set -e

echo "🔧 Setting up Cloud Build Triggers for GitHub integration..."
echo ""

read -p "Do you want to setup staging triggers? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then
    echo "📋 Setting up staging triggers..."
    gcloud config set project carbonwallet-staging
    
    echo "Creating staging trigger..."
    gcloud builds triggers create github \
        --repo-name=carbonweb-bryan \
        --repo-owner=thinxuan \
        --branch-pattern="^main$" \
        --build-config=cloudbuild-staging.yaml \
        --name=deploy-staging \
        --description="Auto-deploy to staging when code is pushed to main branch"
    
    echo "✅ Staging trigger created!"
    echo ""
fi

read -p "Do you want to setup production triggers? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then
    echo "📋 Setting up production triggers..."
    gcloud config set project carbonwallet-prod-476112
    
    echo "Creating production trigger..."
    gcloud builds triggers create github \
        --repo-name=carbonweb-bryan \
        --repo-owner=thinxuan \
        --branch-pattern="^production$" \
        --build-config=cloudbuild-production.yaml \
        --name=deploy-production \
        --description="Auto-deploy to production when code is pushed to production branch"
    
    echo "✅ Production trigger created!"
    echo ""
fi

echo "🎉 Cloud Build Triggers setup complete!"
echo ""
echo "Note: You may need to authenticate GitHub with GCP on first trigger."
echo "Visit: https://console.cloud.google.com/cloud-build/triggers"


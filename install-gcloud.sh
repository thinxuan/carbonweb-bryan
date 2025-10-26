#!/bin/bash

# Google Cloud SDK Installation Script (No Homebrew Required)
# This script downloads and installs gcloud CLI on macOS

set -e

echo "🔧 Installing Google Cloud SDK..."
echo ""

# Detect architecture
ARCH=$(uname -m)
if [[ "$ARCH" == "arm64" ]]; then
    DOWNLOAD_URL="https://dl.google.com/dl/cloudsdk/channels/rapid/downloads/google-cloud-cli-darwin-arm64.tar.gz"
    FILE_NAME="google-cloud-cli-darwin-arm64.tar.gz"
    DIR_NAME="google-cloud-cli-darwin-arm64"
elif [[ "$ARCH" == "x86_64" ]]; then
    DOWNLOAD_URL="https://dl.google.com/dl/cloudsdk/channels/rapid/downloads/google-cloud-cli-darwin-x86_64.tar.gz"
    FILE_NAME="google-cloud-cli-darwin-x86_64.tar.gz"
    DIR_NAME="google-cloud-cli-darwin-x86_64"
else
    echo "❌ Unsupported architecture: $ARCH"
    exit 1
fi

echo "📦 Detected architecture: $ARCH"
echo ""

# Download
echo "⬇️  Downloading Google Cloud SDK..."
curl -O "$DOWNLOAD_URL"

# Extract
echo "📂 Extracting..."
tar -xf "$FILE_NAME"

# Install
echo "🚀 Installing..."
if [[ -f "$DIR_NAME/install.sh" ]]; then
    ./$DIR_NAME/install.sh --quiet
else
    echo "❌ Installer script not found"
    exit 1
fi

# Cleanup
echo "🧹 Cleaning up downloaded files..."
rm -rf "$FILE_NAME" "$DIR_NAME"

echo ""
echo "✅ Google Cloud SDK installed successfully!"
echo ""
echo "Please run the following command to reload your shell:"
echo "  source ~/.zshrc"
echo ""
echo "Or if you're using bash:"
echo "  source ~/.bash_profile"
echo ""
echo "Then verify installation:"
echo "  gcloud --version"
echo ""


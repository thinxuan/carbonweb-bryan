#!/bin/bash
set -e

echo "Installing Node.js dependencies..."
npm install

echo "Building assets..."
npm run build

echo "Build completed successfully!"

#!/usr/bin/env bash
# This file should NOT be used - Docker handles everything
# If you see this message, Render is not using Docker mode

echo "ERROR: Render is not in Docker mode!"
echo "Please check Render Dashboard settings:"
echo "1. Build Command should be empty or 'echo Using Dockerfile'"
echo "2. Start Command should be empty or 'echo Using Dockerfile CMD'"
echo "3. Dockerfile should be auto-detected"
echo ""
echo "Or delete this service and use Blueprint method instead."
exit 1

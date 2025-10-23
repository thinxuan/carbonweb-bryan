#!/bin/bash
echo "This service should be configured to use Docker instead of this build script."
echo "Please update Render dashboard settings:"
echo "1. Set Environment to 'Docker'"
echo "2. Remove Build Command or set it to 'echo Using Dockerfile'"
echo "3. Remove Start Command or set it to 'echo Using Dockerfile CMD'"
echo ""
echo "For now, exiting successfully to prevent deployment failure."
exit 0

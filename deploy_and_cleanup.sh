#!/bin/bash

APP_NAME="emailtraduzplusapi"

echo "Starting deploy..."
fly deploy --app "$APP_NAME"
DEPLOY_RESULT=$?

if [ $DEPLOY_RESULT -ne 0 ]; then
    echo "Deploy failed. Exiting."
    exit $DEPLOY_RESULT
fi

echo "Deploy succeeded. Cleaning up stopped machines..."

# Pega IDs das máquinas paradas
STOPPED_MACHINES=$(fly machines list --app "$APP_NAME" --json | jq -r '.[] | select(.state=="stopped") | .id')

if [ -z "$STOPPED_MACHINES" ]; then
    echo "No stopped machines found."
else
    for MACHINE_ID in $STOPPED_MACHINES; do
        echo "Destroying stopped machine: $MACHINE_ID"
        fly machines destroy "$MACHINE_ID" --app "$APP_NAME" --yes
    done
fi

echo "Cleanup finished."

#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
APP_DIR="${ROOT_DIR}/app"

HOST="${HOST:-127.0.0.1}"
PORT="${PORT:-8000}"

cd "${APP_DIR}"
echo "Serving from: ${APP_DIR}"
echo "URL: http://${HOST}:${PORT}"
echo "Router: ${APP_DIR}/router.php (clean URLs like /coaching, /contacto)"
exec php -S "${HOST}:${PORT}" router.php



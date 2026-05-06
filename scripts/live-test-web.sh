#!/usr/bin/env bash
set -euo pipefail

python_port="${PYTHON_API_PORT:-8000}"
php_port="${PHP_WEB_PORT:-8080}"

echo "[live-test] Starte Vorbereitung..."
bash scripts/bootstrap.sh

echo "[live-test] Starte Dienste..."
bash scripts/start-services.sh

echo "[live-test] Pruefe API-Health..."
curl -fsS "http://localhost:${python_port}/health" >/tmp/live_test_health.json
cat /tmp/live_test_health.json

echo "[live-test] Pruefe DB-Anbindung..."
curl -fsS "http://localhost:${python_port}/db-check" >/tmp/live_test_dbcheck.json
cat /tmp/live_test_dbcheck.json

echo "[live-test] Pruefe Fahrenheit-Reiseseite..."
curl -fsS "http://localhost:${php_port}/fahrenheit_reiseseite/" >/tmp/live_test_fahrenheit.html
head -n 20 /tmp/live_test_fahrenheit.html

echo "[live-test] Erfolgreich"
echo "[live-test] Browser-Zielseite: http://localhost:${php_port}/fahrenheit_reiseseite/"
echo "[live-test] API-Health:        http://localhost:${python_port}/health"

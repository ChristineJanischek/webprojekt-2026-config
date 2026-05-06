#!/usr/bin/env bash
set -euo pipefail

function wait_for_python_db() {
  local port="$1"
  local attempts=30
  local i

  for ((i=1; i<=attempts; i++)); do
    if curl -fsS "http://localhost:${port}/db-check" | grep -q '"ok":true'; then
      echo "[start] Python-API und DB-Verbindung sind bereit"
      return 0
    fi
    echo "[start] Warte auf Python-API/DB (${i}/${attempts})..."
    sleep 1
  done

  echo "[start] Fehler: Python-API konnte keine stabile DB-Verbindung herstellen"
  return 1
}

if [[ ! -f .env ]]; then
  cp .env.example .env
  echo "[start] .env aus .env.example erzeugt"
fi

if grep -q "CHANGE_ME" .env; then
  echo "[start] Fehler: .env enthaelt noch CHANGE_ME-Werte. Bitte zuerst Zugangsdaten setzen."
  exit 1
fi

docker compose up -d --build

echo "[start] Warte auf MySQL-Init und python-api..."
docker compose restart python-api >/dev/null 2>&1 || true

python_port="${PYTHON_API_PORT:-8000}"
php_port="${PHP_WEB_PORT:-8080}"

wait_for_python_db "${python_port}"

echo "[start] Dienste gestartet"
echo "[start] PHP-Webapp:   http://localhost:${php_port}"
echo "[start] Python-API:   http://localhost:${python_port}/health"
echo "[start] Zielseite:    http://localhost:${php_port}/fahrenheit_reiseseite/"

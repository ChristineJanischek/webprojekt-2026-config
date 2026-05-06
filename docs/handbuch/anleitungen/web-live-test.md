# Webprojekt live im Browser testen (Fahrenheit-Reiseseite)

## Ziel
Diese Anleitung startet alle benoetigten Dienste im aktuellen Repository und prueft die Zielseite `webapp/public/fahrenheit_reiseseite` live im Browser.

## Voraussetzungen
- Docker ist verfuegbar.
- Ein Terminal im Projektroot ist offen.
- Datei `.env` ist vorhanden oder wird automatisch erzeugt.

## Schritt-fuer-Schritt

### Schnellstart (ein Befehl)
```bash
bash scripts/live-test-web.sh
```

Der Befehl fuehrt Vorbereitung, Dienstestart und die wichtigsten Live-Pruefungen direkt hintereinander aus.

### 1. Projekt vorbereiten
```bash
bash scripts/bootstrap.sh
```

Falls `.env` noch Platzhalterwerte mit `CHANGE_ME` enthaelt:
1. Oeffne `.env`.
2. Setze sichere lokale Werte fuer:
   - `MYSQL_ROOT_PASSWORD`
   - `MYSQL_PASSWORD`

### 2. Alle Dienste starten
```bash
bash scripts/start-services.sh
```

Der Start ist erfolgreich, wenn die Ausgabe enthaelt:
- `Python-API und DB-Verbindung sind bereit`
- URL der PHP-Webapp
- URL der Zielseite

### 3. Live-Endpunkte pruefen
```bash
curl -fsS http://localhost:${PYTHON_API_PORT:-8000}/health
curl -fsS http://localhost:${PYTHON_API_PORT:-8000}/db-check
curl -fsS http://localhost:${PHP_WEB_PORT:-8080}/fahrenheit_reiseseite/ | head -n 20
```

Erwartung:
- `health` liefert `"status":"ok"`
- `db-check` liefert `"ok":true` und `demo_items`
- HTML der Reiseseite wird ausgegeben

### 4. Seite im Browser oeffnen
- Zielseite: `http://localhost:8080/fahrenheit_reiseseite/`
- API-Health: `http://localhost:8000/health`

In Codespaces ist normalerweise kein VNC noetig.
Nutze Port-Forwarding und oeffne die URL direkt im Browser.

### 5. Kompletten Smoke-Test ausfuehren
```bash
bash scripts/test-services.sh
```

Damit werden PHP-Webseite, Python-API, DB-Abfrage und Java-Smoke-Test zusammen geprueft.

### 6. Dienste stoppen
```bash
bash scripts/stop-services.sh
```

## Hinweise fuer Live-Entwicklung
- Quellcode unter `webapp/public` ist im `php-web`-Container als Volume eingebunden. Aenderungen sind direkt im Browser sichtbar.
- Fuer API-Aenderungen unter `services/python-api` den Service neu bauen:

```bash
docker compose up -d --build python-api
```

## Troubleshooting

### Fehler: `.env enthaelt noch CHANGE_ME-Werte`
Setze in `.env` reale lokale Entwicklungswerte fuer die geforderten Passwoerter.

### Fehler: `Database connection failed`
1. `docker compose ps` pruefen
2. `docker compose logs --tail=120 mysql` pruefen
3. `docker compose restart python-api` ausfuehren
4. `curl -fsS http://localhost:8000/db-check` erneut pruefen

### Browser zeigt Seite nicht
1. `docker compose ps` pruefen
2. Portfreigabe fuer `8080` kontrollieren
3. Testweise Startseite aufrufen: `http://localhost:8080/`

## Zugehoerige Skripte
- `scripts/bootstrap.sh`
- `scripts/start-services.sh`
- `scripts/test-services.sh`
- `scripts/stop-services.sh`

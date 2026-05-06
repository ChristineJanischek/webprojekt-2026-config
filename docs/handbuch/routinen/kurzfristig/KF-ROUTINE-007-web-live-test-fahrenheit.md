# KF-ROUTINE-007: Web-Live-Test Fahrenheit-Reiseseite

## Metadata
- **ID:** KF-ROUTINE-007
- **Kategorie:** kurzfristig
- **Haeufigkeit:** taeglich (bei aktiver Webentwicklung)
- **Zeitaufwand:** 10-20 Minuten
- **Verantwortlicher:** Autor der Web- oder API-Aenderung
- **Abhaengigkeiten:** anleitungen/web-live-test.md, KF-ROUTINE-006-qualitaetsgate-pruefung.md
- **Version:** 1.0
- **Letzte Aktualisierung:** 06.05.2026

## Ziel
Sicherstellen, dass die Seite `fahrenheit_reiseseite` inklusive API- und DB-Anbindung in der Live-Umgebung lauffaehig ist.

## Vorbedingungen
- Projektroot ist im Terminal geoeffnet.
- Docker ist verfuegbar.
- `.env` enthaelt keine `CHANGE_ME`-Werte.

## Schritte
1. Umgebung vorbereiten: `bash scripts/bootstrap.sh`
2. Dienste starten: `bash scripts/start-services.sh`
3. API pruefen: `curl -fsS http://localhost:8000/health`
4. DB-Anbindung pruefen: `curl -fsS http://localhost:8000/db-check`
5. Zielseite aufrufen: `http://localhost:8080/fahrenheit_reiseseite/`
6. Gesamttest starten: `bash scripts/test-services.sh`
7. Nach Abschluss Dienste stoppen: `bash scripts/stop-services.sh`

## Erfolgskriterien
- Zielseite wird im Browser korrekt geladen.
- API-Health liefert Status `ok`.
- DB-Check liefert `ok: true`.
- `scripts/test-services.sh` endet ohne Fehler.

## Fehlerbehandlung
- Start bricht wegen `.env` ab: Zugangsdaten in `.env` setzen.
- DB-Check fehlgeschlagen: `docker compose logs --tail=120 mysql` und `docker compose restart python-api`.
- Zielseite nicht erreichbar: Port 8080 freigeben und `docker compose ps` pruefen.

## Ausgaben/Ergebnisse
- Nachweisbar funktionsfaehige Live-Umgebung fuer Web, API und DB.
- Reproduzierbarer Testablauf fuer taegliche Entwicklung.

## Verknuepfungen
- [web-live-test.md](../../anleitungen/web-live-test.md)
- [KF-ROUTINE-006-qualitaetsgate-pruefung.md](KF-ROUTINE-006-qualitaetsgate-pruefung.md)

## Changelog
- v1.0 (06.05.2026): Initiale Routine fuer Browser-Live-Tests erstellt

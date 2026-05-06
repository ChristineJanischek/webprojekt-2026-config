#!/usr/bin/env bash
set -euo pipefail

if [[ ! -d src/volleyball ]] || ! compgen -G "src/volleyball/*.java" >/dev/null; then
	echo "[java] Kein Java-Quellcode unter src/volleyball gefunden - Java-Smoke-Test wird uebersprungen"
	exit 0
fi

mkdir -p build/java
javac -d build/java src/volleyball/*.java

echo "[java] Kompilierung erfolgreich"

echo "[java] Starte Headless-Modell-Smoke-Tests..."
java -cp build/java volleyball.ModelSmokeTest

echo "[java] Modell-Tests erfolgreich"

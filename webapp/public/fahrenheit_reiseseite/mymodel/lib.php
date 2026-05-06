<?php
function werte_rechnerformular_aus(){
    //Eingaben lesen
    $pFahrenheit = $_POST['tfFahrenheit'];
    
    //Verarbeitung
    $celsius = umrechnen($pFahrenheit);
    $info =pruefen($pFahrenheit);
    
    //Ausgabe
    echo "Eingabe (in Grad Fahrenheit):<br>".$pFahrenheit."<br>";
    echo "Umrechnung (in Grad Celsius):<br>".$celsius."<br>";
    echo "Information:<br>".$info."<br>";
}

function umrechnen($pFahrenheit){
    
    $celsius = ($pFahrenheit-32)*5/9;
    return $celsius;
    
}

function pruefen($pFahrenheit){
    if($pFahrenheit >77){
        echo "Eventuell ist ein Sonnenschtz empfehlenswert!";
    }elseif($pFahrenheit < 32){
        echo "Die Temperaturen liegen unter dem Gefrierpunkt. Ziehen Sie sich warm an!";
    }else{
        echo "In der Regel schwanken die Temperaturen aufgrund der Jahreszeiten in ganz Europa.
Prüfen Sie deshalb aktuelle Weterlage vor Ort!";
    }
    
}


//FÜR MAIN
function werteAus(){
    //Implementierung (Inhalt definieren)
    //Hier wird eine Nachricht deklariert
    $mMessage  =   erzeugeAnleitung();
    
    //und zur ckgegeben
    return $mMessage;
}

//Für main
/*Funktion/Methode
 * die irgendetwas ausgeben kann*/
function erzeugeAnleitung(){
    //Implementierung (Inhalt definieren)
    //Hier wird eine Nachricht deklariert
    $mMessage = "<section><ol><h2>Vorgehensweise - Do it!</h2>
                    <li>Die Formular-Komponenten geh&ouml;ren in die Form-Datei! (Eingabe-Komponenten implementieren!)</li>
                    <li>Die Bibliothek (lib.php) ist im head des Frameworks includiert! (Checke das!)</li>
                    <li>Die Bibliothek (lib.php), das ist die Modell-Datei. Diese Datei findest Du im Verzeichnis 'mymodel'.
                        Das ist der Ort f&uuml;r die Implementierung der Formularauswertung und Ausgabe. (Implementiere ggf. fehlende Bestandteile!)</li>
                    <li>Die Steuerung von Ereignissen (Action) geh&ouml;rt in die Controller-Datei! Hier kannst Du die Bestandteile der Bibliothek nutzen,
                        indem Du die Funktionen/Methoden aufrufts. (Implementiere fehlende Aufrufe!)</li>
                </ol><br><br><br></section>";
    //und zur ckgegeben
    return $mMessage;
}

/*Funktion/Methode
 * die eine Ausgabe die in einer Variablen (Platzhalter) steckt!*/
function schreibeAusgabe($pAusgabe){
    echo $pAusgabe;
}

?>
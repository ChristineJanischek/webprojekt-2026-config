
    <!-- FORMULAR ANFANG -->
    <h2>noch kein Form eingebettet</h2>
    <Form name = "Fahrenheitrechner" method="post" action ="view_rechneroutput.php">
    	<Fieldset>
    		<legend>Grad Fahrenheit in Grad Celsius umrechnen</legend>
    		<lable for ="tfFahrenheit" >Bitte geben Sie die Temperatur (in Grad Fahrenheit) ein:</lable><br><br>
    		<input type ="number" step="0.01" id="tfFahrenheit" name= "tfFahrenheit"></input><br><br>
    		<input  type ="submit" value="Ausrechnen" name="celsiusAusrechnen"/>
    		<?php echo "<input type='button' value='Zur&uuml;ck' onClick='history.back()'/>"?>
    	
    	</Fieldset>
    </Form>
	<!-- FORMULAR ENDE -->



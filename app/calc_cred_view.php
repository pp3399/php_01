<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Kalkulator kredytowy </title>
	</head>
	<body>
		<h3>Kalkulator kredytowy</h3>
		
		<form action="<?php print(_APP_URL);?>/app/calc_cred.php" method="get">
			<label for="amount">Kwota: </label>
			<input id="amount" type="text" name="amt" value="<?php if (isset($amt)) print($amt); ?>"/>
			<br/>
			
			<label for="years">Liczba lat: </label>
			<input id="years" type="text" name="yrs" value="<?php if (isset($yrs)) print($yrs); ?>"/>
			<br/>
			
			<label for="rate">Oprocentowanie (w %): </label>
			<input id="rate" type="text" name="rt" value="<?php if (isset($rt)) print($rt); ?>"/>
			<br/>
			<input type="submit" value="Oblicz miesięczną ratę"/>
		</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
		<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #0f0; width:300px;"> 
<?php echo 'Miesięczna rata wynosi: '.$result . ' zł'; ?>
		</div>
<?php } ?>
	</body>
</html>
<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$amt = $_REQUEST ['amt'];
$yrs = $_REQUEST ['yrs'];
$rt = $_REQUEST ['rt'];


// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($amt) && isset($yrs) && isset($rt))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $amt == "") {
	$messages [] = 'Nie podano kwoty';
}

if ( $yrs == "") {
	$messages [] = 'Nie podano liczby lat';
}

if ( $rt == "") {
	$messages [] = 'Nie podano oprocentowania';
}

//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $messages )) {
	
	// sprawdzenie, czy $amt i $yrs i $rt są liczbami całkowitymi
	if (! is_numeric( $amt )) {
		$messages [] = 'Podana kwota nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $yrs )) {
		$messages [] = 'Podana liczba lat nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $rt )) {
		$messages [] = 'Podane oprocentowanie nie jest liczbą całkowitą';
	}
}


//sprawdzenie czy któraś z podanych wartości nie jest ujemna
if (empty( $messages )) {
	
	// sprawdzenie, czy $amt i $yrs i $rt są liczbami całkowitymi
	if ($amt < 0) {
		$messages [] = 'Kwota musi być dodatnia (większa od 0)';
	}
	
	if ($yrs < 0) {
		$messages [] = 'Liczba lat musi być dodatnia (większa od 0)';
	}
	
	if ($rt < 0) {
		$messages [] = 'Oprocentowanie musi być dodatnie (większe od zera)';
	}
}





// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na int
	$amount = intval($amt);
	$years = intval($yrs);
	$rate = floatval($rt);
	
	$years = $years*12;
	$rate = $rate/100;
	
	$result = ($amount * $rate)/(12*(1 - ((12/(12+$rate)) **$years))); //wzór na raty równe
	$result = number_format($result, 2, ',', ' '); //zaokrąglanie do 2 miejsc po przecinku - ? notacja francuska ?
	
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$amt,$yrs,$rt,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_cred_view.php';
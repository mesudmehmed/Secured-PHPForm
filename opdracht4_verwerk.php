<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>#1Mesud - Backend</title>
	<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://82894.ict-lab.nl/FRONT2/SPA/style/style.css">
	</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container">
    <a class="navbar-brand" href="#">Mesud Mehmed</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
   
  </div>
</nav>

<header>
<div class="mesud">
<?php
	session_start();
	if(isset($_SESSION["token"]) && $_SESSION["token"] == $_POST["csrf_token"]){
		}else{
echo 'False token !';		
}
	//uitzeten van de foutmeldings voor extra beveiliging
	ini_set("display_errors", 0);
    include 'error.php';
	//controleren of de afzender de pagina opdracht1_form.php is
if (isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] == "opdracht4_form.php") {
	//einde controle van de afzender
   }else{
      echo 'False afzender !';	
   }
	function uuidv4(){
		$data = openssl_random_pseudo_bytes(16);
		$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
		$data[8] = chr(ord($data[6]) & 0x3f | 0x80);
		return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}
	//variabelen defeneren en beveilegen aan de hand van de functies: htmlspecialchars, trim, strip_tags en htmlentities
    $Fname = htmlspecialchars(trim(strip_tags(htmlentities(ucfirst(($_POST['Vnaam']))))));
	$Bname = htmlspecialchars(trim(strip_tags(htmlentities(ucfirst(($_POST['Anaam']))))));
	$Emi = htmlspecialchars(trim(strip_tags(htmlentities($_POST['Email']))));
	$Date = htmlspecialchars(trim(strip_tags(htmlentities($_POST['Datum']))));
	$Tnum = htmlspecialchars(trim(strip_tags(htmlentities($_POST['Tel']))));
	$Postcode = htmlspecialchars(trim(strip_tags(htmlentities(strtoupper($_POST['Pcode'])))));
	$DatePattern = "Y-m-d";
	$TnumPattern = "/[0-9]{2}[0-9]{8}/";
	$PostcodePattern = "/[0-9]{4}[A-Z]{2}|[0-9]{4}[a-z]{2}/";
	$id = uuidv4();
	//controleren of alle velden aanwezig zijn
	if (isset($Fname) && $Bname && $Emi && $Date && $Tnum && $Postcode){
		//einde controle van de velden	
    }else{
		echo 'False formulier !';
		echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
	}
	//controleren of de eerste variabel leeg is
    if (empty($Fname)) {
        echo "Voornaam veld is leeg !<br>";
		echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
    }
	//controleren of de twede variabel leeg is
    if (empty($Bname)) {
        echo "Achternaam veld is leeg !<br>";
		echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
    }
	//controleren of de derde variabel leeg is
    if (empty($Emi)) {
        echo "Email veld is leeg !<br>";
		echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
    }
	 //controleren of het een echte email is aan de hand van de FILTER_VALIDATE_EMAIL functie
     if (filter_var($Emi, FILTER_VALIDATE_EMAIL)) {
		 }else{
      echo 'Ongeldige email adres !<br>';
		 echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
       }
	//controleren of de vierde variabel leeg is
    if (empty($Date)) {
        echo "Datum veld is leeg !<br>";
		echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
    }
	
		//controleren of het ingevulde date een echte datum is
		if(date($DatePattern, strtotime($Date)) == date($Date)){
			}else{
		echo 'Ongeldige datum !<br>';
		  echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
		} 
	//controleren of de vijfde variabel leeg is
    if (empty($Tnum)) {
        echo "Telefoon nummer veld is leeg !<br>";
		echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
    }
	  //controleren of de ingevulde data een echte telefoon nummer is
		if (preg_match($TnumPattern, $Tnum) == 1){	
			}else{
		echo 'Ongeldige telefoon nummer!<br>';	
			echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
		}
	//controleren of de zesde variabel leeg is
    if (empty($Tnum)) {
        echo "Postcode veld is leeg !<br>";
		echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
    }
		//controleren of de ingevulde data een echte postcode is
		if (preg_match($PostcodePattern, $Postcode) == 1){	
			}else{
	echo 'Ongeldige postcode !<br>';
	echo '<br><br><a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a></div>';
		  exit();
		}	
    $host = "localhost";  //db host
    $username = ""; //db username
    $password = ""; //db password
    $dbname = ""; //dbname
    $mysqli = new mysqli($host, $username, $password, $dbname);
     if ($mysqli->connect_error) {
    die("Geen Verbinding: " . $mysqli->connect_error);
     }
   $stmt = mysqli_prepare($mysqli, "INSERT INTO veipro (ID, Voornaam, Achternaam, Email, Datum, Telefoon, Postcode) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "sssssss", $id, $Fname, $Bname, $Emi, $Date, $Tnum, $Postcode);
	if (mysqli_stmt_execute($stmt)){
		echo '<div class="alert alert-success" role="alert">
    Toevoeging gelukt: <br><strong>ID: '. $id. '</br> Voornaam: '. $Fname. '</br> Achternaam: '. $Bname. '</br> Email: '. $Emi. '</br> Datum: '. $Date. '</br> Telefoon Nummer: '. $Tnum. '</br> Postcode: '. $Postcode. '</strong>.</div>';	
	}
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($mysqli);
	
?>
	<br><br>
	<a href="opdracht4_form.php" class="btn btn-outline-secondary">Terug naar Opdracht 4</a>
	</div>
	
</header>
	</body>
	</head>
</html>
	


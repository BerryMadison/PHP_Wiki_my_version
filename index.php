<?php 
	/* Database credentials. Assuming you are running MySQL
	server with default setting (user 'root' with password 'CTC-Lohr') */
	/*mit dieser Datei soll eine Verbindung zur Datenbank aufgebaut werden */
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'tunix');
	define('DB_NAME', 'php');

	/* Attempt to connect to MySQL database */
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	// Check connection
	if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}

	/* change character set to utf8mb4 */
	if (!mysqli_set_charset($link, "utf8mb4")) {
		printf("Error loading character set utf8mb4: %s\n", mysqli_error($link));
		exit();
	}
?>
<!doctype html>
	<html lang="de">
	<head> 
		<meta charset="utf-8">
		<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="stylesheet.css">
		<title>PHPwiki</title>

	</head>	
	<body>
		<header>
			<div class="center">
				<h1>PHP WIKI</h1>
				<ul>
					<li><a href="insert.php">Infos in die Datenbank hinzufügen</a></li>
					<li>
					<form style="padding:10px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">		<!-- '<form>'-Tag mit Suchleiste & Button -->
						<input type="text" name="search" placeholder="Suche">								<!-- '<input>'-Tag die eigentliche Suchleiste -->
						<button type="submit" name="submit-search">Search</button>							<!-- '<button>'-Tag startet Suche -->
					</form>
					</li>
				</ul>
			</div>
		</header>

		<main class="php">
		<?php
		$sql = "SELECT * FROM phpwiki;";
		$ergebnis = mysqli_query($link, $sql);
		$spaltennamen = array('namo', 'beschreibung','beispiel','Art');
		
		if (!isset($_POST['submit-search'])) {
			echo "<div class='command-container'>";
			$queryResults = mysqli_num_rows($ergebnis);
			if ($queryResults > 0) {
				while ($row = mysqli_fetch_assoc($ergebnis)) {
					echo "<div class='klasse'>
							<p style='font-size:large;margin:0;'>".$row['Art']."</p>
							<p style='font-size:xx-large;font-weight:bold;margin:0;'>".$row['namo']."</p><br>
							<p>".$row['beschreibung']."</p><br>
							<p class='>".$row['beispiel']."</p><br>
						</div>";
				}
			}
			echo "</div>";
		} else {
			$search = mysqli_real_escape_string($link, $_POST['search']);
			$sql = "SELECT * FROM phpwiki WHERE namo LIKE '%$search%' or beschreibung LIKE 
				'%$search%' or beispiel LIKE '%$search%' or Art LIKE '%$search%'";
			$result = mysqli_query($link, $sql);
			$queryResult = mysqli_num_rows($result);

			
			if ($queryResult == 1) {
				echo "<p style='font-size:large;'>Es gibt " .$queryResult." Ergebnis!</p>";
			} else {
				echo "<p style='font-size:large;'>Es gibt " .$queryResult." Ergebnisse!</p>";
			}

			
			echo "<div class='command-container'>";

			$result = mysqli_query($link, $sql);
			$queryResults = mysqli_num_rows($result);

			if ($queryResults > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					echo "<div>
							<div class='command-box'>
							<p style='font-size:large;'>".$row['Art']." <span style='font-size:xx-large;font-weight:bold;'>".$row['namo']."</span></p><br>
							<p>".$row['beschreibung']."</p><br>
							<p>".$row['beispiel']."</p><br>
							</div>
						</div>";
				}
			}
		}

	?>
		</main>
	</body>
</html>
<!doctype html>
	<html lang="de">
	<head> 
		<meta charset="utf-8">
		<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="stylesheet.css">
		<title>PHPwiki</title>

		<?php 

		?>
	</head>	
	<body>
		<header>
			<div class="center">
				<h1>PHP WIKI</h1>
				<ul>
					<li><a href="index.php">Suche</a></li>
					<li>
						<form style="padding:0;" method ='GET' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<table>
								<tr>
									<label for='namo'>Das ist der Name</label><br>
									<input class='input' id='namo' type='text' name='namo' required>
									<br>
								</tr>
								<br>
								<tr>
									<label for='beschreibung'>Das ist die Beschreibung</label><br>
									<textarea id="beschreibung" name="beschreibung" rows="4" cols="50"></textarea>
								</tr>
								<br><br>
								<tr>
									<label for='beispiel'>Das ist ein Beispiel</label><br>
									<input class='input' id='beispiel' type='text' name='beispiel' required>
									<br>
								</tr>
								<br>
								<tr>
									<label for='art'>Das ist die Art</label><br>
									<select class='randy' type='text' name="art" id="art">
												<option value="Variable">Variable</option>
												<option value="Funktion">Funktion</option>
												<option value="Kontrollstruktur">Kontrollstruktur</option>
									</select>
									<br>
								</tr>
								<br>
								<tr>
									<button type="submit">In Datenbank speichern</button>
								</tr>
								<br>
								<tr>
									<div class="hinweis">
										<?php
											// Database credentials. Assuming you are running MySQL
											// server with default setting (user 'root' with password 'CTC-Lohr')
											// mit dieser Datei soll eine Verbindung zur Datenbank aufgebaut werden
											define('DB_SERVER', 'localhost');
											define('DB_USERNAME', 'root');
											define('DB_PASSWORD', 'tunix');
											define('DB_NAME', 'php');
											
											// Attempt to connect to MySQL database 
											$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
											
											// Check connection
											if($link === false){
												die("ERROR: Could not connect. " . mysqli_connect_error());
											}
											
											// change character set to utf8mb4 
											if (!mysqli_set_charset($link, "utf8mb4")) {
												printf("Error loading character set utf8mb4: %s\n", mysqli_error($link));
												exit();
											}


											
											$namo = $beschreibung = $beispiel = $art = "";

											$sql = "INSERT INTO phpwiki(namo,beschreibung,beispiel,art) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE 
											namo=VALUES(namo), 
											beschreibung=VALUES(beschreibung),
											beispiel=VALUES(beispiel), 
											art=VALUES(art);";

											$stmt=mysqli_prepare($link, $sql);
											mysqli_stmt_bind_param($stmt, 'ssss', $namo, $beschreibung, $beispiel, $art);




											function test_input($data)	
											{
													$data = trim($data);
													$data = stripslashes($data);
													$data = htmlspecialchars($data);
													
													return $data;
											}

											if(!empty($_GET['namo'])||!empty($_GET['beschreibung'])||!empty($_GET['beispiel'])||!empty($_GET['art']))
											{
											$namo= test_input($_GET['namo']);
											echo $namo;
											$beschreibung = test_input($_GET['beschreibung']);
											echo $beschreibung;
											$beispiel= test_input($_GET['beispiel']);
											echo $beispiel;
											$art = test_input($_GET['art']);
											echo $art;
											}

											//var_dump($_GET);

											if(empty($_GET['namo'])||empty($_GET['beschreibung'])||empty($_GET['beispiel'])||empty($_GET['art']))
											{
												echo "Bitte geben Sie ein vollständiges Set an Werten ein";
											}else{
												if(mysqli_stmt_execute($stmt)){
													echo "Speichern hat geklappt.";
													mysqli_stmt_close($stmt);
												}else{
													echo "Speichern hat nicht geklappt.";
												}
											}
										?>
									</div>
								</tr>
								<br>
							</table>
						</form>
					</li>
				</ul>
			</div>
		</header>
	</body>
</html>
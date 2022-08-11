drop database php;
create database php;
use php;
create table phpwiki
	(
	   namo varchar(30) primary key not null,
	   beschreibung longtext not null,
	   beispiel longtext,
	   Art enum('Variable','Funktion','Kontrollstruktur')
    );

insert into phpwiki values 
	(
	'for', /*name*/
	'Die For-Schleife ist eine kopfgesteuerte Schleife und eine Kontrollstruktur, die durch Wiederhohlungen Befehle abarbeitet, die mit Start- und Stopp-Bedingungen begrenzt sind.', /*beschreibung*/
	'for($i=0,$i<10,$i++){echo $i;}', /*beispiel*/
	'Kontrollstruktur' /*art*/
	),
	(
	'foreach', /*name*/
	'Die For-Schleife ist eine kopfgesteuerte Schleife und eine Kontrollstruktur, die durch Wiederhohlungen Befehle abarbeitet, die alle Elemente im array durchlueft.', /*beschreibung*/
	'Bei indizierten Arrays:<br><br>
	foreach (array_name as $value)
	    statement
	<br><br>
	Bei aoosziativen Arrays:<br><br>
	foreach (array_name as $key => $value)
	statement', /*beispiel*/
	'Kontrollstruktur' /*art*/
	),
	(
	'while', /*name*/
	'Die While-Schleife ist eine kopfgesteuerte Schleife und eine Kontrollstruktur, die durch Wiederhohlungen Befehle abarbeitet, die mit einer Stopp-Bedingungen begrenzt ist.', /*beschreibung*/
	'while ($i <= 10) {
     echo $i++; }', /*beispiel*/
	'Kontrollstruktur' /*art*/
	)
	,
	(
	'do while', /*name*/
	'Die While-Schleife ist eine fussgesteuerte Schleife und eine Kontrollstruktur, die durch Wiederhohlungen Befehle abarbeitet, die mit einer Stopp-Bedingungen begrenzt ist, die allerdings erst nach dem ersten Durchlauf die Stopp-Bedingungen �berpr�ft. Das hei�t das sie immer mindestnes einen Durchlauf hat.', /*beschreibung*/
	'do {echo $x; $x++;} while ($x < 10);', /*beispiel*/
	'Kontrollstruktur' /*art*/
	),
	(
	'switch case', /*name*/
	'Switch case ist eine Verzweigung und eine Kontrollstruktur, die einzelen Fuelle der Eingabe ueberprueft und seperate und unterschiedliche Befehle ausfuehrt.', /*beschreibung*/
	'switch $x {case 1: echo "case1"; break; case 2: echo "case2" break; case 3: echo "case3"; break; default: echo "default"; break; }', /*beispiel*/
	'Kontrollstruktur' /*art*/
	),
	(
	'if else ', /*name*/
	'if else ist eine Verzweigung und eine Kontrollstruktur, nach dem Entweder-Oder-Schema.', /*beschreibung*/
	'if($i == 2){echo "true"}else{echo "false"}', /*beispiel*/
	'Kontrollstruktur' /*art*/
	),
	(
	'int', /*name*/
	'int oder integer vraiable beschreibt ganze zahlen. Die spanne ist durch 32Bit darstellbar ', /*beschreibung*/
	'$i=0;
	$min=-2147483648;
	$max=2147483647;', /*beispiel*/
	'Variable' /*art*/
	);

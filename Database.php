<?php
/**
 * Created by PhpStorm.
 * User: Nichlas
 * Date: 05-12-2017
 * Time: 08:55
 */
//Database.php hed originalt index.php men blev omdøbt fordi jeg skulle
// lave en login i stedet og jeg vil gerne henvise til den først
// når jeg starter programmet

// en if statement der siger at hvis username ||(betyder eller)
// password ikke er korrekt så skriver den ud at der er fejl
// og der bliver også lavet en knap hvor man kan gå tilbage og prøve igen
if ($_POST["username"] != "admin" || $_POST["password"] != "1234"){

 ?>
    Username or password not correct go back and try again
    <button onclick="window.history.back()"> Try again</button>
<?php
    exit();
}

//connectionen til databasen
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "progexam_1";

// Create connection og hvis der kommer en fejl så printer den ud at der er en fejl
$conn = new PDO("mysql:host=$servername;dbname=$dbname" , $username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

// vores join som også skal stå i vores sql de 2 left join er en advanceret opgave 1
$select = "SELECT ORD_ID, ORD_DATE, ORD_DESCRIPTION,ORD_AMOUNT,AGENT_NAME,CUST_NAME FROM orders
LEFT JOIN agents ON orders.AGENT_ID = agents.AGENT_ID
LEFT JOIN customers ON orders.CUSTOMER_ID = customers.CUST_ID";

//den første linje laver en prepare statement
// den anden linje executer
// den tredje linje henter dataen asociative dvs man for et array tilbage der asociative
$result = $conn->prepare($select);
$result->execute();
$result = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- linket er fra bootstrap og det henter deres css stylesheet under man skal downloaded det -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
   <!-- script tagget er brugt til at forbinde med mit javascript som indeholder sortable -->
    <script src="Sortable.js">

    </script>
</head>
<body>
<!-- her laver jeg en table classe med 6 table heads som opgaven nævner -->
<table class="table sortable">
 <thead>
 <tr>
<!-- her i table head (th) laver jeg en overskrift for hver af de
 tabeller opgaven kræver -->
 <th>Ordre ID </th>
 <th>Ordredato </th>
 <th>Ordrebeskrivelse </th>
 <th>Ordrebeløb </th>
     <th>Agent</th>
     <th>Customer</th>
 </tr>

 </thead>
<tbody>

<?php
// for hvert result der er bliver sat ind som en række dvs at ord id for en rækkes osv.
foreach ($result as $row) : ?>
<tr>
    <!-- her henter jeg data fra tabellerne og sætter dem ind i rows/rækker -->
  <td><?= $row['ORD_ID'] ?> </td>
    <td><?= $row['ORD_DATE'] ?></td>
    <td><?= $row['ORD_DESCRIPTION'] ?></td>
    <td><?= $row['ORD_AMOUNT'] ?></td>
    <td><?= $row['AGENT_NAME'] ?></td>
    <td><?= $row['CUST_NAME'] ?></td>
</tr>
<?php endforeach; ?>

</tbody>
</table>



</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: nichlas
 * Date: 08-12-2017
 * Time: 09:30
 */


//connectionen til databasen
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "progexam_1";

// Create connection og hvis der kommer en fejl så printer den ud at der er en fejl
$conn = new PDO("mysql:host=$servername;dbname=$dbname" , $username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );

// mit join som også skal stå i vores sql de 2 left join er en advanceret opgave 1
$select = "SELECT ORD_ID, ORD_DATE, ORD_DESCRIPTION,ORD_AMOUNT,AGENT_NAME,CUST_NAME FROM orders
LEFT JOIN agents ON orders.AGENT_ID = agents.AGENT_ID
LEFT JOIN customers ON orders.CUSTOMER_ID = customers.CUST_ID";

//den første linje laver en prepare statement
// den anden linje executer
// den tredje linje henter dataen asociative dvs man for et array tilbage der asociative
$result = $conn->prepare($select);
$result->execute();
$result = $result->fetchAll(PDO::FETCH_ASSOC);


// echo printer $result ud som en json for at se om det virker skal du åbne chrome og
// skrive local host vælge mappen din opgave ligger i og derefter stien = localhost/mappen/json_api.php
echo json_encode($result);


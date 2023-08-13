<?php
$servername = "db4free.net";
$username = "sam2651";
$password = "12341652";
$dbname = "cse391a3";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully<br>";

$sql = "SELECT section_no,seats FROM sections";
$result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     //echo "section_no: " . $row["section_no"]. " - seats: " . $row["seats"]."<br>";
//   }
// } else {
//   echo "0 results";
// }
//$conn->close();



?>
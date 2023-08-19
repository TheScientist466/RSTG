<?php
$servername = "localhost:3306";
$username = "ivan";
$password = "2345";

$conn = new MySQLi($servername, $username, $password);

if($conn->connect_error) {
    die("Connection failed : " . $conn->connect_error);
}

echo "Connected successfully<br>";

$sql = "SELECT ID, Name, CountryCode, District FROM world.city WHERE CountryCode='" . $_POST["Code"] . "'";
$result = $conn->query($sql);

//echo $sql;

if ($result->num_rows > 0) {
    echo "<table>\n";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td>" . $row["CountryCode"] . "</td>";
        echo "<td>" . $row["District"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
else {
    echo "0 results";
}
$conn->close();

?>

<?php
// Database connection
$host = "localhost";
$username = "2440245";
$password = "Rabinbst123*";
$database = "db2440245";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve movies
$sql = "SELECT Movie_name, Genre, Price, Date_of_release FROM movies";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Movies List</title>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 30px;
}

h1 {
    color: #333;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid black;
    padding: 12px;
    text-align: left;
}

th {
    background-color: lightgrey;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>

</head>
<body>

<h1>Movies List</h1>

<table>
<tr>
    <th>Movie Name</th>
    <th>Genre</th>
    <th>Price</th>
    <th>Date of Release</th>
</tr>

<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        echo "<td>" .
             htmlspecialchars($row["Movie_name"]) .
             "</td>";

        echo "<td>" .
             htmlspecialchars($row["Genre"]) .
             "</td>";

        echo "<td>£" .
             number_format((float)$row["Price"], 2) .
             "</td>";

        echo "<td>" .
             date("d/m/Y", strtotime($row["Date_of_release"])) .
             "</td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No movies found</td></tr>";
}

$conn->close();
?>

</table>

</body>
</html>

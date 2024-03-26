<?php

$applicationID = isset($_GET['applicationID']) ? $_GET['applicationID'] : null;

if (!$applicationID) {
    echo "Application ID not provided.";
    exit();
}

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "realestateregistration";

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DocumentFile  FROM registrationapplication WHERE ApplicationID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $applicationID);


$stmt->execute();


$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    
    $documentFile = $row["DocumentFile"];

    
    $stmt->close();
} else {
    echo "Application not found.";
    exit();
}

$conn->close();

header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=document.pdf");
header("Content-Transfer-Encoding: binary");
header("Accept-Ranges: bytes");

echo $documentFile;
?>

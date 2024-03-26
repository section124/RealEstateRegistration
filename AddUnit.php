<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Egyptian Real Estate Registration</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/favicon.ico" rel="icon">
    <?php
session_start();
if (!isset($_SESSION["BuyerUserID"])) {
    header("Location: login.php");
    exit();
}
?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style3.css" rel="stylesheet">
</head>
<body>
<?php
$userID = $_SESSION["BuyerUserID"];
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "realestateregistration";
    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $queryGet = "SELECT ApplicationID, UnitAddress, ApplicationDate FROM registrationapplication WHERE BuyerUserID = '".$userID."'";
        $resultGet = $conn->query($queryGet);

        if (!$resultGet) {
            die("Query failed: " . $conn->error);
        }
    }
?>
<a href="#" class="navbar-brand p-0">
    <h1 class="m-0">Egyptian Real Estate Registration</h1>
</a>
<div class="container-xxl position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="left-logo">
            <img src="img/logo 1.png" alt="Logo">
        </div>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
            <a href="index2.php" class="nav-item nav-link active">Home</a>
                    <a href="about2.php" class="nav-item nav-link">About</a>
                    <a href="service2.php" class="nav-item nav-link">Service</a>
                    <a href="contact2.php" class="nav-item nav-link">Contact</a>
            </div>
            <div class="dropdown">
                <button class="dropbtn">&#9776;</button>
                <div class="dropdown-content">
                <a href="UnitRegistration.php?BuyerUserID=<?php echo $userID; ?>">Unit Registration</a>
                    <a href="AddUnit.php?BuyerUserID=<?php echo $userID; ?>">My Units</a>
                    <a href="AccountDetails.php?BuyerUserID=<?php echo $userID; ?>">Account Details</a>
                    <a href="index.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</div>

</br></br>
<div class="container-s">
    <h2> Units List  </h2>
    <table>
        <tr>
            <th style="color: black;">Application ID</th>
            <th style="color: black;">Unit Address</th>
            <th style="color: black;">Application Date</th>
            <th style="color: black;">Status</th> 
            <th style="color: black;">Applications</th> 
        </tr>

        <?php
        if ($resultGet->num_rows > 0) {
            while ($row = $resultGet->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ApplicationID"] . "</td>";
                echo "<td>" . $row["UnitAddress"] . "</td>";
                echo "<td>" . $row["ApplicationDate"] . "</td>";
                echo "<td><a href='ViewStatus.php?applicationID=" . $row["ApplicationID"] . "' class='btn btn-primary'>View Status</a></td>";
                echo "<td><a href='ViewApplication.php?applicationID=" . $row["ApplicationID"] . "' class='btn btn-primary'>View Application</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>NO data found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

<br><br>
<a href="UnitRegistration.php" class="btn btn-primary">Add New Unit</a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js"></script>
</body>
</html>

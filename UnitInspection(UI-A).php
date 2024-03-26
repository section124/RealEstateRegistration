<?php
session_start();

$userID = "";

if (isset($_SESSION['BuyerUserID'])) {
    $userID = $_SESSION['BuyerUserID'];
} else {
    header("Location: Login.php");
    exit();
}
?>
<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "realestateregistration";
$link = new mysqli($host, $username, $password, $dbname);
if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$query = "SELECT ApplicationID, UnitAddress, ApplicationDate FROM unitinspection WHERE DocumentApproval != 'Accepted'";
$result = $link->query($query);

$queryAccepted = "SELECT ApplicationID, UnitAddress, ApplicationDate FROM unitinspection WHERE DocumentApproval = 'Accepted'";
$resultAccepted = $link->query($queryAccepted);

if (!$result || !$resultAccepted) {
    die("Error fetching data: " . $link->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Egyptian Real Estate Registration</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style2.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style3.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="m-0">Egyptian Real Estate Registration</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
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
                        <a href="index(UI-A).php" class="nav-item nav-link active">Home</a>
                        <a href="about(UI-A).php" class="nav-item nav-link">About</a>
                        <a href="service(UI-A).php" class="nav-item nav-link">Service</a>
                        <a href="contact(UI-A).php" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">&#9776;</button>
                        <div class="dropdown-content">
                            <a href="UnitInspection(UI-A).php">Waiting list</a>
                            <a href="CustomerInquiries(UI-A).php">Customer Inquiries</a>
                            <a href="AccountDetails(UI-A).php?BuyerUserID=<?php echo $userID; ?>">Account Details</a>
                            <a href="index.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            </nav>
        </br></br>
        </br></br>
        <!-- Add the form for user registration -->
        <div class="container-s">
        <h2>Welcome to Unit Inspection Office<h2>
            <h2>Customer List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Application ID</th>
                        <th>Unit Address</th>
                        <th>Application Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ApplicationID'] . "</td>";
                        echo "<td>" . $row['UnitAddress'] . "</td>";
                        echo "<td>" . $row['ApplicationDate'] . "</td>";
                        echo "<td>";
                        echo '<button class="btn btn-success" style="margin-right: 10px;" onclick="viewApplication(' . $row['ApplicationID'] . ')">View Application</button>';
                        echo '<button class="btn btn-success" style="margin-right: 10px;" onclick="changeStatus(' . $row['ApplicationID'] . ')">Change Status</button>';
                        echo '<button class="btn btn-success" onclick="viewStatus(' . $row['ApplicationID'] . ')">View Status</button>';
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container-s">
            <h2>Customer List (Accepted)</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Application ID</th>
                        <th>Unit Address</th>
                        <th>Application Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    while ($row = $resultAccepted->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['ApplicationID'] . "</td>";
                        echo "<td>" . $row['UnitAddress'] . "</td>";
                        echo "<td>" . $row['ApplicationDate'] . "</td>";
                        echo "<td>";
                        echo '<button class="btn btn-success" style="margin-right: 10px;" onclick="viewApplication(' . $row['ApplicationID'] . ')">View Application</button>';
                        echo '<button class="btn btn-success" style="margin-right: 10px;" onclick="changeStatus(' . $row['ApplicationID'] . ')">Change Status</button>';
                        echo '<button class="btn btn-success" onclick="viewStatus(' . $row['ApplicationID'] . ')">View Status</button>';
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/isotope/isotope.pkgd.min.js"></script>
        <script src="lib/lightbox/js/lightbox.min.js"></script>
        <script>
            function viewApplication(applicationID) {
                window.location.href = "ViewApplication(UI-A).php?applicationID=" + applicationID;
            }

            function changeStatus(applicationID) {
                window.location.href = "ChangeStatus(UI-A).php?applicationID=" + applicationID;
            }

            function viewStatus(applicationID) {
                window.location.href = "ViewStatus(UI-A).php?applicationID=" + applicationID;
            }
        </script>
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>

    </html>
    <?php
    $link->close();
    ?>

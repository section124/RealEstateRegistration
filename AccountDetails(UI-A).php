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
<?php
if (!isset($_SESSION["BuyerUserID"])) {
    header("Location: Login.php"); 
    exit();
}
    $BuyerUserID = isset($_GET['BuyerUserID']) ? $_GET['BuyerUserID'] : null;

    if (!$BuyerUserID) {
        echo "User ID not provided.";
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

    $sql = "SELECT * FROM registration WHERE BuyerUserID = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in SQL query: " . $conn->error);
    }

    $stmt->bind_param("i", $BuyerUserID);

    
    $stmt->execute();

    
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        $userName = $row["BuyerFullName"];
        $dateOfBirth = $row["DateOfBirth"];
        $nationalID = $row["BuyerNationalID"];
        $userAddress = $row["BuyerAddressee"];
        $phoneNumber = $row["BuyerPhoneNumber"];
        $email = $row["BuyerEmail"];
        $password = $row["BuyerPassword"];
        

        
        $stmt->close();
    } else {
        echo "User account not found.";
        exit();
    }


    $conn->close();
    ?>
<body>
<div class="container-xxl bg-white p-0">

    <a href="" class="navbar-brand p-0">
        <h1 class="m-0">Egyptian Real Estate Registration
        </h1>
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
    </div>
</br></br>
</br></br>
</br>
<div class="mb-3">
            <label for="user-id" class="form-label">User ID:</label>
            <input type="text" class="form-control" id="user-id" name="user-id" value="<?php echo $BuyerUserID; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="user-name" class="form-label">User Name:</label>
            <input type="text" class="form-control" id="user-name" name="user-name" value="<?php echo $userName; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="date-of-birth" class="form-label">Date of Birth:</label>
            <input type="date" class="form-control" id="date-of-birth" name="date-of-birth" value="<?php echo $dateOfBirth; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="national-id" class="form-label">National ID:</label>
            <input type="text" class="form-control" id="national-id" name="national-id" value="<?php echo $nationalID; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="user-address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="user-address" name="user-address" value="<?php echo $userAddress; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="phone-number" class="form-label">Phone Number:</label>
            <input type="tel" class="form-control" id="phone-number" name="phone-number" value="<?php echo $phoneNumber; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="text" class="form-control" id="password" name="password" value="<?php echo $password; ?>" readonly>
        </div>

        <!-- Add a button or link to go back to the menu or another page -->
        <div class="mb-3">
            <button type="button" class="btn btn-primary" onclick="window.location.href='index(UI-A).php'">Back to Menu</button>
        </div>
</div>
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


<script src="js/main.js"></script>
</body>
</html>

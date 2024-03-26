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

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "realestateregistration";
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Egyptian Real Estate Registration - View Status (UI-A)</title>
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
        <!-- PHP Code to Fetch Data from Database -->
        <?php
        if (isset($_GET['applicationID'])) {
            $applicationID = $_GET['applicationID'];

           
            $query = "SELECT ra.*, 
            ui.PreviewDate, ui.PreviewResult, ui.FinalApproval as FinalApprovalUnitInspection, 
            np.PreviewApproval, np.FirstReview, np.SecondReview, np.RequiredFees, np.FinalApproval as FinalApprovalNotary,
            ui.DocumentVerification, ui.DocumentReview, ui.DocumentApproval
         FROM registrationapplication ra
         LEFT JOIN unitinspection ui ON ra.UnitAddress = ui.UnitAddress AND ra.ApplicationID = ui.ApplicationID
         LEFT JOIN notarypublic np ON ra.ApplicationID = np.ApplicationID
         WHERE ra.ApplicationID = '$applicationID'";

            $result = $conn->query($query);

            if (!$result) {
                die("Error in query: " . $conn->error);
            }

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                echo '<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">';
                echo '    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">';
                echo '        <span class="sr-only">Loading...</span>';
                echo '    </div>';
                echo '</div>';
                                ?>
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0">Egyptian Real Estate Registration
                    </h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>

                <!-- Navbar & Hero Start -->
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
                    </nav>
                </div>
                </br></br>
                </br>
                <div class="container-s">
                    <!-- Accordion for States of Registration Application submission documents -->
                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="registration-documents-heading">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#registration-documents-collapse" aria-expanded="true" aria-controls="registration-documents-collapse">
                                    States of Registration Application Submission Documents
                                </button>
                            </h2>
                            <div id="registration-documents-collapse" class="accordion-collapse collapse show" aria-labelledby="registration-documents-heading">
                                <div class="accordion-body">
                                    <ul class="state-states">
                                        <li class="state-state">
                                            <strong>Document Verification:</strong> <?php echo $row["DocumentVerification"]; ?>
                                        </li>
                                        <li class="state-state">
                                            <strong>Review:</strong> <?php echo $row["DocumentReview"]; ?>
                                        </li>
                                        <li class="state-state">
                                            <strong>Approval:</strong> <?php echo $row["DocumentApproval"]; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    <!-- Accordion for States of Unit Inspection -->
                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="unit-preview-heading">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#unit-preview-collapse" aria-expanded="false" aria-controls="unit-preview-collapse">
                                    States of Unit Inspection
                                </button>
                            </h2>
                            <div id="unit-preview-collapse" class="accordion-collapse collapse" aria-labelledby="unit-preview-heading">
                                <div class="accordion-body">
                                    <ul class="state-states">
                                        <li class="state-state">
                                            <strong>Preview Date:</strong> <?php echo $row["PreviewDate"]; ?>
                                        </li>
                                        <li class="state-state">
                                            <strong>Preview Result:</strong> <?php echo $row["PreviewResult"]; ?>
                                        </li>
                                        <li class="state-state">
                                            <strong>Final Approval:</strong> <?php echo $row["FinalApprovalUnitInspection"]; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back to Top -->
                <a class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
                <?php
            } else {
                echo "No data found for the user. Check your database data and query criteria.";
            }
        }
    
        $conn->close();
        ?>
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

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "realestateregistration";

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $statusDocumentVerification = isset($_POST['status-select']) ? $_POST['status-select'] : null;
    $statusReview = isset($_POST['status-select-review']) ? $_POST['status-select-review'] : null;
    $newStatus = isset($_POST['new-status']) ? $_POST['new-status'] : null;
    $previewDate = isset($_POST['date-select']) ? $_POST['date-select'] : null;
    $previewResult = isset($_POST['status-select-preview']) ? $_POST['status-select-preview'] : null;
    $finalApproval = isset($_POST['new-status']) ? $_POST['new-status'] : null;

    $applicationID = isset($_POST['applicationID']) ? $_POST['applicationID'] : null;

    if (!$applicationID) {
        echo "ApplicationID not provided in the form.";
        exit;
    }
    }

    
    $checkQuery = "SELECT * FROM unitinspection WHERE ApplicationID = '$applicationID'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $updateQuery = "UPDATE unitinspection SET 
        DocumentVerification = '$statusDocumentVerification',
        DocumentReview = '$statusReview',
        DocumentApproval = '$newStatus',
        PreviewDate = '$previewDate',
        PreviewResult = '$statusReview',
        FinalApproval = '$finalApproval'
        WHERE ApplicationID = '$applicationID'";


        if ($conn->query($updateQuery) === TRUE) {
            echo "<p>Status updated successfully.</p>";

            header("Location: ViewStatus(UI-A).php?applicationID=$applicationID");
            exit;
        } else {
            echo "<p>Error updating status: " . $conn->error . "</p>";
        }
    } else {
        $insertQuery = "INSERT INTO unitinspection (ApplicationID, DocumentVerification, DocumentReview, DocumentApproval, PreviewDate, PreviewResult, FinalApproval)
                        VALUES ('$applicationID', '$statusDocumentVerification', '$statusReview', '$newStatus', '$previewDate', '$previewResult', '$finalApproval')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "<p>New record inserted successfully.</p>";
        } else {
            echo "<p>Error inserting record: " . $conn->error . "</p>";
        }
    }


    $conn->close();

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
            <h2>Updated Status Application Submission Documents</h2>
            <div class="mb-3">
    <label for="application-id" class="form-label">Application ID:</label>
    <input type="text" class="form-control" id="application-id" name="application-id" value="<?php echo $applicationID; ?> " readonly>
</div>
<!--Status Document Verification -->
<div class="mb-3">
    <label for="status-select" class="form-label">Status Document Verification:</label>
    <input type="text" class="form-control" id="status-select" name="status-select" value="<?php echo $statusDocumentVerification; ?>" readonly>
</div>
<!-- Status Review -->
<div class="mb-3">
    <label for="status-select-review" class="form-label">Status Review:</label>
    <input type="text" class="form-control" id="status-select-review" name="status-select-review" value="<?php echo $statusReview; ?>" readonly>
</div>
<!-- New Status -->
<div class="mb-3">
    <label for="new-status" class="form-label">New Status:</label>
    <input type="tel" class="form-control" id="new-statusr" name="new-status" value="<?php echo $newStatus; ?>" readonly>
</div>
<h2>Updated Status Unit Inspection</h2>
<!--  Preview Date -->
<div class="mb-3">
    <label for="date-select" class="form-label">Preview Date:</label>
    <input type="date" class="form-control" id="date-select" name="date-select" value="<?php echo $previewDate; ?>" readonly>
</div>
<!-- Status Preview Result -->
<div class="mb-3">
    <label for="status-select-preview" class="form-label">Status Preview Result:</label>
    <input type="text" class="form-control" id="status-select-preview" name="status-select-preview" value="<?php echo $previewResult; ?>" readonly>
</div>
<!-- Status Final Approval: -->
<div class="mb-3">
    <label for="address" class="form-label">Status Final Approval:</label>
    <input type="text" class="form-control" id="address" name="address" value="<?php echo $finalApproval; ?>" readonly>
</div>
        </div>
    </div>
</body>

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
    function changeStatusManually() {

        document.getElementById('status-change-form').submit();
    }
</script>

<script src="js/main.js"></script>
</html>
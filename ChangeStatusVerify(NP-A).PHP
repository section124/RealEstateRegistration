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
    $SecondReview = isset($_POST['select-second']) ? $_POST['select-second'] : null;
    $DatetPayfeesContractSignature = isset($_POST['date-select']) ? $_POST['date-select'] : null;
    $finalApproval = isset($_POST['status-select-preview']) ? $_POST['status-select-preview'] : null;
    $requiredFees = isset($_POST['required-fees']) ? $_POST['required-fees'] : null;

    $applicationID = isset($_POST['applicationID']) ? $_POST['applicationID'] : null;

    if (!$applicationID) {
        echo "ApplicationID not provided in the form.";
        exit;
    }

    $feesReceipt = isset($_FILES['fees-receipt']) ? $_FILES['fees-receipt'] : null;
    $feesReceiptFileName = isset($feesReceipt['name']) ? $feesReceipt['name'] : null;
    $feesReceiptTmpName = isset($feesReceipt['tmp_name']) ? $feesReceipt['tmp_name'] : null;

    if ($feesReceiptTmpName && is_uploaded_file($feesReceiptTmpName)) {
        $feesReceiptData = file_get_contents($feesReceiptTmpName);
    } else {
        $feesReceiptData = null;
    }

    $documentsDeedOfOwnershipPDF = isset($_FILES['deed-of-ownership']) ? $_FILES['deed-of-ownership'] : null;
    $documentsDeedFileName = isset($documentsDeedOfOwnershipPDF['name']) ? $documentsDeedOfOwnershipPDF['name'] : null;
    $documentsDeedTmpName = isset($documentsDeedOfOwnershipPDF['tmp_name']) ? $documentsDeedOfOwnershipPDF['tmp_name'] : null;

    if ($documentsDeedTmpName && is_uploaded_file($documentsDeedTmpName)) {
        $documentsDeedData = file_get_contents($documentsDeedTmpName);
    } else {
        $documentsDeedData = null;
    }

    $checkQuery = "SELECT * FROM notarypublic WHERE ApplicationID = '$applicationID'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        $updateQuery = "UPDATE notarypublic SET 
            PreviewApproval = ?,
            FirstReview = ?,
            SecondReview = ?,
            FinalApproval = ?,
            DatetPayfeesContractSignature = ?,
            RequiredFees = ?,
            FeesReceiptPDF = ?,  
            DocumentsDeedOfOwnershipPDF = ? 
            WHERE ApplicationID = ?";

        $stmt = $conn->prepare($updateQuery);
        if (!$stmt) {
            die("Error in prepared statement: " . $conn->error);
        }

        $stmt->bind_param("sssssssss", $statusDocumentVerification, $statusReview, $SecondReview, $finalApproval, $DatetPayfeesContractSignature, $requiredFees, $feesReceiptData, $documentsDeedData, $applicationID);

        if ($stmt->execute()) {
            echo "<p>Status updated successfully.</p>";

            header("Location: ViewStatus(NP-A).php?applicationID=$applicationID");
            exit;
        } else {
            echo "<p>Error updating status: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        $insertQuery = "INSERT INTO notarypublic (ApplicationID, PreviewApproval, FirstReview, SecondReview, FinalApproval, DatetPayfeesContractSignature, RequiredFees, FeesReceiptPDF, DocumentsDeedOfOwnershipPDF)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertQuery);
        if (!$stmt) {
            die("Error in prepared statement: " . $conn->error);
        }

        $stmt->bind_param("sssssssss", $applicationID, $statusDocumentVerification, $statusReview, $SecondReview, $finalApproval, $DatetPayfeesContractSignature, $requiredFees, $feesReceiptData, $documentsDeedData);

        if ($stmt->execute()) {
            echo "<p>New record inserted successfully.</p>";
        } else {
            echo "<p>Error inserting record: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Digital Agency HTML Template</title>
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
                        <a href="index(NP-A).php" class="nav-item nav-link active">Home</a>
                        <a href="about(NP-A).php" class="nav-item nav-link">About</a>
                        <a href="service(NP-A).php" class="nav-item nav-link">Service</a>
                        <a href="contact(NP-A).php" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">&#9776;</button>
                        <div class="dropdown-content">
                        <a href="NotaryPublic(NP-A).php">Waiting list</a>
                            <a href="CustomerInquiries(NP-A).php">Customer Inquiries</a>
                            <a href="AccountDetails(NP-A).php?BuyerUserID=<?php echo $userID; ?>">Account Details</a>
                            <a href="index.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            </nav>
        </div>
    </div>
    <div class="container-s">
        <h2>Updated States of Notary Public</h2>
        <!-- Preview Date -->
        <div class="mb-3">
            <label for="date-select" class="form-label">Preview Approval:</label>
            <input type="date" class="form-control" id="date-select" name="date-select" value="<?php echo $statusDocumentVerification; ?>" readonly>
        </div>

        <!-- Status Preview Result -->
        <div class="mb-3">
            <label for="status-select-preview" class="form-label">First Review:</label>
            <input type="text" class="form-control" id="status-select-preview" name="status-select-preview" value="<?php echo $statusReview; ?>" readonly>
        </div>

        <!-- Status Final Approval -->
        <div class="mb-3">
            <label for="address" class="form-label">Second Review:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $SecondReview; ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Required Fees:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $requiredFees; ?>" readonly>
        </div>

        <!-- Date to Pay fees and contract Signature -->
        <div class="mb-3">
            <label for="date-select" class="form-label">Date to Pay fees and contract Signature (for Seller and Buyer):</label>
            <input type="date" class="form-control" id="date-select" name="date-select" value="<?php echo $DatetPayfeesContractSignature; ?>" readonly>
        </div>

        <!-- Final Approval -->
        <div class="mb-3">
            <label for="address" class="form-label">Final Approval:</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $finalApproval; ?>" readonly>
        </div>
                        <!-- Upload Fees Receipt (PDF) -->
    <div class="mb-3">
        <label for="fees-receipt" class="form-label">Upload Fees Receipt (PDF):</label>
        <input type="file" class="form-control" id="fees-receipt" name="fees-receipt" value="<?php echo $feesReceiptFileName ; ?>" readonly>
    </div>

    <!-- Upload Documents of Deed of Ownership (PDF) -->
    <div class="mb-3">
        <label for="deed-of-ownership" class="form-label">Upload Documents of Deed of Ownership (PDF):</label>
        <input type="file" class="form-control" id="deed-of-ownership" name="deed-of-ownership" value="<?php echo $documentsDeedFileName  ; ?>" readonly>
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
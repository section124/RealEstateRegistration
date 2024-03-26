<?php
session_start();
$userID = "";
if (isset($_SESSION['BuyerUserID'])) {
    $userID = $_SESSION['BuyerUserID'];
} else {
    header("Location: Login.php");
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

$query = "SELECT BuyerFullName, BuyerPhoneNumber, BuyerAddressee, BuyerEmail, BuyerNationalID FROM registration WHERE BuyerUserID = '$userID'";
$result = $conn->query($query);
if ($result && $result->num_rows > 0) {
    $buyerInfo = $result->fetch_assoc();
} else {
    die("Error: Buyer information not found for BuyerUserID $userID");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["document"]) && $_FILES["document"]["error"] == 0) {
        $file = $_FILES["document"];
        if ($file["type"] == "application/pdf") {
            $pdfData = file_get_contents($file["tmp_name"]);
            $stmt = $conn->prepare("INSERT INTO registrationapplication (DocumentFile, BuyerUserID) VALUES (?, ?)");
            $stmt->bind_param("bi", $pdfData, $userID);
            $stmt->send_long_data(0, $pdfData);
            if ($stmt->execute()) {
                echo "Registration and file upload successful.";
            } else {
                echo "Error in registration or file upload: " . $conn->error;
            }
            $stmt->close();
        } else {
            echo "Please upload only PDF files.";
        }
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
    <link href="img/logo 1.png" rel="icon">

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
    </div>
    <!-- Add the form for user registration -->
</br></br>
    <div class="container-s">
        <h2>Registration Application</h2>
        <form id="registration-form" method="post" action="UnitRegistrationView.php" enctype="multipart/form-data">
            <!-- Application ID (Read from the database) -->
            <div class="mb-3">
                <label for="application-id" class="form-label">Application ID:</label>
                <?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "realestateregistration";
$link = new mysqli($host, $username, $password, $dbname);

if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} else {
        $applicationID = rand(100000, 999999);
    echo '<div class="mb-3">';
    echo '<input type="text" class="form-control" id="application-id" name="application-id" value="' . $applicationID . '" readonly>';
    echo '</div>';
    
}
?>
            </div>
            <!-- UserID (Read from the database) -->
            <div class="mb-3">
    <label for="user-id" class="form-label">User ID:</label>
    <?php
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    } else {
                if (isset($_SESSION['BuyerUserID'])) {
            $userID = $_SESSION['BuyerUserID'];

            echo '<input type="text" class="form-control" id="user-id" name="user-id" value="' . $userID . '" readonly>';
        } else {
            echo 'User ID not found in session.';
        }
    }


    $link->close();
    ?>
</div>

<!-- Buyer Full Name -->
<div class="mb-3">
    <label for="name" class="form-label">Buyer Full Name:</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $buyerInfo['BuyerFullName']; ?>" required>
</div>

<!-- Buyer Phone Number -->
<div class="mb-3">
    <label for="phone-number" class="form-label">Buyer Phone Number:</label>
    <input type="tel" class="form-control" id="phone-number" name="phone-number" value="<?php echo $buyerInfo['BuyerPhoneNumber']; ?>" required>
</div>
                <!-- Application Date -->
                <div class="mb-3">
                    <label for="application-date" class="form-label">Application Date:</label>
                    <input type="date" class="form-control" id="application-date" name="application-date" required>
                </div>

<!-- Address -->
<div class="mb-3">
    <label for="address" class="form-label">Address:</label>
    <input type="text" class="form-control" id="address" name="address" value="<?php echo $buyerInfo['BuyerAddressee']; ?>" required>
</div>

<!-- Buyer Email -->
<div class="mb-3">
    <label for="email" class="form-label">Buyer Email:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $buyerInfo['BuyerEmail']; ?>" required>
</div>

<!-- National ID -->
<div class="mb-3">
    <label for="national-id" class="form-label">National ID:</label>
    <input type="text" class="form-control" id="national-id" name="national-id" value="<?php echo $buyerInfo['BuyerNationalID']; ?>" required>
</div>

                <!-- Seller Full Name -->
                <div class="mb-3">
                    <label for="seller-name" class="form-label">Seller Name:</label>
                    <input type="text" class="form-control" id="seller-name" name="seller-name" required>
                </div>

                <!-- Seller Email -->
                <div class="mb-3">
                    <label for="seller-email" class="form-label">Seller Email:</label>
                    <input type="email" class="form-control" id="seller-email" name="seller-email" required>
                </div>

                <!-- Seller National ID -->
                <div class="mb-3">
                    <label for="seller-national-id" class="form-label">Seller National ID:</label>
                    <input type="text" class="form-control" id="seller-national-id" name="seller-national-id" required>
                </div>

                <!-- Seller Phone Number -->
                <div class="mb-3">
                    <label for="seller-phone-number" class="form-label">Seller Phone Number:</label>
                    <input type="tel" class="form-control" id="seller-phone-number" name="seller-phone-number" required>
                </div>

                <!-- Unit Address -->
                <div class="mb-3">
                    <label for="unit-address" class="form-label">Unit Address:</label>
                    <input type="text" class="form-control" id="unit-address" name="unit-address" required>
                </div>

                <!-- Unit Total Area -->
                <div class="mb-3">
                    <label for="unit-total-area" class="form-label">Unit Total Area:</label>
                    <input type="number" class="form-control" id="unit-total-area" name="unit-total-area" required>
                </div>

                <!-- Type Of Unit -->
                <div class="mb-3">
                    <label for="type-of-unit" class="form-label">Type Of Unit:</label>
                    <select class="form-select" id="type-of-unit" name="type-of-unit">
                        <option value="Single-Family Homes">Single-Family Homes</option>
                        <option value="Apartments">Apartment</option>
                        <option value="Condominiums">Condominiums</option>
                        <option value="Townhouses">Townhouses</option>
                        <option value="Villas">Villas</option>
                        <option value="Office Spaces">Office Spaces</option>
                    </select>
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <!-- Ownership Contract -->
                <div class="mb-3">
                    <label for="ownership-contract" class="form-label">Ownership Contract:</label>
                    <input type="text" class="form-control" id="ownership-contract" name="ownership-contract" required>
                </div>
                <!-- Upload Documents -->
                <div class="mb-3">
                <label for="document" class="form-label">Upload Documents (PDF):</label>
                <input type="file" class="form-control" id="document" name="document" accept=".pdf">
                </div>
                <!-- Ownership Year -->
                <div class="mb-3">
                    <label for="ownership-year" class="form-label">Ownership Year:</label>
                    <input type="text" class="form-control" id="ownership-year" name="ownership-year" required>
                </div>
                <!-- Notary Public -->
                <div class="mb-3">
                    <label for="notary-public" class="form-label">Notary Public:</label>
                    <select class="form-select" id="notary-public" name="notary-public">
                        <option value="Cairo">Cairo</option>
                        <option value="Alexandria">Alexandria</option>
                        <option value="Giza">Giza</option>
                        <option value="Luxor">Luxor</option>
                        <option value="Hurghada">Hurghada</option>
                    </select>
                </div>
            <!-- Submit Button -->
            <button type="submit" value="Upload" action="UnitRegistrationView.php" class="btn btn-primary">Submit</button>

        </form>
</br>

    <form action="UnitRegistration.php" method="post" enctype="multipart/form-data">

    </form>
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

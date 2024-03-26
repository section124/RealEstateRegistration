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

    $sql = "SELECT * FROM registrationapplication WHERE ApplicationID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $applicationID);

    
    $stmt->execute();

    
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        
        $applicationID = $row["ApplicationID"];
        $userID = $row["BuyerUserID"];
        $buyerName = $row["BuyerFullName"];
        $buyerPhoneNumber = $row["BuyerPhoneNumber"];
        $applicationDate = $row["ApplicationDate"];
        $buyerAddress = $row["BuyerAddress"];
        $buyerEmail = $row["BuyerEmail"];
        $buyerNationalID = $row["BuyerNationalID"];
        $sellerName = $row["SellerFullName"];
        $sellerEmail = $row["SellerEmail"];
        $sellerNationalID = $row["SellerNationalID"];
        $sellerPhoneNumber = $row["SellerPhoneNumber"];
        $unitAddress = $row["UnitAddress"];
        $unitTotalArea = $row["UnitTotalArea"];
        $typeOfUnit = $row["TypeOfUnit"];
        $price = $row["Price"];
        $ownershipContract = $row["OwnershipContractNo"];
        $ownershipYear = $row["OwnershipYear"];
        $notaryPublic = $row["NotaryPublic"];
        

        
        $stmt->close();
    } else {
        echo "Application not found.";
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
        </div>
        </nav>
    </div>
</br></br>
</br></br>
<div class="container-s">
    <h2>Registration Application</h2>
    <form id="registration-form" method="post" action="UnitRegistration.php">
       <!-- Application ID -->
<div class="mb-3">
    <label for="application-id" class="form-label">Application ID:</label>
    <input type="text" class="form-control" id="application-id" name="application-id" value="<?php echo $applicationID; ?>" readonly>
</div>

<!-- User ID -->
<div class="mb-3">
    <label for="user-id" class="form-label">User ID:</label>
    <input type="text" class="form-control" id="user-id" name="user-id" value="<?php echo $userID; ?>" readonly>
</div>

<!-- Buyer Full Name -->
<div class="mb-3">
    <label for="name" class="form-label">Buyer Full Name:</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $buyerName; ?>" readonly>
</div>

<!-- Buyer Phone Number -->
<div class="mb-3">
    <label for="phone-number" class="form-label">Buyer Phone Number:</label>
    <input type="tel" class="form-control" id="phone-number" name="phone-number" value="<?php echo $buyerPhoneNumber; ?>" readonly>
</div>

<!-- Application Date -->
<div class="mb-3">
    <label for="application-date" class="form-label">Application Date:</label>
    <input type="date" class="form-control" id="application-date" name="application-date" value="<?php echo $applicationDate; ?>" readonly>
</div>

<!-- Address -->
<div class="mb-3">
    <label for="address" class="form-label">Address:</label>
    <input type="text" class="form-control" id="address" name="address" value="<?php echo $buyerAddress; ?>" readonly>
</div>

<!-- Buyer Email -->
<div class="mb-3">
    <label for="email" class="form-label">Buyer Email:</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo $buyerEmail; ?>" readonly>
</div>

<!-- Buyer National ID -->
<div class="mb-3">
    <label for="national-id" class="form-label">National ID:</label>
    <input type="text" class="form-control" id="national-id" name="national-id" value="<?php echo $buyerNationalID; ?>" readonly>
</div>
<!-- Seller Full Name -->
<div class="mb-3">
    <label for="seller-name" class="form-label">Seller Name:</label>
    <input type="text" class="form-control" id="seller-name" name="seller-name" value="<?php echo $sellerName; ?>" readonly>
</div>

<!-- Seller Email -->
<div class="mb-3">
    <label for= "seller-email" class="form-label">Seller Email:</label>
    <input type="email" class="form-control" id="seller-email" name="seller-email" value="<?php echo $sellerEmail; ?>" readonly>
</div>

<!-- Seller National ID -->
<div class="mb-3">
    <label for="seller-national-id" class="form-label">Seller National ID:</label>
    <input type="text" class="form-control" id="seller-national-id" name="seller-national-id" value="<?php echo $sellerNationalID; ?>" readonly>
</div>

<!-- Seller Phone Number -->
<div class="mb-3">
    <label for="seller-phone-number" class="form-label">Seller Phone Number:</label>
    <input type="tel" class="form-control" id="seller-phone-number" name="seller-phone-number" value="<?php echo $sellerPhoneNumber; ?>" readonly>
</div>

<!-- Unit Address -->
<div class="mb-3">
    <label for="unit-address" class="form-label">Unit Address:</label>
    <input type="text" class="form-control" id="unit-address" name="unit-address" value="<?php echo $unitAddress; ?>" readonly>
</div>

<!-- Unit Total Area -->
<div class="mb-3">
    <label for="unit-total-area" class="form-label">Unit Total Area:</label>
    <input type="number" class="form-control" id="unit-total-area" name="unit-total-area" value="<?php echo $unitTotalArea; ?>" readonly>
</div>

<!-- Type Of Unit -->
<div class="mb-3">
    <label for="type-of-unit" class="form-label">Type Of Unit:</label>
    <input type="text" class="form-control" id="type-of-unit" name="type-of-unit" value="<?php echo $typeOfUnit; ?>" readonly>
</div>

<!-- Price -->
<div class="mb-3">
    <label for="price" class="form-label">Price:</label>
    <input type="number" class="form-control" id="price" name="price" value="<?php echo $price; ?>" readonly>
</div>

<!-- Ownership Contract -->
<div class="mb-3">
    <label for="ownership-contract" class="form-label">Ownership Contract:</label>
    <input type="text" class="form-control" id="ownership-contract" name="ownership-contract" value="<?php echo $ownershipContract; ?>" readonly>
</div>

<!-- Document Upload (PDF) -->
<div class="mb-3">
    <label for="document-file" class="form-label">Upload Documents (PDF):</label>
    <?php

        $DocumentFile = $row['DocumentFile'];

        if (!empty($DocumentFile)) {
            echo "<a href=\"download.php?applicationID=$applicationID\" target=\"_blank\">View Document</a>";
        } else {
            echo "No document available";
        }
    ?>
</div>

<!-- Ownership Year -->
<div class="mb-3">
    <label for="ownership-year" class="form-label">Ownership Year:</label>
    <input type="text" class="form-control" id="ownership-year" name="ownership-year" value="<?php echo $ownershipYear; ?>" readonly>
</div>

<!-- Notary Public -->
<div class="mb-3">
    <label for="notary-public" class="form-label">Notary Public:</label>
    <input type="text" class="form-control" id="notary-public" name="notary-public" value="<?php echo $notaryPublic; ?>" readonly>
</div>
<div class="mb-3">
    <button type="button" class="btn btn-primary" onclick="window.location.href='index2.php'">Back to Menu</button>
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['Name']) ? $_POST['Name'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : "";
    $whichOffice = isset($_POST['whichOffice']) ? $_POST['whichOffice'] : "";
    $message = isset($_POST['Message']) ? $_POST['Message'] : "";

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "realestateregistration";
    $link = new mysqli($host, $username, $password, $dbname);

    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }

    $insertQuery = "INSERT INTO customerinquiries (Name, Email, PhoneNumber, WhichOffice, Message) VALUES ('$name', '$email', '$phoneNumber', '$whichOffice', '$message')";

    if ($link->query($insertQuery) === TRUE) {
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }

    $link->close();
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
</head>

<body>
    <div class="container-xxl bg-white p-0">

        
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
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="service.php" class="nav-item nav-link">Service</a>
                    </div>
                    <a href="Login.php" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Sign in or Sign up </a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-primary hero-header">
                <div class="container my-5 py-5 px-lg-5">
                    <div class="row g-5 py-5">
                        <div class="col-12 text-center">
                            <h1 class="text-white animated slideInDown">Contact</h1>
                            <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


                <!-- Contact Start -->
                <form method="post" action="contact.php">
    <div class="container-xxl py-5">
        <div class="container py-5 px-lg-5">
            <div class="wow fadeInUp" data-wow-delay="0.1s">
                <p class="section-title text-secondary justify-content-center"><span></span>Contact Us<span></span></p>
                <h1 class="text-center mb-5">Contact For Any Query</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="wow fadeInUp" data-wow-delay="0.3s">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" name="Name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" name="phoneNumber" placeholder="Subject">
                                        <label for="subject">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="subject">Which Office</label>
                                    <div class="form-floating">
                                        <select class="form-select" id="subject" name="whichOffice">
                                            <option value="Unit Inspection">Unit Inspection</option>
                                            <option value="Notary Public">Notary Public</option>
                                            <option value="Both of Them">Both of Them</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="Message" name="Message" style="height: 150px"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
                <!-- Contact End -->
                
        
                <!-- Footer Start -->
                <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s">
                    <div class="container py-5 px-lg-5">
                        <div class="row g-5">
                            <div class="col-md-6 col-lg-3">
                                <p class="section-title text-white h5 mb-4">Address<span></span></p>
                                <p><i class="fa fa-map-marker-alt me-3"></i>Street 9, Al Abageyah, Cairo Governorate 4412131, Egypt</p>
                                <p><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                                <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <p class="section-title text-white h5 mb-4">Quick Link<span></span></p>
                                <a class="btn btn-link" href="about.php">About Us</a>
                                <a class="btn btn-link" href="contact.php">Contact Us</a>
                            </div>
                        
                </div>
                <!-- Footer End -->
                <!-- Back to Top Start -->
                <a class="btn btn-lg btn-secondary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
            </div>
        <!-- Back to Top End -->
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
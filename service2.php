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
                        <a href="index2.php" class="nav-item nav-link active">Home</a>
                        <a href="about2.php" class="nav-item nav-link">About</a>
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
            </nav>


            <div class="container-xxl py-5 bg-primary hero-header">
                <div class="container my-5 py-5 px-lg-5">
                    <div class="row g-5 py-5">
                        <div class="col-12 text-center">
                            <h1 class="text-white animated slideInDown">Service</h1>
                            <hr class="bg-white mx-auto mt-0" style="width: 90px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->


        <!-- Service Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <p class="section-title text-secondary justify-content-center"><span></span>Our Services<span></span></p>
                    <h1 class="text-center mb-5">What Solutions We Provide</h1>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.1s">
                    <p class="mb-4">At RERA, we offer a comprehensive range of services to assist you with all your real estate registration needs. Our dedicated team of professionals is committed to ensuring that your property transactions are handled efficiently, accurately, and transparently. Explore our services below:</p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fa fa-search fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Property Registration</h5>
                            <p class="m-0">Our core service, property registration, is designed to simplify the process of transferring property ownership. We handle all the necessary documentation, ensuring that your property is legally registered and protected. Our expertise in property registration guarantees a hassle-free experience for buyers and sellers alike.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fa fa-laptop-code fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Property information/ Inspection's</h5>
                            <p class="m-0">Looking to verify property ownership or gather information about a specific property? Our property search service allows you to access accurate and up-to-date property records. Whether you're a potential buyer or an existing property owner, we can provide you with the information you need.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fab fa-facebook-f fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Record Keeping</h5>
                            <p class="m-0">Property transactions involve a significant amount of paperwork. Our record-keeping service ensures that all property-related documents are properly maintained and organized. We offer secure storage and easy retrieval of your important records, giving you peace of mind.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fa fa-mail-bulk fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Title Transfer Assistance</h5>
                            <p class="m-0">If you're in the process of buying or selling a property, our Real Estate Registration service can simplify the legal aspects of the transaction. We guide you through the title transfer process, ensuring that all legal requirements are met.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="service-item d-flex flex-column text-center rounded">
                            <div class="service-icon flex-shrink-0">
                                <i class="fa fa-thumbs-up fa-2x"></i>
                            </div>
                            <h5 class="mb-3">Consultation Services</h5>
                            <p class="m-0">Have questions or need guidance regarding real estate registration? Our consultation services provide you with access to our experienced professionals. We're here to answer your queries and provide expert advice tailored to your specific needs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->


        <!-- Contact Start -->
        <div class="container-xxl bg-primary newsletter py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center">
                        <p class="section-title text-white justify-content-center"><span></span>Contact<span></span></p>
                        <h1 class="text-center text-white mb-4">Stay Always In Touch</h1>
                        <p class="text-white mb-4">Contact us to learn more about our services and how we can assist you with your real estate registration requirements. We look forward to serving you.</p>                        
                            <a href="contact.php" class="btn rounded-pill py-2 px-9 ms-1 d-none d-sm-block" style="background-color: rgb(255, 187, 0);">Contact</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Newsletter End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
                <h1 class="text-center mb-5">Why Choose Us for Your Real Estate Registration Needs?</h1>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"></i>Our team has extensive experience in real estate registration, ensuring that your transactions are handled with precision.</p>
                        <div class="d-flex align-items-center">
                            <div class="ps-4">
                                <h5 class="mb-1">Expertise</h5>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"></i>We prioritize transparency throughout the registration process, providing you with clear and accurate information.</p>
                        <div class="d-flex align-items-center">
                            <div class="ps-4">
                                <h5 class="mb-1">Transparency</h5>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"></i>We understand the importance of time in real estate transactions. Our efficient processes save you time and effort.</p>
                        <div class="d-flex align-items-center">
                            <div class="ps-4">
                                <h5 class="mb-1">Efficiency</h5>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded my-4">
                        <p class="fs-5"></i>Your satisfaction is our top priority, and we're here to assist you every step of the way.
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="ps-4">
                                <h5 class="mb-1">Customer Centricity</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->

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
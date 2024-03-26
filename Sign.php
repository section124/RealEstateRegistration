<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register Account Page</title>
    <link href="css/STYLEEE.css" rel="stylesheet">
</head>

<body>
    <body class="align">
        <section class='login' id='login'>
            <div class='head'>
                <h1 class='company'>Registration Form</h1>
            </div>
            <p class='msg'>Welcome to Egyptian Real Estate Registration</p>
            <div class='form'>
                <form name="Register" action="SignVerify.php" method="POST">
                <input type="text" placeholder='Buyer Full Name' class='text' name="Fullname" required><br>
                <input type="date" placeholder='Date Of Birth' class='text' name="DateOfBirth" required><br>
                <input type="text" placeholder='National ID' class='text' name="NationalID" required><br>
                <input type="text" placeholder='Address' class='text' name="Address" required><br>
                <input type="number" placeholder='Phone Number' class='number' name="PhoneNumber" required><br>
                <input type="text" placeholder='Email' class='text' name="Email" required><br>
                <input type="password" placeholder='Password' class='password' name="Password" required><br>
                    <center>
                        <input type="submit" value="Enter" class='btn-login'>
                        <input type="button" value="Cancel"  class='btn-login' onclick="history.back()">
                    </center>
                </form>
            </div>
        </section>
    </body>

</html>

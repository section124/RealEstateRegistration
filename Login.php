
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link href="css/STYLEEE.css" rel="stylesheet">
</head>
<body>
<body class="align">
<section class='login' id='login'>
  <div class='head'>
  <h1 class='company'>Log In Page</h1>
  </div>
  <p class='msg'>Welcome to Egyptian Real Estate Registration</p>
  <div class='form'>
  <form name = "Login" action="login.php" method="POST" >
<input type="text" placeholder='Full Name' class='text' name="Fullname" required><br>
<input type="password" placeholder='Password' class='password' name="Password" required><br>
<center>
<button type="submit" class='btn-login' id='do-login'>Login</button>
  <p>
  <p>Not a member? <a href="Sign.php">Sign up now</a>
  <p>
  <p>

  <?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['Fullname'];
    $userPwd = $_POST['Password'];


    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "realestateregistration"; 

    $link = new mysqli($host, $username, $password, $dbname);

    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    } else {
        $queryCheck = "SELECT * FROM registration WHERE BuyerFullName = '" . $userName . "'";
        $resultCheck = $link->query($queryCheck);

        if ($resultCheck->num_rows == 0) {
            echo "The entered user name is not registered";
        } else {
            $row = $resultCheck->fetch_assoc();
            if ($row["BuyerPassword"] == $userPwd) {
                $_SESSION["BuyerUserID"] = $row["BuyerUserID"];
                $_SESSION["Fullname"] = $userName;
                $_SESSION["UserType"] = $row["UserType"];

if ($row["UserType"] == "Notary Public") {
    header("Location: index(NP-A).php");
    exit();
} elseif ($row["UserType"] == "Unit Inspection") {
    header("Location: index(UI-A).php");
    exit();
} else {
    header("Location: index2.php"); 
    exit();
}
} else {
  echo "Wrong Password or Name ! <br><br>";
  echo "Click <a href='Login.php'> here </a> to login again ";
}
}
}

$link->close();
}
?>
</center>    
</form>
  </div>
</section>
</body>

</html>



  
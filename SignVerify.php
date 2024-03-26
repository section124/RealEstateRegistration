<?php 
$username=$_POST["Fullname"];
$DateOfBirth =$_POST["DateOfBirth"];
$NationalID =$_POST["NationalID"];
$Address =$_POST["Address"];
$PhoneNumber =$_POST["PhoneNumber"];
$Email =$_POST["Email"];
$Password =$_POST["Password"];

$host = "localhost" ; 
$user = "root" ;
$pass = "";
$db = "realestateregistration";

 
$conn = new mysqli ( $host , $user , $pass , $db );

if ($conn->connect_error) {
    die("Connection failed: " . $link->connect_error);}
else 
{
$queryInsert =" Insert into registration (BuyerFullName , DateOfBirth ,
BuyerNationalID , BuyerAddressee , BuyerPhoneNumber	 , BuyerEmail , BuyerPassword)
Values('".$username."','".$DateOfBirth."' , '".$NationalID."' ,
'".$Address."' , '".$PhoneNumber."' ,'".$Email."', '".$Password."')"; 



if($conn -> query ($queryInsert) === TRUE) {
} else {
	echo "<p style='color:red;'> failed to insert ".$conn -> error. "</p>" ;
}
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Confirmation</title>
    <link href="css/STYLEEE.css" rel="stylesheet">
</head>

<body>
    <body class="align">
        <section class='login' id='login'>
            <div class='head'>
                <h1 class='company'>Registration Confirmation</h1>
            </div>
            <p class='msg'>Welcome to Egyptian Real Estate Registration</p>
            <div class='form'>
                <h1> User Details </h1>
<table>
<tr> 
 <td style= "color:white"> Buyer Full Name : </td>
 <td> <?php echo $username;?> </td>
 </tr>
  <tr> 
 <td style= "color:white"> Date Of Birth : </td>
 <td> <?php echo $DateOfBirth;?> </td>
 </tr>
 <tr> 
 <td style= "color:white"> National ID : </td>
 <td> <?php echo $NationalID;?> </td>
 </tr>
 <tr> 
 <td style= "color:white"> Address :  </td>
 <td> <?php echo $Address;?> </td>
 </tr>
 <tr> 
 <td style= "color:white"> Phone Number : </td>
 <td>  <?php echo $PhoneNumber;?> </td>
 </tr>
  <tr> 
 <td style= "color:white"> Email : </td>
 <td>  <?php echo $Email;?> </td>
 </tr>
 <tr> 
 <td style= "color:white"> Password :</td>
 <td> <?php echo $Password;?> </td>
 </tr>
</table>
<center>
Click to Login button to go login page 
<p>
<button type="button" onclick="redirectToLogin()" class='btn-login' id='do-login'>Login</button>
</Center>
<script>
            function redirectToLogin() {
                window.location.href = 'Login.php';
            }
        </script>
</body>

</html>
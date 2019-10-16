<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="register.css">
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="checkPasswordsMatch.js"></script>
    <title>Home</title>
</head>
<!-- <img src="https://img.icons8.com/doodle/48/000000/address-book.png"> -Use this for icon of address book -->

<body>
    <nav class='navbar navbar-expand-lg navbar-light bg-light'>
        <a class='navbar-brand logo' href='#'><img src="https://img.icons8.com/color/48/000000/login-as-user.png"> alter-EGO </a>
        <form class='mx-2 my-auto mx-auto search-bar d-inline w-30' method='POST' action='login.php'>
            <div class='input-group'>
                <input class=' form-control mr-sm-2' id='loginUsername' name='username' type='username' placeholder='Username' aria-label='Search'>
                <input class=' form-control mr-sm-2' id='loginPassword' name='password' type='password' placeholder='Password' aria-label='Search'>
                <span class='input-group-append'>
                  <input class='btn btn-outline-success' name='submitButton' type='submit'>
                  </span>
            </div>
        </form>
    </nav>
    <div class = "dataInfo">
    <?php
    include 'post.php';
    include 'emailUser.php';
    if(isset($_POST['submitButton'])){
      //Declare variables and convert data to lowercase except for password and phone
        $userName =  strtolower($_POST['username']);
        $password = $_POST['password'];
        $email = strtolower($_POST['email']);
        $phone =  ($_POST['phone']);

        //Create a mySQLI object written as OpenCon()
        $connection=OpenCon();

        //Prepare statements for SQL use:
        $userName = $connection->real_escape_string($userName);
        $password = $connection->real_escape_string($password);
        $email = $connection->real_escape_string($email);
        $phone =  $connection->real_escape_string($phone);

        //Hash the password for security
        $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
        //Insert records into the database from the user entered fields
        $insert = "INSERT INTO users(`id`,`username`,`password`,`email`,`phone`)
                VALUES('','$userName','$hashedPassword','$email','$phone')";

        //Check for matching username
        $query = "SELECT username FROM users WHERE username='$userName'";
        $emailQuery = "SELECT email FROM users WHERE email='$email'";
        //Check if user exists
        if($userCheck = $connection->query($query)){
          if($emailCheck = $connection->query($emailQuery)){
            if(mysqli_num_rows($emailCheck)>=1){
              echo"<h1 align = 'Center'>$email already has an account</h1>
              <p align = 'Center'><img src='https://img.icons8.com/clouds/200/000000/delete-database.png'>";
            }
            else{
              if(mysqli_num_rows($userCheck)>= 1){
                echo"
                <h1 align = 'Center'>$userName Already Exists</h1>
                <p align = 'Center'><img src='https://img.icons8.com/clouds/200/000000/delete-database.png'>";
              }
              else{
                //Update database with user information
                if($request = $connection->query($insert)){
                  emailUser($email,$userName);
                  echo"<p align = 'Center'><img src='https://img.icons8.com/bubbles/200/000000/database.png'></p><br>";
                }
              }
            }
          }

        }
        else{
          echo"
          <h1 align = 'Center'>ERROR CONNECTING - Contact Administrator - 950doenut.buff@gmail.com</h1>
          <p align = 'Center'><img src='https://img.icons8.com/clouds/200/000000/delete-database.png'>";
        }
        CloseCon($connection);
    }
?>
    </div>
    <h1 align="Center">Sign-up</h1>
    <div class="container" align="Center">
        <div>
            <form action="home.php" method="post">
                <label for="username">Username:</label>
                <input id="username" name="username" type="username" placeholder="Username" class="inputGroup" title="Make sure username is less than 25 characters long and no less than 6 characters 
            and Please refrain from using these characters['%', '^', '*', '_', '|']" pattern="[a-zA-Z0-9!@#$]{6,25}" required><br>

                <label for="password">Password:</label>
                <input id="password" name="password" type="password" placeholder="Password" class="inputGroup" onkeyup="check();" title="Make sure password is less than 25 characters long and no less than 6 characters 
            and Please refrain from using these characters['%', '^', '*', '_', '|']" pattern="[a-zA-Z0-9!@#$]{6,25}" required><br>

                <label for="ConfirmPassword">Confirm Password:</label>
                <input id="ConfirmPassword" name="ConfirmPassword" type="password" placeholder="Confirm Password" class="inputGroup" onkeyup="check();" required><br>
                <span id="message" hidden></span><br>
                <label for="email">Email:</label>
                <input id="email" name="email" type="email" placeholder="johnDoe@email.com" class="inputGroup" title="Please enter a valid email: [johnDoe@gmail.com]" required><br>

                <label for="phone">Phone:</label>
                <input id="phone" name="phone" type="tel" placeholder="5555555555" class="inputGroup" pattern="[0-9]{10}" title="Please enter a valid 10 digit phone number: 1234567891" required><br>

                <input id="submitButton" type="submit" name="submitButton" class="inputGroup">
            </form>
        </div>
</body>

</html>

<?php
  require "login.php";
  require "message.php";
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset='UTF-8'>
        <title>Main</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>
        <link rel='stylesheet' href='register.css'>
    </head>

    <body>
        <?php
          if(!isset($_SESSION['loginUsername'])){
            echo"<h1 align = 'Center'>You have not logged in.</h1>";
            echo"<h2 align = 'Center'>Check your username or password";
          }
          else{
            $username = $_SESSION['loginUsername'];
            echo"
            <nav class='navbar navbar-expand-lg navbar-light bg-light'>
            <div class='navbar-brand dropdown'>
              <a class = 'dropdown-toggle' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                $username
              </a>
              <div class='dropdown-menu dropdown-menu-left' aria-labelledby='navbarDropdown'>
                  <a class='dropdown-item' href='endSession.php'>Logout</a>
                  <a class='dropdown-item' href='#'>Account</a>
              </div>
            </div>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
              <span class='navbar-toggler-icon'></span>
            </button>
          
            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
              <ul class='navbar-nav mr-auto'>
                <li class='nav-item active'>
                  <a class='nav-link' href='#'>Coming Soon <span class='sr-only'>(current)</span></a>
                </li>
              </ul>
              <form class='mx-2 my-auto mx-auto search-bar d-inline w-50'>
                <div class = 'input-group'>
                    <input class=' form-control mr-sm-2' type='text' placeholder='Search Contacts' aria-label='Search'>
                    <span class='input-group-append'>
                      <button class='btn btn-outline-success' type='submit'>GO</button>
                    </span>
                </div>
              </form>
            </div>
          </nav>
          <div class = 'mainContainer'>
            <div class = 'contactContainer'>
              Contacts
            </div>
            <div class = 'messageContainer'>";
              getMessages($username);
      echo"  </div>
          </div>
          ";
          }
          ?>

    </body>

    </html>
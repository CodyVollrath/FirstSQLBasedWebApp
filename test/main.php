<?php
  require "login.php";
  require "message.php";
  require_once "contact.php";
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
      <!-- MODAL POPUP -->
      <div class="modal fade" id="windowModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header text-center">
              <h4 class="modal-title w-100 font-weight-bold">Add Contact</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <div class="modal-body mx-3">
            <div class="md-form mb-5">
              <i class="fas fa-envelope prefix grey-text"></i>
                <label for="contactName">Name Of Contact</label>
                <input type="username" name ='contactname' onkeyup="checkInDB()" list='users' id='contactName'placeholder='Enter a user'>
                <textarea name = 'messageArea' class='form-control' placeholder = 'Message' id = 'messagearea' rows = '3'></textarea>
                <button type ='button' onclick="sendNewMessageJS();" id ='sendRequest' class = '' name = 'sendRequest'>Send</button>
              
              <script>
                  document.getElementById('sendRequest').disabled = true;
              </script>
            </div>
          </div>
            <div class="modal-footer d-flex justify-content-center">
            </div>
          </div>
        </div>
      </div>
      <!-- END MODAL POPUP -->
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
              <div class = 'addContact'>
                <button class = 'addButton' name ='addContact' data-toggle='modal' data-target='#windowModal'>
                  <a><img src='https://img.icons8.com/bubbles/110/000000/add.png'>
                    Add Contact
                  </a>
                </button>
                <datalist id='users'>

                </datalist>
              </div>";
              echo getContacts($username);
            echo"</div>
            <div class = 'messageContainer'>";
            displayMessages($username);
           echo" <div id = 'textBar'>
            <input id = 'messageTextBar' placeholder='Message' name = 'messageInput' type='text'>
            <button id = 'send' name='sendButton'>SEND</button>
          </div>";
      echo"  </div>
          </div>
          ";
          }
          ?>
          <?php
            function getContacts($username){
              $conn = openCon();
              $contactQuery = "SELECT `contact` FROM messages WHERE `username` = '$username'";
              if($requestContacts = $conn->query($contactQuery)){
                if(mysqli_num_rows($requestContacts)>=1){
                  $contactsArray =array();
                  while($contactData = $requestContacts->fetch_assoc()){
                    $contactsArray[] = $contactData['contact'];
                  }
                  $unquieContacts[] = array_unique($contactsArray);
                  foreach($unquieContacts as $contact){
                   echo implode(" ",$contact), "<br>";
                  }
                }
              }
            }
          ?>
         
          <script>
            function checkInDB(){
              var contactName = document.getElementById("contactName").value;
              //Send This Username to another file contact.php
              $.post('contact.php',
              {
                contactname: contactName
              },
              //Receive this data from contact.php
              function(data,status){
                console.log(data);
                if(data.includes('Not a user')){
                    document.getElementById('sendRequest').disabled = true;
                }
                else{
                  document.getElementById('sendRequest').disabled = false;
                }
              }
              );
            }
            function getContactName(){
              var contactName = document.getElementById("contactName").value;
              return contactName
            }
            function sendNewMessageJS(){
              var contactName = document.getElementById("contactName").value;
              var message = document.getElementById("messagearea").value;
              var sendRequest = document.getElementById("sendRequest").value;
              $.post('sendNewMessage.php',
              {
                contactname:contactName,
                messagearea:message,
                sendRequest:sendRequest
              },
              function(data,status){
                console.log(data);
                location.reload();
              });
            }
          </script>
          <script src='https://code.jquery.com/jquery-3.3.1.min.js'></script>
          <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js' integrity='sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q' crossorigin='anonymous'></script>
          <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js' integrity='sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl' crossorigin='anonymous'></script>
    </body>

    </html>
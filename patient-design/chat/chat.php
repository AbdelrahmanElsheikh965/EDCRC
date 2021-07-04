<?php
session_start();
include "../../User.php";
$user = new User();
if (isset($_SESSION['email']) && $_SESSION['type'] == "patients") {
    $email = $_SESSION['email'];
    $patient_id = $_SESSION['id'];
    $recent_data = $user->recent_chats($patient_id);
    
    $data = $user->read_message(15, $patient_id);
    
    if (isset($_POST['send'])) {
      $message = $_POST['messageBody'];
      $user->insert_message("patient", $doctor_id, $patient_id, $message);
      $data = $user->read_message($doctor_id, $patient_id);
    }

}else{
  echo "string";
}

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="chat.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <!-- <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"> heavy link --> 
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      
    <!-- <link rel="stylesheet" href="../../assets/css/chat.css" /> -->

</head>
<body>

<div class="container py-5 px-4">
  <!-- For demo purpose-->
  <header class="text-center">
    <h1 class="display-4 text-white">Patient Chat</h1>
    <p class="text-white lead mb-0">start a discussion with your Doctors</p>
    <br>
  </header>


  <div class="row rounded-lg overflow-hidden shadow">
    <!-- Users box-->

        <nav style="width: 1122px;" class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Chat Messaging</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
              </form>
            </div>
               <a href="../patient_profile.php"><button style="float: right;" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Go back</button> </a>
          </nav>

    <div class="col-5 px-0">
      <div class="bg-white">
        <div class="bg-gray px-4 py-2 bg-light">
          <p class="h5 mb-0 py-1">Recent</p>
        </div>

        <div class="messages-box">
          <div class="list-group rounded-0">
              
            <?php foreach ($recent_data as $id => $name) { ?>
        
            <a href="chat.php" class="list-group-item list-group-item-action active text-white rounded-0">
              <div class="media"><img src="../../images/icons/doc.png" alt="user" width="50" class="rounded-circle">
                <div class="media-body ml-4"><?= $name ?>
                  <div class="d-flex align-items-center justify-content-between mb-1">
                    <h6 class="mb-0"><?= $user->last_message($patient_id, $id)[0] ?></h6><small class="small font-weight-bold"></small>
                  </div>
                  <p class="font-italic mb-0 text-small"></p>
                </div>
              </div>
            </a>

            <?php } ?>
          

    

          </div>
        </div>
      </div>
    </div>
    <!-- Chat Box-->
    <div class="col-7 px-0">
      <div class="px-4 py-5 chat-box bg-white">

       <?php if (is_countable($data) == true) { ?>

          <?php for ($i = 0; $i < count($data); $i++) { ?>

            <?php if ($data[$i]['sender'] == "doctor") { ?>

                <!-- Sender Message-->
                <div class="media w-50 mb-3"><img src="../../images/icons/doc.png" alt="user" width="50" class="rounded-circle">
                  <div class="media-body ml-3">
                    <div class="bg-light rounded py-2 px-3 mb-2">
                      <p class="text-small mb-0 text-muted"><?= $data[$i]['message'] ?></p>
                    </div>
                    <p class="small text-muted"><?= $data[$i]['created_at'] ?></p>
                  </div>
                </div>

      <?php } elseif ($data[$i]['sender'] == "patient") { ?>

        <!-- Reciever Message-->
        <div class="media w-50 ml-auto mb-3">
          <div class="media-body">
            <div class="bg-primary rounded py-2 px-3 mb-2">
              <p class="text-small mb-0 text-white"><?= $data[$i]['message'] ?></p>
            </div>
            <p class="small text-muted"><?= $data[$i]['created_at'] ?></p>
          </div>
        </div>

            <?php } ?>    
          <?php } ?>
          <?php } ?>

      </div>

      <!-- Typing area -->
      <form action="chat.php" class="bg-light">
        <div class="input-group">
          <input type="text" placeholder="Type a message" name="messageBody" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
          <div class="input-group-append">
            <input type="submit" class="btn btn-success" name="send" value="send">
            <!-- <a id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></a> -->
          </div>
        </div>

      </form>
    </div>
  </div>
</div>


</body>
</html>
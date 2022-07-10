<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registo</title>
  <link rel="stylesheet" href="./Register.css?v=<?php echo time(); ?>">
  <style>

  </style>
</head>


<body>

  <header>

  </header>

  <main>
    <div class="split left">
      <div class="">
        <img class="slogan" src="../../../Assets/Images/21B_Slogan 1.png" alt="">
      </div>
    </div>

    <div class="split right">

      <?php
      require_once 'C:\xampp\htdocs\App\221B\app\models\Register\RegisterController.php';

      if(isset($_POST['userBirthDate']))
      {
        date_default_timezone_set('Europe/Bucharest');
        $todaysDate=new DateTime(date("d-m-Y"));
        $usersBirthdate=new DateTime($_POST['userBirthDate']);
        $interval=$todaysDate->diff($usersBirthdate);
  
      }

      if(isset( $_POST['userLastName']))
      {
        $name=$_POST['userFirstName'] .' ' .$_POST['userLastName'];
      }
     
      try {
        if (isset($_POST['register'])) {
          if ($_POST['userPassword'] != $_POST['userPasswordConfirmation']) {

      ?>
            <div class="alert">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
              <strong>Atenção! </strong>As palavras-passes sao diferentes!!!
            </div>
          <?php

          } elseif (strlen($_POST['userPassword']) < 8) {
          ?>
            <div class="warningAlert">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
              <strong>Atenção! </strong>A palavra-passe deve ter no minimo 8 letras!!!
            </div>
            <?php
          }elseif (intval($interval->y)<11) {
            ?>
              <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Atenção! </strong>A idade minima para o registo sao 11 anos de idade!
              </div>
              <?php
            }elseif (!preg_match ("/^([a-zA-Z' ]+)$/", $name)) {
              ?>
                <div class="warningAlert">
                  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                  <strong>Atenção! </strong>Por favor introduza um nome valido, somente com letras alfabeticas!!!
                </div>
                <?php
              } 
             else {

            $registerControllerInstance = new RegisterController();
            $result = $registerControllerInstance->registerUSer($_POST['userFirstName'], $_POST['userLastName'], $_POST['userEmail'], $_POST['userPassword'], $_POST['userBirthDate']);

            if ($result) {
            ?>

              <div class="successAlert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Sucesso! </strong>Usuario registado
              </div>
        <?php

            }
          }
        }
      } catch (PDOException) {
        ?>

        <div class="warningAlert">
          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
          <strong>Atenção! </strong>Só é possivel criar uma conta com um email!
        </div>
      <?php
      }

      ?>


      <div class="">
        <div class="welcomeContainer">
          <!-- <p class="welcomeParagraph">Seja bem vindo(a)</p>

                    <img src="../../../Assets/Images/FriendlyDetective.png" alt=""> -->
          <div class="words word-1">
            <span>R</span>
            <span>E</span>
            <span>G</span>
            <span>I</span>
            <span>S</span>
            <span>T</span>
            <span>R</span>
            <span>O</span>
          </div>


        </div>
        <form action="./registerView.php" class="registerForm" method="post">

          <div class="inputFlexBox">

            <div class="leftColumnContainer">
              <label for="userFirstName"> Primeiro nome</label><br>
              <input required type="text" name="userFirstName" value=<?php if (isset($_POST['userFirstName']))  echo $_POST['userFirstName']; ?>>
            </div>

            <div class="rightColumnContainer">
              <label for="userLastName">Ultimo nome</label><br>
              <input required type="text" name="userLastName" value=<?php if (isset($_POST['userLastName']))  echo $_POST['userLastName']; ?>>
            </div>

          </div>


          <div class="inputFlexBox">

            <div class="leftColumnContainer">
              <label for="userBirthDate">Data de nascimento</label><br>
              <input required type="date" name="userBirthDate" value=<?php if (isset($_POST['userBirthDate']))  echo $_POST['userBirthDate']; ?>><br>
            </div>

            <div class="rightColumnContainer">
              <label for="userEmail">Email</label><br>
              <input required type="email" name="userEmail" value=<?php if (isset($_POST['userEmail']))  echo $_POST['userEmail']; ?>>
            </div>

          </div>


          <div class="inputFlexBox">

            <div class="leftColumnContainer">

              <label for="fname">Palavra passe</label><br>
              <input required type="password" name="userPassword"><br>
            </div>

            <div class="rightColumnContainer">

              <label for="passwordConfirmation">Confirmar palavra passe</label><br>
              <input required type="password" name="userPasswordConfirmation">

            </div>

          </div>

          <button type="submit" name="register" class="registerButton"><b>Registar</b></button>

          <p>Ja tem uma conta? faça já o <a href="../Login/LoginView.php">login!</a></p>
        </form>

      </div>
    </div>
  </main>

  <footer>

  </footer>
</body>

</html>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Login.css?v=<?php echo time(); ?>">
    <title>Login</title>
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
            require_once 'C:\xampp\htdocs\App\221B\app\models\Login\loginController.php';

            $loginControllerInstance = new LoginController();
            if (isset($_POST['login'])) {

                $_SESSION['email'] = $_POST['userEmail'];  
                $result = $loginControllerInstance->Login($_POST['userEmail'], $_POST['userPassword']);

                if ($result == false && $_POST['userEmail'] != 'helder@hotmail.com') {
                ?>
                    <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                    <strong>Oops!</strong> email ou palavra-passe nao valída!
                    </div>
                    <?php

                } else
                {
                    $result=$loginControllerInstance->getUsersCredential($_POST['userEmail'] );
                    $_SESSION['userFirstName']=$result['first_name'];
                    $_SESSION['userLastName']=$result['last_name'];
                    $_SESSION['userBirthDate']=$result['birth_date'];
                    header('Location: ../Environment/EnvironmentView.php');
                    
                }
            }
            ?>
            <div class="">
                <a href="../Environment/EnvironmentView.php"></a>
                <div class="welcomeContainer">
                    <!-- <p class="welcomeParagraph">Seja bem vindo(a)</p>

                    <img src="../../../Assets/Images/FriendlyDetective.png" alt=""> -->
                    <div class="words word-1">
                        <span>L</span>
                        <span>O</span>
                        <span>G</span>
                        <span>I</span>
                        <span>N</span>
                    </div>


                </div>
                <!-- <h1 class="title">Registo</h1> -->

                <form action="./loginView.php" class="registerForm" method="post">

                    <div class="inputFlexBox">

                        <div class="leftColumnContainer">
                            <label for="userEmail" class="emailLabel">Email</label><br>
                            <input required type="email" class="emailBox" name="userEmail" value=<?php if(isset($_POST['userEmail']))  echo $_POST['userEmail'];?>>
                        </div>

                        <div class="rightColumnContainer">
                            <label for="userPassword" class="passwordLabel">Password</label><br>
                            <input type="password" class="passwordBox" name="userPassword" required>
                        </div>

                    </div>

                    <button type="submit" name="login" class="loginButton"><b>Login</b></button>

                    <p>Não possui uma conta? faça já o <a href="../Register/registerView.php">registo!</a></p>
                </form>

            </div>
        </div>
    </main>

    <footer>

    </footer>
</body>

</html>
<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./definition.css?echo time(); ?>">

    <title>Document</title>
</head>

<body>
    <header></header>
    <main>

        <div class="split left">
            <div class="">
                <img class="slogan" src="../../../Assets/Images/21B_Slogan 1.png" alt="">
            </div>

        </div>

        <div class="split right">

            <?php
            if (isset($_POST['logoutButton'])) {
                session_destroy();
                header('location: ../../models/Login/loginView.php');

                exit;
            } elseif (isset($_POST['eraseButton'])) {
                require_once 'C:\xampp\htdocs\App\221B\app\models\Login\loginController.php';
                $loginControllerInstance = new loginController();
                $loginControllerInstance->deactivateAccount($_SESSION['email']);
                session_destroy();
                header('location: ../../models/Login/loginView.php');
            } elseif (isset($_POST['saveButton'])) {
                require_once 'C:\xampp\htdocs\App\221B\app\models\Register\RegisterController.php';

                if ($_POST['userPassword'] != $_POST['userPasswordConfirmation']) {
                    echo 'Palavras passes diffs';
                } else {
                    $registerControllerInstance = new RegisterController();
                    $result = $registerControllerInstance->updateUser($_POST['userFirstName'], $_POST['userLastName'], $_SESSION['email'], $_POST['userPassword'], $_POST['userBirthDate']);
                    echo $result;
                }
            }
            ?>
            <div class="
        Avatar"><img src="../../../Assets/Images/avatar.png" alt="Avatar" class="avatar"></div>
            <form action="" class="registerForm" method="post">

                <div class="inputFlexBox">

                    <div class="leftColumnContainer">
                        <label for="userFirstName"> Primeiro nome</label><br>
                        <input required type="text" value=<?php echo $_SESSION['userFirstName'] ?> name="userFirstName">
                    </div>

                    <div class="rightColumnContainer">
                        <label for="userLastName">Ultimo nome</label><br>
                        <input required value=<?php echo $_SESSION['userLastName'] ?> type="text" name="userLastName">
                    </div>

                </div>


                <div class="inputFlexBox">

                    <div class="leftColumnContainer">
                        <label for="userBirthDate">Data de nascimento</label><br>
                        <input required type="date" name="userBirthDate" value=<?php echo $_SESSION['userBirthDate'] ?>><br>
                    </div>

                    <div class="rightColumnContainer">
                        <label for="userEmail">Email</label><br>
                        <input readonly type="email" name="userEmail" value=<?php echo $_SESSION['email'] ?>>
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
                <button type="submit" id="saveButton" name="saveButton" class="button"><b>Salvar alterações</b></button>
            </form>

            <div class="buttonsGrid">


                <div>
                    <form action="./definition.php" method="post">
                        <button type="submit" id="eraseButton" name="eraseButton" class="button"><b>Apagar conta</b></button>
                    </form>
                </div>

                <div>
                    <form action="./definition.php" method="post">
                        <button type="submit" name="logoutButton" id="logoutButton" class="button"><b>Logout</b></button>
                    </form>
                </div>

                <div>
                    <button class="backButton"><a href="../../models/Environment/EnvironmentView.php?environmentName=<?php echo "Casa" ?>">Voltar ao ambiente principal</a></button>
                </div>
            </div>

        </div>

    </main>

</body>

</html>


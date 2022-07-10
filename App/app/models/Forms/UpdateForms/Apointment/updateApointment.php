<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./updateApointment.css?php echo time(); ?>">

    <title>Document</title>
</head>

<body>
    <header></header>
    <main>

        <div class="split left">
            <div class="">
                <img class="slogan" src="../../../../../Assets/Images/21B_Slogan 1.png" alt="">
            </div>
        </div>

        <div class="split right">
            <?php
            require_once 'C:\xampp\htdocs\App\221B\app\models\Apointment\ApointmentController.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $apointmentControllerInstance = new ApointmentController();

                $picture = null;

                $result = $apointmentControllerInstance->updateApointment($_SESSION['email'],  $_GET['compartmentId'], $_GET['apointmentId'],  $_POST['apointmenName'], $_POST['apointmenDescription'], $_POST['apointmenType'], $picture);

                echo $result;
            }

            ?>
            <div class="addApointmentForm">
                <div class="addApointmentFormHeader">

                </div>
                <form action="" method="post">

                    <p class="apointmentNameLabel">Nome do apontamento</p>
                    <input type="text" value="<?php echo $_GET['apointmenName'] ?>" name='apointmenName' class="formInput" required><br>

                    <p class="apointmentDescriptionLabel">Descrição do compartimento</p>
                    <input type="text" value="<?php echo $_GET['apointmenDescription'] ?>" class="formInput" name='apointmenDescription' required><br>

                    <p class="apointmentTypeLabel">Nome do tipo de apontamento</p>
                    <input type="text" value="<?php echo $_GET['apointmenType'] ?>" name='apointmenType' class="formInput" required><br>

                    <p class="apointmentImageLabel">Foto do apontamento</p>
                    <input type="file" name="img" class="apointmentPicture">

                    <button class="addApointmentButton">Atualizar apontamento</button>
                </form>

                <a class="backToCompartment" href="../../../Compartment/Compartment.view.php?compartmentId=<?php echo $_GET['compartmentId'] ?>&compartmentName=<?php echo $_GET['compartmentName'] ?>">
                    <button class="backButton">
                        Voltar ao compartimento
                    </button>
                </a>
            </div>
        </div>

    </main>

</body>

</html>
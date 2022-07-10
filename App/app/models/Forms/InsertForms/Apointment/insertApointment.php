<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./insertApointment.css?php echo time(); ?>">

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



            if (isset($_POST['addApointmentButton'])) {
                if (isset($_POST['picture']))
                    $picture = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
                else
                    $picture = null;
                    
                $apointmenttControllerInstance = new ApointmentController();
                $result = $apointmenttControllerInstance->insertApointment($_SESSION['mainCompartment'], $_SESSION['mainEnvironment'], $_SESSION['email'], $_POST['apointmentNameLabel'], $_POST['apointmentTypeLabel'], $_POST['apointmentDescriptionLabel'], $picture);


                echo $result;
            } 


            ?>


            <div class="addApointmentForm">
                <div class="addApointmentFormHeader">

                </div>
                <form action="./insertApointment.php?compartmentId=<?php echo $_GET['compartmentId'] ?>&compartmentName=<?php echo $_GET['compartmentName'] ?>" method="post" class="form-container" enctype="multipart/form-data">

                    <p class="apointmentNameLabel">Nome do apontamento</p>
                    <input type="text" name="apointmentNameLabel" class="formInput" required><br>


                    <p class="apointmentTypeLabel">Nome do tipo de apontamento</p>
                    <input type="text" name="apointmentTypeLabel" class="formInput" required><br>


                    <p class="apointmentDescriptionLabel">Descrição do compartimento</p>
                    <input type="text" name="apointmentDescriptionLabel" class="formInput" required><br>

                    <p class="apointmentImageLabel">Foto do apontamento</p>
                    <input type="file" name="picture" class="apointmentPicture">

                    <button name="addApointmentButton" class="addApointmentButton">Adicionar apontamento</button>



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
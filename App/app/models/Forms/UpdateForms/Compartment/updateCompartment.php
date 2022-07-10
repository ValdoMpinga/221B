<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <link rel="stylesheet" href="./updateCompartment.css?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <main>

        <div class="split left">
            <div class="">
                <img class="slogan" src="../../../../../Assets/Images/21B_Slogan 1.png" alt="">
            </div>
        </div>

        <div class="split right">
            <?php
            require_once 'C:\xampp\htdocs\App\221B\app\models\Compartment\CompartmentController.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $compartmentControllerInstance = new CompartmentController();
                $result = $compartmentControllerInstance->updateCompartment($_SESSION['mainEnvironment'], $_SESSION['email'], $_GET['compartmentName'], $_POST['compartmentNameLabel'], $_POST['compartmentDescriptionLabel']);

                if ($result) {
                    echo $result;
                } else {
                    echo $result;
                }
            }


            ?>
            <div class="addCompartmentForm">
                <div class="addCompartmentFormHeader">
<form action=""></form>


                </div>
                <form action="" method="post">

                    <p class="compoartmentNameLabel">Nome do compartimento</p>
                    <input type="text" value="<?php echo $_GET['compartmentName'] ?>" name="compartmentNameLabel" class="formInput" required><br>

                    <p class="compartmentDescriptionLabel">Descrição do compartimento</p>
                    <input type="text" value="<?php echo $_GET['compartmentDescription'] ?>" name="compartmentDescriptionLabel" class="formInput" required>

                    <button class="addCompartmentButton">Atualizar compartimento</button>
                </form>
                <a class="backToEnvironment" href="../../../Environment/EnvironmentView.php?environmentName=<?php echo $_GET['environmentName'] ?>">
                    <button class="backButton">
                        Voltar ao ambiente
                    </button>
                </a>
            </div>
        </div>


    </main>

</body>

</html>
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
    <link rel="stylesheet" href="./insertCompartment.css?php echo time(); ?>">
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

            if (isset($_POST['compoartmentNameLabel'])) {
                $compartmentControllerInstance = new CompartmentController();
                $result = $compartmentControllerInstance->insertCompartment($_SESSION['mainEnvironment'], $_SESSION['email'], $_POST['compoartmentNameLabel'], $_POST['compartmentDescriptionLabel']);

                if ($result) {
                    echo 'Compartimento criadoo';
                } else {
                    echo 'Erro ao criar o  compartimento';
                }
            }


            ?>

            <div class="addCompartmentForm">
                <div class="addCompartmentFormHeader">

                </div>
                <form method="post" action="./insertCompartment.php?environmentName=<?php echo $_GET['environmentName'] ?>" class="form-container">

                    <p class="compoartmentNameLabel">Nome do compartimento</p>
                    <input type="text" name="compoartmentNameLabel" class="formInput" required><br>

                    <p class="compartmentDescriptionLabel">Descrição do compartimento</p>
                    <input type="text" name="compartmentDescriptionLabel" class="formInput" required>

                    <button class="addCompartmentButton">Adicionar compartimento</button>

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
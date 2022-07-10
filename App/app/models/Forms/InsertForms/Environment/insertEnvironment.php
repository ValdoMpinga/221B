<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./insertEnvironment.css?php echo time(); ?>">
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

            <?php require_once 'C:\xampp\htdocs\App\221B\app\models\Environment\EnvironmentController.php';

            if (isset($_POST['environmetNameLabelPost'])) {
                $environmentControllerInstance = new EnvironmentController();
                $result = $environmentControllerInstance->insertEnvironment($_SESSION['email'], $_POST['environmetNameLabelPost'], $_POST['environmetDescriptionLabelPost']);

                if ($result) {
                    echo 'Ambiente criado com sucesso!';
                } else {
                    echo 'Falha ao criar o ambiente, lembre que um user so pode ter um ambiente com um nome';
                }
            }
            ?>

            <div class="addEnvironmetForm">
                <div class="addEnvironmetFormHeader"></div>
                <form action="./insertEnvironment.php?environmentName=<?php echo $_GET['environmentName'] ?> " method="post">

                    <p class="environmetNameLabel">Nome do ambiente</p>
                    <input type="text" name="environmetNameLabelPost" class="formInput" required><br>

                    <p class="environmetDescriptionLabel">Descrição do ambiente</p>
                    <input type="text" name="environmetDescriptionLabelPost" class="formInput" required>

                    <button class="addEnvironmetButton">Adicionar ambiente</button>
                </form>

                
                <a class="backToEnvironment" href="../../../Environment/EnvironmentView.php?environmentName=<?php echo $_GET['environmentName'] ?>">
                    <button class="backButton">
                        Voltar ao ambiente
                    </button>
                </a>
            </div>

        </div>
        </div>
    </main>
</body>

</html>
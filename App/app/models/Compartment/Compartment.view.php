<?php
session_start();

$_SESSION['mainCompartment'] = $_GET['compartmentId'];
?>

<?php  ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Compartment.css?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Os seus apontamentos</title>
</head>

<body>

    <header>
        <?php
        require 'C:\xampp\htdocs\App\221B\app\models\Header\header.php';
        ?>
        </head>
        <main>

            <div class="split left">

                <ul id="myUL">
                    <li><span class="caret">Meus ambientes</span>
                        <ul class="nested">

                            <?php
                            require_once 'C:\xampp\htdocs\App\221B\app\models\Environment\EnvironmentController.php';

                            $environmentControllerInstance = new EnvironmentController();
                            $rows = $environmentControllerInstance->getEnvironment($_SESSION['email']);

                            foreach ($rows as $row) {
                                $_SESSION['mainEnvironment'] = $row['environment_name'];
                                $rowToList = ucwords($row['environment_name']);
                                break;
                            }



                            foreach ($rows as $row) {

                            ?>

                                <a href="../Environment/EnvironmentView.php?environmentName=<?php echo $row['environment_name'] ?>">
                                    <li class="envChildren"><?php $rowToList = ucwords($row['environment_name']);
                                                            echo $row['environment_name']
                                                            ?>
                                    </li>

                                </a>

                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>


            </div>
            <div class="split right">

                <p class="actualCompartment">Compartimento atual:
                    <?php

                    echo $_GET['compartmentName'];
                    ?>
                </p>

                <div class="inputGrid">

                    <div>
                        <input type="text" class="searchBar" placeholder="Pesquisa..." name="aptSearch">
                    </div>

                    <div class="dropdown">
                        <button class="dropbtn">Adicionar <i class="fas fa-plus-circle"></i>

                        </button>
                        <div class="dropdown-content">
                            <a href="../Forms/InsertForms/Apointment/insertApointment.php?compartmentId=<?php echo $_GET['compartmentId'] ?>&compartmentName=<?php echo $_GET['compartmentName'] ?>">Apontamento</a>
                        </div>

                    </div>
                </div>

                <?php
                require_once 'C:\xampp\htdocs\App\221B\app\models\Apointment\ApointmentController.php';

                $apointmentControllerInstance = new ApointmentController();
                $apointmentRows = $apointmentControllerInstance->getApointment($_GET['compartmentId'], $_SESSION['email'], $_SESSION['mainEnvironment']);

                ?>
                <div class="cardGrid">
                    <?php
                    foreach ($apointmentRows as $rows) {
                    ?>
                        <div class="apointmentCard">
                            <div class="apointmentType">
                                <p class="apointmentTypeName"><b> <?php echo $rows['apointment_type'] ?></b></p>
                            </div>
                            <div class="imgDiv">
                               <img src="../../../Assets/Images/coming soon.png" alt="">
                            </div>

                            <div class="gridOne">
                                <p class="apointmentTitle"><?php echo $rows['apointment_name'] ?></p>
                                <a href="../Forms/UpdateForms/Apointment/updateApointment.php?apointmentId=<?php echo $rows['apointment_id'] ?>&apointmenName=<?php echo $rows['apointment_name'] ?>&apointmenDescription=<?php echo $rows['apointment_description'] ?>&apointmenType=<?php echo $rows['apointment_type'] ?>&compartmentId=<?php echo $_GET['compartmentId'] ?>&compartmentName=<?php echo $_GET['compartmentName'] ?>"> <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <article>
                                <?php echo $rows['apointment_description'] ?>
                            </article>

                            <div class="gridTwo">
                                <div class="dateBadge">
                                    <p class="apointmentCreationDate"><b><?php echo $rows['apointment_creation_date'] ?></b></p>
                                </div>

                                <div class="deleteIcon">
                                    <a href="../Forms/DeleteForms/Apointment/deleteApointment.php?apointmentId=<?php echo $rows['apointment_id'] ?>&compartmentId=<?php echo $_GET['compartmentId'] ?>&compartmentName=<?php echo $_GET['compartmentName'] ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>



            </div>
            </div>



        </main>
        <script>
            var toggler = document.getElementsByClassName("caret");
            var i;

            for (i = 0; i < toggler.length; i++) {
                toggler[i].addEventListener("click", function() {
                    this.parentElement.querySelector(".nested").classList.toggle("active");
                    this.classList.toggle("caret-down");
                });
            }

            const onChildClick = document.getElementsByClassName('envChildren');

            onChildClick.addEventListener('click', () => {
                console.log(onChildClick.Value);
            });
        </script>
</body>

</html>
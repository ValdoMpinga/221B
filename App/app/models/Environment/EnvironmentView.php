<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Environment.css?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>O seu ambiente</title>
</head>

<body>

    <?php
    if (!(isset($_SESSION['email']))) {
        echo '<p> You are not logged in</p>';
    }
    ?>

    <header>
        <?php
        require 'C:\xampp\htdocs\App\221B\app\models\Header\header.php';
        ?>
    </header>

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
                            <a href=".\EnvironmentView.php?environmentName=<?php echo $row['environment_name'] ?>">
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

            <p class="actualEnvironment">Ambiente atual:
                <?php
                if (isset($_GET['environmentName']))
                    echo $_GET['environmentName'];
                else echo $_SESSION['mainEnvironment'];
                ?>
            </p>

            <div class="inputGrid">


                <div>
                    <input type="text" class="searchBar" placeholder="Pesquisa..." 
                    >
                   
                </div>

                <div class="dropdown">
                    <button class="dropbtn">Adicionar <i class="fas fa-plus-circle"></i>

                    </button>
                    <div class="dropdown-content">
                        <a href="../Forms/InsertForms/Environment/insertEnvironment.php?environmentName=<?php 
                          if(isset( $_GET['environmentName'] ))
                          echo $_GET['environmentName'] ;
                          else
                          echo $_SESSION['mainEnvironment'];
                          ?>">Ambiente</a>

                        <a href="../Forms/InsertForms/Compartment/insertCompartment.php?environmentName=<?php 
                         if(isset( $_GET['environmentName'] ))
                         echo $_GET['environmentName'] ;
                         else
                         echo $_SESSION['mainEnvironment'];
                        ?>">Compartimento</a>
                    </div>

                </div>
            </div>



            <?php
            require 'C:\xampp\htdocs\App\221B\app\models\Compartment\CompartmentController.php';

            $compartmentControllerInstance = new CompartmentController();

            if (isset($_GET['environmentName'])) {
                $_SESSION['mainEnvironment'] = $_GET['environmentName'];
                $compartments = $compartmentControllerInstance->getCompartment($_SESSION['email'], $_SESSION['mainEnvironment']);
            } else {
                $compartments = $compartmentControllerInstance->getCompartment($_SESSION['email'], $_SESSION['mainEnvironment']);
            }


            if (isset($compartments))

                foreach ($compartments as $compartment) {
            ?><a href="..\Compartment\Compartment.view.php?compartmentId=<?php echo  $compartment['compartment_id'] ?>&compartmentName=<?php echo $compartment['compartment_name'] ?>">
                    <div class="card">
                        <div>
                            <p class="compartmentLabel">Compartimento:</p>
                            <p class="compartmentName">
                                <?php
                                $compartmentName = ucwords($compartment['compartment_name']);
                                echo $compartmentName;
                                unset($_SESSION['selectedCompartment']);
                                $_SESSION['selectedCompartment'] = $compartmentName;

                                ?>
                            </p>
                        </div>
                        <div>
                            <div class="compartmentCardActionButtons">
                                <a href="../Forms/UpdateForms/Compartment/updateCompartment.php?compartmentName=<?php echo $compartment['compartment_name'] ?>&compartmentDescription=<?php echo $compartment['compartment_description'] ?>&environmentName=<?php 
                                if(isset( $_GET['environmentName'] ))
                                echo $_GET['environmentName'] ;
                                else
                                echo $_SESSION['mainEnvironment'];?>">
                                    <button class="editButton">Editar</button>
                                </a>

                                <a href="../Forms/DeleteForms/Compartment/deleteCompartment.php?compartmentName=<?php echo $compartment['compartment_name'] ?>&environmentName=<?php 
                                if(isset( $_GET['environmentName'] ))
                                echo $_GET['environmentName'] ;
                                else
                                echo $_SESSION['mainEnvironment'];
                                ?>">
                                

                                    <button type="submit" class="eliminateButton">Eliminar</button>
                                </a>


                            </div>
                        </div>
                    </div>
                </a>
            <?php
                }
            ?>





        </div>
    </main>

    <footer></footer>


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
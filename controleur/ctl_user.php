<?php
include './model/Db_user.php';

$action =$_GET['action'];

switch($action){	


            case 'validLogin':
                //appel à la base de donnée le modele
                if(isset($_POST['email']) && isset($_POST['password']))
                {
                   $email = $_POST['email'];
                   $password = $_POST['password'];
                   
                   $user = DbUser::getUser($email,$password);
                   
                   if(is_array($user))
                   {
                        $_SESSION['email']=$email;
                        $info = DbUser::getInfoUser($email);
                        $_SESSION["prenom"] = $info[0]['prenom'];
                        $_SESSION["nom"] = $info[0]['nom'];
                        $_SESSION["id"] = $info[0]['id_user'];
                        echo "<script>window.location.replace('index.php?ctl=annonce&action=vueAnnonces');</script>";
                   }
                   else
                   {
                       echo "<script>window.location.replace('index.php?msg=Email ou mot de passe incorrect');</script>";
                        #echo "<script>alert('Email ou Mot de passe incorrect.')</script>";
                   }
                }
                break;		

            case 'deconnect':
                //appel à la base de donnée le modele
                session_unset();
                session_destroy();
                //appel à la vue
                header('Location: index.php');
                break;

            case 'profilUser':
                $email = $_SESSION['email'];
                $infoUser = DbUser::getInfoUser($email);
                $infoVehicule = DbUser::getCarUser($email);
                include ('vue/vue_user/profil_user.php');
            break;

            case 'addCarUser':
                if(!empty($_POST['matricule']) && !empty($_POST['marque']) && !empty($_POST['modele']))
                {
                    $email = $_SESSION['email'];
                    $matricule=$_POST['matricule'];
                    $marque=$_POST['marque'];
                    $modele=$_POST['modele'];
                    DbUser::AddCarUser($email,$matricule,$marque,$modele);
                    header("Location: index.php?ctl=user&action=profilUser");
                }
                break;

                case 'DelCarUser' :
                    $email = $_SESSION['email'];
                    $id_car=$_GET['id_car'];
                    DbUser::DelCarUser($id_car);
                    $infoUser = DbUser::getInfoUser($email);
                    $infoVehicule = DbUser::getCarUser($email);
                    header("Location: index.php?ctl=user&action=profilUser");
                break;

                case 'validModif':
                    $email = $_SESSION['email'];
                    $id_car= $_POST['id_car'];
                    $matricule=$_POST['matricule'];
                    $marque=$_POST['marque'];
                    $modele=$_POST['modele'];
                    DbUser::modifCar($id_car,$matricule,$marque,$modele);
                    $infoUser = DbUser::getInfoUser($email);
                    $infoVehicule = DbUser::getCarUser($email);
                    include ('vue/vue_user/profil_user.php');
                    break;

                   
		}

?>
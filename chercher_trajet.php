<?php

include('include/connexion.php');
$message = "";
$requete = "SELECT id ,nom  FROM `villes`";
$sth = $connexion->prepare($requete);
$sth->execute();
$lignes = $sth->fetchAll(PDO::FETCH_ASSOC);
$rows=array();


if (isset($_POST['id_ville_depart'])) {
    $loginOK = false;

    if (empty($_POST['id_ville_depart']) || empty($_POST['id_ville_arrive']) || empty($_POST['date_aller'])
         || empty($_POST['heure_depart'])) {
        $message = "Vous devez saisir la ville de départ, la ville d'arrivée, la date aller, la date retour, l'heure de départ, l'heure d'arrivée, le nombre de places";
    } else {
        $id_ville_depart = trim($_POST['id_ville_depart']);
        $id_ville_arrive =  trim($_POST['id_ville_arrive']);
        $date_aller =  trim($_POST['date_aller']);
        $heure_depart =  trim($_POST['heure_depart']);


        $requete2 = "SELECT utilisateurs.identifiant id_ville_depart,id_ville_arrive,date_aller,heure_depart,heure_arrive
                    FROM trajets inner join utilisateurs on trajets.id_conducteur = utilisateurs.id
                    where date_aller=:date_aller";

       try {

            $sth = $connexion->prepare($requete2);
            $param=array(":date_aller"=>$date_aller);
            $sth->execute($param);

//On récupère toutes les lignes de la table dans la variable $lignes qui est un tableau associatif
            $rows = $sth->fetchALL(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "problème pour répondre à votre demande, abandon" . $e->getMessage();
            die();
        }
    }
}
?>



<section class="signup"  method="POST" >
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Chercher trajet</h2>






                <form class="register-form" id="register-form" name="connecion" method="POST" action="index.php?action=chercher_trajet">

                    <div class="form-group">
                        <select class="form-select form-select-lg mb-3" name='id_ville_depart' aria-label=".form-select-lg example" required>
                            <option selected disabled>ville depart</option>
                            <?php

                            foreach ($lignes as $ligne) {
                                echo "<option value={$ligne['id']} >";
                                echo "{$ligne['nom']}";
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <select class="form-select form-select-lg mb-3" id="name" name='id_ville_arrive' aria-label=".form-select-lg example" required>
                            <option selected disabled>ville arrive</option>
                            <?php
                            foreach ($lignes as $ligne) {
                                echo "<option value={$ligne['id']} >";
                                echo "{$ligne['nom']}";
                                echo "</option>";
                            }
                            ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <div class="input-group">
                            <input id="date_aller" name="date_aller" type="date" required/>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <div class="input-group">
                            <input id="heure_depart" name="heure_depart" type="time" required/>
                        </div>
                    </div>

                    <div class="form-group form-button">
                        <input type="submit" id="signup" class="form-submit" value="chercher le trajet"/>

                    </div>
                    <a href="index.php?action=script_inscription">Inscription</a>
                    <br><br>
                </form>
            </div>
        </div>
    </div>
</section>











<div class="container">
<?php
echo "Trajet Trouvé<br/>";
foreach ($rows as $ligne) {

    echo $ligne['id_ville_depart']."<br/>";
    echo $ligne['id_ville_arrive']."<br/>";
    echo $ligne['date_aller']."<br/>";
    echo $ligne['heure_depart']."<br/>";
    echo $ligne['heure_arrive']."<br/>";
}
?>
<br>
</div>
<h2><?php echo $message ?></h2>

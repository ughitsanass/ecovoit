<?php

// On n'effectue les traitement qu'à la condition que
// les informations aient été effectivement postées
$message = "";
if (isset($_POST['id_conducteur'])) {
    $loginOK = false;

    if (empty($_POST['id_conducteur']) || empty($_POST['id_ville_depart'])) {
        $message = "saisissez votre id ! ";
    } else {

        $id_conducteur = $_POST['id_conducteur'];
        $id_ville_depart = $_POST['id_ville_depart'];
        $id_ville_arrive = $_POST['id_ville_arrive'];
        $date_aller = $_POST['date_aller'];
        $date_retout = $_POST['date_retout'];
        $heure_depart = $_POST['heure_depart'];
        $heure_arrive = $_POST['heure_arrive'];
        $nombre_places = $_POST['nombre_places'];
        $requete = "insert into ecovoit.trajets (ecovoit.trajets.id_conducteur,ecovoit.trajets.id_ville_depart,ecovoit.trajets.id_ville_arrive,ecovoit.trajets.date_aller,ecovoit.trajets.date_retout,ecovoit.trajets.heure_depart,ecovoit.trajets.heure_arrive,ecovoit.trajets.nombre_places) values (:id_conducteur,:id_ville_depart,:id_ville_arrive,:date_aller,:date_retout,:heure_arrive,:nombre_places)";
        try {
            $sth = $connexion->prepare($requete);
            $param = array(':id_conducteur' => $id_conducteur, ':id_ville_depart' => $id_ville_depart, ':id_ville_arrive' => $id_ville_arrive, ':date_aller' => $date_aller, ':date_retout' => $date_retout, ':heure_depart' => $heure_depart, ':heure_arrive' =>$heure_arrive, 'nombre_places' => $nombre_places);
            $sth->execute($param);
            $message = "<h1>trajet vers $id_ville_arrive créé </h1>";
        } catch (PDOException $e) {
            $message = "<h1>Problème " . $e->getMessage() . "</h1>";
        }
    }
}
?>
<form class="row g-3 needs-validation" name="proposer_trajet" method="POST" action="index.php?action=script-choix-proposer-trajet">

    <div class="col-md-3">
        <label for="validationDefault01" class="form-label"></label>
        <input type="text" class="form-control" id="validationDefault01" value="" name="id_conducteur" placeholder="Entrer votre id de conducteur" >
    </div>


    <div class="col-md-3">
        <label for="validationDefault02" class="form-label"></label>
        <input type="text" class="form-control" id="validationDefault02" value="" name="id_ville_depart" placeholder="id_ville_depart" required>
    </div>


    <div class="col-md-4">
        <label for="validationDefaultUsername" class="form-label"></label>
        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">@</span>
            <input type="text" class="form-control" id="validationDefaultUsername" name="id_ville_arrive" placeholder="id_ville_arrive" aria-describedby="inputGroupPrepend2" required>
        </div>
    </div>

    <div class="col-md-4">
        <label for="validationDefaultUsername" class="form-label"></label>
        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">🔒</span>
            <input type="text" class="form-control" id="validationDefaultUsername" name="date_aller" placeholder="date_aller" aria-describedby="inputGroupPrepend2" required>
        </div>
    </div>

    <div class="col-md-4">
        <label for="validationDefaultUsername" class="form-label"></label>
        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">📅</span>
            <input type="text" class="form-control" id="validationDefaultUsername" name="date_retout" placeholder="date_retour" aria-describedby="inputGroupPrepend2" required>
        </div>
    </div>



    <div class="col-md-4">
        <label for="validationDefaultUsername" class="form-label"></label>
        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">📞</span>
            <input type="text" class="form-control" id="validationDefaultUsername" name="heure_depart" placeholder="heure_depart" aria-describedby="inputGroupPrepend2" required>
        </div>
    </div>

    <div class="col-md-4">
        <label for="validationDefaultUsername" class="form-label"></label>
        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">📞</span>
            <input type="text" class="form-control" id="validationDefaultUsername" name="heure_arrive" placeholder="heure_arrive" aria-describedby="inputGroupPrepend2" required>
        </div>
    </div>

    <div class="col-md-4">
        <label for="validationDefaultUsername" class="form-label"></label>
        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">📞</span>
            <input type="text" class="form-control" id="validationDefaultUsername" name="nombre_places" placeholder="nombre de places" aria-describedby="inputGroupPrepend2" required>
        </div>
    </div>

    <div class="col-sm-10">
        <button class="btn btn-primary btn-lg" type="submit">Submit form</button>
    </div>



        <?= $message ?>


    </div>
</form>

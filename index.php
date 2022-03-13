<?php

$pathParent = dirname(__FILE__);
include $pathParent . "/credentials/credentials.php";

header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html>
<link rel="stylesheet" href="style/pagination.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<h1 style="text-align:center;">Films</h1>



<?php

//si aucun paramètre n'est passé dans l'url, redirige automatiquement vers la page numéro 1
if(!$_GET["numPage"]){
    header("LOCATION: ?numPage=1");
}

//connexion a la BDD
$mysqlClient = new PDO($dbname, $login, $password);

//fonction qui retourne le nombre de lignes dans la BDD
function getDatabaseCount($mysqlClient){
    $sqlQueryCount = "SELECT COUNT(*) FROM films";

    $result = $mysqlClient->prepare($sqlQueryCount);
    $result->execute();
    $databaseCount = $result->fetchAll();
    return $databaseCount[0][0];
}

//nombre d'element à afficher par page
$nbElemPage = 6;

//permet d'obtenir le nombre de page qui contiendront 6 elements de la BDD par page (58/6 arrondi au supérieur donne 10 pages de 6 élements max) 
$nbPageData = round(getDatabaseCount($mysqlClient)/$nbElemPage); 

//offset qui permet d'obtenir les lignes de données à partir du numéro de page (page 2 => de l'élement 7 à ...)
$numDepartElem = $nbElemPage * $_GET['numPage'] - $nbElemPage;

function getMovieDatabase($mysqlClient, $nbElemPage, $numDepartElem){
    //requete pour obtenir les X lignes de la BDD en fonction de l'offset (la page ou l'on se trouve)
    //avec une limite fixé du nombre de résultat à retourner
    $sqlQueryData = "SELECT * FROM films LIMIT $nbElemPage OFFSET $numDepartElem";

    $result = $mysqlClient->prepare($sqlQueryData);
    $result->execute();
    $movieDatabase = $result->fetchAll();
    return $movieDatabase;
}

//si les données retournés de la requete sont vides, modifie une variable de l'url et affiche la dernière page possédant des résultats 
if(!getMovieDatabase($mysqlClient, $nbElemPage, $numDepartElem)){
    if($_GET["numPage"] > $nbPageData){
        $query = $_GET;
        $query['numPage'] = $nbPageData;
        $query_result = http_build_query($query);

        header("LOCATION: ?$query_result");
    }
}

//fonction qui permet d'obtenir l'url de la page précédente
function getPreviousPageUrl(){
    $previousPageNumber = $_GET["numPage"] - 1;
    $baseUrl = strtok($_SERVER['REQUEST_URI'], '?');
    $previousPageUrl = $baseUrl . "?numPage=" . $previousPageNumber;
    return $previousPageUrl;
}

//fonction qui permet d'obtenir l'url de la page suivante
function getNextPageUrl(){
    $nextPageNumber = $_GET["numPage"] + 1;
    $baseUrl = strtok($_SERVER['REQUEST_URI'], '?');
    $nextPageUrl = $baseUrl . "?numPage=" . $nextPageNumber;
    return $nextPageUrl;
}

//fonction qui permet d'obtenir une url en fonction du numéro de page passé en paramètre
function getPageUrlByNumber($numNewPage){
    $baseUrl = strtok($_SERVER['REQUEST_URI'], '?');
    $nextPageUrl = $baseUrl . "?numPage=" . $numNewPage;
    return $nextPageUrl;
}

//print_r($databaseCount[0][0]); //nombre de lignes de la bdd

?>
    <div class="divMovie">
        <?php
        $i=0;
        //affiche les élements retournés de la requete SQL
        foreach(getMovieDatabase($mysqlClient, $nbElemPage, $numDepartElem) as $tab => $val) {
            $i++;
        ?>
            <div class="divDataMovie">
                <p><strong style="text-decoration: underline;">Nom:</strong><?php echo(" " . $val["nom_film"]); ?></p>
                <p><strong style="text-decoration: underline;">Genre:</strong><?php echo(" " . $val["genre_film"]); ?></p>
                <p><strong style="text-decoration: underline;">Date de sortie:</strong><?php echo(" " . $val["date_film"]); ?></p>
            </div>

        <?php 
            //toutes les 2 itérations, revient à la ligne afin d'avoir 2 éléments par ligne
            if($i%2==0){
                ?>
                <div style='clear:both'></div>
                <?php
            }
        }
        ?>
    </div>

    </br>


<!--Bouton de numéro de page
1, 2, [3], 4, 5, ..., 30-->
    <div class="changePage">
        <div class="changePageButton">
            <!-- Affiche un bouton qui redirige vers la page 1 lorsqu'on se trouve sur une autre page que la page 1 -->
            <?php if($_GET["numPage"] != 1){?>
                <a href=<?php echo getPageUrlByNumber(1); ?> class="btn btn-info"><?php echo (1); ?></a>
            <?php } ?>
        <?php
        //if($_GET['numPage'] > 1 && $_GET['numPage'] < $nbPageData){
            for($i=-2; $i<3; $i++){
                //s'il y a une différence > 2 entre la 1ère page et la page actuelle (ou entre la dernière page et la page actuelle), affiche [...]
                if($i == -2 && $_GET["numPage"] + $i > 2 || $i == 2 && $_GET["numPage"] + $i < $nbPageData - 2 ){
                    ?><a class="btn btn-info" readonly><?php echo("..."); ?></a><?php
                    
                }
                //affiche le numéro de page actuel
                elseif($i == 0){
                    ?><strong><a class="btn btn-info" style="background-color:grey"><?php echo ($_GET["numPage"] + $i); ?></a></strong><?php
                    
                //affiche les numéros de pages précédents et suivants autour de la page actuelle
                }elseif($_GET["numPage"] + $i > 1 && $_GET["numPage"] + $i < $nbPageData ){
        ?>
                <a href=<?php echo getPageUrlByNumber($_GET["numPage"] + $i); ?> class="btn btn-info"><?php echo ($_GET["numPage"] + $i); ?></a>

        <?php
                }
            }
        //}
        //Affiche un bouton qui redirige vers la dernière page lorsqu'on se trouve sur une autre page que la dernière
            if($_GET["numPage"] != $nbPageData){?>
                <a href=<?php echo getPageUrlByNumber($nbPageData); ?> class="btn btn-info"><?php echo ($nbPageData); ?></a>
            <?php } ?>
        </div>
    </div>






<!--Boutons Page Précédente/Page Suivante-->
    <div class="changePage">
        <div class="changePageButton">
        <?php
        //si on se trouve sur une page autre que la 1ère et dernière
        if($_GET['numPage'] > 1 && $_GET['numPage'] < $nbPageData){
        ?>
                <!-- Aller à la 1ère page -->
                <a href=<?php echo getPageUrlByNumber(1); ?> class="btn btn-info"><<</a>
                <!-- Aller à la page précédente -->
                <a href=<?php echo getPreviousPageUrl(); ?> class="btn btn-info"><</a>
                <!-- Affiche la page actuelle -->
                <strong><a class="btn btn-info" style="background-color:grey"><?php echo $_GET["numPage"]; ?></a></strong>
                <!-- Aller à la page suivante -->
                <a href=<?php echo getNextPageUrl(); ?> class="btn btn-info">></a>
                <!-- Aller à la dernière page -->
                <a href=<?php echo getPageUrlByNumber($nbPageData); ?> class="btn btn-info">>></a>

        <?php
            //si on se trouve sur la page 1
            }elseif($_GET['numPage'] == 1){
        ?>
                <!-- Affiche seulement les boutons suivant et dernière page -->
                <strong><a class="btn btn-info" style="background-color:grey"><?php echo $_GET["numPage"]; ?></a></strong>
                <a href=<?php echo getNextPageUrl(); ?> class="btn btn-info">></a>
                
                <a href=<?php echo getPageUrlByNumber($nbPageData); ?> class="btn btn-info">>></a>

        <?php
            //si on se trouve sur la dernière page
            }elseif($_GET['numPage'] == $nbPageData){
        ?>
                <!-- Affiche seulement les boutons précédent et 1ère page -->
                <a href=<?php echo getPageUrlByNumber(1); ?> class="btn btn-info"><<</a>

                <a href=<?php echo getPreviousPageUrl(); ?> class="btn btn-info"><</a>
                <strong><a class="btn btn-info" style="background-color:grey"><?php echo $_GET["numPage"]; ?></a></strong>
        <?php
            }
        ?>
        </div>
    </div>


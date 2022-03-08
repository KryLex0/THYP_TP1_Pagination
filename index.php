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

function getDatabaseCount($mysqlClient){
    //requete qui retourne le nombre de lignes dans la BDD afin d'afficher des numéros de pages en fonction du nombre d'élements
    $sqlQueryCount = "SELECT COUNT(*) FROM films";

    $result = $mysqlClient->prepare($sqlQueryCount);
    $result->execute();
    $databaseCount = $result->fetchAll();
    return $databaseCount[0][0];
}

//nombre d'element à afficher par page
$nbElemPage = 6;



//permet d'obtenir le nombre de page qui contiendront 6 elements de la BDD par page (48/6 arrondi au supérieur donne 10 pages) 
$nbPageData = round(getDatabaseCount($mysqlClient)/$nbElemPage); 

//offset qui permet d'obtenir les lignes de données à partir du numéro de page (page 2 => élements 7 à 6*2)
$numDepartElem = $nbElemPage * $_GET['numPage'] - $nbElemPage ;

function getMovieDatabase($mysqlClient, $nbElemPage, $numDepartElem){
    //requete pour obtenir les X lignes de la BDD en fonction de l'offset (la page ou l'on se trouve)
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

function getCurrentUrl($numPage){
    $query = $_GET;
    $query['numPage'] = $numPage;
    $query_result = http_build_query($query);
    return "?" . $query_result;
}


function getPreviousPageUrl(){
    $previousPageNumber = $_GET["numPage"] - 1;
    $baseUrl = strtok($_SERVER['REQUEST_URI'], '?');
    $previousPageUrl = $baseUrl . "?numPage=" . $previousPageNumber;
    return $previousPageUrl;
}

function getNextPageUrl(){
    $nextPageNumber = $_GET["numPage"] + 1;
    $baseUrl = strtok($_SERVER['REQUEST_URI'], '?');
    $nextPageUrl = $baseUrl . "?numPage=" . $nextPageNumber;
    return $nextPageUrl;
}

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
        foreach(getMovieDatabase($mysqlClient, $nbElemPage, $numDepartElem) as $tab => $val) {
            $i++;
        ?>
            <div class="divDataMovie">
                <p><strong style="text-decoration: underline;">Nom:</strong><?php echo(" " . $val["nom_film"]); ?></p>
                <p><strong style="text-decoration: underline;">Genre:</strong><?php echo(" " . $val["genre_film"]); ?></p>
                <p><strong style="text-decoration: underline;">Date de sortie:</strong><?php echo(" " . $val["date_film"]); ?></p>
            </div>

        <?php 
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
            <?php if($_GET["numPage"] != 1){?>
                <a href=<?php echo getPageUrlByNumber(1); ?> class="btn btn-info"><?php echo (1); ?></a>
            <?php } ?>
        <?php
        //if($_GET['numPage'] > 1 && $_GET['numPage'] < $nbPageData){
            for($i=-2; $i<3; $i++){
                if($i == -2 && $_GET["numPage"] + $i > 2 || $i == 2 && $_GET["numPage"] + $i < $nbPageData - 2 ){
                    ?><a class="btn btn-info" readonly><?php echo("..."); ?></a><?php
                    
                }
                elseif($i == 0){
                    ?><strong><a class="btn btn-info" style="background-color:grey"><?php echo ($_GET["numPage"] + $i); ?></a></strong><?php
                    
                
                }elseif($_GET["numPage"] + $i > 1 && $_GET["numPage"] + $i < $nbPageData ){
        ?>
                <a href=<?php echo getPageUrlByNumber($_GET["numPage"] + $i); ?> class="btn btn-info"><?php echo ($_GET["numPage"] + $i); ?></a>

        <?php
                }
            }
        //}
            if($_GET["numPage"] != $nbPageData){?>
                <a href=<?php echo getPageUrlByNumber($nbPageData); ?> class="btn btn-info"><?php echo ($nbPageData); ?></a>
            <?php } ?>
        </div>
    </div>






<!--Boutons Page Précédente/Page Suivante-->
    <div class="changePage">
        <div class="changePageButton">
        <?php
        if($_GET['numPage'] > 1 && $_GET['numPage'] < $nbPageData){
        ?>
                <a href=<?php echo getPageUrlByNumber(1); ?> class="btn btn-info"><<</a>

                <a href=<?php echo getPreviousPageUrl(); ?> class="btn btn-info"><</a>
                <strong><a class="btn btn-info" style="background-color:grey"><?php echo $_GET["numPage"]; ?></a></strong>
                <a href=<?php echo getNextPageUrl(); ?> class="btn btn-info">></a>
                
                <a href=<?php echo getPageUrlByNumber($nbPageData); ?> class="btn btn-info">>></a>

        <?php
        }elseif($_GET['numPage'] == 1){
        ?>
        <strong><a class="btn btn-info" style="background-color:grey"><?php echo $_GET["numPage"]; ?></a></strong>
                <a href=<?php echo getNextPageUrl(); ?> class="btn btn-info">></a>
                
                <a href=<?php echo getPageUrlByNumber($nbPageData); ?> class="btn btn-info">>></a>

        <?php
            }elseif($_GET['numPage'] == $nbPageData){
        ?>
                <a href=<?php echo getPageUrlByNumber(1); ?> class="btn btn-info"><<</a>

                <a href=<?php echo getPreviousPageUrl(); ?> class="btn btn-info"><</a>
                <strong><a class="btn btn-info" style="background-color:grey"><?php echo $_GET["numPage"]; ?></a></strong>
        <?php
            }
        ?>
        </div>
    </div>


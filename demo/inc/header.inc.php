<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pabru - FileUploader</title>

    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>
    <link href="assets/css/styles.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

</head>
<body>

<div id="header">

    <h1>Test du FileUploader</h1>
    <h6>Seul le champs fichier est obligatoire. </h6>
    <hr/>

    <?php if ( isset($_GET["upload"] ) && $_GET["upload"] == "success" && isset($_GET["urls"])){
    ?>
    <div class="row teal lighten-2 upload-files">
        <h5>Mes fichiers téléchargés</h5>
    <?php
        $ex = explode("-sepeartion-",$_GET["urls"]);
        $count = 1;
        foreach($ex as $key => $value){
            if($value != ""){
                echo "<a href='".$value."' target='_blank'>Lien du fichier".$count."</a><br/>";
            }
            $count ++;
        }
   ?>
        </div>
    <?php } ?>
</div>
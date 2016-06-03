<?php
include_once 'viewDescriptor.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?=$vd->getTitolo();?></title>
        <link href="css/thema.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
    <body>
        <div class='main_wrapper'>
            <?php 
                $social=$vd->getSocial();
                require $social;?>
            <?php 
                $header=$vd->getHeader();
                require $header; ?>
            <div id='wrapper'>
                <?php 
                    $Navigation=$vd->getNavigation();
                require $Navigation; ?>
                <div id='content'>
                    <p><?php $titolo=$vd->getTitolo();
                        echo $titolo;?></p>
                    <?php 
                        $contenuto=$vd->getContenuto();
                        require $contenuto; ?>
                    <?php include 'contenuto1.php'; ?>
                    <p>contenuto2</p>
                    <?php include 'contenuto1.php'; ?>
                </div>
            </div>
            <?php include 'footer.php';?>
            <div id='codevalidation'></div>
        </div>
    </body>
</html>

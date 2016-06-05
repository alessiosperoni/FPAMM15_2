
<h2>Dati sviluppatore:</h2>
<p>
<?php 
    echo 'Nome utente: &nbsp;&nbsp;';
    echo $user->getNome();
    echo '</br>';
    echo 'Cognome utente:&nbsp;&nbsp; ';
    echo $user->getCognome();
    echo '</br>';
    echo 'Ruolo: &nbsp;&nbsp;';
    if($user->getRuolo==1) {echo 'User';}else{echo 'Sviluppatore';}
    echo '</br>';
    echo 'Username: &nbsp;&nbsp;';
    echo $user->getUsername();
    echo '</br>';
?>
</p>



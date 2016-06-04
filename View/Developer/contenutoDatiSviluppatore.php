
<h2>Dati utente:</h2>
<p>
<?php 
    echo 'Nome utente: &nbsp;&nbsp;';
    echo $user->getNome();
    echo '</br>';
    echo 'Cognome utente:&nbsp;&nbsp; ';
    echo $user->getCognome();
    echo '</br>';
    echo 'Ruolo: 1=user 2=developer: &nbsp;&nbsp;';
    echo $user->getRuolo();
    echo '</br>';
    echo 'Username: &nbsp;&nbsp;';
    echo $user->getUsername();
    echo '</br>';
?>
</p>



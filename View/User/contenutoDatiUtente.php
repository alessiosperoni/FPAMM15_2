
<h2>Dati utente:</h2>
<p>
<?php 
    //$user = UserFactory::instance()->UserFromDatabase($username, $password);
    //$user = UserFactory::instance()->cercaUtentePerId($_SESSION[ControllerBase::user],$_SESSION[ControllerBase::ruolo]);
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



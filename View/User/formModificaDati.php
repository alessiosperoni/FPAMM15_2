<div class="input-form">
    <form method="post" action="index.php?page=user&cmd=modifica">
        <input type="hidden" name="user" value="<?=$user->getId()?>"/>
        <label for="Nome Utente">Nome</label>
        <input type="text" name="nomeUtente" id="nomeUtente" value="<?= $user->getNome() ?>"/>
        <br/>
        <label for="Cognome Utente">Cognome</label>
        <input type="text" name="cognomeUtente" id="cognomeUtente" value="<?= $user->getCognome() ?>"/>
        <br/>
        <label for="email">email</label>
        <input type="text" name="email" id="email" value="<?= $user->getEmail() ?>"/>
        <br/>
        <div class="save">
            <button type="submit" name="cmd" value="salva">Salva</button>
        </div>
    </form>
</div>
<div class="input-form">
    <form method="post" action="index.php?page=developer&cmd=addCode">
        <input type="hidden" name="prodotto" value="<?=$prodotto->getId()?>"/>
        <label for="Nome prodotto">Nome</label>
        <input type="text" name="nome" id="nome" value="<?= $prodotto->getNome() ?>"/>
        <br/>
        <label for="Modello prodotto">Modello</label>
        <input type="text" name="modello" id="modello" value="<?= $prodotto->getModello() ?>"/>
        <br/>
        <label for="data">data</label>
        <input type="date" name="data" id="data" value="<?= $prodotto->getData() ?>"/>
        <br/>
        <label for="produttore_id">id dello sviluppatore</label>
        <input type="produttore_id" name="produttore_id" id="produttore_id" value="<?= $prodotto->getProduttore_id() ?>"/>
        <br/>
        <label for="descrizione">descrizione</label>
        <input type="text" name="descrizione" id="descrizione" value="<?= $prodotto->getDescrizione() ?>"/>
        <br/>
        
        <div class="save">
            <button type="submit" name="cmd" value="addCode">Salva</button>
        </div>
    </form>
</div>
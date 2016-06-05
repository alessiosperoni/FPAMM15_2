<div class="input-form">
    <form method="post" action="index.php?page=developer&cmd=newProdotto">
        <input type="hidden" name="user" value="<?=$prodotto->getId()?>"/>
        <label for="Nome prodotto">Nome</label>
        <input type="text" name="nomeProdotto" id="nomeProdotto" value="<?= $prodotto->getNome() ?>"/>
        <br/>
        <label for="Modello prodotto">Modello</label>
        <input type="text" name="modelloProdotto" id="modelloProdotto" value="<?= $prodotto->getModello() ?>"/>
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
            <button type="submit" name="cmd" value="newProdotto">Salva</button>
        </div>
    </form>
</div>
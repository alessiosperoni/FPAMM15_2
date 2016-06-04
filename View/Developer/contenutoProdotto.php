
<h2>Dati Prodotto:</h2>
<p>
<?php 
    echo 'Id prodotto: &nbsp;&nbsp;';
    echo $prodotto->getId();
    echo '</br>';
    echo 'Nome prodotto: &nbsp;&nbsp;';
    echo $prodotto->getNome();
    echo '</br>';
    echo 'Modello prodotto: &nbsp;&nbsp;';
    echo $prodotto->getModello();
    echo '</br>';
    echo 'data prodotto: &nbsp;&nbsp;';
    echo $prodotto->getData();
    echo '</br>';
    echo 'produttore id: &nbsp;&nbsp;';
    echo $prodotto->getProduttore_id();
    echo '</br>';
    echo 'Descrizione del prodotto: &nbsp;&nbsp;';
    echo $prodotto->getDescrizione();
    echo '</br>';
?>
</p>
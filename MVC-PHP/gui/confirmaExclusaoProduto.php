<h4>Deseja excluir o produto <?php
    $pro = $this->getDados("produto");
    if ($pro instanceof Produto) {
        echo $pro->getNome_produto();
    }
    ?>?</h4>
<form method="post" action="<?php echo URL; ?>controle-produto/confirma-exclusao">
    <input type="hidden" name="id" value="<?php
    if ($pro instanceof Produto) {
        echo $pro->getId_produto();
    }
    ?>">
    <input type="submit" value="Sim">
</form>
<a href="<?php echo URL; ?>controle-produto/lista-de-produto" >Não</a>

<div class="container">
    <?php
    $id = "";
    $nome = "";
    $valor = "";
    $status = "";

    $produto = $this->getDados("produto");
    $categoria = $this->getDados("categorias");
    if ($produto) {
        $produto instanceof Produto;
        $id = $produto->getId_produto();
        $nome = $produto->getNome_produto();
        $valor = $produto->getValor();
        $status = $produto->getStatus();
    }
    ?>

    <form method="post" enctype="multipart/form-data" action="<?php echo URL; ?>controle-produto/salvar"> 
        <label>Id</label><br>
        <input class="form-control" type="text" readonly="true" value="<?php echo $id; ?>" name="id"><br>
        <label>Nome</label><br>
        <input class="form-control" type="text" value="<?php echo $nome; ?>" name="nome"><br>
        <label>Valor</label><br>
        <input  class="form-control" type="text" value="<?php echo $valor; ?>" name="valor"><br>
        <label>Status</label><br>
        <select class="form-control" name="status">
            <option value="A" <?php
            if ($status == 'A') {
                echo 'selected="true"';
            }
            ?>>Ativo</option>
            <option value="I" <?php
            if ($status == 'I') {
                echo 'selected="true"';
            }
            ?>>Inativo</option>
        </select><br>
        <label>Categorias</label><br>
        <select class="form-control" name="categoria">
            <?php
            foreach ($categoria as $cat):
                $cat instanceof Categoria;
                ?>
                <option value="<?= $cat->getId_categoria() ?>"
                <?php
                if (( $produto->getCategoria() instanceof Categoria ) && ( $produto->getCategoria()->getId_categoria() === $cat->getId_categoria() )) :
                    ?>
                            selected = "selected"
                            <?php
                        endif;
                        ?>>
                            <?= $cat->getNome_categoria() ?>
                </option>
                <?php
            endforeach;
            ?>
        </select>
        <hr/>
        <input type="submit" class="btn btn-success" value="Salvar"><br>
        <a class="btn btn-default" href="<?php echo URL; ?>controle-produto/lista-de-produto">voltar</a><br>
    </form>
</div>
<script type="text/javascript" src="<?= URL ?>/js/jquery.3.1.1.min.js"></script>
<script type="text/javascript" src="<?= URL ?>/js/bootstrap.min.js"></script>
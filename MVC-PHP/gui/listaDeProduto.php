<div class="container">

    <a class="btn btn-danger" href="<?php echo URL; ?>Login/logout/">
        <i class="glyphicon glyphicon-remove"></i> Logout</a>
    <a class="btn btn-primary" href="<?php echo URL; ?>controle-produto/novo/">Novo Produto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Status</th>
                <th>controles</th>
            </tr>
        <tbody>
            <?php
            if ($this->getDados('produtos')):
                $ar = $this->getDados('produtos');
                $dStatus = ["A" => "Ativo", "I" => "Inativo"];
                foreach ($ar as $produto):
                    $produto instanceof Produto;
                    ?>
                    <tr><td><?= $produto->getId_produto() ?></td>
                        <td><?= $produto->getNome_produto() ?></td>
                        <td><?= $produto->getValor() ?></td>
                        <td><?= $dStatus[$produto->getStatus()] ?></td>
                        <td>
                            <a class="btn btn-default" 
                               href="<?= URL ?>controle-produto/excluir/<?= $produto->getId_produto() ?>">
                                excluir
                            </a> &nbsp;
                            <a class="btn btn-default" href="<?= URL ?>controle-produto/editar/<?= $produto->getId_produto() ?>">
                                editar
                            </a>
                        </td></tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        </thead>    
    </table>
</div>

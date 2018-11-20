<div class="container">

    <a class="btn btn-danger" href="<?php echo URL; ?>Login/logout/">
        <i class="glyphicon glyphicon-remove"></i> Logout</a>
    <a class="btn btn-primary" href="<?php echo URL; ?>controle-categoria/novo/">Nova Categoria</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>controles</th>
            </tr>
        <tbody>
            <?php
            if ($this->getDados('categorias')):
                $ar = $this->getDados('categorias');
                foreach ($ar as $categoria):
                    $categoria instanceof Categoria;
                    ?>
                    <tr><td><?= $categoria->getId_categoria() ?></td>
                        <td><?= $categoria->getNome_categoria() ?></td>
                        <td>
                            <a class="btn btn-default" 
                               href="<?= URL ?>controle-categoria/excluir/<?= $categoria->getId_categoria() ?>">
                                excluir
                            </a> &nbsp;
                            <a class="btn btn-default" href="<?= URL ?>controle-categoria/editar/<?= $categoria->getId_categoria() ?>">
                                editar
                            </a>
                        </td></tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        </thead>    
    </table>
</div>

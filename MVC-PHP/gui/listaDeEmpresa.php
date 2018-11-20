<div class="container">

    <a class="btn btn-danger" href="<?php echo URL; ?>Login/logout/">
        <i class="glyphicon glyphicon-remove"></i> Logout</a>
    <a class="btn btn-primary" href="<?php echo URL; ?>controle-empresa/novo/">Nova Empresa</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Status</th>
                <th>controles</th>
            </tr>
        <tbody>
            <?php
            if ($this->getDados('empresas')):
                $ar = $this->getDados('empresas');
                $dStatus = ["A" => "Ativo", "I" => "Inativo"];
                foreach ($ar as $empresa):
                    $empresa instanceof Empresa;
                    ?>
                    <tr><td><?= $empresa->getId() ?></td>
                        <td><?= $empresa->getNome() ?></td>
                        <td><?= $dStatus[$empresa->getStatus()] ?></td>
                        <td>
                            <a class="btn btn-default" 
                               href="<?= URL ?>controle-empresa/excluir/<?= $empresa->getId() ?>">
                                excluir
                            </a> &nbsp;
                            <a class="btn btn-default" href="<?= URL ?>controle-empresa/editar/<?= $empresa->getId() ?>">
                                editar
                            </a>
                        </td></tr>
                <?php endforeach; ?>
<?php endif; ?>
        </tbody>
        </thead>    
    </table>
</div>

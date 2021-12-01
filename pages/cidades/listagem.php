<?php
try {

    if (isset($_GET['p']) && intval($_GET['p']) > 0) {
        $stmt = $conn->prepare("select c.id, c.codigo, c.nome, e.id as id_estado, e.nome as nome_estado
                                  from cidades c
                                  join estados e
                                    on e.id = c.estado
                                 limit " . (intval($_GET['p']) * 5). ", 5");
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("select c.id, c.codigo, c.nome, e.id as id_estado, e.nome as nome_estado
                                  from cidades c
                                  join estados e
                                    on e.id = c.estado
                                 limit 5");
        $stmt->execute();
    }

    $resultado = $stmt->fetchAll();

?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>Cidades</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-success float-right" href="?page=cidades&action=cadastrar">Cadastrar Nova Cidade</a>
            </div>
        </div>
        <br />
        <div class="table-responsive">
            <table border="1" class="table table-striped">
                <thead>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Código</b></td>
                        <td><b>Nome da Cidade</b></td>
                        <td><b>Estado</b></td>
                        <td><b>Ações</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($resultado)) {
                        foreach ($resultado as $linha) {
                    ?>
                            <tr>
                                <td><?= $linha['id'] ?></td>
                                <td><?= $linha['codigo'] ?></td>
                                <td><?= $linha['nome'] ?></td>
                                <td><?= ($linha['id_estado'] . ' - ' . $linha['nome_estado']) ?></td>
                                <td class="text-center">
                                    <a href="?page=cidades&action=alterar&id=<?= $linha['id'] ?>">Alterar</a>
                                    <b> | </b>
                                    <a href="?page=cidades&action=deletar&id=<?= $linha['id'] ?>">Deletar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan=\"3\"> Não foi encontrado resultados </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
        if (isset($_GET['p']) && intval($_GET['p']) > 0) {
            try {
                echo '<a class="btn btn-info float-right m-3" href="?page=cidades&p=' . (intval($_GET['p']) + 1) . '">Próximo</a>';
                echo '<a class="btn btn-info float-right m-3" href="?page=cidades&p=' . (intval($_GET['p']) - 1) . '">Anterior</a>';
            } catch (\Exception $e) {
                echo '<a class="btn btn-info float-right m-3" href="?page=cidades&p=' . 1 . '">Próximo</a>';
                echo '<a class="btn btn-info float-right m-3" href="?page=cidades&p=' . 0 . '">Anterior</a>';
            }
        } else {
            echo '<a class="btn btn-info float-right m-3" href="?page=cidades&p=' . 1 . '">Próximo</a>';
        }
        ?>
    </div>


<?php
} catch (PDOException $e) {
    echo "Erro: {$e->getMessage()}";
}

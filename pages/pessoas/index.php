<?php
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'cadastrar':
            include_once('./pages/pessoas/cadastro.php');
            break;
        case 'alterar':
            include_once('./pages/pessoas/alteracao.php');
            break;
        case 'deletar':
            if (isset($_GET['id'])) {
                $stmt = $conn->prepare("DELETE FROM PESSOAS WHERE ID = :id;");
                $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();
                header('Location: ?page=pessoas');
            }
            break;
        default:
            include_once('./pages/pessoas/listagem.php');
            break;
    }
} else {
    include_once('./pages/pessoas/listagem.php');
}

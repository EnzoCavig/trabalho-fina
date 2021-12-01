<?php
    if(isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'cadastrar':
                include_once('./pages/cidades/cadastro.php');
                break;
            case 'alterar':
                include_once('./pages/cidades/alteracao.php');
                break;
            case 'deletar':
                if(isset($_GET['id'])){
                    $stmt = $conn->prepare("DELETE FROM CIDADES WHERE ID = :id;");
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                header('Location: ?page=cidades');
            }
            break;
            default:
                include_once('./pages/cidades/listagem.php');
                break;
        }
    } else {
        include_once('./pages/cidades/listagem.php');
    }
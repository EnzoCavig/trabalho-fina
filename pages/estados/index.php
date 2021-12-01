<?php
    if(isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'cadastrar':
                include_once('./pages/estados/cadastro.php');
                break;
            case 'alterar':
                include_once('./pages/estados/alteracao.php');
                break;
            case 'deletar':
                if(isset($_GET['id'])){
                    $stmt = $conn->prepare("DELETE FROM estados WHERE id = :id;");
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                header('Location: ?page=estados');
            }
            break;
            default:
                include_once('./pages/estados/listagem.php');
                break;
        }
    } else {
        include_once('./pages/estados/listagem.php');
    }
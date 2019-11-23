<?php


class TaskController extends Controller
{
    public function archive() {
        // Attention MANOEUVRE DE SECURITE A FAIRE
        TaskModel::archiveTask($_REQUEST['idTask']);
        header("Location: index.php?action=showList&idList=" . $_REQUEST['idList']);
        exit();
    }

    public function unarchived() {
        // Attention MANOEUVRE DE SECURITE A FAIRE
        TaskModel::desarchiveTask($_REQUEST['idTask']);
        header("Location: index.php?action=listArchived&idList=" . $_REQUEST['idList']);
        exit();
    }

    public function updateTask() {
        // Attention MANOEUVRE DE SECURITE A FAIRE
        TaskModel::updateTask($_POST['nomTache'],$_POST['echeance'],$_POST['notes'],$_POST['lien'],$_REQUEST['idTask']);
        header("Location: index.php?action=showList&idList=" . $_REQUEST['idList']);
        exit();
    }

    public function newTask() {
        // Attention MANOEUVRE DE SECURITE A FAIRE
        $data = array(
            'listName' => TaskModel::getListName($_REQUEST['idList'])
        );
        //var_dump($data);
        $this->setData($data);
        $this->display();
    }

    public function addTask() {
        // Attention MANOEUVRE DE SECURITE A FAIRE
        if ($_POST['nomTache'] && $_POST['echeance'] && isset($_POST['notes']) && isset($_POST['lien'])) { // Si l'utilisateur ne rempli pas au moins le nom de la tâche et la date
            $date = date_create($_POST['echeance']);
            $date_formate = date_format($date,"Y-m-d H:i:s");
            TaskModel::addTask($_POST['nomTache'],$_POST['echeance'],$_POST['notes'],$_POST['lien'],$_REQUEST['idList']);
            header("Location: index.php?action=showList&idList=".$_REQUEST['idList']);
            exit();
        } else {
            header("Location: index.php?action=newTask&idList=".$_REQUEST['idList']);
            exit();
        }
    }
}
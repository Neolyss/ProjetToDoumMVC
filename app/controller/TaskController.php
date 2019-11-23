<?php


class TaskController extends Controller
{
    public function archive() {
        // Attention MANOEUVRE DE SECURITE A FAIRE
        TaskModel::archiveTask($_REQUEST['idTask']);
        header("Location: index?action=showList&idList=" . $_REQUEST['idList']);
        exit();
    }

    public function unarchived() {
        // Attention MANOEUVRE DE SECURITE A FAIRE
        TaskModel::desarchiveTask($_REQUEST['idTask']);
        header("Location: index?action=listArchived&idList=" . $_REQUEST['idList']);
        exit();
    }

    public function updateTask() {
        // Attention MANOEUVRE DE SECURITE A FAIRE
        TaskModel::updateTask($_POST['nomTache'],$_POST['echeance'],$_POST['notes'],$_POST['lien'],$_REQUEST['idTask']);
        header("Location: index?action=showList&idList=" . $_REQUEST['idList']);
        exit();
    }
}
<?php


class TaskController extends Controller
{
    public function getRightList() { // Retourne vrai si vous avez le droit administrateur
        return(TaskModel::getRight($_REQUEST['idList']));
    }

    public function archive() {
        if($this->getRightList()) { // Si on a le droit d'administrateur
            if(TaskModel::archiveTask($_REQUEST['idTask'])) {
                header("Location: index.php?action=showList&idList=" . $_REQUEST['idList']);
                exit();
            }
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }

    }

    public function unarchived() {
        if($this->getRightList()) { // Si on a le droit d'administrateur
            if(TaskModel::desarchiveTask($_REQUEST['idTask'])) {
                header("Location: index.php?action=listArchived&idList=" . $_REQUEST['idList']);
                exit();
            }
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }

    }

    public function updateTask() {
        if($this->getRightList()) { // Si on a le droit d'administrateur
            if(TaskModel::updateTask($_POST['nomTache'],$_POST['echeance'],$_POST['notes'],$_POST['lien'],$_REQUEST['idTask'])) {
                // Si la mise à jour s'est bien passé
                header("Location: index.php?action=showList&idList=" . $_REQUEST['idList']);
                exit();
            } else {
                // Sinon
                header("Location: index.php?action=showTask&idList=" . $_REQUEST['idList']. "&idTask=". $_REQUEST['idTask']);
                exit();
            }
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }
    }

    public function newTask() {
        if($this->getRightList()) { // Si on a le droit d'administrateur
            $data = array(
                'listName' => TaskModel::getListName($_REQUEST['idList'])
            );
            $this->setData($data);
            $this->display();
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }
    }

    public function addTask() {
        if($this->getRightList()) { // Si on a le droit d'administrateur
            // Si l'utilisateur ne rempli pas au moins le nom de la tâche et la date
            if ($_POST['nomTache'] && $_POST['echeance'] && isset($_POST['notes']) && isset($_POST['lien'])) {

                $date = date_create($_POST['echeance']);
                $date_formate = date_format($date,"Y-m-d H:i:s");

                TaskModel::addTask($_POST['nomTache'],$date_formate,$_POST['notes'],$_POST['lien'],$_REQUEST['idList']);
                header("Location: index.php?action=showList&idList=".$_REQUEST['idList']);
                exit();
            } else {
                header("Location: index.php?action=newTask&idList=".$_REQUEST['idList']);
                exit();
            }
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }
    }
}
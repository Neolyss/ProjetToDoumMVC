<?php


class ListController extends Controller
{
    public function getRightList() { // Retourne le droit sur la liste
        return(ListModel::getRight($_REQUEST['idList']));
    }

    public function addList() { // Permet à l'utilisateur connecté d'ajouter une liste
        // On ajoute la liste dans la table Liste
        ListModel::addList($_POST['nomList']);
        // On récupère l'ID de la liste
        $idList = ListModel::getListId($_POST['nomList']);
        if(ListModel::addRightOwner($_REQUEST['idUser'],$idList)) { // Si le droit de la liste a bien été ajouté
            header("Location: index.php?action=home");
            exit();
        } else { // Si çela ne marche pas
            header("Location: index.php?action=newList");
            exit();
        }
    }

    public function showList() { // Montre la liste des tâches
        if($this->getRightList()) { // Si on a les droits
            $data = array(
                'today' => ListModel::getTodayTasks(),
                'late' => ListModel::getLateTasks(),
                'mail' => ListModel::getMail(),
                'listName' => ListModel::getListName($_REQUEST['idList']),
                'listRight' => ListModel::getRight($_REQUEST['idList']),
                'taskList' => ListModel::displayTask($_REQUEST['idList'])
            );
            $this->setData($data);
            $this->display();
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }
    }

    public function listArchived() { // Montre la liste des tâches archivées
        if($this->getRightList() == "admin" || $this->getRightList() == "lectureEcriture") { // Si on a les droits d'écriture ou administrateur
            $data = array(
                'mail' => ListModel::getMail(),
                'archivedList' => ListModel::displayTaskArchived($_REQUEST['idList'])
            );
            $this->setData($data);
            $this->display();
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }

    }

    public function showTask() {
        if($this->getRightList()) { // Si on a les droits
            $data = array(
                'today' => ListModel::getTodayTasks(),
                'late' => ListModel::getLateTasks(),
                'mail' => ListModel::getMail(),
                'listName' => ListModel::getListName($_REQUEST['idList']),
                'listRight' => ListModel::getRight($_REQUEST['idList']),
                'taskList' => ListModel::displayTask($_REQUEST['idList']),
                'task' => ListModel::getTask($_REQUEST['idTask']),
            );
            $this->setData($data);
            $this->display();
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }
    }

}
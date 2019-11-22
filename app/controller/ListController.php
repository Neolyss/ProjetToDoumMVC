<?php


class ListController extends Controller
{
    public function addList() {
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

    public function showList() {
        $data = array(
            'today' => ListModel::getTodayTasks(),
            'late' => ListModel::getLateTasks(),
            'mail' => ListModel::getMail(),
            'listName' => ListModel::getListName($_REQUEST['idList']),
            'listRight' => ListModel::getRight($_REQUEST['idList']),
            'taskList' => ListModel::displayTask($_REQUEST['idList'])
        );
        //var_dump($data);
        $this->setData($data);
        $this->display();
    }

    public function listArchived() {
        $data = array(
            'mail' => ListModel::getMail(),
            'archivedList' => ListModel::getArchivedLists($_REQUEST['idList'])
        );
        //var_dump($data);
        $this->setData($data);
        $this->display();
    }
}
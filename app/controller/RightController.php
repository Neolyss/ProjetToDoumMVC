<?php

class RightController extends Controller {

    public function right() {
        if(RightModel::getRightAdmin($_REQUEST['idList'])) { // Si on a les droits en admin
            $data = array(
                'today' => RightModel::getTodayTasks(),
                'late' => RightModel::getLateTasks(),
                'mail' => RightModel::getMail(),
                'listName' => RightModel::getListName($_REQUEST['idList']),
                'users' => RightModel::getUsersToAddToAList($_REQUEST['idList'])
            );
            $this->setData($data);
            $this->display();
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }
    }

    public function addRight() {
        if(RightModel::getRightAdmin($_REQUEST['idList'])) { // Si on a les droits en admin
            RightModel::addRightUser($_REQUEST['idList'], $_REQUEST['idUser'], $_REQUEST['droit']);
            header("Location: index.php?action=right&idList=" . $_REQUEST['idList']);
            exit();
        } else {
            header("Location: index.php?action=error&type=403");
            exit();
        }
    }
}

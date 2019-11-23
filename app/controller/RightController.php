<?php

class RightController extends Controller {

    public function right() {
        $data = array(
            'today' => RightModel::getTodayTasks(),
            'late' => RightModel::getLateTasks(),
            'mail' => RightModel::getMail(),
            'listName' => RightModel::getListName($_REQUEST['idList']),
            'users' => RightModel::getUsersToAddToAList($_REQUEST['idList'])
        );
        //var_dump($data);
        $this->setData($data);
        $this->display();
    }

    public function addRight() {
        //var_dump($_POST);
        RightModel::addRightUser($_REQUEST['idList'],$_REQUEST['idUser'],$_REQUEST['droit']);
        header("Location: index.php?action=right&idList=". $_REQUEST['idList']);
        exit();
    }
}

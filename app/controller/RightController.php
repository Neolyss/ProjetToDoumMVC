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
}

<?php
namespace controllers;

require_once './libs/DB.php';
require_once './models/Products.php';

//use libs\DB;
//use models\Products;


//    public function index()
//    {
//        $taskModel = new Task();
//        $session = Session::getInstance();
//        if ($_POST) {
//            $taskModel->email = $_POST['email'] ?? '';
//            $taskModel->name = $_POST['name'] ?? '';
//            $taskModel->message = $_POST['message'] ?? '';
//            $taskModel->status = 0;
//            if ($taskModel->validate()) {
//                $taskModel->insert();
//                $session->set('newTask', true);
//                $this->redirect('/');
//            }
//        }
//
//        $sort = $_GET['sort'] ?? 'id';
//        $dir = $_GET['dir'] ?? 'desc';
//
//        $page = $_GET['page'] ?? 1;
//        $page = intval($page);
//        if (!$page) {
//            $page = 1;
//        }
//
//        $perPage = 3;
//
//        $db = Db::getInstance();
//
//        $totalCount = $db->queryOne('SELECT COUNT(*) as total FROM ' . Task::getTableName())->total;
//
//        $totalPages = ceil($totalCount / $perPage);
//
//        if ($page > $totalPages) {
//            $page = $totalPages;
//        }
//
//        $offset = ($page - 1) * $perPage;
//
//        $sortQuery = '';
//        if ($sort && in_array($sort, ['id', 'name', 'email', 'status'])) {
//            $dir = $dir == 'asc' ? $dir : 'desc';
//            $sortQuery = "ORDER BY $sort $dir";
//        }
//
//        $tasks = $db->queryAll('SELECT * FROM ' . Task::getTableName() . " $sortQuery LIMIT $offset, $perPage");
//
//
//        $errors = $taskModel->getErrors();
//        $newTaskCreated = $session->get('newTask', false);
//        if ($newTaskCreated) {
//            $session->remove('newTask');
//        }
//
//        $isAdmin = $session->get('isAdmin');
//
//        return $this->loadView('task/index', compact('isAdmin', 'tasks', 'page', 'totalPages', 'sort', 'dir', 'taskModel', 'errors', 'newTaskCreated'));
//
//    }
//
//
//}

class MainController
{
    public function index()
    {

        $db = Products::getInstanceCall();
        $tasks = $db->select();


        return $this->loadView('main/index', compact('tasks'));

    }

}
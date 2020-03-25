<?php
namespace App\Core;

use App\Config\Database;
use App\Models\TaskModel;
use App\Models\Tasks;
class ResourceModel implements ResourceModelInterface {
    private $table = null;
    private $id = null;
    private $model = null;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model)
    {
        // TODO: Implement save() method.
    }

    public function add($model)
    {
        if (isset($_POST['title']))
        {
            require(ROOT . "app/Config/cli-config.php");
            $tasks = new Tasks();
            $title = $_POST["title"];
            $description = $_POST["description"];
            $tasks->setTitle($title);
            $tasks->setDescription($description);
            $em->persist($tasks);
            if (!$em->flush())
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

    }

    public function get($id)
    {
        require(ROOT . "app/Config/cli-config.php");
        $tasks = $em->getRepository(Tasks::class)->find($id);
        return $tasks;
    }

    public function getAll()
    {
        require(ROOT . "app/Config/cli-config.php");
        $tasks = $em->getRepository(Tasks::class)->findAll();
        return $tasks;
    }

    public function update($model, $id) // ['title' => '', 'de' => '' ]
    {
        require(ROOT . "app/Config/cli-config.php");
        $task['task'] = $em->find(Tasks::class, $id);
        if (isset($_POST["title"]))
        {
            $task['task']->setTitle($_POST["title"]);
            $task['task']->setDescription($_POST["description"]);

            if (!$em->flush())
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

    }

    public function delete($id)
    {
//        $sql = "DELETE FROM ".$this->table." WHERE ".$this->id." = ". $id;
//        $req = Database::getBdd()->prepare($sql);
//        return $req->execute([$id]);
        require(ROOT . "app/Config/cli-config.php");
        $tasks = $em->getReference(Tasks::class, $id);
        $em->remove($tasks);
        if (!$em->flush())
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }

    }
?>

<?php


class ListModel
{
    // соединяемся с БД
    protected $host = "eu-cdbr-west-01.cleardb.com";
    protected $dbname = "cartpower";
    protected $username = "bdfba8f894e478";
    protected $password = "43e93423";
    protected $conn;
    protected $error;

    public function __construct() {
        $this->connection();
    }

    public function connection()
    {
        $this->conn = new \mysqli($this->host, $this->username, $this->password, $this->dbname);

        if (!$this->conn) {
            $this->error = "Ошибка соединения";
        }
    }

        // устанавливаем задачу
        public function addTask($name, $mail, $text) {
            $this->conn->query("INSERT INTO `task`(`name`, `mail`, `text`) VALUES ('$name', '$mail', '$text')");
        }

        // получаем задачу
        public function getTask() {
            $data = [];
            if ($result = $this->conn->query("SELECT `id`, `name`, `mail`, `text`, `done` FROM `task` WHERE 1")) {
                while ($row = $result-> fetch_row()) {
                    $data[] = $row;
                }
                    $result -> free_result();
            }
            return $data;
        }

        // удаляем задачу
        public function deleteTask($id) {
            $this->conn->query("DELETE FROM `task` WHERE id = $id ");
        }

        // изменить задачу
        public function editTask($id, $text) {
            $this->conn->query("UPDATE `task` SET text`= '$text' WHERE id= $id");
        }

        //авторизация админа
        public function authAdmin($login, $password) {
            $username = filter_var(trim($login), FILTER_SANITIZE_STRING);
            $userpass = filter_var(trim($password), FILTER_SANITIZE_STRING);

            $result = $this->conn->query("SELECT * FROM `user` WHERE `login` = '$username' AND `password` = '$userpass'");
            $usersCol = $result->fetch_assoc();
            if(count($usersCol) == 0){
                echo "Такой пользователь не найден";
                exit();
            }
            else if(count($usersCol) == 1){
                echo "Логин или праоль введены неверно";
                exit();
            }

            setcookie('user', $usersCol['user'], time() + 3600, "/");

            $this->conn->close();

        }

        // сортировка таблиц
        public function sortTable($sort_list) {
            $data = [];
            if ($result = $this->conn->query("SELECT * FROM `task` ORDER BY '$sort_list'")) {
                while ($row = $result-> fetch_row()) {
                    $data[] = $row;
                }
                $result -> free_result();
            }
            return $data;
        }

        // запрос получения количества элементов в БД
        public function countElem() {
           $result = $this->conn->query("SELECT COUNT(*) FROM `task`");
           $row = $result->fetch_row();
           $count = $row[0];
        }

        //
}

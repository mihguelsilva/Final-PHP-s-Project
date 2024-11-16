<?php
class User {
    public function register ($name, $phone, $email, $password) {
        global $pdo;
        $sql = $pdo->prepare('SELECT id_user FROM user_register WHERE email LIKE :email');
        $sql->bindValue(':email', $email);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return false;
        } else {
            $password = md5($password);
            $sql = $pdo->prepare('INSERT INTO user_register (name, phone, email, password) VALUES (:name, :phone, :email, :password)');
            $sql->bindValue(":name", $name);
            $sql->bindValue(":phone", $phone);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":password", $password);
            $sql->execute();
            return true;
        }
    }
    public function signin($email, $password) {
        $sql = $pdo->prepare('SELECT id_user FROM user_register WHERE email = :email AND password = :password');
        $sql->bindValue(":email", $email);
        $sql->bindValue(":password", $password);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $_SESSION['login'] = $data['id_user'];
        }
    }
}
?>

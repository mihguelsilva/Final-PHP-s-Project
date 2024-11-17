<?php
class Category {
    public function catchCategory() {
        global $pdo;
        $sql = $pdo->prepare('SELECT id_category, name FROM category ORDER BY id_category');
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        } else {
            $data = array();
        }
        return $data;
    }
}
?>

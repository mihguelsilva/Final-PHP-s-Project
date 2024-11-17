<?php
class Ads {
    public function addAds($title, $description, $value, $category, $state, $photos) {
        global $pdo;
        $sql = $pdo->prepare('INSERT INTO announcements (title, description, value, state, fk_id_user, fk_id_category) values (:t, :d, :v, :s, :id_user, :id_category)');
        $sql->bindValue(":t", $title);
        $sql->bindValue(":d", $description);
        $sql->bindValue(":v", $value);
        $sql->bindValue(":s", $state);
        $sql->bindValue(":id_user", $_SESSION['login']);
        $sql->bindValue(':id_category', $category);
        $sql->execute();
        $id_announcements = $pdo->lastInsertId();

        if (count($photos) > 0) {
            for($i = 0; $i < count($photos['tmp_name']); $i++) {
                $type = $photos['type'][$i];
                if (in_array($type, array('image/jpeg', 'image/png'))) {
                    $fileName = md5(time() . ".jpg");
                    move_uploaded_file($photos['tmp_name'][$i], 'ads-images' . DIRECTORY_SEPARATOR . $fileName);
                    $sql = $pdo->prepare('INSERT INTO images (url, fk_id_announcements) values (:u, :id_an)');
                    $sql->bindValue(':u', $fileName);
                    $sql->bindValue(':id_an', $id_announcements);
                    $sql->execute();
                }
            }
        }
    }
    /*
    public function removeAds() {
    }
    public function editAds() {
    }
    */
}
?>

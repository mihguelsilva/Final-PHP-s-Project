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
                    $fileName = md5(rand(0,99999).time().".jpg");
                    move_uploaded_file($photos['tmp_name'][$i], 'ads-images' . DIRECTORY_SEPARATOR . $fileName);
                    $sql = $pdo->prepare('INSERT INTO images (url, fk_id_announcements) values (:u, :id_an)');
                    $sql->bindValue(':u', $fileName);
                    $sql->bindValue(':id_an', $id_announcements);
                    $sql->execute();
                }
            }
        }
    }
    
    public function catchAds() {
        global $pdo;
        $sql = $pdo->prepare('SELECT *,
(SELECT images.url FROM images WHERE images.fk_id_announcements = announcements.id_announcements LIMIT 1) AS url,
(SELECT category.name FROM category WHERE category.id_category = announcements.fk_id_category) AS category_name
 FROM announcements WHERE fk_id_user = :id_user');
        $sql->bindValue(':id_user', $_SESSION['login']);
        $sql->execute();
        $data = array();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        }
        return $data;
    }
    
    public function removeAds($id) {
        global $pdo;
        $sql = $pdo->prepare('SELECT url FROM images WHERE fk_id_announcements = :id_images');
        $sql->bindValue(':id_images', $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $urls = $sql->fetchAll();
            foreach($urls as $url) {
                unlink('ads-images'.DIRECTORY_SEPARATOR.$url['url']);
            }
            $sql = $pdo->prepare('DELETE FROM images WHERE fk_id_announcements = :id_images');
            $sql->bindValue(':id_images', $id);
            $sql->execute();
        }
        $sql = $pdo->prepare('DELETE FROM announcements WHERE id_announcements = :id_an');
        $sql->bindValue('id_an', $id);
        $sql->execute();
    }

    public function editAds($id) {
        global $pdo;
        $data = array();
        $data['photos'] = array();
        $sql = $pdo->prepare('SELECT * FROM announcements WHERE id_announcements = :id_an');
        $sql->bindValue(':id_an', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data =  $sql->fetch();
            $sql = $pdo->prepare('SELECT id_image, url FROM images WHERE fk_id_announcements = :id_images');
            $sql->bindValue(':id_images', $id);
            $sql->execute();
            if($sql->rowCount() > 0) {
                $data['photos'] = $sql->fetchAll();
            }
        }
        return $data;
    }

    public function deletePhoto($id) {
        global $pdo;
        $sql = $pdo->prepare('SELECT url FROM images WHERE id_image = :id_image');
        $sql->bindValue('id_image', $id);
        $sql->execute();
        if ($sql->rowCount()) {
            $url = $sql->fetch();
            unlink('ads-images' . DIRECTORY_SEPARATOR . $url['url']);
        }
        $sql = $pdo->prepare('DELETE FROM images WHERE id_image = :id_image');
        $sql->bindValue(':id_image', $id);
        $sql->execute();
    }

    public function updateAds($id, $title, $description, $value, $category, $state, $photos) {
        global $pdo;
        $sql = $pdo->prepare('UPDATE announcements SET
title = :t, description = :d, value = :v, state = :s, fk_id_category = :id_cat
WHERE id_announcements = :id_an');
        $sql->bindValue(':t', $title);
        $sql->bindValue(':d', $description);
        $sql->bindValue(':v', $value);
        $sql->bindValue(':s', $state);
        $sql->bindValue(':id_cat', $category);
        $sql->bindValue(':id_an', $id);
        $sql->execute();
        if (count($photos) > 0) {
            for($i = 0; $i < count($photos['tmp_name']); $i++) {
                $type = $photos['type'][$i];
                if (in_array($type, array('image/jpeg', 'image/png'))) {
                    $fileName = md5(rand(0,99999).time().".jpg");
                    move_uploaded_file($photos['tmp_name'][$i], 'ads-images' . DIRECTORY_SEPARATOR . $fileName);
                    $sql = $pdo->prepare('INSERT INTO images (url, fk_id_announcements) values (:u, :id_an)');
                    $sql->bindValue(':u', $fileName);
                    $sql->bindValue(':id_an', $id);
                    $sql->execute();
                }
            }
        }
    }

    public function catchProduct() {
        global $pdo;
        $sql = $pdo->prepare('SELECT *,
(SELECT images.url FROM images WHERE images.fk_id_announcements = announcements.id_announcements LIMIT 1) AS url,
(SELECT category.name FROM category WHERE category.id_category = announcements.fk_id_category) AS category_name
 FROM announcements ORDER BY id_announcements DESC');
        $sql->execute();
        $data = array();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        }
        return $data;
    }

    public function checkProduct($id) {
        global $pdo;
        $data = array();
        $data['photos'] = array();
        $sql = $pdo->prepare('SELECT *,
(SELECT user_register.name FROM user_register WHERE user_register.id_user = announcements.fk_id_user) AS user_name,
(SELECT user_register.email FROM user_register WHERE user_register.id_user = announcements.fk_id_user) AS user_email,
(SELECT user_register.phone FROM user_register WHERE user_register.id_user = announcements.fk_id_user) AS user_phone
 FROM announcements WHERE id_announcements = :id_an');
        $sql->bindValue(':id_an', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $sql = $pdo->prepare('SELECT * FROM images WHERE fk_id_announcements = :id_an');
            $sql->bindValue(':id_an', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $data['photos'] = $sql->fetchAll();
            }
        }
        return $data;
    }
}
?>

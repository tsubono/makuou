<?php

$driver_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$dsn = "mysql:dbname=_test_canvas;host=mysql523.heteml.jp;charset=utf8mb4";
$username = "_test_canvas";
$passwd = "mysecret";
$products = [];
$graphicsCategories = [];
$graphics = [];
$result = [];
$saved = [];

try {
    if (!isset($_POST['type']) || empty($_POST['type'])) {
        $result['status'] = false;
        echo json_encode($result);
    }

    // データベースに接続
    $pdo = new PDO($dsn, $username, $passwd, $driver_options);

    // アイテム一覧取得
    if ($_POST['type'] == 'getProducts') {
        $stmt = $pdo->query('SELECT * FROM products');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }

        $result['products'] = $products;
    // スタンプカテゴリ一覧取得
    } elseif ($_POST['type'] == 'getGraphicsCategories') {
        $stmt = $pdo->query('SELECT * FROM graphicsCategories');

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $graphicsCategories[] = $row;
        }

        $result['graphicsCategories'] = $graphicsCategories;
    // スタンプ一覧取得
    } elseif ($_POST['type'] == 'getGraphics') {
        $graphicsCategoryId = $_POST['graphicsCategoryId'];

        $stmt = $pdo->prepare('SELECT * FROM graphics WHERE graphicsCategoryId = :graphicsCategoryId');
        $stmt->bindValue(':graphicsCategoryId', (int)$graphicsCategoryId, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $graphics[] = $row;
        }

        $result['graphics'] = $graphics;

    // アイテム取得
    } elseif ($_POST['type'] == 'getProduct') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = :user_id');
        $stmt->bindValue(':user_id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();

        $result['product'] = $stmt->fetch(PDO::FETCH_ASSOC);
    // 保存済みデータ取得
    } elseif ($_POST['type'] == 'getSaved') {
        $user_id = $_POST['user_id'];
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;

        if (!empty($id)) {
            $stmt = $pdo->prepare('SELECT * FROM saved WHERE user_id = :user_id AND id = :id');
            $stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $stmt->execute();
            $saved = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $pdo->prepare('SELECT * FROM saved WHERE user_id = :user_id');
            $stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
            $stmt->execute();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $saved[] = $row;
            }
        }
        $result['saved'] = $saved;
    // デザイン保存
    } elseif ($_POST['type'] == 'SaveDesign') {

        try {
            $pdo->beginTransaction();

            $product_id = $_POST['product_id'];
            $filename = $_POST['filename'];
            $json = $_POST['json'];
            $user_id = $_POST['user_id'];
            $saved_id = $_POST['saved_id'];
            $uploaded_files = json_decode($_POST['uploaded_files'], true);

            // 該当デザイン取得
            $stmt = $pdo->prepare('SELECT * FROM saved WHERE user_id = :user_id AND id = :id');
            $stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
            $stmt->bindValue(':id', (int)$saved_id, PDO::PARAM_INT);
            $stmt->execute();
            $saved = $stmt->fetch(PDO::FETCH_ASSOC);

            // 更新
            if (!empty($saved_id)) {
                $stmt = $pdo -> prepare("UPDATE saved SET product_id = :product_id, filename = :filename, json = :json, user_id = :user_id WHERE id = :id");
                $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->bindValue(':filename', $filename, PDO::PARAM_STR);
                $stmt->bindValue(':json', $json, PDO::PARAM_STR);
                $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindValue(':id', $saved_id, PDO::PARAM_INT);

                // 前回のデザイン画像を削除
                if (file_exists("../saved_design/png/". $saved["filename"]. ".png")) {
                    unlink("../saved_design/png/". $saved["filename"]. ".png");
                }

             // 新規追加
            } else {
                $stmt = $pdo -> prepare("INSERT INTO saved (product_id, filename, json, user_id) VALUES (:product_id, :filename, :json, :user_id)");
                $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
                $stmt->bindValue(':filename', $filename, PDO::PARAM_STR);
                $stmt->bindValue(':json', $json, PDO::PARAM_STR);
                $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            }

            $stmt->execute();
            if (empty($saved_id)) {
                $saved_id = $pdo->lastInsertId();
            }
            $pdo->commit();

            // canvasにアップロードされた写真一覧をsavedに移動する
            foreach ($uploaded_files as $uploaded_file) {
                if (file_exists ( "../upload/tmp/".$uploaded_file )) {
                    rename("../upload/tmp/".$uploaded_file, "../upload/saved/".$uploaded_file);
                }
            }
        } catch(PDOExecption $e) {
            $pdo->rollback();
        }
        $result['saved_id'] = $saved_id;

    // デザイン削除
    } elseif ($_POST['type'] == 'DeleteDesign') {
        try {
            $user_id = $_POST['user_id'];
            $saved_id = $_POST['saved_id'];

            try {
                $pdo->beginTransaction();

                // 該当デザイン取得
                $stmt = $pdo->prepare('SELECT * FROM saved WHERE user_id = :user_id AND id = :id');
                $stmt->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
                $stmt->bindValue(':id', (int)$saved_id, PDO::PARAM_INT);
                $stmt->execute();
                $saved = $stmt->fetch(PDO::FETCH_ASSOC);

                // 画像を削除
                if (file_exists("../saved_design/png/". $saved["filename"]. ".png")) {
                    unlink("../saved_design/png/". $saved["filename"]. ".png");
                }
                // canvasのimageデータの画像を削除
                $objects = json_decode($saved['json'], true);
                foreach ($objects["objects"] as $object) {
                    if ($object["type"] == "image") {
                        $file = basename($object["src"]);
                        if (file_exists("../upload/saved/". $file)) {
                            unlink("../upload/saved/". $file);
                        }
                    }
                }

                // DBデータを削除
                $stmt = $pdo -> prepare("DELETE FROM saved WHERE id = :id AND user_id = :user_id");
                $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->bindValue(':id', $saved_id, PDO::PARAM_INT);
                $stmt->execute();
                $pdo->commit();

            } catch(PDOExecption $e) {
                $pdo->rollback();
            }
        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
            echo json_encode($result);
        }

    }
    $result['status'] = true;

    echo json_encode($result);

} catch (PDOException $e) {

    // エラーが発生した場合は「500 Internal Server Error」でテキストとして表示して終了する
    // - もし手抜きしたくない場合は普通にHTMLの表示を継続する
    // - ここではエラー内容を表示しているが， 実際の商用環境ではログファイルに記録して， Webブラウザには出さないほうが望ましい
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());

}


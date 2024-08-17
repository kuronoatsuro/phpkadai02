
<?php

//1. POSTデータ取得
$book_name = $_POST['book_name']; // 名前を取得
$book_url = $_POST['book_url']; // Eメールアドレスを取得
$book_comment = $_POST['book_comment']; // 内容を取得

//2. DB接続
try {
    $pdo = new PDO('mysql:dbname=gs_an_table;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO gs_an_table(book_name, book_url, book_comment, date) VALUES(:book_name, :book_url, :book_comment, NOW())");

//  2. バインド変数を用意

$stmt->bindValue(':book_name', $book_name, PDO::PARAM_STR);
$stmt->bindValue(':book_url', $book_url, PDO::PARAM_STR);
$stmt->bindValue(':book_comment', $book_comment, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('ErrorMessage:' . $error[2]);
} else {
    header("Location: index.php");
}
?>
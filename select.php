<?php
//DB接続
try {
    $pdo = new PDO('mysql:dbname=gs_an_table;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

//SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_an_table');
$status = $stmt->execute();

//エラー処理
if ($status==false) {
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ブックマーク表示</title>
    <link href="css/style.css" rel="stylesheet">

</head>

<body id="main">
    <nav class="navbar">
        <a class="navbar-brand" href="index.php">データ登録</a>
        <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
            <button type="submit" class="logout-button">ログアウト</button>
        </form>
    </nav>

    <div class="container">
        <h1>ブックマーク一覧</h1>
        <div class="book_list">
            <?php while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <p>
                    <?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?>
                    <?= htmlspecialchars($result['book_name'], ENT_QUOTES, 'UTF-8') ?> 
                    <?= htmlspecialchars($result['book_comment'], ENT_QUOTES, 'UTF-8') ?> 
                </p>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>
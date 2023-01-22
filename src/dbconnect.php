<?php
require_once 'env.php';
ini_set('display_errors', true);
$host = DB_HOST; //db
$db = DB_NAME; //posse
$user = DB_USER; //root
$pass = DB_PASS; //root
$dsn = "mysql:dbname=$db;host=$host;";
try {
  $pdo = new PDO($dsn, $user, $pass, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      // エラーモード設定
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      // フェッチモード（配列をキーとバリューで必ず返す）
      // オプション
    ]
  );
    return $pdo;
  } catch(PDOException $e) {
    echo '接続失敗です' . $e->getMessage();
    exit();
  }


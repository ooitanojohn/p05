<?php
//********************************************************
// ユーザー検索
//********************************************************

//********************* 配列初期化 **************************
/* PASS配列(DB) */
$nameTbl = [
    ['name' => '川島', 'pass' => 'aaaa'],
    ['name' => '田中', 'pass' => 'bbbb'],
    ['name' => '山本', 'pass' => 'cccc'],
    ['name' => '川田', 'pass' => 'dddd']
];
/* ErrMsg配列 */
$ErrMsg = [
    'id' => '',
    'pass' => ''
];
/* LoginMsg */
$LoginMsg = '';
$userId = '';
$userName = '';

/* フォーム受け取り */
require_once 'model/validate.php';
$form = new ValidateCheck('search', 'post');
// 受け取り内容
$postData = $form->receiveData();
$id = $form->findByData($postData, 'id');
$pass = $form->findByData($postData, 'pass');

/* ログインボタン押されていれば */
if ($postData !== NULL) {
    /* バリデーションチェック */
    switch (true) {
        case $form->ValidateEmpty($id):
            $ErrMsg['id'] = 'IDが入力されていません。';
            break;
        case $form->ValidateNumeric($id):
            $ErrMsg['id'] = 'IDが数値ではありません。';
            break;
        case $form->ValidateNumericSize($id, $nameTbl):
            $ErrMsg['id'] = 'IDが存在しません';
            break;
        default:
            // $date = data
            break;
    }
    if ($form->ValidateEmpty($pass)) {
        $ErrMsg['pass'] = 'PASSWORDが入力されていません。';
    }
    /* 入力エラーなければ*/
    $ErrJudge = array_filter($ErrMsg);
    if (empty($ErrJudge)) {
        require_once 'model/newArrayAutoInstance.php';
        $userData = new UserArrayData($nameTbl);

        /* ユーザーIDから配列よりPASS取得 */
        $nameData = $nameTbl[$id]['name'];
        $passData = $nameTbl[$id]['pass'];
        /* 入力されたpassと配列のpassを比較して認証 */
        $span = '失敗';
        if ($pass === $passData) {
            $span = '成功';
            $userId = $id;
            $userName = $nameData;
        }
        $LoginMsg = 'Login' . $span . ' ユーザー名 : ' . $nameData;
        // csv出力
        date_default_timezone_set('Asia/Tokyo');
        $rec = date('Y-m-d H:i:s') . ' ';
        $rec .= $LoginMsg;
        $rec .= "\n";
        $userData->csvWrite('data.txt', $rec);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <table border="0">
            <tr>
                <td>ユーザID</td>
                <td><input type="text" name="id" value="<?php echo $id ?>"></td>
                <td><?php echo $ErrMsg['id'] ?></td>
            </tr>
            <tr>
                <td>PASSWORD</td>
                <td><input type="text" name="pass" value="<?php echo $pass ?>"></td>
                <td><?php echo $ErrMsg['pass'] ?></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="submit" name="search" value="検索">
                </td>
            </tr>
        </table>
    </form>
    <p><?php echo $LoginMsg ?></p>
    <table border="1">
        <tr>
            <td width="130">ユーザーID</td>
            <td width="130"><?php echo $userId ?></td>
        </tr>
        <tr>
            <td>ユーザー名</td>
            <td><?php echo $userName ?></td>
        </tr>
    </table>

</body>

</html>
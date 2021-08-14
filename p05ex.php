<?php
//********************************************************
// ユーザー検索
//********************************************************

//********************* 配列初期化 **************************
/* PASS配列(DB) */
$passTbl = [
    '川島',
    '田中',
    '山本',
    '川田'
];
/* ErrMsg配列 */
$ErrMsg = [
    'id' => '',
    'pass' => ''
];
/* LoginMsg */
$LoginMsg = '';

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
        case $form->ValidateNumericSize($id, $passTbl):
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
        // インスタンス化してusers配列に
        require_once 'model/Data.php';
        foreach ($passTbl as $key => $val) {
            ${'user' . $key} = new UserData($key, $val);
            $users[] = ${'user' . $key};
        }
        /* ユーザーIDから配列よりPASS取得 */
        $passData =  ${'user' . $id}->getPass();
        /* 入力されたpassと配列のpassを比較して認証 */
        if ($pass === $passData) {
            $LoginMsg = 'Login完了 ユーザー名 : ' . ${'user' . $id}->getId();
        } else {
            $LoginMsg =
                $LoginMsg = 'Login失敗 ユーザー名 : ' . ${'user' . $id}->getId();
        }
    }
}
require_once 'model/newArrayAutoInstance.php';
$test = new UserArrayData($passTbl);
$teachers = $test->UserData('teacher');

echo '$teachers:';
var_dump($teachers);
echo '<br>';

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
            <td width="130"><?php echo $users[0]->getId() ?></td>
        </tr>
        <tr>
            <td>ユーザー名</td>
            <td><?php echo $users[0]->getPass() ?></td>
        </tr>
    </table>

</body>

</html>
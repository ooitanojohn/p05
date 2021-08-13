<?php
/* PASS配列(DB) */
require_once 'model/arrayData.php';
$passTbl = [
    '川島',
    '田中',
    '山本',
    '川田'
];
// インスタンス化してusers配列に
foreach ($passTbl as $key => $val) {
    ${'user' . $key} = new ArrayUserData($key, $val);
    $users[] = ${'user' . $key};
}

/* フォーム受け取り */
require_once 'model/validate.php';
$postData = new Form('search');
// 受け取り内容
echo '$postData->postData():';
var_dump($postData->postData());
echo '<br>';

/* バリデーションチェック */

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
                <td><input type="text" name="id" value="<?php  ?>"></td>
                <td><?php  ?></td>
                <td colspan="2" align="right">
                    <input type="submit" name="search" value="検索">
                <td></td>
                </td>
            </tr>
        </table>
    </form>
    <p><?php  ?></p>
    <table border="1">
        <tr>
            <td width="130">ユーザーID</td>
            <td width="130"><?php echo $users[0]->getId() ?></td>
        </tr>
        <tr>
            <td>ユーザー名</td>
            <td><?php echo $users[0]->getpass() ?></td>
        </tr>
    </table>

</body>

</html>
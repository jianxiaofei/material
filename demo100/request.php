<?php
session_start();
header("Content-Type:text/plain");
$data = json_decode($_POST['data']);
$judge = $data->judge;
$name = $data->name;
$pwd = $data->password;
if ($judge) {
	$sex = $data->sex;
	$email = $data->email;
}

$servername = "localhost";
$username = "root";
$password = "Le3M7qGBfTUKUYPT";
$dbname = "userInfo";
$message = array();

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//登陆验证
if (!$judge) {
	$sql = "SELECT * FROM person WHERE (username='$name') AND (password='$pwd')";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = mysqli_fetch_array($result)) {
			// array_push($message,$row);

			$message['id'] = $row['id'];
			$message['name'] = $row['username'];
			$message['age'] = $row['age'];
			$message['email'] = $row['email'];
			$message['len'] = count($message);
			setcookie('username', $row['username'], time() + 24 * 60 * 60 * 7, '/'); //设置cookie保存数据上级页面可以拿去
		}
		;
		echo json_encode(["code" => 200, "msg" => "登录成功！", "result" => $message]);
	} else {
		echo json_encode(['code' => 100, 'msg' => '用户名或密码不正确！']);
	}
}
//注册
else if ($judge) {

	$sql = "INSERT INTO person (username, password,sex,age,email)
    VALUES ('$name','$pwd','$sex',22,'$email')";

	if ($conn->query($sql) === TRUE) {
		echo json_encode(["code" => 200, "msg" => "注册成功！"]);
	} else {
		echo json_encode(['code' => 100, 'msg' => $sql . $conn->error]);
	}
}

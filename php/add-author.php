<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	include "../db_conn.php";

	if (isset($_POST['author_name'])) {

		$name = $_POST['author_name'];

		if (empty($name)) {
			$em = "Nama Penulis Diperlukan";
			header("Location: ../add-author.php?error=$em");
            exit;
		}else {

			$sql  = "INSERT INTO authors (nama)
			         VALUES (?)";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name]);

		     if ($res) {

		     	$sm = "Berhasil Ditambah!";
				header("Location: ../add-author.php?success=$sm");
	            exit;
		     }else{

		     	$em = "Terjadi Kesalahan!";
				header("Location: ../add-author.php?error=$em");
	            exit;
		     }
		}
	}else {
      header("Location: ../admin.php");
      exit;
	}

}else{
  header("Location: ../login.php");
  exit;
}
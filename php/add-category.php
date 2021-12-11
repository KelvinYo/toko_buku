<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	include "../db_conn.php";

	if (isset($_POST['category_name'])) {

		$name = $_POST['category_name'];

		if (empty($name)) {
			$em = "Nama Kategori Diperlukan";
			header("Location: ../add-category.php?error=$em");
            exit;
		}else {

			$sql  = "INSERT INTO categories (nama)
			         VALUES (?)";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$name]);

		     if ($res) {

		     	$sm = "Berhasil Ditambah!";
				header("Location: ../add-category.php?success=$sm");
	            exit;
		     }else{

		     	$em = "Terjadi Kesalahan!";
				header("Location: ../add-category.php?error=$em");
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
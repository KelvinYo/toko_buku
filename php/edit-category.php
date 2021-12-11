<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {


	include "../db_conn.php";

	if (isset($_POST['category_name']) &&
        isset($_POST['category_id'])) {

		$nama = $_POST['category_name'];
		$id = $_POST['category_id'];


		if (empty($nama)) {
			$em = "Nama Kategori Diperlukan";
			header("Location: ../edit-category.php?error=$em&id=$id");
            exit;
		}else {

			$sql  = "UPDATE categories 
			         SET nama=?
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$nama, $id]);

		     if ($res) {

		     	$sm = "Berhasil Diperbarui!";
				header("Location: ../edit-category.php?success=$sm&id=$id");
	            exit;
		     }else{

		     	$em = "Terjadi Kesalahan!";
				header("Location: ../edit-category.php?error=$em&id=$id");
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
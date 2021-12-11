<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	include "../db_conn.php";

	if (isset($_POST['author_name']) &&
        isset($_POST['author_id'])) {

		$nama = $_POST['author_name'];
		$id = $_POST['author_id'];

		if (empty($nama)) {
			$em = "Nama Penulis Diperlukan";
			header("Location: ../edit-author.php?error=$em&id=$id");
            exit;
		}else {

			$sql  = "UPDATE authors 
			         SET nama=?
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$nama, $id]);

		     if ($res) {

		     	$sm = "Berhasil Diperbarui!";
				header("Location: ../edit-author.php?success=$sm&id=$id");
	            exit;
		     }else{

		     	$em = "Terjadi Kesalahan!";
				header("Location: ../edit-author.php?error=$em&id=$id");
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
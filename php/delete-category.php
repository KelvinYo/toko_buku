<?php  
session_start();

if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	include "../db_conn.php";

	if (isset($_GET['id'])) {

		$id = $_GET['id'];

		if (empty($id)) {
			$em = "Error Occurred!";
			header("Location: ../admin.php?error=$em");
            exit;
		}else {
 
			$sql  = "DELETE FROM categories
			         WHERE id=?";
			$stmt = $conn->prepare($sql);
			$res  = $stmt->execute([$id]);

		     if ($res) {
		     	# success message
		     	$sm = "Berhasil Dihapus!";
				header("Location: ../admin.php?success=$sm");
	            exit;
			 }else {
			 	$em = "Terjadi Kesalahan!";
			    header("Location: ../admin.php?error=$em");
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
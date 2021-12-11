<?php 
session_start();
if (isset($_SESSION['user_id'])&&
    isset($_SESSION['user_email'])){

        include "db_conn.php";

        include "php/func-book.php";
        $books = get_all_books($conn);
    
        include "php/func-author.php";
        $authors = get_all_author($conn);

        include "php/func-category.php";
        $categories = get_all_categories($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ADMIN</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</head>
<body>
<div class='container'>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin.php">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" 
                aria-current="page" 
                href="index.php">Toko</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" 
                href="add-book.php">Tambah Buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" 
                href="add-category.php">Tambah Kategori</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" 
                href="add-author.php">Tambah Penulis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" 
                href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
    </nav>
    <form action="search.php"
          method="get"
          style="width: 100%; max-width: 30rem">
        <div class="input-group my-5">
            <input type="text" 
                   class="form-control"
                   name="key" 
                   placeholder="Cari Buku..." 
                   aria-label="Cari Buku..." 
                   aria-describedby="basic-addon2">
            <Button  class="input-group-text
                            btn btn-primary" 
                   id="basic-addon2">
                <img src="img/search.png"
                          width="20">
            </button>
        </div>
    </form>

    <div class="mt-5"></div>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>

    <?php if($books == 0){?>
            <div    class="alert alert-warning text-center p-5" 
                    role="alert">
                    <img src="img/empty.png" width="100">
                    <br>
                Tidak ada buku di database
		  </div>
    <?php }else{?>

    <h4 class="mt-5">Semua Buku</h4>
    <table class= "table table-bordered shadow">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 0;
                foreach ($books as $book) {
                $i++;
            ?>
            <tr>
                <td><?=$i?></td>
                <td>
                    <img    width="100"
                            src="uploads/cover/<?=$book['cover']?>">
                    <a  class="link-dark d-block text-center"
                        href="uploads/files/<?=$book['file']?>">
                        <?=$book['title']?>
                    </a>

                </td>
                <td>
                    <?php if ($authors == 0){ 
                        echo "Undefined";}else{
                        
                        foreach ($authors as $author) {
                            if ($author['id'] == $book['author_id']) {
                                echo $author['nama'];
                            }
                        }
                    }   
                    ?>    
                </td>
                <td><?=$book['description']?></td>
                <td>
                    <?php if ($categories == 0){ 
                        echo "Undefined";}else{
                        
                        foreach ($categories as $category) {
                            if ($category['id'] == $book['category_id']) {
                                echo $category['nama'];
                            }
                        }
                    }   
                    ?>
            </td>
                <td>
                    <a  href="edit-book.php?id=<?=$book['id']?>" 
                        class="btn btn-warning">
                        Edit</a>

                    <a  href="php/delete-book.php?id=<?=$book['id']?>" 
                        class="btn btn-danger">
                        Delete</a>
                </td>
            </tr>
            <?php } ?>   
        </tbody>
    </table>
    <?php } ?>

    <?php if($categories == 0){?>
        <div    class="alert alert-warning text-center p-5" 
                    role="alert">
                    <img src="img/empty.png" width="100">
                    <br>
                Tidak ada kategori di database
		  </div>
    <?php }else{?>
    <h4 class="mt-5">Semua Kategori</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $j = 0;
                foreach ($categories as $category) {
                $j++;
            ?>
            <tr>
                <td><?=$j?></td>
                <td><?=$category['nama']?></td>
                <td>
                    <a  href="edit-category.php?id=<?=$category['id']?>" 
                        class="btn btn-warning">
                        Edit</a>

                    <a  href="php/delete-category.php?id=<?=$category['id']?>" 
                        class="btn btn-danger">
                        Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>

    <?php if($authors == 0){?>
        <div    class="alert alert-warning text-center p-5" 
                    role="alert">
                    <img src="img/empty.png" width="100">
                    <br>
                Tidak ada Penulis di database
		  </div>
    <?php }else{?>
    <h4 class="mt-5">Semua Penulis</h4>
    <table class="table table-bordered shadow">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penulis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $k = 0;
                foreach ($authors as $author) {
                $k++;
            ?>
            <tr>
                <td><?=$k?></td>
                <td><?=$author['nama']?></td>
                <td>
                    <a  href="edit-author.php?id=<?=$author['id']?>" 
                        class="btn btn-warning">
                        Edit</a>

                    <a  href="php/delete-author.php?id=<?=$author['id']?>" 
                        class="btn btn-danger">
                        Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
</div>
</body>
</html>

<?php }else {
    header("Location: login.php");
    exit;
} ?>
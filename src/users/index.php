<?php require_once '../templates/header.php'; 
if ($checkSession && !isset($_SESSION['email'])) {
  // Redirect ke halaman login jika belum login
  header("Location: ./login.php");
  exit();
}

?>

<div class="container">
  <h1 class="mt-4 mb-3">Data Pengguna</h1>
  <br>
  <a href="./tambah.php" class="btn btn-success mb-3">Tambah Pengguna</a>
  <a href="./logout.php" class="btn btn-danger mb-3">Logout</a>
  <br>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Action</th>
          <th scope="col">Avatar</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Role</th>
      
        </tr>
      </thead>
      <tbody>
        <?php
        $users = mysqli_query($conn, "SELECT * FROM users");
        $no = 1;
        foreach ($users as $user) {
          ?>
          <tr>
            <th scope="row"><?= $no++ ?></th>
            <td>
            <a href="./detail.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary mr-2">Detail</a>
              <a href="./edit.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-warning mr-2">Edit</a>
              <a href="./?hapus&id=<?= $user['id'] ?>" class="btn btn-sm btn-danger">Hapus</a>
            </td>
            <td>
              <img src="data:image/jpeg;base64, <?= base64_encode($user['avatar']); ?>" alt="Avatar" class="rounded-circle" style="width: 75px; height: 75px;">
            </td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['phone'] ?></td>
            <td><?= $user['role'] ?></td>

          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
if (isset($_GET['hapus']) && isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM users WHERE id = $id";
  if (mysqli_query($conn, $query)) {
    echo "<script>window.location.href = './';</script>";
    exit();
  } else {
    echo "Gagal menghapus pengguna.";
  }
}
require_once '../templates/footer.php';
?>

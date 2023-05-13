<?php require_once '../templates/header.php'; 

if ($checkSession && !isset($_SESSION['email'])) {
    // Redirect ke halaman login jika belum login
    header("Location: ./login.php");
    exit();
}

$user = mysqli_query($conn, "SELECT * FROM users WHERE id = " . $_GET['id']);
$user = mysqli_fetch_object($user);

?>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Detail Profil User</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="avatar-container">
                        <?php if ($user->avatar): ?>
                            <img src="data:image/jpeg;base64,<?= base64_encode($user->avatar) ?>" alt="Avatar" class="rounded-circle" style="width: 75px; height: 75px;">
                        <?php else: ?>
                            <div class="avatar-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <h4 for="inputName">Name</h4>
                        <p><?= $user->name;?></p>
                    </div>
                    <div class="form-group">
                        <h4 for="inputEmail">Email</h4>
                        <p><?= $user->email;?></p>
                    </div>
                    <div class="form-group">
                        <h4 for="inputAddress">Address</h4>
                        <p><?= $user->address;?></p>
                    </div>
                    <div class="form-group">
                        <h4 for="inputPhoneNumber">Phone Number</h4>
                        <p><?= $user->phone;?></p>
                    </div>
                    <div class="form-group">
                        <h4 for="inputRole">Role</h4>
                        <p><?= $user->role;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="./" class="btn btn-primary mt-3">Kembali</a>
</div>
<?php require_once '../templates/footer.php'; ?>

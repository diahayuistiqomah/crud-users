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
    <h1>Edit Data User</h1>
    <a href="./" class="btn btn-danger">Kembali</a>
    <br>
    <br>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputName">Name</label>
            <input name="name" type="text" class="form-control" id="inputName" value="<?= $user->name;?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input name="email" type="email" class="form-control" id="inputEmail4" value="<?= $user->email;?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <div class="input-group">
                    <input name="password" type="password" class="form-control" id="inputPassword4" value="<?= $user->password;?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="passwordVisibilityToggle" onclick="togglePasswordVisibility()">
                            <i id="passwordVisibilityIcon" class="fas fa-eye"></i> <span id="passwordVisibilityText">Show</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="avatar-container">
    <?php if ($user->avatar): ?>
        <img id="avatarImage" src="data:image/jpeg;base64,<?= base64_encode($user->avatar) ?>" alt="Avatar" class="rounded-circle" style="width: 75px; height: 75px;">
    <?php else: ?>
        <div class="avatar-placeholder">
            <i class="fas fa-user"></i>
        </div>
    <?php endif; ?>
</div>
<div class="form-group mt-3">
    <label for="inputAvatar">Upload your avatar</label>
    <input name="avatar" type="file" class="form-control-file" id="inputAvatar" onchange="previewAvatar(event)">
</div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input name="address" type="text" class="form-control" id="inputAddress" value="<?= $user->address;?>">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputPhoneNumber">Phone Number</label>
                <input name="phone" type="text" class="form-control" id="inputPhoneNumber" value="<?= $user->phone;?>">
            </div>
            <div class="form-group col-md-4">
                <label for="inputRole">Role</label>
                <select name="role" id="inputRole" class="form-control">
                    <?php
                    $roles = mysqli_query($conn, "SELECT DISTINCT role FROM users");
                    while ($role = mysqli_fetch_assoc($roles)) {
                        if ($role['role'] == $user->role) {
                            echo "<option value='" . $role['role'] . "' selected>" . $role['role'] . "</option>";
                        } else {
                            echo "<option value='" . $role['role'] . "'>" . $role['role'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Edit</button>
    </form>
</div>
<?php 
if (isset($_POST['simpan'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $avatar = $_FILES['avatar']['tmp_name'];
        $avatarContent = file_get_contents($avatar);
        $avatarContent = mysqli_real_escape_string($conn, $avatarContent);
        $query = "UPDATE users SET email='$email', name='$name', role='$role', avatar='$avatarContent', phone='$phone', address='$address', password='$password', updated_at=CURRENT_TIMESTAMP WHERE id=" . $_GET['id'];
    } else {
        $query = "UPDATE users SET email='$email', name='$name', role='$role', phone='$phone', address='$address', password='$password', updated_at=CURRENT_TIMESTAMP WHERE id=" . $_GET['id'];
    }
    
    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href = './';</script>";
    } else {
        echo "Terjadi kesalahan query";
    }
    
}

require_once '../templates/footer.php'; ?>
<?php require_once '../templates/header.php'; 

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
    } else {
        $avatarContent = null;
    }

    $query = "INSERT INTO users (email, name, role, avatar, phone, address, password, created_at, updated_at) VALUES (
        '$email', '$name', '$role', '$avatarContent', '$phone', '$address', '$password', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
    )";

    if (mysqli_query($conn, $query)) {
        echo "<script>window.location.href = './';</script>";
    } else {
        echo "Terjadi kesalahan query";
    }
}

?>
<div class="container">
    <h1>Tambah User</h1>
    <a href="./" class="btn btn-danger">Kembali</a>
    <br>
    <br>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputName">Name</label>
            <input name="name" type="text" class="form-control" id="inputName" placeholder="Please input your name">
        </div>
        <div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputEmail4">Email</label>
        <input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <div class="input-group">
            <input name="password" type="password" class="form-control" id="inputPassword4" placeholder="Password">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="passwordVisibilityToggle" onclick="togglePasswordVisibility()">
                    <i id="passwordVisibilityIcon" class="fas fa-eye"></i> <span id="passwordVisibilityText">Show</span>
                </button>
            </div>
        </div>
    </div>
</div>


        <div class="form-group">
            <label for="exampleFormControlFile1">Upload your avatar</label>
            <input name="avatar" type="file" class="form-control-file" id="inputFile">
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input name="address" type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputPhoneNumber">Phone Number</label>
                <input name="phone" type="text" class="form-control" id="inputPhoneNumber" placeholder="your number">
            </div>
            <div class="form-group col-md-4">
    <label for="inputRole">Role</label>
    <select name="role" id="inputRole" class="form-control">
        <option selected>Choose...</option>
        <?php
        
        $enumValues = mysqli_query($conn, "SHOW COLUMNS FROM users WHERE Field = 'role'");
        $enumRow = mysqli_fetch_assoc($enumValues);
        $enumOptions = explode(",", str_replace("'", "", substr($enumRow['Type'], 5, (strlen($enumRow['Type'])-6))));

        foreach ($enumOptions as $option) {
            echo "<option value='" . $option . "'>" . $option . "</option>";
        }
        ?>
    </select>
</div>

        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php require_once '../templates/footer.php'; ?>
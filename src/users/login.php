<?php require_once '../templates/header.php'; 

if (isset($_SESSION['email'])) {
    // Redirect ke halaman utama jika sudah login
    header("Location: ./");
    exit();
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Query untuk mencari pengguna berdasarkan email dan password
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Periksa apakah rolenya adalah admin
        if ($row['role'] == 'admin') {
            // Simpan email ke session
            $_SESSION['email'] = $email;

            // Redirect ke halaman utama setelah login sukses
            header("Location: ./");
            exit();
        } else {
            $error_message = "Anda bukan admin.";
        }
    } else {
        $error_message = "Email atau password salah.";
    }
}
?>

<div class="container">
        <div class="row justify-content-center mt-5">
            
            <div class="col-md-6">
            <a href="../../" class="btn btn-danger mb-2">Kembali</a>
                <div class="card">
                    <div class="card-header">
                    
                        <h3 class="text-center">Halaman Login</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error_message)): ?>
                            <p class="text-danger text-center"><?php echo $error_message; ?></p>
                        <?php endif; ?>
                        <form method="POST" action="login.php">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require_once '../templates/footer.php';
?>

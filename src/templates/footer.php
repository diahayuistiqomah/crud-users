
</main>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("inputPassword4");
        var passwordVisibilityIcon = document.getElementById("passwordVisibilityIcon");
        var passwordVisibilityText = document.getElementById("passwordVisibilityText");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordVisibilityIcon.classList.remove("fa-eye");
            passwordVisibilityIcon.classList.add("fa-eye-slash");
            passwordVisibilityText.textContent = "Hide";
        } else {
            passwordInput.type = "password";
            passwordVisibilityIcon.classList.remove("fa-eye-slash");
            passwordVisibilityIcon.classList.add("fa-eye");
            passwordVisibilityText.textContent = "Show";
        }
    }
    function previewAvatar(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function () {
            var dataURL = reader.result;
            var avatarImage = document.getElementById('avatarImage');
            avatarImage.src = dataURL;
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN - SIPEKA</title>
    <link rel="shortcut icon" href="<?= URLROOT ?>/assets/images/logo/logo-pn.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="<?= URLROOT ?>/assets/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link href="<?= URLROOT ?>/assets/css/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="<?= URLROOT ?>/assets/images/logo/wave.png">
    <div class="container">
        <div class="img">
            <img src="<?= URLROOT ?>/assets/images/logo/login_av.svg">
        </div>
        <div class="login-content">
            <form method="post" action="">
                <img src="<?= URLROOT ?>/assets/images/logo/logo-pn.png">
                <h4 class="title">Pengadilan Negeri</h4>
                <h4 class=" title">Martapura Kelas 1B</h4>
                <br>
                <?php flash(); ?>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="text" name="username" class="input" value="">
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" name="password" class="input" value="">
                    </div>
                </div>
                <input type="submit" class="btn text-white" value="login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?= URLROOT ?>/assets/js/Jquery.js"></script>
    <script src="<?= URLROOT ?>/assets/vendor/global/global.min.js"></script>
    <script>
        const inputs = document.querySelectorAll(".input");


        function addcl() {
            let parent = this.parentNode.parentNode;
            parent.classList.add("focus");
        }

        function remcl() {
            let parent = this.parentNode.parentNode;
            if (this.value == "") {
                parent.classList.remove("focus");
            }
        }


        inputs.forEach(input => {
            input.addEventListener("focus", addcl);
            input.addEventListener("blur", remcl);
        });
    </script>
</body>

</html>
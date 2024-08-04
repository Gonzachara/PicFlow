<div class="login">
    <div class="col-lg-4 col-md-8 col-sm-12 bg-white border rounded p-4 shadow-sm mx-auto mt-5">
        <div class="text-center mb-4">
            <img class="mb-4" src="assets/images/pictogram.png" alt="Logo" height="45">
            <h1 class="h4 fw-normal">¿Olvidaste tu contraseña?</h1>
        </div>
        <?php
        if (isset($_SESSION['forgot_code']) && !isset($_SESSION['auth_temp'])) {
            $action = 'verifycode';
        } elseif (isset($_SESSION['forgot_code']) && isset($_SESSION['auth_temp'])) {
            $action = 'changepassword';
        } else {
            $action = 'forgotpassword';
        }
        ?>
        <form method="post" action="assets/php/actions.php?<?=$action?>">
            <div class="form-floating mb-3">
                <?php if ($action == 'forgotpassword') { ?>
                    <input type="email" name="email" class="form-control rounded-0" placeholder="username/email" required style="border-radius: 12px !important;">
                    <label for="floatingInput">Ingresa tu correo</label>
                    <?= showError('email') ?>
                    <button class="btn btn-primary w-100 mt-3" type="submit">Enviar código de verificación</button>
                <?php } ?>
            </div>

            <?php if ($action == 'verifycode') { ?>
                <p class="text-center">Ingresa el código de 6 dígitos enviado a - <?=$_SESSION['forgot_email']?></p>
                <div class="form-floating mb-3">
                    <input type="text" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="Código" required>
                    <label for="floatingPassword">Código de verificación</label>
                </div>
                <?= showError('email_verify') ?>
                <button class="btn btn-primary w-100 mt-3" type="submit">Verificar código</button>
            <?php } ?>

            <?php if ($action == 'changepassword') { ?>
                <p class="text-center">Ingresa tu nueva contraseña - <?=$_SESSION['forgot_email']?></p>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Nueva contraseña" required>
                    <label for="floatingPassword">Nueva contraseña</label>
                </div>
                <?= showError('password') ?>
                <button class="btn btn-primary w-100 mt-3" type="submit">Cambiar contraseña</button>
            <?php } ?>

            <div class="text-center mt-4">
                <a href="?login" class="text-decoration-none"><i class="bi bi-arrow-left-circle-fill"></i> Volver a Iniciar sesión</a>
            </div>
        </form>
    </div>
</div>

<style>
    body {
        background-color: #f4f4f4;
    }
    .login {
        padding: 20px;
    }
    .form-floating input {
        border-radius: 12px;
    }
    .btn-primary {
        border-radius: 12px;
    }
</style>
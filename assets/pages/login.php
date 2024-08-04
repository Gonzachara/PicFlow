<div class="login">
    <div class="col-sm-12 col-md-4 bg-white border rounded p-4 shadow-sm mx-auto mt-5">
        <form method="post" action="assets/php/actions.php?login">
            <div class="text-center mb-4">
                <img class="mb-4" src="assets/images/pictogram.png" alt="" height="45">
                <h1 class="h4 fw-normal text-center">Iniciar sesión</h1>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="username_email" class="form-control rounded-0" placeholder="username/email" style="border-radius: 12px !important;">
                <label for="floatingInput">Usuario / Correo</label>
            </div>
            <?=showError('username_email')?>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Contraseña" style="border-radius: 12px !important;">
                <label for="floatingPassword">Contraseña</label>
            </div>
            <?=showError('password')?>
            <?=showError('checkuser')?>



            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn btn-primary w-100" type="submit">Iniciar sesión</button>
            </div>
            <div class="text-center">
                <a href="?signup" class="text-decoration-none">Crear nueva cuenta</a>
                <br><br>
                <a href="?forgotpassword&newfp" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>
</div>
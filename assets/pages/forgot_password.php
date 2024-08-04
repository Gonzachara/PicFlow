
    <div class="login">
        <div class="col-lg-4 col-md-8 col-sm-12 bg-white border rounded p-4 shadow-sm">
            <?php
if(isset($_SESSION['forgot_code']) && !isset($_SESSION['auth_temp'])){
    $action = 'verifycode';
}elseif(isset($_SESSION['forgot_code']) && isset($_SESSION['auth_temp'])){
    $action = 'changepassword';
}else{
    $action= 'forgotpassword';
}
            ?>
            <form method="post" action="assets/php/actions.php?<?=$action?>">
                <div class="d-flex justify-content-center">


                </div>
                <h1 class="h5 mb-3 fw-normal">¿Olvidaste tu contraseña?</h1>
<?php
if($action=='forgotpassword'){  
    ?>
  <div class="form-floating">
                    <input type="email" name="email" class="form-control rounded-0" placeholder="username/email">
                    <label for="floatingInput">Ingresa tu correo</label>
                </div>
                <?=showError('email')?>

<br>
                <button class="btn btn-primary" type="submit">Enviar código de verificación</button>

    <?php
}
?>
   
   
   <?php
if($action=='verifycode'){
    ?>
<p>Enter 6 Digit Code Sended to You  - <?=$_SESSION['forgot_email']?></p>
                <div class="form-floating mt-1">

                    <input type="text" name="code" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">######</label>
                </div>
                <?=showError('email_verify')?>

                <br>
                <button class="btn btn-primary" type="submit">Verificar código</button>

    <?php
}
?>


<?php
if($action=='changepassword'){
    ?>
<p>Enter your new password  - <?=$_SESSION['forgot_email']?></p>
<div class="form-floating mt-1">
                    <input type="password" name="password" class="form-control rounded-0" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Nueva contraseña</label>
                </div> 
                <?=showError('password')?>

                <br>
                <button class="btn btn-primary" type="submit">Cambiar contraseña</button>


    <?php
}
?>

                 
            
                <br>
                <br>

                <a href="?login" class="text-decoration-none mt-5"><i class="bi bi-arrow-left-circle-fill"></i> Volver a
                    Iniciar sesión</a>
            </form>
        </div>
    </div>


<div class="container">
    <form class="form-signin" action="<?= BASE_URL?>login/index" method="post">
        <input type="hidden" name="enviar" value="1" />
        <div class="form-signin-heading text-center">
            <h1 class="sign-title">Iniciar Sesion</h1>
            <img src="<?= $_layoutParams['ruta_img']?>logo.png" class="img-circle" width="240" />
        </div>
        <div class="login-wrap">
            <input type="text" class="form-control" name="usuario" placeholder="Usuario" autofocus>
            <input type="password" class="form-control" name="pass" placeholder="Contraseña">
            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>
            </button>
        </div>
    </form>
</div>
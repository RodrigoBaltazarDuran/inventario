<div class="main-container">
    <form action="" method="POST" autocomplete="off" class="box login">
        <h5 class="title is-5 has-text centered is-uppercase">Sistema de inventario</h5>
        <div class="field">
            <label for="login_usuario" class="label">Usuario</label>
            <div class="control">
                <input type="text" class="input" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required />
            </div>
        </div>
        <div class="field">
            <label for="login_clave" class="label">Clave</label>
            <div class="control">
                <input type="password" class="input" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required />
            </div>
        </div>

        <p class="has-text-centered mb-4 mt-3">
            <button type="submit" class="button is-info is-rounded">Iniciar sesión</button>
        </p>

        <?php
            if (isset($_POST['login_usuario']) && isset($_POST['login_clave'])) {
                require_once "./php/main.php";
                require_once "./php/iniciar_sesion.php";
            }
        ?>

    </form>
</div>
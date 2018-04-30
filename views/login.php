<div class="login-container grey-bg">
  <div class="login-header">
    <h1>Monitoramento</h1>
  </div>
  <div class="card bg-light login-form">
    <div class="card-body">
      <div class="login-icon"><i class="fa fa-user-circle mb-5" aria-hidden="true"></i></div>

      <?PHP echo $alert; ?>

      <form method="POST">
        <div class="form-group bmd-form-group">
          <label for="email" class="bmd-label-floating">Email</label>
          <input type="text" name="email" id="email" class="form-control input-blue mb-4"/>
        </div>
        <div class="form-group bmd-form-group">
          <label for="senha" class="bmd-label-floating">Senha</label>
          <input type="password" name="senha" id="senha" class="form-control input-blue mb-5"/>
        </div>
        <input type="submit" value="Fazer Login" class="mui-btn login-submit blue"/>
        <div class="form-group login-forgot">
          <a href="<?PHP echo BASE_URL;?>password/forgot" class="light-blue">Esqueci a senha</a>
          <br>
          <a href="<?PHP echo BASE_URL;?>cadastrar" class="light-blue">Cadastrar-se</a>
        </div>
      </form>
    </div>
  </div>
</div>

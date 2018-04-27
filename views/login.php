<div class="login-container grey-bg">
  <div class="login-header">
    <h1>Monitoramento</h1>
  </div>
  <div class="card bg-light login-form">
    <div class="card-body">
      <div class="login-icon"><i class="fa fa-user-circle" aria-hidden="true"></i></div>

      <?PHP echo $alert; ?>

      <form method="POST">
        <div class="form-group">
  <!--        <label for="email">Email:</label>-->
          <input type="email" name="email" id="email" placeholder="Email" class="form-control input-blue"/>
        </div>
        <div class="form-group">
  <!--        <label for="senha">Senha:</label>-->
          <input type="password" name="senha" id="senha" placeholder="Senha" class="form-control input-blue"/>
        </div>
        <input type="submit" value="Fazer Login" class="mui-btn login-submit blue"/>
        <div class="form-group login-forgot">
          <a href="<?PHP echo BASE_URL;?>password/forgot">Esqueci a senha</a>
          <br>
          <a href="<?PHP echo BASE_URL;?>cadastrar">Cadastrar-se</a>
        </div>
      </form>
    </div>
  </div>
</div>

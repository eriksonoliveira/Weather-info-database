<div class="login-container">
  <div class="login-header">
    <h1>Monitoramento</h1>
  </div>
  <div class="login-form">
    <div class="login-icon"><i class="fa fa-user-circle" aria-hidden="true"></i></div>

    <?PHP echo $alert; ?>

    <form method="POST">
      <div class="form-group">
<!--        <label for="email">Email:</label>-->
        <input type="email" name="email" id="email" placeholder="Email" class="form-control"/>
      </div>
      <div class="form-group">
<!--        <label for="senha">Senha:</label>-->
        <input type="password" name="senha" id="senha" placeholder="Email" class="form-control"/>
      </div>
      <input type="submit" value="Fazer Login" class="btn btn-primary login-submit"/>
      <div class="form-group login-forgot"><a href="<?PHP echo BASE_URL;?>password/forgot">Esqueci a senha</a></div>
    </form>
  </div>
</div>

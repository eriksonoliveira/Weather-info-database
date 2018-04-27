<div class="pass-forg-container grey-bg">
  <div id="pass-recov-content" class="card">
    <div class="card-body">

      <?PHP if(checked) { ?>
      <div class='card-title'>
        <h2>Digite a sua nova senha</h2>
      </div>
      <form method='POST' class='pass-recov-form'>
        <div class='form-group'>
          <label>Nova senha:</label>
          <input type='password'  class='form-control' name='password1' data-id='".$id."'/>
          <br>
          <label>Repita a senha:</label>
          <input type='password'  class='form-control' name='password2'/>
          <br>
          <button type='submit' class='btn blue'>Atualizar senha</button>
        </div>
      </form>
      <?PHP } else { ?>

      <h2>O link é inválido ou a solicitação expirou.</h2>

      <?PHP } ?>
    </div>
  </div>
</div>

<script src="<?PHP echo BASE_URL;?>assets/js/password-recovery.js"></script>

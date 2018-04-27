<div class="user-container grey-bg">

  <div class="card user-edit" style="max-width: 550px;">
    <div class="card-body">
      <div class="card-title">
        <h2 class="user-name"><?PHP echo $user['nome'];?></h2>
      </div>
      <form method="POST" class="user-edit-form">
        <div class="form-group">
          <input type="text" class="form-control input-blue" name="name" placeholder="Nome" value="<?PHP echo $user['nome']; ?>" data-id="<?PHP echo $user['id'];?>"/>
          <input type="email" class="form-control input-blue" name="email" placeholder="Email de cadastro" value="<?PHP echo $user['email']; ?>"/>
          <?PHP if($_SESSION['permission'] == 'admin'):?>
          <div class="form-check custom-control custom-checkbox">
            <input id="make-admin" type="checkbox" class="custom-control-input" <?PHP echo ($user['permissoes'] == 'admin') ? 'checked': ''; ?>/>
            <label class="custom-control-label" for="make-admin">Administrador</label>
          </div>
          <?PHP endif; ?>
          <button type="submit" class="btn blue">Salvar</button>
        </div>
      </form>
      <p class="card-text user-success-msg" style="display: none;"><small class="text-muted">Atualizações Salvas</small></p>
    </div>
</div>
</div>


<script src="<?php echo BASE_URL;?>assets/js/user-page.js"></script>

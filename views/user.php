<div class="user-container">

  <div class="card user-edit" style="max-width: 550px;">
    <div class="card-body">
      <div class="card-title">
        <h2 class="user-name"><?PHP echo $user['nome'];?></h2>
      </div>
      <form method="POST" class="user-edit-form">
        <div class="form-group">
          <input type="text" class="form-control" name="name" placeholder="Nome"/><br>
          <input type="email" class="form-control" name="email" placeholder="Email de cadastro"/><br>
          <?PHP if($_SESSION['permission'] == 'admin'):?>
            <labe for="make-admin">Administrador:</labe>
            <input id="make-admin" type="checkbox" class="form-control"/>
          <?PHP endif; ?>
          <button type="submit" class="btn blue">Salvar</button>
        </div>
      </form>
    </div>
</div>
</div>


<script src="<?php echo BASE_URL;?>assets/js/user-page.js"></script>

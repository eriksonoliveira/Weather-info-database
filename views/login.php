<div class="container">
  <h1>Log In</h1>
  
  <?PHP echo $alert; ?>
  
  <form method="POST">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" class="form-control"/>
    </div>    
    <div class="form-group">
      <label for="senha">Senha:</label>
      <input type="password" name="senha" id="senha" class="form-control"/>
    </div>
    <input type="submit" value="Fazer Login" class="btn btn-default"/>
  </form>
</div>
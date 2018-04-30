<div class="container cadastrar-container">
  <div class="card cadastrar-content" style="width: 60%; min-width: 300px;">
    <div class="card-body">
      <div class="card-title">
        <h1>Cadastre-se</h1>
      </div>

      <?PHP echo $success; ?>
      <?PHP echo $failure; ?>
      <?PHP echo $warning; ?>

      <form method="POST">
        <div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" name="nome" id="nome" class="form-control"/>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" class="form-control"/>
        </div>
        <div class="form-group">
          <label for="senha">Senha:</label>
          <input type="password" name="senha" id="senha" class="form-control"/>
        </div>
        <div class="form-group">
          <label for="funcao">Função:</label>
          <select type="text" name="funcao" id="funcao" class="custom-select">
            <option selected></option>
            <option value="Meteorologista">Meteorologista</option>
            <option value="Tecnico">Técnico</option>
          </select>
        </div>
        <input type="submit" value="Cadastrar" class="btn btn-default"/>
      </form>
    </div>
  </div>
</div>

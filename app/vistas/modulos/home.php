<div class="col-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Bienvenido, <?php echo $_SESSION["user_name"] ?? "Usuario"; ?>!</h5>
      <h5 class="card-title">ID del Usuario: <?php echo $_SESSION["USER_ID"] ?? "ROL"; ?></h5>
      <h5 class="card-title">ID del Rol: <?php echo $_SESSION["ROLE_ID"] ?? "ROLE_ID"; ?></h5>
      <p class="card-text">Selecciona una opción del menú lateral para comenzar.</p>
    </div>
  </div>
</div>

<?php
$users = UserController::ctrGetAllUsers();
?>

<section class="section">

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title">Usuarios registrados</h5>
                <!-- Basic Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
                  Agregar Usuario
                </button>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b> Nombre </b>
                    </th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th data-type="date" data-format="YYYY/DD/MM">Fecha de Registro</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($users)):?>
                    <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?= htmlspecialchars($user["user_name"],ENT_QUOTES,'UTF-8')?></td>
                    <td><?= htmlspecialchars($user["user_email"],ENT_QUOTES,'UTF-8')?></td>
                    <td style="width: 100px; text-aling: center;">************</td>
                    <td><?= htmlspecialchars($user["user_datatime"],ENT_QUOTES,'UTF-8')?></td>
                    <td class="text-center">
                      <button class="btn btn-sm btn-warning me-1" 
                      data-bs-toggle="modal"
                      data-bs-target="#editUserModal"
                      data-id="<?php echo $user["pk_id_user"] ?>"
                      data-name="<?php echo htmlspecialchars($user["user_name"]) ?>"
                      data-email="<?php echo htmlspecialchars($user["user_email"]) ?>"
                      >
                      Editar
                    </button>
                    <a
                      href="index.php?route=users&action=delete&id=<?= $user["pk_id_user"] ?>"
                      class="btn btn-danger btn-sm"
                    >
                      Eliminar
                    </a>
                  </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->
            </div>
          </div>
        </div>
      </div>
    </section>

<div class="modal fade" id="largeModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Basic Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <h5 class="card-title">Agregar usuario</h5>
        <form method="POST" action="index.php?route=users&action=save">
          <div class="row mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" name="userName" class="form-control" id="inputText">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Correo</label>
            <div class="col-sm-10">
              <input type="email" name="userEmail" class="form-control" id="inputEmail">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>
            <div class="col-sm-10">
              <input type="password" name="userPassword" class="form-control" id="inputPassword">
            </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form><!-- End Form -->
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->


        <!--Modal editar usuario-->

<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="index.php?route=users&action=update">
      <div class="modal-body">
        <input type="hidden" name="userId" id="editUserId">
  <div class="row mb-3">
    <label for="inputText" class="col-sm-2 col-form-label">Nombre</label>
    <div class="col-sm-10">
      <input type="text" name="userName" class="form-control" id="editUserName">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputEmail" class="col-sm-2 col-form-label">Correo</label>
    <div class="col-sm-10">
      <input type="email" name="userEmail" class="form-control" id="editUserEmail">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña</label>
    <div class="col-sm-10">
      <input type="password" name="userPassword" class="form-control" id="editUserPassword" placeholder="Dejar en blanco si no deseas cambiarla">
    </div>
  </div>
  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
  </form><!-- End Form -->
</div><!-- End Basic Modal-->


<script>
  const editUserModal = document.getElementById('editUserModal');

      editUserModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const email = button.getAttribute('data-email');

        document.getElementById('editUserId').value = id;
        document.getElementById('editUserName').value = name;
        document.getElementById('editUserEmail').value = email;
        
        
       });

</script>
<?php
$roles = RoleController::ctrGetAllRoles();
?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Roles registrados</h5>
            <!-- Basic Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
              Agregar Rol
            </button>
          </div>

        <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>
                    <b> Rol </b>
                  </th>
                  <th>Descripcion</th>
                  <th data-type="date" data-format="YYYY/DD/MM">Fecha de Registro</th>
                  <th>Acciones</th> <!-- Nueva columna -->
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($roles)):?>
                  <?php foreach ($roles as $rol): ?>
                <tr>
                  <td><?= htmlspecialchars($rol["role_name"],ENT_QUOTES,'UTF-8')?></td>
                  <td><?= htmlspecialchars($rol["role_description"],ENT_QUOTES,'UTF-8')?></td>
                  <td><?= htmlspecialchars($rol["role_datatime"],ENT_QUOTES,'UTF-8')?></td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-warning me-1"
                      data-bs-toggle="modal"
                      data-bs-target="#editRoleModal"
                      data-id="<?= $rol["pk_id_role"] ?>"
                      data-name="<?= htmlspecialchars($rol["role_name"]) ?>"
                      data-description="<?= htmlspecialchars($rol["role_description"]) ?>"
                    >
                      Editar
                    </button>
                    <a href="index.php?route=roles&action=delete&id=<?= $rol["pk_id_role"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro de eliminar el rol?')">Eliminar</a>
                  </td>
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
        <form method="POST" action="index.php?route=role&action=save" >
        <div class="row mb-3">
        <label for="inputRole" class="col-sm-2 col-form-label">Nombre Rol</label>
        <div class="col-sm-10">
            <input type="text" name="roleName" class="form-control" id="inputRole">
        </div>
        </div>
        <div class="row mb-3">
        <label for="inputDescription" class="col-sm-2 col-form-label">Descripción</label>
        <div class="col-sm-10">
            <input type="text" name="roleDescription" class="form-control" id="inputDescription">
        </div>
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
        </form><!-- End Form -->
      </div>
    </div>
  </div>
</div><!-- End Basic Modal-->

<!-- Modal Editar Rol -->
<div class="modal fade" id="editRoleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="index.php?route=roles&action=update">
        <div class="modal-header">
          <h5 class="modal-title">Editar Rol</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="roleId" id="editRoleId">
          <div class="mb-3">
            <label for="editRoleName" class="form-label">Nombre Rol</label>
            <input type="text" class="form-control" id="editRoleName" name="roleName" required>
          </div>
          <div class="mb-3">
            <label for="editRoleDescription" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="editRoleDescription" name="roleDescription" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var editRoleModal = document.getElementById('editRoleModal');
  if (editRoleModal) {
    editRoleModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var roleId = button.getAttribute('data-id');
      var roleName = button.getAttribute('data-name');
      var roleDescription = button.getAttribute('data-description');

      document.getElementById('editRoleId').value = roleId;
      document.getElementById('editRoleName').value = roleName;
      document.getElementById('editRoleDescription').value = roleDescription;
    });
  }
});
</script>
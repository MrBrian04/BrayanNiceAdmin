<?php
$roles = RoleController::ctrGetAllRoles();
?>

<section class="section">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h5 class="card-title">Roles registrados</h5>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
                Agregar Rol
              </button>
            </div>

            <table class="table datatable">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Fecha de Registro</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($roles)): ?>
                  <?php foreach ($roles as $rol): ?>
                    <tr>
                      <td><?= htmlspecialchars($rol["role_name"], ENT_QUOTES, 'UTF-8') ?></td>
                      <td><?= htmlspecialchars($rol["role_description"], ENT_QUOTES, 'UTF-8') ?></td>
                      <td><?= htmlspecialchars($rol["role_datatime"], ENT_QUOTES, 'UTF-8') ?></td>
                      <td class="text-center">
                        <button class="btn btn-sm btn-warning me-1"
                          data-bs-toggle="modal"
                          data-bs-target="#editRoleModal"
                          data-id="<?= $rol["pk_id_role"] ?>"
                          data-name="<?= htmlspecialchars($rol["role_name"], ENT_QUOTES, 'UTF-8') ?>"
                          data-description="<?= htmlspecialchars($rol["role_description"], ENT_QUOTES, 'UTF-8') ?>">
                          Editar
                        </button>
                        <a href="index.php?route=roles&action=delete&id=<?= $rol["pk_id_role"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro de eliminar el rol?')">Eliminar</a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
</section>

<!-- Modal para Agregar Rol -->
<div class="modal fade" id="largeModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Rol</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="index.php?route=roles&action=save">
          <div class="row mb-3">
            <label for="roleName" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" name="roleName" class="form-control" id="roleName" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="roleDescription" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
              <textarea name="roleDescription" class="form-control" id="roleDescription" rows="3" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal para Editar Rol -->
<div class="modal fade" id="editRoleModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="POST" action="index.php?route=roles&action=update">
        <div class="modal-header">
          <h5 class="modal-title">Editar Rol</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="roleId" id="editRoleId">
          <div class="row mb-3">
            <label for="editRoleName" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
              <input type="text" name="roleName" class="form-control" id="editRoleName" required>
            </div>
          </div>
          <div class="row mb-3">
            <label for="editRoleDescription" class="col-sm-2 col-form-label">Descripción</label>
            <div class="col-sm-10">
              <textarea name="roleDescription" class="form-control" id="editRoleDescription" rows="3" required></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Llenar datos del modal de edición de rol
  const editRoleModal = document.getElementById('editRoleModal');
  editRoleModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const roleId = button.getAttribute('data-id');
    const roleName = button.getAttribute('data-name');
    const roleDescription = button.getAttribute('data-description');

    document.getElementById('editRoleId').value = roleId;
    document.getElementById('editRoleName').value = roleName;
    document.getElementById('editRoleDescription').value = roleDescription;
  });

  
  // Buscador manual de roles
  document.getElementById('roleSearchInput').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('.table.datatable tbody tr');
    rows.forEach(row => {
      const name = row.children[0].textContent.toLowerCase();
      const desc = row.children[1].textContent.toLowerCase();
      if (name.includes(searchValue) || desc.includes(searchValue)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });

  // Inicializar datatable (opcional, puedes quitar si no usas la librería)
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".datatable").forEach(function(table) {
      new simpleDatatables.DataTable(table);
    });
  });
</script>

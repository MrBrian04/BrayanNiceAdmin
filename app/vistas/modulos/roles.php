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
                  
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($roles)):?>
                  <?php foreach ($roles as $rol): ?>
                <tr>
                  <td><?= htmlspecialchars($rol["role_name"],ENT_QUOTES,'UTF-8')?></td>
                  <td><?= htmlspecialchars($rol["role_description"],ENT_QUOTES,'UTF-8')?></td>
                  <td><?= htmlspecialchars($rol["role_datatime"],ENT_QUOTES,'UTF-8')?></td>
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
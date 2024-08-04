<?php if(isset($_SESSION['Auth'])): ?>
  <!-- Modal para Crear Nuevo Post -->
  <div class="modal fade" id="addpost" tabindex="-1" aria-labelledby="addpostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addpostLabel">Crear Nuevo Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <img src="" style="display:none" id="post_img" class="w-100 rounded border">
          <form method="post" action="assets/php/actions.php?addpost" enctype="multipart/form-data">
            <div class="mb-3">
              <input class="form-control" name="post_img" type="file" id="select_post_img" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="post_text" class="form-label">Escribe Algo</label>
              <textarea name="post_text" class="form-control" id="post_text" rows="3" placeholder="Comparte tus pensamientos..."></textarea>
            </div>
            <div class="mb-3">
              <label for="post_location" class="form-label">Ubicación (opcional)</label>
              <input type="text" class="form-control" id="post_location" name="post_location" placeholder="Añade una ubicación...">
            </div>
            <div class="mb-3">
              <label for="post_tags" class="form-label">Etiquetas (opcional)</label>
              <input type="text" class="form-control" id="post_tags" name="post_tags" placeholder="Ej: viaje, comida, amigos">
              <small class="form-text text-muted">Separe las etiquetas con comas.</small>
            </div>
            <button type="submit" class="btn btn-primary">Publicar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Sidebar de Notificaciones -->
  <div class="offcanvas offcanvas-start" id="notification_sidebar" aria-labelledby="notificationSidebarLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="notificationSidebarLabel">Notificaciones</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body">
      <?php
      $notifications = getNotifications();
      foreach($notifications as $not):
        $time = $not['created_at'];
        $fuser = getUser($not['from_user_id']);
        $post = $not['post_id'] ? 'data-bs-toggle="modal" data-bs-target="#postview'.$not['post_id'].'"' : '';
      ?>
        <div class="d-flex justify-content-between border-bottom py-2">
          <div class="d-flex align-items-center">
            <img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="Foto de Perfil" class="rounded-circle border" height="40" width="40">
            <div class="ms-2">
              <a href='?u=<?=$fuser['username']?>' class="text-decoration-none text-dark">
                <h6 class="m-0"><?=$fuser['first_name']?> <?=$fuser['last_name']?></h6>
              </a>
              <p class="m-0 text-muted">@<?=$fuser['username']?> <?=$not['message']?></p>
              <time class="text-muted" datetime="<?=$time?>"></time>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <?php if($not['read_status'] == 0): ?>
              <div class="p-1 bg-primary rounded-circle"></div>
            <?php elseif($not['read_status'] == 2): ?>
              <span class="badge bg-danger">Posteo Eliminado</span>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Sidebar de Mensajes -->
  <div class="offcanvas offcanvas-start" id="message_sidebar" aria-labelledby="messageSidebarLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="messageSidebarLabel">Mensajes</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body" id="chatlist"></div>
  </div>

  <!-- Modal de Chat -->
  <div class="modal fade" id="chatbox" tabindex="-1" aria-labelledby="chatboxLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <a href="" id="cplink" class="text-decoration-none text-dark">
            <h5 class="modal-title" id="chatboxLabel">
              <img src="assets/images/profile/default_profile.jpg" id="chatter_pic" height="40" width="40" class="m-1 rounded-circle border">
              <span id="chatter_name"></span> (@<span id="chatter_username">cargando..</span>)
            </h5>
          </a>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body d-flex flex-column-reverse gap-2" id="user_chat">Cargando..</div>
        <div class="modal-footer">
          <p class="p-2 text-danger mx-auto" id="blerror" style="display:none">
            <i class="bi bi-x-octagon-fill"></i> No puedes enviar mensajes a este usuario
          </p>
          <div class="input-group p-2" id="msgsender">
            <input type="text" class="form-control rounded-0 border-0" id="msginput" placeholder="Escribe algo.." aria-label="Mensaje">
            <button class="btn btn-outline-primary rounded-0 border-0" id="sendmsg" data-user-id="0" type="button">Enviar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="height: 250px;"></div>

  <!-- Footer -->
  <footer class="footer bg-dark text-white py-4 fixed-bottom">
    <div class="container text-center">
        <div class="d-flex justify-content-center mb-3">
            <a href="#" class="text-white me-3"><i class="bi bi-facebook fs-3"></i></a>
            <a href="#" class="text-white me-3"><i class="bi bi-twitter fs-3"></i></a>
            <a href="#" class="text-white me-3"><i class="bi bi-instagram fs-3"></i></a>
        </div>
        <p class="mb-0">&copy; <?= date('Y') ?> Pictogram - Todos los derechos reservados.</p>
        <p class="mb-0">Desarrollado por <a href="https://instagram.com/gonzaachara" target="_blank" class="text-white">Gonzalo Chiaradia</a></p>
    </div>
</footer>

<!-- Scripts -->
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/jquery.timeago.js"></script>
<script src="assets/js/custom.js?v=<?=time()?>"></script>
<?php endif; ?>

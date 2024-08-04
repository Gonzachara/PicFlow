<?php
global $profile;
global $profile_post;
global $user;
?>
    <div class="container col-md-9 col-sm-11 rounded-0">
        <div class="col-12 rounded p-4 mt-4 d-md-flex gap-5">
            <div class="col-md-4 col-sm-12 d-flex justify-content-center mx-auto align-items-start"><div class="px-md-5"></div><img src="assets/images/profile/<?=$profile['profile_pic']?>"
                    class="img-thumbnail rounded-circle mb-3" style="width:170px;height:170px" alt="...">
            </div>
            <div class="col-md-8 col-sm-11">
                <div class="d-flex flex-column">
                    <div class="d-flex gap-5 align-items-center">
                        <span style="font-size: xx-large;"><?=$profile['first_name']?> <?=$profile['last_name']?></span>
                        
                        <?php
if($user['id']!=$profile['id'] && !checkBS($profile['id'])){
    ?>
  <div class="dropdown">
                            <span class="" style="font-size:xx-large" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i> </span>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#chatbox" onclick="popchat(<?=$profile['id']?>)"><i class="bi bi-chat-fill"></i> Enviar mensaje</a></li>
                                <li><a class="dropdown-item " href="assets/php/actions.php?block=<?=$profile['id']?>&username=<?=$profile['username']?>"><i class="bi bi-x-circle-fill"></i> Bloquear</a></li>
                            </ul>
                        </div>
    <?php
}
                        ?>
                      


                    </div>
                    <span style="font-size: larger;" class="text-secondary">@<?=$profile['username']?></span>
                    <?php
if(!checkBS($profile['id'])){
    ?>
 <div class="d-flex gap-2 align-items-center my-3">

<a class="btn btn-sm btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 48 48">
	<rect width="48" height="48" fill="none" />
	<g fill="none" stroke="white" stroke-width="4">
		<path d="M39.3 6H8.7A2.7 2.7 0 0 0 6 8.7v30.6A2.7 2.7 0 0 0 8.7 42h30.6a2.7 2.7 0 0 0 2.7-2.7V8.7A2.7 2.7 0 0 0 39.3 6Z" />
		<path stroke-linecap="round" d="M24 6v36M6 24h36" />
	</g>
</svg> <?=count($profile_post)?> Posteos</a>
<a class="btn btn-sm btn-primary <?=count($profile['followers'])<1?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#follower_list"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
	<rect width="24" height="24" fill="none" />
	<path fill="white" d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3s1.34 3 3 3m-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5S5 6.34 5 8s1.34 3 3 3m0 2c-2.33 0-7 1.17-7 3.5V18c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-1.5c0-2.33-4.67-3.5-7-3.5m8 0c-.29 0-.62.02-.97.05c.02.01.03.03.04.04c1.14.83 1.93 1.94 1.93 3.41V18c0 .35-.07.69-.18 1H22c.55 0 1-.45 1-1v-1.5c0-2.33-4.67-3.5-7-3.5" />
</svg> <?=count($profile['followers'])?> Seguidores</a>
<a class="btn btn-sm btn-primary <?=count($profile['following'])<1?'disabled':''?>" data-bs-toggle="modal" data-bs-target="#following_list"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
	<rect width="24" height="24" fill="none" />
	<path fill="white" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4" />
</svg> <?=count($profile['following'])?> Siguiendo</a>


</div>
    <?php

}
                    ?>
                   
<?php


if($user['id']!=$profile['id']){
?>
 <div class="d-flex gap-2 align-items-center my-1">
<?php
if(checkBlockStatus($user['id'],$profile['id'])){
?> 
<button class="btn btn-sm btn-danger unblockbtn" data-user-id='<?=$profile['id']?>' >Desbloquear</button>

<?php
}else if(checkBlockStatus($profile['id'],$user['id'])){ ?>
    <div class="alert alert-danger" role="alert">
    <i class="bi bi-x-octagon-fill"></i> @<?=$profile['username']?> ¡Te bloqueó!
</div>
   <?php }else if(checkFollowStatus($profile['id'])){
   ?>
<button class="btn btn-sm btn-danger unfollowbtn" data-user-id='<?=$profile['id']?>' >Dejar de seguir</button>
   
   <?php
}else{
    ?>
<button class="btn btn-sm btn-primary followbtn" data-user-id='<?=$profile['id']?>' >Seguir</button>

    <?php
}
?>



</div>
<?php
}
?>
                   
                </div>
            </div>


        </div>
        <h3 class="border-bottom">Posteos</h3>
        <?php

if(checkBS($profile['id'])){
    $profile_post = array();

   ?>
 <div class="alert alert-secondary text-center" role="alert">
    <i class="bi bi-x-octagon-fill"></i> ¡No podés ver los posteos de este usuario!
</div>
   <?php
    
}else if(count($profile_post)<1){
    echo "<p class='p-2 bg-white border rounded text-center my-3'>Este usuario no tiene posteos</p>";
}
        ?>
        <div class="gallery d-flex flex-wrap gap-2 mb-4">
            <?php
               
foreach($profile_post as $post){
    $likes = getLikes($post['id']);

    ?>
            <img src="assets/images/posts/<?=$post['post_img']?>" data-bs-toggle="modal" data-bs-target="#postview<?=$post['id']?>" width="300px" class="rounded" />
       
            <div class="modal fade" id="postview<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body d-md-flex p-0">
                    <div class="col-md-8 col-sm-12">
                        <img src="assets/images/posts/<?=$post['post_img']?>" style="max-height:90vh" class="w-100 rounded-start">
                    </div>



                    <div class="col-md-4 col-sm-12 d-flex flex-column">
                        <div class="d-flex align-items-center p-2 <?=$post['post_text']?'':'border-bottom'?>">
                            <div><img src="assets/images/profile/<?=$profile['profile_pic']?>" alt="" height="50" width="50" class="rounded-circle border">
                            </div>
                            <div>&nbsp;&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-start">
                                <h6 style="margin: 0px;"><?=$profile['first_name']?> <?=$profile['last_name']?></h6>
                                <p style="margin:0px;" class="text-muted">@<?=$profile['username']?></p>
                            </div>

                            <div class="d-flex flex-column align-items-end flex-fill">
                <div class="" ></div>
                <div class="dropdown">
  <span class="<?=count($likes)<1?'disabled':''?>" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <?=count($likes)?> Likes
</span>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  <?php
  foreach($likes as $like){
      $lu = getUser($like['user_id']);
      ?>
  <li><a class="dropdown-item" href="?u=<?=$lu['username']?>"><?=$lu['first_name'].' '.$lu['last_name']?> (@<?=$lu['username']?>)</a></li>

      <?php
  }
  ?> 
    
  </ul>
</div>
                <div style="font-size:small" class="text-muted">Posteado <?=show_time($post['created_at'])?> </div> 
                 
</div>
                        </div>
<div class="border-bottom p-2 <?=$post['post_text']?'':'d-none'?>"><?=$post['post_text']?> </div>


                        <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?=$post['id']?>" style="height: 100px;">

                          <?php
$comments = getComments($post['id']);
if(count($comments)<1){
    ?>
<p class="p-3 text-center my-2 nce">No hay comentarios</p>
    <?php
}
foreach($comments as $comment){
    $cuser = getUser($comment['user_id']);
    ?>
<div class="d-flex align-items-center p-2">
                                <div><img src="assets/images/profile/<?=$cuser['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-start">
                                    <h6 style="margin: 0px;"><a href="?u=<?=$cuser['username']?>" class="text-decoration-none text-muted">@<?=$cuser['username']?></a> - <?=$comment['comment']?></h6>
                                    <p style="margin:0px;" class="text-muted"><?=show_time($comment['created_at'])?></p>
                                </div>
                            </div>

    <?php
}
                          ?>

                            
                          

                           

                        </div>
                        <?php
                        if(checkFollowStatus($profile['id']) || $profile['id']==$user['id']){
                            ?>
  <div class="input-group p-2 border-top">
                            <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="Escribe algo.."
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                id="button-addon2">Postear</button>
                        </div>
                            <?php
                        }else{
                            ?>
<div class="text-center p-2">
Si querés comentar, seguí a este usuario</div>
                        
                            <?php
                        }
                        ?>
                      
                    </div>



                </div>

            </div>
        </div>
    </div>
    <?php
}
            ?>
           

        </div>




    </div>

  
    <!-- Modal -->
    
    


    <!-- this is for follower list -->
    <div class="modal fade" id="follower_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seguidores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
foreach($profile['followers'] as $f){
    $fuser = getUser($f['follower_id']);
    $fbtn='';
    if(checkFollowStatus($f['follower_id'])){
        $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" data-user-id='.$fuser['id'].' >Dejar de seguir</button>';
    }else if($user['id']==$f['follower_id']){
        $fbtn='';
    }else{
        $fbtn = '<button class="btn btn-sm btn-primary followbtn" data-user-id='.$fuser['id'].' >Seguir</button>';

    }
    ?>
<div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href='?u=<?=$fuser['username']?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;"><?=$fuser['first_name']?> <?=$fuser['last_name']?></h6></a>
                            <p style="margin:0px;font-size:small" class="text-muted">@<?=$fuser['username']?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <?=$fbtn?>

                    </div>
                </div>
    <?php
}
                ?>
            </div>
   
        </div>
  </div>
</div>



<!-- this is for following list -->
<div class="modal fade" id="following_list" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Siguiendo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
foreach($profile['following'] as $f){
    $fuser = getUser($f['user_id']);
    $fbtn='';
    if(checkFollowStatus($f['user_id'])){
        $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" data-user-id='.$fuser['id'].' >Dejar de seguir</button>';
    }else if($user['id']==$f['user_id']){
        $fbtn='';
    }else{
        $fbtn = '<button class="btn btn-sm btn-primary followbtn" data-user-id='.$fuser['id'].' >Seguir</button>';

    }
    ?>
<div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center p-2">
                        <div><img src="assets/images/profile/<?=$fuser['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
                        </div>
                        <div>&nbsp;&nbsp;</div>
                        <div class="d-flex flex-column justify-content-center">
                            <a href='?u=<?=$fuser['username']?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;"><?=$fuser['first_name']?> <?=$fuser['last_name']?></h6></a>
                            <p style="margin:0px;font-size:small" class="text-muted">@<?=$fuser['username']?></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <?=$fbtn?>

                    </div>
                </div>
    <?php
}
                ?>
            </div>
   
        </div>
  </div>
</div>
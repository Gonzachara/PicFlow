    <?php
    global $user;
    global $posts;
    global $follow_suggestions;
    
    ?>
        <div class="container col-md-10 col-sm-12 col-lg-9 rounded-0 d-flex justify-content-between">
            <div class="col-md-8 col-sm-12" style="max-width:93vw">

            
                <?php
            
                showError('post_img');
                if(count($posts)<1){
                    echo "<p style='max-width: 40vw; margin: 20px auto; padding: 15px; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; text-align: center; font-size: 1.2em; color: #495057;'>Seguí a alguien o publicá algo</p>";
                }
    foreach($posts as $post){
        $likes = getLikes($post['id']);
        $comments = getComments($post['id']);
        ?>
        <div class="card mt-4">
                    <div class="card-title d-flex justify-content-between  align-items-center">

                        <div class="d-flex align-items-center p-2">
                        <img src="assets/images/profile/<?=$post['profile_pic']?>" alt="Foto de perfil de <?=$post['first_name']?> <?=$post['last_name']?>" height="30" width="30" class="rounded-circle border">&nbsp;&nbsp;<a href='?u=<?=$post['username']?>' class="text-decoration-none text-dark" aria-label="perfil de <?=$post['first_name']?> <?=$post['last_name']?>"><?=$post['first_name']?> <?=$post['last_name']?></a>
                        </div>
                        <div class="p-2">
                            <?php
    if($post['uid']==$user['id']){
        ?>

    <div class="dropdown">

    <i class="bi bi-three-dots-vertical" id="option<?=$post['id']?>" data-bs-toggle="dropdown" aria-expanded="false"></i>

    <ul class="dropdown-menu" aria-labelledby="option<?=$post['id']?>">
        <li><a class="dropdown-item" href="assets/php/actions.php?deletepost=<?=$post['id']?>"><i class="bi bi-trash-fill"></i> Eliminar publicación</a></li>
    </ul>
    </div>
        <?php
    }
                            ?>
                        
                        </div>
                    </div>
                    <img src="assets/images/posts/<?=$post['post_img']?>" loading=lazy class="" alt="...">
                    <h4 style="font-size: x-larger" class="p-2 border-bottom d-flex">
                <span>
                <?php
    if(checkLikeStatus($post['id'])){
    $like_btn_display='none';
    $unlike_btn_display='';
    }else{
        $like_btn_display='';
        $unlike_btn_display='none';  
    }
        ?>
                    <i class="bi bi-heart-fill unlike_btn text-danger" style="display:<?=$unlike_btn_display?>; cursor:pointer;" data-post-id='<?=$post['id']?>'></i>
                    <i class="bi bi-heart like_btn" style="display:<?=$like_btn_display?>; cursor:pointer;" data-post-id='<?=$post['id']?>'></i>

                    </span>
                    &nbsp;&nbsp;<i
                            class="bi bi-chat-left d-flex align-items-center"><span class="p-1 mx-2 text-small" style="font-size:small; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#postview<?=$post['id']?>"><?=count($comments)?> comments</span></i> 
                            
                    </h4>
                    <div>
                    <span class="p-1 mx-2" data-bs-toggle="modal" data-bs-target="#likes<?=$post['id']?>"><span id="likecount<?=$post['id']?>"><?=count($likes)?></span> likes</span>
                    <span style="font-size:small" class="text-muted">Posteado</span> <?=show_time($post['created_at'])?> 
                    
    </div>
                    <?php
    if($post['post_text']){
        ?>
    <div class="border p-2 my-2 <?=$post['post_text']?'':'d-none'?>"><?=$post['post_text']?> </div>
        <?php
    }
                    ?>
                    <div class="input-group p-2 <?=$post['post_text']?'border-top':''?>">
                    
                            <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="Escribe algo.."
                                    aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page='wall' data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                    id="button-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 14 14">
                                    <rect width="14" height="14" fill="none" />
                                    <path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" d="m5.812 11l2.178 2.168a1.1 1.1 0 0 0 1.05.3a1.119 1.119 0 0 0 .809-.74l3.576-10.72A1.118 1.118 0 0 0 11.987.57L1.267 4.147a1.119 1.119 0 0 0-.74.859a1.099 1.099 0 0 0 .3 1l2.737 2.737l-.09 3.466zM13.106.79L3.564 8.742" />
                                </svg></button>
                    </div>

                </div>
                <div class="modal fade" id="postview<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-body d-md-flex p-0">
                        <div class="col-md-8 col-sm-12">
                            <img src="assets/images/posts/<?=$post['post_img']?>" style="max-height:90vh" class="w-100 overflow:hidden">
                        </div>



                        <div class="col-md-4 col-sm-12 d-flex flex-column">
                            <div class="d-flex align-items-center p-2 border-bottom">
                                <div><img src="assets/images/profile/<?=$post['profile_pic']?>" alt="" height="50" width="50" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start">
                                    <h6 style="margin: 0px;"><?=$post['first_name']?> <?=$post['last_name']?></h6>
                                    <p style="margin:0px;" class="text-muted">@<?=$post['username']?></p>
                                </div>
                                <div class="d-flex flex-column align-items-end flex-fill">
                    <div class="" ></div>
                    <div class="dropdown">
    <span class="<?=count($likes)<1?'disabled':''?>" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" title="Ver quiénes han dado like">
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


                            <div class="flex-fill align-self-stretch overflow-auto" id="comment-section<?=$post['id']?>" style="height: 100px;">

                            <?php
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
                                        <h6 style="margin: 0px;"><a href="?u=<?=$cuser['username']?>" class="text-decoration-none text-dark text-small text-muted">@<?=$cuser['username']?></a> - <?=$comment['comment']?></h6>
                                        <p style="margin:0px;" class="text-muted">(<?=show_time($comment['created_at'])?>)</p>
                                    </div>
                                </div>

        <?php
    }
                            ?>

                                
                            

                            

                            </div>
                            <div class="input-group p-2 border-top">
                                <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="Escribe algo.."
                                    aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page='wall' data-cs="comment-section<?=$post['id']?>" data-post-id="<?=$post['id']?>" type="button"
                                    id="button-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 14 14">
                                    <rect width="14" height="14" fill="none" />
                                    <path fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round" d="m5.812 11l2.178 2.168a1.1 1.1 0 0 0 1.05.3a1.119 1.119 0 0 0 .809-.74l3.576-10.72A1.118 1.118 0 0 0 11.987.57L1.267 4.147a1.119 1.119 0 0 0-.74.859a1.099 1.099 0 0 0 .3 1l2.737 2.737l-.09 3.466zM13.106.79L3.564 8.742" />
                                </svg></button>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>

                <div class="modal fade" id="likes<?=$post['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Likes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <?php
                    if(count($likes)<1){
                        ?>
    <p>No hay likes</p>
                        <?php
                    }
    foreach($likes as $f){

        $fuser = getUser($f['user_id']);
        $fbtn='';
        if(checkBS($f['user_id'])){
    continue;
        }elseif(checkFollowStatus($f['user_id'])){
            $fbtn = '<button class="btn btn-sm btn-danger unfollowbtn" data-user-id='.$fuser['id'].' >Dejar de seguir</button>';
        }elseif($user['id']==$f['user_id']){
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

        <?php
    }
                ?>
        
        

            </div>

            <div class="col-lg-4 col-sm-0 overflow-hidden mt-4 p-sm-0 p-md-3">
        

                <div class="d-flex align-items-center p-2">
                    <div><img src="assets/images/profile/<?=$user['profile_pic']?>" alt="" height="60" width="60" class="rounded-circle border">
                    </div>
                    <div>&nbsp;&nbsp;&nbsp;</div>
                    <div class="d-flex flex-column justify-content-center">
                    <a href='?u=<?=$user['username']?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;"><?=$user['first_name']?> <?=$user['last_name']?></h6></a>
                        <p style="margin:0px;" class="text-muted">@<?=$user['username']?></p>
                    </div>
                </div>


                <div>
                    <h6 class="text-muted p-2">Podés seguir a estos usuarios también</h6>
                    <?php
    foreach($follow_suggestions as $suser){
        ?>
    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center p-2">
                            <div><img src="assets/images/profile/<?=$suser['profile_pic']?>" alt="" height="40" width="40" class="rounded-circle border">
                            </div>
                            <div>&nbsp;&nbsp;</div>
                            <div class="d-flex flex-column justify-content-center">
                                <a href='?u=<?=$suser['username']?>' class="text-decoration-none text-dark"><h6 style="margin: 0px;font-size: small;"><?=$suser['first_name']?> <?=$suser['last_name']?></h6></a>
                                <p style="margin:0px;font-size:small" class="text-muted">@<?=$suser['username']?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-primary followbtn" data-user-id='<?=$suser['id']?>' >Seguir</button>

                        </div>
                    </div>
        <?php
    }

    if(count($follow_suggestions)<1){
        echo "<p class='p-2 bg-white border rounded text-center'>No hay sugerencias para vos</p>";
    }
                    ?>
                    
                


                </div>
            </div>
        </div>
    
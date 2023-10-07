<?php
set_query_var('ENTRY', 'index');
$blog_id = get_option( 'page_for_posts' );
$idpost = get_the_ID();
$date = explode("T", get_the_date('c', $idpost))[0];
$newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
$hora = explode("T", get_the_date('c', $idpost))[1];
$newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
get_header(); ?>
<style>
.notice-html a{
    color: var(--primary);
}

.notice-html a:hover{
    text-decoration: underline;
}

.notice-html iframe{
    margin: 0 auto;
}

.notice-html [id^="attachment"].aligncenter{
    margin: 0 auto;
}

.notice-html * {
    max-width: 100%;
}

.notice-html p{
    color: #dfdfdf;
}

.notice-html h1{
    color: #dfdfdf;
    font-size: 3rem;
}

.notice-html h2{
    color: #dfdfdf;
    font-size: 2.5rem;
}

.notice-html h3{
    color: #dfdfdf;
    font-size: 2rem;
}

.notice-html h4{
    color: #dfdfdf;
    font-size: 1.5rem;
}

.notice-html h5{
    color: #dfdfdf;
    font-size: 1rem;
}

.notice-html h6{
    color: #dfdfdf;
    font-size:.8rem;
}

.notice-html ul{
    padding-left: 1.5rem;
}

.notice-html ul li{
    color: #dfdfdf;
    font-size: 1.125rem;
    line-height: 1.75rem;
    font-weight: 300;
    margin-bottom: .5rem;
}

.notice-html ul li:last-child{
    margin-bottom: none;
}

.notice-html iframe{
    max-width: 100%;
}
</style>
<main class="-screen relative flex flex-col bg-dark pb-24">
    <div class="w-full h-80-screen relative" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>'); background-repeat: no-repeat; background-size: cover;background-position: center;">
        <div class="w-full h-full absolute top-0 lef-0 bg-gradient-dark"></div>
    </div>
    <div class="w-full relative px-4 md:px-0">
        <div class="w-full md:w-9/12 mx-auto z-20 bg-gray py-12 px-8 rounded-xl mt--6">
            <div class="w-full flex md:hidden mb-4">
                <span class="text-warning leading-none text-sm"><?php echo get_the_category( $idpost )[0]->name; ?></span>
            </div>
            <div class="w-full">
                <h1 class="text-3xl md:text-5xl font-medium text-white"><?php echo get_the_title(); ?></h1>
            </div>
            <div class="w-full mt-8">
                <div class="flex w-full border-solid border-b border-gray-light pb-3 justify-between flex flex-col md:flex-row">
                    <div class="flex items-center gap-x-2 text-sm text-white">
                        <span class="text-warning leading-none text-sm hidden md:flex"><?php echo get_the_category( $idpost )[0]->name; ?></span>
                        <span class="text-gray-light hidden md:flex">|</span>
                        <span class="leading-none text-sm"><?php echo $newdate; ?></span>
                        <span class="text-gray-light">|</span>
                        <span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                    </div>
                    <div class="flex items-center mt-4 md:mt-0">
                        <span class="text-primary text-base font-normal mr-4">Compartir artículo:</span>
                        <div class="flex items-center gap-x-6">
                            <a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>" class="h-10 w-10 flex justify-center items-center rounded-full bg-dark-neutral" target="_blank">
                                <span class="mdi mdi-facebook text-white-alt text-xl"></span>
                            </a>
                            <a class="whatsapp-share-button h-10 w-10 flex justify-center items-center rounded-full bg-dark-neutral" target="_blank" href="whatsapp://send?text=Comparte%20con%20tus%20amigos%20<?php echo get_permalink(); ?>" >
                                <span class="mdi mdi-whatsapp text-white-alt text-xl"></span>
                            </a>  
                            <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(get_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;via=Atlantic City" title="Compartir en Twitter" class="h-10 w-10 flex justify-center items-center rounded-full bg-dark-neutral" target="_blank" onclick="fn(this, event, {method:'wopen'})">
                                <span class="mdi mdi-twitter text-white-alt text-xl"></span>
                            </a>
                            <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>"  target="_blank" class="h-10 w-10 flex justify-center items-center rounded-full bg-dark-neutral">
                                <span class="mdi mdi-linkedin text-white-alt text-xl"></span>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="w-full mt-12">
                <div class="w-full w-full-content notice-html">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="w-full py-12 flex flex-col justify-center items-center">
                <span class="text-primary text-base font-normal">Compartir artículo:</span>
                <div class="flex items-center mt-4">
                    <div class="flex items-center gap-x-6">
                        
                        <a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>" class="h-10 w-10 flex justify-center items-center rounded-full bg-dark-neutral" target="_blank">
                            <span class="mdi mdi-facebook text-white-alt text-xl"></span>
                        </a>
                        
                        <a class="whatsapp-share-button h-10 w-10 flex justify-center items-center rounded-full bg-dark-neutral" href="whatsapp://send?text=Comparte%20con%20tus%20amigos%20<?php echo get_permalink(); ?>" >
                            <span class="mdi mdi-whatsapp text-white-alt text-xl"></span>
                        </a>  

                        <a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(get_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php echo urlencode(get_permalink()); ?>&amp;via=Atlantic City" title="Compartir en Twitter" class="h-10 w-10 flex justify-center items-center rounded-full bg-dark-neutral" target="_blank" onclick="fn(this, event, {method:'wopen'})">
                            <span class="mdi mdi-twitter text-white-alt text-xl"></span>
                        </a>
                        
                        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>" class="h-10 w-10 flex justify-center items-center rounded-full bg-dark-neutral">
                            <span class="mdi mdi-linkedin text-white-alt text-xl"></span>
                        </a>

                    </div>
                </div>
            </div>
            
            <div class="w-full flex flex-col">
                <?php the_tags('<ul class="post-tags"><li>','</li><li>','</li></ul>'); ?>
            </div>

            <?php 
                $publicidad = get_field( 'publicidad' );
                if ($publicidad) {
            ?>
            
            <div class="w-full">
                <div class="w-full md:w-8/12 mx-auto">
                    <article class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                        <img src="<?php echo $publicidad;?>" alt="" class="rounded-lg object-cover object-center w-full h-full">
                    </article>
                </div>
            </div>
            <?php } ?>
            <div class="w-full mt-24">
                <div class="flex w-full border-solid border-b border-gray-light pb-3">
                    <h1 class="text-2xl font-medium text-white">
                        Comentarios
                    </h1>
                </div>
            </div>
            <div class="w-full mt-10">
                <?php
                    $comments = get_comments( array( 'post_id' => $idpost ) );

                    foreach ( $comments as $comment ) {
                        $userid = $comment->user_id;
                        $comment_author = $comment->comment_author;
                        $comment_date = $comment->comment_date;
                        $date = explode(" ", $comment_date)[0];
                        $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                        $hora = explode(" ", $comment_date)[1];
                        $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                        ?>
                <div class="w-full">
                    <span class="flex items-start">
                        <img class="w-12 h-12 rounded-full mr-4" src="<?php echo esc_url( get_avatar_url( $userid ) ); ?>" alt="">
                        <div class="flex flex-col">
                            <p class="text-white text-lg font-medium"><?php echo $comment_author; ?></p>
                            <span class="my-2">
                                <span class="text-base text-white font-light"><?php echo $newdate; ?></span><span class="text-primary mx-4">|</span><span class="text-base text-white font-light"><?php echo $newhora; ?> hrs.</span>
                            </span>
                            <p class="text-base text-white font-light">
                                <?php echo $comment->comment_content; ?>
                            </p>
                        </div>
                    </span>
                </div>
                        <?php
                    }                    
                ?>
            </div>
            <div class="w-full mt-10">
                <?php 
                    if (is_user_logged_in()) {
                        ?>                        
                        <div class="w-full">
                            <?php 
                                $commenter = wp_get_current_commenter();
                                $user = wp_get_current_user();
                            ?>
                            <span class="flex items-center">
                                <img class="w-12 h-12 rounded-full mr-4" src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="">
                                <p class="text-white text-lg font-medium"><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></p>
                            </span>
                        </div>
                        <div class="w-full mt-8">
                            <?php 
                                $comments_args = array(
                                    // change the title of send button 
                                    'label_submit'=>'Enviar',
                                    // change the title of the reply section
                                    'title_reply'=>'',
                                    // remove "Text or HTML to be displayed after the set of comment fields"
                                    'comment_notes_after' => '',
                                    // redefine your own textarea (the comment body)
                                    'comment_field' => '<div class="flex w-full"><input id="comment" class="w-full py-3 px-8 bg-dark placeholder-gray-light text-base border-solid font-normal rounded-lg border border-dark input-primary outline-none text-white" name="comment" type="text" placeholder="Brindanos tus comentarios...." aria-required="true"></div>',
                                );
                                comment_form($comments_args);
                            ?>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="w-full">
                            <p class="text-white text-lg font-medium">Necesitas iniciar sesión para comentar</p>
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="w-full mt-24">
        <div class="w-full px-4 md:px-8">
            <div class="flex w-full border-solid border-b border-gray-light pb-3">
                <h1 class="text-2xl font-medium text-white">
                    NOTICIAS RELACIONADAS
                </h1>
            </div>
            <div class="w-full mt-12">
                <div class="flex flex-col md:flex-row gap-x-8 gap-y-8">
                <?php
                    $related = get_posts( array( 'category__in' => wp_get_post_categories($idpost), 'numberposts' => 3, 'post__not_in' => array($idpost) ) );
                    if( $related ) foreach( $related as $post ) {
                        $relatedid = $post->id;
                        $date = explode("T", get_the_date('c', $relatedid))[0];
                        $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                        $hora = explode("T", get_the_date('c', $relatedid))[1];
                        $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                    setup_postdata($post); ?>
                    <div class="w-full w-4/12">
                        <article class="w-full notice bg-gray">
                            <a href="<?php echo get_permalink($relatedid);?>" class="flex bg-gray w-full flex-row md:flex-col items-start justify-between rounded-lg">
                                <div class="w-full relative overflow-hidden h-56">
                                    <img src="<?php echo get_the_post_thumbnail_url($relatedid);?>" alt="" class="rounded-tl-lg md:rounded-tr-lg rounded-bl-lg md:rounded-bl-none object-cover object-center w-full h-full notice-image">
                                </div>
            
                                <div class="w-full h-full flex flex-col justify-end p-7 my-auto">
                                    <div class="flex items-center gap-x-2 text-white">
                                        <span class="text-warning leading-none text-sm"><?php echo get_the_category( $relatedid )[0]->name;?></span>
                                    </div>
                                    <h3 class="mt-2  leading-6 text-white">
                                        <a href="<?php echo get_the_post_thumbnail_url($relatedid);?>" class="text-lg font-semibold text-2xl">
                                        <?php echo get_the_title($myid);?>
                                        </a>
                                    </h3>
                                    <div class="flex items-center gap-x-2 text-white mt-8 text-sm">
                                        <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    </div>  
                    <?php }
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </div>
</main>
<style>
.post-tags {
    list-style: none;
    padding: 0;
}

.post-tags li {
    display: inline-block;
    margin-right: 10px;
    background-color: #034132;
    padding: 5px 10px;
    color: #fff;
    border-radius: 14px;
}
.w-full-content p {
    color: #dfdfdf;
    font-size: 1.125rem;
    line-height: 1.75rem;
    font-weight: 300;
}
.comment-respond .form-submit input {
    margin-top: 10px;
    display: block;
    width: 200px;
    padding: 10px;
    border-radius: 5px;
    color: white;
    background: #4fc1a7;
}

.comment-respond .logged-in-as a {
    text-decoration: underline;
}
.comment-respond .logged-in-as {
    color: white;
    margin-bottom: 10px;
}
</style>
<?php get_footer(); ?>
<?php 
set_query_var('ENTRY', 'index');
$frontpage_id = get_option( 'page_on_front' );
$blog_id = get_option( 'page_for_posts' );
$myid = get_the_ID();
$category = get_queried_object();
$idCategory = $category->term_id;
$nameCategory = $category->name;
get_header(); ?>
<!-- section index init -->
<style>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

@media (min-width: 768px){
    .md\:header-vs{
        height: 125px;
        max-height: 125px;
    }

    .md\:mt-125 {
        margin-top: 125px !important;
    }

    .md\:pt-125 {
        padding-top: 125px !important;
    }

    .md\:mt-95 {
        margin-top: 125px !important;
    }

    .h-custom-logs{
        height: calc(100vh - 203px);
    }

    body.archive:not(.category-futbol-internacional) .h-custom-logs{
        height: calc(100vh - 68px);
    }
}
</style>
<div class="bg-dark flex flex-col pb-24 w-full margin-top-header">
    <?php 
        if (property_exists($category, "term_id")){
            $orderitems = get_field( 'orden_de_items', $category );            
            if ($orderitems == "izquierdo") {
            ?>
                <div class="w-full bg-dark-bold flex items-center px-8 justify-center md:justify-start relative md:fixed z-10 h-16 header-title">
                    <div id="category-box" class="flex w-full py-0 items-center">
                        <h1 class="text-2xl font-semibold text-white my-auto uppercase text-center w-full md:w-auto">
                            <?php 
                                $ancestros = get_ancestors($idCategory, 'category');
                                if ($category->parent) {
                                    if (count($ancestros) > 1) {
                                        $parent = get_term( $ancestros[1], 'category');
                                        echo $parent->name;
                                    } else {
                                        echo get_cat_name($category->parent);
                                    }
                                    
                                } else {
                                    echo $nameCategory;
                                }
                            ?>
                        </h1>
                        <!-- SEPARATION -->
                        <span class="separation bg-primary mx-8 hidden md:flex"></span>
                        <!-- END SEPARATION -->
                        <?php
                        $aux = 0;

                        $idcropCat = $idCategory;
                        $encuentros = get_field('encuentros', "category_".$idcropCat);
                        $matchs = get_field('matchs', "category_".$idcropCat);
                        if ($category->parent != 0) {
                            $cterms = get_terms( array(
                                'taxonomy'   => 'category',
                                'hide_empty' => false,
                                'fields' => 'ids',
                                'parent' => $category->parent
                            ) );
                            $encuentros = [];
                            $matchs = [];
                            $encuentros = get_field('encuentros', "category_".$idcropCat);
                            $matchs = get_field('matchs', "category_".$idcropCat);
                            if(empty($encuentros) || empty($matchs)) {
                                foreach ($cterms as $cterm_id) {
                                    if (empty($encuentros)) {
                                        $etemp = get_field('encuentros', "category_" . $cterm_id);
                                        if($etemp) {
                                            $encuentros = array_merge($encuentros, $etemp);
                                        }
                                    }
                                    if (empty($matchs)) {
                                        $mtemp = get_field('matchs', "category_" . $cterm_id);
                                        if($mtemp) {
                                            $matchs = array_merge($matchs, $mtemp);
                                        }
                                    }
                                }
                            }

                        }
                        
                        $existList = false;
                        if($encuentros && empty($matchs)){
                            if(count($encuentros) > 0){
                                    $existList = true;
                            }
                        }
                        else if(!empty($matchs)){
                            if(count($matchs) > 0){
                                $existList = true;
                            }
                        }

                        if($existList){
                            ?>
                                <p class="text-lg font-normal text-white my-auto hidden md:flex">Próximos encuentros:</p>
                            <?php
                        }
                        ?>
                        <div class="hidden md:flex items-center px-4 h-full">
                            <?php 
                                
                                /*$encuentrosCat = get_field( 'encuentros', "category_".$idcropCat );
                                if ($encuentrosCat) {
                                    $encuentros = $encuentrosCat;
                                }*/
                                if ($encuentros && empty($matchs)) {
                                    foreach ($encuentros as $enc) {
                                        ?>
                                    <?php if ($aux != 0) {?> <div class="w-px h-12 bg-gray-light"></div> <?php } ?>
                                    <div class="flex items-center h-full px-8 " id="bombita11">
                                        <div class="flex flex-col items-center">
                                            <img class="h-7" src="<?php echo $enc['logo_equipo_local']; ?>" alt="">
                                            <span class="text-white text-s text-normal mt-0.5 leading-none"><?php echo $enc['equipo_local']; ?></span>
                                        </div>
                                        <div class="flex flex-col items-center px-4">
                                            <span class="text-white text-s leading-tight text-center"><?php echo $enc['fecha']; ?></span>
                                            <span class="text-white text-s leading-tight text-center"><?php echo $enc['hora']; ?></span>
                                            <span class="text-white text-s leading-tight font-bold">VS</span>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <img class="h-7" src="<?php echo $enc['logo_equipo_visitante']; ?>" alt="">
                                            <span class="text-white text-s text-normal mt-1 leading-none"><?php echo $enc['equipo_visitante']; ?></span>
                                        </div>
                                    </div>
                                        <?php
                                    $aux++;
                                    }
                                }else if(!empty($matchs)){
                                    $maux = 0;
                                    $lastitem = count($matchs);
                                    foreach ($matchs as $key => $match) {
                                    ?>
                            <div class="flex items-center h-full px-4 bombita h-full" id="bombita<?php echo $key; ?>" style="height: 100% !important;">
                                <?php
                                if(!$match['disable']){
                                    echo $match['iframe'];
                                }
                                ?>
                            </div>
                                        <?php
                                        if(($key+1) != $lastitem) {
                                            ?><div class="w-px h-12 bg-gray-light"></div><?php
                                        }
                                        $maux++;
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            } 
            if ($orderitems == "arriba") {
                ?>
                <div class="w-full md:h-subtitle bg-dark-bold flex items-center px-0 md:px-8 justify-center md:justify-start">
                    <div class="flex flex-col md:flex-row w-full h-full items-center">
                        <h1 class="text-2xl font-semibold text-white my-auto py-5 md:py-0 px-8 md:px-0 uppercase">
                            <?php 
                                $ancestros = get_ancestors($idCategory, 'category');
                                if ($category->parent) {
                                    if (count($ancestros) > 1) {
                                        $parent = get_term( $ancestros[1], 'category');
                                        echo $parent->name;
                                    } else {
                                        echo get_cat_name($category->parent);
                                    }
                                    
                                } else {
                                    echo $nameCategory;
                                }
                            ?>
                        </h1>
                        <!-- SEPARATION -->
                        <span class="hidden md:flex w-px bg-primary h-10 mx-5 my-auto"></span>
                        <!-- END SEPARATION -->
                        <ul class="flex h-full w-full md:w-auto bg-gray md:bg-transparent items-center">
                            <?php 
                                $taxonomy     = 'category';
                                $orderby      = 'menu_order';
                                $empty        = 0;
                                $idcrop = $idCategory;
                                if ($category->parent) {
                                    $idcrop = $category->parent;
                                }
                                $args = array(
                                    'taxonomy'     => $taxonomy,
                                    'orderby'      => $orderby,
                                    'hide_empty'   => $empty,
                                    'parent'       => $idcrop,
                                );
                                $selfcategories = get_categories( $args );
                                if ($selfcategories) {
                                    foreach ($selfcategories as $self) {
                                        $link = get_term_link($self->slug, 'category');
                                        $name = $self->name;      
                                        $active = false;
                                        if($self->term_id == $idCategory) {
                                            $active = true;
                                        }                                        
                                        ?>
                                        <li class="w-full md:w-auto h-full px-0 md:px-4">
                                            <a href="<?php echo $link; ?>" class="<?php if($active) echo "active"; ?> w-full px-8 md:px-0 py-4 md:py-0 flex items-center h-full font-normal text-base text-white h-full cursor-pointer hover:text-primary nav-link-primary">
                                                <?php echo $name; ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="w-full flex justify-center">
                    <div class="flex py-5 flex items-center overflow-auto">
                        <?php
                        $aux = 0;
                        $idcropCat = $idCategory;
                        $encuentros = get_field('encuentros', "category_".$idcropCat);
                        $matchs = get_field('matchs', "category_".$idcropCat);
                        if ($category->parent != 0) {
                            $cterms = get_terms( array(
                                'taxonomy'   => 'category',
                                'hide_empty' => false,
                                'fields' => 'ids',
                                'parent' => $category->parent
                            ) );
                            $encuentros = [];
                            $matchs = [];
                            $encuentros = get_field('encuentros', "category_".$idcropCat);
                            $matchs = get_field('matchs', "category_".$idcropCat);
                            if(empty($encuentros) || empty($matchs)) {
                                foreach ($cterms as $cterm_id) {
                                    if (empty($encuentros)) {
                                        $etemp = get_field('encuentros', "category_" . $cterm_id);
                                        if($etemp) {
                                            $encuentros = array_merge($encuentros, $etemp);
                                        }
                                    }
                                    if (empty($matchs)) {
                                        $mtemp = get_field('matchs', "category_" . $cterm_id);
                                        if($mtemp && is_array($mtemp) && is_array($matchs)) {
                                            $matchs = array_merge($matchs, $mtemp);
                                        }
                                    }
                                }
                            }

                        }

                        $existList = false;
                        if($encuentros && empty($matchs)){
                            echo 1;
                            if(count($encuentros) > 0){
                                    $existList = true;
                            }
                        }
                        else if(!empty($matchs)){
                            echo 2;
                            if(count($matchs) > 0){
                                $existList = true;
                            }
                        }

                        if($existList){
                            ?>
                                <p class="text-lg font-normal text-white my-auto hidden md:flex">Próximos encuentros:</p>
                            <?php
                        }
                        ?>
                        
                        <div class="hidden md:flex items-center px-4 h-full">
                            <?php 
                                
                                if ($encuentros && empty($matchs)) {
                                    foreach ($encuentros as $enc) {
                                        ?>
                                    <?php if ($aux != 0) {?> <div class="w-px h-12 bg-gray-light"></div> <?php } ?>
                                    <div class="flex items-center h-full px-8" id="bombita">
                                        <div class="flex flex-col items-center">
                                            <img class="h-7" src="<?php echo $enc['logo_equipo_local']; ?>" alt="">
                                            <span class="text-white text-s text-normal mt-0.5 leading-none"><?php echo $enc['equipo_local']; ?></span>
                                        </div>
                                        <div class="flex flex-col items-center px-4">
                                            <span class="text-white text-s leading-tight"><?php echo $enc['fecha']; ?></span>
                                            <span class="text-white text-s leading-tight"><?php echo $enc['hora']; ?></span>
                                            <span class="text-white text-s leading-tight font-bold">VS</span>
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <img class="h-7" src="<?php echo $enc['logo_equipo_visitante']; ?>" alt="">
                                            <span class="text-white text-s text-normal mt-1 leading-none"><?php echo $enc['equipo_visitante']; ?></span>
                                        </div>
                                    </div>
                                        <?php
                                    $aux++;
                                    }
                                }else if(!empty($matchs)){
                                    $lastitem = count($matchs);
                                    foreach ($matchs as $key => $match) {
                                        ?>
                                        <div class="flex items-center h-full px-4 bombita" id="bombita<?php echo $key; ?>">
                                            <?php
                                            if(!$match['disable']){
                                                echo $match['iframe'];
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if(($key+1) != $lastitem) {
                                            ?><div class="w-px h-12 bg-gray-light"></div><?php
                                        }
                                        $aux++;
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="flex flex-col md:flex-row gap-x-8 h-full relative   
             <?php if ($orderitems == "arriba") { echo "pl-0"; } else { echo "pl-aside mt-0 header-title-target"; }?>">
                <?php 
                    if ($orderitems == "izquierdo") {
                        ?>
                <aside class="w-full md:w-60 relative md:fixed z-10 h-auto md:h-screen left-0 h-custom-logs">
                    <div class="bg-gray h-full overflow-auto no-scrollbar">
                        <ul class="w-full flex flex-row md:flex-col flex-nowrap md:flex-wrap overflow-auto py-0 md:py-4">
                            <?php 
                                $idcrop = $idCategory;
                                if ($category->parent) {
                                    if (count($ancestros) > 1) {                                        
                                        $idcrop = $ancestros[1];
                                    } else {
                                        $idcrop = $category->parent;
                                    }
                                }
                                $taxonomy     = 'category';
                                $orderby      = 'menu_order';
                                $empty        = 0;
                                $args = array(
                                    'taxonomy'     => $taxonomy,
                                    'orderby'      => $orderby,
                                    'hide_empty'   => $empty,
                                    'parent'       => $idcrop,
                                );
                                $selfcategories = get_categories( $args );
                                if ($selfcategories) {
                                    foreach ($selfcategories as $self) {
                                        $link = get_term_link($self->slug, 'category');
                                        $name = $self->name;
                                        $actives = "";
                                        if ($idCategory == $self->term_id) {
                                            $actives = "background: #121313";
                                        }
                                        ?>
                                        <li class="w-full py-2 md:py-0 px-1 md:px-0" data-id="<?php echo $self->term_id; ?>">
                                            <a href="<?php echo $link; ?>" style="<?php echo $actives;?>" class="bg-dark md:bg-transparent w-full text-white flex items-center py-4 hover:bg-dark-bold focus:bg-dark-bold active:bg-dark-bold duration-3 transition-all px-8 rounded-full md:rounded-none">
                                                <?php
                                                    if (get_field( 'icon', "category_".$self->term_id )) {
                                                        ?>
                                                    <img class="h-7 mr-4" src="<?php echo get_field( 'icon', "category_".$self->term_id ); ?>">
                                                        <?php
                                                    }
                                                ?>
                                                <span class="text-base font-normal whitespace-nowrap md:whitespace-pre-wrap pr-5 md:pr-0"><?php echo $name; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </aside>
                <main class="h-full w-full <?php if (!get_field("desactivar_lateral", "category_".$idCategory)) { echo "md:w-7/12"; } else { echo "md:w-12/12"; } ?> px-5 md:px-0">
                    <?php 
                            $taxonomy     = 'category';
                            $orderby      = 'menu_order';
                            $idcrop = $idCategory;
                        ?>
                    <div class="flex flex-col w-full py-8 px-0 md:px-8 gap-y-8">
                        <?php                        
                            if ($category->parent) {
                                $removeBorder = true;
                                if (count($ancestros) > 1) {                                        
                                    $idcrop = $ancestros[0];
                                    $removeBorder = false;
                                } else {
                                    $idcrop = $idCategory;
                                }
                                $args = array(
                                    'taxonomy'     => $taxonomy,
                                    'orderby'      => $orderby,
                                    'hide_empty'   => $empty,
                                    'parent'       => $idcrop,
                                );
                                $Newselfcategories = get_categories( $args );
                                ?>
                                <div class="w-full overflow-x-auto overflow-y-hidden">
                                    <div class="flex w-full border-solid border-b border-gray-light flex items-center">
                                        <span class="mr-2  h-full">
                                            <img class="h-8" src="<?php echo get_field("icon", "category_".$idcrop); ?>" alt="">
                                        </span>
                                        <h1 class="text-xl font-semibold text-white whitespace-nowrap  h-full">
                                            <?php echo get_cat_name($idcrop); ?>
                                        </h1>
                                        <div class="w-px h-12 bg-gray-light mx-4"></div>
                                        <div class="flex items-center h-full">
                                        <?php 
                                                $myterm = get_term( $idcrop, 'category' );
                                                $myterm_link = get_term_link( $myterm );
                                            ?>
                                            <a href="<?php echo $myterm_link; ?>" class="rounded-3xl border py-2 px-4 text-base font-medium <?php if ($removeBorder) {echo "border-primary text-primary";} else { echo "text-white"; }?> bg-gray-tag mr-2">Todos</a>                                        
                                            <div class="flex items-center  h-full">
                                                <?php if ($Newselfcategories) {
                                                    foreach ($Newselfcategories as $cc) {
                                                        $active = false;
                                                        if ($idCategory == $cc->term_id) {
                                                            $active = true;
                                                        }
                                                        ?>                                            
                                                <a href="<?php echo $link = get_term_link($cc->slug, 'category');; ?>" class=" p-2 cursor-pointer  h-full link-icon-bar py-4 <?php if($active) { echo "active"; } ?>">
                                                    <span class="flex justify-center items-center w-12 h-12 bg-gray rounded-full link-icon-bar-circle">
                                                        <img class="h-8" src="<?php echo get_field( 'icon', "category_".$cc->term_id ); ?>" alt="">
                                                    </span>
                                                </a>
                                                        <?php
                                                    }
                                                }?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                            }
                        ?>
                        <!--
                        <div class="flex w-full border-solid border-b border-gray-light py-3 flex items-center overflow-auto">
                            <span class="mr-6">
                                <img class="w-8" src="assets/img/icons/menu-4.svg" alt="">
                            </span>
                            <h1 class="text-xl font-semibold text-white whitespace-nowrap">
                                SERIE A
                            </h1>
                            <div class="w-px h-12 bg-gray-light mx-8"></div>
                            <div class="flex items-center">
                                <span class="rounded-3xl border border-primary py-2 px-4 text-base font-medium text-primary bg-gray-tag mr-4">Todos</span>
                                <div class="flex items-center gap-x-4">
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-1.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-2.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-3.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-4.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-6.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-7.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-8.svg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        -->
                        <?php
                            if ( have_posts() ) : ?>
                            <?php
                            $aux = 0;
                            // Start the loop.
                            while ( have_posts() ) :
                                the_post();
                                $myid = get_the_ID();
                                $date = explode("T", get_the_date('c', $myid))[0];
                                $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                                $hora = explode("T", get_the_date('c', $myid))[1];
                                $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                        ?>
                        <?php 
                            if ($aux == 0) {
                                ?>
                                <div class="w-full">
                                    <article class="w-full notice">
                                        <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg">
                                            <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            <div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
                        
                                            <div class="absolute top-0 left-0 w-full md:w-9/12 h-full flex flex-col justify-end p-7">
                                                <div class="flex items-center gap-x-2 text-xs text-white">
                                                    <span class="text-warning leading-none"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                    <span class="hidden md:flex">|</span>
                                                    <span class="leading-none hidden md:flex"><?php echo $newdate; ?></span>
                                                    <span class="hidden md:flex">|</span>
                                                    <span class="leading-none hidden md:flex"><?php echo $newhora; ?> hrs.</span>
                                                </div>
                                                <h3 class="mt-2  leading-6 text-white">
                                                    <span class="text-2xl md:text-4xl font-semibold">
                                                    <?php echo get_the_title($myid);?>
                                                    </span>
                                                </h3>
                                                <div class="flex items-center gap-x-2 text-xs text-white md:hidden mt-5">
                                                    <span class="leading-none"><?php echo $newdate; ?></span>
                                                    <span class="">|</span>
                                                    <span class="leading-none"><?php echo $newhora; ?> hrs.</span>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>                            
                                <?php
                            }
                            if ($aux == 1 || $aux == 2) {
                                ?>
                                    <?php if ($aux == 1) { ?>                                    
                                <div class="flex flex-col md:flex-row gap-x-8 gap-y-8">
                                        <div class="w-full md:w-1/2">
                                            <article class="w-full notice notice-small">
                                                <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                                    <div class="w-2/5 relative overflow-hidden">
                                                        <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                    </div>
                                                    <div class="w-3/5">
                                                        <div class="h-full w-full flex flex-col justify-between p-7">
                                                            <div class="w-full">
                                                                <div class="flex items-center gap-x-2 ">
                                                                    <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                                </div>
                                                                <h3 class="mt-2 leading-6 text-white">
                                                                    <span class="text-xl font-medium">
                                                                    <?php echo get_the_title($myid);?>
                                                                    </span>
                                                                </h3>
                                                            </div>
                                                            <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                                                <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </article>
                                        </div>
                                    <?php } ?>
                                    <?php if ($aux == 2) { ?>
                                        <div class="w-full md:w-1/2">
                                            <article class="w-full notice notice-small">
                                                <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                                    <div class="w-2/5 relative overflow-hidden">
                                                        <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                    </div>
                                                    <div class="w-3/5">
                                                        <div class="h-full w-full flex flex-col justify-between p-7">
                                                            <div class="w-full">
                                                                <div class="flex items-center gap-x-2 ">
                                                                    <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                                </div>
                                                                <h3 class="mt-2 leading-6 text-white">
                                                                    <span class="text-xl font-medium">
                                                                    <?php echo get_the_title($myid);?>
                                                                    </span>
                                                                </h3>
                                                            </div>
                                                            <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                                                <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </article>
                                        </div>                                
                                </div>
                                    <?php } ?>
                                <?php
                            }
                            if ($aux == 3) {
                                ?>
                                <div class="flex flex-col gap-y-8">
                                    <article class="w-full notice notice-small">
                                        <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg h-64">
                                            <div class="w-5/12 relative overflow-hidden">
                                                <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            </div>
                                            <div class="w-7/12">
                                                <div class="h-full w-full flex flex-col justify-center p-7">
                                                    <h3 class="text-2xl font-medium leading-6 text-white mb-8">
                                                        <span class="text-2xl font-medium">
                                                        <?php echo get_the_title($myid);?>
                                                        </span>
                                                    </h3>
                                                    <div class="flex items-center gap-x-2 text-sm text-white mt-2">
                                                        <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>|<span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                                <?php
                            }
                            if ($aux == 4 || $aux == 5) {
                                ?>
                                    <?php if ($aux == 4) { ?>                                
                                        <div class="gap-x-8 hidden md:flex">
                                            <div class="w-1/2">
                                                <article class="w-full notice notice-small">
                                                    <a href="<?php echo get_permalink($myid); ?>" class="flex bg-gray w-full flex-col items-start justify-between rounded-lg">
                                                        <div class="w-full relative overflow-hidden h-56">
                                                            <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-tr-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                        </div>
                                    
                                                        <div class="w-full h-full flex flex-col justify-end p-7">
                                                            <div class="flex items-center gap-x-2 text-white">
                                                                <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                            </div>
                                                            <h3 class="mt-2  leading-6 text-white">
                                                                <span class="text-lg font-normal">
                                                                <?php echo get_the_title($myid);?>
                                                                </span>
                                                            </h3>
                                                            <div class="flex items-center gap-x-2 text-white mt-3 text-sm">
                                                                <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </article>
                                            </div>
                                            <?php } ?>
                                            <?php if ($aux == 5) { ?>
                                            <div class="w-1/2">
                                                <article class="w-full notice notice-small">
                                                    <a href="<?php echo get_permalink($myid); ?>" class="flex bg-gray w-full flex-col items-start justify-between rounded-lg">
                                                        <div class="w-full relative overflow-hidden h-56">
                                                            <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-tr-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                        </div>
                                    
                                                        <div class="w-full h-full flex flex-col justify-end p-7">
                                                            <div class="flex items-center gap-x-2 text-white">
                                                                <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                            </div>
                                                            <h3 class="mt-2  leading-6 text-white">
                                                                <span class="text-lg font-normal">
                                                                <?php echo get_the_title($myid);?>
                                                                </span>
                                                            </h3>
                                                            <div class="flex items-center gap-x-2 text-white mt-3 text-sm">
                                                                <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </article>
                                            </div>                                
                                        </div>
                                    <?php } ?>
                                <?php
                            }
                        ?>
                        <?php
                            $aux++;
                            endwhile;
                        endif;
                        ?>
                    </div>                    
                    <div class="pag-link px-8">
                        <?php powernature_pagination(); ?>
                    </div>
                    
                    <?php 
                        $publicidad = get_field( 'publicidad', $category );
                        if ($publicidad) {
                    ?>
                    <div class="flex w-full px-8 gap-x-8">
                        <article class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                            <img src="<?php echo $publicidad; ?>" alt="" class="rounded-lg object-cover object-center w-full h-full">
                        </article>
                    </div>
                    <?php } ?>
                </main>
                <?php if (!get_field("desactivar_lateral", "category_".$idCategory)) { ?>
                <section class="h-full w-full md:w-4/12 pl-5 md:pl-0 pr-5 md:pr-4">
                    <div class="w-full flex flex-col py-8 gap-y-8">                        
                    <?php 
                        $lateral = get_field( 'lateral', 'options');
                        $idcropCat2 = $idCategory;
                        if ($category->parent) {
                            $idcropCat2 = $category->parent;
                        }
                        $lateralCat = get_field( 'lateral', "category_".$idCategory );                           
                        if ($lateralCat) {
                            $lateral = $lateralCat;
                        }


                        if ($lateral) {
                            foreach ($lateral as $la) {
                                ?>                        
                        <?php if ($la['type'] == "clasificacion") { ?>   
                            <style>#iframeContent p{color: white;} #iframeContent iframe{ width: 100%;} #iframeContent{color: white;}</style>
                            <div class="w-full bg-gray rounded-xl" id="iframeContent">
                                <?php
                                    $post_id = $la["id"];
                                    echo get_post_field('post_content', $post_id);
                                ?>
                            </div> 
                        <?php } ?>
                        <?php if ($la['type'] == "banner") { ?> 
                            <div class="w-full bg-gray rounded-xl">
                                <div class="flex w-full border-solid border-b border-primary py-3 px-4 flex items-center justify-center min-h-16">
                                    <h2 class="text-xl font-medium text-white"><?php echo $la['banner_titulo']; ?></h2>
                                </div>
                                <div class="w-full flex items-center justify-between">
                                    <img class="w-full rounded-bl-xl rounded-br-xl" src="<?php echo $la['banner_imagen']; ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($la['type'] == "publicidad") { ?> 
                            <div class="w-full">
                                <div class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                    <img src="<?php echo $la['publicidad_imagen']; ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full">
                                    <div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
            
                                    <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-end p-7">
                                        <h3 class=" leading-6 text-white mb-12 w-1/2">
                                            <a href="<?php echo $la['publicidad_link']; ?>" class="text-2xl font-semibold">
                                                <?php echo $la['publicidad_title']; ?>
                                            </a>
                                        </h3>
                                        <span class="mx-auto">
                                            <a href="<?php echo $la['publicidad_link']; ?>" class="outline outline-2 outline-primary text-primary font-medium py-2 px-4 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">MÁS INFORMACIÓN</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($la['type'] == "posts") { ?> 
                            <div class="w-full flex flex-col gap-y-8">
                                <?php
                                    if ( have_posts() ) : ?>
                                    <?php
                                    $aux = 0;
                                    // Start the loop.
                                    while ( have_posts() ) :
                                        the_post();
                                        $myid = get_the_ID();
                                        $date = explode("T", get_the_date('c', $myid))[0];
                                        $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                                        $hora = explode("T", get_the_date('c', $myid))[1];
                                        $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                                        if ($aux < $la['cantidad']) {
                                ?>
                                <div class="w-full">
                                    <article class="w-full notice notice-small">
                                        <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                            <div class="w-2/5 relative overflow-hidden">
                                                <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            </div>
                                            <div class="w-3/5">
                                                <div class="h-full w-full flex flex-col justify-between p-7">
                                                    <div class="w-full">
                                                        <div class="flex items-center gap-x-2 ">
                                                            <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                        </div>
                                                        <h3 class="mt-2 leading-6 text-white">
                                                            <span class="text-xl font-medium">
                                                            <?php echo get_the_title($myid);?>
                                                            </span>
                                                        </h3>
                                                    </div>
                                                    <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                                        <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                                <?php
                                        }
                                    $aux++;
                                    endwhile;
                                endif;
                                ?>
                            </div>
                        <?php } ?>
                                <?php
                            }
                        }
                    ?>
                    </div>
                </section>
                <?php } ?>
                        <?php
                    }
                    if ($orderitems == "arriba") {
                        ?>
                <main class="h-full w-full <?php if (!get_field("desactivar_lateral", "category_".$idCategory)) { echo "md:w-8/12"; } else { echo "md:w-12/12"; } ?> pr-5 md:pr-0 pl-3">
                    <div class="flex flex-col w-full py-8 px-0 md:px-8 gap-y-8">
                        <?php                        
                            if ($category->parent) {
                                $removeBorder = true;
                                if (count($ancestros) > 1) {                                        
                                    $idcrop = $ancestros[0];
                                    $removeBorder = false;
                                } else {
                                    $idcrop = $idCategory;
                                }
                                $args = array(
                                    'taxonomy'     => $taxonomy,
                                    'orderby'      => $orderby,
                                    'hide_empty'   => $empty,
                                    'parent'       => $idcrop,
                                );
                                $Newselfcategories = get_categories( $args );
                                ?>
                                <div class="flex w-full border-solid border-b border-gray-light py-3 flex items-center overflow-auto">
                                    <span class="mr-6">
                                        <img class="w-8" src="<?php echo get_field("icon", "category_".$idcrop); ?>" alt="">
                                    </span>
                                    <h1 class="text-xl font-semibold text-white whitespace-nowrap">
                                        <?php echo get_cat_name($idcrop); ?>
                                    </h1>
                                    <div class="w-px h-12 bg-gray-light mx-8"></div>
                                    <div class="flex items-center">
                                        <?php 
                                            $myterm = get_term( $idcrop, 'category' );
                                            $myterm_link = get_term_link( $myterm );
                                        ?>
                                        <a href="<?php echo $myterm_link; ?>" class="rounded-3xl border py-2 px-4 text-base font-medium <?php if ($removeBorder) {echo "border-primary text-primary";} else { echo "text-white"; }?> bg-gray-tag mr-4">Todos</a>
                                        <div class="flex items-center gap-x-4">
                                            <?php if ($Newselfcategories) {
                                                foreach ($Newselfcategories as $cc) {
                                                    $active = false;
                                                    if ($idCategory == $cc->term_id) {
                                                        $active = true;
                                                    }
                                                    ?>                                            
                                            <a href="<?php echo $link = get_term_link($cc->slug, 'category');; ?>" <?php if($active) { echo "style='background: #121313;'"; } ?> class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                                <img class="w-full max-w-full max-h-full" src="<?php echo get_field( 'icon', "category_".$cc->term_id ); ?>" alt="">
                                            </a>
                                                    <?php
                                                }
                                            }?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <!--
                        <div class="flex w-full border-solid border-b border-gray-light py-3 flex items-center overflow-auto">
                            <span class="mr-6">
                                <img class="w-8" src="assets/img/icons/menu-4.svg" alt="">
                            </span>
                            <h1 class="text-xl font-semibold text-white whitespace-nowrap">
                                SERIE A
                            </h1>
                            <div class="w-px h-12 bg-gray-light mx-8"></div>
                            <div class="flex items-center">
                                <span class="rounded-3xl border border-primary py-2 px-4 text-base font-medium text-primary bg-gray-tag mr-4">Todos</span>
                                <div class="flex items-center gap-x-4">
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-1.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-2.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-3.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-4.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-6.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-7.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-8.svg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        -->
                        <?php
                            if ( have_posts() ) : ?>
                            <?php
                            $aux = 0;
                            // Start the loop.
                            while ( have_posts() ) :
                                the_post();
                                $myid = get_the_ID();
                                $date = explode("T", get_the_date('c', $myid))[0];
                                $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                                $hora = explode("T", get_the_date('c', $myid))[1];
                                $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                        ?>
                        <?php 
                            if ($aux == 0) {
                                ?>
                                <!-- top grande -->
                                <div class="w-full">
                                    <article class="w-full notice">
                                        <a data-notice="<?php echo $myid; ?>" href="<?php echo get_permalink($myid); ?>" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg">
                                            <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            <div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
                        
                                            <div class="absolute top-0 left-0 w-full md:w-9/12 h-full flex flex-col justify-end p-7">
                                                <div class="flex items-center gap-x-2 text-xs text-white">
                                                    <span class="text-warning leading-none"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                    <span class="hidden md:flex">|</span>
                                                    <span class="leading-none hidden md:flex"><?php echo $newdate; ?></span>
                                                    <span class="hidden md:flex">|</span>
                                                    <span class="leading-none hidden md:flex"><?php echo $newhora; ?> hrs.</span>
                                                </div>
                                                <h3 class="mt-2  leading-6 text-white">
                                                    <span class="text-2xl md:text-4xl font-semibold">
                                                    <?php echo get_the_title($myid);?>
                                                    </span>
                                                </h3>
                                                <div class="flex items-center gap-x-2 text-xs text-white md:hidden mt-5">
                                                    <span class="leading-none"><?php echo $newdate; ?></span>
                                                    <span class="">|</span>
                                                    <span class="leading-none"><?php echo $newhora; ?> hrs.</span>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>                            
                                <?php
                            }
                            if ($aux == 1 || $aux == 2) {
                                ?>
                                    <?php if ($aux == 1) { ?>
                                    <!-- dos columnas -->                            
                                    <div class="flex flex-col md:flex-row gap-x-8 gap-y-8">
                                            <div class="w-full md:w-1/2">
                                                <article class="w-full notice notice-small">
                                                    <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                                        <div class="w-2/5 relative overflow-hidden">
                                                            <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                        </div>
                                                        <div class="w-3/5">
                                                            <div class="h-full w-full flex flex-col justify-between p-7">
                                                                <div class="w-full">
                                                                    <div class="flex items-center gap-x-2 ">
                                                                        <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                                    </div>
                                                                    <h3 class="mt-2 leading-6 text-white">
                                                                        <span class="text-xl font-medium">
                                                                        <?php echo get_the_title($myid);?>
                                                                        </span>
                                                                    </h3>
                                                                </div>
                                                                <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                                                    <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </article>
                                            </div>
                                        <?php } ?>
                                        <?php if ($aux == 2) { ?>
                                            <div class="w-full md:w-1/2">
                                                <article class="w-full notice notice-small">
                                                    <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                                        <div class="w-2/5 relative overflow-hidden">
                                                            <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                        </div>
                                                        <div class="w-3/5">
                                                            <div class="h-full w-full flex flex-col justify-between p-7">
                                                                <div class="w-full">
                                                                    <div class="flex items-center gap-x-2 ">
                                                                        <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                                    </div>
                                                                    <h3 class="mt-2 leading-6 text-white">
                                                                        <span class="text-xl font-medium">
                                                                        <?php echo get_the_title($myid);?>
                                                                        </span>
                                                                    </h3>
                                                                </div>
                                                                <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                                                    <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </article>
                                            </div>                                
                                    </div>
                                    <?php } ?>
                                <?php
                            }
                            if ($aux == 3) {
                                ?>
                                <!-- una columna -->
                                <div class="flex flex-col gap-y-8">
                                    <article class="w-full notice notice-small">
                                        <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg h-64">
                                            <div class="w-5/12 relative overflow-hidden">
                                                <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            </div>
                                            <div class="w-7/12">
                                                <div class="h-full w-full flex flex-col justify-center p-7">
                                                    <h3 class="text-2xl font-medium leading-6 text-white mb-8">
                                                        <span class="text-2xl font-medium">
                                                        <?php echo get_the_title($myid);?>
                                                        </span>
                                                    </h3>
                                                    <div class="flex items-center gap-x-2 text-sm text-white mt-2">
                                                        <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>|<span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                                <?php
                            }
                            if ($aux == 4 || $aux == 5) {
                                ?>
                                    <?php if ($aux == 4) { ?>                                
                                    <div class="gap-x-8 hidden md:flex">
                                        <div class="w-1/2">
                                            <article class="w-full notice notice-small">
                                                <a href="<?php echo get_permalink($myid); ?>" class="flex bg-gray w-full flex-col items-start justify-between rounded-lg">
                                                    <div class="w-full relative overflow-hidden h-56">
                                                        <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-tr-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                    </div>
                                
                                                    <div class="w-full h-full flex flex-col justify-end p-7">
                                                        <div class="flex items-center gap-x-2 text-white">
                                                            <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                        </div>
                                                        <h3 class="mt-2  leading-6 text-white">
                                                            <span class="text-lg font-normal">
                                                            <?php echo get_the_title($myid);?>
                                                            </span>
                                                        </h3>
                                                        <div class="flex items-center gap-x-2 text-white mt-3 text-sm">
                                                            <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </article>
                                        </div>
                                        <?php } ?>
                                        <?php if ($aux == 5) { ?>
                                        <div class="w-1/2">
                                            <article class="w-full notice notice-small">
                                                <a href="<?php echo get_permalink($myid); ?>" class="flex bg-gray w-full flex-col items-start justify-between rounded-lg">
                                                    <div class="w-full relative overflow-hidden h-56">
                                                        <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-tr-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                    </div>
                                
                                                    <div class="w-full h-full flex flex-col justify-end p-7">
                                                        <div class="flex items-center gap-x-2 text-white">
                                                            <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                        </div>
                                                        <h3 class="mt-2  leading-6 text-white">
                                                            <span class="text-lg font-normal">
                                                            <?php echo get_the_title($myid);?>
                                                            </span>
                                                        </h3>
                                                        <div class="flex items-center gap-x-2 text-white mt-3 text-sm">
                                                            <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </article>
                                        </div>                                
                                    </div>
                                    <?php } ?>
                                <?php
                            }
                        ?>
                        <?php
                            $aux++;
                            endwhile;
                        endif;
                        ?>
                    </div>                    
                    <div class="pag-link px-8">
                        <?php powernature_pagination(); ?>
                    </div>
                    
                    <?php 
                        $publicidad = get_field( 'publicidad', $category );
                        if ($publicidad) {
                    ?>
                    <div class="flex w-full px-8 gap-x-8">
                        <article class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                            <img src="<?php echo $publicidad; ?>" alt="" class="rounded-lg object-cover object-center w-full h-full">
                        </article>
                    </div>
                    <?php } ?>
                </main>
                <?php if (!get_field("desactivar_lateral", "category_".$idCategory)) { ?> 

                <!-- izquierda -->
                <section class="h-full w-full md:w-4/12 pl-5 md:pl-0 pr-5 md:pr-4">
                    <div class="w-full flex flex-col py-8 gap-y-8">                        
                    <?php 
                        $lateral = get_field( 'lateral', 'options');
                        $idcropCat2 = $idCategory;
                        if ($category->parent) {
                            $idcropCat2 = $category->parent;
                        }
                        $lateralCat = get_field( 'lateral', "category_".$idCategory );    
                                                   
                        if ($lateralCat) {
                            $lateral = $lateralCat;
                        }


                        if ($lateral) {
                            foreach ($lateral as $la) {
                                ?>                        
                        <?php if ($la['type'] == "clasificacion") { ?>  
                            <style>#iframeContent p{color: white;} #iframeContent iframe{ width: 100%;} #iframeContent{color: white;}</style>
                            <div class="w-full bg-gray rounded-xl">
                            <?php
                                    $post_id = $la["id"];
                                    echo get_post_field('post_content', $post_id);
                                ?>
                            </div> 
                        <?php } ?>
                        <?php if ($la['type'] == "banner") { ?> 
                            <div class="w-full bg-gray rounded-xl">
                                <div class="flex w-full border-solid border-b border-primary py-3 px-4 flex items-center justify-center min-h-16">
                                    <h2 class="text-xl font-medium text-white"><?php echo $la['banner_titulo']; ?></h2>
                                </div>
                                <div class="w-full flex items-center justify-between">
                                    <img class="w-full rounded-bl-xl rounded-br-xl" src="<?php echo $la['banner_imagen']; ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($la['type'] == "publicidad") { ?> 
                            <div class="w-full">
                                <div class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                    <img src="<?php echo $la['publicidad_imagen']; ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full">
                                    <div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
            
                                    <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-end p-7">
                                        <h3 class=" leading-6 text-white mb-12 w-1/2">
                                            <a href="<?php echo $la['publicidad_link']; ?>" class="text-2xl font-semibold">
                                                <?php echo $la['publicidad_title']; ?>
                                            </a>
                                        </h3>
                                        <span class="mx-auto">
                                            <a href="<?php echo $la['publicidad_link']; ?>" class="outline outline-2 outline-primary text-primary font-medium py-2 px-4 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">MÁS INFORMACIÓN</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($la['type'] == "posts") { ?> 
                            <div class="w-full flex flex-col gap-y-8">
                                <?php
                                    if ( have_posts() ) : ?>
                                    <?php
                                    $aux = 0;
                                    // Start the loop.
                                    while ( have_posts() ) :
                                        the_post();
                                        $myid = get_the_ID();
                                        $date = explode("T", get_the_date('c', $myid))[0];
                                        $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                                        $hora = explode("T", get_the_date('c', $myid))[1];
                                        $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                                        if ($aux < $la['cantidad']) {
                                ?>
                                <div class="w-full">
                                    <article class="w-full notice notice-small">
                                        <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                            <div class="w-2/5 relative overflow-hidden">
                                                <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            </div>
                                            <div class="w-3/5">
                                                <div class="h-full w-full flex flex-col justify-between p-7">
                                                    <div class="w-full">
                                                        <div class="flex items-center gap-x-2 ">
                                                            <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                        </div>
                                                        <h3 class="mt-2 leading-6 text-white">
                                                            <span class="text-xl font-medium">
                                                            <?php echo get_the_title($myid);?>
                                                            </span>
                                                        </h3>
                                                    </div>
                                                    <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                                        <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                                <?php
                                        }
                                    $aux++;
                                    endwhile;
                                endif;
                                ?>
                            </div>
                        <?php } ?>
                                <?php
                            }
                        }
                    ?>
                    </div>
                </section>
                <?php } ?>
                        <?php
                    }
                ?>
            </div>
            <?php
        } else {
            ?>
            <div class="w-full bg-dark-bold flex items-center px-8 justify-center md:justify-start">
                <div class="flex w-full py-5 items-center">
                    <h1 class="text-2xl font-semibold text-white my-auto">
                        <?php echo "Noticias"; ?>
                    </h1>
                    <!-- SEPARATION -->
                    <span class="separation bg-primary mx-8 hidden md:flex"></span>
                    <!-- END SEPARATION -->
                    <?php
                    $aux = 0;
                    $encuentros = get_field('encuentros', 'options');
                    $idcropCat = $idCategory;
                    if ($category->parent) {
                        $idcropCat = $category->parent;
                    }
                    $encuentrosCat = get_field( 'encuentros', "category_".$idcropCat );                          
                    if ($encuentrosCat) {
                        $encuentros = $encuentrosCat;
                    }

                    $existListP = false;
                    if($encuentros){
                        if(count($encuentros) > 0){
                            $existListP = true;
                        }
                    }

                    if($existListP){
                        ?>
                            <p class="text-lg font-normal text-white my-auto hidden md:flex">Próximos encuentros:</p>
                        <?php
                    }
                    ?>
                    <div class="hidden md:flex items-center px-4 h-full">
                        <?php 
                            
                            if ($encuentros) {
                                foreach ($encuentros as $enc) {
                                    ?>
                                <?php if ($aux != 0) {?> <div class="w-px h-12 bg-gray-light"></div> <?php } ?>
                                <div class="flex items-center h-full px-8" id="bombita22">
                                    <div class="flex flex-col items-center">
                                        <img class="h-7" src="<?php echo $enc['logo_equipo_local']; ?>" alt="">
                                        <span class="text-white text-s text-normal mt-0.5 leading-none"><?php echo $enc['equipo_local']; ?></span>
                                    </div>
                                    <div class="flex flex-col items-center px-4">
                                        <span class="text-white text-s leading-tight"><?php echo $enc['fecha']; ?></span>
                                        <span class="text-white text-s leading-tight"><?php echo $enc['hora']; ?></span>
                                        <span class="text-white text-s leading-tight font-bold">VS</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <img class="h-7" src="<?php echo $enc['logo_equipo_visitante']; ?>" alt="">
                                        <span class="text-white text-s text-normal mt-1 leading-none"><?php echo $enc['equipo_visitante']; ?></span>
                                    </div>
                                </div>
                                    <?php
                                $aux++;
                                }
                            }
                        ?>
                    </div>
                </div>
            </div> 
            <div class="flex flex-col md:flex-row gap-x-8 h-full">
                <aside class="w-full md:w-2/12">
                    <div class="bg-gray">
                        <ul class="w-full flex flex-row md:flex-col flex-nowrap md:flex-wrap overflow-auto py-0 md:py-4">
                            <?php 
                                $idcrop = $idCategory;
                                if ($category->parent) {
                                    $idcrop = $category->parent;
                                }
                                $taxonomy     = 'category';
                                $orderby      = 'menu_order';
                                $empty        = 0;
                                $args = array(
                                    'taxonomy'     => $taxonomy,
                                    'orderby'      => $orderby,
                                    'hide_empty'   => $empty,
                                    'parent'       => 0,
                                );
                                $selfcategories = get_categories( $args );
                                if ($selfcategories) {
                                    foreach ($selfcategories as $self) {
                                        $link = get_term_link($self->slug, 'category');
                                        $name = $self->name;
                                        $actives = "";
                                        if ($idCategory == $self->term_id) {
                                            $actives = "background: #121313";
                                        }
                                        ?>
                                        <li class="w-full" data-id="<?php echo $self->term_id; ?>">
                                            <a href="<?php echo $link; ?>" style="<?php echo $actives;?>" class="w-full text-white flex items-center py-4 hover:bg-dark-bold focus:bg-dark-bold active:bg-dark-bold duration-3 transition-all px-8">
                                                <?php
                                                    if (get_field( 'icon', "category_".$self->term_id )) {
                                                        ?>
                                                    <img class="h-7 mr-4" src="<?php echo get_field( 'icon', "category_".$self->term_id ); ?>">
                                                        <?php
                                                    }
                                                ?>
                                                <span class="text-base font-normal whitespace-nowrap md:whitespace-pre-wrap"><?php echo $name; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </aside>
                <main class="h-full w-full md:w-7/12 px-5 md:px-0">
                    <div class="flex flex-col w-full py-8 px-8 px-8 gap-y-8">
                      
                        <!--
                        <div class="flex w-full border-solid border-b border-gray-light py-3 flex items-center overflow-auto">
                            <span class="mr-6">
                                <img class="w-8" src="assets/img/icons/menu-4.svg" alt="">
                            </span>
                            <h1 class="text-xl font-semibold text-white whitespace-nowrap">
                                SERIE A
                            </h1>
                            <div class="w-px h-12 bg-gray-light mx-8"></div>
                            <div class="flex items-center">
                                <span class="rounded-3xl border border-primary py-2 px-4 text-base font-medium text-primary bg-gray-tag mr-4">Todos</span>
                                <div class="flex items-center gap-x-4">
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-1.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-2.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-3.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-4.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-6.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-7.svg" alt="">
                                    </a>
                                    <a class="w-12 h-12 bg-gray rounded-full p-2 cursor-pointer mx-2">
                                        <img class="w-full max-w-full max-h-full" src="assets/img/icons/sub-8.svg" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        -->
                        <?php
                            if ( have_posts() ) : ?>
                            <?php
                            $aux = 0;
                            // Start the loop.
                            while ( have_posts() ) :
                                the_post();
                                $myid = get_the_ID();
                                $date = explode("T", get_the_date('c', $myid))[0];
                                $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                                $hora = explode("T", get_the_date('c', $myid))[1];
                                $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                        ?>
                        <?php 
                            if ($aux == 0) {
                                ?>
                                <div class="w-full">
                                    <article class="w-full notice notice-small">
                                        <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg">
                                            <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            <div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
                        
                                            <div class="absolute top-0 left-0 w-full md:w-9/12 h-full flex flex-col justify-end p-7">
                                                <div class="flex items-center gap-x-2 text-xs text-white">
                                                    <span class="text-warning leading-none"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                    <span class="hidden md:flex">|</span>
                                                    <span class="leading-none hidden md:flex"><?php echo $newdate; ?></span>
                                                    <span class="hidden md:flex">|</span>
                                                    <span class="leading-none hidden md:flex"><?php echo $newhora; ?> hrs.</span>
                                                </div>
                                                <h3 class="mt-2  leading-6 text-white">
                                                    <span class="text-2xl md:text-4xl font-semibold">
                                                    <?php echo get_the_title($myid);?>
                                                    </span>
                                                </h3>
                                                <div class="flex items-center gap-x-2 text-xs text-white md:hidden mt-5">
                                                    <span class="leading-none"><?php echo $newdate; ?></span>
                                                    <span class="">|</span>
                                                    <span class="leading-none"><?php echo $newhora; ?> hrs.</span>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>                            
                                <?php
                            }
                            if ($aux == 1 || $aux == 2) {
                                ?>
                                    <?php if ($aux == 1) { ?>                                    
                                <div class="flex flex-col md:flex-row gap-x-8 gap-y-8">
                                        <div class="w-full md:w-1/2">
                                            <article class="w-full notice notice-small">
                                                <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                                    <div class="w-2/5 relative overflow-hidden">
                                                        <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                    </div>
                                                    <div class="w-3/5">
                                                        <div class="h-full w-full flex flex-col justify-between p-7">
                                                            <div class="w-full">
                                                                <div class="flex items-center gap-x-2 ">
                                                                    <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                                </div>
                                                                <h3 class="mt-2 leading-6 text-white">
                                                                    <span class="text-xl font-medium">
                                                                    <?php echo get_the_title($myid);?>
                                                                    </span>
                                                                </h3>
                                                            </div>
                                                            <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                                                <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </article>
                                        </div>
                                    <?php } ?>
                                    <?php if ($aux == 2) { ?>
                                        <div class="w-full md:w-1/2">
                                            <article class="w-full notice notice-small">
                                                <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                                    <div class="w-2/5 relative overflow-hidden">
                                                        <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                    </div>
                                                    <div class="w-3/5">
                                                        <div class="h-full w-full flex flex-col justify-between p-7">
                                                            <div class="w-full">
                                                                <div class="flex items-center gap-x-2 ">
                                                                    <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                                </div>
                                                                <h3 class="mt-2 leading-6 text-white">
                                                                    <span class="text-xl font-medium">
                                                                    <?php echo get_the_title($myid);?>
                                                                    </span>
                                                                </h3>
                                                            </div>
                                                            <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                                                <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </article>
                                        </div>                                
                                </div>
                                    <?php } ?>
                                <?php
                            }
                            if ($aux == 3) {
                                ?>
                                <div class="flex flex-col gap-y-8">
                                    <article class="w-full notice notice-small">
                                        <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg h-64">
                                            <div class="w-5/12 relative overflow-hidden">
                                                <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            </div>
                                            <div class="w-7/12">
                                                <div class="h-full w-full flex flex-col justify-center p-7">
                                                    <h3 class="text-2xl font-medium leading-6 text-white mb-8">
                                                        <span class="text-2xl font-medium">
                                                        <?php echo get_the_title($myid);?>
                                                        </span>
                                                    </h3>
                                                    <div class="flex items-center gap-x-2 text-sm text-white mt-2">
                                                        <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>|<span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                                <?php
                            }
                            if ($aux == 4 || $aux == 5) {
                                ?>
                                    <?php if ($aux == 4) { ?>                                
                                <div class="gap-x-8 hidden md:flex">
                                    <div class="w-1/2">
                                        <article class="w-full notice notice-small">
                                            <a href="<?php echo get_permalink($myid); ?>" class="flex bg-gray w-full flex-col items-start justify-between rounded-lg">
                                                <div class="w-full relative overflow-hidden h-56">
                                                    <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-tr-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                </div>
                            
                                                <div class="w-full h-full flex flex-col justify-end p-7">
                                                    <div class="flex items-center gap-x-2 text-white">
                                                        <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                    </div>
                                                    <h3 class="mt-2  leading-6 text-white">
                                                        <span class="text-lg font-normal">
                                                        <?php echo get_the_title($myid);?>
                                                        </span>
                                                    </h3>
                                                    <div class="flex items-center gap-x-2 text-white mt-3 text-sm">
                                                        <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </article>
                                    </div>
                                    <?php } ?>
                                    <?php if ($aux == 5) { ?>
                                    <div class="w-1/2">
                                        <article class="w-full notice notice-small">
                                            <a href="<?php echo get_permalink($myid); ?>" class="flex bg-gray w-full flex-col items-start justify-between rounded-lg">
                                                <div class="w-full relative overflow-hidden h-56">
                                                    <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-tr-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                                </div>
                            
                                                <div class="w-full h-full flex flex-col justify-end p-7">
                                                    <div class="flex items-center gap-x-2 text-white">
                                                        <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                    </div>
                                                    <h3 class="mt-2  leading-6 text-white">
                                                        <span class="text-lg font-normal">
                                                        <?php echo get_the_title($myid);?>
                                                        </span>
                                                    </h3>
                                                    <div class="flex items-center gap-x-2 text-white mt-3 text-sm">
                                                        <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </article>
                                    </div>                                
                                </div>
                                    <?php } ?>
                                <?php
                            }
                        ?>
                        <?php
                            $aux++;
                            endwhile;
                        endif;
                        ?>
                    </div>                    
                    <div class="pag-link px-8">
                        <?php powernature_pagination(); ?>
                    </div>
                   
                </main>
                <section class="h-full w-full md:w-4/12 pl-5 md:pl-0 pr-5 md:pr-4">
                    <div class="w-full flex flex-col py-8 gap-y-8">                        
                    <?php 
                        $lateral = get_field( 'lateral', 'options');
                        if ($lateral) {
                            foreach ($lateral as $la) {
                                ?>                        
                        <?php if ($la['type'] == "clasificacion") { ?>   
                            <style>#iframeContent p{color: white;} #iframeContent iframe{ width: 100%;} #iframeContent{color: white;}</style>
                            <div class="w-full bg-gray rounded-xl">
                                <?php
                                    $post_id = $la["id"];
                                    echo get_post_field('post_content', $post_id);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if ($la['type'] == "banner") { ?> 
                            <div class="w-full bg-gray rounded-xl">
                                <div class="flex w-full border-solid border-b border-primary py-3 px-4 flex items-center justify-center min-h-16">
                                    <h2 class="text-xl font-medium text-white"><?php echo $la['banner_titulo']; ?></h2>
                                </div>
                                <div class="w-full flex items-center justify-between">
                                    <img class="w-full rounded-bl-xl rounded-br-xl" src="<?php echo $la['banner_imagen']; ?>" alt="">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($la['type'] == "publicidad") { ?> 
                            <div class="w-full">
                                <div class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                    <img src="<?php echo $la['publicidad_imagen']; ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full">
                                    <div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
            
                                    <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-end p-7">
                                        <h3 class=" leading-6 text-white mb-12 w-1/2">
                                            <a href="<?php echo $la['publicidad_link']; ?>" class="text-2xl font-semibold">
                                                <?php echo $la['publicidad_title']; ?>
                                            </a>
                                        </h3>
                                        <span class="mx-auto">
                                            <a href="<?php echo $la['publicidad_link']; ?>" class="outline outline-2 outline-primary text-primary font-medium py-2 px-4 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">MÁS INFORMACIÓN</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($la['type'] == "posts") { ?> 
                            <div class="w-full flex flex-col gap-y-8">
                                <?php
                                    if ( have_posts() ) : ?>
                                    <?php
                                    $aux = 0;
                                    // Start the loop.
                                    while ( have_posts() ) :
                                        the_post();
                                        $myid = get_the_ID();
                                        $date = explode("T", get_the_date('c', $myid))[0];
                                        $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                                        $hora = explode("T", get_the_date('c', $myid))[1];
                                        $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                                        if ($aux < $la['cantidad']) {
                                ?>
                                <div class="w-full">
                                    <article class="w-full notice notice-small">
                                        <a href="<?php echo get_permalink($myid); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                            <div class="w-2/5 relative overflow-hidden">
                                                <img src="<?php echo get_the_post_thumbnail_url($myid); ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            </div>
                                            <div class="w-3/5">
                                                <div class="h-full w-full flex flex-col justify-between p-7">
                                                    <div class="w-full">
                                                        <div class="flex items-center gap-x-2 ">
                                                            <span class="text-warning leading-none text-sm"><?php echo get_the_category( $myid )[0]->name;?></span>
                                                        </div>
                                                        <h3 class="mt-2 leading-6 text-white">
                                                            <span class="text-xl font-medium">
                                                            <?php echo get_the_title($myid);?>
                                                            </span>
                                                        </h3>
                                                    </div>
                                                    <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                                        <span class="leading-none text-sm"><?php echo $newdate; ?></span>|<span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                                <?php
                                        }
                                    $aux++;
                                    endwhile;
                                endif;
                                ?>
                            </div>
                        <?php } ?>
                                <?php
                            }
                        }
                    ?>
                    </div>
                </section>
            </div>
            <?php
        }
    ?>
</div>
<style>
    body.category-liga-1-primera-division-pronostico-futbol-nacional .flex.w-full.border-solid.border-b.border-gray-light.py-3.flex.items-center.overflow-auto {
        display: none;
    }
    body.category-seleccion-peruana-pronostico-futbol-nacional .flex.w-full.border-solid.border-b.border-gray-light.py-3.flex.items-center.overflow-auto {
        display: none;
    }
    .home {
        background-color: #181B1E !important;
    }
    .navigation a svg {
    width: 14px;
    height: 14px;
    display: block;
    position: relative;
    top: 3px;
    left: 4px;
}
.navigation a svg path {
    fill: white;
    stroke: white;
}
.navigation a {
    color: white;
    border: solid 1px #4fc1a7;
    width: 24px;
    height: 24px;
    text-align: center;
    line-height: 24px;
    font-size: 16px;
    border-radius: 50%;
    margin: 0px 5px;
}
.navigation span.current {
    background: #4fc1a7;
    width: 24px;
    height: 24px;
    text-align: center;
    line-height: 24px;
    font-size: 16px;
    border-radius: 50%;
    color: white;
    border: solid 1px #4fc1a7;
    margin: 0px 5px;
}
.navigation {
    display: flex;
    margin-bottom: 20px;
}
</style>
<!-- section index end -->
<?php get_footer(); ?>

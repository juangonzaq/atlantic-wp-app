<?php /* Template Name: home */
set_query_var('ENTRY', 'home');
get_header();
?>
<!-- home content -->
<style>
.scroll-disabled{
    width: 100vw;
    height: 100vh;
    overflow: hidden;
}

.swipper-gallery .swiper-wrapper .swiper-slide img{
    object-fit: contain;
}
</style>
<main class="main-container min-h-full bg-dark px-5 md:px-8 py-8 margin-top-header">
    <!-- BANNER -->
    <?php
        $banner = get_field("banner"); 
        if($banner) {
    ?>
    <section class="w-full h-72 relative overflow-hidden">
        <div class="swiper h-full w-full" id="swiper-banner">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php 
                    foreach ($banner as $ban) {
                        ?>
                        <div class="swiper-slide px-0 md:px-12">
                            <div class="h-full w-full rounded-xl relative overflow-hidden">
                                <img class="object-cover w-full h-full" src="<?php echo $ban["imagen"]; ?>" alt="">
                                <div class="absolute top-0 left-0 w-full md:w-1/3 h-full flex flex-col justify-end md:justify-center px-16 pb-12 md:pb-0">
                                    <h1 class="hidden md:flex text-2xl text-white mb-5 font-bold "><?php echo $ban["title"]; ?></h1>
                                    <span class="mx-auto md:mx-0">
                                    <a href="<?php echo $ban["link"]; ?>" class="w-full md:w-auto bg-primary text-primary font-semibold py-4 md:py-3 px-10 md:px-8 rounded-lg text-dark hover:bg-primary hover:text-dark text-lg md:text-base"><?php echo $ban["link_text"]; ?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <!-- If we need pagination -->
            <div id="swiper-pagination-banner" class="swiper-pagination z-10 flex justify-center"></div>
        
            <!-- If we need navigation buttons -->
            <div class="hidden md:flex at-swiper-button-prev absolute text-white left-2 top-center cursor-pointer z-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="hidden md:flex at-swiper-button-next absolute text-white right-2 top-center cursor-pointer z-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 011.06-1.06l7.5 7.5z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </section>
    <?php } ?>
    <!-- END BANNER -->
    <!-- HOME -->
    <?php
        $builder = get_field("builder"); 
        if($builder) {
            foreach ($builder as $item) {
    ?>
    <section class="main-container mx-auto flex flex-col mt-4 gap-x-8 gap-y-6 px-0 md:px-12">
        <?php 
            if ($item['title']) {
                ?>                
        <div class="flex w-full border-solid border-b border-gray-light py-3">
            <h1 class="text-base md:text-2xl font-semibold text-white">
                <?php echo $item['title']; ?>
            </h1>
            <span class="border-solid border-l border-primary text-primary ml-5 flex items-center px-5">
                <a href="<?php echo $item['link']; ?>" class="flex items-center">
                    <?php echo $item['link_text']; ?>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>						  
                </a>
            </span>
        </div>
                <?php
            }
        ?>
        <div class="w-full flex flex-col md:flex-row gap-x-8 gap-y-8 mt-0">
            <?php 
                $left = $item["lado_izquierdo"];
            ?>
            <div class="w-full md:w-3/5 text-white flex flex-col gap-y-8">
                <?php 
                    if ($left) {
                        foreach ($left as $l) {
                ?>
                    <?php if ($l['type'] == "article-full") {
                        $idnoticia = $l["idnoticiafull"];
                        $date = explode("T", get_the_date('c', $idnoticia))[0];
                        $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                        $hora = explode("T", get_the_date('c', $idnoticia))[1];
                        $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                        ?>
                        <article class="w-full notice">
                            <a href="<?php echo get_permalink($idnoticia);?>" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg">
                                <img src="<?php echo get_the_post_thumbnail_url($idnoticia);?>" alt="" class="rounded-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                <div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
            
                                <div class="absolute top-0 left-0 w-full md:w-9/12 h-full flex flex-col justify-end p-7">
                                    <div class="flex items-center gap-x-2 text-xs text-white">
                                        <span class="text-warning leading-none"><?php echo get_the_category( $idnoticia )[0]->name;?></span>
                                        <span class="hidden md:flex">|</span>
                                        <span class="leading-none hidden md:flex"><?php echo $newdate; ?></span>
                                        <span class="hidden md:flex">|</span>
                                        <span class="leading-none hidden md:flex"><?php echo $newhora; ?> hrs.</span>
                                    </div>
                                    <h3 class="mt-2  leading-6 text-white">
                                        <span class="text-2xl font-semibold">
                                            <?php echo get_the_title($idnoticia);?>
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
                        <?php
                    }?>
                    <?php if ($l['type'] == "article-two") {
                        $articles = $l["articles"];
                        if ($articles) {
                            ?>
                            <div class="flex flex-col md:flex-row gap-x-8 gap-y-8">
                            <?php
                            foreach ($articles as $article) {
                                $idnoticia = $article["id"];
                                $date = explode("T", get_the_date('c', $idnoticia))[0];
                                $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                                $hora = explode("T", get_the_date('c', $idnoticia))[1];
                                $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                               ?>
                               <div class="w-full md:w-1/2">
                                    <article class="w-full notice notice-small">
                                        <a href="<?php echo get_permalink($idnoticia);?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                            <div class="w-2/5 relative overflow-hidden">
                                                <img src="<?php echo get_field('imagen_miniatura', $idnoticia);?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            </div>
                                            <div class="w-3/5">
                                                <div class="h-full w-full flex flex-col justify-between p-7">
                                                    <div class="w-full">
                                                        <div class="flex items-center gap-x-2 ">
                                                            <span class="text-warning leading-none text-sm"><?php echo get_the_category( $idnoticia )[0]->name;?></span>
                                                        </div>
                                                        <h3 class="mt-2 leading-6 text-white paragraph-cut-2" title="<?php echo get_the_title($idnoticia);?>">
                                                            <span class="text-xl font-medium">
                                                            <?php echo get_the_title($idnoticia);?>
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
                            ?>
                            </div>
                            <?php
                        }
                        ?>
                        
                        <?php
                    }?>
                    <?php if ($l['type'] == "publicidad") { 
                        ?>
                        <div class="flex w-full gap-x-8">
                            <article class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                <img src="<?php echo $l["imagen_publicidad"];?>" alt="" class="rounded-lg object-cover object-center w-full h-full">
                            </article>
                        </div>
                    <?php
                    }?> 
                <?php
                        }
                    }
                ?>
                
            </div>
            <div class="w-full md:w-2/5 text-white">
                <?php 
                    $right = $item["lado_derecho"];
                ?>
                <div class="flex flex-col gap-y-8">
                    <?php 
                        if ($right) {
                            $aux = 0;
                            foreach ($right as $r) {
                    ?>
                        <?php if ($r['type'] == "articles") {?>
                            <?php if ($r['articles']) {
                                foreach ($r['articles'] as $article) {
                                    $idnoticia = $article["id"];
                                    $date = explode("T", get_the_date('c', $idnoticia))[0];
                                    $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                                    $hora = explode("T", get_the_date('c', $idnoticia))[1];
                                    $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                                   ?>
                                   <article class="w-full notice notice-small">
                                        <a href="<?php echo get_permalink($idnoticia);?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                            <div class="w-2/5 md:w-1/3 relative overflow-hidden">
                                                <img src="<?php echo get_field('imagen_miniatura', $idnoticia);?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                            </div>
                                            <div class="w-3/5 md:w-2/3">
                                                <div class="h-full w-full flex flex-col justify-between p-7">
                                                    <div class="flex">
                                                        <span class="text-warning leading-none text-sm"><?php echo get_the_category( $idnoticia )[0]->name;?></span>
                                                    </div>
                                                    <h3 class="text-lg font-semibold leading-6 text-white paragraph-cut-2" title="<?php echo get_the_title($idnoticia);?>">
                                                        <span class="text-xl font-medium">
                                                            <?php echo get_the_title($idnoticia);?>
                                                        </span>
                                                    </h3>
                                                    <div class="flex items-center gap-x-2 text-sm text-white mt-2">
                                                        <!-- <span class="text-warning leading-none text-sm hidden md:flex"><?php echo get_the_category( $idnoticia )[0]->name;?></span>
                                                        <span class=" hidden md:flex">|</span> -->
                                                        <span class="leading-none text-sm"><?php echo $newdate; ?></span>
                                                        <span class="">|</span>
                                                        <span class="leading-none text-sm"><?php echo $newhora; ?> hrs.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                   <?php
                                }
                            ?>
                            <?php } ?>
                        <?php } ?>
                        <?php if ($r['type'] == "publicidad") {?>
                            <div class="<?php if ($aux != 0) { echo "mt-1"; } ?>">
                                <div class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                    <img src="<?php echo $r['imagenpublicidad']; ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full">
                                    <div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>

                                    <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-end p-7">
                                        <h3 class=" leading-6 text-white mb-12 w-1/2">
                                            <a href="<?php echo $r['linkpublicidad']; ?>" target="_blank" class="text-2xl font-semibold">
                                                <?php echo $r['titlepublicidad']; ?>
                                            </a>
                                        </h3>
                                        <span class="mx-auto">
                                            <a href="<?php echo $r['linkpublicidad']; ?>" target="_blank" class="outline outline-2 outline-primary text-primary font-medium py-2 px-4 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">MÁS INFORMACIÓN</a>
                                        </span>
                                    </div>
                                </div>
                            </div>                            
                        <?php } ?>
                    <?php
                            $aux++;
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- HOME END -->
    <?php }} ?>
    <!-- GALERÍA DE FOTOS -->
		<section class="main-container mx-auto flex flex-col mt-12 gap-x-8 px-0 md:px-12">
			<div class="flex w-full border-solid border-b border-gray-light py-3">
				<h1 class="text-2xl font-semibold text-white pr-2 md:pr-0">
					GALERÍA DE FOTOS
				</h1>
				<!--<span class="border-solid border-l border-primary text-primary ml-0 md:ml-5 flex items-center px-5">
					<a href="<?php echo site_url(); ?>/noticias" class="flex items-center whitespace-nowrap">
						VER MÁS
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
							<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
						</svg>						  
					</a>
				</span>-->
			</div>

			<div class="w-full flex gap-x-8 gap-y-8 mt-8">
				<section class="w-full relative overflow-hidden">
					<div id="swiper-card" class="swiper relative h-full w-full">
						<!-- <div class="absolute top-0 right-0 bg-dark w-1/3 h-full z-10 opacity-75"></div> -->

						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
							<!-- Slides -->
                            <?php 
                                $fots = get_field("galeria");
                                if($fots) {
                                    foreach ($fots as $fot) {
                                        $id = $fot['id'];
                                        if (get_field('fotos', $id)) {
                                            $cant = count(get_field('fotos', $id));
                                        }                                        
                                        ?>                                
							<div class="swiper-slide pr-3">
								<article class="notice notice-gallery-open cursor-pointer flex bg-gray w-full flex-col items-start justify-between rounded-lg h-full" data-id="swiper-<?php echo $id; ?>">
                                    <div class="w-full">
                                        <div class="w-full relative overflow-hidden h-64">
                                            <img src="<?php echo get_the_post_thumbnail_url($id); ?>" alt="<?php echo get_the_title($id); ?>" class="rounded-tl-lg rounded-tr-lg object-cover object-center w-full h-full notice-image h-full">
                                        </div>				
                                    </div>
									<div class="w-full h-full flex flex-col justify-between p-7 h-full">
                                        <div class="w-full">
                                            <div class="flex items-center gap-x-2 text-white">
                                                <span class="text-warning leading-none text-sm">                                                
                                                    <?php 
                                                        $term_name = get_term( get_field('category', $id) )->name;
                                                        echo $term_name; ?>
                                                </span>
                                            </div>
                                            <h3 class="mt-2  leading-6 text-white">
                                                <a href="#" class="text-lg font-normal">
                                                    <?php echo get_the_title($id); ?>
                                                </a>
                                            </h3>
                                        </div>
                                        <?php
                                            if (get_field('fotos', $id)) {
                                                ?>
                                                <div class="flex items-center gap-x-2 text-white mt-3">
                                                    <span class="leading-none text-sm"><?php echo $cant; ?> fotos</span>
                                                </div>
                                                <?php
                                            }
                                        ?>
									</div>
								</article>
							</div>
                                        <?php
                                    }
                                }
                            ?>
						</div>
					
						<!-- If we need navigation buttons -->
			
						<div class="at-swiper-button-next absolute text-primary right-2 top-center-5xl cursor-pointer z-10 text-5xl">
							<span class="mdi mdi-chevron-right text-5xl"></span>
						</div>
					</div>
				</section>
			</div>
		</section>
        <?php
            $fots = get_field("galeria");
            if($fots) {
                foreach ($fots as $fot) {
                    $id = $fot['id'];
        ?>                        
        <div class="modal-gallery fixed z-19 top-modal-header h-with-head left-0 w-screen hidden" id="swiper-<?php echo $id; ?>" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!-- class="gallery-content w-full h-full bg-dark flex justify-center overflow-auto" -->
            <div class="flex flex-col justify-center items-center w-full h-full bg-dark">
                <div class="relative w-full h-full max-h-full flex flex-col items-center justify-center">
                    <!-- <div class="w-full flex justify-end mb-4 items-center pr-14">
                        <button href="" class="flex items-center close"  data-id="swiper-<?php echo $id; ?>">
                            <span class="text-primary text-lg font-normal  hover:underline cursor-pointer">Cerrar</span>
                            <span class=" mdi mdi-close text-primary text-xl font-normal hover:underline cursor-pointer ml-2"></span>
                        </button>
                    </div> -->
                    <div class="w-full mb-12 md:mb-4 mt-20 md:mt-0 flex flex-col md:flex-row justify-end items-center" style="width: 72%;">
                        <!-- <p class="text-base font-medium text-white order-2 md:order-1"><?php echo get_the_title($id); ?></p> -->
                        <button href="" class="flex items-center close ml-auto md:ml-5 mb-5 md:mb-0 order-1 md:order-2"  data-id="swiper-<?php echo $id; ?>">
                            <!-- <span class="text-primary text-2xl md:text-lg font-normal  hover:underline cursor-pointer">Cerrar</span> -->
                            <span class=" mdi mdi-close text-primary text-4xl font-normal hover:underline cursor-pointer ml-2"></span>
                        </button>
                    </div>
                    <div class="swiper swipper-gallery max-h-full flex items-center w-full" data-modal-id="swiper-<?php echo $id; ?>">
                        <div class="swiper-wrapper h-full max-h-full">
                            <?php 
                                if (get_field('fotos', $id)) {
                                    foreach (get_field('fotos', $id) as $foto) {
                                        ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo $foto['foto'];?>" />
                                    </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <div class="w-full py-8" style="width: 71.5%;">
                        <div class="w-full flex justify-between items-start">
                            <div class="flex mr-0 md:mr-8 content-white pr-3 md:pr-80">
                                <p class="text-base font-normal text-white-modal">
                                    <?php
                                        $my_postid = $id;//This is page id or post id
                                        $content_post = get_post($my_postid);
                                        $content = $content_post->post_content;
                                        $content = apply_filters('the_content', $content);
                                        $content = str_replace(']]>', ']]&gt;', $content);
                                        echo $content;
                                    ?>
                                </p>
                            </div>
                            <div class="hidden md:flex items-start">
                                <span class="h-10 w-10 rounded-full border-2 border-white border-solid p-2 cursor-pointer swiper-gallery-button-prev flex justify-center items-center mr-4">
                                    <span class="mdi mdi-chevron-left text-white text-4xl font-medium"></span>
                                </span>
                                <span class="h-10 w-10 rounded-full border-2 border-white border-solid p-2 cursor-pointer swiper-gallery-button-next flex justify-center items-center">
                                    <span class="mdi mdi-chevron-right text-white text-4xl font-medium"></span>
                                </span>
                            </div>
                        </div>
                        <div class="w-full border-b border-solid border-gray-light pt-6 flex items-center justify-end gallery-pagination">
                            <span class="text-base font-normal text-white gallery-pagination__page">1</span>
                            <span class="w-px mx-2 bg-primary h-4 incline"></span>
                            <span class="text-base font-normal text-white gallery-pagination__pages">0</span>
                            <div class="gallery-pagination__border">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } }?>
    <!-- INSTAGRAM -->
        <section class="main-container mx-auto flex flex-col mt-12 gap-x-8 px-0 md:px-12">
			<div class="flex w-full">
				<h2 class="text-2xl font-semibold text-white mx-auto text-center">
					Síguenos en Instagram
					<a href="https://www.instagram.com/atlanticcityperu/" target="_blank" class="text-primary text-2xl font-semibold">@atlanticcitysports</a>
				</h2>
			</div>
			<div class="w-full flex flex-wrap gap-y-2 mt-4 md:mt-4">
				<?php echo do_shortcode("[instagram-feed feed=1]"); ?>
			</div>
		</section>
</main>
<?php
get_footer();
?>

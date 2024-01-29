<?php /* Template Name: promociones */
set_query_var('ENTRY', 'home');
get_header();
?>
<style>
    .swiper-slide.after::after{
        border-radius: .5rem;
    }

    .swiper-slide.hide-back.slide-cover::after{
        display: none !important;
        content: none !important;
    }
</style>
<div class="min-h-full bg-dark pb-24">
    <div class="py-28">
        <div class="w-full px-8 md:px-12">
            <div class="flex w-full border-solid border-b border-gray-light pb-3 justify-center md:justify-start">
                <h1 class="text-2xl font-semibold text-white">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>
        <div class="flex gap-x-8 h-full py-8">
            <main class="w-full flex flex-wrap px-4 md:px-8">
                <!-- <div class="w-full flex flex-col gap-y-8 px-4 md:px-8"> -->
                    <!-- BANNER -->
                    <!-- <section class="w-full h-72 relative overflow-hidden">
                        <div class="swiper h-full w-full" id="swiper-banner">
                            <div class="swiper-wrapper">
                                <?php 
                                    $banner = get_field("banner");
                                    if ($banner) {
                                        foreach ($banner as $ba) {
                                            ?>
                                <div class="swiper-slide px-0 md:px-12">
                                    <div class="h-full w-full rounded-xl relative overflow-hidden">
                                        <img class="object-cover w-full h-full" src="<?php echo $ba['imagen']; ?>" alt="">
                                        <div class="absolute top-0 left-0 w-full md:w-1/3 h-full flex flex-col justify-end md:justify-center px-16 pb-12 md:pb-0">
                                            <h1 class="hidden md:flex text-2xl text-white mb-5 font-bold "><?php echo $ba['title']; ?></h1>
                                            <span class="mx-auto md:mx-0">
                                            <a href="<?php echo $ba['link']; ?>" target="_blank" class="w-full md:w-auto bg-primary text-primary font-semibold py-3 px-8 rounded text-dark hover:bg-primary hover:text-dark">
                                             <?php echo $ba['link_text']; ?>
                                            </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                            <?php
                                        }
                                    }
                                ?>
                            </div>
                            <div class="swiper-pagination z-10 flex justify-center"></div>
                        
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
                    </section> -->
                    <!-- END BANNER -->
                <!-- </div> -->
                <!-- <div class="w-full flex gap-x-8 pl-4 md:pl-20 pr-0 md:pr-20"> -->
                    <?php 
                        $cardCount = get_field("card");
                    ?>
                    <!-- <div id="swiper-card" class="swiper relative h-full w-full" data-count="<?php echo $cardCount?count($cardCount):0; ?>"> -->
                        <!-- <div class="swiper-wrapper"> -->
                            <?php 
                                $card = get_field("card");
                                if ($card) {
                                    foreach ($card as $ca) {
                            ?>
                            <!-- <div class="swiper-slide hide-back after pr-3"> -->

                            <div class="w-full md:w-4/12 px-4 mb-6">
                                <div class=" flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                    <img src="<?php echo $ca['imagen']; ?>" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full">
                                    <div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
            
                                    <div class="absolute top-0 left-0 w-full h-full flex flex-col justify-end p-7">
                                        <h3 class=" leading-6 text-white mb-12 w-full md:w-1/2">
                                            <a href="<?php echo $ca['link']; ?>" target="_blank" class="text-2xl md:text-3xl font-semibold">
                                            <?php echo $ca['text']; ?>
                                            </a>
                                        </h3>
                                        <span class="mx-auto">
                                            <a href="<?php echo $ca['link']; ?>" target="_blank"  class="outline outline-2 outline-primary text-primary font-medium py-2 px-4 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">MÁS INFORMACIÓN</A>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->
                            <?php
                                        }
                                    }
                                ?>
                        <!-- </div> -->
                    <!-- </div> -->
                <!-- </div> -->
            </main>
        </div>
    </div>
</div>
<?php
get_footer();
?>
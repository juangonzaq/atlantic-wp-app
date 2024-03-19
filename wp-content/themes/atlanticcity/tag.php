<?php get_header(); ?>
<main class="-screen relative flex flex-col bg-dark pb-24">
    <div class="w-full h-70-screen relative" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>'); background-repeat: no-repeat; background-size: cover;">
        <div class="w-full h-full absolute top-0 lef-0 bg-gradient-dark"></div>
    </div>
    <div class="w-full relative px-4 md:px-0">
        <div class="w-full md:w-9/12 mx-auto z-20 bg-gray py-12 px-8 rounded-xl mt--6">
            <h1 class="text-3xl mb-6 text-white px-4">Tag: <?php single_tag_title(); ?></h1>

            <div class="flex flex-wrap gap-y-8">
                <?php if (have_posts()) : while (have_posts()) : the_post(); 
                $myid = get_the_ID();
                $date = explode("T", get_the_date('c', $myid))[0];
                $newdate = explode("-", $date)[2]."/".explode("-", $date)[1]."/".explode("-", $date)[0];
                $hora = explode("T", get_the_date('c', $myid))[1];
                $newhora = explode(":", $hora)[0].":".explode(":", $hora)[1];
                ?>
                    <div class="w-full md:w-6/12 lg:w-4/12 px-4">
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
                                        <h3 class="mt-2 leading-6 text-white paragraph-cut-2" title="<?php echo get_the_title($myid);?>">
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
                <?php endwhile; else: ?>
                    <p>No hay posts con este tag.</p>
                <?php endif; ?>
            </div>

            <div class="mt-12">
                <?php the_posts_pagination(); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>

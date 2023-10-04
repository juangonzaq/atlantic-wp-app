<?php get_header(); ?>

<main class="-screen relative flex flex-col bg-dark pb-24">
    <div class="w-full h-80-screen relative" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>'); background-repeat: no-repeat; background-size: cover;background-position: center;">
        <div class="w-full h-full absolute top-0 lef-0 bg-gradient-dark"></div>
    </div>

    <div class="w-full relative px-4 md:px-0">
        <div class="w-full md:w-9/12 mx-auto z-20 bg-gray py-12 px-8 rounded-xl mt--6">
            <h1 class="text-3xl mb-6">Tag: <?php single_tag_title(); ?></h1>

            <div class="flex flex-col md:flex-row gap-x-8 gap-y-8">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="w-full md:w-1/2">
                        <article class="w-full notice notice-small">
                            <a href="<?php the_permalink(); ?>" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
                                <div class="w-2/5 relative overflow-hidden">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image absolute left-0 top-0">
                                    <?php endif; ?>
                                </div>
                                <div class="w-3/5">
                                    <div class="h-full w-full flex flex-col justify-between p-7">
                                        <div class="w-full">
                                            <div class="flex items-center gap-x-2 ">
                                                <span class="text-warning leading-none text-sm"><?php the_category(', '); ?></span>
                                            </div>
                                            <h3 class="mt-2 leading-6 text-white">
                                                <span class="text-xl font-medium">
                                                    <?php the_title(); ?>
                                                </span>
                                            </h3>
                                        </div>
                                        <div class="flex items-center gap-x-2 text-white text-sm mt-2">
                                            <span class="leading-none text-sm"><?php the_date(); ?></span>|<span class="leading-none text-sm"><?php the_time(); ?></span>
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

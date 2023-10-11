<?php 
set_query_var('ENTRY', 'page');
$frontpage_id = get_option( 'page_on_front' );
$blog_id = get_option( 'page_for_posts' );
get_header(); ?>
<!-- section index init -->
<main data-page="" class="-screen relative flex flex-col bg-dark pb-24">
    <div class="w-full h-70-screen relative" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>'); background-repeat: no-repeat; background-size: cover;">
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
            <div class="w-full mt-12">
                <div class="w-full w-full-content font-medium text-white">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer();
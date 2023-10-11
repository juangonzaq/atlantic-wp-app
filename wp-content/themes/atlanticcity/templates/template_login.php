<?php
set_query_var('ENTRY', 'home');
get_header();
?>
<main class="h-header-screen w-screen relative flex justify-center items-center margin-top-header">
		<img class="absolute top-0 left-0 object-cover w-full h-full" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
		<div class="container z-10 pb-24">
			<div class="w-full md:w-8/12 lg:w-4/12 mx-auto">
				<form action="" class="w-full flex flex-col">
					<h1 class="text-white text-4xl font-medium relative w-max py-4 mx-auto">
						Iniciar sesión
						<span class="h-1 bg-primary rounded-xl absolute w-1/2 bottom-0 left-0 right-0 mx-auto"></span>
					</h1>
					<div class="text-base text-white font-normal text-center mt-8">
						<label>
							<input type="checkbox" id="dataConsentCheckbox">
							Estoy de acuerdo en compartir mis datos
						</label>
						
						<?php 
							if (is_user_logged_in()) {
								header('Location: ' . home_url());
								exit;
							} else {
								the_content();
							}
						?>
                        
                    </div>
                    <?php echo do_shortcode("[xs_social_login]"); ?>					
				</form>
			</div>
		</div>
	</main>
<?php
get_footer();
?>
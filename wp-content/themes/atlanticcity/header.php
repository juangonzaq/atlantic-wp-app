<!doctype html>
<html lang="<?php bloginfo( 'language' ) ?>">
<head>    
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">    	
    <link href="<?php echo site_url()?>/wp-content/themes/atlanticcity/plugins/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?php echo site_url()?>/wp-content/themes/atlanticcity/plugins/material-icons/materialdesignicons.min.css" rel="stylesheet">
    <link href="<?php echo site_url()?>/wp-content/themes/atlanticcity/css/tailwind.min.css" rel="stylesheet">
	<?php
        $entry = get_query_var('ENTRY');
        load_assets(['main', $entry]);
        wp_head();
		$classextra = "";
		if (is_front_page()) {
			$classextra = "top-menu";
		}
    ?>
	<style>
		@media (max-width: 640px) {
			.content-logo-mobile ~ .menu-desktop{
				width: 95% !important;
			}
		}
		

		  	.at-menu-nav-nh{
				margin: 0 !important;
				padding-right: 1.5rem;
			}

			.at-menu-nav-nh.active > a{
				color: var(--primary);
				border-bottom: 3px solid var(--primary);
			}

			.at-menu-nav-nh > a{
				border-bottom: 3px solid transparent;
				transition: all .3s;
			}

			.at-menu-nav-nh > a:hover{
				color: var(--primary);
				border-bottom: 3px solid var(--primary);
				background-color: transparent;
			}

			.at-menu-nav{
				margin: 0 !important;
				padding-right: 1.5rem;
			}

			.at-menu-nav.active > a{
				color: var(--primary);
				border-bottom: 3px solid var(--primary);
			}

			.at-menu-nav > a{
				border-bottom: 3px solid transparent;
				transition: all .3s;
			}

			.at-menu-nav > a:hover{
				color: var(--primary);
				border-bottom: 3px solid var(--primary);
				background-color: transparent;
			}
	</style>
</head>
<body <?php body_class($classextra); ?>>
    <div class="main-header z-30 w-full fixed top-0 left-0">
		<?php if (is_front_page()) { ?>
		<div class="main-menu px-2 md:px-8 h-main-menu bg-dark flex items-center">
			<div class="main-container mx-auto w-full py-2 px-0 md:px-5 hidden md:flex justify-center justify-between">
                <?php
                    $iconos = get_field('iconos', 'options');
                    $aux = 0;
                    foreach ($iconos as $icon) {
                        ?>
                        <a href="<?php echo $icon['href']; ?>" class="w-12 h-12 bg-gray border border-transparent rounded-full p-3 cursor-pointer mx-2 hover:border-primary" data="<?php echo $aux."-".count($iconos); ?>">
                            <img class="h-6 w-6 max-w-none" src="<?php echo $icon['icon']; ?>" alt="">
                        </a>
                        <?php if ($aux == (count($iconos)/2 - 1)) { ?>
                            <!-- SEPARATION -->
                            <span class="separation bg-separation"></span>
                            <!-- END SEPARATION -->
                        <?php } ?>
                        <?php
                        $aux++;
                    }
                ?>
			</div>
			<div class="main-container mx-auto w-full py-2 px-0 md:px-5 justify-center justify-between realtive flex md:hidden">
				<div class="w-full realtive flex md:hidden">
					<div class="swiper h-full w-full" id="swiper-breads">
						<!-- Additional required wrapper -->
						<div class="swiper-wrapper">
							<!-- Slides -->
							<?php
								$iconos = get_field('iconos', 'options');
								$aux = 0;
								foreach ($iconos as $icon) {
									?>
									<div class="swiper-slide px-0 md:px-12">
										<a href="<?php echo $icon['href']; ?>" class="w-9 h-9 bg-gray rounded-full p-1.5 cursor-pointer flex justify-center items-center  hover:border-primary" data="<?php echo $aux."-".count($iconos); ?>">
											<img class="h-6 w-6 max-w-none" src="<?php echo $icon['icon']; ?>" alt="">
										</a>
									</div>
									<?php
									$aux++;
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<header class="bg-gray h-header">
			<nav class="bg-gray h-full flex items-center">
				<div class="mx-auto px-4 md:px-8 w-full h-full">
					<div class="relative flex h-16 items-center justify-between h-full">
						<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
							<!-- Mobile menu button-->
							<button type="button" class="mobile-menu-button inline-flex items-center justify-center rounded-md p-0  hover:bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white cursor-pointer" aria-controls="mobile-menu" aria-expanded="false">
								<!--
								Icon when menu is closed.
					
								Menu open: "hidden", Menu closed: "block"
								-->
								<svg class="i-open h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
								</svg>
								<!--
								Icon when menu is open.
					
								Menu open: "block", Menu closed: "hidden"
								-->
								<svg class="i-close h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
								</svg>
							</button>
						</div>
						<div class="flex flex-1 items-center sm:items-stretch sm:justify-start content-logo-mobile mx-14 md:mx-0">
						<div class="flex flex-shrink-0 items-center">
							<a href="<?php echo site_url(); ?>">
								<img class="block h-8 w-auto lg:hidden w-180px mxw-180px" src="<?php echo get_field('logo', 'options'); ?>">
								<img class="hidden h-8 w-auto lg:block w-180px mxw-180px" src="<?php echo get_field('logo', 'options'); ?>">
							</a>
						</div>
					</div>
						<div class="flex items-center pr-6 h-full menu-desktop">
							<!-- <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 h-full"> -->
							<div class="hidden sm:ml-6 sm:block mr-5 h-full">
								<ul class="flex space-x-4 h-full">
								<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
								<!-- <a href="#" class="bg-dark text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Pronósticos y estadísticas</a> -->
									<?php
										$menu = get_field('menu', 'option');
										if ($menu) {
											foreach ($menu as $me) {
											$active = "";
											$url = $_SERVER['REQUEST_URI'];
											if ($me['menu']) { foreach ($me['menu'] as $subme) { 
												$valid = 0;
												if($subme['id'] && $subme['id'] !="" && $url != "" && $url != "/"){
													?>
													<script>console.log(<?php echo json_encode($subme['id']); ?>)</script>
													<?php
													$valid = count(explode($url, $subme['id']));
												}
												if ($valid > 1) { $active = "active"; }
											}}
												?>
												<!-- <script>console.log(<?php echo json_encode($url); ?>)</script>
												<script>console.log(<?php echo json_encode($menu); ?>)</script> -->
										<li class="flex <?php echo ($me['menu'])?((count($me['menu']) > 0)?'at-menu-nav':'pr-6'):'at-menu-nav-nh'; ?>  <?php echo $active; ?>">
											<a role="button" <?php if (!$me["menu"]){ ?> href="<?php echo $me["link_principal"]; ?>" <?php } ?>class="at-menu-nav-button text-gray-300 py-2 text-base font-regular flex items-center text-white hover:text-primary h-full z-20">
												<?php echo $me['nombre'];?>
												<?php if ($me["menu"]){ ?> <span class="mdi mdi-chevron-down text-xl flex pt-1 "></span><?php } ?>
											</a>
											<div class="at-menu-nav-content left-0 bottom-0 z-10 main-submenu max-h-0 overflow-hidden">
												<div class="bg-gray py-5 at-menu-nav-content-body">
													<ul>
														<?php 
															if ($me['menu']) {
																foreach ($me['menu'] as $subme) {
																	?>
														<li class="text-white font-regular py-1.5">
															<a href="<?php echo $subme['id']; ?>" class="hover:underline">
															  <?php
															  	echo $subme['nombre'];
															  ?>
															</a>
														</li>
																	<?php
																}
															}
														?>
													</ul>
												</div>
											</div>
										</li>
												<?php
											}
										}
									?>
									<li class="flex at-menu-nav-desktop">
										<span role="button" class="at-menu-nav-button text-gray-300 py-2 text-base font-normal flex items-center text-white h-full z-20">
											<span class="w-10 h-10 rounded-full bg-dark p-2 flex justify-center icon-search">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
													<path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
												</svg>
											</span>
										</span>
										<!-- style="display: flex !important; max-height: calc(100vh - var(--h-main-menu) - var(--height-header));" -->
										
									</li>
								</ul>
							</div>
							
							<!-- SEARCH MOBILE -->
							<div class="flex md:hidden pr-2 h-full">
								<span class="flex at-menu-nav-mobile mr-2">
									<span role="button" class="at-menu-nav-button text-gray-300 py-2 text-base font-normal flex items-center text-white hover:text-primary h-full z-20">
										<span class="w-10 h-10 rounded-full bg-dark p-2 flex justify-center icon-search">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
												<path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
											</svg>
										</span>
									</span>
									<!-- style="display: flex !important; max-height: calc(100vh - var(--h-main-menu) - var(--height-header));" -->
									
								</span>
							</div>
							<?php
								if (is_user_logged_in()) {
									$user = wp_get_current_user();
									?>
								<!-- Profile dropdown -->
								<div class="relative ml-3">
									<div>
									<!-- rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800  -->
										<button type="button" class="flex items-center button-profile text-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
											<img class="h-8 w-8 rounded-full mr-2" src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="">
											<?php global $current_user; wp_get_current_user(); ?>
											<?php 
											if ( is_user_logged_in() ) { 
												$first_name = explode(' ', $current_user->user_firstname)[0];
    											echo $first_name; 
											} else { 
												
												wp_loginout(); 
											} ?>
										</button>
										</div>
							
										<div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
										<!--<a href="<?php echo site_url(); ?>/wp-admin/profile.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Mi perfil</a>-->
										<!--<a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>-->
										<a href="<?php echo wp_logout_url( home_url() ); ?>" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Cerrar sesión</a>
									</div>
								</div>
									<?php
								} else {
									?>									
									<div class="flex items-center">
										<span>
											<a href="<?php echo site_url();?>/iniciar-sesion" type="button" class="outline outline-2 outline-primary text-primary font-medium py-1.5 px-4 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white hidden md:flex">Iniciar sesión</a>
											<a href="<?php echo site_url();?>/iniciar-sesion" type="button" class="w-10 h-10 rounded-full bg-dark p-2 flex md:hidden justify-center text-primary items-center" style="padding-left: 0.65rem;">
												<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6">
													<path fill-rule="evenodd" d="M8 0.75C5.1084 0.75 2.75 3.1084 2.75 6C2.75 7.80762 3.67285 9.41309 5.07031 10.3594C2.39551 11.5078 0.5 14.1621 0.5 17.25H2C2 13.9277 4.67773 11.25 8 11.25C11.3223 11.25 14 13.9277 14 17.25H15.5C15.5 14.1621 13.6045 11.5078 10.9297 10.3594C12.3271 9.41309 13.25 7.80762 13.25 6C13.25 3.1084 10.8916 0.75 8 0.75ZM8 2.25C10.0801 2.25 11.75 3.91992 11.75 6C11.75 8.08008 10.0801 9.75 8 9.75C5.91992 9.75 4.25 8.08008 4.25 6C4.25 3.91992 5.91992 2.25 8 2.25Z" clip-rule="evenodd"/>
												</svg>

												<!-- flex justify-center texnt-primary items-center -->
											</a>
										</span>
									</div>
									<?php
								}
							?>
						<!-- <button href="#" class="rounded-md bg-primary px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ml-3">Iniciar sesión</button> -->
							

						<div class="at-menu-nav-content-search left-0 bottom-0 z-10 main-submenu max-h-0 flex flex-col overflow-auto">
										<div class="bg-black py-5 w-full h-24">
											<div class="w-full mx-auto px-12">
												<div class="block-input relative">
													<input type="text" placeholder="Buscar..." id="searchMobile" class="w-full h-12 bg-black text-primary placeholder-white text-xl border-l-none border-t-none border-r-none outline-none border-b border-solid border-gray-light pr-12 text-ellipsis input-close-search-mobile">
													<span class="absolute top-1 right-1 font-bold rounded-full flex justify-center items-center button-close-search hidden cursor-pointer button-close-search-mobile">
														<span class="mdi mdi-close-circle text-3xl text-primary bg-black"></span>
													</span>
												</div>
											</div>
										</div>
										<div class="h-full bg-dark search-float-mobile" id="MySearchcontentMobile" style="display:none">
											<div class="main-container  mx-auto flex flex-col w-full py-3">
												<div class="w-full flex items-end  px-5">
													<span class=" text-primary flex items-center w-full">
														<div class="text-sm font-medium text-center text-gray-500 w-full">
															<span class="inline-block py-4 text-white text-base font-medium px-8"><span id="resultados-mobile" ></span> Resultados</span>

															<ul class="flex flex-wrap justify-between -mb-px border-gray-light border-b border-solid w-full">
																<!-- border-b border-gray-200 dark:text-gray-400 dark:border-gray-700  -->
																<li class="relative">
																	<a href="#" class="nav-link-search nav-link-search-mobile inline-block py-4 pr-3 text-white text-base font-light active"
																	data-id="#todos-mobile" data-result="">Todos</a>
																</li>
																<li class="relative">
																	<a href="#" class="nav-link-search nav-link-search-mobile inline-block py-4 px-3 text-white text-base font-light "
																	data-id="#noticias-mobile" data-result="">Noticias</a>
																</li>
																<li class="relative">
																	<a href="#" class="nav-link-search nav-link-search-mobile inline-block py-4 px-3 text-white text-base font-light "
																	data-id="#videos-mobile" data-result="">Videos</a>
																</li>
																<li class="relative">
																	<a href="#" class="nav-link-search nav-link-search-mobile inline-block py-4 pl-3 text-white text-base font-light " 
																	data-id="#galeria-mobile" data-result="">Galería de fotos</a>
																</li>
															</ul>
														</div>
													</span>
												</div>
												<div class="allContent">
													<div class="itemContentMobile" id="todos-mobile">
														<div class="flex flex-wrap w-full gap-y-4 mt-8 mobileJsContent">
														</div>
														<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
															<ahref="javascript:void(0)" class="jsSeeMore outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
														</div>
													</div>
													<div class="itemContentMobile" id="noticias-mobile" style="display:none">
														<div class="flex flex-wrap w-full gap-y-4 mt-8 mobileJsContent">
														</div>
														<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
															<a href="javascript:void(0)" class="jsSeeMore outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
														</div>
													</div>
													<div class="itemContentMobile" id="videos-mobile" style="display:none">
														<div class="flex flex-wrap w-full gap-y-4 mt-8 mobileJsContent">
														</div>
														<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
															<a href="javascript:void(0)" class="jsSeeMore outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
														</div>
													</div>
													<div class="itemContentMobile" id="galeria-mobile" style="display:none">
														<div class="flex flex-wrap w-full gap-y-4 mt-8 mobileJsContent">
														</div>
														<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
															<a href="javascript:void(0)" class="jsSeeMore outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
						
						</div>

						<div class="at-menu-nav-content-search-desktop left-0 bottom-0 z-10 main-submenu max-h-0 flex flex-col overflow-auto">
											<div class="bg-black py-5 w-full h-24">
												<div class="md:w-1/2 mx-auto">
													<div class="block-input relative">
														<input type="text" placeholder="Buscar..." id="search" class="w-full h-12 bg-black text-primary placeholder-white text-xl border-l-none border-t-none border-r-none outline-none border-b border-solid border-gray-light input-close-search">
														<span class="absolute top-1 right-1 font-bold rounded-full flex justify-center items-center button-close-search hidden cursor-pointer" id="closeCircle">
															<span class="mdi mdi-close-circle text-3xl text-primary bg-black"></span>
														</span>
													</div>
												</div>
											</div>
											<div class="h-full bg-gray px-8 search-float" id="MySearchcontent" style="display:none">
												<div class="container  mx-auto flex flex-col w-full py-3">
													<div class="w-full flex items-end  px-5">
														<span class=" text-primary flex items-center w-full">
															<div class="text-sm font-medium text-center text-gray-500 w-full">
																<ul class="flex flex-wrap -mb-px border-gray-light border-b border-solid">
																	<!-- border-b border-gray-200 dark:text-gray-400 dark:border-gray-700  -->
																	<li class="relative">
																		<a class="inline-block py-4 pr-8 text-white text-base font-medium"><span id="resultados"></span> Resultados</a>
																		<span class="absolute bottom-4 right-0 h-2/5 border border-solid border-gray-border border-r flex"></span>
																	</li>
																	<li class="relative">
																		<a href="#" class="nav-link-search inline-block py-4 px-8 text-white text-base font-light active" 
																		data-id="#todos" data-result="">Todos</a>
																	</li>
																	<li class="relative">
																		<a href="#" class="nav-link-search inline-block py-4 px-8 text-white text-base font-light "
																		data-id="#noticias" data-result="">Noticias</a>
																	</li>
																	<li class="relative">
																		<a href="#" class="nav-link-search inline-block py-4 px-8 text-white text-base font-light "
																		data-id="#videos" data-result="">Videos</a>
																	</li>
																	<li class="relative">
																		<a href="#" class="nav-link-search inline-block py-4 px-8 text-white text-base font-light "
																		data-id="#galeria" data-result="">Galería de fotos</a>
																	</li>
																</ul>
															</div>
														</span>
													</div>
													<div class="allContent">
														<div class="itemContent" id="todos">
															<div class="flex flex-wrap w-full gap-y-8 mt-8 addContentJs">
															</div>
															<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
																<a href="javascript:void(0)" class="jsSeeMore outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
															</div>
														</div>
														<div class="itemContent" id="noticias" style="display:none">
															<div class="flex flex-wrap w-full gap-y-8 mt-8 addContentJs">
															</div>
															<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
																<a href="javascript:void(0)" class="jsSeeMore outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
															</div>
														</div>
														<div class="itemContent" id="videos" style="display:none">
															<div class="flex flex-wrap w-full gap-y-8 mt-8 addContentJs">
															</div>
															<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
																<a href="javascript:void(0)" class="jsSeeMore outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
															</div>
														</div>
														<div class="itemContent" id="galeria" style="display:none">
															<div class="flex flex-wrap w-full gap-y-8 mt-8 addContentJs">
															</div>
															<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
																<a href="javascript:void(0)" class="jsSeeMore outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
					</div>
				</div>
			
				<!-- Mobile menu, show/hide based on menu state. -->
				<div class="sm:hidden fixed top-modal-header lef-0 z-30 w-screen bg-dark h-header-screen mobile-menu" id="mobile-menu">
					<div class="space-y-1 py-8 px-9">
						<ul>
							<?php
							$menu = get_field('menu', 'option');
							if ($menu) {
								foreach ($menu as $me) {
									?>
							<li>
									<?php
										if($me['menu']){
											if(count($me['menu']) > 0){
												?>
													<a href="" class="<?php echo ($me['menu'])?((count($me['menu']) > 0)?'menu-item-movil':''):''; ?> text-white  hover:text-white block px-0 py-2 text-base font-regular flex w-full items-center justify-between border-b border-gray-light mb-3" aria-current="page">
													<?php echo $me['nombre'];?>
													<span class="mdi mdi-chevron-down text-2xl flex pt-1 icon-arrow"></span>
												<?php
											} else { ?>
													<a href="<?php echo $me['id'];?>" class="<?php echo ($me['menu'])?((count($me['menu']) > 0)?'menu-item-movil':''):''; ?> text-white  hover:text-white block px-0 py-2 text-base font-regular flex w-full items-center justify-between border-b border-gray-light mb-3" aria-current="page">
													<?php echo $me['nombre'];?>
										<?php	}
										}
									?>
								</a>
								<div class="menu-content-movil">
									<ul class="border-b border-gray-light pb-3">
										<?php 
											if ($me['menu']) {
												foreach ($me['menu'] as $subme) {
													?>											
											<li class="py-2">
												<a href="<?php echo $subme['id']; ?>" class="text-white font-light hover:underline"><?php
													echo $subme['nombre'];
													?></a>
											</li>
													<?php
												}
											}
										?>
									</ul>
								</div>
							</li>							
							<?php
											}
										}
									?>
						</ul>
					</div>
				</div>
			</nav>
		</header>
	</div>
<script>
function callAjaxFull() {
jQuery.ajax({
	type: "post",
	dataType: "json",
	url: "https://blog.casinoatlanticcity.com/wp-admin/admin-ajax.php",
	data: {
		action: "send_mydatafull",
		value: jQuery("#search").val()
	},
	success: function(response) {
		const posts = response.posts;
		const medias = response.medias;
		const videos = response.videos;
		const lengthtotal = posts.length + medias.length + videos.length;
		jQuery('.nav-link-search').eq(0).attr("data-result", lengthtotal);
		jQuery('.nav-link-search').eq(1).attr("data-result", response.posts.length);
		jQuery('.nav-link-search').eq(2).attr("data-result", response.medias.length);
		jQuery('.nav-link-search').eq(3).attr("data-result", response.videos.length);
		jQuery('#resultados').html(lengthtotal);
		//data
		const $todos = jQuery('#todos').find('.addContentJs');
		const $noticias = jQuery('#noticias').find('.addContentJs');
		const $videos = jQuery('#videos').find('.addContentJs');
		const $galeria = jQuery('#galeria').find('.addContentJs');
		$todos.html("");
		$noticias.html("");
		$videos.html("");
		$galeria.html("");
		if (lengthtotal == 0) {
			$todos.html("<div class='notresult'>No se encontraron resultados</div>");
		}
		if (posts.length > 0) {
			posts.forEach((post) => {
				const template = `
					<div class="w-2/6 px-4">
						<article class="w-full notice">
							<a href="${post.link}" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg" >
								<img src="${post.imagen}" alt="" class="rounded-lg object-cover object-center w-full h-full notice-image">
								<div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
				
								<div class="absolute top-0 left-0 w-full h-full flex flex-col justify-end p-7">
									<div class="flex items-center gap-x-2 text-white">
										<span class="text-warning leading-none text-sm">${post.category}</span>|<span class="leading-none text-sm">${post.dia}</span>|<span class="leading-none text-sm">${post.hora} hrs.</span>
									</div>
									<h3 class="mt-2  leading-6 text-white">
										<span class="text-lg font-medium">
											${post.name}
										</span>
									</h3>
								</div>
							</a>
						</article>
					</div>
				`;
				$noticias.append(template);
				$todos.append(template);
			});
		} else {
			$noticias.html("<div class='notresult'>No se encontraron resultados</div>");
		}
		if (medias.length > 0) { 
			medias.forEach((post) => {
				const template = `
					<div class="w-2/6 px-4">
						<article class="w-full notice">
							<a href="${post.link}" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg" >
								<img src="${post.imagen}" alt="" class="rounded-lg object-cover object-center w-full h-full notice-image">
								<div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
				
								<div class="absolute top-0 left-0 w-full h-full flex flex-col justify-end p-7">
									<div class="flex items-center gap-x-2 text-white">
										<span class="text-warning leading-none text-sm">${post.category}</span>|<span class="leading-none text-sm">${post.dia}</span>|<span class="leading-none text-sm">${post.hora} hrs.</span>
									</div>
									<h3 class="mt-2  leading-6 text-white">
										<span class="text-lg font-medium">
											${post.name}
										</span>
									</h3>
								</div>
							</a>
						</article>
					</div>
				`;
				$galeria.append(template);
				$todos.append(template);
			});
		} else {
			$galeria.html("<div class='notresult'>No se encontraron resultados</div>");
		}
		if (videos.length > 0) {
			videos.forEach((post) => {
				const template = `
				<div class="w-2/6 px-4">
					<article class="w-full notice">
						<a href="${post.link}" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg" >
							<img src="${post.imagen}" alt="" class="rounded-lg object-cover object-center w-full h-full notice-image">
							<div class="absolute top-0 left-0 w-full h-full from-dark rounded-lg"></div>
			
							<div class="absolute top-0 left-0 w-full h-full flex flex-col justify-end p-7">
								<div class="flex items-center gap-x-2 text-white">
									<span class="text-warning leading-none text-sm">${post.category}</span>|<span class="leading-none text-sm">${post.dia}</span>|<span class="leading-none text-sm">${post.hora} hrs.</span>
								</div>
								<h3 class="mt-2  leading-6 text-white">
									<span class="text-lg font-medium">
										${post.name}
									</span>
								</h3>
							</div>
						</a>
					</article>
				</div>
				`;
				$videos.append(template);
				$todos.append(template);
			});
		} else {
			$videos.html("<div class='notresult'>No se encontraron resultados</div>");
		}
		jQuery("#MySearchcontent").show();
		//functions
	}
});
}

jQuery('.jsSeeMore').on("click", function() {
	jQuery(this).hide();
	callAjaxFull();
});
</script>

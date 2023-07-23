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
</head>
<body <?php body_class($classextra); ?>>
    <div class="main-header z-30 w-full fixed top-0 left-0">
		<?php if (is_front_page()) { ?>
		<div class="main-menu px-2 md:px-8 h-main-menu bg-dark flex items-center">
			<div class="main-container mx-auto w-full py-2 px-0 md:px-5 flex justify-center justify-between">
                <?php
                    $iconos = get_field('iconos', 'options');
                    $aux = 0;
                    foreach ($iconos as $icon) {
                        ?>
                        <a class="w-9 h-9 bg-gray rounded-full p-1.5 cursor-pointer mx-2" data="<?php echo $aux."-".count($iconos); ?>">
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
		</div>
		<?php } ?>
		<header class="bg-gray h-header">
			<nav class="bg-gray h-full flex items-center">
				<div class="mx-auto px-4 md:px-8 w-full h-full">
					<div class="relative flex h-16 items-center justify-between h-full">
						<div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
							<!-- Mobile menu button-->
							<button type="button" class="mobile-menu-button inline-flex items-center justify-center rounded-md p-0 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white cursor-pointer" aria-controls="mobile-menu" aria-expanded="false">
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
						<div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
						<div class="flex flex-shrink-0 items-center">
							<a href="<?php echo site_url(); ?>">
								<img class="block h-8 w-auto lg:hidden w-180px mxw-180px" src="<?php echo get_field('logo', 'options'); ?>">
								<img class="hidden h-8 w-auto lg:block w-180px mxw-180px" src="<?php echo get_field('logo', 'options'); ?>">
							</a>
						</div>
					</div>
						<div class="flex items-center pr-2 h-full">
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
												$valid = count(explode($url, $subme['id']));
												if ($valid > 1) { $active = "active"; }
											}}
												?>
										<li class="flex at-menu-nav <?php echo $active; ?>">
											<a role="button" <?php if (!$me["menu"]){ ?> href="<?php echo $me["link_principal"]; ?>" <?php } ?>class="at-menu-nav-button text-gray-300 py-2 text-base font-regular flex items-center text-white hover:text-primary h-full z-20">
												<?php echo $me['nombre'];?>
												<?php if ($me["menu"]){ ?> <span class="mdi mdi-chevron-down text-xl flex pt-1"></span><?php } ?>
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
									<li class="flex at-menu-nav">
										<span role="button" class="at-menu-nav-button text-gray-300 py-2 text-base font-normal flex items-center text-white hover:text-primary h-full z-20">
											<span class="w-10 h-10 rounded-full bg-dark p-2 flex justify-center">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
													<path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
												</svg>
											</span>
										</span>
										<!-- style="display: flex !important; max-height: calc(100vh - var(--h-main-menu) - var(--height-header));" -->
										<div class="at-menu-nav-content left-0 bottom-0 z-10 main-submenu max-h-0 flex flex-col overflow-auto">
											<div class="bg-black py-5 w-full h-24">
												<div class="md:w-1/2 mx-auto">
													<div class="block-input relative">
														<input type="text" placeholder="Buscar..." id="search" class="w-full h-12 bg-black text-primary placeholder-white text-xl border-l-none border-t-none border-r-none outline-none border-b border-solid border-gray-light">
														<span class="absolute top-1 right-1 font-bold rounded-full flex justify-center items-center" id="closeCircle" style="display:none">
															<span class="mdi mdi-close-circle text-3xl text-primary bg-black"></span>
														</span>
													</div>
												</div>
											</div>
											<div class="h-full bg-gray px-8" id="MySearchcontent" style="display:none">
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
																<a href="<?php echo site_url() ?>/noticias" class="outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
															</div>
														</div>
														<div class="itemContent" id="noticias" style="display:none">
															<div class="flex flex-wrap w-full gap-y-8 mt-8 addContentJs">
															</div>
															<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
																<a href="<?php echo site_url() ?>/noticias" class="outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
															</div>
														</div>
														<div class="itemContent" id="videos" style="display:none">
															<div class="flex flex-wrap w-full gap-y-8 mt-8 addContentJs">
															</div>
															<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
																<a href="<?php echo site_url() ?>/noticias" class="outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
															</div>
														</div>
														<div class="itemContent" id="galeria" style="display:none">
															<div class="flex flex-wrap w-full gap-y-8 mt-8 addContentJs">
															</div>
															<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
																<a href="<?php echo site_url() ?>/noticias" class="outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>
							
							<!-- SEARCH MOBILE -->
							<div class="flex md:hidden">
								<span class="flex at-menu-nav">
									<span role="button" class="at-menu-nav-button text-gray-300 py-2 text-base font-normal flex items-center text-white hover:text-primary h-full z-20">
										<span class="w-10 h-10 rounded-full bg-dark p-2 flex justify-center">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
												<path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z" clip-rule="evenodd" />
											</svg>
										</span>
									</span>
									<!-- style="display: flex !important; max-height: calc(100vh - var(--h-main-menu) - var(--height-header));" -->
									<div class="at-menu-nav-content left-0 bottom-0 z-10 main-submenu max-h-0 flex flex-col overflow-auto hidden">
										<div class="bg-black py-5 w-full h-24">
											<div class="w-full mx-auto px-12">
												<div class="block-input relative">
													<input type="text" placeholder="Buscar..." id="searchMobile" class="w-full h-12 bg-black text-primary placeholder-white text-xl border-l-none border-t-none border-r-none outline-none border-b border-solid border-gray-light pr-12 text-ellipsis">
												</div>
											</div>
										</div>
										<div class="h-full bg-dark" id="MySearchcontentMobile" style="display:none">
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
															<a href="<?php echo site_url() ?>/noticias" class="outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
														</div>
													</div>
													<div class="itemContentMobile" id="noticias-mobile" style="display:none">
														<div class="flex flex-wrap w-full gap-y-4 mt-8 mobileJsContent">
														</div>
														<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
															<a href="<?php echo site_url() ?>/noticias" class="outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
														</div>
													</div>
													<div class="itemContentMobile" id="videos-mobile" style="display:none">
														<div class="flex flex-wrap w-full gap-y-4 mt-8 mobileJsContent">
														</div>
														<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
															<a href="<?php echo site_url() ?>/noticias" class="outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
														</div>
													</div>
													<div class="itemContentMobile" id="galeria-mobile" style="display:none">
														<div class="flex flex-wrap w-full gap-y-4 mt-8 mobileJsContent">
														</div>
														<div class="flex justify-center gap-y-8 gap-x-8 mt-8 px-5">
															<a href="<?php echo site_url() ?>/noticias" class="outline outline-2 outline-primary text-primary font-medium py-3 px-12 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">VER MÁS</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</span>
							</div>
							<?php
								if (is_user_logged_in()) {
									$user = wp_get_current_user();
									?>
								<!-- Profile dropdown -->
								<div class="relative ml-3">
									<div>
										<button type="button" class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
											<span class="sr-only">Open user menu</span>
											<img class="h-8 w-8 rounded-full" src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" alt="">
										</button>
										</div>
							
										<div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
										<a href="<?php echo site_url(); ?>/wp-admin/profile.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Mi perfil</a>
										<!--<a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>-->
										<a href="<?php echo wp_logout_url( home_url() ); ?>" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Cerrar sesión</a>
									</div>
								</div>
									<?php
								} else {
									?>									
									<div class="flex items-center">
										<span>
											<a href="<?php echo site_url();?>/login" type="button" class="outline outline-2 outline-primary text-primary font-medium py-1.5 px-4 rounded transition-all duration-3 text-white hover:bg-primary hover:text-white">Iniciar sesión</a>
										</span>
									</div>
									<?php
								}
							?>
						<!-- <button href="#" class="rounded-md bg-primary px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ml-3">Iniciar sesión</button> -->
							

							
						
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
								<a href="#" class="menu-item-movil text-white  hover:text-white block px-0 py-2 text-base font-regular flex w-full items-center justify-between border-b border-gray-light mb-3" aria-current="page">
									<?php echo $me['nombre'];?>
									<span class="mdi mdi-chevron-down text-2xl flex pt-1 icon-arrow"></span>
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

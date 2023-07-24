
<footer class="bg-gray w-full px-8 py-10">
		<div class="container mx-auto">
			<div class="md:flex md:justify-between">
				<div class="w-full md:w-1/4">
					<a href="<?php echo site_url(); ?>" class="flex items-center justify-center md:justify-start">
						<img class="block h-8 w-auto lg:hidden w-180px mxw-180px" src="<?php echo get_field('logo', 'options'); ?>">
						<img class="hidden h-8 w-auto lg:block w-180px mxw-180px" src="<?php echo get_field('logo', 'options'); ?>">
					</a>
				</div>
                <?php 
                    $menusfooter = get_field('menu_footer', 'options');
                    $aux = 0;
                    if ($menusfooter) {
                        foreach ($menusfooter as $mn) {
                 ?>
                 <div class="w-full md:w-1/4">
					<h2 class="mb-4 text-xl font-semibold text-white text-center md:text-left mt-8 md:mb-0"><?php echo $mn['title']; ?></h2>
					<ul class="text-gray-600 dark:text-gray-400 font-medium">
                        <?php
                            if ($mn['submenu']) {
                                foreach ($mn['submenu'] as $m) {
                                    ?>
                        <li class="mb-1 justify-center md:justify-start flex py-2 md:py-1">
							<a href="<?php echo $m['link']; ?>" class="underline text-white"><?php echo $m['text']; ?></a>
						</li>
                                    <?php
                                }
                            }
                        ?>
					</ul>
                    <?php
                        if ($aux == 1) {
                            ?>
                            <div class="w-full mt-5 flex items-center justify-center md:justify-start my-4 md:my-4">
                                <div class="mr-2 max-w-36"><img src="<?php echo site_url()?>/wp-content/themes/atlanticcity/css/Captura de Pantalla 2022-07-01 a la(s) 17.15 1.png" alt="Atlantic"></div>
                                <div class="mr-2 max-w-36"><img src="<?php echo site_url()?>/wp-content/themes/atlanticcity/css/XMgroup1.png" alt="Atlantic"></div>
                                <div class="max-w-36"><img src="<?php echo site_url()?>/wp-content/themes/atlanticcity/css/x34 4 18Plus movie.png" alt="Atlantic"></div>
                            </div>
                            <?php
                        }
                    ?>
				</div>
                 <?php
                    $aux++;
                        }
                    }
                ?>
				<div class="w-full md:w-1/4">
					<h2 class="mb-6 text-xl font-semibold text-white text-center md:text-left mt-8 md:mb-0">Contacto</h2>
					<ul class="text-gray-600 dark:text-gray-400 font-medium">
						<li class="mb-1 justify-center md:justify-start flex">
							<a href="<?php echo get_field('telefono_link', 'options'); ?>" class="underline text-white">
                                <?php echo get_field('telefono', 'options'); ?>
                            </a>
						</li>
						<li class="mb-1 justify-center md:justify-start flex">
							<a href="<?php echo get_field('mailto', 'options'); ?>" class="underline text-white">
                            <?php echo get_field('mail', 'options'); ?>
                            </a>
						</li>
					</ul>
					<h2 class="mb-6 text-xl font-semibold text-white text-center md:text-left mt-8 md:mb-0">Redes sociales</h2>
					<div class="flex items-center justify-center md:justify-start">
						<span class=" text-white">
							<a href="<?php echo get_field('facebook', 'options'); ?>">
								<span class="mdi mdi-facebook text-4xl"></span>
							</a>
						</span>
					</div>
				</div>
			</div>
		</div>
	</footer>
	
	<div class="copyrigth w-full">
		<div class="w-full py-4 px-5 flex justify-center bg-primary-dark">
			<p class="m-0 text-white font-medium text-center">2022 © Atlantic City. Todos los derechos reservados.</p>
		</div>
	</div>
<script>
    var ajaxUrl = '<?php echo site_url()?>/wp-admin/admin-ajax.php';
</script>
<?php wp_footer() ?>
<!-- Resto del contenido de la página -->
<script src="<?php echo site_url()?>/wp-content/themes/atlanticcity/plugins/swiper/swiper-bundle.min.js"></script>

<script>

    function disableMenus(menuSelect){
		let menus = document.querySelectorAll('.menu-desktop .at-menu-nav');
		if(menus){
			menus.forEach(menu => {
				if(menu != menuSelect){
					menu.classList.remove('hover');
				}
			});
		}
	}

    function toggleMenuSearchMobile(hide = false){
        let contentSearch = document.querySelector('.at-menu-nav-content-search');
        let menuActive = document.querySelector('.menu-desktop .at-menu-nav-mobile.active');
        if(contentSearch){
            if(hide){
                if(menuActive){
                    menuActive.classList.remove('active');
                }
                contentSearch.classList.remove('show');
            }
            else{
                contentSearch.classList.toggle('show');
            }
        }

        if(!hide){
            disableMenus(null);
        }
    }

    function toggleMenuSearchDesktop(hide = false){
		let contentSearchDesk = document.querySelector('.at-menu-nav-content-search-desktop');
        let menuActiveDesk = document.querySelector('.menu-desktop .at-menu-nav-desktop.active');
        if(contentSearchDesk){
            if(hide){
                if(menuActiveDesk){
                    menuActiveDesk.classList.remove('active');
                }
                contentSearchDesk.classList.remove('show');
            }
            else{
                contentSearchDesk.classList.toggle('show');
            }
        }

        if(!hide){
            disableMenus(null);
        }
    }

	function loadMenus(){
		let menus = document.querySelectorAll('.menu-desktop .at-menu-nav');
		if(menus){
			menus.forEach(menu => {
				menu.addEventListener('click', ()=>{
					menu.classList.toggle('hover');
                    toggleMenuSearchMobile(true);
                    toggleMenuSearchDesktop(true);
					disableMenus(menu);
				});
			});
		}
	}

    function loadMenuSearch(){
		let menus = document.querySelectorAll('.menu-desktop .at-menu-nav-mobile');
		if(menus){
			menus.forEach(menu => {
				menu.addEventListener('click', ()=>{
                    menu.classList.toggle('active');
                    toggleMenuSearchMobile();
				});
			});
		}
	}

    function loadMenuSearchDesktop(){
		let menus = document.querySelectorAll('.menu-desktop .at-menu-nav-desktop');
		if(menus){
			menus.forEach(menu => {
				menu.addEventListener('click', ()=>{
                    menu.classList.toggle('active');
                    toggleMenuSearchDesktop();
				});
			});
		}
	}

    function loadSwipperBreads(){
        const swiper = new Swiper("#swiper-breads", {
          slidesPerView: 7.3,
        //   spaceBetween: 30,
          loop: true,
          pagination: {
            el: "#swiper-breads .swiper-pagination",
            clickable: false,
            renderBullet: (index, className) => {
              return '<span class="'+className+' flex w-2.5 h-2.5 bg-white rounded-full cursor-pointer z-20"></span>';
            },
          }
        });
    }

    function loadSwipperCard(width){
        const swiper = new Swiper("#swiper-banner", {
          slidesPerView: 1,
        //   spaceBetween: 30,
          loop: true,
          pagination: {
            el: "#swiper-pagination-banner",
            clickable: true,
            renderBullet: (index, className) => {
              return '<span class="'+className+' flex w-2.5 h-2.5 bg-white rounded-full cursor-pointer z-20"></span>';
            },
          },
          navigation: {
            nextEl: "#swiper-banner .at-swiper-button-next",
            prevEl: "#swiper-banner .at-swiper-button-prev",
          }
        });
        
        const swiperCard = new Swiper("#swiper-card", {
            slidesPerView: width,
            spaceBetween: 4,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            loop: false,
            navigation: {
                nextEl: "#swiper-card .at-swiper-button-next",
            },
            on: {
                init: function (e) {
                    e.slides.forEach(slide => {
                        slide.classList.remove('slide-cover');
                    });

                    let slidesVisibles = e.slides.filter(slide => slide.classList.contains('swiper-slide-visible'));
                    // let slidesHidden = e.slides.filter(slide => !slide.classList.contains('swiper-slide-visible'));

                    /* slidesHidden.forEach(slide => {
                        slide.classList.add('slide-cover');
                    }); */

                    slidesVisibles.forEach((slide, index) => {
                        if(index == (slidesVisibles.length - 1)){
                            slide.classList.add('slide-cover');
                        }
                    });
                },
                slideChange: function(e){
                    e.slides.forEach(slide => {
                        slide.classList.remove('slide-cover');
                    });

                    let slidesVisibles = e.slides.filter(slide => slide.classList.contains('swiper-slide-visible'));
                    // let slidesHidden = e.slides.filter(slide => !slide.classList.contains('swiper-slide-visible'));

                    /* slidesHidden.forEach(slide => {
                        slide.classList.add('slide-cover');
                    }); */

                    slidesVisibles.forEach((slide, index) => {
                        if(index == (slidesVisibles.length - 1)){
                            slide.classList.add('slide-cover');
                        }
                    });
                }
            },
        });
    }

    function setPositionMenus(){
        const menuNavs = document.querySelectorAll('.at-menu-nav');
        if(menuNavs){
            menuNavs.forEach((menuNav, iMenu) => {
                let left = menuNav.getBoundingClientRect().left;
                const menuNavContent = menuNav.querySelector('.at-menu-nav-content .at-menu-nav-content-body');
                if(menuNavContent){
                    menuNavContent.style.paddingLeft = (left) + 'px';
                }

                let button = menuNav.querySelector('.at-menu-nav-button');
                let content = menuNav.querySelector('.at-menu-nav-content');
                if(button && content){
                    button.addEventListener('click', ()=>{
                        // content.classList.remove('max-h-0');
                        // content.classList.toggle('hidden');
                    });
                }
            });
        }
    }

    function setProgressGallery(id){
        let progress = document.querySelector('#'+id+' .gallery-pagination .gallery-pagination__border');
        let page = document.querySelector('#'+id+' .gallery-pagination .gallery-pagination__page');
        let pages = document.querySelector('#'+id+' .gallery-pagination .gallery-pagination__pages');
        let slides = document.querySelectorAll('#'+id+' .swiper-wrapper .swiper-slide');
        let slidesGroup = [];
        let currentIndex = 0;
        if(slides){
            slides.forEach(slide => {
                if(slide.swiperSlideSize){
                    slidesGroup.push(slide);
                }
            });
        }

        slidesGroup.forEach((slide, index) => {
            if(slide.classList.contains('swiper-slide-active')){
                currentIndex = index;
            }
        });

        if(progress){
            let width = (100/slidesGroup.length) * (currentIndex + 1);
            progress.style.width = width + '%';
        }

        if(page){
            page.innerText = currentIndex + 1;
        }

        if(pages){
            pages.innerText = slidesGroup.length;
        }
    }

    function loadSwipperGallery(id){
        let swiperGallery = new Swiper(id, {
            slidesPerView: 1.2,
            spaceBetween: 0,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            loop: false,
            navigation: {
                prevEl: ".swiper-gallery-button-prev",
                nextEl: ".swiper-gallery-button-next",
            },
            on: {
                init: function (e) {
                    e.slides.forEach(slide => {
                        slide.classList.add('slide-cover');
                    });


                    let slidesVisibles = e.slides.filter(slide => slide.classList.contains('swiper-slide-active'));

                    slidesVisibles.forEach((slide, index) => {
                        slide.classList.remove('slide-cover');
                    });

                    setTimeout(() => {
                        setProgressGallery(e.el.dataset.modalId);
                    }, 500);
                },
                transitionStart: function(e){
                    e.slides.forEach(slide => {
                        slide.classList.add('slide-cover');
                    });


                    let slidesVisibles = e.slides.filter(slide => slide.classList.contains('swiper-slide-active'));

                    slidesVisibles.forEach((slide, index) => {
                        slide.classList.remove('slide-cover');
                    });

                    setProgressGallery(e.el.dataset.modalId);
                },
                slideChange: function(e){
                    setProgressGallery(e.el.dataset.modalId);
                }
            },
        });
    }

    document.addEventListener('DOMContentLoaded', ()=>{
        window.addEventListener('resize', (e)=>{
            setPositionMenus()
            
            let width = 1.3;
            if(document.body.clientWidth > 640){
                width = 3.5;
            }
            loadSwipperCard(width);
            loadSwipperBreads();
        });

        // AVATAR
        const avatarToggle = document.getElementById('user-menu-button');
        const dropAvatar = document.querySelector('[aria-labelledby="user-menu-button"]');
        if(avatarToggle && dropAvatar){
          avatarToggle.addEventListener('click', ()=>{
              dropAvatar.classList.toggle('hidden');
          });

          document.addEventListener('click', (event) => {
              const targetElement = event.target;

              if (!dropAvatar.contains(targetElement) && !avatarToggle.contains(targetElement)) {
                  dropAvatar.classList.add('hidden');
              }
          });
        }
        // SUBMENU
        const menus = document.querySelectorAll('.at-menu');
        if(menus){
          menus.forEach(menu => {
            const menuButton = menu.querySelector('.at-menu-button');
            const menuContent = menu.querySelector('.at-menu-content');

            if(menuButton){
                menuButton.addEventListener('click', ()=>{
                  if(menuContent.classList)
                //   menuContent.classList.toggle('hidden');
                // hidden 
                  menuContent.classList.add('transition ease-out duration-200');
                });
            }
          });
        }        
        let widthBody = (document.body.clientWidth > 640)?3.5:1.3;

        setTimeout(() => {
            loadSwipperCard(widthBody);
            loadSwipperBreads();
            // loadSwipperGallery(".swipper-gallery")
        }, 500);

        const menuItemMovil = document.querySelectorAll('.menu-item-movil');
        if(menuItemMovil){
            menuItemMovil.forEach(menuMovil => {
                menuMovil.addEventListener('blur', () => {
                    const menuItemMovilAll = document.querySelectorAll('.menu-item-movil');
                    if(menuItemMovilAll){
                        menuItemMovilAll.forEach(item => {
                            item.classList.remove('active');
                        });
                    }
                });

                menuMovil.addEventListener('click', (e)=>{
                    const menuItemMovilAll = document.querySelectorAll('.menu-item-movil');
                    if(menuItemMovilAll){
                        menuItemMovilAll.forEach(item => {
                            if(item != e.target){
                                item.classList.remove('active');
                            }
                        });
                    }

                    if(menuMovil.classList.contains('active')){
                        menuMovil.classList.remove('active');
                    }
                    else{
                        menuMovil.classList.add('active');
                    }
                });
            });
        }

        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        if(mobileMenuButton){
            mobileMenuButton.addEventListener('click', (e)=>{
                mobileMenuButton.classList.toggle('active');
                let contentClass = mobileMenuButton.getAttribute('aria-controls');
                let menuMobilecontent = document.querySelector('.'+contentClass);
                // let mainHeader = document.querySelector('.main-header');
                if(menuMobilecontent){
                    if(mobileMenuButton.classList.contains('active')){
                        menuMobilecontent.classList.add('open');
                        /* if(mainHeader){
                            mainHeader.classList.add('static-menu');
                        } */
                    }
                    else{
                        menuMobilecontent.classList.remove('open');
                        /* if(mainHeader){
                            mainHeader.classList.remove('static-menu');
                        } */
                    }
                }
            });
        }

        setTimeout(() => {
            setPositionMenus()
        }, 500);	
        
        const buttonSwipperGallery = document.querySelectorAll('.modal-gallery .close');
        if(buttonSwipperGallery){
            buttonSwipperGallery.forEach(buttonSwiperGallery => {
                buttonSwiperGallery.addEventListener('click', () => {                    
                    const dataid = buttonSwiperGallery.getAttribute("data-id");                    
                    let modalGallery = document.getElementById(dataid);
                    if(modalGallery){
                        modalGallery.classList.add('hidden');
                    }
                });
            });
        }

        // GALLERY
        const buttonsGallery = document.querySelectorAll('.notice-gallery-open');
        if(buttonsGallery){
            buttonsGallery.forEach(buttonGallery => {
                buttonGallery.addEventListener('click', () => {                    
                    const dataid = buttonGallery.getAttribute("data-id");      
                    // const description = buttonGallery.getAttribute("data-description");    
                    let modalGallery = document.getElementById(dataid);
                    loadSwipperGallery('#'+dataid + ' .swipper-gallery')
                    if(modalGallery){
                        modalGallery.classList.remove('hidden');
                    }
                });
            });
        }

        // MANUS
        loadMenus();
        loadMenuSearch();
        loadMenuSearchDesktop();
    });
</script>
</body>
</html>

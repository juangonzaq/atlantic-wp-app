// Import styles
import './scss/app.scss';
// Import scripts
import TweenMax from "gsap/TweenMax";
import CSSPlugin from "gsap/CSSPlugin";
import TweenLite from "gsap/TweenLite";
//header
	function scrollAnimated(){
		var lastScrollTop = 0, delta = 20;
		/*$(window).on('scroll',function(){
			var nowScrollTop = $(this).scrollTop();
			if (nowScrollTop > 50){
				$('.bot-nav').addClass('animated');
			} else {
				$('.bot-nav').removeClass('animated');
			}
		});*/
	}
	scrollAnimated();
//another ios
	var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
	if (iOS) {
	 	//
	}
//scroll
	/*$('.anchor a').on('click', function(event){
      	event.preventDefault();
      	let $this = $(this);
      	let href = $this.attr('href');
      	$('html, body').stop().animate({scrollTop: $(href).offset().top - 130}, 800);
 	});*/
	$('.nav-link-search').on("click", function(){
		const $this = $(this);
		const dataId = $this.attr("data-id");
		const dataResult = $this.attr("data-result");
		$(".itemContent").hide();
		$(dataId).show();
		$('.nav-link-search').removeClass("active");
		$this.addClass("active");
		$('#resultados').html(dataResult);
	});
	$('.nav-link-search-mobile').on("click", function(){
		const $this = $(this);
		const dataId = $this.attr("data-id");
		const dataResult = $this.attr("data-result");
		$(".itemContentMobile").hide();
		$(dataId).show();
		$('.nav-link-search-mobile').removeClass("active");
		$this.addClass("active");
		$('#resultados-mobile').html(dataResult);
	});
//header animation
	$('#search').on('keyup', function() {
		const $this = $(this);
		const value = $this.val();
		if (value.length > 2) {
			setTimeout(function(){
				$.ajax({
					type: "post",
					dataType: "json",
					url: ajaxUrl,
					data: {
						action: "send_mydata",
						value: value
					},
					success: function(response) {
						const posts = response.posts;
						const medias = response.medias;
						const videos = response.videos;
						const lengthtotal = posts.length + medias.length + videos.length;
						$('.nav-link-search').eq(0).attr("data-result", lengthtotal);
						$('.nav-link-search').eq(1).attr("data-result", response.posts.length);
						$('.nav-link-search').eq(2).attr("data-result", response.medias.length);
						$('.nav-link-search').eq(3).attr("data-result", response.videos.length);
						$('#resultados').html(lengthtotal);
						//data
						const $todos = $('#todos').find('.addContentJs');
						const $noticias = $('#noticias').find('.addContentJs');
						const $videos = $('#videos').find('.addContentJs');
						const $galeria = $('#galeria').find('.addContentJs');
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
											<a href="${post.link}" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg" style="min-height: 332px !important;">
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
											<a href="${post.link}" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg" style="min-height: 332px !important;">
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
										<a href="${post.link}" class="flex w-full flex-col items-start justify-between relative overflow-hidden max-h-96 rounded-lg" style="min-height: 332px !important;">
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
						$("#MySearchcontent").show();
						//functions
					}
				});
			}, 500);
		}
	});
	$('#searchMobile').on('keyup', function() {
		const $this = $(this);
		const value = $this.val();
		if (value.length > 2) {
			setTimeout(function(){
				$.ajax({
					type: "post",
					dataType: "json",
					url: ajaxUrl,
					data: {
						action: "send_mydata",
						value: value
					},
					success: function(response) {
						const posts = response.posts;
						const medias = response.medias;
						const videos = response.videos;
						const lengthtotal = posts.length + medias.length + videos.length;
						$('.nav-link-search-mobile').eq(0).attr("data-result", lengthtotal);
						$('.nav-link-search-mobile').eq(1).attr("data-result", response.posts.length);
						$('.nav-link-search-mobile').eq(2).attr("data-result", response.medias.length);
						$('.nav-link-search-mobile').eq(3).attr("data-result", response.videos.length);
						$('#resultados-mobile').html(lengthtotal);
						//data
						const $todos = $('#todos-mobile').find('.mobileJsContent');
						const $noticias = $('#noticias-mobile').find('.mobileJsContent');
						const $videos = $('#videos-mobile').find('.mobileJsContent');
						const $galeria = $('#galeria-mobile').find('.mobileJsContent');
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
									<div class="w-full px-4">
										<article class="w-full notice">
											<a href="${post.link}" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
												<div class="w-2/5 relative">
													<img src="${post.imagen}" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image">
												</div>
												<div class="w-3/5">
													<div class="h-full w-full flex flex-col justify-between p-7">
														<div class="w-full">
															<div class="flex items-center gap-x-2 ">
																<span class="text-warning leading-none text-sm">${post.category}</span>
															</div>
															<h3 class="mt-2 leading-6 text-white">
																<span class="text-xl font-medium">
																${post.name}
																</span>
															</h3>
														</div>
														<div class="flex items-center gap-x-2 text-white text-sm mt-2">
															<span class="leading-none text-sm">${post.dia}</span>|<span class="leading-none text-sm">${post.hora} hrs.</span>
														</div>
													</div>
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
									<div class="w-full px-4">
										<article class="w-full notice">
											<a href="${post.link}" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
												<div class="w-2/5 relative">
													<img src="${post.imagen}" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image">
												</div>
												<div class="w-3/5">
													<div class="h-full w-full flex flex-col justify-between p-7">
														<div class="w-full">
															<div class="flex items-center gap-x-2 ">
																<span class="text-warning leading-none text-sm">${post.category}</span>
															</div>
															<h3 class="mt-2 leading-6 text-white">
																<span class="text-xl font-medium">
																${post.name}
																</span>
															</h3>
														</div>
														<div class="flex items-center gap-x-2 text-white text-sm mt-2">
															<span class="leading-none text-sm">${post.dia}</span>|<span class="leading-none text-sm">${post.hora} hrs.</span>
														</div>
													</div>
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
									<div class="w-full px-4">
										<article class="w-full notice">
											<a href="${post.link}" class="flex w-full flex relative overflow-hidden bg-gray rounded-lg">
												<div class="w-2/5 relative">
													<img src="${post.imagen}" alt="" class="rounded-tl-lg rounded-bl-lg object-cover object-center w-full h-full notice-image">
												</div>
												<div class="w-3/5">
													<div class="h-full w-full flex flex-col justify-between p-7">
														<div class="w-full">
															<div class="flex items-center gap-x-2 ">
																<span class="text-warning leading-none text-sm">${post.category}</span>
															</div>
															<h3 class="mt-2 leading-6 text-white">
																<span class="text-xl font-medium">
																${post.name}
																</span>
															</h3>
														</div>
														<div class="flex items-center gap-x-2 text-white text-sm mt-2">
															<span class="leading-none text-sm">${post.dia}</span>|<span class="leading-none text-sm">${post.hora} hrs.</span>
														</div>
													</div>
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
						$("#MySearchcontentMobile").show();
						//functions
					}
				});
			}, 500);
		}
	});
/* MENU RESPONSIVE */


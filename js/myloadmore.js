jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error

  // FILTER BAR CONTROLLER
  // Bloque inspirado en el post:
  // https://rudrastyh.com/wordpress/load-more-posts-ajax.html

  // TODO: hay mejores formas de hacer AJAX en wordpress, por ejemplo:
  // https://10up.github.io/Engineering-Best-Practices/php/
  // + ctrl + f = ajax

  // TODO: re - hacer con rewrite API
  // AND ALSO PAGINATION CONTROLLER
  function filterPagination(parent, category, page){
    var filterQueries = new Array();




    // URL HANDLING
		// urlVirg es la url sin variables
    var urlVirg = window.location.href.split('?')[0];
		// urlVars será el vector de variables en la url
    var urlVars = window.location.href.split('?');
    urlVars.shift();
    urlVars = !urlVars[0] ? [] : urlVars.join().split('&');

		var filters = urlVars.map( x => x.split('=')[0]);
    var values  = urlVars.map( x => x.split('=')[1]);

		current = filters.includes("page") ? parseInt(values[filters.findIndex(x=>x=='page')]) : 1;
		if ( page == 'next' ) { page = current + 1; }
		if ( page == 'prev' ) { page = current - 1; }


		if(parent){
			if(filters.includes(parent)){
				let j=0;
				urlVars.forEach((item, i) => {
					if (item.split('=')[0] == parent) {
						// si la categoria es 0 quita el filtro
						if (category != '0') { filterQueries[j] = parent + '=' + category; j+=1; }
					} else { filterQueries[j] = item; j+=1; }
				});
			} else {
				urlVars.forEach((item, i) => {
					filterQueries[i] = item;
				});
				filterQueries.push(parent + '=' + category);
			}
		}

		if(page){
			if(filters.includes('page')){
				c.log(page);
				let j=0;
				urlVars.forEach((item, i) => {
					if (item.split('=')[0] == 'page') {
						filterQueries[j] = 'page=' + page; j++;
					} else { filterQueries[j] = item; j++; }
				});
			} else {
				urlVars.forEach((item, i) => {
					filterQueries[i] = item;
				});
				filterQueries.push('page=' + page);
			}
		}
    window.history.replaceState('', 'Title', urlVirg + '?' + filterQueries.join('&'));
    // END OF URL HANDLING


		// PREPARE DATA TO BE SENT
    var categoriesArray = filterQueries.map ( item => item.split('=')[1] );
    var parentsArray = filterQueries.map ( item => item.split('=')[0] );
		if(parentsArray.includes('page')){
			categoriesArray.splice(parentsArray.findIndex(x=>x=='page'), 1);
			parentsArray.splice(parentsArray.findIndex(x=>x=='page'), 1);
		}
		// the value in 'action' is the key that will be identified by the 'wp_ajax_' hook
		var data = {
			'action'   : 'latte_pagination',
			'query'    : misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page'     : page,
		};
    if (!!categoriesArray[0]) { data['category'] = categoriesArray; }
    if (!!parentsArray[0]) { data['parent'] = parentsArray; }
		// DATA READY




    // Send the data
    $.ajax({
      url : misha_loadmore_params.ajaxurl,
      data : data,
      type : 'POST',
      success : respuesta => {
        // d.querySelector('#slider')
        // If successful Append the data into our html container
        $('#slider').empty();
        $('#slider').append(respuesta);
      }
    });
  }
  // Load page 1 as the default
  // cvf_load_all_posts(1);

  // Handle the clicks
  $('.paginationLink').live('click',function(){
      // var page = $(this).attr('p');
      page = this.dataset.pagination;
      filterPagination(false, false, page);
  });
	$('.selectBoxOption').change(function(){
    var button = $(this),
        parent = button[0].querySelector('input').dataset.parent,
        category = button[0].querySelector('input').dataset.slug;
		filterPagination(parent, category, false);
	});
	// END OF PAGINATION CONTROLLER
	// END OF FILTER BAR CONTROLLER








  // ADD TO CART CONTROLLER
  $( document.body ).on( 'added_to_cart removed_from_cart', ()=>{
		var data = { 'action' : 'added_to_cart' };
    $.ajax({
      url : misha_loadmore_params.ajaxurl,
      data : data,
      type : 'POST',
      success : respuesta => {
        d.querySelector('.cartButtonCant').innerText = respuesta/10;
      }
    });
  })
  // END OF ADD TO CART CONTROLLER
});

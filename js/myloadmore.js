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
    var query = JSON.parse(misha_loadmore_params.posts);
    var filterQueries = new Array();


        // URL HANDLING
          urlVars = getUrlVars();
      		var filters = urlVars.map( x => x.split('=')[0]);
          var values  = urlVars.map( x => x.split('=')[1]);
      		current = filters.includes("page") ? parseInt(values[filters.findIndex(x=>x=='page')]) : 1;
      		if ( page == 'next' ) { page = current + 1; }
      		if ( page == 'prev' ) { page = current - 1; }
          // c.log(page)
          if ( page && page != 1 ) { filterQueries = setUrlVar('page', page); }
          else if ( page )         { filterQueries = setUrlVar('page'); }

          if (category != 0) { filterQueries = setUrlVar(parent, category); }
          else if ( parent ) { filterQueries = setUrlVar(parent); }
        // END OF URL HANDLING



if(false){
    // TODO: hacer una funcion en plan "changeUrlVar" y ponerlo fuera
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
    // c.log(page)


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
}


		// PREPARE DATA TO BE SENT
    var categoriesArray = filterQueries.map ( item => item.split('=')[1] );
    var parentsArray = filterQueries.map ( item => item.split('=')[0] );
		if(parentsArray.includes('page')){
			categoriesArray.splice(parentsArray.findIndex(x=>x=='page'), 1);
			parentsArray.splice(parentsArray.findIndex(x=>x=='page'), 1);
		}
    query.tax_query = {}
    query.tax_query['relation'] = 'AND';
    query.tax_query[0] = {
      'taxonomy' : 'product_visibility',
      'field'    : 'term_taxonomy_id',
      'terms'    : [7],
      'operator' : 'NOT IN',
    }
    if (!!parentsArray[0]) {
      parentsArray.forEach((item, i) => {
        Object.defineProperty(query.tax_query,item,{enumerable: true,value:{
            'taxonomy' : 'product_cat',
            'field'    : 'slug',
            'terms'    : categoriesArray[i],
          }
        })
      });

      // query.tax_query.tipo = 0;
    }
    // c.log(query.tax_query)
    // c.log(JSON.stringify(query), 'hello world')
		// the value in 'action' is the key that will be identified by the 'wp_ajax_' hook
    // c.log(query);
		var data = {
			'action'   : 'latte_pagination',
			'query'    : JSON.stringify(query), // that's how we get params from wp_localize_script() function
			'page'     : page,
		};
		// DATA READY
        // c.log(query.tax_query.tipo);
        // c.log(query.tax_query.motivo);

    regex = 'stories';
    // c.log(urlVirg)
    // c.log(!!urlVirg.includes(regex))
    var urlVirg = w.location.href.split('?')[0];
    if (!!urlVirg.includes(regex)) {
      data['type'] = "story";
    } else {
      data['type'] = "product";
    }
    // c.log(data['type'])

    // Send the data
    $.ajax({
      url : misha_loadmore_params.ajaxurl,
      data : data,
      type : 'POST',
      success : respuesta => {
        // c.log(respuesta)
        // c.log(JSON.parse(respuesta));
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
  $('#myAddToCart').on('click',()=>{
		// c.log('add to cart')
    let addToCart = d.querySelector('#myAddToCart');
		var product_id = addToCart.dataset.productId;
    var quantity = addToCart.dataset.quantity;

    if(addToCart.dataset.productType == 'variable'){
      var variationId = addToCart.dataset.variationId;
      if (!variationId) {
        alert('Select a size in order to add to cart')
        return;
      }

    }
		var data = {
			"action" : "woocommerce_add_variation_to_cart",
			"product_id" : product_id,
			"variation_id" : variationId,
			"quantity" : quantity,
			// "variation" : {
			// 	"Attributes" : "m - l",
			// },
		};
    $.ajax({
      url : misha_loadmore_params.ajaxurl,
      data : data,
      type : 'POST',
      success : respuesta => {
				c.log(respuesta);
	        d.querySelector('.cartButtonCant').innerText = respuesta/10;
				// c.log('soy el nene');
        // d.querySelector('.cartButtonCant').innerText = respuesta/10;
      }
    });
  })



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

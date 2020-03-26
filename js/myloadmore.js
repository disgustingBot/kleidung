jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error

    // PAGINATION CONTROLLER
    // we will remove the button and load its new copy with AJAX, that's why $('body').on()
	$('body').on('click', '#misha_loadmore', function(){
		$.ajax({
			url : misha_loadmore_params.ajaxurl,
			data : {
				'action': 'loadmore',
				'query': misha_loadmore_params.posts,
				'page' : misha_loadmore_params.current_page,
				'first_page' : misha_loadmore_params.first_page // here is the new parameter
			},
			type : 'POST',
			beforeSend : function ( xhr ) {
				$('#misha_loadmore').text('Loading...');
			},
			success : function( data ){

				$('#misha_loadmore').remove(); // remove button
				$('#misha_pagination').before(data).remove(); // add new posts and remove pagination links
				misha_loadmore_params.current_page++;


			}
		});
		return false;
	});




  // This is required for AJAX to work on our page
  // var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
  // $('body').on('click', '.testButton', function(){c.log('takeover')});

  function cvf_load_all_posts(page){
    c.log(page);
    // Start the transition
    // $(".cvf_pag_loading").fadeIn().css('background','#ccc');

    // Data to receive from our server
    // the value in 'action' is the key that will be identified by the 'wp_ajax_' hook
    var data = {
        'action'   : "latte_pagination",
        // 'page'     : misha_loadmore_params.current_page,
        // 'page'     : d.querySelector('.testButton').dataset.pagination,
        'page'     : page,
        'query'    : misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
    };

    // Send the data
    $.ajax({
      url : misha_loadmore_params.ajaxurl,
      data : data,
      type : 'POST',
      success : respuesta => {
        d.querySelector('#slider')
        // If successful Append the data into our html container
        $('#slider').empty();
        $('#slider').append(respuesta);
        // $(".cvf_universal_container").html(response);
        // End the transition
        // $(".cvf_pag_loading").css({'background':'none', 'transition':'all 1s ease-out'});
        // misha_loadmore_params.current_page++;
      }
    });
  }

  // Load page 1 as the default
  // cvf_load_all_posts(1);

  // Handle the clicks
  $('.testButton').live('click',function(){
    c.log(this);
    page = this.dataset.pagination;
      // var page = $(this).attr('p');
      cvf_load_all_posts(page);
  });
  $('.paginationLink').live('click',function(){
      // var page = $(this).attr('p');
      page = this.dataset.pagination;
      cvf_load_all_posts(page);
  });







    // END OF PAGINATION CONTROLLER



















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



  // FILTER BAR CONTROLLER
  // Bloque inspirado en el post:
  // https://rudrastyh.com/wordpress/load-more-posts-ajax.html

  // TODO: hay mejores formas de hacer AJAX en wordpress, por ejemplo:
  // https://10up.github.io/Engineering-Best-Practices/php/
  // + ctrl + f = ajax

  // TODO: re - hacer con rewrite API
  $('.selectBoxOption').change(function(){
    // c.log('Hola mundo')
    var button = $(this),
        parent = button[0].querySelector('input').dataset.parent,
        category = button[0].querySelector('input').dataset.slug,
        filterQueries = new Array();




    // URL HANDLING
    var urlVirg = window.location.href.split('?')[0];
    var urlVars = window.location.href.split('?');
    urlVars.shift();
    urlVars = !urlVars[0] ? [] : urlVars.join().split('&');

    var filters = urlVars.map( x => x.split('=')[0]);

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
    window.history.replaceState('', 'Title', urlVirg + '?' + filterQueries.join('&'));
    // END OF URL HANDLING





    var categoriesArray = filterQueries.map ( item => item.split('=')[1] );
    var parentsArray = filterQueries.map ( item => item.split('=')[0] );

		var data = {
			'action'   : 'loadmore',
			'query'    : misha_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page'     : misha_loadmore_params.current_page,
		};
    if (!!categoriesArray[0]) { data['category'] = categoriesArray; }
    if (!!parentsArray[0]) { data['parent'] = parentsArray; }

		$.ajax({ // you can also use $.post here
			url : misha_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {

        d.querySelector('#slider').classList.add('loading');
        d.querySelectorAll('.card').forEach((item, i) => {
          item.remove()
        });
				// button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) {
          $('#slider').append(data);
					// button.text( 'More posts' ).prev().after(data); // insert new posts
					// misha_loadmore_params.current_page++;
          d.querySelector('#slider').classList.remove('loading');

					// if ( misha_loadmore_params.current_page == misha_loadmore_params.max_page )
						// button.remove(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					// button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
  // END OF FILTER BAR CONTROLLER
});

// Bloque inspirado en el post:
// https://rudrastyh.com/wordpress/load-more-posts-ajax.html

// TODO: hay mejores formas de hacer AJAX en wordpress, por ejemplo:
// https://10up.github.io/Engineering-Best-Practices/php/
// + ctrl + f = ajax

// TODO: re - hacer con rewrite API
jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
  // $('.misha_loadmore').click(function(){
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
      var j=0;
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
    // filterQueries.forEach((item, i) => {
    //   data['parent'][i] = item.split('=')[0];
    //   data['category'][i] = item.split('=')[1];
    // });
    // c.log(data);

    // c.log(button.querySelector('input').dataset.slug)
    // c.log(button[0].querySelector('input').dataset.slug)

		$.ajax({ // you can also use $.post here
			url : misha_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {

        // c.log(JSON.parse(misha_loadmore_params.posts));
        // c.log(d.querySelector('#slider'));

        // window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
        // window.history.replaceState(“object or string”, “Title”, “/another-new-url”);
        // c.log(window.location.href);

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
});

d=document;w=window;c=console;
// import $ from 'jquery';
// import ajaxLoadMore from 'ajaxLoadMore';


w.onload=()=>{
  // LAZY LOAD FUNCTIONS MODULE
  var lBs=[].slice.call(d.querySelectorAll(".lazy-background")),lIs=[].slice.call(d.querySelectorAll(".lazy")),opt={threshold:.01};
  // c.log(lIs);
  if("IntersectionObserver" in window){
    let lBO=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){let l=e.target;l.classList.add("visible");lBO.unobserve(l)}})},opt),
        lIO=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){let l=e.target;l.classList.remove("lazy");lIO.unobserve(l);l.srcset=l.dataset.url}})},opt);
    lIs.forEach(lI=>{lIO.observe(lI)});lBs.forEach(lB=>{lBO.observe(lB)});
  }

  if (d.querySelector("#logoBrand") ){
    d.querySelector("#logoBrand").classList.add("loaded");
  }
  if(d.querySelector("#logo")){
    d.querySelector("#logo").classList.add("loaded");
  }
  d.getElementById("load").style.top="-100vh";
  if(d.querySelector('#homeATF')){
    // altClassOnScroll('alt', '#header', '#homeATF', false, { threshold : .5 });
  }
}

// SLIDER:
// TODO: mejorar modulo para poder reutilizarlo sin duplicar codigo
var j=1;
var x=d.getElementsByClassName("carouselItem");
var carousels = d.querySelectorAll('.gallery');
carousels.forEach((item, i) => {
  // c.log(item.querySelectorAll('.element'));
  let j=1,x=item.getElementsByClassName("element");


  const showDivs=n=>{

    if(n>x.length){j=1}
    if(n<1){j=x.length}
    for(i=0;i<x.length;i++){x[i].classList.add("inactive")}
    x[j-1].classList.remove("inactive");

  }
  const carousel=()=>{j++;

    for(i=0;i<x.length;i++){x[i].classList.add("inactive")}
    if(j>x.length){j=1}
    x[j-1].classList.remove("inactive");
    setTimeout(carousel, 8000); // Change image every N/1000 seconds

  }

  const plusDivs=n=>{showDivs(j+=n)}

  if(x.length>0){showDivs(j);setTimeout(carousel, 8000);}

  item.querySelector('#nextButton').onclick = () =>{plusDivs(+1)}
  item.querySelector('#prevButton').onclick = () =>{plusDivs(-1)}

});












// alternates a class from a selector of choice, example:
// <div class="someButton" onclick="altClassFromSelector('activ', '#navBar')"></div>
const altClassFromSelector = ( clase, selector, mainClass = false )=>{
  const x = d.querySelectorAll(selector);
  x.forEach((y, i) => {
    // if there is a main class removes all other classes
    if(mainClass){
      y.classList.forEach( item=>{
        // TODO: testear si anda con el nuevo condicional
        if( item!=mainClass && item!=clase ){
          y.classList.remove(item);
        }
      });
    }
    if(y.classList.contains(clase)){
      y.classList.remove(clase)
    }else{
      y.classList.add(clase)
    }
  });
}











// GO BACK BUTTONS
function goBack(){w.history.back()}














// SELECT BOX CONTROLER
const selectBoxControler=(a, selectBoxId, current)=>{ // c.log(a)
  if(!!a){d.querySelector(selectBoxId).classList.add('alt')}
  else   {d.querySelector(selectBoxId).classList.remove('alt')}

  d.querySelector(current).innerHTML=a;
  d.activeElement.blur();
}



//Accordion //Desplegable
var acc = d.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click",()=>{
    this.classList.toggle("active");
    // TODO: Hacer que se puede elegir el elemento a acordionar
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
      panel.style.padding = "0";
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
      panel.style.padding = "20px";
    }
  });
}

// LOGO ANIMATION
// const logo = document.querySelectorAll("#logo path");
// for(let i = 0; i<logo.length; i++) {
//   console.log(`Letter ${i} is ${logo[i].getTotalLength()}`);

// }







// quantity selector on the thing
const changeQuantity = (value) => {
  let quantity = parseInt(d.querySelector('#addToCartQantity').value);
  quantity += value;
  if (quantity<=1) {
    quantity = 1;
  }
  d.querySelector('#addToCartQantity').value       = quantity;
  d.querySelector('#myAddToCart').dataset.quantity = quantity;
}














// const selectBoxVisibilityCheck = (selectBox) => {
//   let numberOfHiddens = selectBox.querySelectorAll('.selectBoxOption.hidden').length
//   if (numberOfHiddens + 1 == selectBox.querySelectorAll('.selectBoxInput').length) {
//     selectBox.classList.add('hidden');
//   } else {
//     selectBox.classList.remove('hidden');
//   }
// }

// const attributes = [...d.querySelectorAll('.selectBox')]
// attributes.forEach( (x, i) =>{
//   selectBoxVisibilityCheck(x);
//   x.querySelectorAll('.single-product .selectBoxInput').forEach( y =>{
//     y.addEventListener('change', z => {

//       let ids = JSON.parse("[" + z.target.dataset.ids + "]");

//       if (i+1<attributes.length) {

//         // for all the next selectBoxes
//         for (var counter = i + 1; counter < attributes.length; counter++) {

//           // this part brings them back to 0
//           let temp = attributes[counter].querySelector('.selectBoxOption:first-child input');
//           if(!temp.checked){
//             selectBoxControler('', '#'+attributes[counter].id, '#'+attributes[counter].querySelector('.selectBoxCurrent').id);
//             temp.checked = true;
//           }
//           d.querySelector('#myAddToCart').dataset.variationId = ''
//           d.querySelector('#myAddToCart').innerText = "Select Options";


//           // this next part hides the attributes that are not variations from the next selectBoxes
//           attributes[counter].querySelectorAll('.selectBoxInput').forEach( (w, k) =>{
//             if(k){ // avoid k = 0 to keep blank option
//               let newIds = JSON.parse("[" + w.dataset.ids + "]");
//               let selectBoxOption = attributes[counter].querySelectorAll('.selectBoxOption')[k];
//               // if any of the new ids equals any of the old ids
//               if (newIds.some( r => ids.includes(r))) {
//                 selectBoxOption.classList.remove("hidden")
//               } else {
//                 selectBoxOption.classList.add("hidden")
//               }
//             }
//           })
//           selectBoxVisibilityCheck(attributes[counter]);
//         }

//         d.querySelector('#myAddToCart').dataset.variationId = '';


//       } else {
//         // aqui voy a  comparar los id y pasar el que tienen todos en común al boton de add to cart
//         attributes.forEach((att,index)=>{
//           // if (index+1<attributes.length) {
//           // let newIds = JSON.parse("[" + att.querySelector('input:checked').dataset.ids + "]");
//           // let commonIds = [...new Set(newIds)].filter(x => new Set(ids).has(x));
//           let newIds = JSON.parse("[" + att.querySelector('input:checked').dataset.ids + "]");
//           if (index>0) {
//             let oldIds = JSON.parse("[" + attributes[index-1].querySelector('input:checked').dataset.ids + "]");
//             let commonIds = [...new Set(newIds)].filter(x => new Set(oldIds).has(x));
//             c.log(commonIds);
//             if (commonIds.length==1) {
//               d.querySelector('#myAddToCart').dataset.variationId = commonIds[0]
//               d.querySelector('#myAddToCart').innerText = "Add to cart";
//               // TODO: falta que ponga una descripcion dinamica en variation description
//               // TODO: falta que muestre el precio de forma dinamica
//             } else {
//               d.querySelector('#myAddToCart').dataset.variationId = ''
//               d.querySelector('#myAddToCart').innerText = "Select Options";
//             }
//           }
//           if (attributes.length == 1) {
//             // c.log(att.querySelector('input:checked').value)
//             if(att.querySelector('input:checked').value!=0){
//               d.querySelector('#myAddToCart').dataset.variationId = att.querySelector('input:checked').value
//               d.querySelector('#myAddToCart').innerText = "Add to cart";
//             } else {
//               d.querySelector('#myAddToCart').dataset.variationId = ''
//               d.querySelector('#myAddToCart').innerText = "Select Options";
//             }

//           }
//         })
//       }


//     })
//   })
// })








const attributes = [...d.querySelectorAll('.single-product .selectBoxInput')]
attributes.forEach( (x, i) =>{

  // x.querySelectorAll('.single-product .selectBoxInput').forEach( y =>{
    x.addEventListener('change', z => {

      let ids = z.target.dataset.ids;

      if(z.target.value!=0){
        d.querySelector('#myAddToCart').dataset.variationId = ids
        d.querySelector('#myAddToCart').dataset.variation = z.target.value
        d.querySelector('#myAddToCart').innerText = "Add to cart";
      } else {
        d.querySelector('#myAddToCart').dataset.variationId = ''
        d.querySelector('#myAddToCart').dataset.variation = ''
        d.querySelector('#myAddToCart').innerText = "Select Options";
      }


    })
  // })
})


























const altClassOnScroll = (clase, selector, observado, unobserve = true, options = { root: null, threshold: 1, rootMargin: "0px 0px 0px 0px" }) => {

  const observer = new IntersectionObserver(function(entries, observer){
    entries.forEach(entry => {
      const x = d.querySelectorAll(selector);
      if(entry.isIntersecting){
        x.forEach( y => {
          y.classList.add(clase)
        });
        if(unobserve){observer.unobserve(entry.target)}
      } else {
        x.forEach( y => {
          y.classList.remove(clase)
        });
      }
    })
  }, options);

  d.querySelectorAll(observado).forEach(e => {
    observer.observe(e);
  })
}


// altClassOnScroll('alt', '#header', '#homeATF', false, { threshold : .7 });


// cards = d.querySelectorAll('.card')
// cards.forEach((item, i) => {
//   console.log(item.id);
//   altClassOnScroll('alt', '.archiveStories', item.id { threshold : .51 });
// altClassOnScroll('alt', '#header', '#homeATF', { threshold : .7 });


/*  Animacion de STORIES ATF  */
if(d.querySelectorAll('.storieImg')){
  d.querySelectorAll('.storieImg').forEach((item, i) => {
    altClassOnScroll('animate', "#"+item.id, '.storiesTitle',  {threshold:.1});
  });
}

/*  Animacion de STORIES ARCHIVE  */
if(d.querySelectorAll('.card')){
  d.querySelectorAll('.card').forEach((item, i) => {
    altClassOnScroll('alt', "#"+item.id, "#"+item.id,  {threshold:.2});
  });
}


/*  Animacion de SINGLE STORIE SOCIALSHARING  */
altClassOnScroll('alt', '.storieSocialSharing', '.titleMoreStories',  { threshold : .1 });


// altClassOnScroll('alt', '#header', '#homeATF',      true, { threshold : .7 });
altClassOnScroll('alt', '#brandImg1', '#brandTxt1', true, { threshold : .7, rootMargin: "0px 0px 0px 0px" });
altClassOnScroll('alt', '#brandTxt1', '#brandTxt1', true, { threshold : .3 });
altClassOnScroll('alt', '#brandImg2', '#brandImg2', true, { threshold : .3 });
altClassOnScroll('alt', '#brandTxt2', '#brandTxt2', true, { threshold : .3 });
altClassOnScroll('alt', '#brandImg3', '#brandImg3', true, { threshold : .3 });
altClassOnScroll('alt', '#brandTxt3', '#brandTxt3', true, { threshold : .3 });
altClassOnScroll('alt', '#brandTxt4', '#brandTxt4', true, { threshold : .3 });
altClassOnScroll('alt', '#brandImg4', '#brandTxt4', true, { threshold : .3 });
altClassOnScroll('alt', '#brandImg5', '#brandTxt5', true, { threshold : .3 });


// brandImg5
// cards = d.querySelectorAll('.card')
// cards.forEach((item, i) => {
//   console.log(item.id);
//   altClassFromSelectorOnObserveSelector('alt', '.archiveStories', item.id { threshold : .51 });
// });











const altClassOnScroll_v2 = (observado, unobserve = true, reverse = false, options = { root: null, threshold: 1, rootMargin: "0px 0px 0px 0px" }) => {

  const observer = new IntersectionObserver(function(entries, observer){
    entries.forEach(entry => {
      const x = d.querySelectorAll('.Obse');
      if(entry.isIntersecting){
        x.forEach( y => {
          if(!reverse){
            y.classList.add('observed')
          } else {
            y.classList.reverse('observed')
          }
        });
        if(unobserve){observer.unobserve(entry.target)}
      } else {
        x.forEach( y => {
          if(!reverse){
            y.classList.remove('observed')
          } else {
            y.classList.add('observed')
          }
        });
      }
    })
  }, options);

  d.querySelectorAll(observado).forEach(e => {
    observer.observe(e);
  })
}

if(d.querySelectorAll('.Obse')){
  d.querySelectorAll('.Obse').forEach((item, i) => {
    let observe   = item.dataset.observe ? item.dataset.observe : '#'+item.id;
    let reverse   = item.dataset.reverse ? item.dataset.reverse : false;
    let unobserve = item.dataset.unobserve == 'false' ? false : true;
    // c.log(unobserve);
    altClassOnScroll_v2(observe, unobserve, reverse)
  })
}







const frontPageSlider = (page) => {
  // c.log(lt_data.ajaxUrl);

  d.querySelector('#sliderArrow').dataset.page = parseInt(d.querySelector('#sliderArrow').dataset.page) + page;
  var url = lt_data.ajaxUrl,
      dataNames =['action', 'page'],
      dataValues=['lt_slider', d.querySelector('#sliderArrow').dataset.page];
  postAjaxCall(url,dataNames,dataValues).then(v=>{
    // c.log(v)
    if (v=='no_more') {
      window.location.href = lt_data.home + '/shop';
      return;
    }
    try{
      d.querySelectorAll('.slider .card').forEach((x,i)=>{x.remove()})
      d.querySelector('.sliderCards').innerHTML = v;
      // d.querySelector('.slider .sliderTitle').insertAfter(v)
      // JSON.parse(v).forEach((e,i)=>{
      //   c.log(e)
      // })
    }catch(err){
      c.log(err);c.log(v)
        d.querySelectorAll('.slider .card').forEach((x,i)=>{x.remove()})
        // d.querySelector('.slider').insertBefore(v, d.querySelector('.slider .sliderTitle'))
    }
  });
}





function postAjaxCall(url,dataNames,dataValues){// return a new promise.
	return new Promise((resolve,reject)=>{// do the usual XHR stuff
		var req=new XMLHttpRequest();
		req.open('post',url);
		//NOW WE TELL THE SERVER WHAT FORMAT OF POST REQUEST WE ARE MAKING
		req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		req.onload =()=>{if(req.status>=200&&req.status<300){resolve(req.response)}else{reject(Error(req.statusText));console.log("ERROR")}}
		req.onerror=()=>{reject(Error("Network Error"))}// handle network errors
		// prepare the data to be sent
		let data;
		for(var i=0;i<dataNames.length;i++){data=data+"&"+dataNames[i]+"="+dataValues[i]}
		// make the request
    req.send(data)
	})
}
// ESTO ENTREGA EL LENGHT DE LAS LETRAS DEL LOGO PARA LANIMACIÓN, LO DEJO COMENTADO
// const logo = document.querySelectorAll("#logo path");
//
// for (let i = 0; i < logo.length; i++) {
//   console.log(`Letter ${i} is ${logo[i].getTotalLength()}`);
// }



// URL HANDLING
const setUrlVar = ( variable, value = '' ) => {
  var filterQueries = new Array();
	// urlVirg es la url sin variables
  var urlVirg = w.location.href.split('?')[0];
	// urlVars será el vector de variables en la url
  // var urlVars = w.location.href.split('?');
  // urlVars.shift();
  // urlVars = !urlVars[0] ? [] : urlVars.join().split('&');

  var urlVars = getUrlVars();

	var variables = urlVars.map( x => x.split('=')[0] );
  var values  = urlVars.map( x => x.split('=')[1] );

  // c.log(page)


	if(variable){
		if(variables.includes(variable)){
			let j=0;
			urlVars.forEach((item, i) => {
				if ( variables[i] == variable ) {
					// si la categoria es 0 quita el filtro
					if (value != '') { filterQueries[j] = variable + '=' + value; j+=1; }
				} else { filterQueries[j] = item; j+=1; }
			});
		} else if (value != '') {
			urlVars.forEach((item, i) => {
				filterQueries[i] = item;
			});
			filterQueries.push(variable + '=' + value);
		}
	}
  let conector = filterQueries.length != 0 ? '?' : '';
  w.history.replaceState('', 'Title', urlVirg + conector + filterQueries.join('&'));
  // c.log(filterQueries)
  return filterQueries;
}

const getUrlVars = () => {
  var urlVars = w.location.href.split('?');
  urlVars.shift();
  urlVars = !urlVars[0] ? [] : urlVars.join().split('&');

  return urlVars;
}
// END OF URL HANDLING

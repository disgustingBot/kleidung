d=document;w=window;c=console;
// import $ from 'jquery';
// import ajaxLoadMore from 'ajaxLoadMore';


w.onload=()=>{
  // LAZY LOAD FUNCTIONS MODULE
  var lBs=[].slice.call(d.querySelectorAll(".lazy-background")),lIs=[].slice.call(d.querySelectorAll(".lazy")),opt={threshold:.01};
  if("IntersectionObserver" in window){
    let lBO=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){let l=e.target;l.classList.add("visible");lBO.unobserve(l)}})},opt),
        lIO=new IntersectionObserver(es=>{es.forEach(e=>{if(e.isIntersecting){let l=e.target;l.classList.remove("lazy");lIO.unobserve(l);l.srcset=l.dataset.url}})},opt);
    lIs.forEach(lI=>{lIO.observe(lI)});lBs.forEach(lB=>{lBO.observe(lB)});
  }

  if (d.querySelector("#logoBrand") ){
    d.querySelector("#logoBrand").classList.add("loaded");
  }
  d.querySelector("#logo").classList.add("loaded");
  d.getElementById("load").style.top="-100vh";
  altClassOnScroll('alt', '#header', '#homeATF', false, { threshold : .5 });
}


// SLIDER:
// TODO: mejorar modulo para poder reutilizarlo sin duplicar codigo
var j=1,x=d.getElementsByClassName("carouselItem");
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
const selectBoxControler=(a, selectBoxId, current)=>{// c.log(a)
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

























const altClassOnScroll = (clase, selector, observado, unobserve = true, options = { root: null, threshold: 1, rootMargin: "0px 0px 0px 0px" }) => {

  const observer = new IntersectionObserver(function(entries, observer){
    entries.forEach(entry => {



        // const x = d.querySelectorAll(selector);
        // x.forEach((y, i) => {
        //   if(y.classList.contains(clase)){
        //     y.classList.remove(clase)
        //   }else{
        //     y.classList.add(clase)
        //   }
        // });




        const x = d.querySelectorAll(selector);
        if(entry.isIntersecting){
          x.forEach( y => {
            y.classList.add(clase)
          });
        } else {
          x.forEach( y => {
            y.classList.remove(clase)
          });
        }




      // altClassFromSelector(clase, selector)
      if(entry.isIntersecting && unobserve){
        observer.unobserve(entry.target);
      // } else {

      }






    })
  }, options);

  d.querySelectorAll(observado).forEach(e => {
    observer.observe(e);
  })
}

altClassFromSelectorOnObserveSelector('alt', '#header', '#homeATF', { threshold : .7 });


cards = d.querySelectorAll('.card')
cards.forEach((item, i) => {
  console.log(item.id);
  altClassFromSelectorOnObserveSelector('alt', '.archiveStories', item.id { threshold : .51 });
});


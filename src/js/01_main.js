//init fancybox.js
Fancybox.bind("[data-fancybox]", {});

//init yandex.map.js
// ymaps.ready(init);

//swiper.js
const swiperServices = new Swiper('.l-services__grid.swiper', {
  spaceBetween: 20,
  slidesPerView: 1,
  breakpoints: {
    320: {
      slidesPerView: 'auto',
      spaceBetween: 20
    },
    769: {
      slidesPerView: 2,
      spaceBetween: 20
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 20
    }
  }
});

const swiperClients = new Swiper('.swiper-clients', {
  spaceBetween: 20,
  centeredSlides: false,
  slidesPerView: "auto",
  loop: true,
  loopedSlides: 20,
  speed: 6000,
  autoplay: {
    delay: 1,
    disableOnInteraction: false,
  },
  allowTouchMove: true,
  disableOnInteraction: true,
});

const swiperReviews = new Swiper('.swiper-reviews', {
  slidesPerView: 1,
  spaceBetween: 20,
  speed: 1000,
  navigation: {
    nextEl: '.l-reviews__card-next',
    prevEl: '.l-reviews__card-prev',
  },
  breakpoints: {
    320: {
      slidesPerView: 'auto',
      spaceBetween: 20
    },
    768: {
      slidesPerView: 1,
      spaceBetween: 20
    },
  }
});

const swiperFrames = new Swiper('.swiper-frames', {
  slidesPerView: "auto",
  spaceBetween: 40,
  speed: 1000,
  navigation: {
    nextEl: '.l-reviews__card-next',
    prevEl: '.l-reviews__card-prev',
  },
  breakpoints: {
    320: {
      spaceBetween: 20
    },
    768: {
      spaceBetween: 40
    },
  }
});

const swiperServiceFrames = new Swiper('.service-frames', {
  slidesPerView: "auto",
  spaceBetween: 40,
  speed: 1000,
  navigation: {
    nextEl: '.l-reviews__card-next',
    prevEl: '.l-reviews__card-prev',
  },
  breakpoints: {
    320: {
      spaceBetween: 20
    },
    768: {
      spaceBetween: 40
    },
  }
});

document.addEventListener('DOMContentLoaded', function() {
  // Map tabs
  const btns = document.querySelectorAll('.l-contacts__info-btn .btn');
  const tabs = document.querySelectorAll('.l-contacts__info-tab');

  btns.forEach(btn => {
    btn.addEventListener('click', function() {
      btns.forEach(item => item.classList.remove('active'));
      this.classList.add('active');

      const tabToShow = this.getAttribute('data-tab');
      const tab = document.getElementById(tabToShow);

      tabs.forEach(tab => tab.classList.remove('active'));
      tab.classList.add('active');
      tab.style.opacity = 0;

      setTimeout(function() {
        tab.style.opacity = 1;
      }, 100);

    });
  });

  // Header dropdown services
  const dropdownBtn = document.querySelectorAll('.l-header__nav-dropdown-btn');
  const dropdownContent = document.querySelectorAll('.l-header__nav-dropdown-content');

  dropdownBtn.forEach(btn => {
    btn.addEventListener('click', function(event) {
      event.stopPropagation();

      this.classList.toggle('active');
      const index = Array.from(dropdownBtn).indexOf(this);
      dropdownContent[index].classList.toggle('active');
    });
  });

  document.addEventListener('click', function() {
    dropdownContent.forEach(content => content.classList.remove('active'));
    dropdownBtn.forEach(btn => btn.classList.remove('active'));
  });

  // Burger menu
  const burgerOpenBtn = document.querySelector('.l-header__mob-nav svg.open-burger');
  const burgerCloseBtn = document.querySelector('.l-header__mob__close svg');
  const burgerWrapper = document.querySelector('.l-header__mob-wrapper');
  const burgerContent = document.querySelector('.l-header__mob-content');

  burgerOpenBtn.addEventListener('click', function(event) {
    event.stopPropagation();
    burgerWrapper.classList.add('active');
    document.documentElement.classList.add('no-scroll');
    setTimeout(function() {
      burgerContent.classList.add('active');
    }, 100);
  });

  burgerCloseBtn.addEventListener('click', function() {
    burgerContent.classList.remove('active');
    setTimeout(function() {
      burgerWrapper.classList.remove('active');
      document.documentElement.classList.remove('no-scroll');
    }, 100);
  });

  document.addEventListener('click', function(event) {
    if (event.target === burgerWrapper) {
      burgerContent.classList.remove('active');
      setTimeout(function() {
        burgerWrapper.classList.remove('active');
        document.documentElement.classList.remove('no-scroll');
      }, 100);
    }
  });
});

//yandex map function
// function init() {
//   var myMap = new ymaps.Map("map", {
//     center: [62.024255, 129.726218],
//     zoom: 16,
//     controls: ['zoomControl'],
//     behaviors: ["default", "scrollZoom"]
//   });
//   var myPlacemark1 = new ymaps.Placemark(
//     [62.024255, 129.726218], 
//     {balloonContent: 'Транспортная компания "Айан"'},
//     {iconColor: '#3AC4A7'}
//   );
//   var myPlacemark2 = new ymaps.Placemark(
//     [55.048013, 82.905086], 
//     {balloonContent: 'Офис в Новосибирске'},
//     {iconColor: '#3AC4A7'}
//   );
//   var myPlacemark3 = new ymaps.Placemark(
//     [55.461757, 37.583041], 
//     {balloonContent: 'Офис в Москве'},
//     {iconColor: '#3AC4A7'}
//   );
//   myMap.behaviors.disable("scrollZoom");
//   myMap.geoObjects.add(myPlacemark1);
//   myMap.geoObjects.add(myPlacemark2);
//   myMap.geoObjects.add(myPlacemark3);

//   let locationBtns = document.querySelectorAll('.l-contacts__info-btn .btn');
//   locationBtns.forEach(element => {
//     element.addEventListener("click", (event) => {
//       let coordinate = element.getAttribute('data-coordinate').split(',',2);
//       myMap.setZoom(17);
//       myMap.panTo([+coordinate[0], +coordinate[1]], {
//         flying: true,
//         delay: 1500,
//         duration: 1500,
//       });
//     });
//   });
// }

//custom select
var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);



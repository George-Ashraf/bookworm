

window.onload=function(){
    const load =document.querySelector('.spinnerbox')

        load.className +=" hide"
    }


const section = document.querySelectorAll(".book-showcase")
const book = document.querySelectorAll(".book")
const body = document.querySelector("body")

let prev = 0
let calc = 0
const sensitivity = 2

for (let i = 0; i < section.length; i++) {
    section[i].addEventListener('mousedown', function (e) {
        const x = e.clientX
        section[i].addEventListener('mousemove', rotate)

        function rotate(e) {
            calc = (e.clientX - x)
            for (let x = 0; x < book.length; x++) {

                book[x].style.transform = `rotateY(${calc+prev}deg)`
                book[x].style.cursor = "grabbing"
            }
        }
        prev += calc
        window.addEventListener('mouseup', function () {
            section[i].removeEventListener('mousemove', rotate)
            body.style.cursor = "default"
        })
    })

}

document.addEventListener('DOMContentLoaded', () => {
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    const datatables = select('.datatable', true);
    datatables.forEach(datatable => {
        new simpleDatatables.DataTable(datatable, {
            perPageSelect: [5, 10, 15, ["All", -1]],
            columns: [
                {
                    select: 2,
                    sortSequence: ["desc", "asc"]
                },
                {
                    select: 3,
                    sortSequence: ["desc"]
                },
                {
                    select: 4,
                    cellClass: "green",
                    headerClass: "red"
                }
            ]
        });
    });
});


var toggle =document.querySelector( '.menu-toggle');
toggle.onclick=function(){
    var nav=document.querySelector('nav');
    nav.classList.toggle('active')
    var link=document.querySelector('nav ul li a');
    link.classList.toggle('active');

}

const currentloaction= location.href;
const menuitem= document.querySelectorAll('a');
const menulength=menuitem.length
for(let i=0;i<menulength;i++){
    if(menuitem[i].href===currentloaction){
        menuitem[i].className="active";
    }
}
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
     autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
    loop: true,

    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
      },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 5,
        spaceBetween: 10,
      },
    },
  });
  var swiper = new Swiper(".mySwiper2", {
    pagination: {
      el: ".swiper-pagination",
      dynamicBullets: true,
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
  });

// var hamburger = document.querySelector(".hamburger");
// hamburger.addEventListener("click", function() {
//   hamburger.classList.toggle("is-active");
// });

wow = new WOW({
    boxClass: 'animate__animated'

  }).init();


//   const driver = window.driver.js.driver;


//   const driverObj = driver({
//     showProgress: true,
//     steps: [
//       { element: '.step1', popover: { title: 'booksharing section', description: 'make a booksharing section to upload your book and wait another user to upload his book' } },
//       { element: '.step2', popover: { title: 'add your section', description: 'now add your section ' } },
//       { element: '.step3', popover: { title: 'Title', description: 'Description' } },
//       { element: '.step4', popover: { title: 'Title', description: 'Description' } },
//     ]
//   });

//   driverObj.drive();

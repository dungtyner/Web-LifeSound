myFunction();
myFunction1();
myFunction2();
myFunction3();
openNav();
closeNav();

function myFunction() {
document.getElementById("prod-dropdown-brand").classList.toggle("show");
}

function myFunction1() {
  document.getElementById("prod-dropdown-type").classList.toggle("show");
}

function myFunction2() {
  document.getElementById("prod-dropdown-price").classList.toggle("show");
}

function myFunction3() {
  document.getElementById("prod-dropdown-availability").classList.toggle("show");
}  

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.prod-btn-content')) {
    var dropdowns = document.getElementsByClassName("prod-subnav-list");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
/* Hiển thị giá trị mặc định 0 cho thẻ input với id là demo*/
output.innerHTML = slider.value; 

/* cập nhật giá trị hiện tại của ranger slider*/
slider.oninput = function() {
  output.innerHTML = this.value;
}


function openNav() {
  document.getElementById("prod-filter").style.display = "flex";
  document.getElementById("prod-filter").style.width = "400px";


}

function closeNav() {
  document.getElementById("prod-filter").style.width = "0";

}


window.addEventListener('resize',function(event)
{
  console.log(window.innerWidth);
  if(window.innerWidth<=992)
  {
    var el_filter=document.querySelector('.col-md-3.product-facet__aside');
    console.log(el_filter);
    console.log(document.querySelector('.prod-filter-responsive'));
    document.querySelector('.prod-filter-responsive').appendChild(el_filter);
  }  
  else
  {
    var el_filter=document.querySelector('.col-md-3.product-facet__aside');
    console.log(el_filter);
    console.log(document.querySelector('.prod-filter-responsive'));
    var container= document.querySelector('.container.container-content_deal')


    container.insertBefore(el_filter,document.querySelector('.col-md-9.wrapper-product'));

  }
})

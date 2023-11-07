import * as toolProduct from '../products/toolProduct.js';
// myFunction();
// myFunction1();
// myFunction2();
// myFunction3();
openNav();
closeNav();
// handleClick_BtnSummary_filter();
  function handleClick_BtnSummary_filter()
  {
    var BtnSummary_filters = document.querySelectorAll('.btn-block.prod-btn-content')
    for(var BtnSummary_filter of BtnSummary_filters)
    {

      BtnSummary_filter.addEventListener('click',function(event){
        event.currentTarget.closest('.prod-nav-list').querySelector('.prod-subnav-list').classList.toggle('show');
      });
    }
  }


  handleClick_BtnSummary_PRO(
    document.querySelectorAll('.btn-block.prod-btn-content'),
    (event)=>
    {
      

        if(
          // !event.currentTarget.closest('.prod-nav-list').querySelector('.form-range.subnav-item-range-price')
          true
        )
        {

          event.currentTarget.closest('.prod-nav-list').querySelector('.prod-subnav-list').classList.toggle('show');
        }

    }
  )

  function handleClick_BtnSummary_PRO(BtnSummaries,methodWork)
  {
    for(var i=0; i<BtnSummaries.length;i++)
    {
      BtnSummaries[i].addEventListener('click',function(event){
          methodWork(event);

      });
    }
  }
// Close the dropdown if the user clicks outside of it
// window.onclick = function(event) {
//   if (!event.target.matches('.prod-btn-content')) {
//     var dropdowns = document.getElementsByClassName("prod-subnav-list");
//     var i;
//     for (i = 0; i < dropdowns.length; i++) {
//       var openDropdown = dropdowns[i];
//       if (openDropdown.classList.contains('show')) {
//         openDropdown.classList.remove('show');
//       }
//     }
//   }
// }

var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
/* Hiển thị giá trị mặc định 0 cho thẻ input với id là demo*/
output.innerHTML = slider.value; 

/* cập nhật giá trị hiện tại của ranger slider*/
slider.oninput = function() {
  output.innerHTML = this.value;
}


function openNav() {
  document.querySelector('.mobile-toolbar-item.mobile-toolbar-item__filter').addEventListener('click',function(event)
  {
    document.getElementById("prod-filter").style.display = "flex";
    document.getElementById("prod-filter").style.width = "400px";
  })


}

function closeNav() {
  document.querySelector('.closebtn').addEventListener('click',function(event)
  {
    document.getElementById("prod-filter").style.width = "0";
  })

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


function openPopupProduct()
{
  var list = document.querySelectorAll('col-md-4.product-card-item');

  list.addEventListener('click',function(event)
  {
    
  })
}
toolProduct.loadEventItemProductShowDetail(
  document.querySelectorAll('.col-md-4.product-card-item')
  ,'click'
  ,document
  ,(data)=>{
    toolProduct.getDataDetail(data,null);
  }
)

var Filter_brandItems= document.querySelectorAll('.prod-subnav-list .prod-subnav-item');
// console.log(Filter_brandItems);
Filter_brandItems.forEach(el=>{
  el.addEventListener('click',(event)=>{
    // console.log(event.currentTarget);
    event.currentTarget.classList.toggle('isSelectEd');
    var xmlHttp = new XMLHttpRequest();
    var Filter_brandItems_Selected= document.querySelectorAll('#prod-dropdown-brand .prod-subnav-item.isSelectEd');
    var value_Filter_brandItems_Selected=[];
    Filter_brandItems_Selected.forEach(el=>{
      value_Filter_brandItems_Selected.push(el.getAttribute('data-id-brand-product'));
    })


    var Filter_categoryItems_Selected= document.querySelectorAll('#prod-dropdown-type .prod-subnav-item.isSelectEd')
    var value_Filter_categoryItems_Selected=[];
    Filter_categoryItems_Selected.forEach(el=>{
      value_Filter_categoryItems_Selected.push(el.getAttribute('data-id-category-product'));
    })
    
    xmlHttp.onreadystatechange=function()
    {
      if(this.readyState==4 && this.status==200)
      {
        console.log(this.responseText);
      }
    }
    xmlHttp.open('GET','/product/getProducts_withFilter?value_Filter_brandItems_Selected='+JSON.stringify(value_Filter_brandItems_Selected)+'&value_Filter_categoriesItems_Selected='+JSON.stringify(value_Filter_categoryItems_Selected));
    xmlHttp.send();
  }) 
})


// var Filter_categoryItems= document.querySelectorAll('#prod-dropdown-type .prod-subnav-item');
// Filter_categoryItems.forEach(el=>{
//   el.addEventListener('click',(e)=>{
//     e.currentTarget.classList.toggle('isSelectEd');
//     var xmlHttp = new XMLHttpRequest();
//     var Filter_categoryItems_Selected= document.querySelectorAll('#prod-dropdown-type .prod-subnav-item.isSelectEd')
//     var value_Filter_categoryItems_Selected=[];
//     Filter_categoryItems_Selected.forEach(el=>{
//       value_Filter_categoryItems_Selected.push(el.getAttribute('data-id-category-product'));
//     })
//     xmlHttp.onreadystatechange=function(){
//       if(this.readyState==4 && this.status==200){
//          console.log(this.responseText);

//       }
//     }
//     xmlHttp.open('GET','/product/getProducts_withFilter_categories?value_Filter_categoriesItems_Selected='+JSON.stringify(value_Filter_categoryItems_Selected));
//     xmlHttp.send();
//   })
// })


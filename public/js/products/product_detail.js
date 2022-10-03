// document.addEventListener("DOMContentLoaded",function(event)
// {
//     var btnReadMore__comments = document.querySelector('.btn-readMore__comments');
//     btnReadMore__comments.addEventListener('click',function(event)
//     {
//         var itemProduct__comment = document.createElement('div');
//         itemProduct__comment.className='item-product__comment';
//         itemProduct__comment.innerHTML=`
        
//                     <div class="header-product__comment">
//                         <div class="part-rate__star">
//                             <div class="list-star">
//                                 <div class="item-star"><i class="fa-solid fa-star"></i></div>
//                                 <div class="item-star"><i class="fa-solid fa-star"></i></div>
//                                 <div class="item-star"><i class="fa-solid fa-star"></i></div>
//                                 <div class="item-star"><i class="fa-solid fa-star"></i></div>
//                             </div></div>
//                         <div class="part-time__post">12/09/21</div>
//                     </div>
//                     <div class="info-commenter">
//                         <div class="avatar__commenter"><img src="http://127.0.0.1:8000/images/dnmn.jpg" alt=""></div>

//                         <div class="name__commenter">Đặng Ngọc Mạnh Nhật<div class="tag__verified">Verified</div>
//                     </div>
//                 </div>
//                     <div class="main__comment">

//                         <div class="title__comment">So beautifully!!!</div>
//                          <div class="part-image__comment">
//                             <div class="main-image__comment">

//                             </div>
//                             <div class="list_shortcut-image__comment">
//                                 <div class="item_shortcut__comment"></div>
//                                 <div class="item_shortcut__comment"></div>
//                             </div>
//                          </div>   
//                         <div class="text__comment">The product is top class! Excellent build quality and looks great too (deserves more than 5 stars for looks alone). Comfortable for long duration! Sound quality is great too. A satisfying experience and well worth the investment!

// Note: Waited for 3 weeks to receive it thanks to some delivery issues!!</div>
//                     <div class="part-rate_quality">
//                         <div class="list-rate_quality">
//                             <div class="item-rate_quality">
//                                 <div class="name-rate_quality">Quatity</div>
//                                 <div class="line-rate_quality"></div>
//                             </div>
//                             <div class="item-rate_quality">
//                                 <div class="name-rate_quality">Quatity</div>
//                                 <div class="line-rate_quality"></div>
//                             </div>
//                             <div class="item-rate_quality">
//                                 <div class="name-rate_quality">Quatity</div>
//                                 <div class="line-rate_quality"></div>
//                             </div>
//                         </div>
//                     </div>
//                     </div>
//                     <div class="footer-product__comment">
//                     <div class="btn-interact__comment btn-interact__comment__like">
//                         <i class="fa-solid fa-thumbs-up"></i>
//                     </div>
//                     <div class="btn-interact__comment btn-interact__comment__dislike">
//                         <i class="fa-regular fa-thumbs-down"></i>
//                     </div>
//                     </div>
//                     <div class="shop__replied">
//                         <div class="name-shop__replied">Life Sound</div>
//                         <div class="main-shop__replied">
//                             <div class="text-shop__replied">Thank you very much</div>
//                         </div>
//                     </div>
                
//         `
//     document.querySelector('.list-product__comment').appendChild(itemProduct__comment);
//     })
// })
import * as toolProduct from '../products/toolProduct.js';
toolProduct.loadEventItemProductShowDetail(
    document.querySelectorAll('.item_product')
    ,'click'
    ,document
    ,(data)=>{
        console.log(data);
        toolProduct.getDataDetail(data)
    }
)



// var product__detail =document.querySelector("#popup-product__detail");
// EventShowElDetail(".item_product","show","click",product__detail,document,false);









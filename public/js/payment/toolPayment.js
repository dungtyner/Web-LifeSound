saveInformation();
comfirmOrder();
import * as toolCart from '../cart/toolCart.js';    
// toolCart.getListProductCart((List)=>{
//     console.log((render_PaymentProduct));
//     for(var item of List)
//     {
//         render_PaymentProduct(item)
//     }
   
// })
// function render_PaymentProduct(dataItem)
// {
//     var elProduct = document.createElement('div');
//     elProduct.className="row justify-content-between";
//     elProduct.innerHTML=
//     `
//         <div class="col-auto col-md-7">
//             <div class="media flex-column flex-sm-row">
//                 <img class=" img-fluid" src="${dataItem.img.url_img_product}" width="62" height="62">
//                 <div class="media-body  my-auto">
//                     <div class="row ">
//                         <div class="col-auto"><p class="mb-0"><b>${dataItem.name_product}</b></p><small class="text-muted">1 Week Subscription</small></div>
//                     </div>
//                 </div>
//             </div>
//         </div>
//         <div class=" pl-0 flex-sm-col col-auto  my-auto"> <p class="boxed-1">${dataItem.dataOrdered.quantityOrder}</p></div>
//         <div class=" pl-0 flex-sm-col col-auto  my-auto "><p><b>${((dataItem.dataOrdered.quantityOrder)*(dataItem.price.root_price_product)).toFixed(2)}</b></p></div>
//         <hr class="my-2">

//     `
//     document.querySelector('.borderList-PaymentProduct').appendChild(elProduct);

// }

// function died...
function updateProductCart(){
    // let's start Ajax
    let xhr = new XMLHttpRequest(); // creating XML object 
    xhr.open("GET", "/payment/getDataForPayment", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let result = JSON.parse(xhr.response);
                if(result.status==0)
                {
                    let borderListPaymentProduct = document.querySelector('content');
                    borderListPaymentProduct.innerHTML = `
                        <style>
                            #pleaseLogin{
                                background: white;
                                height: 100%;
                                width: 100%;
                                border: 1px solid black;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                            }
                            .pleaseLogin-text {
                                font-size: 30px;
                                font-family: monospace;
                                height: max-content;
                            }
                        </style>
                        <div id="pleaseLogin">
                            <b class="pleaseLogin-text">${result.mess}</b>
                        </div>
                    `
                }
            }
        }
    }
    xhr.send();
}
///
function saveInformation() {

    // console.log("hahahah ngu");

    let btnSaveInformation = document.getElementById('btnSaveInformation');
    btnSaveInformation.addEventListener("click", function() {

        let nameFromYourLocal = document.getElementById('nameFromYourLocal').value;
        let localFromYourLocal = document.getElementById('localFromYourLocal').value;
        let emailFromYourLocal = document.getElementById('emailFromYourLocal').value;
        let phoneFromYourLocal = document.getElementById('phoneFromYourLocal').value;
    

        

        var form = new FormData();
        form.append('newInfo', JSON.stringify({
            nameFromYourLocal,
            localFromYourLocal,
            emailFromYourLocal,
            phoneFromYourLocal
        }));
        // let's start Ajax
        let xhr = new XMLHttpRequest(); // creating XML object 
        xhr.open("POST", "/payment/saveInformation", true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    
                    console.log(xhr.responseText);
                }
            }
        }
        xhr.setRequestHeader('X-CSRF-TOKEN',document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

        xhr.send(form);
    });
}

function comfirmOrder() {
    let btnBtnBlockBtnOutlinePrimaryBtnLg = document.getElementById('btnBtnBlockBtnOutlinePrimaryBtnLg');
    btnBtnBlockBtnOutlinePrimaryBtnLg.addEventListener("click", function() {
        
       
        // let's start Ajax
        let xhr = new XMLHttpRequest(); // creating XML object 
        xhr.open("GET", "/payment/comfirmOrder", true);
        xhr.onload = () => {
            if(xhr.readyState === XMLHttpRequest.DONE) {
                if(xhr.status === 200) {
                    
                    console.log(xhr.responseText);
                }
            }
        }
        // xhr.setRequestHeader('X-CSRF-TOKEN',document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xhr.send();
        



    });
}
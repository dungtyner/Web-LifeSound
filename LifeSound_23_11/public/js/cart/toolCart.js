import * as toolCommon from "../toolCommon/toolCommon.js";
import * as toolProduct from '../products/toolProduct.js';
getCountProductsCart((num) => {
    var header__cart__counts = document.querySelectorAll(
        ".header__cart__count"
    );
    for (var header__cart__count of header__cart__counts) {
        header__cart__count.textContent = num;
    }
});
function getCountProductsCart(methodWork) {
    $.ajax({
        type: "GET",
        url: "/cart/getCountProductsCart",
        typeData: "json",
        success: function (data) {
            // console.log(data);
            methodWork(data.result);
        },
    });
}
function insertCartPopup(data_CartPopup) {
    var cartPopup = document.createElement("div");
    cartPopup.classList.add("cart-content-data");
    cartPopup.innerHTML = `
            <div class="header-cart-content-data">
                <div class="left-item-cart-content">
                    <p class="header__cart__count cart">${
                        data_CartPopup.length
                    }</p>
                    <i class="fa-solid fa-bag-shopping"></i>
                    <p>ITEMS</p>
                </div>
                <div class="close-content-data">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>

            <div class="product-cart-content-data">
            ${data_CartPopup
                .map((el, idx) => {
                    return `
                <div data-id_product="${el[0].id_product}" class="sub-cart-product-display">
                    <div class="image-sub-cart-product">
                        <img src="${
                            el.list.img_product[0].url_img_product
                        }" alt="">
                    </div>
                    <div class="title-sub-cart-product">
                        <h2>${el[0].name_product}</h2>
                        <div class="part-optColorOrder__product_cart">
                                <div class="list-optColorOrder__product_cart">
                                    ${el.list.color_product
                                        .map((el_opt, idx) => {
                                            console.log(el_opt.id_color_product,el.dataOrdered.id_optColor);
                                            if (
                                                el_opt.id_color_product + "" ==
                                                el.dataOrdered.id_optColor
                                            ) {
                                                return `
                                                <div data-id_optColor='${el_opt.id_color_product}' class="item-optColorOrder__product_cart active">
                                                <div class="value-optColorOrder__product_cart">
                                                ${el_opt.value_color_product}
                                                </div>
                                                </div>
                                                `;
                                            } 
                                            // else {
                                            //     return `
                                            //     <div data-id_optColor='${el_opt.id_color_product}' class="item-optColorOrder__product_cart">
                                            //     <div class="value-optColorOrder__product_cart">
                                            //     ${el_opt.value_color_product}
                                            //     </div>
                                            //     </div>
                                            //     `;
                                            // }
                                        })
                                        .join("")}
                                    </div>
                            </div>
                    <div class="part-optPlugOrder__product_cart">
                                <div class="list-optPlugOrder__product_cart">
                                        ${el.list.plug_product
                                            .map((el_opt, idx) => {
                                                if (
                                                    el_opt.id_plug_product +
                                                        "" ==
                                                    el.dataOrdered.id_optPlug
                                                ) {
                                                    return `
                                                <div data-id_optPlug='${el_opt.id_plug_product}' class="item-optPlugOrder__product_cart active">
                                                <div class="value-optPlugOrder__product_cart">
                                                    ${el_opt.value_plug_product}
                                                </div>
                                            </div>
                                                `;
                                                } 
                                        //         else {
                                        //             return `
                                        //     <div data-id_optPlug='${el_opt.id_plug_product}' class="item-optPlugOrder__product_cart">
                                        //     <div class="value-optPlugOrder__product_cart">
                                        //         ${el_opt.value_plug_product}
                                        //     </div>
                                        // </div>
                                        //     `;
                                        //         }
                                            }
                                            )
                                            .join("")}
                                    </div>
                            </div>
                            <div class='btn-editOptProductCart'><i class="fa-solid fa-pen-to-square"></i></div>
                        <div class="plus-minus-sub-cart-product part-quantityOrder__product_cart">
                            <div class="one-three-plus-minus-num btn_decrease-quantityOrder__product_cart">
                                <i class="fa-solid fa-minus"></i>
                            </div>
                            <div class="one-three-plus-minus-num ipt-quantityOrder__product_cart">
                                <input type="number" min='1' max='${
                                    el[0].dataQuantity.quantity_product_has
                                }' value='${
                        el.dataOrdered.quantityOrder
                    }' class='value-quantityOrder__product_cart'/>/
                                <div class="value-quantityProduct">${
                                    el[0].dataQuantity.quantity_product_has
                                }</div>
                            </div>
                            <div class="one-three-plus-minus-num btn_increase-quantityOrder__product_cart">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            
                            
                            
                            
                        </div>
                        
                    </div>
                    
                    <div class="price-remove-sub-cart-product">
                    <div class="btn-remove-sub-cart-product">
                    <i class="fa-solid fa-trash"></i>
                        </div>
                        <div data-salesingleprice-productdetail='${(
                            (1 - el[0].dataPrice.rate_sale_default_product) *
                            el[0].dataPrice.root_price_product *
                            el.dataOrdered.quantityOrder
                        ).toFixed(2)}'class="value-price-sub-cart-product">
                        <h3 class='text-price-sub-cart-product'>${(
                            (1 - el[0].dataPrice.rate_sale_default_product) *
                            el[0].dataPrice.root_price_product *
                            el.dataOrdered.quantityOrder
                        ).toFixed(2)}</h3><span class='unit-price-sub-cart-product'>$</span>
                        </div>

                    </div>
                </div>
                `;
                })
                .join("")}
                

                
            </div>
            
            <div class="footer-cart-content-data">
            <div class='btn-checkOut__product_cart'>
                    Check out <span class='value-pay__product_cart'>123456</span> 
                    <span class="unit-pay__product_cart">$</span>
            </div>
            </div>
    `;

    var sub_carts = cartPopup.querySelectorAll(".sub-cart-product-display");
    for (var sub_cart of sub_carts) {
        sub_cart.querySelector('.btn-editOptProductCart').addEventListener('click'
            ,function(event)
            {
                var sub_cart_parent = event.currentTarget.closest('.sub-cart-product-display');
                getOptProductCart(sub_cart_parent,
                    {
                        id_optColor: 
                toolCommon.getAttributeWithElement(

                    sub_cart_parent
                    .querySelector(
                        ".item-optColorOrder__product_cart.active"
                        )
                        ,("data-id_optColor"),0
                        ),
                id_optPlug: toolCommon.getAttributeWithElement(

                    sub_cart_parent
                    .querySelector(
                        ".item-optPlugOrder__product_cart.active"
                        )
                        ,("data-id_optPlug"),0
                        ) ,
                        quantityOrder: sub_cart_parent.querySelector('input.value-quantityOrder__product_cart').value,
                        quantityProduct: sub_cart_parent.querySelector('.value-quantityProduct').textContent
                    },(result,obj_opt)=>{
                        result = {...result,dataOrdered:obj_opt}
                        insertPopUpUpdateOptProductCart(sub_cart_parent,result)
                    })
                // insertPopUpUpdateOptProductCart(sub_cart_parent,null);
            })
        sub_cart.querySelector('.title-sub-cart-product h2').addEventListener('click',function(event)
        {

            var sub_cart_parent = event.currentTarget.closest('.sub-cart-product-display');
            sub_cart_parent.closest('.cart-content-data').remove();
            toolProduct.getDataDetail(sub_cart_parent.getAttribute('data-id_product'),
            {
                id_optColor: 
                toolCommon.getAttributeWithElement(

                    sub_cart_parent
                    .querySelector(
                        ".item-optColorOrder__product_cart.active"
                        )
                        ,("data-id_optColor"),0
                        ),
                id_optPlug: toolCommon.getAttributeWithElement(

                    sub_cart_parent
                    .querySelector(
                        ".item-optPlugOrder__product_cart.active"
                        )
                        ,("data-id_optPlug"),0
                        ) 
            });
        });
        
        sub_cart.querySelector('.btn-remove-sub-cart-product').addEventListener('click',function(event)
        {
            var sub_cart_parent = event.currentTarget.closest('.sub-cart-product-display');
            if(confirm('Are you sure???'))
            {

                request_deleteProductCart( {
                    id_product: sub_cart_parent.getAttribute('data-id_product')
                    ,id_optColor: 
                    toolCommon.getAttributeWithElement(
    
                        sub_cart_parent
                        .querySelector(
                            ".item-optColorOrder__product_cart.active"
                            )
                            ,("data-id_optColor"),0
                            ),
                    id_optPlug: toolCommon.getAttributeWithElement(
    
                        sub_cart_parent
                        .querySelector(
                            ".item-optPlugOrder__product_cart.active"
                            )
                            ,("data-id_optPlug"),0
                            ) 
                })
                getCountProductsCart((num) => {
                    var header__cart__counts = document.querySelectorAll(
                        ".header__cart__count"
                        );
                        for (var header__cart__count of header__cart__counts) {
                            header__cart__count.textContent = num;
                        }
                    });
                    var cartPopup = sub_cart_parent.closest('.cart-content-data')
                    sub_cart_parent.remove();
                    load_value_priceSumCart(cartPopup);
                    
            }
        })
        toolCommon.setActiveInList(
            ".item-optColorOrder__product_cart",
            "active",
            sub_cart,
            "click",
            (dataOpt,eventCurrentTarget) => {
                var sub_cart = eventCurrentTarget.closest('.sub-cart-product-display')
                loadSubCartWithOpt(sub_cart)
            }
        );
        toolCommon.setActiveInList(
            ".item-optPlugOrder__product_cart",
            "active",
            sub_cart,
            "click",
            (dataOpt,eventCurrentTarget) => {
                var sub_cart = eventCurrentTarget.closest('.sub-cart-product-display')
                loadSubCartWithOpt(sub_cart)
            }
            
            
        );

        toolCommon.setNumOrderProduct(
            sub_cart.querySelector(".btn_increase-quantityOrder__product_cart"),
            sub_cart.querySelector(".btn_decrease-quantityOrder__product_cart"),
            sub_cart.querySelector("input.value-quantityOrder__product_cart"),
            (el_valueOrder) => {
                var sub_cart = el_valueOrder
                    .closest(".sub-cart-product-display")
                load_value_priceSubCart(el_valueOrder,sub_cart,cartPopup);
                    
            }
        );
    }
    load_value_priceSumCart(cartPopup);
    cartPopup.style.display = "flex";
    closeCartForm(cartPopup);

    document.body.appendChild(cartPopup);
}
function request_deleteProductCart(obj_cartProduct,methodWork)
{
    
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            var result = Object.values(JSON.parse(this.responseText))[0];
            if(methodWork)
            {
                methodWork(result);
            }
        }
    };
    xmlHttp.open("GET", "/cart/deleteProductCart?&obj_cartProduct="+JSON.stringify(obj_cartProduct), true);
    xmlHttp.setRequestHeader(
        "X-CSRF-TOKEN",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    );
    xmlHttp.send();
}
function getOptProductCart(el_Parent,obj_opt,methodWork)
{
    var id_product = el_Parent.getAttribute('data-id_product')
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            var result = Object.values(JSON.parse(this.responseText));
            if(methodWork)
            {
                methodWork(result[0],obj_opt)
            }
        }
    };
    xmlHttp.open("GET", "/cart/getOptProductCart?id="+id_product+"&obj_opt="+JSON.stringify(obj_opt), true);
    xmlHttp.setRequestHeader(
        "X-CSRF-TOKEN",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    );
    xmlHttp.send();
}
function requestSaveCart(obj_opt,methodWork) {
    var form = new FormData();
    form.append("obj_OptUpdateProductCart", JSON.stringify(obj_opt));
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            if(methodWork)
            {
                methodWork()
            }
        }
    };
    xmlHttp.open("POST", "/cart/SaveProductCart", true);
    xmlHttp.setRequestHeader(
        "X-CSRF-TOKEN",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    );
    xmlHttp.send(form);
}
function insertPopUpUpdateOptProductCart(elParent,data)
{
    console.log(data)
    var PopUpUpdateOptProductCart = document.createElement('div');
    PopUpUpdateOptProductCart.className='container-popupUpdateOptProductCart'
    PopUpUpdateOptProductCart.setAttribute('data-id_product',data[0].id_product)
    PopUpUpdateOptProductCart.innerHTML=
    `
        <div class='main-popupUpdateOptProductCart' >
            <div class='list-Opt_popupUpdateProductCart'>
                <div class='item-Opt_popupUpdateProductCart'>
                    <div class='title-Opt_popupUpdateProductCart' >Color</div>   
                    <div class='listBtn-Opt_popupUpdateProductCart'>
                    ${data.list.color_product.map(el=>{
                        if(el.id_color_product+''===data.dataOrdered.id_optColor+'')
                        {
                            return(
                            `<div class='itemBtn-Opt_popupUpdateProductCart itemBtn-OptColor_popupUpdateProductCart active' 
                            data-opt-product-detail='${el.value_color_product}'
                            data-id_optColor='${el.id_color_product}'> 
                                <div class='value-Opt_popupUpdateProductCart'>
                                    ${el.value_color_product}
                                </div> 
                            </div>`)
                        }
                        return (
                            `
                            <div class='itemBtn-Opt_popupUpdateProductCart itemBtn-OptColor_popupUpdateProductCart' 
                            data-opt-product-detail='${el.value_color_product}'
                            data-id_optColor='${el.id_color_product}'>
                                <div class='value-Opt_popupUpdateProductCart'>
                                    ${el.value_color_product}
                                </div> 
                            </div>
                        `
                        )
                    }).join('')}

                    </div>
                </div>
                ${
                    (data.list.plug_product.length>0)?`
                    <div class='item-Opt_popupUpdateProductCart'>
                    <div class='title-Opt_popupUpdateProductCart' >Plug</div>   
                    <div class='listBtn-Opt_popupUpdateProductCart'>
                    ${data.list.plug_product.map(el=>{
                        if(el.id_plug_product+''===data.dataOrdered.id_optPlug+'')
                        {
                            return(
                            `<div class='itemBtn-Opt_popupUpdateProductCart itemBtn-OptPlug_popupUpdateProductCart active' 
                            data-opt-product-detail='${el.value_plug_product}'
                            data-id_optPlug='${el.id_plug_product}'
                            > 
                                <div class='value-Opt_popupUpdateProductCart' >
                                    ${el.value_plug_product}
                                </div> 
                            </div>`)
                        }
                        return (
                            `
                            <div class='itemBtn-Opt_popupUpdateProductCart itemBtn-OptPlug_popupUpdateProductCart' 
                            data-opt-product-detail='${el.value_plug_product}'
                            data-id_optPlug='${el.id_plug_product}'>
                                <div class='value-Opt_popupUpdateProductCart'>
                                    ${el.value_plug_product}
                                </div> 
                            </div>
                        `
                        )
                    }).join('')}

                    </div>
                </div>
                    `:''
                }
                
            </div>
            <div class='part-setQuantityOrderProductCart'>
                <div class='container-setQuantityOrderProductCart'>
                    <div class='btnDecrease-setQuantityOrderProductCart'>
                        <i class="fa-solid fa-window-minimize"></i>
                    </div>
                    <div class='sectionValue-setQuantityOrderProductCart'>
                        <input type='number' min=1 value=${data.dataOrdered.quantityOrder} max=${data.dataOrdered.quantityProduct} class='ipt-setQuantityOrderProductCart'/>
                        <div class='limQuantity-setQuantityOrderProductCart'>
                                /<span class='limValueQuantity-setQuantityOrderProductCart'>${data.dataOrdered.quantityProduct}</span>
                        </div>                                                                             
                    </div>
                    <div class='btnIncrease-setQuantityOrderProductCart'>
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
            </div>
            <div class='part-showPriceOrderProductCart'>
                <div class='container-showPriceOrderProductCart'>
                    <div class='value-showPriceOrderProductCart'>
                            15
                    </div>
                    <span class='unitValue-showPriceOrderProductCart'>
                            $
                    </span>
                </div>
            </div>
            <div class='part-optWithPopupUpdateOptProductCart'>
                <div class='list-optWithPopupUpdateOptProductCart'>
                    <div class='item-optWithPopupUpdateOptProductCart itemCancel-optWithPopupUpdateOptProductCart'>
                        <div class='btn-optWithPopupUpdateOptProductCart btnCancel-optWithPopupUpdateOptProductCart'>
                            Cancel
                        </div> 
                    </div>    
                    <div class='item-optWithPopupUpdateOptProductCart itemSave-optWithPopupUpdateOptProductCart'>
                        <div class='btn-optWithPopupUpdateOptProductCart btnSave-optWithPopupUpdateOptProductCart'>
                            Save 
                        </div>
                    </div>                            
                </div>
            </div>
        </div>
    `
    PopUpUpdateOptProductCart.querySelector('.btn-optWithPopupUpdateOptProductCart.btnCancel-optWithPopupUpdateOptProductCart').addEventListener('click',function(event)
    {
        var elParentContainerPopUp = event.currentTarget.closest('.container-popupUpdateOptProductCart')
        elParentContainerPopUp.remove();
    }

    )
    toolCommon.setNumOrderProduct(
        PopUpUpdateOptProductCart.querySelector(".btnIncrease-setQuantityOrderProductCart"),
        PopUpUpdateOptProductCart.querySelector(".btnDecrease-setQuantityOrderProductCart"),
        PopUpUpdateOptProductCart.querySelector("input.ipt-setQuantityOrderProductCart"),
        (el_valueOrder) => {
            var PopUpUpdateOptProductCart = el_valueOrder
                .closest(".container-popupUpdateOptProductCart")
                // console.log((PopUpUpdateOptProductCart));
                load_valuePricePopUpUpdateOptProductCart(PopUpUpdateOptProductCart)
                
        }
    );
    PopUpUpdateOptProductCart.querySelector('.btn-optWithPopupUpdateOptProductCart.btnSave-optWithPopupUpdateOptProductCart').addEventListener('click',function(event)
    {
        var elParentContainerPopUp = event.currentTarget.closest('.container-popupUpdateOptProductCart')
        requestSaveCart({
            id_product:data[0].id_product,
            newOpt:{
                id_optColor: toolCommon.getAttributeWithElement(

                    elParentContainerPopUp
                    .querySelector(
                        ".itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart.active"
                        )
                        ,("data-id_optColor"),0
                        ) ,
                id_optPlug: toolCommon.getAttributeWithElement(
                    elParentContainerPopUp
                    .querySelector(
                        ".itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart.active"
                        )
                        ,("data-id_optPlug"),0
                        ),
                quantityOrder: elParentContainerPopUp.querySelector('.ipt-setQuantityOrderProductCart').value
            },
            oldOpt:data.dataOrdered
        },)
        elParentContainerPopUp.remove();
    })
    toolCommon.setActiveInList(
        '.itemBtn-OptPlug_popupUpdateProductCart'
        ,'active'
        ,PopUpUpdateOptProductCart
        ,'click'
        ,()=>
        {
            loadPopUpUpdateOptProductCart(PopUpUpdateOptProductCart,data)
        }
    );
    toolCommon.setActiveInList(
        '.itemBtn-OptColor_popupUpdateProductCart'
        ,'active'
        ,PopUpUpdateOptProductCart
        ,'click'
        ,()=>
        {
            loadPopUpUpdateOptProductCart(PopUpUpdateOptProductCart,data)
        }
    )
    PopUpUpdateOptProductCart.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart.active').click();
    document.body.appendChild(PopUpUpdateOptProductCart);
}
function load_valuePricePopUpUpdateOptProductCart(PopUpUpdateOptProductCart)
{
    var value_price_sub_cart_product =PopUpUpdateOptProductCart.querySelector('.value-showPriceOrderProductCart');
                value_price_sub_cart_product.textContent=
                    (value_price_sub_cart_product.getAttribute('data-salesingleprice-productdetail')
                        *parseInt(PopUpUpdateOptProductCart.querySelector('input.ipt-setQuantityOrderProductCart').value)).toFixed(2);
}
function loadPopUpUpdateOptProductCart(el_popup,oldData)
{
    // console.log(el_popup);
    toolProduct.getQuantityProductWithOptChar(
        el_popup.getAttribute('data-id_product')
        ,{
            id_optColor: toolCommon.getAttributeWithElement(

                el_popup
                .querySelector(
                    ".itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart.active"
                    )
                    ,("data-id_optColor"),0
                    ) ,
            id_optPlug: toolCommon.getAttributeWithElement(
                el_popup
                .querySelector(
                    ".itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart.active"
                    )
                    ,("data-id_optPlug"),0
                    ),
        }
        ,(result)=>
        {
            console.log(result);
            el_popup.querySelector('.limValueQuantity-setQuantityOrderProductCart').textContent=(typeof result.quantity_product_has ==='undefined')?-1:result.quantity_product_has;
        }
    )
    
    toolProduct.getPrice_Sale_ProductWithOptChar(
        el_popup.getAttribute('data-id_product')
        ,{
            id_optColor: toolCommon.getAttributeWithElement(

                el_popup
                .querySelector(
                    ".itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart.active"
                    )
                    ,("data-id_optColor"),0
                    ) ,
            id_optPlug: toolCommon.getAttributeWithElement(
                el_popup
                .querySelector(
                    ".itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart.active"
                    )
                    ,("data-id_optPlug"),0
                    ),
        },(Obj_price)=>{
            console.log(Obj_price)
            if(Obj_price)
            {
                var value_price_sale=(
                    Obj_price.root_price_product *
                    (1 -Obj_price.rate_sale_default_product)
                ).toFixed(2)
                var value_price_sub_cart_product =el_popup.querySelector('.value-showPriceOrderProductCart');
                value_price_sub_cart_product.setAttribute('data-salesingleprice-productdetail',value_price_sale)
                value_price_sub_cart_product.textContent=value_price_sale*parseInt(el_popup.querySelector('input.ipt-setQuantityOrderProductCart').value);

            }
            else
            {
                el_popup.querySelector('.value-showPriceOrderProductCart').textContent='No'

            }
        }
    )
    getListProductExistCart(
        el_popup.getAttribute('data-id_product')
        ,{
            id_optColor: toolCommon.getAttributeWithElement(

                el_popup
                .querySelector(
                    ".itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart.active"
                    )
                    ,("data-id_optColor"),0
                    ) ,
            id_optPlug: toolCommon.getAttributeWithElement(
                el_popup
                .querySelector(
                    ".itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart.active"
                    )
                    ,("data-id_optPlug"),0
                    ),
        },(data)=>
        {
            var OptColor_popupUpdateProductCart = el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart.noChoose')
            if(OptColor_popupUpdateProductCart)
            OptColor_popupUpdateProductCart.classList.remove('noChoose');
            var OptPlug_popupUpdateProductCart = el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart.noChoose')
            if(OptPlug_popupUpdateProductCart)
            OptPlug_popupUpdateProductCart.classList.remove('noChoose');
            // console.log(oldData);
                if(data[0].length>0)
                {
                    for(var item of data[0].id_optColor)
                {   
                    // if() 
                    // el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart[data-id_optPlug=\"'+item.id_optPlug+'\"]').classList.add('noChoose');
                    el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart[data-id_optColor=\"'+item.id_optColor+'\"]').classList.add('noChoose');
                }
                for(var item of data[0].id_optPlug)
                {   
                    // if() 
                    el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart[data-id_optPlug=\"'+item.id_optPlug+'\"]').classList.add('noChoose');
                    // el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart[data-id_optColor=\"'+item.id_optColor+'\"]').classList.add('noChoose');
                }
                }

                if(el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart[data-id_optPlug=\"'+oldData.dataOrdered.id_optPlug+'\"]'))
                el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart[data-id_optPlug=\"'+oldData.dataOrdered.id_optPlug+'\"]').classList.remove('noChoose');
                if(el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart[data-id_optColor=\"'+oldData.dataOrdered.id_optColor+'\"]'))
                el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart[data-id_optColor=\"'+oldData.dataOrdered.id_optColor+'\"]').classList.remove('noChoose');
                if(el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart.active'))
                el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptColor_popupUpdateProductCart.active').classList.remove('noChoose');
                if(el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart.active'))
                el_popup.querySelector('.itemBtn-Opt_popupUpdateProductCart.itemBtn-OptPlug_popupUpdateProductCart.active').classList.remove('noChoose');

            
            
        })
}
function loadSubCartWithOpt(sub_cart)
{
    toolProduct.getQuantityProductWithOptChar(
        sub_cart.getAttribute('data-id_product')
        ,{
            id_optColor: sub_cart
                .querySelector(
                    ".item-optColorOrder__product_cart.active"
                )
                .getAttribute("data-id_optColor"),
            id_optPlug: sub_cart
                .querySelector(
                    ".item-optPlugOrder__product_cart.active"
                )
                .getAttribute("data-id_optPlug"),
        }
        ,(result)=>
        {
            console.log(result);
            
            loadSubCartWithQuantityProduct((typeof result.quantity_product_has ==='undefined')?-1:result.quantity_product_has,sub_cart);
        }
    )
    toolProduct.getPrice_Sale_ProductWithOptChar(
        sub_cart.getAttribute('data-id_product'),
        {
            id_optColor: sub_cart
                .querySelector(
                    ".item-optColorOrder__product_cart.active"
                )
                .getAttribute("data-id_optColor"),
            id_optPlug: sub_cart
                .querySelector(
                    ".item-optPlugOrder__product_cart.active"
                )
                .getAttribute("data-id_optPlug"),
        },(Obj_price)=>{
            loadSubCartWithPriceProduct(Obj_price,sub_cart)
        }
    )
}
function load_value_priceSubCart(el_valueOrder,el_subCart,elCartPopUp)
{
    var salePriceInfo__sub_cart=el_subCart.querySelector(
        ".cart-content-data .product-cart-content-data .sub-cart-product-display .price-remove-sub-cart-product .value-price-sub-cart-product"
    );
    var value_Price = (
        parseFloat(
            salePriceInfo__sub_cart.getAttribute(
                "data-salesingleprice-productdetail"
            )
        ) * parseInt(el_valueOrder.value)
    ).toFixed(2);
salePriceInfo__sub_cart.querySelector('h3').textContent = value_Price
load_value_priceSumCart(elCartPopUp);
}
function loadSubCartWithPriceProduct(Obj_price,el_subCart)
{
if(Obj_price)
{
    var value_price_sale=(
        Obj_price.root_price_product *
        (1 -Obj_price.rate_sale_default_product)
    ).toFixed(2)
    var value_price_sub_cart_product =el_subCart.querySelector('.value-price-sub-cart-product');
    value_price_sub_cart_product.setAttribute('data-salesingleprice-productdetail',value_price_sale)
    load_value_priceSubCart(el_subCart.querySelector('.value-quantityOrder__product_cart')
        ,el_subCart,el_subCart.closest('.cart-content-data'));
}
    else
    {
        el_subCart.querySelector('.text-price-sub-cart-product').textContent='No'
        load_value_priceSumCart(el_subCart.closest('.cart-content-data'));
    }
}

function loadSubCartWithQuantityProduct(valueQuantity,el_subCart)
{
    if(valueQuantity>0)
    {
        // el_subCart.querySelector('.part-quantityOrder__product_cart').style.display='flex';
        el_subCart.querySelector('.value-quantityProduct').textContent=''+valueQuantity;
        el_subCart.querySelector('input.value-quantityOrder__product_cart').max=valueQuantity
    }
    else if(valueQuantity==0)
    {
        el_subCart.querySelector('.part-quantityOrder__product_cart').style.display='none';
    }
    else
    {
        el_subCart.querySelector('.part-quantityOrder__product_cart').style.display='none';
    }
}
openCartForm((dataListProductCart) => {
    document.querySelector('.search-content-data').style.display='none';
    insertCartPopup(dataListProductCart);
});
function load_value_priceSumCart(cartPopup)
{
    var value_priceSubCartProducts = cartPopup.querySelectorAll(
        ".value-price-sub-cart-product h3"
    );
    var Sum_value_priceSubCartProducts = 0;
    for (var value_priceSubCartProduct of value_priceSubCartProducts) {
        if(!isNaN(parseFloat(
            value_priceSubCartProduct.textContent
        )))
        Sum_value_priceSubCartProducts += parseFloat(
            value_priceSubCartProduct.textContent
        );
        else
        {
            Sum_value_priceSubCartProducts += 0;
        }
    }
    cartPopup.querySelector(
        ".btn-checkOut__product_cart .value-pay__product_cart"
    ).textContent = Sum_value_priceSubCartProducts.toFixed(2);
}
function openCartForm(methodWork) {
    let openCartForm = document.querySelectorAll(".click-form-cart");
    openCartForm.forEach((el) => {
        el.addEventListener("click", function (event) {
            $.ajax({
                url: "/cart/getListProductCart",
                type: "GET",
                typeData: "json",
                success: function (data) {
                    console.log(data);
                    if (methodWork) {
                        methodWork(data.result);
                    }
                },
            });
        });
    });
}
function closeCartForm(cartPopup) {
    let closeCartForm = cartPopup.querySelector(".header-cart-content-data");
    closeCartForm.addEventListener("click", function () {
        cartPopup.remove();
    });
}
function getListProductExistCart(id_product,obj_opt,methodWork)
{
    $.ajax({
        url:
            "/product/getListProductExistCart?id=" +
            id_product +
            "&obj_opt=" +
            JSON.stringify(obj_opt),
        type: "GET",
        typeData: "json",
        success: function (data) {
            console.log(data);
            if (data.length != 0) {
                if (methodWork) {
                    methodWork(Object.values(data));
                }
            } else {
                if (methodWork) {
                    methodWork(-1);
                }
            }
        },
    });
}
export { insertCartPopup,getCountProductsCart};

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
            console.log(data);
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
                                            if (
                                                el_opt.id_color_product + "" ===
                                                el.dataOrdered.id_optColor
                                            ) {
                                                return `
                                                <div data-id_optColor='${el_opt.id_color_product}' class="item-optColorOrder__product_cart active">
                                                <div class="value-optColorOrder__product_cart">
                                                ${el_opt.value_color_product}
                                                </div>
                                                </div>
                                                `;
                                            } else {
                                                return `
                                                <div data-id_optColor='${el_opt.id_color_product}' class="item-optColorOrder__product_cart">
                                                <div class="value-optColorOrder__product_cart">
                                                ${el_opt.value_color_product}
                                                </div>
                                                </div>
                                                `;
                                            }
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
                                                        "" ===
                                                    el.dataOrdered.id_optPlug
                                                ) {
                                                    return `
                                                <div data-id_optPlug='${el_opt.id_plug_product}' class="item-optPlugOrder__product_cart active">
                                                <div class="value-optPlugOrder__product_cart">
                                                    ${el_opt.value_plug_product}
                                                </div>
                                            </div>
                                                `;
                                                } else {
                                                    return `
                                            <div data-id_optPlug='${el_opt.id_plug_product}' class="item-optPlugOrder__product_cart">
                                            <div class="value-optPlugOrder__product_cart">
                                                ${el_opt.value_plug_product}
                                            </div>
                                        </div>
                                            `;
                                                }
                                            })
                                            .join("")}
                                    </div>
                            </div>
                        <div class="plus-minus-sub-cart-product part-quantityOrder__product_cart">
                            <div class="one-three-plus-minus-num btn_decrease-quantityOrder__product_cart">
                                <i class="fa-solid fa-minus"></i>
                            </div>
                            <div class="one-three-plus-minus-num ipt-quantityOrder__product_cart">
                                <input type="number" min='1' max='${
                                    el[0].dataQuantity.quantity_product_has
                                }' value='${
                        el.dataOrdered.quantityOrder
                    }' class='value-quantityOrder__product_cart'/>
                                <div class="value-quantityProduct">/${
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
        sub_cart.querySelector('.title-sub-cart-product h2').addEventListener('click',function(event)
        {
            var sub_cart_parent = event.currentTarget.closest('.sub-cart-product-display');
            toolProduct.getDataDetail(sub_cart_parent.getAttribute('data-id_product'));
        });
        
        sub_cart.querySelector('.btn-remove-sub-cart-product').addEventListener('click',function(event)
        {
            var sub_cart_parent = event.currentTarget.closest('.sub-cart-product-display');
            sub_cart_parent.remove();
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
        ,(valueQuantity)=>
        {
            loadSubCartWithQuantityProduct(valueQuantity,sub_cart);
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

    }
}

function loadSubCartWithQuantityProduct(valueQuantity,el_subCart)
{
    el_subCart.querySelector('.value-quantityProduct').textContent='/'+valueQuantity;
    el_subCart.querySelector('input.value-quantityOrder__product_cart').max=valueQuantity
}
openCartForm((dataListProductCart) => {
    insertCartPopup(dataListProductCart);
});
function load_value_priceSumCart(cartPopup)
{
    var value_priceSubCartProducts = cartPopup.querySelectorAll(
        ".value-price-sub-cart-product h3"
    );
    var Sum_value_priceSubCartProducts = 0;
    for (var value_priceSubCartProduct of value_priceSubCartProducts) {
        Sum_value_priceSubCartProducts += parseFloat(
            value_priceSubCartProduct.textContent
        );
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
export { insertCartPopup };

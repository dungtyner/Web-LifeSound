import * as toolCommon from "../toolCommon/toolCommon.js";
import * as toolCart from "../cart/toolCart.js";

function loadEventItemProductShowDetail(
    elItemProducts,
    typeEvent,
    elParent,
    methodWork
) {
    for (var i = 0; i < elItemProducts.length; i++) {
        document.addEventListener;
        elItemProducts[i].addEventListener(typeEvent, function (event) {
            methodWork(event.currentTarget.getAttribute("data-id_product"));
        });
    }
}
function getDataDetail(data, obj_cartProduct) {
    console.log(data);
    $.ajax({
        type: "GET",
        url: "/product/getDetail?id=" + data,
        // typeData:'json',
        success: function (data) {
            console.log(data);
            renderProductDetail(data, obj_cartProduct);
        },
    });
}
function renderProductDetail(data_productDetail, obj_cartProduct) {
    console.log(obj_cartProduct);
    if(document.querySelector('#popup-product__detail'))
    {
        document.querySelector('#popup-product__detail').remove();
    }
    var popup_product__detail = document.createElement("div");
    popup_product__detail.id = "popup-product__detail";
    popup_product__detail.setAttribute(
        "data-id-product",
        data_productDetail[0].id_product
    );
    popup_product__detail.innerHTML = `
        <div class="container__product_detail">
                <div class="header-product__detail"><div class="btnCLose__product_detail"><i class="fa-solid fa-circle-xmark"></i></div></div>
                <div class="main-product__detail">
                    <div class="partSide-product__detail">
                        <div class="side-Image__product_detail">
                            <div class="main-Image__product_detail">
                                <img src="${
                                    data_productDetail.list.img_product[0]
                                        .url_img_product
                                }" alt="" srcset="">
                            </div>
                            <div class="list-shortcutImage__product_detail">
                                ${data_productDetail.list.img_product
                                    .map((el, idx) => {
                                        if (idx == 0) {
                                            return `<div class="item-shortcutImage__product_detail active" data-opt-product-detail="${el.url_img_product}">
                                        <img src="${el.url_img_product}" alt="" srcset="">
                                        </div>`;
                                        } else {
                                            return `<div class="item-shortcutImage__product_detail" data-opt-product-detail="${el.url_img_product}">
                                        <img src="${el.url_img_product}" alt="" srcset="">
                                        </div>`;
                                        }
                                    })
                                    .join("")}
                            </div>
                        </div>

                        <div class="side-info__product_detail">
                            <div class="header-info__product_detail">
                                <div class="brand-info__product_detail">${
                                    data_productDetail[0].name_brand_product
                                }</div>
                                <div class="name-info__product_detail">${
                                    data_productDetail[0].name_product
                                }</div>
                                <div class="shortTech-info__product_detail">${
                                    data_productDetail[0].name_category_product
                                }</div>
                                <div class="part_rate-info__product_detail">
                                    <div class="list-rate_start-info__product_detail">
                                        <div class="item-rate_start-info__product_detail"><i class="fa-solid fa-star"></i></div>
                                        <div class="item-rate_start-info__product_detail"><i class="fa-solid fa-star"></i></div>
                                        <div class="item-rate_start-info__product_detail"><i class="fa-solid fa-star"></i></div>
                                        <div class="item-rate_start-info__product_detail"><i class="fa-solid fa-star"></i></div>
                                    </div>
                                    <div class="num-rate_start-info__product_detail">
                                        5 reviews
                                    </div>
                                </div>
                                <div class="partPrice-info__product_detail">
                                    <div class="infoPrice-info__product_detail">
                                        <div class="defaultPrice-info__product_detail">
                                            <div data-saleSinglePrice-productDetail='${(
                                                data_productDetail[0]
                                                    .root_price_product *
                                                (1 -
                                                    data_productDetail[0]
                                                        .rate_sale_default_product)
                                            ).toFixed(
                                                2
                                            )}' class="salePrice-info__product_detail">
                                            ${(
                                                data_productDetail[0]
                                                    .root_price_product *
                                                (1 -
                                                    data_productDetail[0]
                                                        .rate_sale_default_product)
                                            ).toFixed(2)}
                                            <b>VNĐ</b></div>
                                            <div class="rootPrice-info__product_detail">
                                            MRP:  ${
                                                "$" +
                                                data_productDetail[0]
                                                    .root_price_product
                                            }
                                            </div>
                                        </div>
                                        <div class="withMethodOther-Price-info__product_detail">
                                        Mua ngay, mua đi, không hết hàng !
                                        </div>
                                    </div>
                                    <div class="requestPrice-info__product_detail">
                                    Giá quá cao chăng?
                                    </div>
                                </div>
                            </div>
                            <div class="part-optionChar__product_detail">
                            <div class="list-optionChar__product_detail">
                                <div class="option-product__detail optionColor-product__detail">
                                    <div class="nameOption-product__detail">
                                        Màu sắc: <span class="valueOptChar__product_detail" data-opt-product-detail="${
                                            data_productDetail.list.color_product[0]
                                                .value_color_product
                                        }">${
                                            data_productDetail.list.color_product[0].value_color_product
                                        }</span>
                                    </div>
                                    <div class="list-option-product__detail list-optionColor-product__detail">
                                        ${data_productDetail.list.color_product
                                            .map((el, idx) => {
                                                if (obj_cartProduct) {
                                                    console.log(
                                                        el.id_color_product + "",
                                                        obj_cartProduct.id_optColor + ""
                                                    );
                                                    if (
                                                        el.id_color_product + "" ==
                                                        obj_cartProduct.id_optColor + ""
                                                    ) {
                                                        return `
                                                <div class="item-optionColor-product__detail active" data-id_optColor="${el.id_color_product}" data-opt-product-detail="${el.value_color_product}">
                                                <img src="${el.url_image_color_sub_product}" style="object-fit: cover;" alt="" srcset="">
                                                </div>
                                                `;
                                                    } else {
                                                        return `
                                                    <div class="item-optionColor-product__detail" data-id_optColor="${el.id_color_product}" data-opt-product-detail="${el.value_color_product}">
                                                    <img src="${el.url_image_color_sub_product}" style="object-fit: cover;" alt="" srcset="">
                                                    </div>
                                                `;
                                                    }
                                                } else if (idx == 0) {
                                                    return `
                                                <div class="item-optionColor-product__detail active" data-id_optColor="${el.id_color_product}" data-opt-product-detail="${el.value_color_product}">
                                                <img src="${el.url_image_color_sub_product}" style="object-fit: cover;" alt="" srcset="">
                                                </div>
                                                `;
                                                } else {
                                                    return `
                                                <div class="item-optionColor-product__detail" data-id_optColor="${el.id_color_product}" data-opt-product-detail="${el.value_color_product}">
                                                <img src="${el.url_image_color_sub_product}" style="object-fit: cover;" alt="" srcset="">
                                                </div>
                                            `;
                                                }
                                            })
                                            .join("")}
                                    </div>
                                </div>
                                ${
                                    data_productDetail.list.plug_product.length > 0
                                        ? `
                                <div class="option-product__detail optionPlug-product__detail">
                                    <div class="nameOption-product__detail">
                                    Cổng: <span class="valueOptChar__product_detail " data-opt-product-detail="${
                                        data_productDetail.list.plug_product[0]
                                            .value_plug_product
                                    }">${
                                                data_productDetail.list
                                                    .plug_product[0]
                                                    .value_plug_product
                                            }
                                    </span>
                                    </div>
                                    <div class="list-option-product__detail list-optionPlug-product__detail">
                                    ${data_productDetail.list.plug_product
                                        .map((el, idx) => {
                                            if (obj_cartProduct) {
                                                if (
                                                    el.id_plug_product + "" ==
                                                    obj_cartProduct.id_optPlug + ""
                                                ) {
                                                    return `
                                            <div class="item-optionPlug-product__detail active" style="background-image: repeating-linear-gradient(45deg, #bfbdbd63 0, #e9e1e1a3  10px, transparent 10px, transparent 20px);" data-id_optPlug="${el.id_plug_product}" data-opt-product-detail="${el.value_plug_product}">${el.value_plug_product}</div>
                                            `;
                                                } else {
                                                    return `
                                                <div class="item-optionPlug-product__detail" style="background-image: repeating-linear-gradient(45deg, #bfbdbd63 0, #e9e1e1a3  10px, transparent 10px, transparent 20px);" data-id_optPlug="${el.id_plug_product}" data-opt-product-detail="${el.value_plug_product}">${el.value_plug_product}</div>
        
                                            `;
                                                }
                                            } else if (idx == 0) {
                                                return `
                                            <div class="item-optionPlug-product__detail active" style="background-image: repeating-linear-gradient(45deg, #bfbdbd63 0, #e9e1e1a3  10px, transparent 10px, transparent 20px);" data-id_optPlug="${el.id_plug_product}" data-opt-product-detail="${el.value_plug_product}">${el.value_plug_product}</div>
                                            `;
                                            } else {
                                                return `
                                            <div class="item-optionPlug-product__detail" style="background-image: repeating-linear-gradient(45deg, #bfbdbd63 0, #e9e1e1a3  10px, transparent 10px, transparent 20px);" data-id_optPlug="${el.id_plug_product}" data-opt-product-detail="${el.value_plug_product}">${el.value_plug_product}</div>

                                        `;
                                            }
                                        })
                                        .join("")}
                                    </div>
                                </div>
                                `
                                        : ""
                                }
                                <div class="option-product__detail optionQuantity-product__detail">
                                    <div class="nameOption-product__detail">
                                    Số lượng: <span class="valueOptChar__product_detail" data-opt-product-detail="123">123</span>
                                    </div>
                                    <div class="part-setNumOrder__product_detail">
                                        <div class="btn-setNumOrder__product_detail btn-decreaseNumberOrder__product_detail">-</div>
                                        <input type="number" min=${1} value='1' class="value-NumberOrder__product_detail" />
                                        <div class="btn-setNumOrder__product_detail btn-increaseNumberOrder__product_detail">+</div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="part-optionPay__product_detail">
                                <div class="mb-optionPay__product_detail btn-soldOut__product_detail">
                                    Sold Out
                                </div>
                                <div class="mb-optionPay__product_detail btn-notify__product_detail">
                                    Notify when Available
                                </div>
                                <div class="mb-optionPay__product_detail btn-addCart__product_detail">
                                    Thêm vào giỏ hàng
                                </div>
                                <div class="mb-optionPay__product_detail btn-CheckInCart__product_detail">
                                    Edit Product in Cart
                                </div>
                                <div class="mb-optionPay__product_detail mess-expected__product_detail">
                                        Bấm mua đi chứ ngần ngại gì nữa.
                                        <span class="timeExpected"> Lấy luôn!</span>
                                </div>
                                <div class="mb-optionPay__product_detail btn-optTalkWithShop__product_detail">
                                    Nhắn Tin với Shop!!!
                                </div>
                                <div class="mb-optionPay__product_detail part-optPayLater__product_detail">
                                    <div class="title-optPayLater__product_detail">
                                    Mua ngay, thanh toán qua!!!
                                    </div>
                                    <div class="list-optPayLater__product_detail">
                                        <div class="item-optPayLater__product_detail">
                                            <div class="logo-bankPayLater__product_detail">
                                                <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBM0E3SHc9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--98ad6550665270931a546757db0e58f65b0505bc/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--ee4e4854f68df0a745312d63f6c2782b5da346cd/MoMo%20Logo.png" alt="" srcset="">
                                            </div></div>
                                        <div class="item-optPayLater__product_detail">
                                            <div class="logo-bankPayLater__product_detail">
                                                <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBM0E3SHc9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--98ad6550665270931a546757db0e58f65b0505bc/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--ee4e4854f68df0a745312d63f6c2782b5da346cd/MoMo%20Logo.png" alt="" srcset="">
                                            </div></div>
                                        <div class="item-optPayLater__product_detail">
                                            <div class="logo-bankPayLater__product_detail">
                                                <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBM0E3SHc9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--98ad6550665270931a546757db0e58f65b0505bc/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--ee4e4854f68df0a745312d63f6c2782b5da346cd/MoMo%20Logo.png" alt="" srcset="">
                                            </div></div>
                                        <div class="item-optPayLater__product_detail">
                                            <div class="logo-bankPayLater__product_detail">
                                                <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBM0E3SHc9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--98ad6550665270931a546757db0e58f65b0505bc/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--ee4e4854f68df0a745312d63f6c2782b5da346cd/MoMo%20Logo.png" alt="" srcset="">
                                            </div></div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="footer-info__product_detail"></div>

                        </div>
                    </div>

                    <div class="partTab__product_detail">
                        <div class="list-BtnTab__product_detail">
                            <div class="item-btnTab__product_detail active" data-tab-product-detail="Description">Mô tả</div>
                            <div class="item-btnTab__product_detail" data-tab-product-detail="Specs">Thông số kỹ thuật</div>
                            <div class="item-btnTab__product_detail" data-tab-product-detail="Best-Pairings">Sản phẩm đi kèm</div>
                            <div class="item-btnTab__product_detail" data-tab-product-detail="FAQS">FAQS</div>
                        </div>
                        <div class="list-mainTab__product_detail">
                            <div data-tab-product-detail="Description" class="item-mainTab__product_detail itemDescription-mainTab__product_detail active">
                                <div class="list-contentDescription__product_detail">
                                ${data_productDetail.list.description_product
                                    .map((el, idx) => {
                                        return `
                                        <div class="item-contentDescription__product_detail">
                                        <div class="headerDescription-mainTab__product_detail">
                                            <div class="title-headerDescription__tabProduct_detail  halfParent">
                                            ${el.title_description}
                                            </div>
                                            <div class="text-headerDescription__tabProduct_detail halfParent">
                                            ${el.content_description}
                                            </div>
                                        </div>
                                        <div class="bodyImages-mainTab__product_detail">
                                        <div class="list-imagesDescription__tabProduct_detail">
                                            ${el.list_img_description_product
                                                .map((img, i) => {
                                                    if (
                                                        el.list_img_description_product
                                                            .length %
                                                            2 !=
                                                        0
                                                    ) {
                                                        if (i == 0) {
                                                            return `
                                                        <div class="item-imagesDescription__tabProduct_detail fullParent">
                                                            <img src="${img.url_img_description_product}" alt="" srcset="">
                                                        </div>
                                                        `;
                                                        } else {
                                                            return `
                                                        <div class="item-imagesDescription__tabProduct_detail halfParent">
                                                            <img src="${img.url_img_description_product}" alt="" srcset="">
                                                        </div>
                                                        `;
                                                        }
                                                    } else {
                                                        return `
                                                    <div class="item-imagesDescription__tabProduct_detail fullParent">
                                                        <img src="${img.url_img_description_product}" alt="" srcset="">
                                                    </div>
                                                    `;
                                                    }
                                                })
                                                .join("")}
                                        </div>
                                        </div>
                                    </div>
                                        `;
                                    })
                                    .join("")}
                                </div>
                            </div>
                            <div data-tab-product-detail="Specs" class="item-mainTab__product_detail itemSpecs-mainTab__product_detail">
                                <div class="list-tableSpecs_mainTab__product_detail">
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-tab-product-detail="Best-Pairings" class="item-mainTab__product_detail itemBestPairs-mainTab__product_detail">
                                <div class="list-selectBestPair_mainTab__product_detail">
                                    <div class="item-selectBestPair_mainTab__product_detail">
                                        <div class="name-optBestPair_mainTab__product_detail">
                                            MỘT SỐ SẢN PHẨM CÙNG BRAND
                                        </div>
                                        <div class="list-optBestPair_mainTab__product_detail">
                                            ${data_productDetail.list.accompanying_list
                                                .map((el, index) => {
                                                    
                                                    return `
                                                        <div class="item-optBestPair_mainTab__product_detail">
                                                            <div class="card-productBestPair_mainTab__product_detail">
                                                                <div class="part-imgProductBestPair_mainTab__product_detail">
                                                                    <img src="${el.img.url_img_product}" alt="">
            
                                                                </div>
                                                                <div class="part-shortInfoProductBestPair_mainTab__product_detail">
                                                                    <div class="name-shortInfoProductBestPair_mainTab__product_detail">
                                                                        ${el.name_product}
                                                                    </div>
                                                                    <div class="priceRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                        <div class="priceSaleRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                            ${el.price.root_price_product.toLocaleString()}
                                                                        </div>
                                                                        <div class="priceRootRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                            <i class="fa fa-money" aria-hidden="true"></i>
                                                                        </div>
                                                                    </div>
                                                                    <button class="button-55 btn_click_detail_new_product" role="button" id_product="${el.id_product}">Chi Tiết</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    `;
                                                })
                                                .join("")
                                            }
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-tab-product-detail="FAQS" class="item-mainTab__product_detail itemFAQS-mainTab__product_detail">
                                <div class="listShow-FAQS-mainTab__product_detail">
                                ${data_productDetail.list.FAQs_product.map((el) => {
                                    return `
                                    <div class="item-Show-FAQS-mainTab__product_detail">
                                        <div class="partQS-show-FAQS-mainTab__product_detail">
                                            <div class="textQS-Show-FAQS-mainTab__product_detail">
                                        ${el.question_product}
                                        </div>
                                        <div class="summary-Show-FAQS-mainTab__product_detail">
                                            <div class="iconSummary-Show-FAQS-mainTab__product_detail">
                                                <i class="fa-regular fa-comment"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="partAnswer-ShowFAQS-mainTab__product_detail">
                                    ${el.answer_product}
                                </div>
                                </div>
                                    `;
                                }).join("")}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-product__detail">
                    <div class="list-brandTechnology__product_detail">

                    ${data_productDetail.list.tech_sound_product
                        .map((el) => {
                            return `
                            <div class="item-brandTechnology__product_detail" style="overflow: hidden;">
                                <div class="logo-brandTechnology__product_detail" style="width: 100%;">
                                    <img src="/${el.logo_tech_sound_product}" alt=""  srcset="" style="width: 100%;">
                                </div>
                                <div class="description-brandTechnology__product_detail">
                                    "${el.description_tech_sound_product}"
                                </div>
                                <div class="btnReadmore-brandTechnology__product_detail">
                                    Read More
                                </div>
                            </div>
                            `;
                        })
                        .join("")}
                        
                    </div>
                </div>
            </div>
            <div class="container-product__comment">
                
                ${data_productDetail.YesNoLogin=='yes'?
                    `<div class="list-product__comment">
                        <div class="item-product__comment">
                            <div class="card mb-3">
                                <img class="display_image_cmt" style="width: 100%; "  alt="">
                            </div>
                        </div>
                        <div class="item-product__comment">
                            <div class="info-commenter">
                                <lable style="margin-right: 10px;"><b>Tiêu Đề:</b></lable>
                                <input type="text" class="input_title_comment_product">
                            </div>

                            <div class="info-commenter" style="margin-top: 10px;">
                                <input type="text" class="input_comment_product"> 
                                <div style="width: 20%; display: flex; justify-content: center; align-items: center;">
                                    <button class="button-30 btn_cmt_upload_image" role="button" style="margin-right: 0.5rem;"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                    <input id="news_image" type="file" name="news_image" class="file-upload-default" style="display: none;">
                                    <button class="button-30 btn_cmt_product" role="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>`
                :''}
                


                <div class="contains_list_comment_content" style="width: 100%;">
                    <button class="button-30 page_comment" page_comment="1" style="margin-right: 0.5rem;"  role="button">1</button>
                </div>
                
                
            <div class="border_btn_pagination_comment_product">
            </div>
        </div>
    `;
    popup_product__detail.querySelector('.btn-CheckInCart__product_detail').addEventListener('click',function(event)
    {
        popup_product__detail.remove();
        document.querySelector('.click-form-cart').click();
    })
    var btnCLose__product_detail = popup_product__detail.querySelector(".btnCLose__product_detail");
    btnCLose__product_detail.addEventListener("click", function (event) {
        popup_product__detail.classList.remove("show");
        popup_product__detail.ontransitionend = function () {
            popup_product__detail.remove();
        };
    });

    let btn_click_detail_new_product = popup_product__detail.querySelectorAll('.btn_click_detail_new_product');
    btn_click_detail_new_product.forEach(item => {
        item.addEventListener('click', function (e) {
            // console.log(e.currentTarget.getAttribute('id_product'));
            getDataDetail(e.currentTarget.getAttribute('id_product'));
            console.log(data_productDetail.list.comment_customer);
        });
    });



    // load comment
        let page_comment = popup_product__detail.querySelectorAll('.page_comment');
        page_comment.forEach(item => {
            item.addEventListener('click', function(e) {
                let pageComment = e.currentTarget.getAttribute('page_comment')
                // console.log(data_productDetail.list.comment_customer.slice(0, 3));
                let contains_list_comment_content = popup_product__detail.querySelector('.contains_list_comment_content');
                contains_list_comment_content.innerHTML=`
                    ${data_productDetail.list.comment_customer.slice((pageComment-1)*3, 3*pageComment)
                        .map((el) => {
                            return `
                            <div class="list-product__comment">
                                <div class="item-product__comment">
                                    <div class="header-product__comment">
                                        <div class="part-rate__star">
                                            <div class="list-star">
                                                <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                            </div>
                                        </div>
                                        <div class="part-time__post">${el.date_send}</div>
                                    </div>
                                    <div class="info-commenter">
                                        <div class="avatar__commenter"><img src="${el.url_avatar_account}" alt=""></div>
                                        <div class="name__commenter">${el.name_customer}
                                            <div class="tag__verified">Người Mua Hàng</div>
                                        </div>
                                    </div>
                                    <div class="main__comment">
                                        <div class="title__comment">&nbsp;</div>
                                        <div class="shop__replied">
                                            <div class="name-shop__replied">${el.title_comment}</div>
                                            <div class="main-shop__replied">
                                                <div class="text-shop__replied">${el.content_comment}</div>
                                            </div>
                                            ${el.url_image_comment ? 
                                                `
                                                    <div class="card mb-3" style="background: transparent;
                                                    border: none;">
                                                        <img class="display_image_cmt" src="${el.url_image_comment.url_image_comment}" 
                                                            style="width: 30%; 
                                                            margin-top: 1rem;
                                                            border: 2px solid black;
                                                            border-radius: 8px; "  
                                                        alt="">
                                                    </div>
                                                `
                                                :''
                                            }
                                        </div>

                                        ${el.comment_admin_reply ?
                                            el.comment_admin_reply.map(element => {
                                                return `
                                                    <div class="shop__replied shop__replied_from_serve">
                                                        <div class="name-shop__replied">Life Sound</div>
                                                        <div class="main-shop__replied">
                                                            <div class="text-shop__replied">${element.content_reply}</div>
                                                        </div>
                                                    </div>
                                                `;
                                            })
                                            .join("")
                                        :``}

                                        
                                    </div>
                                </div>
                                
                            </div>
                            `;
                        })
                        .join("")}
                `

                let border_btn_pagination_comment_product = popup_product__detail.querySelector('.border_btn_pagination_comment_product');
                border_btn_pagination_comment_product.innerHTML=`
                    ${data_productDetail.list.pagination
                    .map((el) => {
                        let html = '';
                        for(let i = 1; i <= el.totalPage; i++) {
                            html = html + '<button class="button-30 page_comment" page_comment="'+ i +'" style="margin-right: 0.5rem;"  role="button">'+ i +'</button>'
                        }
                        return html;
                    })
                    .join("")}
                    `;
                border_btn_pagination_comment_product.querySelectorAll('.page_comment').forEach(item => {
                    item.addEventListener('click', function(e) {
                        let pageComment = e.currentTarget.getAttribute('page_comment')
                        // console.log(data_productDetail.list.comment_customer.slice(0, 3));
                        let contains_list_comment_content = popup_product__detail.querySelector('.contains_list_comment_content');
                        contains_list_comment_content.innerHTML=`
                            ${data_productDetail.list.comment_customer.slice((pageComment-1)*3, 3*pageComment)
                                .map((el) => {
                                    return `
                                    <div class="list-product__comment">
                                        <div class="item-product__comment">
                                            <div class="header-product__comment">
                                                <div class="part-rate__star">
                                                    <div class="list-star">
                                                        <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                        <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                        <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                        <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                        <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                    </div>
                                                </div>
                                                <div class="part-time__post">${el.date_send}</div>
                                            </div>
                                            <div class="info-commenter">
                                                <div class="avatar__commenter"><img src="${el.url_avatar_account}" alt=""></div>
                                                <div class="name__commenter">${el.name_customer}
                                                <div class="tag__verified">Người Mua Hàng</div>
                                            </div>
                                            </div>
                                            <div class="main__comment">
                                                <div class="title__comment">&nbsp;</div>
                                                <div class="shop__replied">
                                                    <div class="name-shop__replied">${el.title_comment}</div>
                                                    <div class="main-shop__replied">
                                                        <div class="text-shop__replied">${el.content_comment}</div>
                                                    </div>
                                                    ${el.url_image_comment ? 
                                                        `
                                                            <div class="card mb-3" style="background: transparent;
                                                            border: none;">
                                                                <img class="display_image_cmt" src="${el.url_image_comment.url_image_comment}" 
                                                                    style="width: 30%; 
                                                                    margin-top: 1rem;
                                                                    border: 2px solid black;
                                                                    border-radius: 8px; "  
                                                                alt="">
                                                            </div>
                                                        `
                                                        :''
                                                    }
                                                </div>
                                                ${el.comment_admin_reply ?
                                                    el.comment_admin_reply.map(element => {
                                                        return `
                                                            <div class="shop__replied shop__replied_from_serve">
                                                                <div class="name-shop__replied">Life Sound</div>
                                                                <div class="main-shop__replied">
                                                                    <div class="text-shop__replied">${element.content_reply}</div>
                                                                </div>
                                                            </div>
                                                        `;
                                                    })
                                                    .join("")
                                                :``}
                                            </div>
                                        </div>
                                        
                                    </div>
                                    `;
                                })
                                .join("")}
                        `
                    });
                });
                
            });
        });
        if(page_comment.length > 0) {
            page_comment[0].click();
        }
    // =======================

    //  comment
        if(data_productDetail.YesNoLogin=='yes') {

            let btn_cmt_upload_image = popup_product__detail.querySelector('.btn_cmt_upload_image');
            btn_cmt_upload_image.addEventListener('click', function(e) {
                popup_product__detail.querySelector('#news_image').click();
            });

            let news_image = popup_product__detail.querySelector('#news_image');
            news_image.addEventListener('change', function(e) {
                popup_product__detail.querySelector('.display_image_cmt').setAttribute('src',URL.createObjectURL(e.currentTarget.files[0]));
            });


            let btn_cmt_product = popup_product__detail.querySelector('.btn_cmt_product');
            btn_cmt_product.addEventListener('click', function() {
                let title_comment = popup_product__detail.querySelector('.input_title_comment_product').value;
                let content_comment = popup_product__detail.querySelector('.input_comment_product').value;
                let url_image_comment = $('#news_image')[0].files;
                let id_product = data_productDetail[0].id_product;
        
                if(content_comment == '' || title_comment == '') {
                    displayToast('Không được để trống ?!');
                } else {
                    var form  = new FormData();
                    form.append('title_comment', title_comment);
                    form.append('content_comment', content_comment);
                    form.append('id_product', id_product);
                    form.append('url_image_comment', url_image_comment[0]);

            
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:  '/product/comment',
                        method: 'post',
                        data: form,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(data) {
                            data_productDetail.list.comment_customer = data.comment_customer;
                            data_productDetail.list.pagination.totalPage = data.pagination[0].totalPage;
                            popup_product__detail.querySelector('.input_title_comment_product').value = '';
                            popup_product__detail.querySelector('.input_comment_product').value = '';
                            popup_product__detail.querySelector('#news_image').value = '';

                            let totalPage = data.pagination[0].totalPage;
                            console.log(data_productDetail.list.pagination.totalPage);
                            // console.log(data.comment_customer);
                            if(data.comment_customer.length == 1) {
                                let border_btn_pagination_comment_product = popup_product__detail.querySelector('.border_btn_pagination_comment_product');
                                border_btn_pagination_comment_product.innerHTML=`
                                    <button class="button-30 page_comment" page_comment="1" style="margin-right: 0.5rem;"  role="button">1</button>
                                `;
                                page_comment[0].click();
                            } else {
                                page_comment[0].click();
                            }
                            let border_btn_pagination_comment_product = popup_product__detail.querySelector('.border_btn_pagination_comment_product');
                            border_btn_pagination_comment_product.innerHTML=`
                                ${data_productDetail.list.pagination
                                .map((el) => {
                                    let html = '';
                                    for(let i = 1; i <= data.pagination[0].totalPage; i++) {
                                        html = html + '<button class="button-30 page_comment" page_comment="'+ i +'" style="margin-right: 0.5rem;"  role="button">'+ i +'</button>'
                                    }
                                    return html;
                                })
                                .join("")}
                                `;
                            border_btn_pagination_comment_product.querySelectorAll('.page_comment').forEach(item => {
                                item.addEventListener('click', function(e) {
                                    let pageComment = e.currentTarget.getAttribute('page_comment')
                                    // console.log(data_productDetail.list.comment_customer.slice(0, 3));
                                    let contains_list_comment_content = popup_product__detail.querySelector('.contains_list_comment_content');
                                    contains_list_comment_content.innerHTML=`
                                        ${data_productDetail.list.comment_customer.slice((pageComment-1)*3, 3*pageComment)
                                            .map((el) => {
                                                return `
                                                <div class="list-product__comment">
                                                    <div class="item-product__comment">
                                                        <div class="header-product__comment">
                                                            <div class="part-rate__star">
                                                                <div class="list-star">
                                                                    <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                                    <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                                    <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                                    <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                                    <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                                                </div>
                                                            </div>
                                                            <div class="part-time__post">${el.date_send}</div>
                                                        </div>
                                                        <div class="info-commenter">
                                                            <div class="avatar__commenter"><img src="${el.url_avatar_account}" alt=""></div>
                                                            <div class="name__commenter">${el.name_customer}
                                                                <div class="tag__verified">Người Mua Hàng</div>
                                                            </div>
                                                        </div>
                                                        <div class="main__comment">
                                                            <div class="title__comment">&nbsp;</div>
                                                            <div class="shop__replied">
                                                                <div class="name-shop__replied">${el.title_comment}</div>
                                                                <div class="main-shop__replied">
                                                                    <div class="text-shop__replied">${el.content_comment}</div>
                                                                </div>
                                                                ${el.url_image_comment ? 
                                                                    `
                                                                        <div class="card mb-3" style="background: transparent;
                                                                        border: none;">
                                                                            <img class="display_image_cmt" src="${el.url_image_comment.url_image_comment}" 
                                                                                style="width: 30%; 
                                                                                margin-top: 1rem;
                                                                                border: 2px solid black;
                                                                                border-radius: 8px; "  
                                                                            alt="">
                                                                        </div>
                                                                    `
                                                                    :''
                                                                }
                                                            </div>
                                                            ${el.comment_admin_reply ?
                                                                el.comment_admin_reply.map(element => {
                                                                    return `
                                                                        <div class="shop__replied shop__replied_from_serve">
                                                                            <div class="name-shop__replied">Life Sound</div>
                                                                            <div class="main-shop__replied">
                                                                                <div class="text-shop__replied">${element.content_reply}</div>
                                                                            </div>
                                                                        </div>
                                                                    `;
                                                                })
                                                                .join("")
                                                            :``}
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                    
                                                `;
                                            })
                                            .join("")}
                                    `
                                });
                            });
                            
                        },
                        error: function() {
                            displayToast('Không Thêm được.');
                        }
                    });       
                }
        
        
            });
        }
    // =======================

    

    toolCommon.setActiveInList(
        ".item-shortcutImage__product_detail",
        "active",
        popup_product__detail,
        "click",
        (urlImage) => {
            popup_product__detail.querySelector(
                ".main-Image__product_detail img"
            ).src = urlImage;
        }
    );
    toolCommon.setActiveInList(
        ".item-optionPlug-product__detail",
        "active",
        popup_product__detail,
        "click",
        (valueOPt) => {
            popup_product__detail.querySelector(
                ".optionPlug-product__detail .valueOptChar__product_detail"
            ).textContent = valueOPt;
            popup_product__detail
                .querySelector(
                    ".optionPlug-product__detail .valueOptChar__product_detail"
                )
                .setAttribute("data-opt-product-detail", valueOPt);

            getQuantityProductWithOptChar(
                popup_product__detail.getAttribute("data-id-product"),
                {
                    id_optColor:toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionColor-product__detail.active"
                        )
                        ,'data-id_optColor'
                        ,0
                    ),
                    id_optPlug: 
                    toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionPlug-product__detail.active"
                        )
                        ,'data-id_optPlug'
                        ,0
                    )
                },
                (result) => {
                    loadOptOrderWithQuantity(result, popup_product__detail);
                }
            );
            getPrice_Sale_ProductWithOptChar(
                popup_product__detail.getAttribute("data-id-product"),
                {
                    id_optColor:toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionColor-product__detail.active"
                        )
                        ,'data-id_optColor'
                        ,0
                    ),
                    id_optPlug: 
                    toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionPlug-product__detail.active"
                        )
                        ,'data-id_optPlug'
                        ,0
                    )
                },
                (Obj_price) => {
                    loadOptOrderWithPrice(Obj_price, popup_product__detail);
                }
            );
        }
    );
    toolCommon.setActiveInList(
        ".item-optionColor-product__detail",
        "active",
        popup_product__detail,
        "click",
        (valueOPt) => {
            popup_product__detail.querySelector(
                ".optionColor-product__detail .valueOptChar__product_detail"
            ).textContent = valueOPt;
            popup_product__detail
                .querySelector(
                    ".optionColor-product__detail .valueOptChar__product_detail"
                )
                .setAttribute("data-opt-product-detail", valueOPt);
            getQuantityProductWithOptChar(
                popup_product__detail.getAttribute("data-id-product"),
                {
                    id_optColor:toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionColor-product__detail.active"
                        )
                        ,'data-id_optColor'
                        ,0
                    ),
                    id_optPlug: 
                    toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionPlug-product__detail.active"
                        )
                        ,'data-id_optPlug'
                        ,0
                    )
                },
                (result) => {
                    loadOptOrderWithQuantity(result, popup_product__detail);
                }
            );

            getPrice_Sale_ProductWithOptChar(
                popup_product__detail.getAttribute("data-id-product"),
                {
                    id_optColor:toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionColor-product__detail.active"
                        )
                        ,'data-id_optColor'
                        ,0
                    ),
                    id_optPlug: 
                    toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionPlug-product__detail.active"
                        )
                        ,'data-id_optPlug'
                        ,0
                    ),
                },
                (Obj_price) => {
                    loadOptOrderWithPrice(Obj_price, popup_product__detail);
                }
            );
        }
    );
    toolCommon.setNumOrderProduct(
        popup_product__detail.querySelector(
            ".btn-increaseNumberOrder__product_detail"
        ),
        popup_product__detail.querySelector(
            ".btn-decreaseNumberOrder__product_detail"
        ),
        popup_product__detail.querySelector(
            "input.value-NumberOrder__product_detail"
        ),
        (el_valueOrder) => {
            var salePriceInfo__product_detail =
                popup_product__detail.querySelector(
                    ".defaultPrice-info__product_detail .salePrice-info__product_detail"
                );
            salePriceInfo__product_detail.textContent = (
                parseFloat(
                    salePriceInfo__product_detail.getAttribute(
                        "data-salesingleprice-productdetail"
                    )
                ) * el_valueOrder.value
            );
        }
    );
    EventChangeWithElTabs(
        popup_product__detail.querySelectorAll(".item-btnTab__product_detail"),
        ".item-mainTab__product_detail",
        "data-tab-product-detail",
        "click",
        popup_product__detail
    );

    popup_product__detail.className = "show";
    popup_product__detail
        .querySelector(".item-optionColor-product__detail.active")
        .click();

    popup_product__detail
        .querySelector(
            ".part-optionPay__product_detail .btn-addCart__product_detail"
        )
        .addEventListener("click", function (event) {
            requestSaveAddCart(
                {
                    id_product:
                        popup_product__detail.getAttribute("data-id-product"),
                    id_optColor:toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionColor-product__detail.active"
                        )
                        ,'data-id_optColor'
                        ,0
                    ),
                    id_optPlug: 
                    toolCommon.getAttributeWithElement(
                        popup_product__detail.querySelector(
                            ".item-optionPlug-product__detail.active"
                        )
                        ,'data-id_optPlug'
                        ,0
                    ),
                    quantityOrder: popup_product__detail.querySelector(
                        ".part-setNumOrder__product_detail .value-NumberOrder__product_detail"
                    ).value,
                },
                () => {
                    popup_product__detail
                        .querySelector(
                            ".item-optionColor-product__detail.active"
                        )
                        .click();
                    toolCart.getCountProductsCart((num) => {
                        var header__cart__counts = document.querySelectorAll(
                            ".header__cart__count"
                        );
                        for (var header__cart__count of header__cart__counts) {
                            header__cart__count.textContent = num;
                        }
                    });
                }
            );
        });
    document.body.appendChild(popup_product__detail);
}
function loadOptOrderWithQuantity(result, popup_product__detail) {
    var valueOpt = result.quantity_product_has;
    popup_product__detail.querySelector(
        ".optionQuantity-product__detail .valueOptChar__product_detail"
    ).textContent = valueOpt;
    popup_product__detail.querySelector(
        ".part-setNumOrder__product_detail .value-NumberOrder__product_detail"
    ).max = valueOpt;
    if (valueOpt == 0) {
        popup_product__detail.querySelector(
            ".option-product__detail.optionQuantity-product__detail"
        ).style.display = "none";
        popup_product__detail.querySelector(
            ".btn-addCart__product_detail"
        ).style.display = "none";

        popup_product__detail.querySelector(
            ".part-optionPay__product_detail .btn-notify__product_detail"
        ).style.display = "block";
        popup_product__detail.querySelector(
            ".part-optionPay__product_detail .btn-soldOut__product_detail"
        ).style.display = "block";
    } else if (typeof valueOpt === "undefined") {
        toolCommon.displayAnItemInList(
            [
                popup_product__detail.querySelector(
                    ".option-product__detail.optionQuantity-product__detail"
                ),
                popup_product__detail.querySelector(
                    ".btn-addCart__product_detail"
                ),
                popup_product__detail.querySelector(
                    ".part-optionPay__product_detail .btn-soldOut__product_detail"
                ),
                popup_product__detail.querySelector(
                    ".part-optionPay__product_detail .btn-addCart__product_detail"
                ),
                popup_product__detail.querySelector(
                    ".part-optionPay__product_detail .btn-CheckInCart__product_detail"
                ),
            ],
            popup_product__detail.querySelector(
                ".part-optionPay__product_detail .btn-notify__product_detail"
            ),
            typeof valueOpt === "undefined",
            () => {}
        );
    } else {
        popup_product__detail.querySelector(
            ".option-product__detail.optionQuantity-product__detail"
        ).style.display = "block";
        toolCommon.displayAnItemInList(
            [
                popup_product__detail.querySelector(
                    ".part-optionPay__product_detail .btn-addCart__product_detail"
                ),
                popup_product__detail.querySelector(
                    ".part-optionPay__product_detail .btn-notify__product_detail"
                ),
                popup_product__detail.querySelector(
                    ".part-optionPay__product_detail .btn-soldOut__product_detail"
                ),
                popup_product__detail.querySelector(
                    ".option-product__detail.optionQuantity-product__detail"
                ),
            ],
            popup_product__detail.querySelector(
                ".part-optionPay__product_detail .btn-CheckInCart__product_detail"
            ),
            typeof result.dataOrdered !== "undefined",
            () => {
                toolCommon.displayAnItemInList(
                    [
                        popup_product__detail.querySelector(
                            ".part-optionPay__product_detail .btn-CheckInCart__product_detail"
                        ),
                        popup_product__detail.querySelector(
                            ".part-optionPay__product_detail .btn-notify__product_detail"
                        ),
                        popup_product__detail.querySelector(
                            ".part-optionPay__product_detail .btn-soldOut__product_detail"
                        ),
                    ],
                    popup_product__detail.querySelector(
                        ".part-optionPay__product_detail .btn-addCart__product_detail"
                    ),
                    typeof result.dataOrdered === "undefined",
                    () => {}
                );
            }
        );
    }
}
function loadOptOrderWithPrice(Obj_price, popup_product__detail) {
    // console.log(Obj_price);
    if (Obj_price) {
        setPriceElProduct(
            Obj_price.root_price_product,
            Obj_price.rate_sale_default_product,
            popup_product__detail.querySelector(
                ".salePrice-info__product_detail"
            ),
            popup_product__detail.querySelector(
                ".rootPrice-info__product_detail"
            )
        );
    } else {
        popup_product__detail.querySelector(
            ".salePrice-info__product_detail"
        ).textContent = "No";
        popup_product__detail.querySelector(
            ".rootPrice-info__product_detail"
        ).textContent = "No";
    }
}
function requestSaveAddCart(obj_opt, methodWork) {
    console.log(obj_opt);
    var form = new FormData();
    form.append("productCartAdd", JSON.stringify(obj_opt));
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            // displayToast('Thêm Thành Công');
            if (methodWork) {
                methodWork();
            }
            // displayToast('Thêm Thành Công');
        }
    };
    xmlHttp.open("POST", "/cart/SaveAddCart", true);
    xmlHttp.setRequestHeader(
        "X-CSRF-TOKEN",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    );
    xmlHttp.send(form);
}

function getQuantityProductWithOptChar(id_product, obj_opt, methodWork) {
    console.log(obj_opt);
    $.ajax({
        url:
            "/product/getQuantity?id=" +
            id_product +
            "&obj_opt=" +
            JSON.stringify(obj_opt),
        type: "GET",
        typeData: "json",
        success: function (data) {
            console.log(data);
            if (data.length != 0) {
                var result = data[0];
                if (methodWork) {
                    methodWork(result);
                }
            } else {
                if (methodWork) {
                    methodWork(-1);
                }
            }
        },
    });
}
function getPrice_Sale_ProductWithOptChar(id_product, obj_opt, methodWork) {
    console.log(obj_opt);
    $.ajax({
        url:
            "/product/getPrice_Sale?id=" +
            id_product +
            "&obj_opt=" +
            JSON.stringify(obj_opt),
        type: "GET",
        typeData: "json",
        success: function (data) {
            console.log(data);
            if (data.length != 0) {
                var result = data[0];
                if (methodWork) {
                    methodWork(result);
                }
            } else {
                if (methodWork) {
                    methodWork(null);
                }
            }
        },
    });
}
const removeClassName = (el, classNameRemove) => {
    if (el) el.classList.remove(classNameRemove);
};
function addClassNameWithEvent(
    el,
    classNameAdd,
    TypeEvent,
    isRemoveClassName,
    methodWork
) {
    el.addEventListener(TypeEvent, function (event) {
        if (isRemoveClassName)
            removeClassName(
                document.querySelector(
                    "." +
                        (el.className + ("." + classNameAdd)).replaceAll(
                            " ",
                            "."
                        )
                ),
                classNameAdd
            );
        if (!event.currentTarget.classList.contains(classNameAdd)) {
            event.currentTarget.className += " " + classNameAdd;
            methodWork(
                event.currentTarget.getAttribute("data-tab-product-detail")
            );
        }
    });
}
function addClassName(el, classNameAdd, isRemoveClassName) {
    if (isRemoveClassName)
        if (!el.classList.contains(classNameAdd)) {
            // removeClassName(document.querySelector("."+(el.className+("."+classNameAdd)).replaceAll(" ",".")),classNameAdd);
            el.className += " " + classNameAdd;
        }
}
function setPriceElProduct(
    valuePrice_root,
    valueRate_sale,
    el_price_sale,
    el_price_root
) {
    var value_price_sale = (valuePrice_root * (1 - valueRate_sale));
    if (el_price_sale) {
        el_price_sale.textContent = value_price_sale + " VNĐ";
        el_price_sale.setAttribute(
            "data-saleSinglePrice-productDetail",
            value_price_sale
        );
    }
    if (el_price_root) el_price_root.textContent = valuePrice_root + " VNĐ";
}

function EventChangeWithElTabs(
    elListTab,
    textQueryELContentTabs,
    nameDataTabs,
    TypeEvent,
    elParent
) {
    for (var elItemTab of elListTab) {
        addClassNameWithEvent(
            elItemTab,
            "active",
            "click",
            true,
            (eventCurrentTarget) => {
                removeClassName(
                    elParent.querySelector(
                        textQueryELContentTabs + ("." + "active")
                    ),
                    "active"
                );
                addClassName(
                    elParent.querySelector(
                        textQueryELContentTabs +
                            "[" +
                            nameDataTabs +
                            "='" +
                            eventCurrentTarget +
                            "']"
                    ),
                    "active",
                    true
                );
            }
        );
    }
}
export {
    getDataDetail,
    loadEventItemProductShowDetail,
    getPrice_Sale_ProductWithOptChar,
    getQuantityProductWithOptChar,
    setPriceElProduct,
};

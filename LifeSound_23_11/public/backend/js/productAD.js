addAndRemoveOneContentDescription();
uploadImageProduct();
subUploadImageForDescription();
addAndRemoveSubProduct();
addAndRemoveCategory();
addAndRemoveTechnology();
addProduct();


// ===> function thêm nhiều ảnh một lúc
function uploadImageProduct() {
    let multiFileImages = document.querySelector('.multiFileImages');
    let uploadImageProduct = document.querySelector('.uploadImageProduct');
    let clearImageProduct = document.querySelector('.clearImageProduct');
    

    uploadImageProduct.addEventListener('click', function(e) {
        e.preventDefault();
        uploadImageProduct.classList.add('active');
        clearImageProduct.classList.remove('active');
        uploadImageProduct.setAttribute('disabled', '');
        clearImageProduct.removeAttribute('disabled');
        multiFileImages.click();
    });
    multiFileImages.addEventListener('change', function(e) {
        loadImageFromInputMultiFile();
    });
    clearImageProduct.addEventListener('click', function(e) {
        e.preventDefault();
        uploadImageProduct.classList.remove('active');
        clearImageProduct.classList.add('active');
        uploadImageProduct.removeAttribute('disabled');
        clearImageProduct.setAttribute('disabled', '');

        multiFileImages.value = '';
        let newHtml = `
                <div class="mup-msg">
                    <span class="mup-main-msg">Ảnh được úp lên đây nề bạn.</span>
                    <span class="mup-msg" id="max-upload-number">Được úp 10 ảnh thôi nà !!</span>
                    <span class="mup-msg">Chỉ được úp ảnh thôi đó.</span>
                </div>
            `;
        document.querySelector('.multiple-uploader').innerHTML =  newHtml;

    }); 
}
function loadImageFromInputMultiFile() {
    let multiFileImages = document.querySelector('.multiFileImages');
    let mupMsg = document.querySelector('.mup-msg');
        mupMsg.style.display = 'none';

    // nếu lớn hơn 10file thì sẻ xóa bớt
    let files = multiFileImages.files;
    if(files.length > 10) {
        const dt2 = new DataTransfer();
        for (let file of files) {
            dt2.items.add(file);
        }
        multiFileImages.files = dt2.files;
        for(let i = files.length; i > 10; i--) {
            let indexDelete = i - 1;
            console.log(indexDelete);
            dt2.items.remove(indexDelete);
        }
        document.querySelector('.multiFileImages').files = dt2.files;
        files = dt2.files;
    }

     // nếu 0 file 
    if(files.length == 0) {
        let uploadImageProduct = document.querySelector('.uploadImageProduct');
        let clearImageProduct = document.querySelector('.clearImageProduct');
        uploadImageProduct.classList.remove('active');
        clearImageProduct.classList.add('active');
        uploadImageProduct.removeAttribute('disabled');
        clearImageProduct.setAttribute('disabled', '');

        multiFileImages.value = '';
        let newHtml = `
                <div class="mup-msg">
                    <span class="mup-main-msg">Ảnh được úp lên đây nề bạn.</span>
                    <span class="mup-msg" id="max-upload-number">Được úp 10 ảnh thôi nà !!</span>
                    <span class="mup-msg">Chỉ được úp ảnh thôi đó.</span>
                </div>
            `;
        document.querySelector('.new-image-product').innerHTML =  newHtml;
    }

    // load image
    let count = 0;
    for(const file of files) {
        let scrLink = URL.createObjectURL(file);
        // console.log(scrLink);
        let newHtml = `
            <div class="image-container deleteSubListFileImage"  id="mup-image" data-acceptable-image="1" >
                <div class="image-size" data-image-index="`+ count +`"><i class="fa fa-trash" aria-hidden="true" style="font-size: 50px; color: red;"></i></div>
                <img src="`+ scrLink +`"  class="image-preview" alt="" />
            </div>
        `;
        document.querySelector('.multiple-uploader').insertAdjacentHTML('beforeend', newHtml);
        count = count + 1;
    }
    // xóa từng ảnh 
    let imageSize = document.querySelectorAll('.image-size');
        imageSize.forEach((item) => {
            item.addEventListener('click', function(e) {
                let indexImage = e.currentTarget.getAttribute('data-image-index');


                const dt = new DataTransfer();
                for (let file of files) {
                    dt.items.add(file);
                }
                console.log(dt);
                // Mise à jour des fichiers de l'input file après ajout
                multiFileImages.files = dt.files;

                dt.items.remove(indexImage);
                document.querySelector('.multiFileImages').files = dt.files;
                document.querySelector('.multiple-uploader').innerHTML =  '<div class="mup-msg"></div>';
                loadImageFromInputMultiFile();
            });
        });
}
// function thêm nhiều ảnh cho nhiều mô tả 
function subUploadImageForDescription() {
    let btn_add_image_of_description = document.querySelectorAll('.btn_add_image_of_description'); //btb upload
    let btn_remove_image_of_description = document.querySelectorAll('.btn_remove_image_of_description'); //btb upload
    let multiDescriptImages = document.querySelectorAll('.multiDescriptImages'); // input ẩn

    btn_add_image_of_description[btn_add_image_of_description.length-1].addEventListener('click',(e)=>{
        e.preventDefault();
        let classInputImage = '.' + e.currentTarget.getAttribute('input-multiDescriptImages');
        e.currentTarget.closest('.multiImageDescriptParent').querySelector(classInputImage).click();
    })

    btn_remove_image_of_description[btn_remove_image_of_description.length-1].addEventListener('click', function(e) {
        e.preventDefault();
        let classInputImage = '.' + e.currentTarget.getAttribute('input-multiDescriptImages');
        e.currentTarget.closest('.multiImageDescriptParent').querySelector(classInputImage).value = '';
        let newHtml = `
            <span style="font-weight: 900; font-size: 1.2rem;">Chưa có ảnh nào.</span>
        `;
        e.currentTarget.closest('.rowImageOfDescription').querySelector('.displayImageOD').innerHTML =  newHtml;

    });
    


    multiDescriptImages.forEach((item) => {
        item.addEventListener('change', function(e) {
            let files = e.currentTarget.files;
            
            // nếu lớn hơn 5 ảnh thì xóa bớt
            if(files.length > 5) {
                const dt2 = new DataTransfer();
                for (let file of files) {
                    dt2.items.add(file);
                }
                e.currentTarget.files = dt2.files;
                for(let i = files.length; i > 5; i--) {
                    let indexDelete = i - 1;
                    console.log(indexDelete);
                    dt2.items.remove(indexDelete);
                }
                e.currentTarget.files = dt2.files;
                files = dt2.files;
            }
            // load ảnh 
            let count = 0;
            e.currentTarget.closest('.rowImageOfDescription').querySelector('.displayImageOD').innerHTML = '';
            for(const file of files) {
                let scrLink = URL.createObjectURL(file);
                // console.log(scrLink);
                testCount = count + 1;
                let newHtml = `
                    <img src="`+ scrLink +`" class="rounded mx-auto d-block displayDescription`+ testCount +`" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                `;
                e.currentTarget.closest('.rowImageOfDescription').querySelector('.displayImageOD').insertAdjacentHTML('beforeend', newHtml);
                count = count + 1;
            }


        });
    });



}


//====> fuction thêm và xóa sản phẩm chi tiết
function addAndRemoveSubProduct() {
    let btn_add_sub_product = document.querySelector('.btn_add_sub_product');
    let btn_remove_sub_product = document.querySelectorAll('.btn_remove_sub_product');
    let count = 1;


    btn_add_sub_product.addEventListener('click', function(e) {
        e.preventDefault();
        count = count + 1;
        var tmp = document.querySelector('.col-form-border-sub-product .row-border-sub-product').cloneNode(true);
        document.querySelector('.col-form-border-sub-product').appendChild(tmp);
        count = btnRemoveSubProduct(count);
    });
    // count = btnRemoveSubProduct(count);

}
function btnRemoveSubProduct(count) {
    let btn_remove_sub_product = document.querySelectorAll('.btn_remove_sub_product');
    if(btn_remove_sub_product.length >= 2) 
    {
            btn_remove_sub_product[0].addEventListener('click', function(e) {

                count = count - 1; 
                
                let btn_remove_sub_product = document.querySelectorAll('.btn_remove_sub_product');
                if(btn_remove_sub_product.length>1)
                e.currentTarget.closest('.row-border-sub-product').remove();
                    
                    btnRemoveSubProduct(count);
        
            })
        }

    btn_remove_sub_product[btn_remove_sub_product.length-1].addEventListener('click', function(e) {
        if(btn_remove_sub_product.length >= 2) {
            count = count - 1; 
            console.log(count);                
            let btn_remove_sub_product = document.querySelectorAll('.btn_remove_sub_product');
            if(btn_remove_sub_product.length>1)
            e.currentTarget.closest('.row-border-sub-product').remove();
            btnRemoveSubProduct(count);
        }

    });
    return count;
}


// ==> function thêm và xóa description product
function addAndRemoveOneContentDescription() {
    let btnAddContentDescription = document.querySelector('.btn_add_content_description');
    let btnDeleteContentDescription = document.querySelector('.btn_delete_content_description');
    let count = 1;

    btnAddContentDescription.addEventListener('click', function (e) {
        e.preventDefault();
        if(count <= 3)
        {
            count = count + 1;
            let newHtml = `
                <div class="sub-big-form-group" count_subDescription="`+ count +`">
                    <div class="form-group">
                        <label for="">Tiêu Đề Mô Tả `+ count +`</label>
                        <input type="text" name="description`+ count +`" class="form-control titleDescription" id="description`+ count +`" placeholder="Nhập tiêu đề mổ tả `+ count +`">
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Nội Dung Mô Tả `+ count +`</label>
                        <textarea rows="3" class="form-control contentDescription" name="contentDescription`+ count +`" id="contentDescription`+ count +`"></textarea>
                    </div>
                </div>
            `;
            document.querySelector('.big-form-group').insertAdjacentHTML('beforeend', newHtml);

            let newHtml2 = `
                <div class="form-group rowImageOfDescription rowImageOfDescription`+ count +`" style="margin-bottom: 0px;">
                    <div class="row">
                        <div class="form-group col-md-9">
                            <label for="">Ảnh Mô Tả `+ count +`</label>
                        </div>
                        <div class="form-group col-md-3 multiImageDescriptParent">
                            <button type="button" class="btn btn-outline-dark btn_add_image_of_description" input-multiDescriptImages="multiDescriptImages`+ count +`"><i class="fa fa-upload" aria-hidden="true" style=""></i></button>
                            <button type="button" class="btn btn-outline-danger btn_remove_image_of_description" input-multiDescriptImages="multiDescriptImages`+ count +`"><i class="fa fa-trash" aria-hidden="true" style=""></i></button>
                            <input id="multiFile" class="multiDescriptImages multiDescriptImages`+ count +`" type="file" name="images[]" multiple="" accept="image/*" style="display: none;">
                        </div>
                    </div>
                    <div class="row displayImageOD imageOfDescription`+ count +`" style="margin-bottom: 0.5rem;
                    border-bottom: 1px solid black;
                    padding-bottom: 0.5rem;">
                        <span style="font-weight: 900; font-size: 1.2rem;">Chưa có ảnh nào của đoạn `+ count +`.</span>
                    </div>
                </div>
            `;
            document.querySelector('.displayImageOfDescription').insertAdjacentHTML('beforeend', newHtml2);

            subUploadImageForDescription();
        }
    });

    btnDeleteContentDescription.addEventListener('click', function(e) {
        e.preventDefault();
        if(count >= 2) {
            count = count - 1;
            let subBigFormGroup = document.querySelectorAll('.sub-big-form-group');
            subBigFormGroup[subBigFormGroup.length-1].remove();

            let rowImageOfDescription = document.querySelectorAll('.rowImageOfDescription');
            rowImageOfDescription[rowImageOfDescription.length-1].remove();
        }
    });
}


// ===>>> function thêm xóa category 
function addAndRemoveCategory() {
    let chooseCategoryProduct = document.querySelector('.choose-category-product');
    // let displaySpanProductCategory = document.querySelectorAll('.displaySpanProductCategory');
    chooseCategoryProduct.addEventListener('change', function() {
        const customProductCategory = document.querySelector('.custom-product-category');
        let name_category_product = chooseCategoryProduct.options[chooseCategoryProduct.selectedIndex].getAttribute('name_category_product');
        let id_category_product = chooseCategoryProduct.options[chooseCategoryProduct.selectedIndex].getAttribute('id_category_product');
        // console.log(id_category_product + ': ' + name_category_product);
        if(id_category_product != 0) {
            if(customProductCategory.children.length > 1) {
                let displaySpanProductCategory = document.querySelectorAll('.display-span-product-category');
                let count = 0;
                    displaySpanProductCategory.forEach((item) => {
                        if(item.getAttribute('id_category_product') == id_category_product) {
                            count = count + 1;
                            // console.log(item.getAttribute('id_category_product') + ': ' + id_category_product + ' => ' + count);
                        } 
                    });
                    if(count > 0) {
                        displayToast('Có rồi Stupid Guy!');
                    } else {
                        let newHTML = `
                            <span class="product-category display-span-product-category" name_category_product="`+name_category_product+`" id_category_product="`+ id_category_product +`" style="background: rgb(221, 143, 201); border-radius: 20px; padding: 0.2rem 0.7rem; cursor: pointer;">
                                <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                                `+ name_category_product +`
                            </span>
                        `;
                        document.querySelector('.custom-product-category').insertAdjacentHTML('beforeend', newHTML);
                        deleteCategory();
                    }
            } else {
                let newHTML = `
                    <span class="product-category display-span-product-category" name_category_product="`+name_category_product+`" id_category_product="`+ id_category_product +`" style="background: rgb(221, 143, 201); border-radius: 20px; padding: 0.2rem 0.7rem; cursor: pointer;">
                        <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                        `+ name_category_product +`
                    </span>
                `;
                document.querySelector('.custom-product-category').insertAdjacentHTML('beforeend', newHTML);
                deleteCategory();

            }
        }
    });
}
function deleteCategory() {
    let displaySpanProductCategory = document.querySelectorAll('.display-span-product-category');
    displaySpanProductCategory[displaySpanProductCategory.length-1].addEventListener('click', function(e) {
        e.currentTarget.remove();
    });
}
// function thêm xóa technology 
function addAndRemoveTechnology() {
    let chooseTechnologyProduct = document.querySelector('.choose-technology-product');
    // let displaySpanProductCategory = document.querySelectorAll('.displaySpanProductCategory');
    chooseTechnologyProduct.addEventListener('change', function() {
        const customProductTechnology = document.querySelector('.custom-product-topics');
        let name_tech_sound_product = chooseTechnologyProduct.options[chooseTechnologyProduct.selectedIndex].getAttribute('name_tech_sound_product');
        let id_tech_sound_product = chooseTechnologyProduct.options[chooseTechnologyProduct.selectedIndex].getAttribute('id_tech_sound_product');
        // console.log(id_category_product + ': ' + name_category_product);
        if(id_tech_sound_product != 0) {
            if(customProductTechnology.children.length > 1) {
                let displaySpanProductTechnolgy = document.querySelectorAll('.display-span-product-technology');
                let count = 0;
                displaySpanProductTechnolgy.forEach((item) => {
                        if(item.getAttribute('id_tech_sound_product') == id_tech_sound_product) {
                            count = count + 1;
                        } 
                    });
                    if(count > 0) {
                        displayToast('Có rồi Stupid Guy!');
                    } else {
                        let newHTML = `
                            <span class="product-technology display-span-product-technology" name_tech_sound_product="`+name_tech_sound_product+`" id_tech_sound_product="`+ id_tech_sound_product +`" style="background: rgb(221, 143, 201); border-radius: 20px; padding: 0.2rem 0.7rem; cursor: pointer;">
                                <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                                `+ name_tech_sound_product +`
                            </span>
                        `; 
                        document.querySelector('.custom-product-topics').insertAdjacentHTML('beforeend', newHTML);
                        deleteTechnology();
                    }
            } else {
                let newHTML = `
                    <span class="product-technology display-span-product-technology" name_tech_sound_product="`+name_tech_sound_product+`" id_tech_sound_product="`+ id_tech_sound_product +`" style="background: rgb(221, 143, 201); border-radius: 20px; padding: 0.2rem 0.7rem; cursor: pointer;">
                        <i class="fa fa-times" aria-hidden="true" style="margin-right: 0.1rem;"></i>
                        `+ name_tech_sound_product +`
                    </span>
                `;
                document.querySelector('.custom-product-topics').insertAdjacentHTML('beforeend', newHTML);
                deleteTechnology();
            }
        }
    });
}
function deleteTechnology() {
    let displaySpanProductTechnology = document.querySelectorAll('.display-span-product-technology');
    displaySpanProductTechnology[displaySpanProductTechnology.length-1].addEventListener('click', function(e) {
        e.currentTarget.remove();
    });
}


// ===>>  function thêm sản phẩm mới add product
function addProduct() {

    let btn_add_new_product = document.querySelector('.btn_add_new_product');
    btn_add_new_product.addEventListener('click', function(e) {
        e.preventDefault();

        // name product
        let name_product = document.getElementById('name_product').value;
        // brand
        let productBrand = document.querySelector('.product-brand');
        let id_brand_product = productBrand.options[productBrand.selectedIndex].getAttribute('id_brand_product');
        let name_brand_product = productBrand.options[productBrand.selectedIndex].getAttribute('name_brand_product');
        // category
        let listCategory = [];
        let productCategory = document.querySelectorAll('.display-span-product-category');
        productCategory.forEach(item => {
            let subListCategory = new Object();
            subListCategory.id_category_product = item.getAttribute('id_category_product');
            subListCategory.name_category_product = item.getAttribute('name_category_product');

            listCategory[listCategory.length] = subListCategory;
        });
        // technology
        let listTechnology = [];
        let productTechnology= document.querySelectorAll('.display-span-product-technology');
        productTechnology.forEach(item => {
            let subListTechnology = new Object();
            subListTechnology.id_tech_sound_product = item.getAttribute('id_tech_sound_product');
            subListTechnology.name_tech_sound_product = item.getAttribute('name_tech_sound_product');

            listTechnology[listTechnology.length] = subListTechnology;
        });
        // list descript product
        let listDescriptionProduct = [];
        let subBigFormGroup = document.querySelectorAll('.sub-big-form-group');
        subBigFormGroup.forEach((item) => {
            let subListDescriptionProduct = new Object();
            subListDescriptionProduct.titleDescription = item.querySelector('.titleDescription').value;
            subListDescriptionProduct.contentDescription = item.querySelector('.contentDescription').value;
            listDescriptionProduct[listDescriptionProduct.length] = subListDescriptionProduct;
        });

        // list multi image of Product
        let listFileImage = [];
        let multiFileImages = document.querySelector('.multiFileImages');
        let files = multiFileImages.files;
        let count = 0;
        for(let file of files) {
            listFileImage[listFileImage.length] = new File([file],`imageProduct_file${count}${file.name.split('.')[0]}.${file.type.split('/')[1]}`,{
            type:file.type,lastModified:file.lastModified});
            count = count + 1;
        }
        //list sub product
        let listSubProduct = [];
        let rowBorderSubProduct = document.querySelectorAll('.row-border-sub-product');
        rowBorderSubProduct.forEach(item => {
            let subListSubProduct = new Object();
            subListSubProduct.id_color_product = item.querySelector('.choose-display-product-color').options[item.querySelector('.choose-display-product-color').selectedIndex].getAttribute('id_color_product');
            subListSubProduct.value_color_product = item.querySelector('.choose-display-product-color').options[item.querySelector('.choose-display-product-color').selectedIndex].getAttribute('value_color_product');

            subListSubProduct.id_plug_product = item.querySelector('.choose-display-product-plug').options[item.querySelector('.choose-display-product-plug').selectedIndex].getAttribute('id_plug_product');
            subListSubProduct.value_plug_product = item.querySelector('.choose-display-product-plug').options[item.querySelector('.choose-display-product-plug').selectedIndex].getAttribute('value_plug_product');

            subListSubProduct.quantity_product_has = item.querySelector('.quantity_product_has').value;
            subListSubProduct.root_price_product = item.querySelector('.root_price_product').value;



            listSubProduct[listSubProduct.length] = subListSubProduct;
        });
        // list sub image color product 
        let listSubImageColorProduct = [];
        let fileImageSubProductColor = document.querySelectorAll('.file_image_sub_product_color');
        fileImageSubProductColor.forEach((item)=>{
            let filesD = item.files;
            let count = 0;
            for(let fileD of filesD) {
                listSubImageColorProduct[listSubImageColorProduct.length] = new File([fileD],`subProductColor_file${count+1}${fileD.name}`,{
                    type:fileD.type,lastModified:fileD.lastModified});
                    count = count + 1;
            }
        })



        // check_Array_Object_Description_Product(listDescriptionProduct);
        check_Array_Object_Sub_Product(listSubProduct, listSubImageColorProduct);
        remove_Element_Same_List_Sub_Product(listSubProduct, listSubImageColorProduct);

        let listDescriptImage = [];
        let multiDescriptImages = document.querySelectorAll('.multiDescriptImages');
        multiDescriptImages.forEach((item,idx)=>{
            let filesD = item.files;
            let count = 0;
            for(let fileD of filesD) {
                listDescriptImage[listDescriptImage.length] = new File([fileD],`mota${idx+1}_file${count+1}${fileD.name}`,{
                    type:fileD.type,lastModified:fileD.lastModified});
                    count = count + 1;
            }
        })

        console.log(listSubImageColorProduct);


        if(name_product == '' ){
            displayToast('Tên Sản Phẩm Không Được Để Trống');
        }
        else if(name_brand_product == '' || name_brand_product == 'null') {
            displayToast('Thương Hiệu Sản Phẩm Không Được Để Trống');
        }
        else if(listCategory.length == 0 ) {
            displayToast('Danh sách Thể Loại Không Được Để Trống');
        }
        else if(listTechnology.length == 0) {
            displayToast('Danh sách Công Nghệ Không Được Để Trống');
        }
        else if(listDescriptionProduct.length == 0) {
            displayToast('Mô Tả Sản Phẩm Không Được Để Trống');
        }
        else if(listFileImage.length == 0) {
            displayToast('Ảnh Sản Phẩm Không Được Để Trống');
        }
        else if(listSubProduct.length == 0) {
            displayToast('Sản Phẩm Con Không Được Để Trống');
        } else {

            

            var form  = new FormData();
                form.append('name_product', name_product);
                form.append('id_brand_product', id_brand_product);

                form.append('listCategory', JSON.stringify(listCategory));
                form.append('listTechnology', JSON.stringify(listTechnology));

                form.append('listDescriptionProduct', JSON.stringify(listDescriptionProduct));
                
                for(let i = 0; i < listDescriptImage.length; i++) {
                    form.append('listDescriptImage'+i.toString(), listDescriptImage[i]);
                }
                for(let i = 0; i < listFileImage.length; i++) {
                    form.append('listFileImage'+i.toString(), listFileImage[i]);
                }
                for(let i = 0; i < listSubImageColorProduct.length; i++) {
                    form.append('listSubImageColorProduct'+i.toString(), listSubImageColorProduct[i]);
                }


                form.append('listSubProduct', JSON.stringify(listSubProduct));

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'add-new-product',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        window.location.href = 'add-product';
                    },
                    error: function() {
                        displayToast('Không Thêm được.');
                    }
                });

        }
    });
}
// xóa cacs mảng giống nhau trong sub product
function remove_Element_Same_List_Sub_Product(listSubProduct, listSubImageColorProduct) {
    for(let sublistSubProduct of listSubProduct) {
        let count = 0;
        let id_color_product = sublistSubProduct.id_color_product;
        let id_plug_product = sublistSubProduct.id_plug_product;
        for(let subSublistSubProduct of listSubProduct) {
            if(subSublistSubProduct.id_color_product == id_color_product && subSublistSubProduct.id_plug_product == id_plug_product)
            {
                count++;
                if(count == 2) {
                    listSubProduct.splice(listSubProduct.indexOf(subSublistSubProduct), 1);
                    listSubImageColorProduct.splice(listSubProduct.indexOf(subListSubProduct), 1);

                    remove_Element_Same_List_Sub_Product(listSubProduct);
                }
            }
        }
    }

};
function check_Array_Object_Sub_Product(listSubProduct, listSubImageColorProduct) {
    for(subListSubProduct of listSubProduct) {
        if(subListSubProduct.id_color_product == 0 || subListSubProduct.id_plug_product == 0) {
            listSubProduct.splice(listSubProduct.indexOf(subListSubProduct), 1);
            listSubImageColorProduct.splice(listSubProduct.indexOf(subListSubProduct), 1);
            check_Array_Object_Sub_Product(listSubProduct);
        }
    }
}




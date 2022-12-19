saveInformation();
comfirmOrder();
chooseDistrictWardStreet();
displayNewLocal();
applyCodeSale();
applyPayments();

import * as toolCart from '../cart/toolCart.js';    

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
    
        let exampleFormControlSelectProvince = document.getElementById('exampleFormControlSelectProvince');
        let exampleFormControlSelectDistrict = document.getElementById('exampleFormControlSelectDistrict');
        let exampleFormControlSelectWard = document.getElementById('exampleFormControlSelectWard');
        let exampleFormControlSelectStreet = document.getElementById('exampleFormControlSelectStreet');
        let numHouseFromYourLocal = document.getElementById('numHouseFromYourLocal');

        let Province = exampleFormControlSelectProvince.options[exampleFormControlSelectProvince.selectedIndex].value;
        let District = exampleFormControlSelectDistrict.options[exampleFormControlSelectDistrict.selectedIndex].value;
        let Ward = exampleFormControlSelectWard.options[exampleFormControlSelectProvince.selectedIndex].value;
        let Street = exampleFormControlSelectStreet.options[exampleFormControlSelectStreet.selectedIndex].value;
        let numHouse = numHouseFromYourLocal.value;
        
        if(numHouse == '') {
            displayToast('Không được để trống, thì ghi không.');
        } else {
        
            var form = new FormData();
            form.append('newInfo', JSON.stringify({
                nameFromYourLocal,
                localFromYourLocal,
                emailFromYourLocal,
                phoneFromYourLocal,

                Province,
                District,
                Ward,
                Street,
                numHouse

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
        }
    });
}

function comfirmOrder() {
    let btnBtnBlockBtnOutlinePrimaryBtnLg = document.getElementById('btnBtnBlockBtnOutlinePrimaryBtnLg');
    btnBtnBlockBtnOutlinePrimaryBtnLg.addEventListener("click", function(e) {
        
    
        // let phiVanChuyen = document.querySelector('.phiVanChuyen').textContent;
        let giamGia = document.querySelector('.giamGia').textContent;
        let phiVanChuyen =document.querySelector('.phiVanChuyen').textContent;
        let hinhThucThanhToan = document.querySelector('.way-payment').value;
        let diachiDonHang = document.getElementById('localFromYourLocal').value;
        console.log(giamGia + " " + phiVanChuyen + ", " + hinhThucThanhToan + ", " + diachiDonHang);

        if(hinhThucThanhToan == '') {
            displayToast('Không được để trống Hình Thức Thanh Toán');
        } else {
            var form = new FormData();
            form.append('newData', JSON.stringify({
                giamGia,
                phiVanChuyen,
                hinhThucThanhToan,
                diachiDonHang
            }));
            // let's start Ajax
            let xhr = new XMLHttpRequest(); // creating XML object 
            xhr.onload = () => {
                if(xhr.readyState === XMLHttpRequest.DONE) {
                    if(xhr.status === 200) {
                        window.location.href = '/payment/returnView';
                        console.log(xhr.responseText);
                    }
                }
            }
            xhr.open("POST", "/payment/comfirmOrder", true);
            xhr.setRequestHeader('X-CSRF-TOKEN',document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.send(form);
        }
    
    });
}

function chooseDistrictWardStreet() {

    let exampleFormControlSelectProvince = document.getElementById('exampleFormControlSelectProvince');
    exampleFormControlSelectProvince.addEventListener('click', function(ev) {
        // let exampleFormControlSelectProvince = document.getElementById('exampleFormControlSelectProvince');
        let name_Province = exampleFormControlSelectProvince.options[exampleFormControlSelectProvince.selectedIndex].value;
        let id_Province = exampleFormControlSelectProvince.options[exampleFormControlSelectProvince.selectedIndex].getAttribute('data-Province');
            
        $.ajax({
            url: '/payment/loadDistrictFromProvince',
            method: 'get',
            data: {
                // _token: _token,
                id_Province: id_Province,
                name_Province: name_Province
            },
            success: function(data) {
                // load_cart();
                console.log(data);

                let exampleFormControlSelectDistrict = document.getElementById('exampleFormControlSelectDistrict');
                exampleFormControlSelectDistrict.innerHTML = data;
            },
            error: function() {
                alert("Lỗi k upload được :<<");
            }
        });

    });

    let exampleFormControlSelectDistrict = document.getElementById('exampleFormControlSelectDistrict');
    exampleFormControlSelectDistrict.addEventListener('click', function() {
        
        let exampleFormControlSelectProvince = document.getElementById('exampleFormControlSelectProvince');
        let id_Province = exampleFormControlSelectProvince.options[exampleFormControlSelectProvince.selectedIndex].getAttribute('data-Province');

        let name_District = exampleFormControlSelectDistrict.options[exampleFormControlSelectDistrict.selectedIndex].value;
        let id_District = exampleFormControlSelectDistrict.options[exampleFormControlSelectDistrict.selectedIndex].getAttribute('data-District');

        $.ajax({
            url: '/payment/loadWardFromDistrict',
            method: 'get',
            data: {
                // _token: _token,
                name_District: name_District,
                id_District: id_District,
                id_Province: id_Province

            },
            success: function(data) {
                // load_cart();
                console.log(data);

                let exampleFormControlSelectWard = document.getElementById('exampleFormControlSelectWard');
                exampleFormControlSelectWard.innerHTML = data;
            },
            error: function() {
                alert("Lỗi k upload được :<<");
            }
        });

    });

    let exampleFormControlSelectWard = document.getElementById('exampleFormControlSelectWard');
    exampleFormControlSelectWard.addEventListener('click', function() {
    
        let exampleFormControlSelectProvince = document.getElementById('exampleFormControlSelectProvince');
        let id_Province = exampleFormControlSelectProvince.options[exampleFormControlSelectProvince.selectedIndex].getAttribute('data-Province');

        let name_District = exampleFormControlSelectDistrict.options[exampleFormControlSelectDistrict.selectedIndex].value;
        let id_District = exampleFormControlSelectDistrict.options[exampleFormControlSelectDistrict.selectedIndex].getAttribute('data-District');

        $.ajax({
            url: '/payment/loadStreetFromDistrict',
            method: 'get',
            data: {
                // _token: _token,
                name_District: name_District,
                id_District: id_District,
                id_Province: id_Province

            },
            success: function(data) {
                // load_cart();
                console.log(data);

                let exampleFormControlSelectStreet = document.getElementById('exampleFormControlSelectStreet');
                exampleFormControlSelectStreet.innerHTML = data;
            },
            error: function() {
                alert("Lỗi k upload được :<<");
            }
        });
    
    });
}

function displayNewLocal() {
    let numHouseFromYourLocal = document.getElementById('numHouseFromYourLocal');
    numHouseFromYourLocal.addEventListener('keyup', function() {
        
        let exampleFormControlSelectProvince = document.getElementById('exampleFormControlSelectProvince');
        let exampleFormControlSelectDistrict = document.getElementById('exampleFormControlSelectDistrict');
        let exampleFormControlSelectWard = document.getElementById('exampleFormControlSelectWard');
        let exampleFormControlSelectStreet = document.getElementById('exampleFormControlSelectStreet');
        

        let localFromYourLocal = document.getElementById('localFromYourLocal');
        localFromYourLocal.value = numHouseFromYourLocal.value + ', ' + exampleFormControlSelectProvince.options[exampleFormControlSelectProvince.selectedIndex].value + ', ' + exampleFormControlSelectDistrict.options[exampleFormControlSelectDistrict.selectedIndex].value + ', ' + exampleFormControlSelectWard.options[exampleFormControlSelectProvince.selectedIndex].value + ', ' + exampleFormControlSelectStreet.options[exampleFormControlSelectStreet.selectedIndex].value;
        // let numHouse = numHouseFromYourLocal.target.getText();

        console.log(numHouseFromYourLocal.value + ', ' + exampleFormControlSelectProvince.options[exampleFormControlSelectProvince.selectedIndex].value + ', ' + exampleFormControlSelectDistrict.options[exampleFormControlSelectDistrict.selectedIndex].value + ', ' + exampleFormControlSelectWard.options[exampleFormControlSelectWard.selectedIndex].value + ', ' + exampleFormControlSelectStreet.options[exampleFormControlSelectStreet.selectedIndex].value);

    });
}

function applyCodeSale() {

    let btnApplyCodeSale = document.getElementById('btnApplyCodeSale');
    btnApplyCodeSale.addEventListener('click', function() {

        // console.log();
        let codeSale = $('#displayCodeSale').val();
        let TongCong = $('.TongCong').text();

        $.ajax({
            url: '/payment/loadCodeSale',
            method: 'get',
            data: {
                // _token: _token,
                codeSale: codeSale,
                TongCong: TongCong

            },
            success: function(data) {
                // load_cart();
                $('.giamGia').text(data);

                // console.log("Tong cong: " + $('.TongCong').text());
                // console.log("sau khi doi: " + $('.TongCong').text().replace(/\s+/g, ''));


                let newTotal = parseInt($('.TongCong').text().replaceAll('.', '')) - data;

                $('.TongCong').text(Intl.NumberFormat('de-DE').format(newTotal));
                // console.log( Intl.NumberFormat('de-DE').format(newTotal) + 'đay la key qua');

                $('#displayCodeSale').prop('disabled', 'true');
                btnApplyCodeSale.disabled = true;
            },
            error: function() {
                alert("Lỗi k load Code Sale được :<<");
            }
        });



        
    });
}

function applyPayments() {

    $('.applyChoosePayments').click(function(e) {
        let name_payment = $(this).attr('data-bank');
        $('.way-payment').val(name_payment);

        let id_Bank = $(this).attr('id_Bank');

        $.ajax({
            url: '/payment/loadDataBank',
            method: 'get',
            data: {
                id_Bank: id_Bank
            },
            success: function(data) {
                $('.card-items-visa').css("background-image", 'url(' + data.image_background_bank + ')');
                $('.number_Bank').text(data.number_Bank);
                $('.name_user_Bank').text(data.name_user_Bank);
            },
            error: function() {
                alert("Lỗi hiển thị được :<<");
            }
        });

    });

}


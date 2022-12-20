import socket from '../js/adminAD.js';
// import * as toolProfile from '../../js/profile/toolProfile.js';



socket.on('Khách hàng đã gửi tin nhắn', data => {
    console.log(data);
    loadTextMess( data.value_mess , false);
});



let id_account = document.querySelector('.btn-send-mess-from-admin').getAttribute('id_account');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
    url:  '/admin/chat/load-chat/'+ id_account,
    method: 'get',
    data: '',
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function(data) {

        console.log(data);
        data.forEach(element => {
            if(element.id_send != 0) {
                loadTextMess( new ValueMess({text: element.mess_text?element.mess_text:'', image: element.mess_image?[element.mess_image]:[] }) , false);
            } else {
                loadTextMess( new ValueMess({text: element.mess_text?element.mess_text:'', image: element.mess_image?[element.mess_image]:[] }) , true);
                
            }
        });


    },
    error: function() {
        console.log('load k được');
    }
});       












let btnSendMessFromAdmin = document.querySelector('.btn-send-mess-from-admin');
btnSendMessFromAdmin.addEventListener('click', function(e) {
        
    let data_mess = e.currentTarget.closest('.footer-chat').querySelector('.input-admin-mess').value;
    let id_account = e.currentTarget.getAttribute('id_account');
    var form = new FormData();

    form.append('data_mess', data_mess);
    form.append('id_account', id_account);


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:  '/admin/chat/save-chat',
        method: 'post',
        data: form,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
            console.log(data);
        },
        error: function() {
            console.log('load gửi được');
        }
    });  

    socket.emit('Admin gửi tin nhắn', {value_mess: new ValueMess({text: data_mess})});
    loadTextMess( new ValueMess({text: data_mess}) , true);

    e.currentTarget.closest('.footer-chat').querySelector('.input-admin-mess').value = '';
});

function loadTextMess(ValueMess, isMe) {
    console.log(ValueMess);
    if(isMe == false) {
        Object.entries(ValueMess).map((el) => {
            let html = '';
            if (el[1].length > 0 && typeof el[1].length !== undefined) {
                switch (el[0]) {
                    case "image":
                        html += `
                            ${el[1].map(elm=>{
                                return `
                                <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:22 pm">
                                    <a class="float-left sohbet2">
                                        <img class="card-img-top img-fluid w-100" src="${elm}" alt="">
                                    </a>
                                </div>
                                `
                            })}
                        `;
    
                        break;
                    case "video":
                        html += `
                            ${
                                el[1].map(elm=>{
                                    return `
                                    <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:22 pm">
                                        <a class="float-left sohbet2">
                                            <img class="card-img-top img-fluid w-100" src="${elm}" alt="">
                                        </a>
                                    </div>
                                    `
                                })
                            }
                            
                        `;
                        break;
                    case 'text':
                        html+=
                            `
                            <div class="balon2 p-2 m-0 position-relative" data-is="Yusuf - 3:26 pm">
                                <a class="float-left sohbet2"> ${el[1]}</a>
                            </div>
                            
                            `
                        break;
                    default:
                        html = "";
                }
            }

            document.querySelector('#sohbet').insertAdjacentHTML('beforeend', html);
            
        });
    } else {
        Object.entries(ValueMess).map((el) => {
            let html = '';
            if (el[1].length > 0 && typeof el[1].length !== undefined) {
                switch (el[0]) {
                    case "image":
                        html += `
                            ${el[1].map(elm=>{
                                return `
                                <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:20 pm">
                                    <a class="float-right">
                                        <img class="card-img-top img-fluid w-100" src="${elm}" alt="">
                                    </a>
                                </div>
                                `
                            })}
                        `;
    
                        break;
                    case "video":
                        html += `
                            ${
                                el[1].map(elm=>{
                                    return `
                                    <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:20 pm">
                                        <a class="float-right">
                                            <img class="card-img-top img-fluid w-100" src="${elm}" alt="">
                                        </a>
                                    </div>
                                    `
                                })
                            }
                            
                        `;
                        break;
                    case 'text':
                        html+=
                            `
                            <div class="balon1 p-2 m-0 position-relative" data-is="You - 3:20 pm">
                                <a class="float-right"> ${el[1]}</a>
                            </div>
                            `
                        break;
                    default:
                        html = "";
                }
            }

            document.querySelector('#sohbet').insertAdjacentHTML('beforeend', html);
            
        });
    }
}






function ValueMess({ text = "", video = [], image = [] }) {
    this.image = image;
    this.video = video;
    this.text = text;
}
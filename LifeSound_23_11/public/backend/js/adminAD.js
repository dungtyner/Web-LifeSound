// Toggle the side navigation
$("#sidenavToggler").click(function(e) {
    e.preventDefault();
    $("body").toggleClass("sidenav-toggled");
    $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
    $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
});

// pagination notification


// proccess socket 
const socket = io('http://localhost:2306',{ transports : ['websocket'] });
export default socket;

socket.on('Khách hàng đã gửi tin nhắn', data => {
    console.log(data.data_account);
    loadNotificationMessage( data.data_account);
});

function loadNotificationMessage(data_account) {
    document.querySelector('.status_mess').style.display = 'inline-block';
    if(document.querySelector('#messagesDropdown').getAttribute('aria-expanded') == 'true') {
        document.querySelector('.status_mess').style.display = 'none';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:  '/admin/chat/load-chat-notification',
            method: 'get',
            data: '',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                
                console.log(data);
                document.querySelector('.big_mess_notification').innerHTML = ``;
                let html = '';
                data.forEach(element => {
                    html += `
                        <a class="dropdown-item" href="/admin/chat/show-chat/${element.id_send}" style="width: 350px;">
                            <strong>${element.nameAccount}</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">
                                ${element.lastMess}
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    `;
                });
    
    
                document.querySelector('.big_mess_notification').insertAdjacentHTML('afterbegin', html);
            },
            error: function() {
                console.log('load k được');
            }
        }); 
    }
}

let messagesDropdown = document.querySelector('#messagesDropdown');
messagesDropdown.addEventListener('click', function(e) {
    if(e.currentTarget.getAttribute('aria-expanded') == 'false') {
        document.querySelector('.status_mess').style.display = 'none';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:  '/admin/chat/load-chat-notification',
            method: 'get',
            data: '',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {
                
                console.log(data);
                document.querySelector('.big_mess_notification').innerHTML = ``;
                let html = '';
                data.forEach(element => {
                    html += `
                        <a class="dropdown-item" href="/admin/chat/show-chat/${element.id_send}" style="width: 350px;">
                            <strong>${element.nameAccount}</strong>
                            <span class="small float-right text-muted">11:21 AM</span>
                            <div class="dropdown-message small">
                                ${element.lastMess}
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    `;
                });
    
    
                document.querySelector('.big_mess_notification').insertAdjacentHTML('afterbegin', html);
            },
            error: function() {
                console.log('load k được');
            }
        }); 
    }

});










function displayToast(mess) {
    document.querySelector('.toast .text.text-2').textContent = mess;
    document.querySelector('.toast').classList.add('active');
    document.querySelector('.progress').classList.add('active');


    let time = setTimeout(() => {
        document.querySelector('.toast').classList.remove("active");
        document.querySelector('.progress').classList.remove("active");
    }, 5000); //1s = 1000 milliseconds

    document.querySelector(".toast .close").addEventListener("click", () => {
        document.querySelector('.toast').classList.remove("active");
        
        setTimeout(() => {
            document.querySelector('.progress').classList.remove("active");
        }, 300);

        clearTimeout(time);
    });
}




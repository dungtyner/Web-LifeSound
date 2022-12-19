

// -- Area Chart Example
function AreaChart() {

    var timeDates = Array.from(Array(10).keys());
    timeDates =timeDates.map((timeDate,idx)=>{
        var now = new Date();
        now.setDate(now.getDate()-idx)
        return now.toLocaleDateString();
    })

    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timeDates.slice(-1*10),
            datasets: [{
                label: "Tổng Số Tiền 10 Ngày Gần Nhất",
                lineTension: 0.3,
                backgroundColor: "rgba(2,117,216,0.2)",
                borderColor: "rgba(2,117,216,1)",
                pointRadius: 5,
                pointBackgroundColor: "rgba(2,117,216,1)",
                pointBorderColor: "rgba(255,255,255,0.8)",
                pointHoverRadius: 5,
                pointHoverBackgroundColor: "rgba(2,117,216,1)",
                pointHitRadius: 20,
                pointBorderWidth: 2,
                data: [10000, 30162, 26263, 18394, 18287, 28682, 31274, 33259, 25849, 24159]
            }],
        },
        options: {
            scales: {
                
            },
            legend: {
                display: false
            }
        }
    });
}
// -- Bar Chart Example
function BarChart(list_charts_product) {

    var ctx = document.getElementById("myBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: list_charts_product.nameProduct,
                datasets: [{
                    label: "Top Sản Phẩm Bán Chạy",
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    // data: list_charts_product.topProduct.count,
                    data: list_charts_product.topProduct.map(el=>{return el.count}),
                    borderWidth: 1
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            callback: function(value) {
                                if (value.length > 4) {
                                    return value.substr(0, 4) + '...'; //truncate
                                } else {
                                    return value
                                }
                            },
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                },
                tooltips: {
                    enabled: true,
                    mode: 'label',
                    callbacks: {
                        title: function(tooltipItems, data) {
                            var idx = tooltipItems[0].index;
                            return 'Sản Phẩm:' + data.labels[idx]; //do something with title
                        },
                        
                    }
                },
                legend: {
                    display: false
                }
            }
    });
}
// -- Pie Chart Example
function PieChart(delivery, process, cancel, success) {
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Đang giao hàng", "Đã hủy", "Đang xử lý", "Giao hàng thành công"],
            datasets: [{
                data: [delivery, cancel, process, success],
                backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
            }],
        },
    });
}











//  -- Load notification dashboard
function loadNotificationDashBoard(dataForum, dataPage, numPage_now) {
    let all_notification_content = document.querySelector('.all_notification_content');
    let result_code = '';

    let all_pagination_border = document.querySelector('.all_pagination_border');
    let html_page = '';
    for(let i = 1; i <= dataPage; i++) {
        html_page = html_page + '<li class="page-item"><a class="page-link total_page" page="' + i +'">' + i +'</a></li>';
    }
    all_pagination_border.innerHTML = html_page;

    if(numPage_now == null) {
        numPage_now = 1;
    }

    document.querySelector('.show_all_notification_content').innerHTML='';
    let listData = dataForum.slice((numPage_now-1)*5, 5*(numPage_now));
    listData.forEach(el => {
        if(el.notification_type == 'notification_admin_order') {
            result_code =  `
                <a class="list-group-item list-group-item-action">
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="${el.notification_avt}" class="rounded-circle"  width="45" height="45" alt="">
                        <div class="media-body">
                            <strong class="text-success">${el.notification_title}</strong><br>
                            <strong>${el.notification_content}</strong>.
                            <div class="text-muted smaller">${el.notification_date}</div>
                        </div>
                    </div>
                </a>
            `
            document.querySelector('.show_all_notification_content').insertAdjacentHTML('beforeend', result_code);
        } else if(el.notification_type == 'notification_admin_cancel_order') {
            result_code =  `
                <a class="list-group-item list-group-item-action" >
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="${el.notification_avt}" class="rounded-circle"  width="45" height="45" alt="">
                        <div class="media-body">
                            <strong class="text-danger">${el.notification_title}</strong><br>
                            <strong>${el.notification_content}</strong>.
                            <div class="text-muted smaller">${el.notification_date}</div>
                        </div>
                    </div>
                </a>
            `
            document.querySelector('.show_all_notification_content').insertAdjacentHTML('beforeend', result_code);

        } else if(el.notification_type == 'notification_admin_comment') {
            result_code =  `
                <a class="list-group-item list-group-item-action" data-toggle="collapse" href="#id_comment${el.id_comment}">
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="${el.notification_avt}" class="rounded-circle"  width="45" height="45" alt="">
                        <div class="media-body">
                            <strong class="text-info">${el.notification_title}</strong><br>
                            <strong>${el.notification_content}</strong>.
                            <div class="text-muted smaller">${el.notification_date}</div>
                        </div>
                    </div>
                </a>

                <div class="collapse" id="id_comment${el.id_comment}">  
                    <div class="card mb-3">
                        <a href="#">
                            <img class="card-img-top img-fluid w-100" src="${el.products.img.url_img_product}" alt="">
                        </a>
                        <div class="card-body">
                            <h6 class="card-title mb-1"><a class="text-LifeSound">${el.products.name_product}</a></h6>
                            <p class="card-text small">
                                ${el.products.shortIntro.title_description.substring(0, 40)}...
                            </p>
                        </div>
                        <hr class="my-0">
                        <div class="card-body py-2 small">
                            <a class="mr-3 d-inline-block text-danger">
                                <i class="fa fa-fw fa-heart"></i>
                                ${el.count_product_loved}
                            </a>
                            <a class="mr-3 d-inline-block text-primary">
                                <i class="fa fa-fw fa-comment "></i>
                                ${el.count_commnent}
                            </a>
                            <a class="d-inline-block text-success">
                                <i class="fa fa-fw fa fa-money "></i>
                                ${el.products.price.root_price_product.toLocaleString()}
                            </a>
                        </div>
                        <hr class="my-0">
                        <div class="card-body small bg-faded">
                            <div class="media">
                                <img class="d-flex mr-3 rounded-circle" src="${el.url_avatar_account}" width="45" height="45" alt="">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1"><a class="text-LifeSound">${el.name_customer}</a></h6>
                                        ${el.comment.content_comment}
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a class="text-LifeSound" href="#">Trả lời</a>
                                        </li>
                                    </ul>

                                    ${el.url_image_comment ?
                                        `<img class="card-img-top img-fluid w-100" src="${el.url_image_comment.url_image_comment}" alt="">` 
                                    :``}

                                    ${el.comment_admin_reply ?
                                        el.comment_admin_reply.map(element => {
                                            return `
                                                <div class="media mt-3">
                                                    <a class="d-flex pr-3" href="#">
                                                        <img src="${element.avt_admin_reply}" class="rounded-circle"  width="45" height="45" alt="">
                                                    </a>
                                                    <div class="media-body">
                                                        <h6 class="mt-0 mb-1"><a class="text-LifeSound">Life Sound</a></h6>
                                                        ${element.content_reply}
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item">
                                                                <a class="text-LifeSound" href="#">${element.date_reply}</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            `;
                                        })
                                        .join("")
                                    :``}

                                </div>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control input-LifeSound" placeholder="Trả lời khách hàng" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-LifeSound" id_comment="${el.id_comment}" id_account="${el.comment.id_account}" type="button">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `
            document.querySelector('.show_all_notification_content').insertAdjacentHTML('beforeend', result_code);

        }
    });

    let total_page = all_pagination_border.querySelectorAll('.total_page');
    total_page.forEach(item => {
        item.addEventListener('click', function(e) {
            document.querySelector('.show_all_notification_content').innerHTML='';
            page = e.currentTarget.getAttribute('page');
            loadNotificationDashBoard(dataForum, dataPage, page);
        });
    });

    // reply customer
    let btnOutlineLifeSound = document.querySelector('.show_all_notification_content').querySelectorAll('.btn-outline-LifeSound');
    btnOutlineLifeSound.forEach(item => {
        item.addEventListener('click', function(e) {
            let content_reply = e.currentTarget.closest('.input-group.mb-3').querySelector('.input-LifeSound').value;
            let id_account = e.currentTarget.getAttribute('id_account');
            let id_comment = e.currentTarget.getAttribute('id_comment');
            e.currentTarget.closest('.input-group.mb-3').querySelector('.input-LifeSound').value= '';


            if(content_reply == '') {
                displayToast('Không được để trống ?!');
            } else {
                var form  = new FormData();
                form.append('id_comment', id_comment);
                form.append('id_account', id_account);
                form.append('content_reply', content_reply);

        
            
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:  '/admin/dashboard/comment-reply',
                    method: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(data) {
                        console.log(numPage_now);
                        console.log(data);
                        loadNotificationDashBoard(data.listDataForum, data.total_page, numPage_now);
                    },
                    error: function() {
                        displayToast('Không Bình Luận Được.');
                    }
                });       
            }
        });
    });
    


}

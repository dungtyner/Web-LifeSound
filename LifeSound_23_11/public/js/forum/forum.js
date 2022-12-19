import * as toolProduct from "../products/toolProduct.js";









// click display product 
let reply_comment = document.querySelectorAll('.reply_comment');
if(reply_comment.length != 0) {
    reply_comment.forEach(item => {
        item.addEventListener('click', function(e) {
            toolProduct.getDataDetail(e.currentTarget.getAttribute('id_product'));
        });
    })
}

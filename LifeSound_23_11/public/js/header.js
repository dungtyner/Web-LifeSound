openFaBars();
openLeftMoreIcon();
openSearchProduct();
// openCartForm();


function openFaBars() {
    let openFaBars = document.querySelector('.icon-menu-more .fa-solid.fa-bars');
    openFaBars.addEventListener("click", function () {
        let headerShowResponsive = document.querySelector('.header-show-responsive');
        headerShowResponsive.style.display = 'flex';

        let iconMenuMore = document.querySelector('.icon-menu-more');
        iconMenuMore.innerHTML = '<i class="fa-solid fa-xmark"></i>';


        closeFaXmark();
    });


}

function closeFaXmark() {
    let closeFaXmark = document.querySelector('.icon-menu-more .fa-solid.fa-xmark');
    closeFaXmark.addEventListener("click", function () {
        let headerShowResponsive = document.querySelector('.header-show-responsive');
        headerShowResponsive.style.display = 'none';

        let iconMenuMore = document.querySelector('.icon-menu-more');
        iconMenuMore.innerHTML = '<i class="fa-solid fa-bars"></i>';

        openFaBars();
    });
}



function openLeftMoreIcon() {
    let openLeftMoreIcon = document.querySelector('.zoom-left-left .fa-solid.fa-angles-left');
    openLeftMoreIcon.addEventListener("click", function () {

        let headerShowLeftResponsive = document.querySelector(".header-show-left-responsive");
        headerShowLeftResponsive.style.width = '220px';
        headerShowLeftResponsive.style.animation = 'displayLeft ease-in 0.5s';

        let threeMoreItem = document.querySelector(".three-more-item");
        threeMoreItem.style.display = "flex";

        let zoomLeftMoreItemZoomLeftLeft = document.querySelector(".zoom-left-more-item.zoom-left-left");
        zoomLeftMoreItemZoomLeftLeft.innerHTML = '<i class="fa-solid fa-angles-right"></i>';

        closeLeftMoreIcon();
    });


}

function closeLeftMoreIcon() {
    let closeLeftMoreIcon = document.querySelector('.zoom-left-left .fa-solid.fa-angles-right');
    closeLeftMoreIcon.addEventListener("click", function () {

        let headerShowLeftResponsive = document.querySelector(".header-show-left-responsive");
        headerShowLeftResponsive.style.width = '60px';

        let threeMoreItem = document.querySelector(".three-more-item");
        threeMoreItem.style.display = "none";

        let zoomLeftMoreItemZoomLeftLeft = document.querySelector(".zoom-left-more-item.zoom-left-left");
        zoomLeftMoreItemZoomLeftLeft.innerHTML = '<i class="fa-solid fa-angles-left"></i>';

        openLeftMoreIcon();
    });


}

function openSearchProduct() {

    let openSearchProduct = document.querySelectorAll(".click-form-search");
    openSearchProduct.forEach((event) => {
        event.addEventListener("click", function () {

            let searchContentData = document.querySelector(".search-content-data");
            searchContentData.style.display = "flex";

            closeSearchProduct();
        });
    });

}

function closeSearchProduct() {
    let closeSearchProduct = document.querySelector(".close-contetn-data");
    closeSearchProduct.addEventListener("click", function () {
        let searchContentData = document.querySelector(".search-content-data");
        searchContentData.style.display = "none";
        openSearchProduct();
    });


}




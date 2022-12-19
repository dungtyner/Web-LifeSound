// Toggle the side navigation
$("#sidenavToggler").click(function(e) {
    e.preventDefault();
    $("body").toggleClass("sidenav-toggled");
    $(".navbar-sidenav .nav-link-collapse").addClass("collapsed");
    $(".navbar-sidenav .sidenav-second-level, .navbar-sidenav .sidenav-third-level").removeClass("show");
});

// pagination notification












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




openDetailOrderInformation();
closeDetailOrderInformation();


function openDetailOrderInformation() {
    let borderRightIconCollapseDetail = document.querySelectorAll(".border-collapse.open");
    borderRightIconCollapseDetail.forEach(event => {
        event.addEventListener("click", function() {
            let dataID = event.getAttribute("data-id");
            console.log(dataID);

            const list = event.classList;
            list.remove("open");
            list.add("close");


            event.innerHTML = '<i class="fa-solid fa-chevron-up"></i>';

            let ANHYEUEM3000tr = document.querySelectorAll(".row.rowmain."+dataID);
            ANHYEUEM3000tr.forEach(event => {
                event.style.display = "revert";
            });


            closeDetailOrderInformation();
        });
    });
}

function closeDetailOrderInformation() {
    let borderRightIconCollapseDetail = document.querySelectorAll(".border-collapse.close");
    borderRightIconCollapseDetail.forEach(event => {
        event.addEventListener("click", function() {
            let dataID = event.getAttribute("data-id");
            console.log(dataID);
            
            const list2 = event.classList;
            list2.remove("close");
            list2.add("open");


            event.innerHTML = '<i class="fa-solid fa-chevron-down"></i>';
            


            let ANHYEUEM3000tr = document.querySelectorAll(".row.rowmain."+dataID);
            ANHYEUEM3000tr.forEach(event => {
                event.style.display = "none";
            });

            openDetailOrderInformation();

        });
    });
}
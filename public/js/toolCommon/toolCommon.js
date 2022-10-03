// import { method } from "lodash";

function  loadEventShowFormPopUp(typeEvent,classNameActive,elForm,elEvent,elParent,methodWork)
{
    elEvent.addEventListener(typeEvent,function(event)
    {
        var containerPopupActive=document.querySelector(".containerPopup.active")
        if(containerPopupActive)
        containerPopupActive.classList.remove("active");
        event.preventDefault();
        elForm.classList.add(classNameActive);
        if(methodWork)
        {
            
            methodWork(elForm,classNameActive);
        }
    })
}
function  removeEventShowFormPopUp(typeEvent,classNameActive,elForm,elEvent,elParent)
{
    elEvent.cloneNode(true);
    elEvent.addEventListener(typeEvent,function(event)
    {
        event.preventDefault();
        var containerPopupActive=document.querySelector(".containerPopup.active")
        if(containerPopupActive)
        containerPopupActive.classList.remove("active");
        console.log(elEvent);
    })
}
function setActiveInList(
    textQuery,
    classNameActive,
    elParent,
    TypeEvent,
    methodWork
) {
    var List = elParent.querySelectorAll(textQuery);
    console.log(List);
    for (var item of List) {
        item.addEventListener(TypeEvent, function (event) {
            var itemActive = elParent.querySelector(
                textQuery + "." + classNameActive
            );
            if (itemActive) itemActive.classList.remove(classNameActive);
            event.currentTarget.classList.add(classNameActive);
            if (methodWork) {
                methodWork(
                    event.currentTarget.getAttribute("data-opt-product-detail"),
                    event.currentTarget
                );
            }
        });
    }
}

function setNumOrderProduct(el_btnIncrease, el_btnDecrease, el_valueOrder,methodWorkWithIpt) {
    // el_valueOrder.setAttribute('value',1);
    el_btnIncrease.addEventListener("click", function (event) {
        if(parseInt((el_valueOrder.value))+1<=parseInt(el_valueOrder.max))
        {
            console.log(el_valueOrder.max);
            console.log(el_valueOrder.value);
            var tmp=parseInt((el_valueOrder.value));
            el_valueOrder.value = tmp+1;

        }
        if(methodWorkWithIpt)
        {
            methodWorkWithIpt(el_valueOrder);
        }
        
    });
    el_btnDecrease.addEventListener("click", function (event) {
        if((parseInt((el_valueOrder.value))-1)>=1)
        {
            var tmp=parseInt((el_valueOrder.value));
            el_valueOrder.value = tmp-1;
        }
        if(methodWorkWithIpt)
        {
            methodWorkWithIpt(el_valueOrder);
        }
    });
    el_valueOrder.addEventListener('change',function(event)
    {
        if(parseInt(el_valueOrder.value)>parseInt(el_valueOrder.max))
        {
            el_valueOrder.value=el_valueOrder.max;
        }
        else
        if(el_valueOrder.value<1)
        {
            el_valueOrder.value=1;
        }
        if(methodWorkWithIpt)
        {
            methodWorkWithIpt(el_valueOrder);
        }
    })
}

export {
    loadEventShowFormPopUp
    ,removeEventShowFormPopUp
    ,setActiveInList
    ,setNumOrderProduct}
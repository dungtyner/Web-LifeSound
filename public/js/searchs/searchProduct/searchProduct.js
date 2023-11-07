import * as toolCommon from "../../toolCommon/toolCommon.js";
import * as toolProduct from "../../products/toolProduct.js";
toolCommon.handleKeyUpInput(
    document.querySelector('.header-search-content-data input')
    ,(event)=>{
        document.querySelector('.product-search-content-data').innerHTML=''
        request_getResultSearch(
            {
                textSearchProduct: toolCommon.getValueInput(event.currentTarget)
            }
            ,(result)=>{
                
                document.querySelector('.product-search-content-data').innerHTML=``
                result.forEach(element => {
                    renderProductSearched(element)
                });
            }
        )
    }
);

function renderProductSearched(data)
{   
    // console.log(data.list.img_product[0]);
    var productSearched = document.createElement('div');
    productSearched.className='sub-product-display';
    productSearched.setAttribute('data-id-product',data.id_product)
    productSearched.innerHTML=
    `
                    <div class="image-sub-product">
                        <img src="${data.list.img_product[0].url_img_product}" alt="">
                    </div>
                    <div class="content-sub-content-display">
                        <h2>${data.name_product}</h2>
                        <p></p>
                        
                    </div>
    `
    productSearched.addEventListener('click',function(event)
    {
        toolProduct.getDataDetail(event.currentTarget.getAttribute('data-id-product'));
    })
    document.querySelector('.product-search-content-data').appendChild(productSearched);
}
function request_getResultSearch(obj_search,methodWork)
{
    const xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange= function()
    {
        if(this.readyState==4 && this.status==200)
        {
            console.log(this.responseText)
            var result = Object.values(JSON.parse(this.responseText))[0];
            if(methodWork)
            {
                methodWork(result);
            }
        }
    }
    xmlHttp.open('GET'
    ,`/product/getResultSearch?
        obj_search=${JSON.stringify(obj_search)} 
    `)
    xmlHttp.send();
}
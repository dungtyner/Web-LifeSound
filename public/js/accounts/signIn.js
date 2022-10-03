var button= document.querySelector("button");
    button.addEventListener("click",function(event)
    {
        var xmlHttp = new XMLHttpRequest()
        xmlHttp.onreadystatechange = function()
        {
            if(this.readyState==4 && this.status==200)
            {
                console.log(this.responseText);
                document.querySelector("h1").textContent=this.responseText;
            }
        }
        xmlHttp.open('POST','/account/signin',true);
        var rand = Math.floor(Math.random()*10000)
        var form = new FormData();
        form.append('rand',rand);
        xmlHttp.setRequestHeader('X-CSRF-TOKEN',document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        xmlHttp.send(form);

    })
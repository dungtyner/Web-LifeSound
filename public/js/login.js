import * as toolCommon from "./toolCommon/toolCommon.js";
CheckLogined((result)=>{
  if(result)
  {
    console.log(result)
    localStorage.setItem('Account',true);
    document.querySelector(".header__linklist .click_show_formLogin").textContent="Profile"
  }
  else
  {
  console.log(result)

    localStorage.setItem('Account',false);
    document.querySelector(".header__linklist .click_show_formLogin").textContent="Account"
  }
});
// RequestSignOut()
function CheckLogined(methodWork)
{
  $.ajax(
    {
      url:'/account/checkSignInEd',
      type:'GET',
      cache: false,
      dataType: 'json',
      success: function(data)
      {
        console.log(data)
        var result = Object.values((data))[0]
        methodWork(result)
      }
    }

  )
}
function RequestSignOut(methodWork)
{
  $.ajax(
    {
      url:'/account/signOut',
      type:'GET',
      success: function(data)
      {
        var result = Object.values((data))[0]
        console.log(result)
        if(result)
        {
          localStorage.setItem('Account',false);
          methodWork();

          

        }
        else
        {
          localStorage.setItem('Account',true);
          document.querySelector(".header__linklist .click_show_formLogin").textContent="Profile"
        }
      }
    })
}
function showPassWord(classNameParent,ElBtnShowPasswords)
{
  for(var i =0;i< ElBtnShowPasswords.length;i++ )
  {
    ElBtnShowPasswords[i].addEventListener('click', function(event) {
      var ElIntPassword=event.currentTarget.closest(classNameParent).querySelector("input");
      const currentType = ElIntPassword.getAttribute('type')
      ElIntPassword.setAttribute(
        'type',
        currentType === 'password' ? 'text' : 'password'
      )
    });
  }

}
function SubmitSignIn(ElFormSignIn,methodWork)
{
  var form = new FormData(ElFormSignIn)
  form.append('g-recaptcha-response',grecaptcha.getResponse())
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange= function()
  {
    if(this.readyState==4 && this.status==200)
    {
      console.log(this.responseText);
      var result = JSON.parse(this.responseText);
      console.log(result);
      if(result.account==null)
      {
        alert("NoNoo");
      }
      else
      {
        if(methodWork)
        {
          methodWork(ElFormSignIn);
        }
        alert("Thông minh quá");
      }
    }
  }
  xmlHttp.open("POST","/account/signin",true);
  xmlHttp.setRequestHeader('X-CSRF-TOKEN',document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  return xmlHttp.send(form);
}
function SubmitSignUp(ElFormSignUp,methodWork)
{
  var form = new FormData(ElFormSignUp)
  // form.append('g-recaptcha-response',grecaptcha.getResponse())
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange= function()
  {
    if(this.readyState==4 && this.status==200)
    {
      console.log(this.responseText);
      var result = JSON.parse(this.responseText);
      console.log(result);
      if(result.account==null)
      {
        alert("NoNoo");
      }
      else
      {
        if(methodWork)
        {
          methodWork(ElFormSignUp);
        }
        alert("Thông minh quá");
      }
    }
  }
  xmlHttp.open("POST","/account/signup",true);
  xmlHttp.setRequestHeader('X-CSRF-TOKEN',document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  return xmlHttp.send(form);
}
function RequestRestorePass(ElParent,methodWork)
{
  // console.log("alo")
  var xmlHttp = new XMLHttpRequest();
  var form = new FormData();
  form.append('email',ElParent.querySelector(".ipt-email__forgetPass").value) ;
  form.append('newPass',ElParent.querySelector(".ipt-newPass__forgetPass").value);
  form.append('code',ElParent.querySelector(".ipt-CodeEmail").value);
  xmlHttp.onreadystatechange= function()
  {
    if(this.readyState==4 && this.status==200)
    {
      console.log(this.responseText);
      var result = Object.values(JSON.parse(this.responseText))[0];
      console.log(result);
      if(result==true)
      {
        alert('Success');
        if(methodWork)
        {
          // methodWork(ElFormSignIn);
        }
      }
      else if(result==="code")
      {
        ElParent.querySelector('.field-ipt-CodeEmail input').classList.add('active');
        alert("check Email \"" +form.get('email')+ "\"");
      }
      else if(result==="ErrorEmail")
      {
        alert("Email not Exist in System!!!!");
      }
      else
      {
        alert("Code Wrong");
      }
    }
  }
  xmlHttp.open("POST","/account/restorePass",true);
  xmlHttp.setRequestHeader('X-CSRF-TOKEN',document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  return xmlHttp.send(form);
}
function RequestChangePass(ElParent,methodWork)
{
  // console.log("alo")
  var xmlHttp = new XMLHttpRequest();
  var form = new FormData();
  form.append('oldPass',ElParent.querySelector(".ipt-oldPass__changePass").value) ;
  form.append('newPass',ElParent.querySelector(".ipt-newPass__changePass").value);
  form.append('code',ElParent.querySelector(".ipt-CodeEmail").value);
  xmlHttp.onreadystatechange= function()
  {
    if(this.readyState==4 && this.status==200)
    {
      console.log(this.responseText);
      var result = Object.values(JSON.parse(this.responseText))[0];
      console.log(result);
      if(result==true)
      {
        alert('Success');
        if(methodWork)
        {
          // methodWork(ElFormSignIn);
        }
      }
      else if(result==="code")
      {
        ElParent.querySelector('.field-ipt-CodeEmail input').classList.add('active');
        alert("check Email \"" +form.get('email')+ "\"");
      }
      else if(result==="ErrorEmail")
      {
        alert("Email not Exist in System!!!!");
      }
      else
      {
        alert("Code Wrong");
      }
    }
  }
  xmlHttp.open("POST","/account/changePass",true);
  xmlHttp.setRequestHeader('X-CSRF-TOKEN',document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  return xmlHttp.send(form);
}
export {
    showPassWord
    ,SubmitSignIn
    ,RequestSignOut
    ,CheckLogined
    ,RequestRestorePass,
    RequestChangePass
  ,SubmitSignUp};



import * as toolAccount from '../login.js';
import * as toolCommon from '../toolCommon/toolCommon.js';
import * as toolCart from '../cart/toolCart.js';
var scriptRecaptcha= document.createElement('script');
scriptRecaptcha.src='https://www.google.com/recaptcha/api.js';
document.body.appendChild(scriptRecaptcha);
insertPopUpLogin();
insertPopUpSignUp();
insertPopUpProfile();
insertPopUpForgetPass()
theFirstCheckLoginEd();
insertPopUpChangePass();
// toolCart.insertCartPopup();



/*SIGN IN - SIGN OUT - SIGN OUT - FORGET PASSWORD - CHANGE PASSWORD*/
function theFirstCheckLoginEd()
{
    toolAccount.CheckLogined(
        (result)=>{
            if(result)
            {
                toolCommon.removeEventShowFormPopUp("click","active",
                document.querySelector(".container-loginPopup")
                ,document.querySelector(".header__linklist .click_show_formLogin"),
                document);
    
                toolCommon.loadEventShowFormPopUp("click","active",
                document.querySelector(".container-proFilePopup")
                ,document.querySelector(".header__linklist .click_show_formLogin"),
                document);
            }
            else
            {
                toolCommon.loadEventShowFormPopUp("click","active",
                document.querySelector(".container-loginPopup")
                ,document.querySelector(".header__linklist .click_show_formLogin"),
                document
                ,(elForm,classNameActive)=>{
                    
                }
            );
            }
        }
    )
}
toolCommon.loadEventShowFormPopUp("click","active",
document.querySelector(".container-forgetPassPopup")
,document.querySelector(".container-loginPopup .click_show_FormForgetPass"),
document);
        toolCommon.loadEventShowFormPopUp("click","active",
        document.querySelector(".container-signUpPopup")
        ,document.querySelector(".container-loginPopup .click_show_FormSignUp"),
        document);
            toolCommon.loadEventShowFormPopUp("click","active",
            document.querySelector(".container-loginPopup")
            ,document.querySelector(".container-signUpPopup .click_show_formLogin"),
            document);
            toolCommon.loadEventShowFormPopUp("click","active",
            document.querySelector(".container-changePassPopup")
            ,document.querySelector(".container-proFilePopup .btnChangePassword"),
            document);

function InsBtnClose_Into_containerPopup(elParent)
{
    var btn_close_containerPopup =  document.createElement("div");
    btn_close_containerPopup.className="btn_close_containerPopup";
    btn_close_containerPopup.innerHTML=`
    <i class="fa-solid fa-xmark"></i>

    `
    btn_close_containerPopup.addEventListener("click",function(event)
    {
        elParent.classList.remove("active");
    })
    elParent.appendChild(btn_close_containerPopup);
}

function insertPopUpLogin()
{
    var popup_login = document.createElement("div");
    popup_login.className="containerPopup container-loginPopup"
    popup_login.innerHTML=
    `
    
    <div class="wrapper_login">
    <img src="../images/dancer.gif"></img>
    <section class="section__form">
        <h1>Hi, welcome back</h1>
        
          <div class="show__note">
             <strong>Note: </strong> 
              </div>
        
        <form action="" method="post" id="form1" class="formSignInPopUp">
            <div class="field input__text">
                <input type="text" name="email" id="name" placeholder="Enter username"
                    value="" required />      
            </div>
           
            <div class="field input__text">
                <input type="password" name="password" id="pass" placeholder="Enter new password"
                    value="" required />
             <button class="btn__show__password" type="button" id="btnPassword">
                <i class="fa-solid fa-eye"></i>
            </button>                      
            </div>
            <input type="checkbox" name="remember" />
            <span>Remember password</span>
            <div class="field button">
                <input class="btn-Submit__formSignIn" type="submit" name="submit" value="login" form="form1" required />
            </div>
        </form>
        <div class="link">Create new account? <a class="click_show_FormSignUp" href="./register.php">Register</a></div>
        <div class="link">Forget password? <a class="click_show_FormForgetPass" href="./register.php">Restore Now</a></div>
    </section>
</div>
    
    `

    popup_login.querySelector(".formSignInPopUp").addEventListener("submit",function(event)
    {
        event.preventDefault();
                console.log(toolAccount.SubmitSignIn(event.currentTarget,(elForm)=>
        {

    document.querySelector(".header__linklist .click_show_formLogin").textContent="Profile"
    theFirstCheckLoginEd();
            
            elForm.reset();
            grecaptcha.reset();
            elForm.closest(".containerPopup").classList.remove("active");
        }));
    })

    InsBtnClose_Into_containerPopup(popup_login);

    toolAccount.showPassWord(
        ".field.input__text"
        ,popup_login.querySelectorAll(".btn__show__password"));

    document.body.appendChild(popup_login);
}
function insertPopUpProfile()
{
    var popup_proFile = document.createElement("div");
    popup_proFile.className="containerPopup container-proFilePopup"
    popup_proFile.innerHTML=
    `
  <div class="wrapper_profile">
        <div class="left">
            <div class="img-profile">
                <img src="uploads/users/avatars/viennv.21it@vku.udn.vn_nguyen_van vien.jpg" alt="" width="100">
                <div class="change_img_profile">
                    <form id="uploadIMGUSer"><input id="ipt_img_profile" type="file" style="display:none" accept="image/*" onchange="document.querySelector('.img-profile img').src = window.URL.createObjectURL(this.files[0])" name="valueUploadImgUser"></form>
                    <div class="btnEditIMGProfile" onclick="
                    {
                        document.querySelector('#ipt_img_profile').click();
                    }
                    "><i class="fa-solid fa-pen-to-square"></i></div>
                    
                </div>
            </div>
            <h4><input class="ipt_name_profile" type="text" value="Nguyen" id="ipt_fnameProfile"></h4>
            <h4><input class="ipt_name_profile" type="text" value="Van Vien" id="ipt_lnameProfile"></h4>
        </div>
        <div class="right">
            
            <div class="info">
     
                <h3>Information</h3>
              
                <div class="info_data">
                    <div class="data">
                        <h4>Email</h4>
                        <p><input type="email" value="viennv.21it@vku.udn.vn" id="ipt_emailProfile"></p>
                    </div>
                    <div class="data">
                        <h4>Phone</h4>
                        <p><input class="ipt_phoneNumber_Filter" type="number" value="0372695578" id="ipt_phoneProfile"></p>
                    </div> 
                </div>
            </div>

            <div class="project">
                <div class="info_data">
                    <div class="data">
                        <h4>Type Account</h4>
                        <p>User</p>
                    </div>
                    <div class="data">
                        <h4>Change Password</h4>
                        <div class="btnChangePassword">Change Password</div>

                    </div> 
                </div>
                
            </div>
<div class="container_option_profile">
    <div class="social_media">
        <ul>
            <!-- <li>
                <a href=""><i class="fa-brands fa-facebook"></i></a>
            </li> -->
            <li class="btnSignOut_profile">
                <a href=""><i class="fa-solid fa-arrow-right-from-bracket"></i> Sign out </a>
            </li>
            <!-- <li>
                <a href=""><i class="fa-brands fa-tiktok"></i></a>
            </li> -->
            
        </ul>
    </div>
    <div class="close-profile">
        <button class="btnsave-profile">Save</button>
        <button class="btnclose-profile">Close</button>
    </div>
</div>
        </div>
        
    </div>
    `
    popup_proFile.querySelector(".btnSignOut_profile").addEventListener('click',function(event)
    {
        event.preventDefault();
        toolAccount.RequestSignOut(()=>{
            popup_proFile.classList.remove("active")
            theFirstCheckLoginEd();
            document.querySelector(".header__linklist .click_show_formLogin").textContent="Account"
        });
    })
    popup_proFile.querySelector(".btnclose-profile").addEventListener("click",function(event)
    {
        popup_proFile.classList.remove('active');
    })
    document.body.appendChild(popup_proFile);

}
function insertPopUpForgetPass()
{
    var popup_forgetPass = document.createElement("div");
    popup_forgetPass.className="containerPopup container-forgetPassPopup"
    popup_forgetPass.innerHTML=
    `
  <div class="wrapper_forgetPass">
  <section class="section__form">
  <h1>Hi, welcome back</h1>
  
    <div class="show__note">
       <strong>Note: </strong> 
        </div>
  
  <form action="" method="post" id="form1" class="formSignInPopUp">
      <div class="field input__text">
          <input type="email" name="email" id="name" class="ipt-email__forgetPass" placeholder="Enter email"
              value="" required />      
      </div>
     
      <div class="field input__text">
          <input type="password" name="password" id="pass" class="ipt-newPass__forgetPass" placeholder="Enter new password"
              value="" required />
       <button class="btn__show__password" type="button" id="btnPassword">
          <i class="fa-solid fa-eye"></i>
      </button>                      
      </div>
      <div class="field-ipt-CodeEmail">
      <input type="text" class="ipt-CodeEmail" placeholder="Code from email" />
      </div>
      <div class="field button">
          <input class="btn-Submit__formSignIn" type="submit" name="submit" value="Restore"required />
      </div>
  </form>
</section>    
    </div>
    `
    popup_forgetPass.querySelector(".formSignInPopUp").addEventListener("submit",function(event)
    {
        event.preventDefault();
        toolAccount.RequestRestorePass(popup_forgetPass,(elForm)=>
            {
            });
    })

    InsBtnClose_Into_containerPopup(popup_forgetPass);

    toolAccount.showPassWord(
        ".field.input__text"
        ,popup_forgetPass.querySelectorAll(".btn__show__password"));
    document.body.appendChild(popup_forgetPass);

}
function insertPopUpChangePass()
{
    var popup_changePass = document.createElement("div");
    popup_changePass.className="containerPopup container-changePassPopup"
    popup_changePass.innerHTML=
    `
  <div class="wrapper_changePass">
  <section class="section__form">
  <h1>Hi, welcome back</h1>
  
    <div class="show__note">
       <strong>Note: </strong> 
        </div>
  
  <form action="" method="post" id="form1" class="formSignInPopUp">
    <div class="field input__text">
    <input type="password" name="password" id="pass" class="ipt-oldPass__changePass" placeholder="Enter old password"
        value="" required />
    <button class="btn__show__password" type="button" id="btnPassword">
    <i class="fa-solid fa-eye"></i>
    </button>                      
    </div>
     
      <div class="field input__text">
          <input type="password" name="password" id="pass" class="ipt-newPass__changePass" placeholder="Enter new password"
              value="" required />
       <button class="btn__show__password" type="button" id="btnPassword">
          <i class="fa-solid fa-eye"></i>
      </button>                      
      </div>
      <div class="field-ipt-CodeEmail">
      <input type="text" class="ipt-CodeEmail" placeholder="Code from email" />
      </div>
      <div class="field button">
          <input class="btn-Submit__formSignIn" type="submit" name="submit" value="Restore"required />
      </div>
  </form>
</section>    
    </div>
    `
    popup_changePass.querySelector(".formSignInPopUp").addEventListener("submit",function(event)
    {
        event.preventDefault();
        toolAccount.RequestChangePass(popup_changePass,(elForm)=>
            {
            });
    })

    InsBtnClose_Into_containerPopup(popup_changePass);

    toolAccount.showPassWord(
        ".field.input__text"
        ,popup_changePass.querySelectorAll(".btn__show__password"));
    document.body.appendChild(popup_changePass);

}
function insertPopUpSignUp()
{
    var popup_signUp = document.createElement("div");
    popup_signUp.className="containerPopup container-signUpPopup"
    popup_signUp.innerHTML=
    `
    <div class="wrapper_signup">
    <img src="../images/dancer.gif"></img>
    <section class="section__form">
        <h1>Hi, welcome back</h1>

        <form action="" method="post" id="form2" class="formSignInPopUp">
            <div class="name-details">
                <div class="field input__text">
                    <input type="text" name="fname" placeholder="First name" required />
                    <div class="has-err">
                        <span></span>
                    </div>
                </div>
                <div class="field input__text">

                    <input type="text" name="lname" placeholder="Last name" required />
                    <div class="has-err">
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="field input__text">
                <input type="text" name="account_numphone" placeholder="Enter mobile number" required />
                <div class="has-err">
                    <span></span>
                </div>
            </div>
            <div class="field input__text">
                <input type="text" name="email" placeholder="Enter email address" required />
                <div class="has-err">
                    <span></span>
                </div>
            </div>
            <div class="field input__text">
                <input type="password" name="password" placeholder="Enter new password" id="pass2" required />
                <button class="btn__show__password" type="button" id="btnPassword2">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <div class="has-err">
                    <span></span>
                </div>
            </div>
            <div class="field input__text">
                <input type="password" name="check_password" placeholder="Enter password again" id="pass3" required />
                <button class="btn__show__password" type="button" id="btnPassword3">
                    <i class="fa-solid fa-eye"></i>
                </button>
                <div class="has-err">
                    <span></span>
                </div>
            </div>
            <div class="g-recaptcha" data-sitekey="6LcEtEUiAAAAALD0i8yZtqJ8tmIGpxj-SwneD32K"></div>
            <div class="field button">
                <input class="btn-Submit__formSignUp" type="submit" name="submit" value="Create account" form="form2" />
            </div>
        </form>
        <div class="link">Already signed up? <a href="./login.php" class="click_show_formLogin">Login now</a></div>
    </section>
</div>

    `
    popup_signUp.querySelector(".formSignInPopUp").addEventListener("submit",function(event)
    {
        event.preventDefault();
        console.log('OKiBae');
                console.log(toolAccount.SubmitSignUp(event.currentTarget,(elForm)=>
        {

    document.querySelector(".header__linklist .click_show_formLogin").textContent="Profile"
    theFirstCheckLoginEd();
            
            elForm.reset();
            // grecaptcha.reset();
            elForm.closest(".containerPopup").classList.remove("active");
        }));
    })
    InsBtnClose_Into_containerPopup(popup_signUp);
    toolAccount.showPassWord(
        ".field.input__text"
        ,popup_signUp.querySelectorAll(".btn__show__password"));
    document.body.appendChild(popup_signUp);
}

/*PRODUCT DETAIL*/
function render_productDetail(data_productDetail)
{
    document.body.appendChild(
    `
    <div id="popup-product__detail" class="show">
    <div class="container__product_detail">
            <div class="header-product__detail"><div class="btnCLose__product_detail"><i class="fa-solid fa-circle-xmark"></i></div></div>
            <div class="main-product__detail">
                <div class="partSide-product__detail">
                    <div class="side-Image__product_detail">
                        <div class="main-Image__product_detail">
                            <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/5efddaa33218b776b29aca1c167ad82f_1160x.jpg?v=1641184507" alt="" srcset="">
                        </div>
                        <div class="list-shortcutImage__product_detail">
                            <div class="item-shortcutImage__product_detail active" data-opt-product-detail="https://cdn.shopify.com/s/files/1/0153/8863/products/5efddaa33218b776b29aca1c167ad82f_1160x.jpg?v=1641184507">
                                <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/5efddaa33218b776b29aca1c167ad82f_1160x.jpg?v=1641184507" alt="" srcset="">
                            </div>
                            <div class="item-shortcutImage__product_detail" data-opt-product-detail="https://cdn.shopify.com/s/files/1/0153/8863/products/Headphone-Zone-LETSHUOER-S12-1_1000x.jpg?v=1658749480">
                                <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/Headphone-Zone-LETSHUOER-S12-1_1000x.jpg?v=1658749480" alt="" srcset="">
                            </div>
                            <div class="item-shortcutImage__product_detail" data-opt-product-detail="https://cdn.shopify.com/s/files/1/0153/8863/products/5efddaa33218b776b29aca1c167ad82f_1160x.jpg?v=1641184507">
                                <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/5efddaa33218b776b29aca1c167ad82f_1160x.jpg?v=1641184507" alt="" srcset="">
                            </div>
                            <div class="item-shortcutImage__product_detail" data-opt-product-detail="https://cdn.shopify.com/s/files/1/0153/8863/products/Headphone-Zone-LETSHUOER-S12-1_1000x.jpg?v=1658749480">
                                <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/Headphone-Zone-LETSHUOER-S12-1_1000x.jpg?v=1658749480" alt="" srcset="">
                            </div>
                        </div>
                    </div>

                    <div class="side-info__product_detail">
                        <div class="header-info__product_detail">
                            <div class="brand-info__product_detail">Letshuoer</div>
                            <div class="name-info__product_detail">Letshuoer - S12</div>
                            <div class="shortTech-info__product_detail">Planar Magnetic In-Ears</div>
                            <div class="part_rate-info__product_detail">
                                <div class="list-rate_start-info__product_detail">
                                    <div class="item-rate_start-info__product_detail"><i class="fa-solid fa-star"></i></div>
                                    <div class="item-rate_start-info__product_detail"><i class="fa-solid fa-star"></i></div>
                                    <div class="item-rate_start-info__product_detail"><i class="fa-solid fa-star"></i></div>
                                    <div class="item-rate_start-info__product_detail"><i class="fa-solid fa-star"></i></div>
                                </div>
                                <div class="num-rate_start-info__product_detail">
                                    5 reviews
                                </div>
                            </div>
                            <div class="partPrice-info__product_detail">
                                <div class="infoPrice-info__product_detail">
                                    <div class="defaultPrice-info__product_detail">
                                        <div class="salePrice-info__product_detail">
                                        ₹ 12,999
                                        </div>
                                        <div class="rootPrice-info__product_detail">
                                        MRP: ₹ 16,999
                                        </div>
                                    </div>
                                    <div class="withMethodOther-Price-info__product_detail">
                                    Or ₹ 2,167 (Simpl/Bajaj/Zest/Cards) 
                                    </div>
                                </div>
                                <div class="requestPrice-info__product_detail">
                                Is our price too high?
                                </div>
                            </div>
                        </div>
                        <div class="part-optionChar__product_detail">
                        <div class="list-optionChar__product_detail">
                            <div class="option-product__detail optionColor-product__detail">
                                <div class="nameOption-product__detail">
                                Color: <span class="valueOptChar__product_detail" data-opt-product-detail="White">White</span>
                                </div>
                                <div class="list-option-product__detail list-optionColor-product__detail">
                                    <div class="item-optionColor-product__detail active" data-opt-product-detail="White">
                                        <img src="//cdn.shopify.com/s/files/1/0153/8863/products/Headphone-Zone-LETSHUOER-S12-1_1160x.jpg?v=1658749480" alt="" srcset="">
                                    </div>
                                    <div class="item-optionColor-product__detail " data-opt-product-detail="Silver">
                                        <img src="//cdn.shopify.com/s/files/1/0153/8863/products/Headphone-Zone-LETSHUOER-S12-1_1160x.jpg?v=1658749480" alt="" srcset="">
                                    </div>
                                </div>
                            </div>
                            <div class="option-product__detail optionPlug-product__detail">
                                <div class="nameOption-product__detail">
                                Plug: <span class="valueOptChar__product_detail " data-opt-product-detail="3.5mm">3.5mm</span>
                                </div>
                                <div class="list-option-product__detail list-optionPlug-product__detail">
                                    <div class="item-optionPlug-product__detail active" data-opt-product-detail="3.5mm">3.5mm</div>
                                    <div class="item-optionPlug-product__detail" data-opt-product-detail="3.0mm">3.0mm</div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="part-optionPay__product_detail">
                            <div class="mb-optionPay__product_detail btn-soldOut__product_detail">
                                Sold Out
                            </div>
                            <div class="mb-optionPay__product_detail btn-notify__product_detail">
                                Notify when Available
                            </div>
                            <div class="mb-optionPay__product_detail btn-addCart__product_detail">
                                Add to Cart
                            </div>
                            <div class="mb-optionPay__product_detail mess-expected__product_detail">
                                Expected to be restocked by 
                                    <span class="timeExpected">end of September</span>
                            </div>
                            <div class="mb-optionPay__product_detail btn-optTalkWithShop__product_detail">
                                Talk to Shop!!!
                            </div>
                            <div class="mb-optionPay__product_detail part-optPayLater__product_detail">
                                <div class="title-optPayLater__product_detail">
                                Buy Now, pay later!!!
                                </div>
                                <div class="list-optPayLater__product_detail">
                                    <div class="item-optPayLater__product_detail">
                                        <div class="logo-bankPayLater__product_detail">
                                            <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBM0E3SHc9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--98ad6550665270931a546757db0e58f65b0505bc/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--ee4e4854f68df0a745312d63f6c2782b5da346cd/MoMo%20Logo.png" alt="" srcset="">
                                        </div></div>
                                    <div class="item-optPayLater__product_detail">
                                        <div class="logo-bankPayLater__product_detail">
                                            <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBM0E3SHc9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--98ad6550665270931a546757db0e58f65b0505bc/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--ee4e4854f68df0a745312d63f6c2782b5da346cd/MoMo%20Logo.png" alt="" srcset="">
                                        </div></div>
                                    <div class="item-optPayLater__product_detail">
                                        <div class="logo-bankPayLater__product_detail">
                                            <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBM0E3SHc9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--98ad6550665270931a546757db0e58f65b0505bc/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--ee4e4854f68df0a745312d63f6c2782b5da346cd/MoMo%20Logo.png" alt="" srcset="">
                                        </div></div>
                                    <div class="item-optPayLater__product_detail">
                                        <div class="logo-bankPayLater__product_detail">
                                            <img src="https://itviec.com/rails/active_storage/representations/proxy/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBM0E3SHc9PSIsImV4cCI6bnVsbCwicHVyIjoiYmxvYl9pZCJ9fQ==--98ad6550665270931a546757db0e58f65b0505bc/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaDdCem9MWm05eWJXRjBTU0lJY0c1bkJqb0dSVlE2RkhKbGMybDZaVjkwYjE5c2FXMXBkRnNIYVFJc0FXa0NMQUU9IiwiZXhwIjpudWxsLCJwdXIiOiJ2YXJpYXRpb24ifX0=--ee4e4854f68df0a745312d63f6c2782b5da346cd/MoMo%20Logo.png" alt="" srcset="">
                                        </div></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="footer-info__product_detail"></div>

                    </div>
                </div>

                <div class="partTab__product_detail">
                    <div class="list-BtnTab__product_detail">
                        <div class="item-btnTab__product_detail active" data-tab-product-detail="Description">Description</div>
                        <div class="item-btnTab__product_detail" data-tab-product-detail="Specs">Specs</div>
                        <div class="item-btnTab__product_detail" data-tab-product-detail="Best-Pairings">Best Pairings</div>
                        <div class="item-btnTab__product_detail" data-tab-product-detail="FAQS">FAQS</div>
                    </div>
                    <div class="list-mainTab__product_detail">
                        <div data-tab-product-detail="Description" class="item-mainTab__product_detail itemDescription-mainTab__product_detail active">
                        <div class="list-contentDescription__product_detail">
                            <div class="item-contentDescription__product_detail">
                                <div class="headerDescription-mainTab__product_detail">
                                    <div class="title-headerDescription__tabProduct_detail  halfParent">
                                    JOIN IN FOR AN IMMERSIVE MUSIC LISTENING EXPERIENCE WITH THE ALL-NEW LETSHUOER S12 PLANAR MAGNETIC IEM
                                    </div>
                                    <div class="text-headerDescription__tabProduct_detail halfParent">
                                    LETSHOUER is an in-ear monitors company founded in August 2016. Danny To, a senior engineer with over 20 years of experience in the acoustics engineering and audio manufacturing process, is the founder and CEO of LETSHOUER. The LETSHUOER S12 are an excellent pair of in-ear monitors that exhibit all of the characteristics expected of planar magnetic technology – low distortion, tight bass response, and a deep stage. S12 are a set of Hi-Fi IEMs designed for music enthusiasts. These planar driver in-ear monitors provide a wider soundstage, greater clarity, quicker transients, smoother treble extension, and exceptional resolution. For your regular musical enjoyment, it will be the perfect ally.
                                    </div>
                                </div>
                                <div class="bodyImages-mainTab__product_detail">
                                <div class="list-imagesDescription__tabProduct_detail">
                                        <div class="item-imagesDescription__tabProduct_detail fullParent">
                                            <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Headphone-Zone-LETSHUOER-S12-Banner-4.jpg?v=1658753073" alt="" srcset="">
                                        </div>
                                        <div class="item-imagesDescription__tabProduct_detail halfParent">
                                            <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Headphone-Zone-LETSHUOER-S12-Banner-4.jpg?v=1658753073" alt="" srcset="">
                                        </div>
                                        <div class="item-imagesDescription__tabProduct_detail halfParent">
                                            <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Headphone-Zone-LETSHUOER-S12-Banner-4.jpg?v=1658753073" alt="" srcset="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-contentDescription__product_detail">
                                <div class="headerDescription-mainTab__product_detail">
                                        <div class="title-headerDescription__tabProduct_detail halfParent">
                                        JOIN IN FOR AN IMMERSIVE MUSIC LISTENING EXPERIENCE WITH THE ALL-NEW LETSHUOER S12 PLANAR MAGNETIC IEM
                                        </div>
                                        <div class="text-headerDescription__tabProduct_detail halfParent">
                                        LETSHOUER is an in-ear monitors company founded in August 2016. Danny To, a senior engineer with over 20 years of experience in the acoustics engineering and audio manufacturing process, is the founder and CEO of LETSHOUER. The LETSHUOER S12 are an excellent pair of in-ear monitors that exhibit all of the characteristics expected of planar magnetic technology – low distortion, tight bass response, and a deep stage. S12 are a set of Hi-Fi IEMs designed for music enthusiasts. These planar driver in-ear monitors provide a wider soundstage, greater clarity, quicker transients, smoother treble extension, and exceptional resolution. For your regular musical enjoyment, it will be the perfect ally.
                                        </div>
                                    </div>
                                    <div class="bodyImages-mainTab__product_detail">
                                    <div class="list-imagesDescription__tabProduct_detail">
                                            <div class="item-imagesDescription__tabProduct_detail fullParent">
                                                <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Headphone-Zone-LETSHUOER-S12-Banner-4.jpg?v=1658753073" alt="" srcset="">
                                            </div>
                                            <div class="item-imagesDescription__tabProduct_detail halfParent">
                                                <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Headphone-Zone-LETSHUOER-S12-Banner-4.jpg?v=1658753073" alt="" srcset="">
                                            </div>
                                            <div class="item-imagesDescription__tabProduct_detail halfParent">
                                                <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Headphone-Zone-LETSHUOER-S12-Banner-4.jpg?v=1658753073" alt="" srcset="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </div>
                        <div data-tab-product-detail="Specs" class="item-mainTab__product_detail itemSpecs-mainTab__product_detail">
                                <div class="list-tableSpecs_mainTab__product_detail">
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div class="item--tableSpecs_mainTab__product_detail">
                                        <div class="title-tableSpecs_mainTab__product_detail">
                                            SPECIFICATIONS
                                        </div>
                                        <div class="body-tableSpecs_mainTab__product_detail">
                                            <table class="tableSpecs_mainTab__product_detail">
                                                <tbody><tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                                <tr>
                                                    <th class="headerRowSpecs-main__product_detail">DRIVERS</th>
                                                    <td class="valueRowSpecs-main__product_detail">1 Dynamic Driver + 2 Balanced Armature</td>
                                                </tr>
                                            </tbody></table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div data-tab-product-detail="Best-Pairings" class="item-mainTab__product_detail itemBestPairs-mainTab__product_detail">
                                <div class="list-selectBestPair_mainTab__product_detail">
                                    <div class="item-selectBestPair_mainTab__product_detail">
                                        <div class="name-optBestPair_mainTab__product_detail">
                                            BEST PAIRED WITH THESE PORTABLE AMPS
                                        </div>
                                        <div class="list-optBestPair_mainTab__product_detail">
                                            <div class="item-optBestPair_mainTab__product_detail">
                                                <div class="card-productBestPair_mainTab__product_detail">
                                                    <div class="part-imgProductBestPair_mainTab__product_detail">
                                                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/A_K-PEE51-2_medium.jpg?v=1621682307" alt="">

                                                    </div>
                                                    <div class="part-shortInfoProductBestPair_mainTab__product_detail">
                                                        <div class="name-shortInfoProductBestPair_mainTab__product_detail">
                                                            FIIO - KA1
                                                        </div>
                                                        <div class="represent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="valueRepresent-shortInfoProductBestPair_mainTab__product_detail">45</div> 
                                                            <div class="unitRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                mW
                                                            </div>
                                                        </div>
                                                        <div class="priceRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="priceSaleRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 6,789 
                                                            </div>
                                                            <div class="priceRootRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 5,678
                                                            </div>
                                                        </div>
                                                        <div class="optPayRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            Add to Cart
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-optBestPair_mainTab__product_detail">
                                                <div class="card-productBestPair_mainTab__product_detail">
                                                    <div class="part-imgProductBestPair_mainTab__product_detail">
                                                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/A_K-PEE51-2_medium.jpg?v=1621682307" alt="">

                                                    </div>
                                                    <div class="part-shortInfoProductBestPair_mainTab__product_detail">
                                                        <div class="name-shortInfoProductBestPair_mainTab__product_detail">
                                                            FIIO - KA1
                                                        </div>
                                                        <div class="represent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="valueRepresent-shortInfoProductBestPair_mainTab__product_detail">45</div> 
                                                            <div class="unitRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                mW
                                                            </div>
                                                        </div>
                                                        <div class="priceRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="priceSaleRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 6,789 
                                                            </div>
                                                            <div class="priceRootRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 5,678
                                                            </div>
                                                        </div>
                                                        <div class="optPayRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            Add to Cart
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-optBestPair_mainTab__product_detail">
                                                <div class="card-productBestPair_mainTab__product_detail">
                                                    <div class="part-imgProductBestPair_mainTab__product_detail">
                                                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/A_K-PEE51-2_medium.jpg?v=1621682307" alt="">

                                                    </div>
                                                    <div class="part-shortInfoProductBestPair_mainTab__product_detail">
                                                        <div class="name-shortInfoProductBestPair_mainTab__product_detail">
                                                            FIIO - KA1
                                                        </div>
                                                        <div class="represent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="valueRepresent-shortInfoProductBestPair_mainTab__product_detail">45</div> 
                                                            <div class="unitRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                mW
                                                            </div>
                                                        </div>
                                                        <div class="priceRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="priceSaleRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 6,789 
                                                            </div>
                                                            <div class="priceRootRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 5,678
                                                            </div>
                                                        </div>
                                                        <div class="optPayRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            Add to Cart
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-optBestPair_mainTab__product_detail">
                                                <div class="card-productBestPair_mainTab__product_detail">
                                                    <div class="part-imgProductBestPair_mainTab__product_detail">
                                                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/A_K-PEE51-2_medium.jpg?v=1621682307" alt="">

                                                    </div>
                                                    <div class="part-shortInfoProductBestPair_mainTab__product_detail">
                                                        <div class="name-shortInfoProductBestPair_mainTab__product_detail">
                                                            FIIO - KA1
                                                        </div>
                                                        <div class="represent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="valueRepresent-shortInfoProductBestPair_mainTab__product_detail">45</div> 
                                                            <div class="unitRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                mW
                                                            </div>
                                                        </div>
                                                        <div class="priceRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="priceSaleRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 6,789 
                                                            </div>
                                                            <div class="priceRootRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 5,678
                                                            </div>
                                                        </div>
                                                        <div class="optPayRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            Add to Cart
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-selectBestPair_mainTab__product_detail">
                                        <div class="name-optBestPair_mainTab__product_detail">
                                            BEST PAIRED WITH THESE PORTABLE AMPS
                                        </div>
                                        <div class="list-optBestPair_mainTab__product_detail">
                                            <div class="item-optBestPair_mainTab__product_detail">
                                                <div class="card-productBestPair_mainTab__product_detail">
                                                    <div class="part-imgProductBestPair_mainTab__product_detail">
                                                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/A_K-PEE51-2_medium.jpg?v=1621682307" alt="">

                                                    </div>
                                                    <div class="part-shortInfoProductBestPair_mainTab__product_detail">
                                                        <div class="name-shortInfoProductBestPair_mainTab__product_detail">
                                                            FIIO - KA1
                                                        </div>
                                                        <div class="represent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="valueRepresent-shortInfoProductBestPair_mainTab__product_detail">45</div> 
                                                            <div class="unitRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                mW
                                                            </div>
                                                        </div>
                                                        <div class="priceRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="priceSaleRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 6,789 
                                                            </div>
                                                            <div class="priceRootRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 5,678
                                                            </div>
                                                        </div>
                                                        <div class="optPayRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            Add to Cart
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-optBestPair_mainTab__product_detail">
                                                <div class="card-productBestPair_mainTab__product_detail">
                                                    <div class="part-imgProductBestPair_mainTab__product_detail">
                                                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/A_K-PEE51-2_medium.jpg?v=1621682307" alt="">

                                                    </div>
                                                    <div class="part-shortInfoProductBestPair_mainTab__product_detail">
                                                        <div class="name-shortInfoProductBestPair_mainTab__product_detail">
                                                            FIIO - KA1
                                                        </div>
                                                        <div class="represent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="valueRepresent-shortInfoProductBestPair_mainTab__product_detail">45</div> 
                                                            <div class="unitRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                mW
                                                            </div>
                                                        </div>
                                                        <div class="priceRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="priceSaleRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 6,789 
                                                            </div>
                                                            <div class="priceRootRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 5,678
                                                            </div>
                                                        </div>
                                                        <div class="optPayRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            Add to Cart
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-optBestPair_mainTab__product_detail">
                                                <div class="card-productBestPair_mainTab__product_detail">
                                                    <div class="part-imgProductBestPair_mainTab__product_detail">
                                                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/A_K-PEE51-2_medium.jpg?v=1621682307" alt="">

                                                    </div>
                                                    <div class="part-shortInfoProductBestPair_mainTab__product_detail">
                                                        <div class="name-shortInfoProductBestPair_mainTab__product_detail">
                                                            FIIO - KA1
                                                        </div>
                                                        <div class="represent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="valueRepresent-shortInfoProductBestPair_mainTab__product_detail">45</div> 
                                                            <div class="unitRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                mW
                                                            </div>
                                                        </div>
                                                        <div class="priceRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="priceSaleRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 6,789 
                                                            </div>
                                                            <div class="priceRootRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 5,678
                                                            </div>
                                                        </div>
                                                        <div class="optPayRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            Add to Cart
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-optBestPair_mainTab__product_detail">
                                                <div class="card-productBestPair_mainTab__product_detail">
                                                    <div class="part-imgProductBestPair_mainTab__product_detail">
                                                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/products/A_K-PEE51-2_medium.jpg?v=1621682307" alt="">

                                                    </div>
                                                    <div class="part-shortInfoProductBestPair_mainTab__product_detail">
                                                        <div class="name-shortInfoProductBestPair_mainTab__product_detail">
                                                            FIIO - KA1
                                                        </div>
                                                        <div class="represent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="valueRepresent-shortInfoProductBestPair_mainTab__product_detail">45</div> 
                                                            <div class="unitRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                mW
                                                            </div>
                                                        </div>
                                                        <div class="priceRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            <div class="priceSaleRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 6,789 
                                                            </div>
                                                            <div class="priceRootRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                                $ 5,678
                                                            </div>
                                                        </div>
                                                        <div class="optPayRepresent-shortInfoProductBestPair_mainTab__product_detail">
                                                            Add to Cart
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div data-tab-product-detail="FAQS" class="item-mainTab__product_detail itemFAQS-mainTab__product_detail">
                            <div class="listShow-FAQS-mainTab__product_detail">
                                <div class="item-Show-FAQS-mainTab__product_detail">
                                    <div class="partQS-show-FAQS-mainTab__product_detail">
                                        <div class="textQS-Show-FAQS-mainTab__product_detail">
                                        What is the warranty period on the LETSHUOER S12 and how do I claim warranty?
                                    </div>
                                    <div class="summary-Show-FAQS-mainTab__product_detail">
                                        <div class="iconSummary-Show-FAQS-mainTab__product_detail">
                                            <i class="fa-regular fa-comment"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="partAnswer-ShowFAQS-mainTab__product_detail">
                                    The warranty period on LETSHUOER S12 is for 1 year. You can simply get in touch with us to claim the warranty.
                                </div>
                                </div>
                                <div class="item-Show-FAQS-mainTab__product_detail">
                                    <div class="partQS-show-FAQS-mainTab__product_detail">
                                        <div class="textQS-Show-FAQS-mainTab__product_detail">
                                        What is the warranty period on the LETSHUOER S12 and how do I claim warranty?
                                    </div>
                                    <div class="summary-Show-FAQS-mainTab__product_detail">
                                        <div class="iconSummary-Show-FAQS-mainTab__product_detail">
                                            <i class="fa-regular fa-comment"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="partAnswer-ShowFAQS-mainTab__product_detail">
                                    The warranty period on LETSHUOER S12 is for 1 year. You can simply get in touch with us to claim the warranty.
                                </div>
                                </div>
                                <div class="item-Show-FAQS-mainTab__product_detail">
                                    <div class="partQS-show-FAQS-mainTab__product_detail">
                                        <div class="textQS-Show-FAQS-mainTab__product_detail">
                                        What is the warranty period on the LETSHUOER S12 and how do I claim warranty?
                                    </div>
                                    <div class="summary-Show-FAQS-mainTab__product_detail">
                                        <div class="iconSummary-Show-FAQS-mainTab__product_detail">
                                            <i class="fa-regular fa-comment"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="partAnswer-ShowFAQS-mainTab__product_detail">
                                    The warranty period on LETSHUOER S12 is for 1 year. You can simply get in touch with us to claim the warranty.
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-product__detail">
                <div class="list-brandTechnology__product_detail">
                    <div class="item-brandTechnology__product_detail">
                        <div class="logo-brandTechnology__product_detail">
                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Head-Fi-Media-Review-Logo-2020.svg?v=1614287289" alt="" srcset="">
                        </div>
                        <div class="description-brandTechnology__product_detail">
                        "The tuning I think was done well and I absolutely recommend the LETSHUOER S12 for both newcomers and those who want to see what the hype around these second gen planar IEMs is all about."
                        </div>
                        <div class="btnReadmore-brandTechnology__product_detail">
                            Read More
                        </div>
                    </div>
                    <div class="item-brandTechnology__product_detail">
                        <div class="logo-brandTechnology__product_detail">
                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Head-Fi-Media-Review-Logo-2020.svg?v=1614287289" alt="" srcset="">
                        </div>
                        <div class="description-brandTechnology__product_detail">
                        "The tuning I think was done well and I absolutely recommend the LETSHUOER S12 for both newcomers and those who want to see what the hype around these second gen planar IEMs is all about."
                        </div>
                        <div class="btnReadmore-brandTechnology__product_detail">
                            Read More
                        </div>
                    </div>
                    <div class="item-brandTechnology__product_detail">
                        <div class="logo-brandTechnology__product_detail">
                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Head-Fi-Media-Review-Logo-2020.svg?v=1614287289" alt="" srcset="">
                        </div>
                        <div class="description-brandTechnology__product_detail">
                        "The tuning I think was done well and I absolutely recommend the LETSHUOER S12 for both newcomers and those who want to see what the hype around these second gen planar IEMs is all about."
                        </div>
                        <div class="btnReadmore-brandTechnology__product_detail">
                            Read More
                        </div>
                    </div>
                    <div class="item-brandTechnology__product_detail">
                        <div class="logo-brandTechnology__product_detail">
                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Head-Fi-Media-Review-Logo-2020.svg?v=1614287289" alt="" srcset="">
                        </div>
                        <div class="description-brandTechnology__product_detail">
                        "The tuning I think was done well and I absolutely recommend the LETSHUOER S12 for both newcomers and those who want to see what the hype around these second gen planar IEMs is all about."
                        </div>
                        <div class="btnReadmore-brandTechnology__product_detail">
                            Read More
                        </div>
                    </div>
                    <div class="item-brandTechnology__product_detail">
                        <div class="logo-brandTechnology__product_detail">
                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Head-Fi-Media-Review-Logo-2020.svg?v=1614287289" alt="" srcset="">
                        </div>
                        <div class="description-brandTechnology__product_detail">
                        "The tuning I think was done well and I absolutely recommend the LETSHUOER S12 for both newcomers and those who want to see what the hype around these second gen planar IEMs is all about."
                        </div>
                        <div class="btnReadmore-brandTechnology__product_detail">
                            Read More
                        </div>
                    </div>
                    <div class="item-brandTechnology__product_detail">
                        <div class="logo-brandTechnology__product_detail">
                        <img src="https://cdn.shopify.com/s/files/1/0153/8863/files/Head-Fi-Media-Review-Logo-2020.svg?v=1614287289" alt="" srcset="">
                        </div>
                        <div class="description-brandTechnology__product_detail">
                        "The tuning I think was done well and I absolutely recommend the LETSHUOER S12 for both newcomers and those who want to see what the hype around these second gen planar IEMs is all about."
                        </div>
                        <div class="btnReadmore-brandTechnology__product_detail">
                            Read More
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-product__comment">
            <div class="list-product__comment">
                <div class="item-product__comment">
                    <div class="header-product__comment">
                        <div class="part-rate__star">
                            <div class="list-star">
                                <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                <div class="item-star"><i class="fa-solid fa-star"></i></div>
                                <div class="item-star"><i class="fa-solid fa-star"></i></div>
                            </div></div>
                        <div class="part-time__post">12/09/21</div>
                    </div>
                    <div class="info-commenter">
                        <div class="avatar__commenter"><img src="http://127.0.0.1:8000/images/dnmn.jpg" alt=""></div>

                        <div class="name__commenter">Đặng Ngọc Mạnh Nhật<div class="tag__verified">Verified</div>
                    </div>
                </div>
                    <div class="main__comment">

                        <div class="title__comment">So beautifully!!!</div>
                         <div class="content__comment">
                         <div class="part-image__comment">
                            <div class="main-image__comment">
                                    <img src="http://127.0.0.1:8000/images/dnmn.jpg" alt="">
                            </div>
                            <div class="list_shortcut-image__comment">
                                <div class="item_shortcut__comment"><img src="http://127.0.0.1:8000/images/dnmn.jpg" alt=""></div>
                                <div class="item_shortcut__comment"><img src="http://127.0.0.1:8000/images/dnmn.jpg" alt=""></div>
                            </div>
                         </div>   
                        <div class="text__comment">
                            The product is top class! Excellent build quality and looks great too (deserves more than 5 stars for looks alone). Comfortable for long duration! Sound quality is great too. A satisfying experience and well worth the investment!
                            Note: Waited for 3 weeks to receive it thanks to some delivery issues!!</div>
                    <div class="part-rate_quality">
                        <div class="list-rate_quality">
                            <div class="item-rate_quality">
                                <div class="name-rate_quality">Quatity</div>
                                <div class="line-rate_quality"></div>
                            </div>
                            <div class="item-rate_quality">
                                <div class="name-rate_quality">Quatity</div>
                                <div class="line-rate_quality"></div>
                            </div>
                            <div class="item-rate_quality">
                                <div class="name-rate_quality">Quatity</div>
                                <div class="line-rate_quality"></div>
                            </div>
                        </div>
                    </div>
                         </div>
                    </div>
                    <div class="footer-product__comment">
                    <div class="btn-interact__comment btn-interact__comment__like">
                        <i class="fa-solid fa-thumbs-up"></i> <div class="value__interact value__interact__like">99</div>
                    </div>
                    <div class="btn-interact__comment btn-interact__comment__dislike">
                        <i class="fa-regular fa-thumbs-down"></i> <div class="value__interact value__interact__dislike">9</div>
                    </div>
                    </div>
                    <div class="shop__replied">
                        <div class="name-shop__replied">Life Sound</div>
                        <div class="main-shop__replied">
                            <div class="text-shop__replied">Thank you very much</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-readMore__comments">
                Read More
            </div>
        </div>
    </div>
    `)
}

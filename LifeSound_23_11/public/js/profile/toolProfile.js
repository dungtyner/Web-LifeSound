import {socket} from '../header.js';
// import toolAccount from '../accounts/toolAccount.js';



var valueMess = new ValueMess({});
console.log("Using toolProfile.js");
import * as toolCommon from "../toolCommon/toolCommon.js";
import * as toolAccount from "../accounts/toolAccount.js";

render_sidebarProfileAccount(
    [
        {
            elIcon: '<i class="fa-solid fa-user-pen"></i>',
            textTab: "Tài khoản của tôi",
        },
        {
            elIcon: '<i class="fa-regular fa-clipboard"></i>',
            textTab: "Đơn Đặt Hàng",
        },
    ],
    (listTabMenuProfile) => {
        toolCommon.setActiveInList(
            ".itemTabMenu-content__sidebar_profile",
            "active",
            listTabMenuProfile,
            "click",
            (_null, elCurrentTarget) => {
                var data_idTab = elCurrentTarget.getAttribute("data-id-tab");
                if (data_idTab === "0") {
                    render_header_BodyProfileAccount(
                        [
                            "Thông Tin Cơ Bản",
                            "Nhắn Tin",
                            "Thông Tin Địa Chỉ Giao Hàng",
                            "Thay đổi mật khẩu",
                        ],
                        (body_profile) => {
                            toolCommon.setActiveInList(
                                ".itemTab-header__body_profile",
                                "active",
                                body_profile,
                                "click",
                                (_null, elCurrentTarget) => {
                                    var data_idTab =
                                        elCurrentTarget.getAttribute(
                                            "data-id-tab"
                                        );
                                    if (data_idTab === "0") {
                                        toolAccount.getInfoBasicAccount(
                                            (data) => {
                                                render_ContentBodyProfileAccount_InfoBasic(
                                                    body_profile.querySelector(
                                                        ".content-body_profile"
                                                    ),
                                                    data
                                                );
                                                if (data.type) {
                                                    var itemRemove =
                                                        body_profile.querySelector(
                                                            '.itemTab-header__body_profile[data-id-tab="3"]'
                                                        );
                                                    if (itemRemove) {
                                                        itemRemove.remove();
                                                    }
                                                }
                                            }
                                        );
                                    } else if (data_idTab === "1") {

                                        render_ContentBodyProfileAccount_Chat(
                                            body_profile.querySelector(
                                                ".content-body_profile"
                                            )
                                        );
                                    } else if (data_idTab === "3") {
                                        toolAccount.getInfoBasicAccount(
                                            (data) => {
                                                render_ContentBodyProfileAccount_ChangPassword(
                                                    body_profile.querySelector(
                                                        ".content-body_profile"
                                                    )
                                                );
                                            }
                                        );
                                    } else {
                                        body_profile.querySelector(
                                            ".content-body_profile"
                                        ).innerHTML =
                                            elCurrentTarget.textContent;
                                    }
                                }
                            );
                            body_profile
                                .querySelector(
                                    ".itemTab-header__body_profile.active "
                                )
                                .click();
                        }
                    );
                } else if (data_idTab === "1") {
                    var body_profile = document.querySelector(".body-profile");
                    body_profile.innerHTML = elCurrentTarget.textContent;
                }
            }
        );

        listTabMenuProfile
            .querySelector(".itemTabMenu-content__sidebar_profile.active")
            .click();
    }
);
document
    .querySelector(".btnSetting-header__sidebar_profile")
    .addEventListener("click", function (event) {
        if (confirm("Bạn Có chắc Thoát???") == true) {
            toolAccount.RequestSignOut(() => {
                alert("Sign out Success");
                location.href = "/";
            });
        }
    });

function render_header_BodyProfileAccount(headers_ProfileAccount, methodWork) {
    var body_profile = document.querySelector(".body-profile");
    body_profile.innerHTML = `
                        <div class="header-body_profile">
                            <div class="sectionTabs-header__body_profile">
                                <div class="listTab-header__body_profile">
                                ${headers_ProfileAccount
                                    .map((el, idx) => {
                                        if (idx == 0) {
                                            return `
                                        <div class="itemTab-header__body_profile active" data-id-tab="${idx}">
                                            <div class="textTab-header__body_profile">
                                                ${el}
                                            </div>
                                        </div>
                                        `;
                                        }
                                        return `
                                        <div class="itemTab-header__body_profile" data-id-tab="${idx}">
                                            <div class="textTab-header__body_profile">
                                                ${el}
                                            </div>
                                        </div>
                                        `;
                                    })
                                    .join("")}
                                </div>
                            </div>
                        </div>
                        <div class="hr-body_profile">

                        </div>
                        <div class="content-body_profile">
                            
                        </div>
    `;
    if (methodWork) {
        methodWork(body_profile);
    }
}

function render_sidebarProfileAccount(arr_listTabMenuProfile, methodWork) {
    var listTabMenuProfile = document.querySelector(
        ".listTabMenu-content__sidebar_profile"
    );

    listTabMenuProfile.innerHTML = `
    ${arr_listTabMenuProfile
        .map((el, idx) => {
            if (idx == 0) {
                return `
            <div class="itemTabMenu-content__sidebar_profile active" data-id-tab="${idx}">
                <div class="btn-itemTabMenu__content__sidebar_profile">
                    ${el.elIcon}
                </div>
                <div class="text-itemTabMenu__content__sidebar_profile">
                    ${el.textTab}
                </div>
            </div>
                `;
            }
            return `
        <div class="itemTabMenu-content__sidebar_profile" data-id-tab="${idx}">
            <div class="btn-itemTabMenu__content__sidebar_profile">
                ${el.elIcon}
            </div>
            <div class="text-itemTabMenu__content__sidebar_profile">
                ${el.textTab}
            </div>
        </div>
            `;
        })
        .join("")}
        
    `;
    if (methodWork) methodWork(listTabMenuProfile);
}
function render_ContentBodyProfileAccount_InfoBasic(el_parent, data) {
    el_parent.innerHTML = `
    <div class="contentDefault-body_profile contentBasicInfo-body_profile">
                                <div class="sideInfoText-contentBasicInfo__body_profile">
                                    <div class="field-updateInfo_profile">
                                        <div class="label-updateInfo_profile">
                                            Địa chỉ Email
                                        </div>
                                        <div class="list-ipt__updateInfo_profile">
                                            <div class="itemIpt-updateInfo_profile">
                                                <div class="sectionIpt-updateInfo_profile">
                                                    <input type="email" name="" value='${data.email}' readonly="" placeholder="abc@abc.abc" id="ipt-updateEmailAccount" class="ipt-updateInfo_profile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field-updateInfo_profile">
                                        <div class="label-updateInfo_profile">
                                            Tên Đầy Đủ
                                        </div>
                                        <div class="list-ipt__updateInfo_profile">
                                            <div class="itemIpt-updateInfo_profile">
                                                <div class="sectionIpt-updateInfo_profile">
                                                    <input type="text" name="" value='${data.fname}' placeholder="First name" id="ipt-updateFnameAccount" class="ipt-updateInfo_profile">
                                                </div>
                                            </div>
                                            <div class="itemIpt-updateInfo_profile">
                                                <div class="sectionIpt-updateInfo_profile">
                                                    <input type="text" name="" placeholder="Last Name" value='${data.lname}' id="ipt-updateLnameAccount" class="ipt-updateInfo_profile" onkeydown="return /[a-z]/i.test(event.key)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="field-updateInfo_profile">
                                        <div class="label-updateInfo_profile">
                                            Số Điện Thoại
                                        </div>
                                        <div class="list-ipt__updateInfo_profile">
                                            <div class="itemIpt-updateInfo_profile">
                                                <div class="sectionIpt-updateInfo_profile">
                                                    <input type="number" name="" readonly="" placeholder="Phone Number" value=${data.account_numphone} id="ipt-updatePhoneNumAccount" class="ipt-updateInfo_profile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field-updateInfo_profile">
                                        <div class="label-updateInfo_profile">
                                            Giới Tính
                                        </div>
                                        <div class="list-ipt__updateInfo_profile">
                                            <div class="itemIpt-updateInfo_profile">
                                                <div class="sectionIpt-updateInfo_profile">
                                                    Male
                                                    <input type="radio" name="gender" id="ipt-updateGenderAccount" class="ipt-updateInfo_profile" checked="true">
                                                </div>
                                            </div>
                                            <div class="itemIpt-updateInfo_profile">
                                                <div class="sectionIpt-updateInfo_profile">
                                                    Female
                                                    <input type="radio" name="gender" id="ipt-updateGenderAccount" class="ipt-updateInfo_profile">
                                                </div>
                                            </div>
                                            <div class="itemIpt-updateInfo_profile">
                                                <div class="sectionIpt-updateInfo_profile">
                                                    Others
                                                    <input type="radio" name="gender" id="ipt-updateGenderAccount" class="ipt-updateInfo_profile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="field-updateInfo_profile" style="display:none">
                                        <div class="label-updateInfo_profile">
                                            Ngày Sinh
                                        </div>
                                        <div class="list-ipt__updateInfo_profile">
                                            <div class="itemIpt-updateInfo_profile">
                                                <div class="sectionIpt-updateInfo_profile">
                                                    <input type="Date" name="" placeholder="Birthday" id="ipt-updateBirthdayAccount" class="ipt-updateInfo_profile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sideInfoPhoto-contentBasicInfo__body_profile">
                                    <div class="sectionPhotoAvatar-contentBasicInfo__body_profile">
                                        <img src="${data.url_avatar_account}" alt="" class="imgPhotoAvatar-contentBasicInfo__body_profile">
                                        <input type="file" name="" id="ipt-updateAvatarAccount" class="ipt-updateInfo_profile" style="display:none">
                                        <div class="btn-updateAvatarAccount">Thay Đổi Ảnh đại diện</div>
                                    </div>
                                    
                                </div>
                                <div class="btnSave-contentBasicInfo__body_profile">Lưu</div>
                            </div>
                            
    `;
    el_parent
        .querySelector("#ipt-updateAvatarAccount")
        .addEventListener("change", function (event) {
            el_parent.querySelector(
                ".imgPhotoAvatar-contentBasicInfo__body_profile"
            ).src = URL.createObjectURL(event.currentTarget.files[0]);
        });
    el_parent
        .querySelector(".btn-updateAvatarAccount")
        .addEventListener("click", function () {
            el_parent.querySelector("#ipt-updateAvatarAccount").click();
        });
    el_parent
        .querySelector(".btnSave-contentBasicInfo__body_profile")
        .addEventListener("click", function (event) {
            // console.log(el_parent.querySelector('#ipt-updateAvatarAccount').files[0]);
            var avatar = el_parent.querySelector("#ipt-updateAvatarAccount")
                .files[0];
            if (avatar) {
                request_UpdateAvatarAccount(avatar);
            }
            request_UpdateInfoBasicAccount(
                el_parent.querySelector("#ipt-updateFnameAccount").value,
                el_parent.querySelector("#ipt-updateLnameAccount").value
            );
        });
}
var files_mess = [];
function render_ContentBodyProfileAccount_Chat(el_parent) {

    sessionStorage.setItem("messFiles", []);
    el_parent.innerHTML = `
        <div class='body-chatShop'>
            <div class='header-chatShop'>
                <div class='Left_header-chatShop'>
                    <div class='avatar-chatShop'>
                        <img src='https://condaluna.com/assets/stickers/music-headphones.gif' alt='' />
                    </div>
                    <div class='name-chatShop'>
                        Life Sound
                    </div>
                </div>
                <div class='Right_header-chatShop'>
                    <div class='btnInfo-chatShop'>
                        <i class="fa-solid fa-info"></i>
                    </div>
                </div>
            </div>
            <div class='content-chatShop'>

            </div>
            <div class='footer-chatShop'>
                <div class='btnDown-chatShop'>
                    <i class="fa-solid fa-circle-arrow-down"></i>
                </div>
                <div class='previewFiles-chatShop'>
                    <div class='btnAddFiles-chatShop'>
                        <i class="fa-solid fa-folder-plus"></i>
                    </div>
                    <div class='listFile-choose-chatShop'>


                    </div>
                </div>
                <div class='formMessage-chatShop'>

                    <div class='left-formMessage-chatShop'>
                        <div class='sectionFile-formMessage-chatShop'>
                            <div class='btnFile-formMessage-chatShop'>
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <input class='iptFile-formMessage-chatShop' style='display:none' type='file' />
                        </div>
                    </div>
                    <div class='center-formMessage-chatShop'>
                        <div class='sectionText-formMessage-chatShop'>
                            <input class='iptText-formMessage-chatShop' type='text' />

                        </div>
                    </div>
                    <div class='right-formMessage-chatShop'>
                        <div class='btnSubmit-formMessage-chatShop'>
                            <i class="fa-solid fa-paper-plane"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    



    var iptFile = el_parent.querySelector(".iptFile-formMessage-chatShop");
    var iptText = el_parent.querySelector(".iptText-formMessage-chatShop");
    var btnSubmit = el_parent.querySelector(".btnSubmit-formMessage-chatShop");
    btnSubmit.addEventListener("click", function (event) {
        if (event.currentTarget.classList.contains("accept")) {
            request_submitFormChat(el_parent);
        }
    });
    // lấy socket để truyền dữ liệu
    socket.on('Admin đã gửi tin nhắn', data => {
        render_A_Mess(data.value_mess,el_parent.querySelector(".body-chatShop"),false )
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:  '/account/load-chat',
        method: 'get',
        data: '',
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
    
            console.log(data);
            data.forEach(element => {
                if(element.id_send != 0) {
                    render_A_Mess( new ValueMess({text: element.mess_text?element.mess_text:'', image: element.mess_image?[element.mess_image]:[] }), el_parent.querySelector(".body-chatShop"), true);
                } else {
                    render_A_Mess( new ValueMess({text: element.mess_text?element.mess_text:'', image: element.mess_image?[element.mess_image]:[] }), el_parent.querySelector(".body-chatShop"), false);
                    
                }
                var content_chatShop = el_parent.querySelector(".content-chatShop"); 
                content_chatShop.scrollTo(0, content_chatShop.scrollHeight);
            });
        },
        error: function() {
            console.log('load k được');
        }
    }); 



    iptText.addEventListener("keyup", (event) => {
        if (event.keyCode == 13) {
            request_submitFormChat(el_parent);
        } else {
            loadSubmitFormChat(el_parent);
        }
    });
    iptText.addEventListener("focus", (event) => {
        loadSubmitFormChat(el_parent);
    });
    iptText.addEventListener("blur", (event) => {
        loadSubmitFormChat(el_parent);
    });
    iptFile.addEventListener("change", (event) => {
        console.log(files_mess.length);
        if (files_mess.length > 0) {
            files_mess = Files_to_ArrFile(
                Object.entries(event.currentTarget.files)
            ).concat(files_mess);
            loadReviewFileChatShop(
                document.querySelector(".previewFiles-chatShop"),
                files_mess
            );
        } else {
            files_mess = Files_to_ArrFile(
                Object.entries(event.currentTarget.files)
            );
        }
        sessionStorage.setItem(
            "messFiles",
            JSON.stringify(event.currentTarget.files)
        );
        loadReviewFileChatShop(
            document.querySelector(".previewFiles-chatShop"),
            files_mess
        );
    });
    el_parent
        .querySelector(".btnAddFiles-chatShop")
        .addEventListener("click", () => {
            iptFile.click();
        });
    el_parent
        .querySelector(".btnFile-formMessage-chatShop")
        .addEventListener("click", function (event) {
            iptFile.click();
        });
    var content_chatShop = el_parent.querySelector(".content-chatShop");

    content_chatShop.addEventListener("scroll", (event) => {
        var el = event.currentTarget;
        if (el.scrollTop <= el.scrollHeight - el.scrollTop - 350) {
            el_parent
                .querySelector(".btnDown-chatShop")
                .classList.add("showNow");
        } else {
            el_parent
                .querySelector(".btnDown-chatShop")
                .classList.remove("showNow");
        }
    });
    content_chatShop.scrollTo(0, content_chatShop.scrollHeight);
    el_parent
        .querySelector(".btnDown-chatShop")
        .addEventListener("click", () => {
            content_chatShop.scrollTo(0, content_chatShop.scrollHeight);
        });
    content_chatShop.scrollTo(0, content_chatShop.scrollHeight);
}
function request_submitFormChat(el_parent) {
    valueMess.text = getIptTextFormChat(el_parent);
    

    // console.log('line 506: ', valueMess.image);

    let listFileMess = [];
    let count = 0;
    for(let fileD of valueMess.image) {
        listFileMess[listFileMess.length] = new File([fileD],`mess_file${count+1}${fileD.name}`,{
            type:fileD.type,lastModified:fileD.lastModified});
            count = count + 1;
    }

    var form  = new FormData();
    form.append('mess_text', valueMess.text);
    for(let i = 0; i < listFileMess.length; i++) {
        form.append('mess_image'+i.toString(), listFileMess[i]);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:  '/account/upload-file-chat',
        method: 'post',
        data: form,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(data) {
    
            let valMss = new ValueMess({text: data.mess_text, image: data.mess_image?data.mess_image:[] });
            render_A_Mess(valMss , el_parent.querySelector(".body-chatShop"), true);
            socket.emit('Khách hàng gửi tin nhắn', {data_account: toolAccount.data_account, value_mess: valMss});
        },
        error: function() {
            console.log('load k được');
        }
    }); 

    resetFromChat(el_parent.querySelector('.body-chatShop .footer-chatShop'));
}
export {ValueMess} ;



function ValueMess({ text = "", video = [], image = [] }) {
    this.image = image;
    this.video = video;
    this.text = text;
}
function Files_to_ArrFile(Files) {
    return Files.map((el) => {
        return el[1];
    });
}

function loadReviewFileChatShop(elFileChatShop, dataFiles) {
    loadSubmitFormChat(
        elFileChatShop
            .closest(".footer-chatShop")
            .querySelector(".formMessage-chatShop")
    );
    elFileChatShop.querySelector(".listFile-choose-chatShop").innerHTML = ``;
    if (dataFiles.length > 0) {
        // console.log('?????');
        elFileChatShop.classList.add("showNow");

        // elFileChatShop.querySelector('.btnAddFiles-chatShop').style.display='flex';

        elFileChatShop
            .closest(".footer-chatShop")
            .querySelector(".btnFile-formMessage-chatShop").style.display =
            "none";

        // valueMess = new ValueMess({});
        elFileChatShop.querySelector(".listFile-choose-chatShop").innerHTML =
            dataFiles
                .map((el, idx) => {
                    return render_reviewFileChatShop(el, idx);
                })
                .join("");
        // console.log(valueMess);
        var btn_Removes = elFileChatShop.querySelectorAll(
            ".btnRemove-choose-chatShop"
        );
        btn_Removes.forEach((el, idx) => {
            el.addEventListener("click", (event) => {
                files_mess.splice(
                    parseInt(
                        event.currentTarget
                            .closest(".File-choose-chatShop")
                            .getAttribute("data-idx")
                    ),
                    1
                );

                loadReviewFileChatShop(elFileChatShop, files_mess);
            });
        });
    } else {
     valueMess = new ValueMess({image:[]});
        elFileChatShop.classList.remove("showNow");
        elFileChatShop
        .closest(".footer-chatShop")
        .querySelector(".btnFile-formMessage-chatShop").style.display =
        "block";
        elFileChatShop
        .closest(".footer-chatShop")
        .querySelector(".iptFile-formMessage-chatShop").value = '';
        elFileChatShop
        .closest(".footer-chatShop")
        .querySelector(".iptFile-formMessage-chatShop").files=null;
        console.log(elFileChatShop
            .closest(".footer-chatShop")
            .querySelector(".iptFile-formMessage-chatShop").files,valueMess);
    }
}

function render_reviewFileChatShop(dataFile, idx) {
    switch (dataFile.type.split("/")[0]) {
        case "image":
            valueMess.image.push(dataFile);
            console.group("ren");
            // console.log(dataFile);
            // console.log(valueMess);
            console.groupEnd("ren");
            return `
            <div class='File-choose-chatShop' data-idx='${idx}'>
            <div class='btnRemove-choose-chatShop'><i class="fa-regular fa-circle-xmark"></i></div>
            <img src='${URL.createObjectURL(dataFile)}' alt =''/>
            </div>
            `;

        case "video":
            valueMess.video.push(dataFile);
            return `
            <div class='File-choose-chatShop' data-idx='${idx}'>
            <div class='btnRemove-choose-chatShop'><i class="fa-regular fa-circle-xmark"></i></div>
    
            <video src='${URL.createObjectURL(dataFile)}' />
            </div>
            `;
        default:
            return null;
    }
}
function getIptTextFormChat(el_parent) {
    var iptText = el_parent.querySelector(".iptText-formMessage-chatShop");
    return iptText.value;
}
function loadSubmitFormChat(el_parent) {
    var btnSubmit = el_parent.querySelector(".btnSubmit-formMessage-chatShop");

    if (getIptTextFormChat(el_parent).length != 0 || files_mess.length != 0) {
        btnSubmit.classList.add("accept");
    } else {
        btnSubmit.classList.remove("accept");
    }
}
function render_A_Mess(valueMess, el_parent, isMe) {
    var sessionMessage = document.createElement("div");
    sessionMessage.className = `sessionMessage-chatShop ${isMe ? "isMe" : ""}`;
    console.log(Object.entries(valueMess));
    Object.entries(valueMess).map((el) => {
        if (el[1].length > 0 && typeof el[1].length !== undefined) {
            switch (el[0]) {
                case "image":
                    sessionMessage.innerHTML += `
                ${el[1].map(elm=>{
                    return `
                    <div class="message-chatShop ${isMe ? "isMe" : ""}">
                    <img src="${elm}" alt="">
                </div>
                    `
                })}
        `;

                    break;
                case "video":
                    sessionMessage.innerHTML += `
                ${
                    el[1].map(elm=>{
                        return `
                        <div class="message-chatShop ${isMe ? "isMe" : ""}">
                        <video src="${elm}" controls="">
                    </video></div>
                        `
                    })
                }
                
            `;
                    break;
                case 'text':
                sessionMessage.innerHTML+=
                        `
                        <div class="message-chatShop ${isMe ? "isMe" : ""}">
                        ${el[1]}
                        </div>
                        `
                    break;
                default:
                    sessionMessage.innerHTML = "";
            }
        }
        el_parent
            .querySelector(".content-chatShop")
            .appendChild(sessionMessage);

            resetFromChat(el_parent.querySelector('.footer-chatShop'));
    });
}
function resetFromChat(el_parent)
{
    // console.log('reset');
    var iptText = el_parent.querySelector(".iptText-formMessage-chatShop");
    iptText.value=''
    files_mess=[]
    loadReviewFileChatShop(el_parent.querySelector('.previewFiles-chatShop'),files_mess)

}
function render_ContentBodyProfileAccount_ChangPassword(el_parent) {
    el_parent.innerHTML = `
    <div class="contentDefault-body_profile contentChangePass-body_profile">
            <section class="section__form">
                <h1>Hi, welcome back</h1>
                
                <div class="show__note">
                    <strong>Note: </strong> 
                </div>
                
                <form action="" method="post" class="formSignInPopUp">
                    <div class="field input__text">
                        <input type="password" name="password" id="pass" class="ipt-oldPass__changePass" placeholder="Enter old password" value="" required="">
                        <button class="btn__show__password" type="button" id="btnPassword">
                            <i class="fa-solid fa-eye"></i>
                        </button>                      
                    </div>
                
                    <div class="field input__text">
                        <input type="password" name="password" id="pass" class="ipt-newPass__changePass" placeholder="Enter new password" value="" required="">
                        <button class="btn__show__password" type="button" id="btnPassword">
                            <i class="fa-solid fa-eye"></i>
                        </button>                      
                    </div>
                    <div class="field-ipt-CodeEmail">
                    <input type="text" class="ipt-CodeEmail" placeholder="Code from email">
                    </div>
                    <div class="field button">
                        <input class="btn-Submit__formSignIn"  name="submit" type='submit' value="Restore" required="">
                    </div>
                </form>
        </section>
    </div>
    
    `;

    toolAccount.showPassWord(
        ".field.input__text",
        el_parent.querySelectorAll(".btn__show__password")
    );
    el_parent
        .querySelector(".btn-Submit__formSignIn")
        .addEventListener("click", function (event) {
            event.preventDefault();
            toolAccount.RequestChangePass(el_parent, () => {});
        });
}

function request_UpdateInfoBasicAccount(fname, lname) {
    var form = new FormData();
    form.append("fname", fname);
    form.append("lname", lname);

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 200 && this.status == 4) {
        }
    };
    xmlHttp.open("POST", "/account/updateInfoBasicAccount");
    xmlHttp.setRequestHeader(
        "X-CSRF-TOKEN",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    );
    xmlHttp.send(form);
}
function request_UpdateAvatarAccount(obj_file) {
    var form = new FormData();
    form.append("avatar", obj_file);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState == 200 && this.status == 4) {
        }
    };
    xmlHttp.open("POST", "/account/updateAvatarAccount");
    xmlHttp.setRequestHeader(
        "X-CSRF-TOKEN",
        document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content")
    );
    xmlHttp.send(form);
}

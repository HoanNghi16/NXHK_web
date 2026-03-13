function validPassword(e){
    console.log('tới đây rồi nè')
    let password = e.value;
    let error = document.getElementById('password-error');
    if (!password || password == ""){
        error.innerHTML = "Mật khẩu không được để trống";
        return false;
    }else if(password.length < 6){
        error.innerHTML = "Mật khẩu phải có ít nhất 6 ký tự";
        return false;
    }else{
        error.innerHTML = "";
        return true;
    }
}
function validEmail(e) {
    console.log('tới đây rồi nè')
    email = e.value;
    let error = document.getElementById("email-error");
    if (!email || email == "") {
        error.innerHTML = "Email không được để trống";
        return false;
    }
    console.log(email);
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!re.test(email)) {
        error.innerHTML = "Email không hợp lệ";
        return false;
    }
    error.innerHTML = "";
    return true;
}

function validName(e){
    let name = e.value;
    let pattern = /^[A-ZÀ-ỸĐ][a-zà-ỹđ]*\s([A-ZÀ-ỸĐ][a-zà-ỹđ]*)(\s[A-ZÀ-ỸĐ][a-zà-ỹđ]*)*$/;
    let error = document.getElementById('name-error')
    if (name.length == 0){
        error.innerHTML='Vui lòng nhập họ tên'
        return false
    }
    else if (pattern.test(name)){
        error.innerHTML='';
        return name;
    }
    else{
        error.innerHTML='Họ tên sai định dạng'
        return false
    }
}
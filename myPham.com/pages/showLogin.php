<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hasaki</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<script>
    function validateform() {
        var userName = document.getElementById('userName').value;
        var Password = document.getElementById('Password_login').value;
        var recaptchaResponse = document.getElementById('g-recaptcha-response').value;

        var NameError = document.getElementById('userNameError_login');
        var userNameRegex = /^[A-Za-z0-9_.]{6,32}$/;

        if (userName.length === 0) {
            NameError.textContent = "Vui lòng nhập tên đăng nhập";
            return false;
        } else if (userName.length < 6) {
            NameError.textContent = "Tên đăng nhập phải có ít nhất 6 ký tự";
            return false;
        } else if (userName.length > 32) {
            NameError.textContent = "Tên đăng nhập không được vượt quá 32 ký tự";
            return false;
        } else if (!userNameRegex.test(userName)) {
            NameError.textContent = "Tên đăng nhập chỉ được chứa chữ cái, số, dấu chấm và dấu gạch dưới";
            return false;
        } else {
            NameError.textContent = "";
        }


        var passError = document.getElementById('password_loginErro');
        var passwordRegex = '/^([\w_\.!@#$%^&*()]+){6,31}$/';


        if (Password.length === 0) {
            passError.textContent = "Vui lòng nhập mật khẩu!";
            return false;
        } else if (Password.length < 6) {
            passError.textContent = "Mật khẩu phải có ít nhất 6 ký tự!";
            return false;
        } else if (Password.length > 32) {
            passError.textContent = "Mật khẩu không được vượt quá 32 ký tự";
            return false;
        } else if (!passwordRegex.test(Password)) {
            passError.textContent = "Mật khẩu không đáp ứng yêu cầu: phải bắt đầu bằng chữ cái đầu viết hoa, bao gồm chữ cái, số, và các ký tự đặc biệt.";
            return false;
        } else {
            passError.textContent = "";
        }



        var recapError = document.getElementById('recaptchaError');
        if (recaptchaResponse.trim() === '') {
            recapError.textContent = "Vui lòng xác minh bạn không phải là người máy!";
            return false;
        } else {
            recapError.textContent = "";
        }

        return true;
    }

    function register_validateForm() {
        var userName = document.getElementById('userNamerg').value;
        var password = document.getElementById('passwordrg').value;
        var confirmPassword = document.getElementById('confirmPassword').value;
        var email = document.getElementById('email').value;

        var userNameRegex = /^[A-Za-z0-9_.]{6,32}$/;
        var NameError = document.getElementById('userNameError');
        if (userName.length === 0) {
            NameError.textContent = "Vui lòng nhập tên đăng nhập";
            return false;
        } else if (userName.length < 6) {
            NameError.textContent = "Tên đăng nhập phải có ít nhất 6 ký tự";
            return false;
        } else if (userName.length > 32) {
            NameError.textContent = "Tên đăng nhập không được vượt quá 32 ký tự";
            return false;
        } else if (!userNameRegex.test(userName)) {
            NameError.textContent = "Tên đăng nhập chỉ được chứa chữ cái, số, dấu chấm và dấu gạch dưới";
            return false;
        } else {
            NameError.textContent = "";
        }

        var passError = document.getElementById('passwordError');
        var passwordRegex = /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/;

        if (password.length === 0) {
            passError.textContent = "Vui lòng nhập mật khẩu!";
            return false;
        } else if (password.length < 6) {
            passError.textContent = "Mật khẩu phải có ít nhất 6 ký tự!";
            return false;
        } else if (password.length > 32) {
            passError.textContent = "Mật khẩu không được vượt quá 32 ký tự";
            return false;
        } else if (!passwordRegex.test(password)) {
            passError.textContent = "Mật khẩu không đáp ứng yêu cầu: phải bắt đầu bằng chữ cái đầu viết hoa, bao gồm chữ cái, số, và các ký tự đặc biệt.";
            return false;
        } else {
            passError.textContent = "";
        }

        var confirmPass = document.getElementById('confirmError');
        if (confirmPassword !== password) {
            confirmPass.textContent = "Xác nhận mật khẩu không khớp";
            return false;
        } else {
            confirmPass.textContent = "";
        }

        var email_erorr = document.getElementById('emailError');
        var emailRegex = /^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(\.[a-zA-Z]{2,12})+$/;

        if (email.length === 0) {
            emailError.textContent = "Vui lòng nhập email của bạn";
            return false;
        } else if (!emailRegex.test(email)) {
            emailError.textContent = "Email không hợp lệ. Vui lòng kiểm tra lại!. Hãy nhập đúng định dạng";
            return false;
        } else {
            emailError.textContent = "";
        }

        return true;
    }
</script>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form onsubmit="return register_validateForm()" id="register">
                <h1>Tạo tài khoản</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span> hoặc sử dụng email của bạn để đăng ký</span>
                <input type="text" placeholder="Name:abcdef" name="userName" id="userNamerg" />
                <span class="text_error" id="userNameError"> </span>

                <input type="password" placeholder="Password:abcd1234" name="password" id="passwordrg" />
                <span class="text_error" id="passwordError"> </span>

                <input type="password" placeholder="Confirm Password:abcd1234" name="confirmPassword" id="confirmPassword" />
                <span class="text_error" id="confirmError"> </span>

                <input type="email" placeholder="Email:abc@gmail.com" name="email" id="email" />
                <span class="text_error" id="emailError"> </span>

                <button type="submit" name="btn_dangKy">Đăng ký</button>
            </form>

        </div>
        <div class="form-container sign-in-container">
            <form onsubmit="return validateform()" id="loginForm">
                <h1>Đăng nhập</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng tài khoản của bạn</span>
                <input type="text" placeholder="userName" name="userName" id="userName" />
                <span class="text_error" id="userNameError_login"> </span>
                <input type="password" placeholder="Password" name="Password" id="Password_login" />
                <span class="text_error" id="password_loginErro"> </span>

                <div class="g-recaptcha" data-sitekey="6LcpksYpAAAAAL7T3R1g6TunuttL4WQfSv9a4Iqu" data-action="LOGIN"></div>
                <span class="text_error" id="recaptchaError"> </span>
                <div class="remember-me-container">
                    <input type="checkbox" name="remember_me" id="remember_me" style="width: 30px;">
                    <label for="remember_me" style="text-align: right;">Ghi nhớ đăng nhập</label>
                </div>
                <a href="?page=forgotPassWord">Quên mật khẩu?</a>
                <button type="submit" name="btn_dangNhap">
                    Đăng nhập</button>

            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Hasaki!</h1>
                    <p>Để duy trì kết nối với chúng tôi vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
                    <button class="ghost" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào, Bạn!</h1>
                    <p>Nhập thông tin cá nhân của bạn và bắt đầu hành trình với chúng tôi</p>
                    <button class="ghost" id="signUp">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        var username = getCookie('username');
        var password = getCookie('password');
        if (username && password) {
            $('#userName').val(username);
            $('#Password_login').val(password); 
            $('#remember_me').prop('checked', true);
        }

        $('#loginForm').on('submit', function() { // Sửa ID thành 'loginForm'
            if ($('#remember_me').is(':checked')) {
                setCookie('username', $('#userName').val(), 30);
                setCookie('password', $('#Password_login').val(), 30);
            } else {
                setCookie('username', '', -1);
                setCookie('password', '', -1);
            }
        });
        $('#register').on('submit', function(e) {
            e.preventDefault();
            var userName = $('#userNamerg').val();
            var passwoord = $('#passwordrg').val();
            var confirmPassword = $('#confirmPassword').val();

            var email = $('#email').val();
            data = {
                userName: userName,
                passwoord: passwoord,
                email: email,
                confirmPassword: confirmPassword
            };

            $.ajax({
                url: '?page=register',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Xử lý lỗi nếu có
                    console.error('Error:', error);
                }
            });


        })
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            var userName = $('#userName').val();
            var password = $('#Password_login').val();
            var recaptchaResponse = grecaptcha.getResponse();

            var data_login = {
                userName: userName,
                password: password,
                recaptchaResponse: recaptchaResponse
            };

            $.ajax({
                url: '?page=login',
                type: 'POST',
                data: data_login,
                dataType: 'json', // Expecting JSON response from the server
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.href = '?page=trangChu';
                    } else if (response.status === 'admin') {
                        window.location.href = './admin/?page=list_post';
                    } else {
                        alert(response.message); // Hiển thị thông báo lỗi nếu không thành công
                    }
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra: ' + error);
                }
            });
        });



    });

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        // Thiết lập thời gian sống của cookie
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        // Tạo chuỗi hết hạn của cookie
        let expires = "expires=" + d.toUTCString();
        // Thiết lập cookie trong tài liệu
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        // Giải mã cookie
        let decodedCookie = decodeURIComponent(document.cookie);
        // Tách chuỗi thành mảng các cookie
        let ca = decodedCookie.split(';');
        // Duyệt qua từng cookie trong mảng
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            // Loại bỏ dấu cách ở đầu cookie
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            // Nếu tên của cookie khớp, trả về giá trị của cookie đó
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        // Nếu không tìm thấy cookie, trả về chuỗi rỗng
        return "";
    }
</script>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add('right-panel-active');
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove('right-panel-active');
    });
</script>
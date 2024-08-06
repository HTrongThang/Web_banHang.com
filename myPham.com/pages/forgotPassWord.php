<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu hasaki</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/login.css">

</head>
<script>
    function forgotPassword_validateform() {
        var email = document.getElementById('email').value;
        var error_email = document.getElementById('emailError');
        if (email.length === 0) {
            error_email.textContent = "Vui lòng nhập dữ liệu vào email";
            return false;
        } else {
            error_email.textContent = "";
        }
        return true;
    }
</script>



<body>
    <div class="container" id="container">   
        <div class="form-container sign-in-container">
            <form id="forgot-password-form"  method="post" onsubmit="return forgotPassword_validateform()">
                <h1>Quên mật khẩu</h1>

                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span> Sử dụng email của bạn đã đăng ký</span>
                <input type="email" placeholder="Email: abc@gmail.com" name="email" id="email" />
                <span class="text_error" id="emailError"> </span>
                <a href="?page=showLogin">Đăng Nhập ?</a>

                <button type="submit" name="btn_guiYeuCau">
                    Gửi yêu cầu</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
             
                <div class="overlay-panel overlay-right">
                    <h1>Welcome Hasaki!</h1>
                    <p style="margin: 0px; padding: 10px 0px 0px 0px;">Bạn có thể lấy lại mật khẩu ngay tại đây</p>
                    <p style="margin: 0px; padding: 10px 0px 0px 0px;">Vui lòng nhập thông tin cá nhân của bạn để lấy lại mật khẩu</p>
                    <p style="margin: 0px; padding: 10px 0px 0px 0px;">Để duy trì kết nối với chúng tôi vui lòng đổi mật khẩu mới tài khoản của bạn</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('#forgot-password-form').on('submit', function(e) {
            e.preventDefault();
            var email = $('#email').val();

            $.ajax({
                type: 'POST',
                url: '?page=xl_quenMatKhau',
                data: {
                    email: email
                },
                success: function(data) {
                    alert(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
</script>
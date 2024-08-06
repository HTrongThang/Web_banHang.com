<style>
.contact-container {
    display: flex;
    justify-content: space-between;
}

.contact-form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.contact-form h3 {
    margin-bottom: 20px;
    color: #333;
}

.contact-form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

.contact-form input[type="text"],
.contact-form input[type="email"],
.contact-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.contact-form textarea {
    resize: vertical;
    min-height: 100px;
}

.contact-form button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.contact-form button[type="submit"]:hover {
    background-color: #0056b3;
}

</style>
<div id="main-content-wp" class="category-news-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=trangChu" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thông tin cửa hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="clearfix wp-inner">
        <div class="container contact-container">
            <div class="col-md-6">
                <div class="contact-form">
                    <h3>Gửi thông tin liên hệ</h3>
                    <form action="?page=submit_contact" method="post">
                        <div class="form-group">
                            <label for="name">Họ và tên:</label>
                            <input type="text" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Nội dung tin nhắn:</label>
                            <textarea name="message" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit">Gửi</button>
                    </form>
                </div>
            </div>
            <div class="row"  style="width: 100%; padding-left: 30px;">
                <div class="">
                    <div class="contact-info">
                        <h3>Thông tin Cửa Hàng</h3>
                        <p><strong>Tên:</strong> Hà Trọng Thắng</p>
                        <p><strong>Số điện thoại:</strong> 0356587127</p>
                        <p><strong>Email:</strong> trongthang412003@gmail.com</p>
                    </div>
                    <div class="google-map">
                        <h3>Bản đồ</h3>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0624766960523!2d106.6262867749703!3d10.806526989344071!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752be2853ce7cd%3A0x4111b3b3c2aca14a!2zMTQwIEzDqiBUcuG7jW5nIFThuqVuLCBUw6J5IFRo4bqhbmgsIFTDom4gUGjDuiwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1698881926269!5m2!1svi!2s" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div id="modal-register" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-body">
        <div class="modal-header">
            <h2 class="modal-title">Đăng Ký Khóa Học</h2>
            <p class="uk-text-muted">Vui lòng điền thông tin để chúng tôi tư vấn cho bạn</p>
        </div>
        <div class="success-message" id="successMessage">
            <div class="uk-alert-success" uk-alert>
                <p><strong>Thành công!</strong> Chúng tôi đã nhận được thông tin đăng ký của bạn. Chúng tôi sẽ liên hệ với bạn sớm nhất.</p>
            </div>
        </div>
        <form action="" method="POST" class="register-form" id="registerForm">
            <div class="form-group">
                <label class="form-label" for="email">Email <span class="uk-text-danger">*</span></label>
                <input type="email" name="email" value="" class="form-input" id="reg_email" placeholder="Nhập vào email của bạn" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="name">Họ tên <span class="uk-text-danger">*</span></label>
                <input type="text" name="name" value="" class="form-input" id="reg_name" placeholder="Nhập vào họ tên của bạn" required>
            </div>
            
            <div class="form-group">
                <label class="form-label" for="phone">Số điện thoại <span class="uk-text-danger">*</span></label>
                <input type="tel" name="phone" value="" class="form-input" id="reg_phone" placeholder="Nhập vào số điện thoại của bạn" required>
            </div>
            
            <input type="hidden" name="product_id" value="{{ $name }}" class="form-input" id="reg_product_name" >
            
            <div class="form-group">
                <label class="form-label" for="message">Lời nhắn</label>
                <textarea name="message" class="form-input" id="reg_message" cols="30" rows="4" placeholder="Lời nhắn của bạn (tùy chọn)"></textarea>
            </div>
            <div class="uk-flex">
                <button type="submit" class="register-btn">
                    <span uk-icon="check"></span>
                    Đăng ký ngay
                </button>
            </div>
        </form>
    </div>
</div>

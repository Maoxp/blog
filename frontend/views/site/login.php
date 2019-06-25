<?php
$this->title = 'Welcome';

use yii\helpers\Url;
?>

<div class="lowin-wrapper">
    <div class="lowin-box lowin-login">
        <div class="lowin-box-inner">
            <form method="post">
                <p>欢迎使用,「Clean Blog」</p>
                <div class="lowin-group">
                    <label>账号 <a href="#" class="login-back-link">Sign In?</a></label>
                    <?php
                    if (!empty($error['username'])) {
                        echo '<p class="p-display" style="color: #ff6464">' . $error['username'][0] . '</p>';
                    }
                    ?>
                    <input type="text" autocomplete="username" name="username" class="lowin-input" required>
                </div>
                <div class="lowin-group password-group">
                    <label>密码 <a href="#" class="forgot-link">忘记密码?</a></label>
                    <?php
                    if (!empty($error['password'])) {
                        echo '<p class="p-display" style="color: #ff6464">' . $error['password'][0] . '</p>';
                    }
                    ?>
                    <input type="password" name="password" autocomplete="current-password" class="lowin-input" required>
                </div>
                <button class="lowin-btn login-btn">
                    登录
                </button>

                <div class="text-foot">
                    还没有账号? <a href="" class="register-link">注册一下</a>
                </div>
            </form>
        </div>
    </div>

    <div class="lowin-box lowin-register">
        <div class="lowin-box-inner">
            <form action="#" method="post" id="form_register">
                <p>Let's create your account</p>
                <div class="lowin-group">
                    <label>账号</label>
                    <input type="text" name="name" autocomplete="name" class="lowin-input" id="register-name" required>
                </div>
                <div class="lowin-group">
                    <label>邮箱</label>
                    <input type="email" autocomplete="email" name="email" class="lowin-input" id="register-email"
                           required>
                </div>
                <div class="lowin-group">
                    <label>密码</label>
                    <input type="password" name="password" autocomplete="current-password" id="register-pwd"
                           class="lowin-input" required>
                </div>

                <button class="lowin-btn">注册</button>
                <div class="text-foot">
                    已有账号? <a href="" class="login-link">登录</a>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="lowin-footer">
    Design By @itskodinger. See Home <a href="/" target="_blank" title="博客首页">博客首页</a>
</footer>
<?php
$js = <<<JS
function delayTime() {
    setTimeout(function() {
      $(".p-display").remove()
     }, 3000);
}
 $('#form_register').submit(function() {
    $.ajax({
        type: "post",
        url: "/site/signup",
        dataType: "json",
        data: {
            'name': $("#register-name").val(),
            'email': $("#register-email").val(),
            'password': $("#register-pwd").val(),
        },
        success: function(result) {
                console.log(result);
                if (result.status) {
                    $(".login-link").after('<h2  style="color: #73ff64">✔ '+result.msg+'</h2>');
                    setTimeout(function() {
                      window.location.href='/site/login';
                    }, 2000);
                } else {
                  var _this;
                  if ('username' in result.data) {
                      _this = $("#register-name");
                      _this.prev().after('<p class="p-display" style="color: #ff6464">'+ result.data.username[0] + ' </p>');
                  }else if ('email' in result.data) {
                       _this = $("#register-email");
                      _this.prev().html('<p class="p-display" style="color: #ff6464">'+ result.data.email[0] + ' </p>');
                  } else if ('password' in result.data) {
                       _this = $("#register-pwd");
                      _this.prev().html('<p class="p-display" style="color: #ff6464">'+ result.data.password[0] + ' </p>');
                  }
                 delayTime();
                }
        }
    });
    return false;
});
delayTime();
JS;
$this->registerJs($js);
?>


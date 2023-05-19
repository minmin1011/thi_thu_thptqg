<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= Config::TITLE ?>
	</title>
	<link rel="stylesheet" href="res/css/style.min.css">
	<link rel="stylesheet" href="res/css/font-awesome.css">
	<link rel="stylesheet" href="res/css/materialize.min.css">
	<script src="res/js/jquery.js"></script>
	<script src="res/js/login.js"></script>
	<script src="res/js/materialize.min.js"></script>
</head>

<body class="bg-login">
	<div id="status" class="status"></div>
	<div class="fade">
		<div class="login-page__lang">
			<div class="lang__box">
				<div class="icon-box">
					<div class="icon-vn"></div>
				</div>
				<div class="title-lang" onclick="choose_lang()">Tiếng Việt</div>
			</div>
		</div>
		<div class="login fadeInLogin">
			<div class="box-title-login">
				
				<div class="title-login">
					<button id="reload" class="material-icons" onclick="reload()" title="Quay lại">arrow_back</button>
					HỆ THỐNG THI THỬ THPT
				</div>
			</div>
			<div class="login-form">
				<div class="row" style="position: relative;">
					<img src="/res/img/loading.gif" alt="" id="loading" class="img-loading hidden">
					<form>
						<div class="input-field" id="field_username">
							<input type="text" name="username" id="username" required autofocus>
							<label for="username" id="lbl_usr">Tài Khoản</label>
							<div class="left-align" style="color: #3c763d;">
							</div>
						</div>
						<div class="left-align custom-title" style="color: #3c763d;">
							<div id="hi" style="display: none;">Xin Chào: <b><span id="hi-text" style="color: blue; font-weight: bold"></span></b>, nhập mật khẩu để tiếp tục.</div>
						</div>
						<div class="input-field" id="field_password">
							<input type="password" name="password" id="password" class="hidden" required>
							<label for="password" id="lbl_pw" class="hidden">Mật Khẩu</label>
						</div>
						<div class="forgot-btn">
							<button class="forgot-password" onclick="submit_forgot_password()" id="btn-fotgot">Quên mật khẩu?</button>
						</div>
						<div class="login-btn">
							<button type="submit" class="login-form-btn" onclick="submit_login()" id="btn-login">Đăng Nhập</button>
						</div>
						<div class="box-login--register">
							<span>Chưa có tài khoản?</span>
							<a href="register.php" class="register">Đăng ký</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
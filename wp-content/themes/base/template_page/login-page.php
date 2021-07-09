<div>
	<div class="social-links">
		<div class="social-links__item">
		  <a href="<?php echo auth_fb_url ?>" class="social-link">
			<i class="fab fa-facebook-f"></i>
		  </a>
		</div>
		<div class="social-links__item">
		  <a href="<?php echo auth_google_url ?>" class="social-link">
			<i class="fab fa-google"></i>
		  </a>
		</div>
		<div class="social-links__item">
		  <a href="<?php echo auth_li_url ?>" class="social-link">
			<i class="fab fa-linkedin-in"></i>
		  </a>
		</div>
	</div>
	
	<form action="#uID" method="POST" class="login__form">
		<label>
			Email address
			<input type="email" name="useremail" placeholder="Enter your email address" required/>
		</label>
		<label>
			Password
			<input class="form-control" name="password" type="password" placeholder="Enter your password" required>
		</label>
		<div class="login__forgot">
			<a href="#forgot-password" class="forgot-password-popup link link--small">Forgot your password?</a>
		</div>
		<input type="hidden" name="user_login_form" value="1">
		<button class="btn btn-primary btn-block" type="submit">Login</button>
	</form>
</div>
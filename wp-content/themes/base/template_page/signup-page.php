<div class="tabs" id="tabs"><?php
	$tab_1 = '';
	$tab_2 = '';
	$tab_3 = '';
	
	if(!isset($GLOBALS['get_employer_google_fname'])  &&
	   !isset($GLOBALS['get_employer_fb_fname'])      &&
	   !isset($GLOBALS['get_recruiter_google_fname']) &&
	   !isset($GLOBALS['get_recruiter_fb_fname'])     &&
	   !isset($GLOBALS['get_employer_li_fname'])      &&
	   !isset($GLOBALS['get_recruiter_li_fname'])
	){
		$tab_1 = 'active';
	}
	
	if(isset($GLOBALS['get_employer_google_fname'])  ||
	   isset($GLOBALS['get_employer_fb_fname'])      ||
	   isset($GLOBALS['get_employer_li_fname'])
	){
		$tab_2 = 'active';
	}
	
	if(isset($GLOBALS['get_recruiter_google_fname']) ||
	   isset($GLOBALS['get_recruiter_fb_fname'])     ||
	   isset($GLOBALS['get_recruiter_li_fname'])
	){
		$tab_3 = 'active';
	} ?>
	
	<ul class="tabs__navigation-list">
		<li class="tabs__navigation-item">
			<a href="#tabs-1" class="tabs__navigation-link <?php echo $tab_1 ?>">TALENT</a>
			<span class="link-underline"></span>
		</li>
		<li class="tabs__navigation-item">
			<a href="#tabs-2" class="tabs__navigation-link <?php echo $tab_2 ?>">EMPLOYER</a>
			<span class="link-underline"></span>
		</li>
		<li class="tabs__navigation-item"> 
			<a href="#tabs-3" class="tabs__navigation-link <?php echo $tab_3 ?>">RECRUITER</a>
			<span class="link-underline"></span>
		</li>							
	</ul>
	
	<div class="tab-container <?php echo $tab_1 ?>" id="tabs-1">
		<form class="form__talent" id="reg_talent_form" action="<?php echo getSEFfile('upload-resume.php') ?>" method="post">
			<div class="tab last">
				<div class="tabs__title">
					<h2>We Bring Job Offers to You</h2>
					<p>Join thousands of people who’ve found their dream job using Wona.</p>
				</div>
				<div class="social-links">
					<div class="social-links__item social-links__item--facebook">
						<a href="<?php echo auth_fb_talent_url ?>" class="social-link" name="facebook">
							<i class="fab fa-facebook-f"></i>
							<span>Sign Up</span>
						</a>
					</div>
					<div class="social-links__item social-links__item--google">
						<a href="<?php echo auth_google_reg_talent_url ?>" class="social-link" name="google">
							<i class="fab fa-google"></i>
							<span>Sign Up</span>
						</a>
					</div>
					<div class="social-links__item social-links__item--in">
						<a href="<?php echo auth_li_talent_url ?>" class="social-link" name="in">
							<i class="fab fa-linkedin-in"></i>
							<span>Sign Up</span>
						</a>
					</div>
				</div>
				<div class="delimiter">
					<div class="line"></div>
					<p>or</p>
					<div class="line"></div>
				</div>
				<div class="form-mdc">
					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<?php $first_name = $GLOBALS['get_talent_google_fname'] ?? $GLOBALS['get_talent_fb_fname'] ?? $GLOBALS['get_talent_li_fname'] ?? ''; ?>
								<input type="text" name="first_name" id="t-first-name" required <?php echo($first_name ?'value="'.$first_name.'" readonly="readonly" class="valid"' :'') ?> placeholder=" ">
								<label for="t-first-name">First Name</label>
								<span class="helper-text">Please enter your first name</span>
							</div>
						</div>
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<?php $last_name = $GLOBALS['get_talent_google_lname'] ?? $GLOBALS['get_talent_fb_lname'] ?? $GLOBALS['get_talent_li_lname'] ??''; ?>
								<input type="text" name="last_name" id="t-last-name" required <?php echo($last_name ?'value="'.$last_name.'" readonly="readonly" class="valid"' :'') ?> placeholder=" ">
								<label for="t-last-name">Last Name</label>
								<span class="helper-text">Enter your last name</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined"> 
								<?php $useremail = $GLOBALS['get_talent_google_email'] ?? $GLOBALS['get_talent_fb_email'] ?? $GLOBALS['get_talent_li_email'] ?? ''; ?>
								<input type="email" name="useremail" id="t-email" required <?php echo($useremail ?'value="'.$useremail.'" readonly="readonly" class="valid"' :'') ?> placeholder=" ">
								<label for="t-email">Email</label>
								<span class="helper-text">Please enter a valid email</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<input type="password" name="password" id="t-password" required placeholder=" ">
								<label for="t-password">Password</label>
								<span toggle="#t-password" class="fa fa-fw fa-eye form-mdc__eye toggle-password"></span>
								<span class="helper-text">Think of a password</span>
							</div>
						</div>
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<input id="t-repeat-password" type="password" required placeholder=" ">
								<label for="t-repeat-password">Repeat password</label>
								<span toggle="#t-repeat-password" class="fa fa-fw fa-eye form-mdc__eye toggle-password"></span>
								<span class="helper-text">Please repeat password</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<!-- <div class="textfield-outlined">
								<input type="tel" name="phone" id="t-phone" required placeholder=" ">
								<label for="t-phone">Mobile</label>
								<span class="helper-text">Please enter your mobile, starting with country code</span>
							</div> -->
							<div class="textfield textfield--code-tel">
								<input type="tel" class="phone-code" id="t-phone" required>
								<input type="hidden" name="phone" class="output-phone-code">
								<span class="helper-text">Please enter your mobile, starting with country code</span>
							</div>
						</div>
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<input type="hidden" id="reg_form_talent_country"     name="reg_form_talent_country">
								<input type="hidden" id="reg_form_talent_city"        name="reg_form_talent_city">
								<input type="text"   id="reg_form_talent_city_google" name="talent_city_google" required placeholder=" " autocomplete="off">
								<label for="reg_form_talent_city_google">City</label>
								<span class="helper-text">Start typing and select your home city</span>											
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="material-switch">
							<input type="checkbox" id="t-agree-conditions" name="" class="switch-input" required placeholder=" ">
							<label for="t-agree-conditions" class="switch-label"><span>By signing up, you agree to Wona’s 
								<a href="#" target="_blank" class="form-mdc__link">Terms of Service</a> and 
								<a href="#" target="_blank" class="form-mdc__link">Privacy Policy</a>, 
								which outline your rights and obligations with respect to your use of the Service and procesing of your data.</span>
							</label>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="material-switch">
							<input type="checkbox"  name="email_receive_subsequent" id="t-agree-email" class="switch-input" placeholder=" ">
							<label for="t-agree-email" class="switch-label"> 
								<span>You agree to receive subsequent email and third-party communications, which you may opt out of, or unsubscribe from, at any time.</span> 
							</label>
						</div>
					</div>
				</div>
				<div class="form__button">
					<div class="form-mdc__footnote">
						<p>Already have an account?</p>
						<a href="<?php echo getSEFfile('login-page.php') ?>">Sign in</a>
					</div>
					<input type="hidden" name="ajax_register_talent">
					<a href="#uID" class="btn nextBtn btn--mdc" id="email_check_talent">Get Started</a>
				</div>
			</div>
		</form>
		<div class="tab-promo">
			<h1 class="tab-promo__title">Create your profile and have the top Artificial Intelligence and tech companies apply to you</h1>
			<div class="tab-promo__content">
				<p>Hiring managers and decision makers will see your profile, so please ensure you take your time to stand out. We find that candidates that upload profile images as well details about themselves both professionally and personally are more likely to attract more offers.
				Upload your achievements and keep companies updated with your skills and abilities, as well as what projects you are currently working on. The greater the transparency, the better we can help ensure the right companies apply to you.</p>
			</div>
		</div>
	</div>
	
	<div class="tab-container <?php echo $tab_2 ?>" id="tabs-2">
		<form class="form__employer" id="reg_employer_form" action="<?php echo getSEFfile('login-page.php') ?>" method="post">
			<div class="tab">
				<div class="tabs__title">
					<h2>We’ll bring you the best!</h2>
					<p>Hire better tech talent, faster. Sign up to get started.</p>
				</div>
				<div class="social-links">
					<div class="social-links__item social-links__item--facebook">
						<a href="<?php echo auth_fb_employer_url ?>" class="social-link" name="facebook">
						<i class="fab fa-facebook-f"></i>
						<span>Sign Up</span>
						</a>
					</div>
					<div class="social-links__item social-links__item--google">
						<a href="<?php echo auth_google_reg_employer_url ?>" class="social-link" name="google">
						<i class="fab fa-google"></i>
						<span>Sign Up</span>
						</a>
					</div>
					<div class="social-links__item social-links__item--in">
						<a href="<?php echo auth_li_employer_url ?>" class="social-link" name="in">
							<i class="fab fa-linkedin-in"></i>
							<span>Sign Up</span>
						</a>
					</div>
				</div>
				<div class="form-mdc">
					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<?php $first_name = $GLOBALS['get_employer_google_fname'] ?? $GLOBALS['get_employer_fb_fname'] ?? $GLOBALS['get_employer_li_fname'] ?? ''; ?>
								<input type="text" name="first_name" id="e-first-name" required <?php echo($first_name ?'value="'.$first_name.'" readonly="readonly" class="valid"' :'') ?> placeholder=" ">
								<label for="e-first-name">First Name</label>
								<span class="helper-text">Please enter your first name</span>
							</div>
						</div>
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<?php $last_name = $GLOBALS['get_employer_google_lname'] ?? $GLOBALS['get_employer_fb_lname'] ?? $GLOBALS['get_employer_li_lname'] ?? ''; ?>
								<input type="text" name="last_name" id="e-last-name" required <?php echo($last_name ?'value="'.$last_name.'" readonly="readonly" class="valid"' :'') ?> placeholder=" ">
								<label for="e-last-name">Last Name</label>
								<span class="helper-text">Enter your last name</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined"> 
								<?php $useremail = $GLOBALS['get_employer_google_email'] ?? $GLOBALS['get_employer_fb_email'] ?? $GLOBALS['get_employer_li_email'] ?? ''; ?>
								<input type="email" name="useremail" id="e-email" required <?php echo($useremail ?'value="'.$useremail.'" readonly="readonly" class="valid"' :'') ?> placeholder=" ">
								<label for="e-email">Email</label>
								<span class="helper-text">Please enter a valid email</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<input type="password" name="password" id="e-password" required placeholder=" ">
								<label for="e-password">Password</label>
								<span toggle="#e-password" class="fa fa-fw fa-eye form-mdc__eye toggle-password"></span>
								<span class="helper-text">Think of a password</span>
							</div>
						</div>
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<input id="e-repeat-password" type="password" required placeholder=" ">
								<label for="e-repeat-password">Repeat password</label>
								<span toggle="#e-repeat-password" class="fa fa-fw fa-eye form-mdc__eye toggle-password"></span>
								<span class="helper-text">Please repeat password</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<!-- <div class="textfield-outlined">
								<input type="tel" name="phone" id="e-phone" required placeholder=" ">
								<label for="e-phone">Mobile</label>
								<span class="helper-text">Please enter your mobile, starting with country code</span>
							</div> -->
							<div class="textfield textfield--code-tel">
								<input type="tel" class="phone-code" id="e-phone" required>
								<input type="hidden" name="phone" class="output-phone-code">
								<span class="helper-text">Please enter your mobile, starting with country code</span>
							</div>
						</div>
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<input type="hidden" id="reg_form_employer_country"     name="employer_country">
								<input type="hidden" id="reg_form_employer_city"        name="employer_city">
								<input type="text"   id="reg_form_employer_city_google" name="employer_city_google" required placeholder=" " autocomplete="off">
								<label for="reg_form_employer_city_google">Headquarters Address</label>
								<span class="helper-text">Start typing and select city</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined"> 
								<input type="text" name="employer_job_title" id="e-job-title" required placeholder=" ">
								<label for="e-job-title">Job Title</label>
								<span class="helper-text">Please enter a job title</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined"> 
								<input type="text" name="employer_company_name" id="e-company-name" required placeholder=" ">
								<label for="e-company-name">Company Name</label>
								<span class="helper-text">Please enter a company name</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-select textfield-select--single"> 
								<select class="mdc-select" name="employer_employ_count" id="e-employ-count" required>
									<option></option>
									<option value="less then 50">less then 50</option>
									<option value="50-200">50-200</option>
									<option value="200–1000">200 – 1000</option>
									<option value="1000+">1000+</option>
								</select>
								<span class="helper-text">Please select number of employees in your company</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="material-switch">
							<input type="checkbox" id="reg_form_employer_agree" name="reg_form_employer_agree" class="switch-input" required placeholder=" ">
							<label for="reg_form_employer_agree" class="switch-label"><span>By signing up, you agree to Wona’s 
								<a href="#" target="_blank" class="form-mdc__link">Terms of Service</a> and 
								<a href="#" target="_blank" class="form-mdc__link">Privacy Policy</a>, 
								which outline your rights and obligations with respect to your use of the Service and procesing of your data.</span>
							</label>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="material-switch">
							<input type="checkbox"  name="email_receive_subsequent" id="e-agree-email" class="switch-input" placeholder=" ">
							<label for="e-agree-email" class="switch-label"> 
								<span>You agree to receive subsequent email and third-party communications, which you may opt out of, or unsubscribe from, at any time.</span> 
							</label>
						</div>
					</div>
				</div>

				<div class="form__button">
					<a class="btn nextBtn btn--mdc">Get Started</a>
				</div>
			</div>
			<div class="tab">
				<div class="tabs__title tabs__title--left">
					<h2>What roles are you hiring for?</h2>
					<p>Select all roles you’re after below</p>
				</div>
				<div class="roles-form">
					<div class="roles-form__list">
						<ul class="roles-form__items"><?php
							$arr = getArrpos();
							foreach($arr as $arri){
								echo'<li class="roles-form__item">
									  <label class="form__checkbox">
										<input type="checkbox" name="job_relation[]" value="'.$arri[0].'">
										<span class="main-checkbox"></span>
										<span>'.$arri[1].'</span>
									  </label>
									</li>';
							} ?>
							<li class="roles-form__item other">
								<label class="form__checkbox">
								<input type="checkbox" name="job_relation_other_yn">
								<span class="main-checkbox"></span>
								<input type="text" name="job_relation_other" class="other-text" placeholder="Other (Please specify)" />
								</label>
								<span class="add-new-roles">+</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="form__buttons">
					<a class="btn prevBtn btn--mdc">Back</a>
					<a class="btn nextBtn btn--mdc">Next</a>
				</div>
			</div>
			<div class="tab">
				<div class="tabs__title tabs__title--left">
					<h2>What markets are you hiring in?</h2>
					<p>Wona’s candidates are in 13 major markets, and remote, too.</p>
				</div>
				<div class="markets-form">
					<div class="markets-form__images">
						<div class="markets-form__img">
							<img src="<?php echo getHomeURL ?>slicing/img/map-USA-min.png" alt="USA map" />
						</div>
						<div class="markets-form__img">
							<img src="<?php echo getHomeURL ?>slicing/img/map-europe-min.png" alt="europe map" />
						</div>
					</div>
					<div class="markets-form__city">
						<?php
							//$arr = siteGetArrCounty();
							//foreach($arr as $arri){ ?>
						<!--<div class="markets-form__column">
							<h3 class="markets-form__subtitle"><?php //echo $arri[0] ?></h3><?php
								//$arrr = siteGetArrCountyCity($arri[0]);
								//foreach($arrr as $arrri){ ?>
								<label class="form__checkbox">
									<input type="checkbox" name="reg_form_employer_wantloc" value="<?php //echo $arri[0].':'.$arrri[0] ?>">
									<span class="main-checkbox"></span>
									<p><?php //echo $arrri[0] ?></p>
								</label><?php
								//} ?>
							</div>--><?php 
							//} ?>
						<div class="markets-form__column">
							<h3 class="markets-form__subtitle">United States</h3>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="United States:San Francisco">
								<span class="main-checkbox"></span>
								<p>San Francisco</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="United States:Seattle">
								<span class="main-checkbox"></span>
								<p>Seattle</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="United States:Dallas">
								<span class="main-checkbox"></span>
								<p>Dallas</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="United States:Washington">
								<span class="main-checkbox"></span>
								<p>Washington</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="United States:Boston">
								<span class="main-checkbox"></span>
								<p>Boston</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="United States:New York">
								<span class="main-checkbox"></span>
								<p>New York</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="Canada:Toronto">
								<span class="main-checkbox"></span>
								<p>Toronto</p>
							</label>
						</div>
						<div class="markets-form__column">
							<h3 class="markets-form__subtitle">EUROPE</h3>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="United Kingdom:London">
								<span class="main-checkbox"></span>
								<p>London</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="France:Paris">
								<span class="main-checkbox"></span>
								<p>Paris</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="Netherlands:Amsterdam">
								<span class="main-checkbox"></span>
								<p>Amsterdam</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="Germany:Berlin">
								<span class="main-checkbox"></span>
								<p>Berlin</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="Poland:Warsaw">
								<span class="main-checkbox"></span>
								<p>Warsaw</p>
							</label>
							<label class="form__checkbox">
								<input type="checkbox" name="reg_form_employer_wantloc" value="Czechia:Prague">
								<span class="main-checkbox"></span>
								<p>Prague</p>
							</label>
						</div>
					</div>
				</div>
				<div class="form__buttons">
					<a class="btn prevBtn btn--mdc">Back</a>
					<a class="btn nextBtn btn--mdc">Next</a>
				</div>
			</div>
			<div class="tab">
				<div class="tabs__title tabs__title--left">
					<h2>What are your top recruiting challenges?</h2>
					<p>Help us understand your recruiting challenges by checking the list below</p>
				</div>
				<div class="recruiting-form">
					<ul class="recruiting-form__list">
						<li class="recruiting-form__item">
							<label class="form__checkbox">
								<input type="checkbox" name="employer_talent_v1">
								<span class="main-checkbox"></span>
								<p>Finding candidates with the right skills and level of experience</p>
							</label>
						</li>
						<li class="recruiting-form__item">
							<label class="form__checkbox">
								<input type="checkbox" name="employer_talent_v2">
								<span class="main-checkbox"></span>
								<p>Standing out to candidates in a competitive market</p>
							</label>
						</li>
						<li class="recruiting-form__item">
							<label class="form__checkbox">
								<input type="checkbox" name="employer_talent_v3">
								<span class="main-checkbox"></span>
								<p>Finding candidates with the right skills and level of experience</p>
							</label>
						</li>
						<li class="recruiting-form__item">
							<label class="form__checkbox">
								<input type="checkbox" name="employer_talent_v4">
								<span class="main-checkbox"></span>
								<p>Knowing what salaries I need to offer</p>
							</label>
						</li>
						<li class="recruiting-form__item">
							<label class="form__checkbox">
								<input type="checkbox" name="employer_talent_v5">
								<span class="main-checkbox"></span>
								<p>Getting people through the pipeline and accepting offers</p>
							</label>
						</li>
					</ul>
				</div>
				<div class="form__buttons">
					<a class="btn prevBtn btn--mdc">Back</a>
					<a class="btn nextBtn btn--mdc">Next</a>
				</div>
			</div>
			<div class="tab">
				<div class="tabs__title tabs__title--left">
					<h2>Learn why top candidates love Wona! </h2>
					<p>Spend just a few minutes to watch our insightful video</p>
				</div>
				<div class="instruction">
					<div class="video-wrap">
						<!-- <img src="<?php //echo getHomeURL ?>slicing/img/maxresdefault-min.jpg" alt="video coming soon"> -->
						<video playsinline controls>
							<source src="<?php echo getHomeURL ?>slicing/media/employer-video.mp4" type="video/mp4"/>
						</video>
					</div>
					<ul class="instruction__list">
						<li class="instruction__item">
							<h5 class="instruction__subtitle">
								<span class="instruction__number">01</span>Set up a company profile
							</h5>
							<p>Create your custom company page, invite co-workers, and connect to your ATS</p>
						</li>
						<li class="instruction__item">
							<h5 class="instruction__subtitle">
								<span class="instruction__number">02</span>Create positions
							</h5>
							<p>Let us know the skills, experience, and role you are looking for.</p>
						</li>
						<li class="instruction__item">
							<h5 class="instruction__subtitle">
								<span class="instruction__number">03</span>See your matches
							</h5>
							<p>We match your needs to deliver relevant candidates. We’ll even email them to you!</p>
						</li>
						<li class="instruction__item">
							<h5 class="instruction__subtitle">
								<span class="instruction__number">04</span>Connect and hire
							</h5>
							<p>Send interview requests to the best candidates, interview, and secure hires.</p>
						</li>
					</ul>
				</div>
				<div class="form__buttons">
					<a class="btn prevBtn btn--mdc">Back</a>
					<a class="btn nextBtn btn--mdc">Next</a>
				</div>
			</div>
			<div class="tab">
				<div class="conclusion">
					<div class="conclusion__title">
						<h2>Let us find the best candidates for you.</h2>
					</div>
					<div class="conclusion__text">
						<p>Let us know who you’re looking for and we’ll do the rest.</p>
						<p>Our maching learning algorithms are constantly learning, so we can suggest ways to find more (or better) candidates based on what’s happening in your market.</p>
					</div>
				</div>
				<div class="form__buttons">
					<a class="btn prevBtn btn--mdc">Back</a>
					<input type="hidden" name="reg_employer_form_yn">
					<a href="#uID" class="btn btn--mdc" id="reg_employer_form_submit">View Company Profile</a>
				</div>
			</div>
		</form>
		<div class="tab-promo">
			<h1 class="tab-promo__title">Top technologists want to work for the best and brightest, the most innovative and dynamic companies.</h1>
			<div class="tab-promo__content">
				<p>Create your company profile and show them why they should be looking to join your team. Attract the greatest minds that share your values and can help your organisation achieve their vision.
				Have the opportunity to keep candidates in the loop by uploading media to your company profile page, collect data on what opportunities attract the talent that is right for you and ensure you always have access to the smartest technologists in the world.</p>
			</div>
		</div>
	</div>

	<div class="tab-container <?php echo $tab_3 ?>" id="tabs-3">
		<form class="form__talent" id="reg_recruter_form" action="<?php echo getSEFfile('login-page.php') ?>" method="post">
			<div class="tab last">
				<div class="tabs__title">
					<h2>Let your recruitment business soar</h2>
					<p>Access thousands of jobs and incredible talent on Wona.</p>
				</div>
				<div class="social-links">
					<div class="social-links__item social-links__item--facebook">
						<a href="<?php echo auth_fb_recruiter_url ?>" class="social-link" name="facebook">
						<i class="fab fa-facebook-f"></i>
						<span>Sign Up</span>
						</a>
					</div>
					<div class="social-links__item social-links__item--google">
						<a href="<?php echo auth_google_reg_recruiter_url ?>" class="social-link" name="google">
						<i class="fab fa-google"></i>
						<span>Sign Up</span>
						</a>
					</div>
					<div class="social-links__item social-links__item--in">
						<a href="<?php echo auth_li_recruiter_url ?>" class="social-link" name="in">
							<i class="fab fa-linkedin-in"></i>
							<span>Sign Up</span>
						</a>
					</div>
				</div>
				<div class="delimiter">
					<div class="line"></div>
					<p>or</p>
					<div class="line"></div>
				</div>
				<div class="form-mdc">
					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<?php $first_name = $GLOBALS['get_recruiter_google_fname'] ?? $GLOBALS['get_recruiter_fb_fname'] ?? $GLOBALS['get_recruiter_li_fname'] ?? ''; ?>
								<input type="text" name="first_name" id="r-first-name" required <?php echo($first_name ?'value="'.$first_name.'" readonly="readonly" class="valid"' :'') ?> placeholder=" ">
								<label for="r-first-name">First Name</label>
								<span class="helper-text">Please enter your first name</span>
							</div>
						</div>
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<?php $last_name = $GLOBALS['get_recruiter_google_lname'] ?? $GLOBALS['get_recruiter_fb_lname'] ?? $GLOBALS['get_recruiter_li_lname'] ?? ''; ?>
								<input type="text" name="last_name" id="r-last-name" required <?php echo($last_name ?'value="'.$last_name.'" readonly="readonly" class="valid"' :'') ?> placeholder=" ">
								<label for="r-last-name">Last Name</label>
								<span class="helper-text">Enter your last name</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined"> 
								<?php $useremail = $GLOBALS['get_recruiter_google_email'] ?? $GLOBALS['get_recruiter_fb_email'] ?? $GLOBALS['get_recruiter_li_email'] ?? ''; ?>
								<input type="email" name="useremail" id="r-email" required <?php echo($useremail ?'value="'.$useremail.'" readonly="readonly" class="valid"' :'') ?> placeholder=" ">
								<label for="r-email">Email</label>
								<span class="helper-text">Please enter a valid email</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<input type="password" name="password" id="r-password" required placeholder=" ">
								<label for="r-password">Password</label>
								<span toggle="#r-password" class="fa fa-fw fa-eye form-mdc__eye toggle-password"></span>
								<span class="helper-text">Think of a password</span>
							</div>
						</div>
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<input id="r-repeat-password" type="password" required placeholder=" ">
								<label for="r-repeat-password">Repeat password</label>
								<span toggle="#r-repeat-password" class="fa fa-fw fa-eye form-mdc__eye toggle-password"></span>
								<span class="helper-text">Please repeat password</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<!-- <div class="textfield-outlined">
								<input type="tel" name="phone" id="r-phone" required placeholder=" ">
								<label for="r-phone">Mobile</label>
								<span class="helper-text">Please enter your mobile, starting with country code</span>
							</div> -->
							<div class="textfield textfield--code-tel">
								<input type="tel" class="phone-code" id="r-phone" required>
								<input type="hidden" name="phone" class="output-phone-code">
								<span class="helper-text">Please enter your mobile, starting with country code</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined">
								<input type="text"   id="reg_form_recruter_city_google" name="recruter_city_google" required placeholder=" " autocomplete="off">
								<label for="reg_form_recruter_city_google">Full address</label>
								<span class="helper-text">Start typing and select address</span>
							</div>
							<div class="address-autofilled">
								<p>
									City:&nbsp;
									<span data-val="reg_form_recruter_city"></span>
								</p>
								<p>
									State:&nbsp;
									<span data-val='reg_form_recruter_state'></span>
								</p>
								<p>
									Country:&nbsp;
									<span data-val="reg_form_recruter_country"></span>
								</p>
								<p>
									Zip:&nbsp;
									<span data-val="reg_form_recruter_zip"></span>
								</p>
								<input type="hidden" id="reg_form_recruter_city"    name="employer_city">
								<input type="hidden" id="reg_form_recruter_state"   name="employer_state">
								<input type="hidden" id="reg_form_recruter_country" name="employer_country">
								<input type="hidden" id="reg_form_recruter_zip"     name="employer_zip">
							</div>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="form-mdc__box">
							<div class="textfield-outlined"> 
								<input type="text" name="talent_url_lin" id="r-linkedin" placeholder=" ">
								<label for="r-linkedin">LinkedIn Profile</label>
								<span class="helper-text">Start typing your adress</span>
							</div>
						</div>
					</div>

					<div class="form-mdc__row">	
						<div class="recr-id-row">
							<label class="mdc-button mdc-button--raised mdc-ripple-upgraded">
								<i class="material-icons mdc-button__icon">add_photo_alternate</i>
								<span class="mdc-button__label">Upload ID</span>
								<div class="mdc-button__ripple"></div>
								<input type="hidden" name="" id="" value="" />
								<input type="file" class="inputfile" id="recr-id" name="recruiter_id" accept=".jpg, .jpeg, .png">							
							</label>

							<div class="recr-id__file">
								<span class="file-name"></span>
								<span class="remove-file">x</span>
							</div>
						</div>	
					</div>

					<div class="form-mdc__row">
						<div class="material-switch">
							<input type="checkbox" id="r-agree-conditions" class="switch-input" required placeholder=" ">
							<label for="r-agree-conditions" class="switch-label"><span>By signing up, you agree to Wona’s 
								<a href="#" target="_blank" class="form-mdc__link">Terms of Service</a> and 
								<a href="#" target="_blank" class="form-mdc__link">Privacy Policy</a>, 
								which outline your rights and obligations with respect to your use of the Service and procesing of your data.</span>
							</label>
						</div>
					</div>

					<div class="form-mdc__row">
						<div class="material-switch">
							<input type="checkbox"  name="email_receive_subsequent" id="r-agree-email" class="switch-input" placeholder=" ">
							<label for="r-agree-email" class="switch-label"> 
								<span>You agree to receive subsequent email and third-party communications, which you may opt out of, or unsubscribe from, at any time.</span> 
							</label>
						</div>
					</div>
				</div>

				<div class="form__button">
					<input type="hidden" name="reg_recruiter_form_yn">
					<button type="button" class="btn nextBtn btn--mdc" id="reg_recruter_form_submit">Submit for review</button>
				</div>
			</div>
		</form>
		<div class="tab-promo">
			<h1 class="tab-promo__title">Take control of your life and earnings by joining a team of top recruiters determined on driving forward the AI jobs market.</h1>
			<div class="tab-promo__content">
				<p>Work when you want. Earn when you want.
				   Recruiters waste too much time sifting through CVs, meeting with candidates, having to manage client relationships, let the machines do all the hard work for you so that you can focus on the human element. At Wona, we believe in role ideation, ensuring that everyone can focus on their strengths and ensure that you are always providing the very best service throughout the hiring process.
				   Only deal with top candidates that are actively looking for their next career move, working in the fasted growing industry with opportunities brought to them</p>
			</div>
		</div>
	</div>
</div>
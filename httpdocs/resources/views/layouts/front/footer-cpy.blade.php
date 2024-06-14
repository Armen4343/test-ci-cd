 <!-- bg image sectinon -->

    <div class="bg-image">
        <div class="bg-image-div">
            <h1 class="bg-image-text">Get in touch</h1>

            <div class="bg-image-input-div my-2">
				<div class="text-danger print-error-msg" style="display:none">
                <ul></ul>
            </div>
                <form action="" method="post" id="subscription-form" style="margin-top: 30px;">
					@csrf
					<input type="email" placeholder="Enter Your Email Address" class="bg-image-input" name="email">
                	<button type="submit" class="bg-image-btn"> Submit</button>
				</form>
				
            </div>
        </div>
    </div>


    <!-- footer -->
    <div class="footer">
        <img src="{{ secure_asset('front-end/images/logo.png') }}" alt="" class="footer-logo">
        <div class="footer-div">
            <div class="footer-div-1">
                <p>A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.A great attention to detail is required to work on zeep up project.</p>
                <img src="{{ secure_asset('front-end/images/n_63bdc9b0f1e7c9e.png') }}" alt="" class="footer-div-logo">
                <img  src="{{ secure_asset('front-end/images/apple-bas.jpg') }}" alt="" class="footer-div-logo ">
            </div>
            <div class="footer-div-2">
                <a href=""> Get help</a>
                <a href="">Add your restaurant</a>
                <a href="">Sign up to deliver</a>
                <a href="">Create a business account</a>
                <a href="">Promotions</a>
            </div>
            <div class="footer-div-2">
                <a href=""> Restaurants near me</a>
                <a href="">View all cities</a>
                <a href="">View all countries</a>
                <a href="">Pick-up near me</a>
                <a href="">About ZeepUp</a>
                <a href="">English</a>
            </div>
        </div>  
    </div>

    
    <!-- last content -->
    <div class="footer-second">
        <div class="footer-icon-div">
            <div>
                <a href="" target="_blank"
                    style="text-decoration: none; color: black; font-size: 1.6rem; margin-left:6px;">
                    <i class="fa-brands fa-square-instagram"></i></a>
                <a href="" target="_blank"
                    style="text-decoration: none; color: black; font-size: 1.6rem; margin-left:6px;">
                    <i class="fa-brands fa-square-facebook"></i></a>
                <a href="" target="_blank"
                    style="text-decoration: none; color: black; font-size: 1.6rem; margin-left:6px;">
                    <i class="fa-brands fa-square-twitter"></i></a>      
            </div>
             <p class="footer-text">Privacy Policy Terms Pricing Do not sell or share my personal information</p>  
        </div>
        <p  class="footer-text">ZeepUp legal terms os service apply</p>
        <p  class="footer-text">© 2023 Mercato Family DE.</p>
    </div>
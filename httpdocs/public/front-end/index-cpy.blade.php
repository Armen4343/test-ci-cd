
:root {
  --bg-color: rgb(242, 242, 242, 1);
}

* {
  margin: 0;
  padding: 0;
  border: none;
  /* box-sizing: border-box; */
  font-family: Red Hat Display;
}
.owl-nav {
    display: block !important;
}
.btn-danger{
	background-color:#ff0066 !Important;
	border-color:#ff0066
}
/* home page start */
.wrapper {
  position: fixed;
  right: -370px;
  bottom: 50px;
  max-width: 345px;
  width: 100%;
  background: #fff;
  border-radius: 8px;
  padding: 15px 25px 22px;
  transition: all 0.3s ease;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
}
.wrapper.show {
  right: 20px;
}
.title-box {
  display: flex;
  align-items: center;
  column-gap: 15px;
  color: #000000;
  margin-bottom: 15px;
}
.title-box i {
  font-size: 32px;
}
.title-box h3 {
  font-size: 24px;
  font-weight: 500;
}
.info {
  margin-bottom: 15px;
}
.info p {
  font-size: 16px;
  font-weight: 400;
  color: #333;
}
.info p a {
  color: #000000;
  text-decoration: none;
}
.info p a:hover {
  text-decoration: underline;
}
.buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
}
.button {
  width: calc(100% / 2 - 10px);
  padding: 8px 0;
  border: none;
  border-radius: 4px;
  background-color: #000000;
  color: #fff;
  cursor: pointer;
  transition: all 0.2s ease;
  border: 1px solid black;
}
.button:hover {
  background-color: #121212;
}
.terms-link {
  text-decoration: none;
  color: #ff00cc;
  font-weight: bold;
}
.slick-track {
  overflow: auto;
  height: auto;
  padding: 10px;
  position: relative;
}
.slick-slide {
  transition: all 0.4s;
  height: auto;
}
/*
.slick-slide:hover {
  transform: scale(1.01);
  box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px,
    rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
  z-index: 1;
  transition: box-shadow 0.4s;
}
*/
/* home page end */

/* ************************* navbar start  **************************** */
.home2-main {
  height: 40rem;
  background-size: cover;
  width: 100%;
  background-repeat: no-repeat;
  background-image: linear-gradient(
      to right,
      rgba(0, 0, 0, 0.095),
      rgba(0, 0, 0, 0.384),
      #0000003c
    ),
    url("images/image_4.png");
  background-color: var(--bg-color);
}
/* ************************* navbar start  **************************** */
.navbar {
  background-color: rgb(242, 242, 242, 1) !important;
  padding: 1rem 1rem !important;
  position: fixed !important;
  top: 0;
  left: 0;
  width: 100% !important;
  z-index: 100 !important;
}
.scrolled {
  background-color: #fff !important;
  box-shadow: 4px 4px 6px #ccc;
}
.navbar-toggler {
  border: none !important;
  color:#ff0066;
  box-shadow: none !important;
}

.navbar-toggler:hover,
.navbar-toggler:active {
  box-shadow: none !important;
}

.btn-close {
  -bs-btn-close-opacity: none !important;
  --bs-btn-close-hover-opacity: none !important;
  --bs-btn-close-focus-shadow: none !important;
  --bs-btn-close-focus-opacity: none !important;
  --bs-btn-close-disabled-opacity: none !important;
}
.navbar-toggler i {
  font-size: 2rem;
  
}

.nav-logo {
  width: 8rem;
  padding-left: 1rem;
}

.nav-logo-side {
  width: 10.3rem;
  align-items: center;
}

.nav-link,
.offcanvas-body,
.offcanvas-header {
  background-color: white !important;
}

.nav-link {
  color: black;
  font-size: 1.1rem;
}

.login {
  left: 1632.849px;
  top: 44px;
  padding: 0.3rem 1.2rem;
  border-radius: 20px;
  font-family: Red Hat Display;
  font-style: normal;
  background-color: white !important;
  font-weight: normal;
  font-size: 13px;
  box-shadow: 2px 3px 4px #888888;
}

.signup {
  box-shadow: 2px 3px 4px #888888;
  padding: 0.3rem 1.5rem;
  border-radius: 20px;
  background-color: #ff0066 !important;
  color: white;
  font-family: Red Hat Display;
  font-style: normal;
  font-weight: normal;
  font-size: 13px;
}

.signup-btn {
  margin-top: 1rem;
  border-radius: 20px;
  width: 12rem;
  height: 4rem;
  font-family: Red Hat Display;
  font-size: 22px;
  background-color: #ff0066 !important;
  color: white;
}

.login-btn {
  margin-top: 1rem;
  border-radius: 20px;
  width: 12rem;
  border: "none";
  font-size: 22px;
  font-family: Red Hat Display;
  height: 4rem;
  color: black;
  background-color: white !important;
}

/* ************************* Hero Section  **************************** */
.hero-section {
  height: 30rem;
  width: 100%;
  position: relative;
  overflow: hidden;
  background-color: rgb(242, 242, 242, 1) !important;
}

/*  her section content */
.hero-section-content {
  margin-top: 8rem;
  width: 50%;
  padding: 0 1rem;
}

.hero-section-title {
  font-size: 2rem;
  font-family: Red Hat Display;
}

.hero-section-main-div {
  margin-top: 1rem;
  display: flex;
}

.hero-section-input-div {
  /* margin-top: 2rem; */
  margin-right: 0.5rem;
  padding: 5px 0px 5px 7px;
  width: 20rem;
  display: flex;
  padding-top: 10px;
  background-color: white !important;
}

.hero-section-input {
  outline: none;

  font-size: 13px;
  background-color: white !important;
  padding: 0 3.8rem 0.4rem 0.2rem;
  color: black;
  font-family: Red Hat Display;
}

.dropdown,
.dropdown-menu,
.dropdown-item {
  border-radius: 0 !important;
}

.dropdown .dropdown-item {
  border-bottom: 1px solid lightgray;
}
.dropdown .dropdown-btn {
 padding: 12px 12px;

  font-size: 13px;
  background-color: white !important;
}
.language-dropdown .dropdown-toggle::after{
    border-top: 0.3em solid #ff0066 !important;
}
.hero-section-btn {
  background-color: #ffbf00 !important;
  color: white;
  font-size: 13px;
  font-family: Red Hat Display;
  margin-left: 10px;
  padding: 0 1.4rem;
}

.hero-section-text {
  font-size: 13px !important;
  color: #707070;
  font-family: Red Hat Display;
}

/*  */

.hero-section-images1 {
  position: absolute;
  width: 38rem;
  height: 28rem;
  right: 0rem;
  bottom: 0rem;
}

.hero-section-images2 {
  position: absolute;
  width: 22rem;
  height: 12rem;
  right: -1rem;
  bottom: 1rem;
  /* z-index: 2; */
}

.hero-section-images3 {
  /* z-index: 1; */
  filter: drop-shadow(0px 11px 20px rgba(0, 0, 0, 0.369)) !important;
  position: absolute;
  width: 17rem;
  height: 15rem;
  right: 19rem;
  bottom: 5rem;
}
/*  ********************  slider  ******************/

.slider {
  width: 90%;
  margin: 10px auto;
}
.slider-section-row {
  font-family: Red Hat Display;
  width: 100%;
  padding: 0 4.7rem;
  display: flex;
  justify-content: space-between;
}

.slick-slide {
  margin: 0px 30px 50px 40px;
}

.slick-slide img {
  	width: 100%;
	height:12rem;
}
.slider-title {
  margin-top: 1rem;
  font-weight: 600;
  font-size: 22px;
  font-family: Red Hat Display;
}
.slider-text {
  color: #767676;
  font-weight: 400;
  font-family: Red Hat Display;
  font-size: 11px;
}
.slick-prev:before,
.slick-next:before {
  color: black !important ;
}
.slider-main-div {
  padding: 2rem 0;
}
.product-container {
  position: relative;
}
.product-container .badge {
  position: absolute;
  top: 5px;
  right: 5px;
  border-radius: 20px !important;
  z-index: 10;
  background-color: #ff0066 !important;
  color: #fff !important;
  padding:10px 10px 10px;
}
.product-container:hover .product {
  box-shadow: 0 35px 35px -25px rgb(0 0 0 / 5%), 0 10px 24px 0 rgb(0 0 0 / 20%);
  padding-left: 30px;
  padding-right: 30px;
  padding-top: 35px;
  position: absolute;
  left: -30px;
  right: -30px;
  top: -35px;
  z-index: 1;
  transition: box-shadow 0.2s;
  width: calc(100% + 60px);
}

/* ****************************** map-section  ***************************** */
.map-section {
  padding: 2rem 2rem;
}

.map-section-row {
  font-family: Red Hat Display;
  width: 100%;
  display: flex;
  justify-content: space-between;
}

.map-section-row strong,
.slider-section-row strong {
  font-size: 2.1rem;
}

.map-text-main-div {
  padding: 3rem 2rem;
  display: flex;
}

.map-div {
  display: flex;
}

.map-text-div {
  width: 100%;
  display: flex;
  justify-content: space-between;
  flex-direction: column;
}

.map-text-div a {
  margin-bottom: 10px;
  font-size: 15px;
  text-decoration: none;
  color: black;
  font-family: Red Hat Display;
}

.bg-image {
  padding: 2rem 0 !important;
  margin-bottom: 2rem;
  height: 20rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  color: white;
  align-items: center;
  background-image: linear-gradient(
      to right,
      rgba(0, 0, 0, 0.095),
      rgba(0, 0, 0, 0.868),
      #000000
    ),
    url("images/bg-image.png");
}

.bg-image-text {
  margin-bottom: 10px;
  font-size: 2.9rem;
  font-weight: 400;
  font-family: Red Hat Display !important;
}

.bg-image-div {
  width: 50%;
  text-align: center;
}

.bg-image-div strong {
  font-size: 14px;
}

.bg-image-input {
  outline: none !important;
  font-size: 0.9rem;
  font-family: Red Hat Display !important;
  padding: 0.5rem 5rem;
}

.bg-image-btn {
  margin-left: 4px;
  font-weight: 400;
  font-size: 0.9rem;
  font-family: Red Hat Display !important;
  background-color: #414141;
  color: white;
  padding: 0.5rem 2.4rem;
}
/*  **************************   footer  ****************************** */
.footer {
  padding: 2rem 3rem 0;
}
.footer-logo {
  height: 2rem;
}
.footer-div {
  display: flex;
  padding: 1rem 0;
  border-bottom: 1px solid grey;
}
.footer-div-1 p {
  padding: 1rem 3rem 2rem 0;
  font-size: 15px;
  font-family: Red Hat Display;
}
.footer-div-2 {
  width: 100%;
  display: flex;
  flex-direction: column;
}
.footer-div-2 a {
  margin-bottom: 10px;
  font-size: 15px;
  text-decoration: none;
  color: black;
  font-family: Red Hat Display;
}
.footer-div-logo {
  height: 2.4rem;
}
.footer-icon-div {
  display: flex;
  justify-content: space-between;
}
.footer-text {
  text-align: right;
  font-size: 13px;
}
.footer-second {
  padding: 0 2rem;
}
.shadow {
  box-shadow: 0 0.1rem 0.2rem rgba(var(--bs-body-color-rgb), 0.15) !important;
}
.hero-section-btn:hover {
  color: #cecaca;
}
/*Login page*/
.auth-container {
  height: calc(100vh - 73px);
}
.auth-bg {
  display: flex;
  align-items: center;
}
.auth-bg .content {
  color: #fff;
  padding: 20px;
}
.auth-bg .content .date {
  font-weight: 300;
  font-size: 14px;
  text-transform: uppercase;
  color: #fff;
  letter-spacing: 2px;
}
.auth-bg .content .heading {
  margin-top: 12px;
  line-height: 1.1;
  font-size: 36px;
  font-weight: 600;
  color: #fff;
  max-width: 680px;
}
.auth-bg .content p {
  line-height: 1.1;
  font-size: 20px;
  font-weight: 300;
}
.auth-bg .content a {
  line-height: 1.1;
  font-size: 20px;
  font-weight: 300;
  color: #fff;
  margin-top: 30px;
  display: block;
}
.widget {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100%;
}
.login-widget {
  width: 500px;
  padding: 30px;
}
.register-widget {
  width: 100%;
  padding: 30px;
}
/*pop up*/
#wizardmodal .modal-dialog {
  max-width: 900px;
}
#wizardmodal .modal-content {
  border: none !important;
  position: relative;
  padding: 0 !important;
  font-size: 14px !important;
  border-radius: 0 !important;
  -webkit-box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%);
  -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
  box-shadow: 0px 10px 34px -15px rgb(0 0 0 / 24%) !important;
}
#wizardmodal .modal-content .modal-header {
  padding: 0 !important;
  border: none !important;
}
#wizardmodal .modal-content button.close {
  position: absolute;
  top: 0;
  right: 0;
  padding: 0;
  margin: 0;
  width: 40px;
  height: 40px;
  z-index: 1;
  text-shadow: none;
  background: #ff0066;
  color: #fff;
  opacity: 1;
}
#wizardmodal .modal-content .text:after {
  position: absolute;
  top: -30px;
  left: -30px;
  right: -30px;
  bottom: -30px;
  content: "";
  border: 1px solid rgba(0, 0, 0, 0.1);
  z-index: -1;
}
#wizardmodal .modal-content .modal-body h2 {
  font-weight: 700;
  text-transform: uppercase;
  font-size: 58px;
}
#wizardmodal .modal-content .modal-body h2 span {
  font-weight: 400;
}
#wizardmodal .wizard-btn {
  color: #fff !important;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-size: 14px;
  background: #ff0066 !important;
  border: 1px solid #ff0066 !important;
}
#wizardmodal .modal .form-control {
  height: 52px;
  background: #fff;
  color: #000;
  font-size: 15px;
  border-radius: 5px;
}
.front-main{
	margin-top:76.95px;
}
/*stepper*/
#regForm {
  background-color: #ffffff;
  width: 100%;
  min-width: 300px;
}

#regForm h1 {
  text-align: center;  
}

/* Mark input boxes that gets an error on validation: */
#regForm input.invalid {
  background-color: #ffdddd;
}
#regForm select.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
#regForm .tab {
  display: none;
}

#regForm button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

#regForm button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
#regForm .step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

#regForm .step.active {
    opacity: 1;
    background: #ff0066;
}

/* Mark the steps that are finished and valid: */
#regForm .step.finish {
  background-color: #ff0066;
}

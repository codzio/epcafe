@extends('vwFrontMaster')

@section('content')
    
<!--======= SUB BANNER =========-->
<section class="sub-bnr" data-stellar-background-ratio="0.5">
<div class="position-center-center">
  <div class="container">
    <h4>DASHBOARD</h4>
    <!--<p>We're Ready To Help! Feel Free To Contact With Us</p>-->
    <ol class="breadcrumb">
      <li><a href="{{ route('homePage') }}">Home</a></li>
      <li class="active">DASHBOARD</li>
    </ol>
  </div>
</div>
</section>

<style type="text/css">
		/*root css*/
		:root{
			--main-color: #BD9C68;
			--primary-color: #1F242B;
			--secondary-color: #25292F;
			--white-color: #fff;
			--black-color: #000;
			--light-gray-color: #F4F4F2;
			--dark-gray: #8B694E;
			--linear-gradient: linear-gradient(to right, #8B694E, #F5CF96);
		}

		/*typography css*/
		.tab-head-font p{
			margin-bottom:0;
		}
		.tab-head-font{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
			color: #fff;
		}
		.tab-body-main-font{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 14px;
			line-height: 29px;
			letter-spacing: 1px;
			color: #1F242B;
		}
		.tab-body-para-font{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 400;
			font-size: 13px;
			line-height: 29px;
			letter-spacing: 1px;
			text-decoration-line: underline;
			color: #2E2E2E;
		}
		.tab-form-btn-font{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 800;
			font-size: 10px;
			line-height: 17px;
			text-align: center;
			letter-spacing: 0.16em;
			color: #fff;
		}
		/* my account */
		.my-account{
			padding-top: 60px;
			padding-bottom: 122px;
		}
		.my-account .content{
			display: flex;
			justify-content:center;
		}
		.tab-head{
			width: max-content;
			height: auto;
			background: #1F242B;
			border-right: 1px solid #fff;
			border-radius: 5px 0px 0px 5px;
			position: relative;
		}
		.tab-head ul{
			padding-left: 0;
			padding-top: 18.5px;
			list-style: none;
			position: relative;
		}
		.tab-head .tab-arr{
			position: absolute;
			top: 17px;
			right: 3%;
			display: none;
		}
		/*.tab-head ul li{
			padding-top: 16.5px;
			padding-bottom: 16.5px;
			padding-left: 36px;
			padding-right: 32px;
			border-top: 0.5px solid #1F242B;
		}*/
		.tab-head ul li:hover > a{
			background: #8b694E;
			border-top: 0.5px solid #fff;
			color: #fff;
		}
		.tab-head ul li a.active{
			background: #8b694E;
			border-top: 0.5px solid #fff;
		}
		/*.tab-head ul li.active a{color: #fff;}*/
		/*.tab-head ul li:hover > a{
			color: #fff;
		}*/
		.tab-head ul li a{
			display: flex;
			align-items: center;
				padding-top: 16.5px;
			padding-bottom: 16.5px;
			padding-left: 36px;
			padding-right: 32px;
			border-top: 0.5px solid #1F242B;
		}
		.tab-head ul li img{
			margin-right: 15px;
		}

		.tab-body{
			width: calc(100% - 271.28px);
			background: #F4F4F2;
			border: 0.5px solid #1F242B;
			border-radius: 0px 5px 5px 0px;
			padding-top: 30px;
			padding-left: 36px;
			padding-right: 34px;
		}
		.tab-body .account-forms p{
			margin-bottom: 18px;
		}
		.tab-body input{
			/*width: 258px;*/
			width: 100%;
			height: 48px;
			background: transparent;
			border:  1px solid #BD9C68;
			border-radius: 5px;
			margin-bottom: 24px;
			padding: 0 20px;
			position: relative;
			z-index: 2;
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
			color: #a0a0a0;
		}
		.tab-body textarea{
			/*width: 258px;*/
			width: 100%;
			height: 127px;
			background: #fff;
			border:  1px solid #BD9C68;
			border-radius: 5px;
			margin-bottom: 24px;
			padding: 8px 20px;
			position: relative;
			resize: none;
		}
		.tab-body .form-field{
			width: 258px;
			position: relative;
		}
		.tab-body .select{
			/*width: 258px;*/
			width: 100%;
			height: 48px;
			background: #fff;
			border:  1px solid #BD9C68;
			border-radius: 5px;	
			margin-bottom: 24px;
			padding: 0 20px;
			color: #a0a0a0;
			position: relative;
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
		}
		/*.tab-body select option{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
			color: #a0a0a0;
			position: absolute;
			left: 4%;
			top: 12px;
		}*/
		.tab-body  .after .plc{
			color: #a0a0a0;
			padding-left: 2px;
		}
		.tab-body .form-field .imp{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
			color: #E80000;
			position: absolute;
			left: 0;
			top: 0;
			width: 100%;
			height: 48px;
			background: #fff;
			text-align: left;
			padding: 12px 16px;
			z-index: 1;
			border-radius: 5px;
		}
		.tab-body .form-field .plc{
			color: #a0a0a0;
			padding-left: 1px;
		}
		.tab-body .after .imp{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
			color: #E80000;
			position: absolute;
			left: 5%;
			top: 12px;
		}
		.tab-body .after{
			display: inline-block;
			position: relative;
			width: 258px;
		}
		.tab-body .after span.arw{
			display: inline-block;
			width: 48px;
			height: 48px;
			background: #BD9C68;
			border-radius: 0px 5px 5px 0px;
			position: absolute;
			top: 0;
			right: 0;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.tab-body .account-forms{display: none;}
		.tab-body .account-forms.active{display: block;}
		.form-btn{
			padding: 11.5px 50.5px;
			background: #8B694E;
			border: 1px solid #8B694E;
		}
		.mr-42{margin-right: 24px;}
		.mr-36{margin-right: 24px;}
		.plc-adjust .imp{text-align: left;}
		.plc-adjust input{height: 68px;}
		.account-forms form{
			text-align: right;
			display: flex;
			justify-content: space-between;
			flex-wrap: wrap;
		}
		.account-forms form button{
			margin-top: 7px;
		}
		.account-forms form button:hover{
			background: #fff;
			color: #8B694E;
			border: 1px solid #8B694E;
		}
		.butn{width: 100%;}
		/*.tab-body .data{display: none;}*/
		.tab-body .d-input{
			width: 100%;
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}
		.tab-body .d-input .form-field{
			width: 47%;
		}
		.tab-body .d-input .after .imp{left: 10px;}
		.tab-body .d-input .after{
			width: 100%;
		}
		.tab-body .d-input .select{
			padding: 0 13px;
		}
		.tab-body .kandoraMeasurement .butn{
			margin-bottom: 38px;
		}
		.accountDetail .butn button:last-child{padding: 13.5px 28.5px}
		.accountDetail .butn button{padding: 8.5px 17.5px;} 
		.accountDetail .butn{display: flex;}
		.accountDetail p{text-decoration: none;}
		.accountDetail p span{color: #E00000;}
		.dashboardMsg{
			width: 100%;
			height: 133px;
			background: #E0F1C1;
			border: 0.5px solid #91C03B;
			border-radius: 5px;
			padding: 25px 14px 22px 21px;
		}
		.dashboard h1{margin-bottom: 19px;}
		.dashboardMsg h2{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 700;
			font-size: 14px;
			line-height: 23px;
			text-align: justify;
			letter-spacing: 0.07em;
			color: #5B8E25;
			padding-bottom: 6px;
		}
		.dashboardMsg p{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 23px;
			text-align: justify;
			letter-spacing: 0.07em;
			color: #5B8E25;
		}
		.my-orders table{
			width: 100%;
			border-collapse: separate;
			border-spacing: 0 10px;
		}
		.my-orders table thead tr{
			background: #BD9C68;
		}
		.my-orders table thead{margin-bottom: 10px;}
		.my-orders table thead tr td:first-child{border-top-left-radius: 5px;border-bottom-left-radius: 5px;}
		.my-orders table thead tr td:last-child{border-top-right-radius: 5px;border-bottom-right-radius: 5px;}
		.my-orders table thead tr td{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 14px;
			line-height: 22px;
			text-align: justify;
			color: #fff;
			padding: 17px 23px;
		}
		.orders{padding-bottom: 47px;}
		.orders h1{margin-bottom: 9px;}
		.my-orders table tbody tr td{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 400;
			font-size: 13px;
			line-height: 16px;
			color: #1F242B;
			padding: 25px 24px 26px 24px;
		}
		.my-orders table tbody tr{background: #fff;}
		.changePassword .butn{display: flex;}
		.changePassword .butn button:last-child{padding: 13.5px 15.5px;}
		.changePassword .butn button{padding: 11.5px 16.5px;}
		.changePassword p{text-decoration: none;}
		.paymentMsg{
			box-sizing: border-box;
			width: 100%;
			/*height: 74px;*/
			background: #E0F1C1;
			border: 0.5px solid #91C03B;
			border-radius: 5px;
			padding: 25px 22px 10px 21px;
		}
		.paymentMsg p{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 700;
			font-size: 16px;
			line-height: 23px;
			text-align: justify;
			letter-spacing: 0.07em;
			color: #5B8E25;
		}
		.payment-tab{
			display: flex;
			margin-bottom: 27px;
			flex-wrap: wrap;
		}
		.paymentMethod p{text-decoration: none;}
		.paymentMethod .payment-tab a{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 12px;
			line-height: 29px;
			letter-spacing: 1px;
			color: #8B694E;
			background: #fff;
			border: 1px solid #8B694E;
			border-radius: 39px;
			padding: 3.5px 24px;
			display: flex;
			align-items: center;
			margin-right: 32px;
			margin-bottom: 16px;
		}
		.paymentMethod .payment-tab a.active{
			background: #8B694E;
			color: #fff;
		}
		.paymentMethod .payment-tab a:hover{
			background: #8B694E;
			color: #fff;
		}
		.paymentMethod .payment-tab a:hover span{
			border: 1px solid #fff;
		}
		.paymentMethod .payment-tab a.active span{
			border: 1px solid #fff;
		}
		.paymentMethod .payment-tab a:hover span:before{
			content: '';
			width: 7px;
			height: 7px;
			background: #fff;
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			border-radius: 50%;
		}
		.paymentMethod .payment-tab a.active span:before{
			content: '';
			width: 7px;
			height: 7px;
			background: #fff;
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			border-radius: 50%;
		}
		.paymentMethod .payment-tab a span{
			display: inline-block;
			width: 14px;
			height: 14px;
			border: 1px solid #8B694E;
			box-sizing: border-box;
			border-radius: 50%;
			margin-right: 12px;
			position: relative;
		}
		.payment-tab-body .data{display: none;}
		.payment-tab-body .data.active{display: block;}
		.paymentMethod .hide{display: none;}
		.addressesMsg{
			width: 100%;
			background: #E0F1C1;
			border: 0.5px solid #91C03B;
			border-radius: 5px;
			padding: 25px 22px 10px 21px;
			margin-bottom: 35px;
		}
		.addressesMsg p{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 700;
			font-size: 16px;
			line-height: 23px;
			text-align: justify;
			letter-spacing: 0.07em;
			color: #5B8E25;
		}
		.addresses button{padding: 13.5px 18px}
		.addresses p{text-decoration: none;}
		.address-tab{margin-bottom: 21px;}
		.address-tab a{
			background: #fff;
			border: 1px solid #8B694E;
			border-radius: 39px;
			padding: 7.5px 34px;
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 12px;
			line-height: 29px;
			text-align: center;
			letter-spacing: 1px;
			color: #8B694E;
			margin-right: 36px;
		}
		.address-tab a.active{
			background: #8B694E;
			color: #fff;
		}
		.address-tab a:hover{
			background: #8B694E;
			color: #fff;
		}
		.address-tab a:last-child{padding: 7.5px 43.5px;}
		.address-tab-body .data{display: none;}
		.address-tab-body .active{display: block;}
		.add_msg{display: none;}
		.billingAddress{padding-bottom: 22px;}
		.shippingAddress{padding-bottom: 53px;}
		.billingAddress p{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 400;
			font-size: 14px;
			line-height: 23px;
			text-align: justify;
			letter-spacing: 0.07em;
			color: #1F242B;
		}
		.account-tab-body.tab-body textarea{
			background: transparent;
			z-index: 2;
		}
		.account-tab-body.tab-body textarea + .imp{height: 127px;z-index: 1;}
		.account-login{
			padding-top: 60px;
			padding-bottom: 99px;
		}
		.account-login .main .content p{
			text-decoration: none;
			margin-bottom: 13px;
		}
		.account-login .main{
			width: 60%;
			background: #F4F4F2;
			margin-left: auto;
			margin-right: auto;
			padding-top: 32px;
			padding-bottom: 32px;
		}
		.account-login .main .content{
			width: 90%;
			background: #fff;
			margin-left: auto;
			margin-right: auto;
			padding: 27px 50px 45px 49px;
		}
		.account-login form .form-field{
			position: relative;
			margin-bottom: 31px;
		}
		.account-login form input{
			width: 100%;
			height: 48px;
			background: #fff;
			border: 1px solid #BD9C68;
			border-radius: 5px;
			position: relative;
			padding: 8px 16px;
		}
		.account-login form span.imp{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 16px;
			line-height: 22px;
			color: #FF0000;
			position: absolute;
			left: 4%;
			top: 12px;
		}
		.account-login form span.plc{
			color: #a0a0a0;
			padding-left: 1px;
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
		}
		.account-login form .butn{
			margin-top: 40px;
			margin-bottom: 35px;
		}
		.account-login form button{width: 100%;}
		.account-login form button:hover{
			background: #fff;
			color: #8B694E;
			border: 1px solid #8B694E;
		}
		.social-account .seperator{
			width: 100%;
			height: 1px;
			background: #C4C4C4;
		}
		.social-account p{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 400;
			font-size: 13px;
			line-height: 22px;
			text-align: center;
			color: #999999;
		}
		.switch-account{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 400;
			font-size: 13px;
			line-height: 22px;
			text-align: center;
			color: #999999;
			margin-top: 29px;
			/*margin-bottom: 40px!important;*/
		}
		.social-account .icons img{width: 46px;}
		.login-logo img{width: 68%;}
		.account-login .login .switch-account{
			margin-bottom: 40px!important;
		}
		.account-login .f-password .switch-account{
			margin-bottom: 40px!important;
		}
		.switch-account a{
			font-weight: 500;
			color: #999999;
			text-decoration: underline;
		}
		.social-account .icons{
			padding-top: 12px;
			padding-bottom: 32px;
			text-align: center;
		}
		.social-account .icons img:first-child{margin-right: 25px;}
		.login-logo{text-align: center;}
		.sh-pass{
			position: absolute;
			top: 50%;
			right: 19.64px;
			transform: translate(-50%, -50%);
			cursor: pointer;
		}
		.account-login .note p{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 400;
			font-size: 12px;
			line-height: 16px;
			text-align: justify;
			color: #999999;
		}
		.account-login .note p a{
			color: #8B694E;
		}
		.mb-9{margin-bottom: 9px!important;}
		.mt-16{margin-top: 16px!important;}
		.account-login .register .switch-account{
			margin-bottom: 0!important;
		}
		.account-login .main .register{
			padding: 27px 50px 29px 49px;
		}
		.account-login .f-password .login-logo{
			margin-bottom: 226px;
		}

		/* custom select */
		.form-field-select{
			position: relative;
		}
		.form-field-select .select{
			/*width: 258px;*/
			width: 100%;
			height: 48px;
			background: #fff;
			border:  1px solid #BD9C68;
			border-radius: 5px;	
			margin-bottom: 24px;
			padding: 0 20px;
			color: #a0a0a0;
			position: relative;
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
		}
		.form-field-select  .after .plc{
			color: #a0a0a0;
			padding-left: 2px;
		}
		.form-field-select .imp{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
			color: #E80000;
			position: absolute;
			left: 0;
			top: 0;
		}
		.form-field-select .plc{
			color: #a0a0a0;
			padding-left: 1px;
		}
		.form-field-select .after .imp{
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 22px;
			color: #E80000;
			position: absolute;
			left: 5%;
			top: 12px;
		}
		.form-field-select .after{
			display: inline-block;
			position: relative;
			width: 85%;
		}
		.form-field-select .after span.arw{
			display: inline-block;
			width: 48px;
			height: 48px;
			background: #BD9C68;
			border-radius: 0px 5px 5px 0px;
			position: absolute;
			top: 0;
			right: 0;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.after{position: relative;cursor: pointer;}
		.after .select{
			position: relative;
		}
		.after .custom-select{
			position: absolute;
			top: 48px;
			left: 0;
			width: 100%;
			z-index: 99;
			display: none;
		}
		.after .custom-select ul{
			list-style: none;
			font-family: 'open-sans-regular';
			font-style: normal;
			font-weight: 600;
			font-size: 13px;
			line-height: 20px;
			color: #7B7B7B;
			padding: 0;
		}
		.after .custom-select ul li{
			background: #fff;
			border: 1px solid #ddd;
			border-top: none;
			border-radius: 0px;
			padding: 13px 20.5px 14px 20.5px;
			text-align: left;
			cursor: pointer;
		}

		@media (min-width:1200px){
			/* my account */
			.tab-body .form-field{width: 326px;}
			.tab-body input{
				/*width: 326px;*/
				width: 100%;
			}
			.tab-body .select{
				/*width: 326px;*/
				width: 100%;
			}
			.tab-body .after{width: 326px;}
			.tab-body{
				padding-left: 74px;
				padding-right: 54px;
			}
			.tab-body .bodyMeasurement{padding-right: 16px;}
			.tab-body .kandoraMeasurement{padding-right: 16px;}
			.tab-body .accountDetail{padding-right: 16px;}
			.tab-body .changePassword{padding-right: 16px;}
			.tab-body .paymentMethod{padding-right: 16px;}
			.tab-body .addresses{padding-right: 16px;}
			.butn{width: 100%;}

			/* rkm listing */
			.list-items a.content-box{width: calc(95%/3);}

			/* account */
			.tab-body .d-input .form-field{
				width: 30%;
			}
			.tab-body .d-input .after{
				width: 30%;
			}
			.tab-body .d-input .after .imp{left: 12px;}
			.addresses button{padding: 13.5px 34px}
			.paymentMethod .payment-tab a{margin-bottom: 0;}
			.plc-adjust input{height: 48px;}
			.accountDetail .butn button{padding: 11.5px 50.5px;} 
			.changePassword .butn button{padding: 11.5px 50.5px;}
			.account-login .main{width: 40%;}
		}

		@media (min-width:1400px){
			/* account tabs */
			.account-forms form{
				display: flex;
				justify-content: space-between;
				flex-wrap: wrap;
			}
			.tab-head{
				width: 266px;
				/*height: 587px;*/
				height: auto;
			}
			.tab-body{
				width: calc(100% - 266px);
				padding-top: 30px;
				padding-left: 101px;
				padding-right: 62px;
			}
			.tab-body .bodyMeasurement{padding-right: 37px;}
			.tab-body .kandoraMeasurement{padding-right: 37px;}
			.tab-body .accountDetail{padding-right: 37px;}
			.tab-body .changePassword{padding-right: 37px;}
			.tab-body .paymentMethod{padding-right: 37px;}
			.tab-body .addresses{padding-right: 37px;}
			.tab-body .form-field{width: 391px;}
			.tab-body input{
				/*width: 391px;*/
				width: 100%;
				height: 48px;
				margin-bottom: 31px;
				padding: 0 20px;
			}
			.tab-body .select{
				/*width: 391px;*/
				width: 100%;
				height: 48px;	
				margin-bottom: 31px;
				padding: 0 20px;
				font-size: 16px;
			}
			.tab-body .after{width: 391px;}
			.tab-body .after span.arw{
				width: 48px;
				height: 48px;
			}
			.form-btn{
				padding: 13.5px 52.5px;
			}
			.mr-42{margin-right: 42px;}
			.mr-36{margin-right: 36px;}
			.butn{width: 100%;}
			.tab-body .after .imp{
				left: 4%;
				font-size: 16px;
			}
			.tab-body .d-input .after .imp{left: 6%;}
			.tab-body .form-field .imp{font-size: 16px;}
			.dashboardMsg h2{font-size: 16px;}
			.dashboardMsg p{font-size: 16px;}
			.addresses button{padding: 13.5px 40px;}
			.address-tab a{font-size: 14px;}
			.paymentMethod .payment-tab a{
				font-size: 14px;
				padding: 3.5px 30px;
				margin-right: 38px;
			}
			.accountDetail .butn button:last-child{padding: 13.5px 39.5px;}
			.changePassword .butn button:last-child{padding: 13.5px 23.5px;}
			.account-login form span.plc{font-size: 16px;}
			.account-login .main{width: 674px;}
			.account-login .main .content{width: 574px;}
			.social-account p{font-size: 16px;}
			.switch-account{font-size: 16px;}
			.social-account .icons img{width: auto;}
			.login-logo img{width: auto;}
			.after .custom-select ul{font-size: 15px;}
		}

		@media (max-width:990.99px){
			/* my account */
			.my-account .content{
				flex-direction: column;
			}
			.tab-head{
				width: 100%;
				border-radius: 5px 5px 0px 0px;
				margin-bottom: 2px;
			}
			.tab-head ul{
				height: 57px;
				padding-top: 0;
				margin-bottom: 0;
			}
			.tab-head ul li{
				border-radius: 5px 5px 0px 0px;
			}
			.tab-head ul li a:not(.active){
				float: left;
				display: none;
				width: 100%;
			}
			.tab-head ul li a:not(.active).SH{display: flex;}
			.tab-head ul li a.active{height: 57px;}
			.tab-body{
				width: 100%;
				padding-top: 30px;
				padding-left: 36px;
				padding-right: 34px;
				padding-bottom: 48px;
				border-radius: 0px 0px 5px 5px;
			}
			.tab-body .form-field{width: 48%;}
			.tab-body input{
				/*width: 48%;*/
				width: 100%;
			}
			.tab-body .after{width: 48%;}
			.tab-body .select{
				width: 100%;
			}
			.mr-42{margin-right: 0;}
			.account-forms form{
				display: flex;
				justify-content: space-between;
				flex-wrap: wrap;
			}
			.butn{width: 100%;}
			.tab-head .tab-arr{display: block;}

			/* account */
			.addresses .m-set{width: 48%;}
			.addresses .m-set .after{width: 100%;}
			.addresses .m-set .form-field{width: 100%;}
			.addresses .butn{display: flex;justify-content: space-between;flex-wrap: wrap;}
			.addresses button{padding: 13.5px 8.5%;}
			.accountDetail .butn button{padding: 11.5px 32.5px;}
			.changePassword .butn button{padding: 11.5px 50.5px;}

			/* rmk inner page */
			.rmk-innerpage .main .detail-slider{flex-direction: column;}
			.rmk-innerpage .detail-slider .slider{
				width: 80%;
				margin-left: auto;
				margin-right: auto;
				margin-bottom: 32px;
			}
			.slider-detail{width: 100%;}

			/* ai first page */
			.ai-first-steps .input-form form{width: 100%;}
			/*.ai-first-steps .step-1 .input-form .form-field-select .after{width: 100%;}*/
			.ai-first-steps .step-2 .taking-front-photo .butn{
				display: flex;
				flex-direction: column;
			}
			.ai-first-steps .step-2 .taking-front-photo .butn button:first-child{
				margin-right: 0;
				margin-bottom: 36px;
			}
			.ai-first-steps .step-4 .taking-front-photo .butn{
				display: flex;
				flex-direction: column;
			}
			.ai-first-steps .step-4 .taking-front-photo .butn button:first-child{
				margin-right: 0;
				margin-bottom: 36px;
			}
			.ai-first-steps .step-6 .taking-front-photo .butn{
				display: flex;
				flex-direction: column;
				align-items: center;
			}
			.get-measurement .taking-btn .butn span{margin: 8px 0;}
		}

		@media (max-width:767.99px){
			/* my account */
			.tab-body .form-field{width: 100%;}
			.tab-body input{width: 100%;}
			.tab-body .after{width: 100%;}
			.tab-body .form-field .imp{left: 0;}
			.tab-body .after .imp{left: 2.5%;}
			.dashboardMsg{
				height: auto;
				padding: 25px 14px 8px 21px;
			}
			.my-orders{overflow-y: scroll;}
			.my-orders table{width: 800px;}
			.addresses .m-set{width: 100%;}
			.address-tab div{
				display: flex;
				flex-wrap: wrap;
			}
			.address-tab div a{margin-bottom: 16px;}
			.account-login .main{width: 90%;}
			.account-login form .form-field{margin-bottom: 22px;}
			.account-login form .butn{
				margin-top: 28px;
				margin-bottom: 24px;
			}
			.account-login .main .content{width: 95%;}
			.social-account .icons{margin-bottom: 0;}
			.account-login .login .switch-account{margin-bottom: 24px!important;}
			.switch-account{margin-top: 22px;}
		}

		@media (max-width:468px){
			/* my account */
			.tab-body .form-field .imp{left: 3%;}
			.tab-body .after .imp{left: 4%;}
			.addresses button{margin-right: 0;}
			.address-tab div{justify-content: center;}
			.address-tab div a{margin-right: 0;}
			.payment-tab{justify-content: center;}
			.accountDetail .butn{flex-direction: column;}
			.changePassword .butn{flex-direction: column;}
		}

		@media (max-width:)
	</style>
</head>
<body>
	<div class="my-account">
		<div class="width fadeInDown">
			<div class="main">
				<div class="content">
					<div class="tab-head">
						<ul>
							<li>
								<a href="#dashboard" class="tab-head-font active">
									<img src="images/dashboard.png" alt="">
									<p>My Dashboard</p>
								</a>
							</li>
							<li>
								<a href="#orders" class="tab-head-font">
									<img src="images/orders.png" alt="">
									<p>My Orders</p>
								</a>
							</li>
							<li>
								<a href="#addresses" class="tab-head-font">
									<img src="images/addresses.png" alt="">
									<p>Addresses</p>
								</a>
							</li>
							<!-- <li>
								<a href="#paymentMethod" class="tab-head-font">
									<img src="images/payment-method.png" alt="">
									<p>Payment Methods</p>
								</a>
							</li> -->
							<li>
								<a href="#accountDetail" class="tab-head-font">
									<img src="images/account-detail.png" alt="">
									<p>Account Details</p>
								</a>
							</li>
							<li>
								<a href="#changePassword" class="tab-head-font">
									<img src="images/change-password.png" alt="">
									<p>Change Password</p>
								</a>
							</li>
							<li>
								<a href="#logout" class="tab-head-font">
									<img src="images/logout.png" alt="">
									<p>Logout</p>
								</a>
							</li>
						</ul>
						<span class="tab-arr"><img src="images/ExpandMore.png" alt=""></span>
					</div>
					<div class="tab-body account-tab-body">
						<div class="data account-forms dashboard active" id="dashboard">
							<div class="form">
								<h1 class="tab-body-main-font uppercase">My Dashboard</h1>
								<div class="dashboardMsg">
									<h2>Hello {{ $customer->name }} (If not {{ $customer->name }}) <a href="{{ route('customerLogout') }}">Log out?</a></h2>
									<p>From your account Dashboard you can view your recent orders, manage your shipping, update billing addresses, edit your password and account details.</p>
								</div>
							</div>
						</div>
						<div class="data account-forms orders" id="orders">
							<div class="form">
								<h1 class="tab-body-main-font uppercase">My Orders</h1>
								<div class="my-orders">
									<table border="0">
										<thead>
											<tr>
												<td>Order ID</td>
												<td>Order Date</td>
												<td>Product Name</td>
												<td>Qty</td>
												<td>Price</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>ABCD321</td>
												<td>14/04/22</td>
												<td>Royal Blue Kuwaiti Kandora</td>
												<td>342</td>
												<td>1643.50 AED</td>
											</tr>
											<tr>
												<td>ABCD321</td>
												<td>14/04/22</td>
												<td>Royal Blue Kuwaiti Kandora</td>
												<td>342</td>
												<td>1643.50 AED</td>
											</tr>
											<tr>
												<td>ABCD321</td>
												<td>14/04/22</td>
												<td>Royal Blue Kuwaiti Kandora</td>
												<td>342</td>
												<td>1643.50 AED</td>
											</tr>
											<tr>
												<td>ABCD321</td>
												<td>14/04/22</td>
												<td>Royal Blue Kuwaiti Kandora</td>
												<td>342</td>
												<td>1643.50 AED</td>
											</tr>
											<tr>
												<td>ABCD321</td>
												<td>14/04/22</td>
												<td>Royal Blue Kuwaiti Kandora</td>
												<td>342</td>
												<td>1643.50 AED</td>
											</tr>
											<tr>
												<td>ABCD321</td>
												<td>14/04/22</td>
												<td>Royal Blue Kuwaiti Kandora</td>
												<td>342</td>
												<td>1643.50 AED</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="data account-forms addresses" id="addresses">
								<h1 class="tab-body-main-font uppercase">Your Addresses</h1>
								<p class="tab-body-para-font">Mandatory fields are marked <span>*</span></p>
								<div class="address-tab">
									<div>
										<a href="#shippingAddress">Shipping Address</a>
										<a href="#billingAddress" class="active">Billing Address</a>
									</div>
								</div>
								<div class="address-tab-body">
									<div class="data shippingAddress" id="shippingAddress">
										<p>The following addresses will be used on the checkout page by default.</p>
										<form action="">
											<div class="form-field">
												<input type="text" name="name" class="mr-42" value="{{ $customer->name }}">
												<span class="imp">*<span class="plc">First Name</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="lastname">
												<span class="imp">*<span class="plc">Last Name</span></span>
											</div>
											<span class="m-set">
												<span class="after">
													<!-- <select name="countryregion" id="">
														<option value="">Country/Region</option>
													</select> -->
													<div class="select"></div>
													<div class="custom-select">
														<ul>
															<li>Your Preferred Fitting 1</li>
															<li>Your Preferred Fitting 2</li>
														</ul>
													</div>
													<span class="imp">*<span class="plc">Country Ragion</span></span>
													<span class="arw"><img src="images/ExpandMore.png" alt=""></span>
												</span>
												<div class="form-field">
													<input type="text" name="towncity" class="mr-42">
													<span class="imp">*<span class="plc">Town/City</span></span>
												</div>
											</span>
											<div class="form-field">
												<textarea type="text" name="address"></textarea>
												<span class="imp">*<span class="plc">Address</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="postcode" class="mr-42">
												<span class="imp"><span class="plc">Postcode/Zip (Optional)</span></span>
											</div>
											<span class="after">
												<!-- <select name="countryoptional" id="">
													<option value="">Country (Optional)</option>
												</select> -->
												<div class="select"></div>
												<div class="custom-select">
													<ul>
														<li>Your Preferred Fitting 1</li>
														<li>Your Preferred Fitting 2</li>
													</ul>
												</div>
												<span class="imp"><span class="plc">Country (Optional)</span></span>
												<span class="arw"><img src="images/ExpandMore.png" alt=""></span>
											</span>
											<div class="form-field">
												<input type="text" name="state" class="mr-42">
												<span class="imp">*<span class="plc">Enter State</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="number" class="mr-42">
												<span class="imp">*<span class="plc">Phone Number</span></span>
											</div>
											<div class="butn">
												<button class="uppercase form-btn tab-form-btn-font mr-36">Cancel</button>
												<button class="uppercase form-btn tab-form-btn-font">Save Address</button>
											</div>
										</form>
									</div>
									<div class="data billingAddress active" id="billingAddress">
										<p>The following addresses will be used on the checkout page by default.</p>
										<form action="">
											<div class="form-field">
												<input type="text" name="firstname" class="mr-42">
												<span class="imp">*<span class="plc">First Name</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="lastname">
												<span class="imp">*<span class="plc">Last Name</span></span>
											</div>
											<span class="m-set">
												<span class="after">
													<!-- <select name="countryregion" id="">
														<option value="">Country/Region</option>
													</select> -->
													<div class="select"></div>
													<div class="custom-select">
														<ul>
															<li>Your Preferred Fitting 1</li>
															<li>Your Preferred Fitting 2</li>
														</ul>
													</div>
													<span class="imp">*<span class="plc">Country Region</span></span>
													<span class="arw"><img src="images/ExpandMore.png" alt=""></span>
												</span>
												<div class="form-field">
													<input type="text" name="towncity" class="mr-42">
													<span class="imp">*<span class="plc">Town/City</span></span>
												</div>
											</span>
											<div class="form-field">
												<textarea type="text" name="address"></textarea>
												<span class="imp">*<span class="plc">Address</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="postcode" class="mr-42">
												<span class="imp"><span class="plc">Postcode/Zip (Optional)</span></span>
											</div>
											<span class="after">
												<!-- <select name="countryoptional" id="">
													<option value="">Country (Optional)</option>
												</select> -->
												<div class="select"></div>
												<div class="custom-select">
													<ul>
														<li>Your Preferred Fitting 1</li>
														<li>Your Preferred Fitting 2</li>
													</ul>
												</div>
												<span class="imp"><span class="plc">Country (Optional)</span></span>
												<span class="arw"><img src="images/ExpandMore.png" alt=""></span>
											</span>
											<div class="form-field">
												<input type="text" name="state" class="mr-42">
												<span class="imp">*<span class="plc">Enter State</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="number" class="mr-42">
												<span class="imp">*<span class="plc">Phone Number</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="email" class="mr-42">
												<span class="imp">*<span class="plc">Email</span></span>
											</div>
											<div class="form-field">
												<div class="butn">
													<button class="uppercase form-btn tab-form-btn-font mr-36">Cancel</button>
													<button class="uppercase form-btn tab-form-btn-font">Update Address</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							<div class="add_msg">
								<div class="addressesMsg">
									<p>No saved Addresses currently added or available.</p>
								</div>
								<div class="butn">
									<button class="uppercase form-btn tab-form-btn-font mr-36">Add Billing Address</button>
									<button class="uppercase form-btn tab-form-btn-font">Add Shipping Address</button>
								</div>
							</div>
						</div>
						<!-- <div class="data account-forms paymentMethod" id="paymentMethod">
							<div class="form">
								<h1 class="tab-body-main-font uppercase">Choose Payment Method</h1>
								<p class="tab-body-para-font">Mandatory fields are marked <span>*</span></p>
								<div class="payment-tab">
									<div>
										<a href="#cards" class="active">
											<span></span>
											Credit/Debit Card
										</a>
									</div>
									<div>
										<a href="#cashod" class="">
											<span></span>
											Cash on Delivery
										</a>
									</div>
									<div>
										<a href="#cardod" class="">
											<span></span>
											Cash on Delivery
										</a>
									</div>
								</div>
								<div class="payment-tab-body">
									<div class="data cards active" id="cards">
										<form action="">
											<div class="form-field">
												<input type="text" name="cardnumber" class="mr-42">
												<span class="imp">*<span class="plc">Card Number</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="mmyy">
												<span class="imp">*<span class="plc">MM/YY</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="cvv" class="mr-42">
												<span class="imp">*<span class="plc">CVV</span></span>
											</div>
											<div class="form-field">
												<input type="text" name="nameoncard">
												<span class="imp">*<span class="plc">Name on Card</span></span>
											</div>
											<div class="butn">
												<button class="uppercase form-btn tab-form-btn-font mr-36">Update</button>
												<button class="uppercase form-btn tab-form-btn-font">Remove</button>
											</div>
										</form>
									</div>
									<div class="data cashod" id="cashod">
										<div class="paymentMsg">
											<p>You have chosen cash on delivery payment method for your account.</p>
										</div>
									</div>
									<div class="data cardod" id="cardod">
										<div class="paymentMsg">
											<p>You have chosen card on delivery payment method for your account. </p>
										</div>
									</div>
								</div>
							</div>
							<div class="paymentMsg hide">
								<p>No saved Payment Methods found.</p>
							</div>
						</div> -->
						<div class="data account-forms accountDetail" id="accountDetail">
							<div class="form">
								<h1 class="tab-body-main-font uppercase">Account Details</h1>
								<p class="tab-body-para-font">Mandatory fields are marked <span>*</span></p>
								<form id="accountDetailForm" method="post">
									<div class="form-field">
										<input type="text" name="name" class="mr-42" value="{{ $customer->name }}">
										<span class="imp">*<span class="plc">Name</span></span>
										<span class="errors" id="nameErr"></span>
									</div>
									<div class="form-field">
										<input type="text" name="email" value="{{ $customer->email }}">
										<span class="imp">*<span class="plc">Email</span></span>
										<span class="errors" id="emailErr"></span>
									</div>
									<div class="form-field">
										<input type="text" name="phone" class="mr-42" value="{{ $customer->phone }}">
										<span class="imp">*<span class="plc">Phone</span></span>
										<span class="errors" id="phoneErr"></span>
									</div>

									<div class="form-field">
										<input type="text" name="address" class="mr-42" value="{{ $customer->address }}">
										<span class="imp">*<span class="plc">Address</span></span>
										<span class="errors" id="addressErr"></span>
									</div>

									<span class="m-set">
										<span class="after">
											<div class="select"></div>
											<div class="custom-select">
												<ul class="state-list">
													<li data-country-code="">Select state</li>
							                        <li data-state-code="AN">Andaman and Nicobar Islands</li>
							                        <li data-state-code="AP">Andhra Pradesh</li>
							                        <li data-state-code="AR">Arunachal Pradesh</li>
							                        <li data-state-code="AS">Assam</li>
							                        <li data-state-code="BR">Bihar</li>
							                        <li data-state-code="CH">Chandigarh</li>
							                        <li data-state-code="CT">Chhattisgarh</li>
							                        <li data-state-code="DN">Dadra and Nagar Haveli</li>
							                        <li data-state-code="DD">Daman and Diu</li>
							                        <li data-state-code="DL">Delhi</li>
							                        <li data-state-code="GA">Goa</li>
							                        <li data-state-code="GJ">Gujarat</li>
							                        <li data-state-code="HR">Haryana</li>
							                        <li data-state-code="HP">Himachal Pradesh</li>
							                        <li data-state-code="JK">Jammu and Kashmir</li>
							                        <li data-state-code="JH">Jharkhand</li>
							                        <li data-state-code="KA">Karnataka</li>
							                        <li data-state-code="KL">Kerala</li>
							                        <li data-state-code="LA">Ladakh</li>
							                        <li data-state-code="LD">Lakshadweep</li>
							                        <li data-state-code="MP">Madhya Pradesh</li>
							                        <li data-state-code="MH">Maharashtra</li>
							                        <li data-state-code="MN">Manipur</li>
							                        <li data-state-code="ML">Meghalaya</li>
							                        <li data-state-code="MZ">Mizoram</li>
							                        <li data-state-code="NL">Nagaland</li>
							                        <li data-state-code="OR">Odisha</li>
							                        <li data-state-code="PY">Puducherry</li>
							                        <li data-state-code="PB">Punjab</li>
							                        <li data-state-code="RJ">Rajasthan</li>
							                        <li data-state-code="SK">Sikkim</li>
							                        <li data-state-code="TN">Tamil Nadu</li>
							                        <li data-state-code="TG">Telangana</li>
							                        <li data-state-code="TR">Tripura</li>
							                        <li data-state-code="UP">Uttar Pradesh</li>
							                        <li data-state-code="UT">Uttarakhand</li>
							                        <li data-state-code="WB">West Bengal</li>
												</ul>
											</div>
											<input id="state" type="name" value="" name="state">
											<span class="imp set_default_state">*<span class="plc" data-default="{{ $customer->state }}">hhhhh</span></span>
											<span class="arw"><img src="images/ExpandMore.png" alt=""></span>
										</span>
										<div class="form-field">
											<input type="text" name="towncity" class="mr-42">
											<span class="imp">*<span class="plc">Town/City</span></span>
										</div>
									</span>

									<div class="form-field plc-adjust">
										<input type="text" name="currentpassword" class="mr-42">
										<span class="imp"><span class="plc">Current Password (blank to leave unchanged)</span></span>
									</div>
									<div class="form-field plc-adjust">
										<input type="text" name="newpassword">
										<span class="imp"><span class="plc">New Password (blank to leave unchanged)</span></span>
									</div>
									<div class="form-field">
										<input type="text" name="confirmnewpassword" class="mr-42">
										<span class="imp"><span class="plc">Confirm New Password</span></span>
									</div>
									<div class="form-field">
										<div class="butn">
											<button class="uppercase form-btn tab-form-btn-font mr-36">Cancel</button>
											<button id="accountDetailFormBtn" class="uppercase form-btn tab-form-btn-font">Save Changes</button>
										</div>
									</div>
								</form>
							</div>
						</div>						
						<div class="data account-forms changePassword" id="changePassword">
							<div class="form">
								<h1 class="tab-body-main-font uppercase">Change Password</h1>
								<p class="tab-body-para-font">Mandatory fields are marked <span>*</span></p>
								<form action="">
									<div class="form-field">
										<input type="text" name="currentpassword" class="mr-42">
										<span class="imp">*<span class="plc">Current Password</span></span>
									</div>
									<div class="form-field">
										<input type="text" name="newpassword">
										<span class="imp">*<span class="plc">New Password</span></span>
									</div>
									<div class="form-field">
										<input type="text" name="confirmpassword" class="mr-42">
										<span class="imp">*<span class="plc">Confirm Password</span></span>
									</div>
									<div class="form-field">
										<div class="butn">
											<button class="uppercase form-btn tab-form-btn-font mr-36">Cancel</button>
											<button class="uppercase form-btn tab-form-btn-font">Update Password</button>
										</div>
									</div>
								</form>
							</div>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	// account tabs
  if($(window).width() < 991){

    $('.tab-head ul').on('click', ".active", function() {
      var a = $(this).closest("ul").children('li').children('a:not(.active)').toggleClass('SH');
      console.log(a);
    });

    var allOption = $('.tab-head ul').children('li').children('a:not(.active)');
    // console.log(allOption)
    $('.tab-head ul').on('click', 'a:not(.active)', function() {
      allOption.removeClass('selected');
      $(this).addClass('selected');
      $('.tab-head ul li').children('.active').html($(this).html());
      var id = $(this).attr('href');
      $('.tab-body .account-forms').removeClass('active');
      $(id).addClass('active');
      allOption.toggleClass('SH');
    });
    
  }else{

    $('.tab-head ul li a').click(function() {
      $('.tab-head ul li a').removeClass('active');
      $(this).addClass('active');
      var id = $(this).attr('href');
      $('.tab-body .account-forms').removeClass('active');
      $(id).addClass('active');
      // console.log(id);
    });

  }

  // address tab
  $('.address-tab div a').click(function(e) {
    e.preventDefault();
    $('.address-tab div a').removeClass('active');
    $(this).addClass('active');
    var id = $(this).attr('href');
    $('.address-tab-body div').removeClass('active');
    $(id).addClass('active');
  });

  // payment tab
  $('.payment-tab div a').click(function(){
    $('.payment-tab div a').removeClass('active');
    $(this).addClass('active');
    var id = $(this).attr('href');
    $('.payment-tab-body .data').removeClass('active');
    $(id).addClass('active');
  });

  // checkout payment method tab
  $('.choose-payment-method-tab .cpmt-tab .tab a').click(function(){
    $('.choose-payment-method-tab .cpmt-tab .tab a').removeClass('active');
    $(this).addClass('active');
    var id = $(this).attr('href');
    $('.choose-payment-method-tab .cpmt-tab .tab-body-content').removeClass('active');
    $(id).addClass('active');
  });

  // checkout address detail tab 
  $('.billing-detail-form .tab a').click(function(){
    $('.billing-detail-form .tab a').removeClass('active');
    $(this).addClass('active');
    var id = $(this).attr('href');
    $('.billing-detail-form .tab-body-content').removeClass('active');
    $(id).addClass('active');
  });


  // remove plc from input on click
  $('.form-field input').focusin(function(){
    $(this).next('.imp').css('opacity','0');
    $(this).css('background','#fff');
  });
  $('.form-field input').focusout(function(){
    $(this).next('.imp').css('opacity','1');
    $(this).css('background','transparent');
    // var a = $(this).val();
    if($(this).val()){
      // console.log('user input done')
      $(this).next('.imp').css('opacity','0');
      $(this).css('background','#fff');
    }
    // console.log(a);
    // console.log('input clicked');
  });
   $('.form-field textarea').focusin(function(){
    $(this).next('.imp').css('opacity','0');
    $(this).css('background','#fff');
    // console.log('input clicked');
  });
  $('.form-field textarea').focusout(function(){
    $(this).next('.imp').css('opacity','1');
    $(this).css('background','transparent');
    if ($(this).val()){
      $(this).next('.imp').css('opacity','0');
      $(this).css('background','#fff');
    }
    // console.log('input clicked');
  });
  $('.form-field-input input').focusin(function(){
    $(this).next('.imp').css('opacity','0');
    $(this).css('background','#fff');
    // console.log('input clicked');
  });
  $('.form-field-input input').focusout(function(){
    $(this).next('.imp').css('opacity','1');
    $(this).css('background','transparent');
    if ($(this).val()){
      $(this).next('.imp').css('opacity','0');
      $(this).css('background','#fff');
    }
    // console.log('input clicked');
  });
  $('.form-field-textarea textarea').focusin(function(){
    $(this).next('.imp').css('opacity','0');
    $(this).css('background','#fff');
    // console.log('input clicked');
  });
  $('.form-field-textarea textarea').focusout(function(){
    $(this).next('.imp').css('opacity','1');
    $(this).css('background','transparent');
    if ($(this).val()){
      $(this).next('.imp').css('opacity','0');
      $(this).css('background','#fff');
    }
    // console.log('input clicked');
  });

  // custom select
  $('.after').click(function(){
   var a = $(this).children('.custom-select').slideToggle('slow');
   var b = $(this).children('.imp').text();
   var text = $(this).children('.imp');
   // var b = $(a).next('.custom-select');
   // console.log(b);
   var c = $(this).children('.custom-select').children('ul').children('li');
   // console.log(c)
   $(c).click(function(){
    var d = $(this).text();
    $(text).text(d);
    $(text).css('color','#a0a0a0');
    // b.html(d);
    // console.log(b);
   });
  });

  // customize section tabs
  $('.customize-section .customize-tab .tab-main').click(function(){
    $('.customize-section .customize-tab .tab-main').removeClass('active');
    $(this).addClass('active');
    var $id = $(this).attr('href');
    $('.customize-section .customize-tab .tab-content').removeClass('active');
    $($id).addClass('active');
  });
  $('.customize-section .customize-tab .tab-content div a').click(function(){
    $('.customize-section .customize-tab .tab-content div a').removeClass('toggleSelect');
    $(this).addClass('toggleSelect');
  });

  // increament decreament counter
    const minus = $('.quantity__minus');
    const plus = $('.quantity__plus');
    const input = $('.quantity__input');
    minus.click(function(e) {
      e.preventDefault();
      var value = input.val();
      if (value > 1) {
        value--;
      }
      input.val(value);
    });
    
    plus.click(function(e) {
      e.preventDefault();
      var value = input.val();
      value++;
      input.val(value);
    });

</script>
<!-- <script src="js/script.js"></script> -->

<script>
$(document).ready(function(){
  $('.state-list li').click(function(){
    var dataVal = $(this).attr('data-state-code');
    $('#state').val(dataVal);
   });

  var liData = document.querySelectorAll('.state-list li[data-state-code]');
  var dData = $('.set_default_state .plc').attr('data-default');
  
  liData.forEach(function(li){
  	if(li.getAttribute('data-state-code') === dData){
  		var defaultLi = li.innerText;
  		$('.set_default_state .plc').html(defaultLi)
  	}
  });

});
</script>

@endsection
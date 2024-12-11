<br> <br> <br><br>
<?php  
	include '../config/koneksi.php';
	include '../library/fungsi.php';

	session_start();
	date_default_timezone_set("Asia/Jakarta");

	$aksi = new oop();
	if (empty($_SESSION['user'])) {
		$aksi->alert("Harap Login Dulu !!!","login.php");
	}

	if (isset($_GET['logout'])) {
		unset($_SESSION['user']);
		unset($_SESSION['id_user']);
		unset($_SESSION['full_name']);
		unset($_SESSION['role']);
		$aksi->alert("logout Berhasil !!!","login.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>PT. HOME CREDIT INDONESIA</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<style type="text/css">
		.navbar-fixed-top{
			background-color: #540707;
			text-color: white;
			left: 0;
			width: 100%;
			padding: 10px
		}
		.footer {
			left: 0;
			bottom: 0;
			width: 100%;
			background-color: #540707;
			color: white;
			text-align: center;
			margin-top: -60px;
			padding: 25px
		}
	</style>
</head>
<link rel="stylesheet" type="text/css"	href="css/style.css">
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="navbar navbar-fixed-top navbar-default">
					<div class="navbar-header">
						<a href="?menu=home" class="navbar-brand" style="margin-top: -10px;">
						<img alt="Brand" src="../images/R.png" width="100px">
						</a>
					</div>
					<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="?masterdata">
								<strong style="color: white;font-calibri: Myriad Pro Light">MASTER DATA</strong>&nbsp;
								<span class="caret" style="color: white"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="?menu=masterdata">
								<li>
									<a href="?menu=parameter"><strong style="color: black;font-calibri: Myriad Pro Light">PARAMETER</strong></a>
								</li>
								<li>
									<a href="?menu=sub_parameter"><strong style="color: black;font-calibri: Myriad Pro Light">SUB PARAMETER</strong></a>
								</li>
								<!-- <li>
									<a href="?menu=tarif"><strong style="color: black;font-calibri: Myriad Pro Light">PENGELOLAAN DATA TARIF</strong></a>
								</li>
								<li>
									<a href="?menu=pelanggan"><strong style="color: black;font-calibri: Myriad Pro Light">PENGELOLAAN DATA PELANGGAN</strong></a>
								</li>
								<li>
									<a href="?menu=teller"><strong style="color: black;font-calibri: Myriad Pro Light">PENGELOLAAN DATA TELLER</strong></a>
								</li>
								<li>
									<a href="?menu=manager"><strong style="color: black;font-calibri: Myriad Pro Light">PENGELOLAAN DATA MANAGER</strong></a>
								</li> -->
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="process">
								<strong style="color: white;font-calibri: Myriad Pro Light">PROCESS</strong>&nbsp;
								<span class="caret" style="color: white"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="process">
								<li>
									<a href="?menu=process"><strong style="color: black;font-calibri: Myriad Pro Light">INBOUND CALL</strong></a>
								</li>
								<li>
									<a href="?menu=process_email"><strong style="color: black;font-calibri: Myriad Pro Light">EMAIL</strong></a>
								</li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="report">
								<strong style="color: white;font-calibri: Myriad Pro Light">REPORT</strong>&nbsp;
								<span class="caret" style="color: white"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="report">
								<li>
									<a href="?menu=report"><strong style="color: black;font-calibri: Myriad Pro Light">PERFORMANCE and FINDING REPORT</strong></a>
								</li>
								<li>
									<a href="?menu=report_qa"><strong style="color: black;font-calibri: Myriad Pro Light">PERFORMANCE QA AGENT</strong></a>
								</li>
							</ul>
						</li>
					</ul>
					
					<ul class="nav navbar-nav navbar-right" style="margin-right: 40px;">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="akun">
								<strong style="color: white;font-calibri: Myriad Pro Light"><?php echo $_SESSION['full_name']; ?></strong>&nbsp;
								<span class="caret" style="color: white"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="akun">
								<li>
									<a href="?menu=profil">
										<strong style="color: black;font-calibri: Myriad Pro Light">PROFILE</strong>
									</a>
								</li>
								<li>
									<a href="?menu=account">
										<strong style="color: black;font-calibri: Myriad Pro Light">ACCOUNT</strong>
									</a>
								</li>
								<li>
									<a href="?logout" onclick="return confirm('Yakin akan keluar dari aplikasi ini ?')">
										<strong style="color: black;font-calibri: Myriad Pro Light">LOG OUT</strong>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php  
		switch (@$_GET['menu']) {
			case 'home':include'home.php'; break;
			case 'parameter':include'parameter.php'; break;
			case 'sub_parameter':include'sub_parameter.php'; break;
			case 'process':include'process.php'; break;
			case 'process_email':include'process_email.php'; break;
			case 'pelanggan':include'pelanggan.php'; break;
			case 'manager':include'manager.php'; break;
			case 'penggunaan':include'penggunaan.php'; break;
			case 'tagihan':include'tagihan.php'; break;
			case 'laporan':include'laporan.php'; break;
			case 'report':include'report.php'; break;
			case 'report_qa':include'report_qa.php'; break;
			case 'profil':include'profil.php'; break;
			case 'account':include'account.php'; break;
			default:$aksi->redirect("?menu=home");break;
		}
	?>

	<br><br>
	<div class="footer">
		<p>
		  	
			  
		</p>
	</div>
	
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
</body>
</html>
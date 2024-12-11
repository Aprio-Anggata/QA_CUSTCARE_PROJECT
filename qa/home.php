<?php 
	if (!isset($_GET['menu'])) {
	 	header('location:menu_utama.php?menu=home');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style type="text/css">
        .middle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .container {
            width: 100%;
            max-width: 1200px; /* Sesuaikan dengan lebar maksimum yang diinginkan */
            margin: 0 auto;
            padding: 15px; /* Menambah padding untuk memberikan ruang di dalam container */
        }
    </style>
</head>
<body>
    <div style="color: black; font-family: Myriad Pro Light">
        <div class="middle" style="color: black; font-size: 50px">
            <h1><b>SCORE CARD FORM </b></h1>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <marquee><h3>Welcome <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="akun">
                        <strong style="color: black; font-family: Myriad Pro Light"><?php echo $_SESSION['full_name']; ?></strong>&nbsp;, Tihs is aplication score card QA v.1.0.0</h3></marquee>
                        <center><img src="../images/Quality-Assurance-02.png" width="30%"></center>
                    </div>      
                </div> 
                <hr>
                <p>PT. HOME CREDIT INDONESIA</p>
            </div>
        </div>
    </div>
</body>
</html>



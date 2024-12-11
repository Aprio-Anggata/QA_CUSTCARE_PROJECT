<?php  
    if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=process');
	}
	//dasar
	$table = "population_tbl";
	$id = @$_GET['id'];
	$where = " sid = '$id'";
	$redirect = "?menu=process";

	if (isset($_POST['sid'])) {
		$sid = $_POST['sid'];
		$population = $aksi->caridata("population_tbl WHERE sid = '$sid'");
		if ($population == "") {
			$aksi->pesan('Data has been deleted');
		}
	}elseif(isset($_GET['hapus']) OR isset($_GET['edit'])){
		$population = $aksi->caridata("population_tbl WHERE sid = '$id'");
		$sid = $population['sid'];
	}
        //Population
		@$population = $aksi->caridata("population_tbl WHERE sid = '$sid'");
        @$sid = $population['sid'];
        @$contract_number = $population['contract_number'];
        @$source = $population['source'];
        @$full_name = $population['full_name'];
        @$type = $population['type'];
        @$subtype = $population['subtype'];
        @$sub_subtype = $population['sub_subtype'];
        @$note = $population['note'];
        @$result = $population['result'];
        @$date_input = $population['date_input'];
        @$agent_name = $population['agent_name'];
        @$agent_nik = $population['agent_nik'];
        @$media = $population['media'];

        //User
		@$user = $aksi->caridata("user_tbl WHERE id_user = '$id_user'");
        @$full_name_user = $user['full_name'];
        @$nik = $user['nik'];

        //Parameter and SubParameter
        @$parameter_tbl = $aksi->caridata("parameter_qa_tbl WHERE id_parameter = '$id_parameter'");
        @$sub_parameter = $aksi->caridata("sub_parameter_tbl WHERE id_sub_par = '$parameter_tbl[id_sub_par]'");
		@$parameter = $parameter_tbl['parameter'];
		@$par_desc = $parameter_tbl['par_desc'];
		@$par_weight = $parameter_tbl['par_weight'];
		@$id_sub_par = $parameter_tbl['id_sub_par'];

        @$sub_par_name = $sub_parameter['sub_par_name'];
        @$sub_par_score = $sub_parameter['sub_par_score'];
        @$ko_status = $sub_parameter['ko_status '];

	    @$sid = $_POST['sid'];
	    @$bulan = $_POST['bulan'];
	    @$contract_number = $_POST['contract_number'];
        @$source = $_POST['source'];
        @$full_name = $_POST['full_name'];
        @$type = $_POST['type'];
        @$subtype = $_POST['subtype'];
        @$sub_subtype = $_POST['sub_subtype'];
        @$note = $_POST['note'];
        @$result = $_POST['result'];
        @$date_input = $_POST['date_input'];
        @$agent_name = $_POST['agent_name'];
        @$agent_nik = $_POST['agent_nik'];
        @$media = $_POST['media'];
        @$jumlah_pembayaran = ($par_weight);
        @$id_user = $id_user.$nik;

// PARAMETER VARIABEL
        @$par_desc_gg= $_POST['par_desc_gg']; 
        @$par_weight_gg = $_POST['par_weight_gg']; 
        @$sub_par_id_gg = $_POST['sub_par_id_gg']; 
        @$sub_par_score_gg = $_POST['sub_par_score_gg']; 
        @$note_subtypee1g = $_POST['note_subtypee1g']; 

        @$par_desc_pk = $_POST['par_desc_pk']; 
        @$par_weight_pk = $_POST['par_weight_pk']; 
        @$sub_par_id_pk = $_POST['sub_par_id_pk']; 
        @$sub_par_score_pk = $_POST['sub_par_score_pk'];
        @$note_subtypee2p = $_POST['note_subtypee2p'];

        @$par_desc_sop = $_POST['par_desc_sop']; 
        @$par_weight_sop = $_POST['par_weight_sop']; 
        @$sub_par_id_sop = $_POST['sub_par_id_sop']; 
        @$sub_par_score_sop = $_POST['sub_par_score_sop'];
        @$note_subtypee3s = $_POST['note_subtypee3s'];

        
        @$par_desc_cs = $_POST['par_desc_cs']; 
        @$par_weight_cs = $_POST['par_weight_cs']; 
        @$sub_par_id_cs = $_POST['sub_par_id_cs']; 
        @$sub_par_score_cs = $_POST['sub_par_score_cs'];
        @$note_subtypee4c = $_POST['note_subtypee4c'];

        @$par_desc_rd = $_POST['par_desc_rd']; 
        @$par_weight_rd = $_POST['par_weight_rd']; 
        @$sub_par_id_rd = $_POST['sub_par_id_rd']; 
        @$sub_par_score_rd = $_POST['sub_par_score_rd'];
        @$note_subtypee5r = $_POST['note_subtypee5r'];

        @$par_desc_cp = $_POST['par_desc_cp']; 
        @$par_weight_cp = $_POST['par_weight_cp']; 
        @$sub_par_id_cp = $_POST['sub_par_id_cp']; 
        @$sub_par_score_cp = $_POST['sub_par_score_cp'];
        @$note_subtypee6c = $_POST['note_subtypee6c'];

        @$total_score = $_POST['total_score'];
        @$qa_name = $_POST['qa_name'];


	// echo $id_penggunaan_next."-".$tahun."-".$bulan;
	@$field_next = array(
		'id_user'=>$id_user,
		'sid'=>$sid,
	);


	@$field = array(
		'full_name'=>$full_name,
		'date_input'=>$date_input,
		'full_name'=>$_SESSION['full_name'],
	);

    @$cek = $aksi->cekdata("score_tbl WHERE sid = '$sid'");
	if (isset($_POST['bsimpan'])) {
		@$cek = $aksi->cekdata("score_tbl WHERE sid = '$sid' AND sid != '$edit[sid]'");
		if 
		($cek > 0) {
			$aksi->pesan("The sample ID has already been claimed..! Please choose another one");
		}else{
			// $aksi->simpan($table,$data);
			mysqli_query($GLOBALS["___mysqli_ston"],"INSERT INTO score_tbl (sid, agent_name, agent_nik, sum_score, score_date, qa_name, p1a,p1b,p1c,p2a,p2b,p2c,p3a,p3b,p3c,p4a,p4b,p4c,p5a,p5b,p5c,p6a,p6b,p6c, contract_number, media) 
			 value 
			 ('$sid','$agent_name','$agent_nik','$total_score',NOW(),'$qa_name','$sub_par_id_gg','$sub_par_score_gg','$note_subtypee1g','$sub_par_id_pk','$sub_par_score_pk','$note_subtypee2p','$sub_par_id_sop','$sub_par_score_sop','$note_subtypee3s','$sub_par_id_cs','$sub_par_score_cs','$note_subtypee4c','$sub_par_id_rd','$sub_par_score_rd','$note_subtypee5r','$sub_par_id_cp','$sub_par_score_cp','$note_subtypee6c','$contract_number','$media')"); 
			$aksi->alert("Score Card Successfully Saved",$redirect);
		}
	}


    if (isset($_POST['bubah'])) {
		@$cek = $aksi->cekdata("score_tbl WHERE sid = '$sid' AND id_score != '$edit[sid]'");
		if 
		($cek > 0) {
			$aksi->pesan("The sample ID has already been claimed..! Please choose another one");
		}else{
			// $aksi->simpan($table,$data);
			mysqli_query($GLOBALS["___mysqli_ston"],"INSERT INTO score_tbl (sid, agent_name, agent_nik, sum_score, score_date, qa_name, p1a,p1b,p1c,p2a,p2b,p2c,p3a,p3b,p3c,p4a,p4b,p4c,p5a,p5b,p5c,p6a,p6b,p6c, contract_number, media) 
			 value 
			 ('$sid','$agent_name','$agent_nik','$total_score',NOW(),'$qa_name','$sub_par_id_gg','$sub_par_score_gg','$note_subtypee1g','$sub_par_id_pk','$sub_par_score_pk','$note_subtypee2p','$sub_par_id_sop','$sub_par_score_sop','$note_subtypee3s','$sub_par_id_cs','$sub_par_score_cs','$note_subtypee4c','$sub_par_id_rd','$sub_par_score_rd','$note_subtypee5r','$sub_par_id_cp','$sub_par_score_cp','$note_subtypee6c','$contract_number','$media')"); 
			$aksi->alert("Score Card Successfully Saved",$redirect);
		}
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus("score_tbl","sid = '$sid'");
		$aksi->hapus("score_tbl","sid = '$sid'");
		$aksi->alert("Data Berhasil Dihapus",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE sid LIKE '%$text%' OR contract_number LIKE '%$text%' OR type LIKE '%$text%' OR subtype LIKE '%$text%' OR sub_subtype LIKE '%$text%' OR note LIKE '%$text%' OR result LIKE '%$text%' OR media LIKE '%$text%' OR agent_name LIKE '%$text%'";
	}else{
		$cari=" WHERE sid != 0";
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
    <marquee><h3>You login with account <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="akun">
				<strong style="color: Black light;font-family: Myriad Pro Light"><?php echo $_SESSION['full_name']; ?></strong>&nbsp;, please check detail before submiting </h3></marquee>
    <br>

    <<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">POPULATION SAMPLE DATA</div>
        <div class="panel-body">
            <div class="col-md-12">
                <form method="post">
                    <div class="input-group">
                        <input type="text" name="tcari" class="form-control" value="<?php echo @$text ?>" placeholder="Masukan Keyword Pencarian (Sample ID, Contract Number, Media, Type, Subtype, Sub Subtype, Etc.) ......">
                        <div class="input-group-btn">
                            <button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
                            <button type="submit" name="brefresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="table-responsive" style="max-height: 400px; overflow-y: scroll;">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <th><center>No.</center></th>
                            <th>Sample ID</th>
                            <th>Contract Number</th>
                            <th>Full Name</th>
                            <th>Source</th>
                            <th>Type</th>
                            <th>Subtype</th>
                            <th>Sub Subtype</th>
                            <th>Note</th>
                            <th>Result</th>
                            <th>Date Input</th>
                            <th>Agent Name</th>
                            <th>Agent Nik</th>
                            <th>Media</th>
                            <th colspan="1"><center>Aksi</center></th>
                        </thead>
                        <tbody>
                            <?php  
                                $no = 0;
                                $data = $aksi->tampil("population_tbl", $cari, "ORDER BY date_input DESC");
                                if ($data == "") {
                                    $aksi->no_record(8);
                                } else {
                                    foreach ($data as $r) {
                                        // Mengecek data dengan kondisi media = 'Inbound Email'
                                        $cek = $aksi->cekdata("population_tbl WHERE sid = '{$r['sid']}' AND media = 'Inbound Email'");

                                        $no++; ?>

                                        <tr>
                                            <td align="center"><?php echo $no; ?>.</td>
                                            <td><?php echo htmlspecialchars($r['sid']); ?></td>
                                            <td><?php echo htmlspecialchars($r['contract_number']); ?></td>
                                            <td><?php echo htmlspecialchars($r['full_name']); ?></td>
                                            <td><?php echo htmlspecialchars($r['source']); ?></td>
                                            <td><?php echo htmlspecialchars($r['type']); ?></td>
                                            <td><?php echo htmlspecialchars($r['subtype']); ?></td>
                                            <td><?php echo htmlspecialchars($r['sub_subtype']); ?></td>
                                            <td><?php echo htmlspecialchars($r['note']); ?></td>
                                            <td><?php echo htmlspecialchars($r['result']); ?></td>
                                            <td><?php echo htmlspecialchars($r['date_input']); ?></td>
                                            <td><?php echo htmlspecialchars($r['agent_name']); ?></td>
                                            <td><?php echo htmlspecialchars($r['agent_nik']); ?></td>
                                            <td><?php echo htmlspecialchars($r['media']); ?></td>
                                            <?php  
                                                if ($cek == 0) { ?>
                                                    <td colspan="2"></td>
                                                <?php } else { ?>
                                                    <td align="center"><a href="?menu=process_email&edit&id=<?php echo htmlspecialchars($r['sid']); ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                                                <?php } ?>
                                        </tr>
                                <?php 
                                    } 
                                } 
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
        <!-- <div class="panel-footer">&nbsp;</div> -->
    </div>
</div>

<div class="container-fluid" style="color: black; font-family: Myriad Pro Light">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php if (!@$_GET['id']) { ?>
                        SCORE CARD INPUT
                    <?php } else { ?>
                        SCORE CARD ADD
                    <?php } ?>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>SAMPLE ID</label>
                                    <input type="text" name="sid" class="form-control" placeholder="Sample ID" required readonly value="<?php echo @$edit['sid'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>CONTRACT NUMBER</label>
                                    <input type="text" name="contract_number" class="form-control" placeholder="Contract Number" required readonly value="<?php echo @$edit['contract_number'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>FULL NAME CUSTOMER</label>
                                    <input type="text" name="full_name" class="form-control" placeholder="Customer Name" required readonly value="<?php echo @$edit['full_name']; ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>MEDIA</label>
                                    <input type="text" name="media" class="form-control" placeholder="Media" required readonly value="<?php echo @$edit['media'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>TYPE</label>
                                    <input type="text" name="type" class="form-control" placeholder="Type" required readonly value="<?php echo @$edit['type'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>SUBTYPE</label>
                                    <input type="text" name="subtype" class="form-control" placeholder="Subtype" required readonly value="<?php echo @$edit['subtype'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>SUB SUBTYPE</label>
                                    <input type="text" name="sub_subtype" class="form-control" placeholder="Sub Subtype" required readonly value="<?php echo @$edit['sub_subtype'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>NOTE</label>
                                    <input type="text" name="note" class="form-control" placeholder="Note" required readonly value="<?php echo @$edit['note'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>RESULT</label>
                                    <input type="text" name="result" class="form-control" placeholder="Result" required readonly value="<?php echo @$edit['result'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>DATE RECORD</label>
                                    <input type="date" name="date_input" class="form-control" placeholder="Date Record" required readonly value="<?php echo @$edit['date_input']; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>SOURCE</label>
                                    <input type="text" name="source" class="form-control" placeholder="Source" required readonly value="<?php echo @$edit['source'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>AGENT NAME</label>
                                    <input type="text" name="agent_name" class="form-control" placeholder="Agent Name" required readonly value="<?php echo @$edit['agent_name'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>AGENT NIK</label>
                                    <input type="text" name="agent_nik" class="form-control" placeholder="Agent NIK" required readonly value="<?php echo @$edit['agent_nik'] ?>">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>QA NAME</label>
                                    <input type="text" class="form-control" name="qa_name" placeholder="QA Name" required readonly value="<?php echo $_SESSION['full_name']?>">
                                </div>
                            </div>
                        </div>
                        <form action="your_php_script.php" method="post">

<!-- SCORE CARD MULAI DARI SINI -->
                        <div class="container-fluid" style="color: black;font-family: Myriad Pro Light">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="panel panel-default" style="padding: 10px; box-shadow: 2px 2px 5px #8c2222;">
                                        <div class="panel-heading">SCORE CARD EMAIL DETAILS</div>
                                        <div class="panel-body">
                                            <form method="post">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Parameter</th>
                                                                <th>Description</th>
                                                                <th>Basic Weight</th>
                                                                <th>Sub Parameter</th>
                                                                <th>Score</th>
                                                                <th>Description Note</th>
                                                                </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>GREETING</td>
                                                            <td>
                                                                <textarea class="form-control" name="par_desc_gg" rows="3" required readonly placeholder="a. Perform opening greetings b. Provide assistance to customers before closing greetings c. Make closing greetings"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" name="par_weight_greeting" rows="3" required readonly placeholder="5"></textarea>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" name="sub_par_id_gg" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_e1g" oninput="updateScoreAndDisplay('sub_par_name_e1g', this, 'sub_par_score_gg')">
                                                                    <datalist id="sub_par_name_e1g">
                                                                        <?php  
                                                                            $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = 'e1g'");
                                                                            while ($b = mysqli_fetch_array($a)) { ?>
                                                                                <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                                        <?php } ?>
                                                                    </datalist>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <b><input type="text" name="sub_par_score_gg" class="form-control sub-par-score" id="sub_par_score_gg" readonly></b>
                                                                </div>
                                                            </td>
                                                            <td colspan="4">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="note_subtypee1g" rows="3" placeholder="Enter note for the subtype"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>PRODUCT KNOWLEDGE</td>
                                                            <td>
                                                                <textarea class="form-control" name="par_desc_pk " rows="3" required readonly placeholder="Provide information correctly, completely and in accordance with customer questions"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" name="par_weight_pk" rows="3" required readonly placeholder="50"></textarea>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" name="sub_par_id_pk" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_e2p" oninput="updateScoreAndDisplay('sub_par_name_e2p', this, 'sub_par_score_pk')">
                                                                    <datalist id="sub_par_name_e2p">
                                                                        <?php  
                                                                            $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = 'e2p'");
                                                                            while ($b = mysqli_fetch_array($a)) { ?>
                                                                                <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                                        <?php } ?>
                                                                    </datalist>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <b><input type="text" name="sub_par_score_pk" class="form-control sub-par-score" id="sub_par_score_pk" readonly></b>
                                                                </div>
                                                            </td>
                                                            <td colspan="4">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="note_subtypee2p" rows="3" placeholder="Enter note for the subtype"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>SOP</td>
                                                            <td>
                                                                <textarea class="form-control" name="par_desc_sop" rows="3" required readonly placeholder="a. Follow all procedures according to SOP b. Follow response time and chat closing time"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" name="par_weight_sop" rows="3" required readonly placeholder="10"></textarea>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" name="sub_par_id_sop" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_e3s" oninput="updateScoreAndDisplay('sub_par_name_e3s', this, 'sub_par_score_sop')">
                                                                    <datalist id="sub_par_name_e3s">
                                                                        <?php  
                                                                            $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = 'e3s'");
                                                                            while ($b = mysqli_fetch_array($a)) { ?>
                                                                                <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                                        <?php } ?>
                                                                    </datalist>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <b><input type="text" name="sub_par_score_sop" class="form-control sub-par-score" id="sub_par_score_sop" readonly></b>
                                                                </div>
                                                            </td>
                                                            <td colspan="4">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="note_subtypee3s" rows="3" placeholder="Enter note for the subtype"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>COMUNICATION SKILLS</td>
                                                            <td>
                                                                <textarea class="form-control" name="par_desc_cs" rows="3" required readonly placeholder="a. Choose appropriate words and use good and correct Indonesian b. Do not use 'slang' and jargon words c. Say greetings correctly d. Probing e. Pay attention to customer discomfort and provide empathy f. State the customer's name correctly"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" name="par_weight_cs" rows="3" required readonly placeholder="10"></textarea>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" name="sub_par_id_cs" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_e4c" oninput="updateScoreAndDisplay('sub_par_name_e4c', this, 'sub_par_score_cs')">
                                                                    <datalist id="sub_par_name_e4c">
                                                                        <?php  
                                                                            $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = 'e4c'");
                                                                            while ($b = mysqli_fetch_array($a)) { ?>
                                                                                <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                                        <?php } ?>
                                                                    </datalist>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <b><input type="text" name="sub_par_score_cs" class="form-control sub-par-score" id="sub_par_score_cs" readonly></b>
                                                                </div>
                                                            </td>
                                                            <td colspan="4">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="note_subtypee4c" rows="3" placeholder="Enter note for the subtype"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>REPORTING AND DOCUMENTATION</td>
                                                            <td>
                                                                <textarea class="form-control" name="par_desc_rd" rows="3" required readonly placeholder="a. Carry out records correctly and completely b. Create escalation tickets to the relevant team for customer complaints (High risk)"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" name="par_weight_rdcl" rows="3" required readonly placeholder="25"></textarea>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" name="sub_par_id_rd" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_e5r" oninput="updateScoreAndDisplay('sub_par_name_e5r', this, 'sub_par_score_rd')">
                                                                    <datalist id="sub_par_name_e5r">
                                                                        <?php  
                                                                            $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = 'e5r'");
                                                                            while ($b = mysqli_fetch_array($a)) { ?>
                                                                                <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                                        <?php } ?>
                                                                    </datalist>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <b><input type="text" name="sub_par_score_rd" class="form-control sub-par-score" id="sub_par_score_rd" readonly></b>
                                                                </div>
                                                            </td>
                                                            <td colspan="4">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="note_subtypee5r" rows="3" placeholder="Enter note for the subtype"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>COMPLIMENTARY</td>
                                                            <td>
                                                                <textarea class="form-control" name="par_desc_cp" rows="3" required readonly placeholder="a. Get praise from customers for handling the information/problem resolution provided"></textarea>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" name="par_weight_cp" rows="3" required readonly placeholder="15"></textarea>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="text" name="sub_par_id_cp" class="form-control" value="No" required list="sub_par_name_e6c" oninput="updateScoreAndDisplay('sub_par_name_e6c', this, 'sub_par_score_cp')">
                                                                    <datalist id="sub_par_name_e6c">
                                                                        <?php  
                                                                            $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = 'e6c'");
                                                                            while ($b = mysqli_fetch_array($a)) { ?>
                                                                                <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                                        <?php } ?>
                                                                    </datalist>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <b><input type="text" name="sub_par_score_cp" class="form-control sub-par-score" id="sub_par_score_cp" readonly></b>
                                                                </div>
                                                            </td>
                                                            <td colspan="4">
                                                                <div class="form-group">
                                                                    <textarea class="form-control" name="note_subtypee6c" rows="3" placeholder="Enter note for the subtype"></textarea>
                                                                </div>
                                                            </td>
                                                        </tr>
                        <!-- Tambahkan baris untuk total score -->
                                                        <tr>
                                                            <td colspan="4">TOTAL SCORE</td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <b><input type="text" id="total_score" class="form-control" name="total_score" readonly></b>
                                                                </div>
                                                            </td>
                                                            <td colspan="4"></td>
                                                        </tr>
                                                        <script>
                                                            function updateScoreAndDisplay(listId, input, scoreFieldId) {
                                                                const list = document.getElementById(listId);
                                                                const selectedOption = Array.from(list.options).find(option => option.value === input.value);
                                                                if (selectedOption) {
                                                                    const score = selectedOption.getAttribute('data-score');
                                                                    document.getElementById(scoreFieldId).value = score;
                                                                } else {
                                                                    document.getElementById(scoreFieldId).value = ''; // Kosongkan score jika tidak ada option yang dipilih
                                                                }
                                                                updateTotalScore();
                                                            }

                                                            function updateTotalScore() {
                                                                const scores = document.querySelectorAll('.sub-par-score');
                                                                let total = 0;
                                                                let valid = true; // Tambahkan flag validitas

                                                                scores.forEach(scoreField => {
                                                                    const scoreValue = scoreField.value.trim().toUpperCase();
                                                                    if (scoreValue === "KO") {
                                                                        valid = false; // Jika ada skor KO, set valid menjadi false
                                                                    }
                                                                    const score = parseFloat(scoreField.value) || 0;
                                                                    total += score;
                                                                });

                                                                if (!valid) {
                                                                    total = 0; // Jika ada KO, total skor menjadi 0
                                                                }

                                                                document.getElementById('total_score').value = total;
                                                            }
                                                        </script>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </form>
                                        </div>
                                            <div class="form-group">
                                                <?php  
                                                if (@$_GET['id']=="") {?>
                                                    <input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SAVE"  style="background: #9e6bff;">
                                                <?php }else{ ?>
                                                    <input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="SAVE" style="background: #00cc4c;">
                                                <?php } ?>

                                                <a href="?menu=process" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
                                            </div>
                                        <div class="panel-footer">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
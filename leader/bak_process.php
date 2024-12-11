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
        @$par_desc_greeting = $_POST['par_desc_greeting']; 
        @$par_weight_greeting = $_POST['par_weight_greeting']; 
        @$sub_par_id_greeting = $_POST['sub_par_id_greeting']; 
        @$sub_par_score_greeting = $_POST['sub_par_score_greeting']; 
        @$note_subtype1g = $_POST['note_subtype1g']; 

        @$par_desc_verification = $_POST['par_desc_verification']; 
        @$par_weight_verification = $_POST['par_weight_verification']; 
        @$sub_par_id_verification = $_POST['sub_par_id_verification']; 
        @$sub_par_score_verification = $_POST['sub_par_score_verification'];
        @$note_subtype2v = $_POST['note_subtype2v']; 

        @$par_desc_tov = $_POST['par_desc_tov']; 
        @$par_weight_tov = $_POST['par_weight_tov']; 
        @$sub_par_id_tov = $_POST['sub_par_id_tov']; 
        @$sub_par_score_tov = $_POST['sub_par_score_tov'];
        @$note_subtype3t = $_POST['note_subtype3t'];

        @$par_desc_pk = $_POST['par_desc_pk']; 
        @$par_weight_pk = $_POST['par_weight_pk']; 
        @$sub_par_id_pk = $_POST['sub_par_id_pk']; 
        @$sub_par_score_pk = $_POST['sub_par_score_pk'];
        @$note_subtype4p = $_POST['note_subtype4p'];

        @$par_desc_cl = $_POST['par_desc_cl']; 
        @$par_weight_cl = $_POST['par_weight_cl']; 
        @$sub_par_id_cl = $_POST['sub_par_id_cl']; 
        @$sub_par_score_cl = $_POST['sub_par_score_cl'];
        @$note_subtype5c = $_POST['note_subtype5c'];

        @$par_desc_cp = $_POST['par_desc_cp']; 
        @$par_weight_cp = $_POST['par_weight_cp']; 
        @$sub_par_id_cp = $_POST['sub_par_id_cp']; 
        @$sub_par_score_cp = $_POST['sub_par_score_cp'];
        @$note_subtype6c = $_POST['note_subtype6c'];

        @$total_score = $_POST['total_score'];

	// echo $id_penggunaan_next."-".$tahun."-".$bulan;
	@$field_next = array(
		'id_user'=>$id_user,
		'sid'=>$sid,
		// 'bulan'=>$next_bulan,
		// 'tahun'=>$next_tahun,
		// 'meter_awal'=>$meter_akhir,
	);


	@$field = array(
		'full_name'=>$full_name,
		'date_input'=>$date_input,
		'full_name'=>$_SESSION['full_name'],
	);

	// if (isset($_POST['bsimpan'])) {
	// 	if ($sid = 0) {
	// 		$aksi->pesan("Sample ID is not found");
	// 	}else{
	// 		$aksi->simpan("score_tbl");
	// 		$aksi->update($table,$field,"sid = '$sid'");
	// 		$aksi->simpan($table,$field_next);
	// 		$aksi->alert("Data Berhasil Disimpan",$redirect);
	// 	}
	// }

    @$cek = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$id_parameter'");
	if (isset($_POST['bsimpan'])) {
		@$cek = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$id_parameter' AND id_parameter != '$edit[id_parameter]'");
		if 
		($cek > 0) {
			$aksi->pesan("Parameter is Existing");
		}else{
			// $aksi->simpan($table,$data);
			mysqli_query($GLOBALS["___mysqli_ston"],"INSERT INTO parameter_qa_tbl (parameter, par_desc, par_weight, id_sub_par, date_inserted) 
			 value 
			 ('$parameter','$par_desc','$par_weight','$id_sub_par','$date_inserted')"); 
			$aksi->alert("Score Card Successfully Saved",$redirect);
		}
	}


	if (isset($_POST['bubah'])) {
		// echo "<br>".$id_penggunaan_next."-".$bulan."-".$tahun;
		$aksi->update($table,$field_update,"sid = '$sid'");
		$aksi->update("score_tbl","sid = '$sid'");
		$aksi->update($table,$field,$where);
		$aksi->alert("Data Berhasil Diubah",$redirect);
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		// $aksi->update("penggunaan", 
						// array(
						// 	'meter_akhir'=>0,
						// 	'tgl_cek'=>"",
						// 	'id_manager'=>"",),
						// $where);
		$aksi->hapus("score_tbl","sid = '$sid'");
		$aksi->hapus("score_tbl","sid = '$sid'");
		$aksi->alert("Data Berhasil Dihapus",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE sid LIKE '%$text%' OR contract_number LIKE '%$text%' OR type LIKE '%$text%' OR subtype LIKE '%$text%' OR sub_subtype LIKE '%$text%' OR note LIKE '%$text%' OR result LIKE '%$text%' OR agent_name LIKE '%$text%' OR date_input LIKE '%$date%'";
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
                                $no=0;
                                $data = $aksi->tampil("population_tbl",$cari,"ORDER BY date_input DESC");
                                if ($data=="") {
                                    $aksi->no_record(8);
                                } else {
                                    foreach ($data as $r) {
                                        $cek = $aksi->cekdata("population_tbl WHERE sid = '$r[sid]'");
                                        $no++; ?>

                                        <tr>
                                            <td align="center"><?php echo $no; ?>.</td>
                                            <td><?php echo $r['sid'] ?></td>
                                            <td><?php echo $r['contract_number'] ?></td>
                                            <td><?php echo $r['full_name'] ?></td>
                                            <td><?php echo $r['source'] ?></td>
                                            <td><?php echo $r['type'] ?></td>
                                            <td><?php echo $r['subtype'] ?></td>
                                            <td><?php echo $r['sub_subtype'] ?></td>
                                            <td><?php echo $r['note'] ?></td>
                                            <td><?php echo $r['result'] ?></td>
                                            <td><?php echo $r['date_input'] ?></td>
                                            <td><?php echo $r['agent_name'] ?></td>
                                            <td><?php echo $r['agent_nik'] ?></td>
                                            <td><?php echo $r['media'] ?></td>
                                            <?php  
                                                if ($cek == 0) { ?>
                                                    <td colspan="2"></td>
                                                <?php } else { ?>
                                                    <td align="center"><a href="?menu=process&edit&id=<?php echo $r['sid']; ?>" ><span class="glyphicon glyphicon-edit"></span></a></td>
                                                <?php } ?>
                                        </tr>
                                <?php } } ?>
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
                                    <input type="text" name="full_name_qa" class="form-control" placeholder="QA NAME" required readonly value="<?php echo $_SESSION['full_name']?>">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCORE CARD MULAI DARI SINI -->
<div class="container-fluid" style="color: black;font-family: Myriad Pro Light">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" style="padding: 10px; box-shadow: 2px 2px 5px #8c2222;">
                <div class="panel-heading">SCORE CARD DETAILS</div>
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
                                        <textarea class="form-control" name="par_desc_greeting" rows="3" required readonly placeholder="There is an opening greeting, the smiling voice is there, the intonation is clear"></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="par_weight_greeting" rows="3" required readonly placeholder="10"></textarea>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="sub_par_id_greeting" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_1g" oninput="updateScoreAndDisplay('sub_par_name_1g', this, 'sub_par_score_greeting')">
                                            <datalist id="sub_par_name_1g">
                                                <?php  
                                                    $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = '1g'");
                                                    while ($b = mysqli_fetch_array($a)) { ?>
                                                        <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <b><input type="text" name="sub_par_score_greeting" class="form-control sub-par-score" id="sub_par_score_greeting" readonly></b>
                                        </div>
                                    </td>
                                    <td colspan="4">
                                        <div class="form-group">
                                            <textarea class="form-control" name="note_subtype1g" rows="3" placeholder="Enter note for the subtype"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>VERIFICATION</td>
                                    <td>
                                        <textarea class="form-control" name="par_desc_verification" rows="3" required readonly placeholder="Agent does at least 3 verifications before continuing the conversation"></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="par_weight_verification" rows="3" required readonly placeholder="20"></textarea>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="sub_par_id_verification" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_2v" oninput="updateScoreAndDisplay('sub_par_name_2v', this, 'sub_par_score_verification')">
                                            <datalist id="sub_par_name_2v">
                                                <?php  
                                                    $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = '2v'");
                                                    while ($b = mysqli_fetch_array($a)) { ?>
                                                        <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <b><input type="text" name="sub_par_score_verification" class="form-control sub-par-score" id="sub_par_score_verification" readonly></b>
                                        </div>
                                    </td>
                                    <td colspan="4">
                                        <div class="form-group">
                                            <textarea class="form-control" name="note_subtype2v" rows="3" placeholder="Enter note for the subtype"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>TONE OF VOICE</td>
                                    <td>
                                        <textarea class="form-control" name="par_desc_tov" rows="3" required readonly placeholder="Agent speaks friendly, Smiling voice, No rush, clear intonation"></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="par_weight_tov" rows="3" required readonly placeholder="20"></textarea>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="sub_par_id_tov" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_3t" oninput="updateScoreAndDisplay('sub_par_name_3t', this, 'sub_par_score_tov')">
                                            <datalist id="sub_par_name_3t">
                                                <?php  
                                                    $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = '3t'");
                                                    while ($b = mysqli_fetch_array($a)) { ?>
                                                        <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <b><input type="text" name="sub_par_score_tov" class="form-control sub-par-score" id="sub_par_score_tov" readonly></b>
                                        </div>
                                    </td>
                                    <td colspan="4">
                                        <div class="form-group">
                                            <textarea class="form-control" name="note_subtype3t" rows="3" placeholder="Enter note for the subtype"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>PRODUCT KNOWLEDGE</td>
                                    <td>
                                        <textarea class="form-control" name="par_desc_pk" rows="3" required readonly placeholder="The agent conveys product knowledge information in accordance with the SOP"></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="par_weight_pk" rows="3" required readonly placeholder="40"></textarea>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="sub_par_id_pk" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_4p" oninput="updateScoreAndDisplay('sub_par_name_4p', this, 'sub_par_score_pk')">
                                            <datalist id="sub_par_name_4p">
                                                <?php  
                                                    $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = '4p'");
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
                                            <textarea class="form-control" name="note_subtype4p" rows="3" placeholder="Enter note for the subtype"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>CLOSING</td>
                                    <td>
                                        <textarea class="form-control" name="par_desc_cl" rows="3" required readonly placeholder="The agent offers to help back before closing, and closes in a friendly manner with clear intonation"></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="par_weight_cl" rows="3" required readonly placeholder="10"></textarea>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="sub_par_id_cl" class="form-control" placeholder="Select Sub Parameter" required list="sub_par_name_5c" oninput="updateScoreAndDisplay('sub_par_name_5c', this, 'sub_par_score_cl')">
                                            <datalist id="sub_par_name_5c">
                                                <?php  
                                                    $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = '5c'");
                                                    while ($b = mysqli_fetch_array($a)) { ?>
                                                        <option value="<?php echo $b['sub_par_name'] ?>" data-score="<?php echo $b['sub_par_score'] ?>"><?php echo $b['sub_par_name']; ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <b><input type="text" name="sub_par_score_cl" class="form-control sub-par-score" id="sub_par_score_cl" readonly></b>
                                        </div>
                                    </td>
                                    <td colspan="4">
                                        <div class="form-group">
                                            <textarea class="form-control" name="note_subtype5c" rows="3" placeholder="Enter note for the subtype"></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>COMPLIMENTARY</td>
                                    <td>
                                        <textarea class="form-control" name="par_desc_cp" rows="3" required readonly placeholder="Agent gets a good complimentary from customer"></textarea>
                                    </td>
                                    <td>
                                        <textarea class="form-control" name="par_weight_cp" rows="3" required readonly placeholder="15"></textarea>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="sub_par_id_cp" class="form-control" value="" required list="sub_par_name_6c" oninput="updateScoreAndDisplay('sub_par_name_6c', this, 'sub_par_score_cp')">
                                            <datalist id="sub_par_name_6c">
                                                <?php  
                                                    $a = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sub_par_name, sub_par_score FROM sub_parameter_tbl WHERE id_sub_par = '6c'");
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
                                            <textarea class="form-control" name="note_subtype6c" rows="3" placeholder="Enter note for the subtype"></textarea>
                                        </div>
                                    </td>
                                </tr>
<!-- Tambahkan baris untuk total score -->
                                <tr>
                                    <td colspan="4">TOTAL SCORE</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="total_score" class="form-control" readonly>
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
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SAVE"  style="background: #3074d1;">
										  <?php }else{ ?>
											<input type="submit" name="bsimpan" class="btn btn-success btn-lg btn-block" value="SAVE" style="background: #00cc4c;">
										<?php } ?>

										<a href="?menu=process" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
									</div>
                <div class="panel-footer">&nbsp;</div>
            </div>
        </div>
    </div>
</div>

            </div>
        </div>
</body>
</html>
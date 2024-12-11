<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=sub_parameter');
	}
	//dasar
	$table = "sub_parameter_tbl";
	$id = @$_GET['id'];
	$where = " md5(sha1(id_sub_tbl)) = '$id'";
	$redirect = "?menu=sub_parameter";

	// cek username
	@$cek_user = $aksi->cekdata("parameter_qa_tbl WHERE parameter = '$_POST[parameter]'");
	$field = array(
		'id_sub_tbl'=>@$_POST['id_sub_tbl'],
		'sub_par_name'=>@$_POST['sub_par_name'],
		'sub_par_score'=>@$_POST['sub_par_score'],
		'date_inserted'=>"date_inserted",
		'id_sub_par'=>@$_POST['id_sub_par'],
		'ko_status'=>@$_POST['ko_status'],
		'area'=>@$_POST['area'],
	);

	//untuk kebutuhan crud
	@$id_sub_tbl = $_POST['id_sub_tbl'];
    @$sub_par_name = $_POST['sub_par_name'];
    @$sub_par_score= $_POST['sub_par_score'];
    @$date_inserted = $_POST['date_inserted'];
	@$id_sub_par = $_POST['id_sub_par'];
	@$ko_status = $_POST['ko_status'];
	@$area = $_POST['area'];

	//tampung data
	$data = array(
		// 'id_sub_tbl'=>$id_sub_tbl,
        'sub_par_name'=>$sub_par_name,
        'sub_par_score'=>$sub_par_score,
        'date_inserted'=>$date_inserted,
		'id_sub_par'=>$id_sub_par,
		'ko_status'=>$ko_status,
		'area'=>$area,
        
	);

	$cek = $aksi->cekdata("sub_parameter_tbl WHERE id_sub_tbl = '$id_sub_tbl'");
	if (isset($_POST['bsimpan'])) {
		@$cek = $aksi->cekdata("sub_parameter_tbl WHERE id_sub_tbl = '$id_sub_tbl' AND id_sub_tbl != '$edit[id_sub_tbl]'");
		if 
		($cek > 0) {
			$aksi->pesan("Sub Parameter is Existing");
		}else{
			// $aksi->simpan($table,$data);
			mysqli_query($GLOBALS["___mysqli_ston"],"INSERT INTO sub_parameter_tbl (sub_par_name, sub_par_score, date_inserted, id_sub_par, ko_status, area) 
			value 
			('$sub_par_name','$sub_par_score','$date_inserted','$id_sub_par','$ko_status','$area')"); 
			$aksi->alert("Sub Parameters Successfully Saved",$redirect);
		}
	}

	if (isset($_POST['bubah'])) {
		$id_sub_tbl = $_POST['id_sub_tbl'];
		@$cek = $aksi->cekdata("sub_parameter_tbl WHERE id_sub_tbl = '$id_sub_tbl' AND id_sub_tbl != '$edit[id_sub_tbl]'");
		if ($cek > 0) {
			$aksi->pesan("Sub Parameter is Existing");
		}else{
			$aksi->update($table,$data,$where);
			$aksi->alert("Sub Parameters Successfully Changed",$redirect);
		}
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Sub Parameter Successfully Deleted",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_sub_tbl LIKE '%$text%' OR sub_par_name LIKE '%$text%' OR sub_par_score LIKE '%$text%' OR id_sub_par LIKE '%$text%' OR ko_status LIKE '%$text%' OR area LIKE '%$text%'";
	}else{
		$cari="";
	}





?>
<!DOCTYPE html>
<html>
<head>
	<title>PATAMETER</title>
</head>
<style type="text/css">
  .panel-heading{
    background: #cceeff	 !important;
  }
  .panel-body{
	  background: #f7f8f7 !important;
  }
</style>
<body>
	<br>
	<br>
	<div class="table-responsive" style="color: black;font-family: Myriad Pro Light">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					<div class="panel panel-default">
						<?php if(!@$_GET['id_sub_tbl']){ ?>
							<div class="panel-heading">ADD SUB PARAMETER</div>
						<?php }else{ ?>
							<div class="panel-heading">UPDATE SUB PARAMETER</div>
						<?php } ?>
						<div class="panel-body">
							<form method="post">
									<div class="col-md-12">
									<div class="form-group">
										<label>Sub Parameter Name</label>
										<textarea class="form-control" name="sub_par_name" rows="3" required placeholder="Insert Sub Parameter Name"><?php echo @$edit['sub_par_name']; ?></textarea>
									</div> 
									<div class="form-group">
										<label>Sub Parameter Score</label>
										<input type="number" name="sub_par_score" class="form-control" placeholder="Insert Score Sub Parameter" required value="<?php echo @$edit['sub_par_score']; ?>" list="gol">
									</div> 
									<div class="form-group">
										<label>Date Inserted</label>
										<input type="date" name="date_inserted" class="form-control" placeholder="Insert Date" required value="<?php echo @$edit['date_inserted']; ?>" list="gol">
									</div>
									<div class="form-group">
										<label>ID Sub Parameter</label>
										<input type="text" name="id_sub_par" class="form-control" placeholder="Insert ID Sub parameter" required value="<?php echo @$edit['id_sub_par']; ?>" list="gol">
									</div>

									<div class="form-group">
										<label>Knock Out Status</label>
										<select type="text" name="ko_status" class="form-control" placeholder="Insert KO Status" required value="<?php echo @$edit['ko_status']; ?>" list="gol">
											<option value=Null></option>
											<option value="n">n</option>
											<option value="y">y</option>
										</select>
									</div>

									<div class="form-group">
										<label>Area</label>
										<input type="text" name="area" class="form-control" placeholder="Insert Area" required value="<?php echo @$edit['area']; ?>" list="gol">
									</div> 

									<div class="form-group">
										<?php  
										  if (@$_GET['id']=="") {?>
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SAVE"  style="background: #3074d1;">
										  <?php }else{ ?>
											<input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="UPDATE" style="background: #00cc4c;">
										<?php } ?>

										<a href="?menu=sub_parameter" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">SUB PARAMETER LIST</div>
						<div class="panel-body">
							<div class="col-md-12">
								<form method="post">
									<div class="input-group">
										<input type="text" name="tcari" class="form-control" value="<?php echo @$text ?>" placeholder="Enter a search keyword...">
										<div class="input-group-btn">
											<button type="submit" name="bcari" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>&nbsp;</button>
											<button type="submit" name="refresh" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<thead>
										<th class="text-center">ID Number</th>
										<th class="text-center">Sub Parameter Name</th>
										<th class="text-center">Sub Paramater Score</th>
										<th class="text-center">Date Inserted</th>	
										<th class="text-center">ID Sub parameter</th>									
										<th class="text-center">Knock Out Staus</th>
										<th class="text-center">Area</th>
										<th colspan="2"><center>Option</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"ORDER BY id_sub_tbl ASC");
												if ($data=="") {
													$aksi->no_record(11);
												}else{
													foreach ($data as $r) {
														$cek = $aksi->cekdata("sub_parameter_tbl WHERE id_sub_tbl = '$r[id_sub_tbl]'");
													$no++; ?>
													<tr>
														<td class="text-center"><?php echo $r['id_sub_tbl'];?></td>
														<td class="text-center"><?php echo $r['sub_par_name'];?></td>
														<td class="text-center"><?php echo $r['sub_par_score'];?></td>
														<td class="text-center"><?php echo $r['date_inserted'];?></td>													
														<td class="text-center"><?php echo $r['id_sub_par'];?></td>
														<td class="text-center"><?php echo $r['ko_status'];?></td>
														<td class="text-center"><?php echo $r['area'];?></td>
														<td align="center"><a href="?menu=sub_parameter&edit&id=<?php echo md5(sha1($r['id_sub_tbl'])); ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
														<td align="center"><a onclick="return confirm('Are you sure want to delete this data ?')" href="?menu=sub_parameter&hapus&id=<?php echo md5(sha1($r['id_sub_tbl'])); ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
													</tr>
											<?php } } ?>
										 </tbody>
									</table>
								</div>
							</div>
						</div>	
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
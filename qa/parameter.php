<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=parameter');
	}
	//dasar
	$table = "parameter_qa_tbl";
	$id = @$_GET['id'];
	$where = " md5(sha1(id_parameter)) = '$id'";
	$redirect = "?menu=parameter";

	// cek username
	@$cek_user = $aksi->cekdata("parameter_qa_tbl WHERE parameter = '$_POST[parameter]'");
	$field = array(
		'id_parameter'=>@$_POST['id_parameter'],
		'parameter'=>@$_POST['parameter'],
		'par_desc'=>@$_POST['par_desc'],
		'par_weight'=>@$_POST['par_weight'],
		'id_sub_par'=>@$_POST['id_sub_par'],
		'date_inserted'=>@$_POST['date_inserted'],
		'area'=>@$_POST['area'],
	);

	//untuk kebutuhan crud
	@$id_parameter = $_POST['id_parameter'];
    @$parameter = $_POST['parameter'];
    @$par_desc= $_POST['par_desc'];
    @$par_weight = $_POST['par_weight'];
    @$id_sub_par = $_POST['id_sub_par'];
    @$date_inserted = $_POST['date_inserted'];
	@$area = $_POST['area'];

	//tampung data
	$data = array(
		// 'id_parameter'=>$id_parameter,
        'parameter'=>$parameter,
        'par_desc'=>$par_desc,
        'par_weight'=>$par_weight,
        'id_sub_par'=>$id_sub_par,
        'date_inserted'=>$date_inserted,
		'area'=>$area,
	);

	// Periksa apakah parameter sudah ada di tabel
	$cek = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$id_parameter'");

	if (isset($_POST['bsimpan'])) {
		// Cek apakah parameter sudah ada di tabel dengan pengecualian jika sedang mengedit data yang sama
		$cek = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$id_parameter' AND id_parameter != '{$edit['id_parameter']}'");

		if ($cek > 0) {
			$aksi->pesan("Parameter is Existing");
		} else {
			// Simpan data baru dengan tanggal berjalan
			$query = "INSERT INTO parameter_qa_tbl (parameter, par_desc, par_weight, id_sub_par, date_inserted, area) 
					VALUES ('$parameter', '$par_desc', '$par_weight', '$id_sub_par', '$date_inserted', '$area')";
			mysqli_query($GLOBALS["___mysqli_ston"], $query);
			$aksi->alert("Parameters Successfully Saved", $redirect);
		}
	}

	if (isset($_POST['bubah'])) {
		$id_parameter = $_POST['id_parameter'];
		@$cek = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$id_parameter' AND id_parameter != '$edit[id_parameter]'");
		if ($cek > 0) {
			$aksi->pesan("Parameter is Existing");
		} else {
			$aksi->update($table,$data,$where);
			$aksi->alert("Account Successfully Changed",$redirect);
		}
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Parameter Successfully Deleted",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_parameter LIKE '%$text%' OR parameter LIKE '%$text%' OR par_desc LIKE '%$text%' OR par_weight LIKE '%$text%' OR id_sub_par LIKE '%$text%' OR area LIKE '%$text%'";
	}else{
		$cari="";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>PARAMETER</title>
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
						<?php if(!@$_GET['id_parameter']){ ?>
							<div class="panel-heading">ADD PARAMETER</div>
						<?php }else{ ?>
							<div class="panel-heading">UPDATE PARAMETER</div>
						<?php } ?>
						<div class="panel-body">
							<form method="post">
									<div class="col-md-12">
									<!-- <div class="form-group">
										<label>ID PARAMETER</label>                
										<input type="text" name="id_parameter" class="form-control" placeholder="Insert ID parameter Name" autocomplete="on" required onsubmit="this.setCustomValidity('')">
									</div>  -->
									<div class="form-group">
										<label>PARAMETER</label>
										<input type="text" name="parameter" class="form-control" placeholder="Insert Parameter" required value="<?php echo @$edit['parameter']; ?>" list="gol">
									</div> 
									<div class="form-group">
										<label>Parameter Description</label>                
										<textarea class="form-control" name="par_desc" rows="3" required placeholder="Insert Parameter Description"><?php echo @$edit['par_desc']; ?></textarea>
									</div> 

									<div class="form-group">
										<label>Parameter Weight</label>                
										<input type="number" name="par_weight" class="form-control" placeholder="Insert Parameter Weight" required value="<?php echo @$edit['par_weight']; ?>" list="gol">
									</div> 

									<div class="form-group">
										<label>ID Sub Parameter</label>
										<input type="text" name="id_sub_par" class="form-control" placeholder="Insert ID Sub parameter" required value="<?php echo @$edit['id_sub_par']; ?>" list="gol">
									</div> 
									<div class="form-group">
										<label>Date Inserted</label>
										<input type="date" name="date_inserted" class="form-control" placeholder="Insert Date" required value="<?php echo @$edit['date_inserted']; ?>" list="gol">
									</div> 
									<div class="form-group">
										<label>Area</label>                
										<input type="text" name="area" class="form-control" placeholder="Insert Area Code" required value="<?php echo @$edit['area']; ?>" list="gol">
									</div> 
									<div class="form-group">
										<?php  
										  if (@$_GET['id']=="") {?>
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SAVE"  style="background: #9e6bff;">
										  <?php }else{ ?>
											<input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="UPDATE" style="background: #00cc4c;">
										<?php } ?>

										<a href="?menu=parameter" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">PARAMETER LIST</div>
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
										<th class="text-center">ID Parameter</th>
										<th class="text-center">Parameter Name</th>
										<th class="text-center">Parameter Description</th>
										<th class="text-center">Parameter Weight</th>
										<th class="text-center">ID Sub parameter</th>
										<th class="text-center">Date Inserted</th>
										<th class="text-center">Area</th>
										<th colspan="2"><center>Option</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"ORDER BY id_parameter ASC");
												if ($data=="") {
													$aksi->no_record(11);
												}else{
													foreach ($data as $r) {
														$cek = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$r[id_parameter]'");
													$no++; ?>

													<tr>
													<td class="text-center"><?php echo $r['id_parameter'];?></td>
													<td class="text-center"><?php echo $r['parameter'];?></td>
													<td class="text-center"><?php echo $r['par_desc'];?></td>
													<td class="text-center"><?php echo $r['par_weight'];?></td>
													<td class="text-center"><?php echo $r['id_sub_par'];?></td>
													<td class="text-center"><?php echo $r['date_inserted'];?></td>
													<td class="text-center"><?php echo $r['area'];?></td>
													<td align="center"><a href="?menu=parameter&edit&id=<?php echo md5(sha1($r['id_parameter'])); ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
													<td align="center"><a onclick="return confirm('Are you sure want to delete this data ?')" href="?menu=parameter&hapus&id=<?php echo md5(sha1($r['id_parameter'])); ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
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
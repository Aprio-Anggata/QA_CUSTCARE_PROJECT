<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=tarif');
	}
	//dasar
	$table = "parameter_qa_tbl";
	$id = @$_GET['id'];
	$where = " md5(sha1(id_parameter)) = '$id'";
	$redirect = "?menu=tarif";

	//untuk kebutuhan crud
	@$id_parameter = $_POST['id_parameter'];
    @$parameter = $_POST['parameter'];
    @$par_desc= $_POST['par_desc'];
    @$par_weight = $_POST['par_weight'];
    @$id_sub_par = $_POST['id_sub_par'];
    @$status_par = $_POST['status_par'];
    @$date_valid_from = $_POST['date_valid_from'];
    @$date_valid_to = $_POST['date_valid_to'];
    @$date_inserted = $_POST['date_inserted'];
    @$inserted_by = $_POST['inserted_by'];

	//tampung data
	$data = array(
		'id_parameter'=>$id_parameter,
        'parameter'=>$parameter,
        'par_desc'=>$par_desc,
        'par_weight'=>$par_weight,
        'id_sub_par'=>$id_sub_par,
        'status_par'=>$status_par,
        'date_valid_from'=>$date_valid_from,
        'date_valid_to'=>$date_valid_to,
        'date_inserted'=>$date_inserted,
        'inserted_by'=>$inserted_by,
	);

	$cek = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$id_parameter'");
	if (isset($_POST['bsimpan'])) {
		@$cek = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$id_parameter' AND id_parameter != '$edit[id_parameter]'");
		if 
		($cek > 0) {
			$aksi->pesan("Data sudah ada");
		}else{
			// $aksi->simpan($table,$data);
			mysqli_query($GLOBALS["___mysqli_ston"],"INSERT INTO parameter_qa_tbl (parameter, par_desc, par_weight, id_sub_par, status_par, date_valid_from, date_valid_to, date_inserted, inserted_by) 
			value 
			('$parameter','$par_desc','$par_weight','$id_sub_par','$status_par','$date_valid_from','$date_valid_to','$date_inserted','$inserted_by')"); 
			$aksi->alert("Data Berhasil Disimpan",$redirect);
		}
	}
	
	if (isset($_POST['bubah'])) {
		@$cek = $aksi->cekdata("parameter_qa_tbl WHERE id_parameter = '$id_parameter' AND id_parameter = '$edit[id_parameter]'");
		if ($cek > 0) {
			$aksi->pesan("Data sudah ada");
		}else{
			// mysqli_query($GLOBALS["___mysqli_ston"],"UPDATE parameter_qa_tbl set parameter='$parameter', par_desc='$par_desc', par_weight='$par_weight', id_sub_par='$id_sub_par', status_par='$status_par', date_valid_from='$date_valid_from', date_valid_to='$date_valid_to',date_inserted='$date_inserted', inserted_by='$inserted_by' WHERE id_parameter = '$id_parameter' AND id_parameter = '$edit[id_parameter]'");
			$aksi->update($table,$data,$where);
			$aksi->alert("Data Berhasil Diubah",$redirect);
		}
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Data Berhasil Dihapus",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_parameter LIKE '%$text%' OR id_parameter LIKE '%$text%' OR daya LIKE '%$text%' OR golongan LIKE '%$text%' OR id_parameter LIKE '%$text%'";
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
						<?php if(!@$_GET['id']){ ?>
							<div class="panel-heading">MASUKKAN PARAMETER</div>
						<?php }else{ ?>
							<div class="panel-heading">UBAH PARAMETER</div>
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
										<input type="text" name="parameter" class="form-control" placeholder="Insert parameter Name" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 
									<div class="form-group">
										<label>Parameter Description</label>                
										<input type="text" name="par_desc" class="form-control" placeholder="Insert Description of parameter" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>Parameter Weight</label>                
										<input type="number" name="par_weight" class="form-control" placeholder="Insert parameter Weight" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>ID Sub Parameter</label>                
										<input type="text" name="id_sub_par" class="form-control" placeholder="Insert ID Sub parameter" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 
									<div class="form-group">
										<label>Status</label>
										<select type="text" name="status_par" class="form-control" autocomplete="off" required onsubmit="this.setCustomValidity('')">
											<option value=Null></option>
											<option value="a">a</option>
											<option value="n">n</option>
										</select>
									</div>
									<div class="form-group">
										<label>Date Valid From</label>                
										<input type="date" name="date_valid_from" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>Date Valid To</label>                
										<input type="date" name="date_valid_to" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>Date Inserted</label>                
										<input type="date" name="date_inserted" class="form-control" placeholder="Insert Date" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 

									<div class="form-group">
										<label>Insert By</label>                
										<input type="text" name="inserted_by" class="form-control" placeholder="Insert By" autocomplete="off" required onsubmit="this.setCustomValidity('')">
									</div> 
									<div class="form-group">
										<?php  
										  if (@$_GET['id']=="") {?>
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SIMPAN"  style="background: #9e6bff;">
										  <?php }else{ ?>
											<input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="UBAH" style="background: #00cc4c;">
										<?php } ?>

										<a href="?menu=tarif" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">DAFTAR PARAMETER</div>
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
										<th class="text-center">Status</th>
										<th class="text-center">Date Valid From</th>
										<th class="text-center">Date Valid To</th>
										<th class="text-center">Date Inserted</th>
										<th class="text-center">Inserted By</th>
										<th colspan="2"><center>Option</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"");
												if ($data=="") {
													$aksi->no_record(7);
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
													<td class="text-center"><?php echo $r['status_par'];?></td>
													<td class="text-center"><?php echo $r['date_valid_from'];?></td>
													<td class="text-center"><?php echo $r['date_valid_to'];?></td>
													<td class="text-center"><?php echo $r['date_inserted'];?></td>
													<td class="text-center"><?php echo $r['inserted_by'];?></td>
														<?php  
															if($cek > 0){?>
																<td>&nbsp;</td>
															<?php }else{ ?>
																<td align="center"><a href="?menu=tarif&edit&id=<?php echo md5(sha1($r['id_parameter'])); ?>" ><span class="glyphicon glyphicon-edit"></span></a></td>
															<?php }?>
														<td align="center"><a href="?menu=tarif&hapus&id=<?php echo md5(sha1($r['id_parameter'])); ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
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
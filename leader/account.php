<?php  
	if (!isset($_GET['menu'])) {
	 	header('location:hal_utama.php?menu=account');
	}
	//dasar
	$table = "user_tbl";
	$id = @$_GET['id'];
	$where = " md5(sha1(id_user)) = '$id'";
	$redirect = "?menu=account";

	// cek username
	@$cek_user = $aksi->cekdata("user_tbl WHERE id_user = '$_POST[id_user]'");
	$field = array(
		'id_user'=>@$_POST['id_user'],
		'user'=>@$_POST['user'],
		'password'=>@$_POST['password'],
		'full_name'=>@$_POST['full_name'],
		'nik'=>@$_POST['nik'],
		'role'=>@$_POST['role'],
		'email'=>@$_POST['email'],
		'superior_name'=>@$_POST['superior_name'],
		'nik_superior'=>@$_POST['nik_superior'],
	);

	//untuk kebutuhan crud
	@$id_user = $_POST['id_user'];
    @$user = $_POST['user'];
    @$password= $_POST['password'];
    @$full_name = $_POST['full_name'];
    @$nik = $_POST['nik'];
    @$role = $_POST['role'];
	@$email = $_POST['email'];
	@$superior_name = $_POST['superior_name'];
	@$nik_superior = $_POST['nik_superior'];

	//tampung data
	$data = array(
		// 'id_user'=>$id_user,
        'user'=>$user,
        'password'=>$password,
        'full_name'=>$full_name,
        'nik'=>$nik,
        'role'=>$role,
		'email'=>$email,
		'superior_name'=>$superior_name,
		'nik_superior'=>$nik_superior,
	);

	$cek = $aksi->cekdata("user_tbl WHERE id_user = '$id_user'");
	if (isset($_POST['bsimpan'])) {
		@$cek = $aksi->cekdata("user_tbl WHERE id_user = '$id_user' AND id_user != '$edit[id_user]'");
		if 
		($cek > 0) {
			$aksi->pesan("Account is Existing");
		}else{
			// $aksi->simpan($table,$data);
			mysqli_query($GLOBALS["___mysqli_ston"],"INSERT INTO user_tbl (user, password, full_name, nik, role, email, superior_name, nik_superior) 
			 value 
			 ('$user','$password','$full_name','$nik','$role','$email','$superior_name','$nik_superior')"); 
			$aksi->alert("Account Successfully Saved",$redirect);
		}
	}
	
	if (isset($_POST['bubah'])) {
		$id_user = $_POST['id_user'];
		@$cek = $aksi->cekdata("user_tbl WHERE id_user = '$id_user' AND id_user != '$edit[id_user]'");
		if ($cek > 0) {
			$aksi->pesan("Account is Existing");
		}else{
			$aksi->update($table,$data,$where);
			$aksi->alert("Account Successfully Changed",$redirect);
		}
	}

	if (isset($_GET['edit'])) {
		$edit = $aksi->edit($table,$where);
	}

	if (isset($_GET['hapus'])) {
		$aksi->hapus($table,$where);
		$aksi->alert("Account Successfully Deleted",$redirect);
	}

	if (isset($_POST['bcari'])) {
		$text = $_POST['tcari'];
		$cari = "WHERE id_user LIKE '%$text%' OR user LIKE '%$text%' OR full_name LIKE '%$text%' OR nik LIKE '%$text%' OR role LIKE '%$text%' OR email LIKE '%$text%'";
	}else{
		$cari="";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Account</title>
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
						<?php if(!@$_GET['id_user']){ ?>
							<div class="panel-heading">ADD PARAMETER</div>
						<?php }else{ ?>
							<div class="panel-heading">UPDATE PARAMETER</div>
						<?php } ?>
						<div class="panel-body">
							<form method="post">
								<div class="col-md-12">
									<div class="form-group">
										<label>User</label>
										<input type="text" name="user" class="form-control" placeholder="Insert User" required value="<?php echo @$edit['user']; ?>" list="gol">
									</div> 
									<div class="form-group">
										<label>Password</label>                
										<input type="text" name="password" class="form-control" placeholder="Insert password" required value="<?php echo @$edit['password']; ?>" list="gol">
									</div> 

									<div class="form-group">
										<label>Full Name</label>                
										<input type="text" name="full_name" class="form-control" placeholder="Insert Full Name" required value="<?php echo @$edit['full_name']; ?>" list="gol">
									</div> 

									<div class="form-group">
										<label>NIIK</label>
										<input type="number" name="nik" class="form-control" placeholder="Insert NIK" required value="<?php echo @$edit['nik']; ?>" list="gol">
									</div> 
									<div class="form-group">
										<label>Role User</label>
										<input type="text" name="role" class="form-control" placeholder="Insert Role Account" required value="<?php echo @$edit['role']; ?>" list="gol">
									</div> 
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" class="form-control" placeholder="Insert Email" required value="<?php echo @$edit['email']; ?>" list="gol">
									</div>
									<div class="form-group">
										<label>Superio Name</label>
										<input type="text" name="superior_name" class="form-control" placeholder="Insert Direct Superior Name" required value="<?php echo @$edit['superior_name']; ?>" list="gol">
									</div>
									<div class="form-group">
										<label>NIK Superior</label>
										<input type="text" name="nik_superior" class="form-control" placeholder="Insert NIK Superior" required value="<?php echo @$edit['nik_superior']; ?>" list="gol">
									</div>
									<div class="form-group">
										<?php  
										if (@$_GET['id']=="") {?>
											<input type="submit" name="bsimpan" class="btn btn-primary btn-lg btn-block" value="SAVE"  style="background: #9e6bff;">
										<?php }else{ ?>
											<input type="submit" name="bubah" class="btn btn-success btn-lg btn-block" value="UPDATE" style="background: #00cc4c;">
										<?php } ?>

										<a href="?menu=account" class="btn btn-danger btn-lg btn-block" style="background: #ff693b;">RESET</a>
									</div>
								</div>
							</form>
						</div>
						<div class="panel-footer">&nbsp;</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="panel panel-default">
						<div class="panel-heading">ACCOUNT POOL</div>
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
										<th class="text-center">ID User</th>
										<th class="text-center">User</th>
										<th class="text-center">Password</th>
										<th class="text-center">Full Name</th>
										<th class="text-center">NIK</th>
										<th class="text-center">Role</th>
										<th class="text-center">Email</th>
										<th class="text-center">Superior Name</th>
										<th class="text-center">NIK Superior</th>
										<th colspan="2"><center>Option</center></th>
										</thead>
										<tbody>
											<?php  
												$no=0;
												$data = $aksi->tampil($table,$cari,"ORDER BY id_user ASC");
												if ($data=="") {
													$aksi->no_record(11);
												}else{
													foreach ($data as $r) {
														$cek = $aksi->cekdata("user_tbl WHERE id_user = '$r[id_user]'");
													$no++; ?>

													<tr>
													<td class="text-center"><?php echo $r['id_user'];?></td>
													<td class="text-center"><?php echo $r['user'];?></td>
													<td class="text-center"><?php echo $r['password'];?></td>
													<td class="text-center"><?php echo $r['full_name'];?></td>
													<td class="text-center"><?php echo $r['nik'];?></td>
													<td class="text-center"><?php echo $r['role'];?></td>
													<td class="text-center"><?php echo $r['email'];?></td>
													<td class="text-center"><?php echo $r['superior_name'];?></td>
													<td class="text-center"><?php echo $r['nik_superior'];?></td>
													<td align="center"><a href="?menu=account&edit&id=<?php echo md5(sha1($r['id_user'])); ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
													<td align="center"><a onclick="return confirm('Are you sure want to delete this User data ?')" href="?menu=account&hapus&id=<?php echo md5(sha1($r['id_user'])); ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
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
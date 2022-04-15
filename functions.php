<?php 

$conn = mysqli_connect("localhost", "root", "", "global");

function registrasi($data) {
	global $conn;

	
	$username = stripcslashes($data["username"]) ;
	$email = $data['email'];
	$password = $data["password"];

 
 $password = password_hash($password, PASSWORD_DEFAULT);


 mysqli_query($conn, "INSERT INTO user VALUES('','$username','$email','$password','0','0','user')");

  return mysqli_affected_rows($conn);
}


function delete($id){

	global $conn;
	mysqli_query($conn,"DELETE FROM user WHERE id = '$id' ");
	return mysqli_affected_rows($conn);
}

function update_user($data){
	global $conn;
	
	$id = $data['id'];
	$username = stripcslashes($data["username"]) ;
	$email = $data['email'];
	$password = $data["password"];
	$balance_avail = $data["balance_avail"];
	$balance_panding = $data["balance_panding"];
	$level = $data["level"];


	$query = "UPDATE user SET 
		id='$id',
		username='$username',
		email='$email',
		password='$password',
		balance_avail='$balance_avail',
		balance_panding='$balance_panding',
		level='$level'
		WHERE id = $id ";

	  mysqli_query($conn, $query);

	  return mysqli_affected_rows($conn);
}

function add_user($data) {
	global $conn;

	
	$username = stripcslashes($data["username"]) ;
	$email = $data['email'];
	$password = $data["password"];
	$balance_avail = $data["balance_avail"];
	$balance_panding = $data["balance_panding"];
	$level = $data["level"];

 
 $password = password_hash($password, PASSWORD_DEFAULT);

 mysqli_query($conn, "INSERT INTO user VALUES('','$username','$email','$password','balance_avail','balance_panding','level')");

  return mysqli_affected_rows($conn);
}

function update_admin($data){
	global $conn;
	
	$id = $data['id'];
	$username = stripcslashes($data["username"]) ;
	$email = $data['email'];
	$password = $data["password"];
	$password = password_hash($password, PASSWORD_DEFAULT);
	$balance_avail = $data["balance_avail"];
	$balance_panding = $data["balance_panding"];
	$level = $data["level"];


	$query = "UPDATE user SET 
		id='$id',
		username='$username',
		email='$email',
		password='$password',
		balance_avail='$balance_avail',
		balance_panding='$balance_panding',
		level='$level'
		WHERE id = $id ";

	  mysqli_query($conn, $query);

	  return mysqli_affected_rows($conn);
}

function add_game($data){
		global $conn;

		$id_platforms = $data['id_platforms'];
		$name_game = $data['name_game'];

		 mysqli_query($conn, "INSERT INTO game VALUES('','$id_platforms','$name_game')");

  return mysqli_affected_rows($conn);
}

function update_game($data){
	global $conn;

	
	
	$id_game = $data['id_game'];
	$id_platforms = $data["id_platforms"];
	$name_game = $data["name_game"];

		
		$query = "UPDATE game SET 
		id_game='$id_game',
		id_platforms='$id_platforms',
		name_game='$name_game'
		WHERE id_game = $id_game ";

	  mysqli_query($conn, $query);

	  return mysqli_affected_rows($conn);


	
}


function delete_game($id_game){

	global $conn;
	mysqli_query($conn,"DELETE FROM game WHERE id_game = '$id_game' ");
	return mysqli_affected_rows($conn);
}

function add_product($data){

	global $conn;

	$id_user = ($data['id_user']);
	$title = htmlspecialchars($data['title']);
	$price = htmlspecialchars($data['price']);
	$id_platforms = htmlspecialchars($data['id_platforms']);
	$id_game = htmlspecialchars($data['id_game']);
	$amount = htmlspecialchars($data['amount']);
	$description = htmlspecialchars($data['description']);


	$img1 = upload();
	if( !$img1) {
		return false;
	}

	$img2 = upload2();
	if( !$img1) {
		return false;
	}
	
	$img3 = upload3();
	if( !$img1) {
		return false;
	}

	$img4 = upload4();
	if( !$img1) {
		return false;
	}
	$img5 = upload5();
	if( !$img1) {
		return false;
	}

	mysqli_query($conn, "INSERT INTO product VALUES('','$id_user','$title','$price','$id_platforms','$id_game','$amount','$description','$img1','$img2','$img3','$img4','$img5')");

  return mysqli_affected_rows($conn);


}

function update_product($data){

	global $conn;
	$id_product = $data['id_product'];
	$id_user = ($data['id_user']);
	$title = htmlspecialchars($data['title']);
	$price = htmlspecialchars($data['price']);
	$id_platforms = htmlspecialchars($data['id_platforms']);
	$id_game = htmlspecialchars($data['id_game']);

	$description = htmlspecialchars($data['description']);


	$img1 = upload();
	if( !$img1) {
		return false;
	}

	$img2 = upload2();
	if( !$img1) {
		return false;
	}
	
	$img3 = upload3();
	if( !$img1) {
		return false;
	}

	$img4 = upload4();
	if( !$img1) {
		return false;
	}
	$img5 = upload5();
	if( !$img1) {
		return false;
	}

	   $queryy = "UPDATE product SET 
		title= title
		WHERE id_product = $id_product ";

		  mysqli_query($conn, $queryy);

	  		  return mysqli_affected_rows($conn);



}

function upload(){

	$nameFile = $_FILES['img1']['name'];
	$sizeFile = $_FILES['img1']['size'];
	$error = $_FILES['img1']['error'];
	$tmpName = $_FILES['img1']['tmp_name'];


	$extensionvalid = ['jpg','jpeg','png'];
	$extensionimage = explode('.', $nameFile);
	$extensionimage = strtolower(end($extensionimage));

	if (!in_array($extensionimage, $extensionvalid)) {

		echo "<script>
			alert('Input all images. If you only have a few images. then input the same image at the column OR only accept jpg , jpeg , png format image')
			</script>
		";
		return false;
	}

	if( $sizeFile > 2000000) {
		echo "<script>
			alert('your image is oversize (max 2Mb')
			</script>
		";
		return false;
	}

	$namefilenew = uniqid();
	$namefilenew .= '.';
	$namefilenew .= $extensionimage;

	move_uploaded_file($tmpName, 'img_product/' . $namefilenew);

	return $namefilenew;

}
function upload2(){

	$nameFile = $_FILES['img2']['name'];
	$sizeFile = $_FILES['img2']['size'];
	$error = $_FILES['img2']['error'];
	$tmpName = $_FILES['img2']['tmp_name'];


	$extensionvalid = ['jpg','jpeg','png'];
	$extensionimage = explode('.', $nameFile);
	$extensionimage = strtolower(end($extensionimage));

	if (!in_array($extensionimage, $extensionvalid)) {

		echo "<script>
			alert('Input all images. If you only have a few images. then input the same image at the column OR only accept jpg , jpeg , png format image')
			</script>
		";
		return false;
	}

	if( $sizeFile > 2000000) {
		echo "<script>
			alert('your image is oversize (max 2Mb')
			</script>
		";
		return false;
	}

	$namefilenew = uniqid();
	$namefilenew .= '.';
	$namefilenew .= $extensionimage;

	if (move_uploaded_file($tmpName, 'img_product/' . $namefilenew) == true ){

		return $namefilenew;

	} else {
		echo "<script>
			alert('GAGAL UPLOD (max 2Mb')
			</script>
		";
		return false;

	}

}

function upload3(){

	$nameFile = $_FILES['img3']['name'];
	$sizeFile = $_FILES['img3']['size'];
	$error = $_FILES['img3']['error'];
	$tmpName = $_FILES['img3']['tmp_name'];


	$extensionvalid = ['jpg','jpeg','png'];
	$extensionimage = explode('.', $nameFile);
	$extensionimage = strtolower(end($extensionimage));

	if (!in_array($extensionimage, $extensionvalid)) {

		echo "<script>
			alert('Input all images. If you only have a few images. then input the same image at the column OR only accept jpg , jpeg , png format image')
			</script>
		";
		return false;
	}

	if( $sizeFile > 2000000) {
		echo "<script>
			alert('your image is oversize (max 2Mb')
			</script>
		";
		return false;
	}

	$namefilenew = uniqid();
	$namefilenew .= '.';
	$namefilenew .= $extensionimage;

	move_uploaded_file($tmpName, 'img_product/' . $namefilenew);

	return $namefilenew;

}

function upload4(){

	$nameFile = $_FILES['img4']['name'];
	$sizeFile = $_FILES['img4']['size'];
	$error = $_FILES['img4']['error'];
	$tmpName = $_FILES['img4']['tmp_name'];


	$extensionvalid = ['jpg','jpeg','png'];
	$extensionimage = explode('.', $nameFile);
	$extensionimage = strtolower(end($extensionimage));

	if (!in_array($extensionimage, $extensionvalid)) {

		echo "<script>
			alert('Input all images. If you only have a few images. then input the same image at the column OR only accept jpg , jpeg , png format image')
			</script>
		";
		return false;
	}

	if( $sizeFile > 2000000) {
		echo "<script>
			alert('your image is oversize (max 2Mb')
			</script>
		";
		return false;
	}

	$namefilenew = uniqid();
	$namefilenew .= '.';
	$namefilenew .= $extensionimage;

	move_uploaded_file($tmpName, 'img_product/' . $namefilenew);

	return $namefilenew;

}

function upload5(){

	$nameFile = $_FILES['img5']['name'];
	$sizeFile = $_FILES['img5']['size'];
	$error = $_FILES['img5']['error'];
	$tmpName = $_FILES['img5']['tmp_name'];


	$extensionvalid = ['jpg','jpeg','png'];
	$extensionimage = explode('.', $nameFile);
	$extensionimage = strtolower(end($extensionimage));

	if (!in_array($extensionimage, $extensionvalid)) {

		echo "<script>
			alert('Input all images. If you only have a few images. then input the same image at the column OR only accept jpg , jpeg , png format image')
			</script>
		";
		return false;
	}

	if( $sizeFile > 2000000) {
		echo "<script>
			alert('your image is oversize (max 2Mb')
			</script>
		";
		return false;
	}

	$namefilenew = uniqid();
	$namefilenew .= '.';
	$namefilenew .= $extensionimage;

	move_uploaded_file($tmpName, 'img_product/' . $namefilenew);

	return $namefilenew;

}

function checkout($data){
		global $conn;
	$id_product = $data['id_product'];
	$id_user = $data['id_user'];
	$balance = $data['balance'];
	$balance_seller = $data['balance_seller'];
    $id_seller = $data['id_seller'];
	$n = 8 ;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  	$invoice = $randomString ; 

	mysqli_query($conn, "INSERT INTO `orderproduct`(`id_order`, `id_product`, `id_user`, `status`, `invoice`, `date`) VALUES ('','$id_product','$id_user','process','$invoice',NOW())");

		$query = "UPDATE product SET 
		amount='0'
		WHERE id_product = $id_product ";

	  mysqli_query($conn, $query);

	 $queryy = "UPDATE user SET 
		balance_avail='$balance'
		WHERE id = $id_user ";



	  mysqli_query($conn, $queryy);

	   $queryyy = "UPDATE user SET 
		balance_panding='$balance_seller'
		WHERE id = $id_seller ";



	  mysqli_query($conn, $queryyy);


	  


  return mysqli_affected_rows($conn);


}


function validation_account($data){
	global	$conn ;

	$id_order = $data['id_order'];
	$id_seller = $data['id_user'];
	$username = $data['username'];
	$email = $data['email'];
	$password = $data['password'];
	$password = $data['detail'];

 mysqli_query($conn, "INSERT INTO result VALUES('','$id_order','$id_seller','$username','$email','$password','$detail')");

  

   $queryy = "UPDATE orderproduct SET 
		status = 'validation'
		WHERE id_order = $id_order ";



	  mysqli_query($conn, $queryy);

	  	return mysqli_affected_rows($conn);
}

function update_validation($data){

	global $conn ;

	$id_order = $data['id_order'];

	   $queryy = "UPDATE orderproduct SET 
		status='process'
		WHERE id_order = $id_order ";

		  mysqli_query($conn, $queryy);

	  		  return mysqli_affected_rows($conn);


}

function updateorder($data){
	global $conn ;
	$id_order = $data['id_order'];
	$id_seller = $data['id_seller'];
	$balance_avail = $data['balance_avail'];
	$balance_panding = $data['balance_panding'];



	   $queryy = "UPDATE orderproduct SET 
		status='completed'
		WHERE id_order = $id_order ";



		  mysqli_query($conn, $queryy);

		    $queryyseller = "UPDATE user SET 
		balance_avail='$balance_avail',
		balance_panding='0'
		WHERE id = $id_seller ";

		

		  mysqli_query($conn, $queryyseller);

	  		  return mysqli_affected_rows($conn);
}


function update_account_func($data){
	global $conn;
	
	$id = $data['id'];
	$username = stripcslashes($data["username"]) ;
	$email = $data['email'];
	$password = $data["password"];
	$password = password_hash($password, PASSWORD_DEFAULT);
	


	$query = "UPDATE user SET 
		id='$id',
		username='$username',
		email='$email',
		password='$password'
		WHERE id = $id ";

	  mysqli_query($conn, $query);

	  return mysqli_affected_rows($conn);

}

function wd_balance($data){
		global $conn;
	
	$id = $data['id'];
	$amount = $data["amount"] ;

	$balance_avail = $data["balance_avail"];

	$balance = $balance_avail - $amount;
	
	


	$query = "UPDATE user SET 
		balance_avail = '$balance'
		WHERE id = $id ";

	  mysqli_query($conn, $query);

	  return mysqli_affected_rows($conn);
}


function wdbank_func($data){
		global $conn;
		$id = $data['id'];
		$balance_avail = $data['balance_avail'];
		$balance_hasil = 0 ;

		 $queryy = "UPDATE user SET 
		balance_avail='balance_hasil'
		WHERE id = $id ";

		 mysqli_query($conn, $queryy);

	  return mysqli_affected_rows($conn);
 
}





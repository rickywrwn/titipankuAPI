<?php
	include("connection.php");
	if(isset($_POST["action"]))
	{
		$action =  $_POST["action"];
		if($action == "sendPicture")
		{
			$upload_path = 'uploads/'; //Upload Folder
			$server_ip = "faure.online"; //Getting Server IP
			$upload_url = 'http://'.$server_ip.'/mysql_finalproject/'.$upload_path; //Upload URL
			
			$response = "";
			
			if(isset($_POST["idTrans"]))
			{
				$idTrans = $_POST["idTrans"];
				$fileinfo = pathinfo($_FILES['image']['name']); // getting file info from the request
				$extension = $fileinfo['extension']; //getting the file extensiion
				$file_url = $upload_url.$idTrans.'.'.$extension; //file url to store in the database
				$file_path = $upload_path.$idTrans.'.'.$extension; //file path to upload in the server
				$image_name = $idTrans.'.'.$extension; //file name to store in the database
				
				try{
					move_uploaded_file($_FILES['image']['tmp_name'],$file_path); // saving the file to the upload folder;
					
					$sql = "SELECT * FROM table_bukti WHERE id_trans = '$idTrans'";
					$result = mysqli_query($conn,$sql);
					if(mysqli_num_rows($result) > 0)
					{
						//Berarti Ada Isi do nothing
						$sql = "UPDATE table_bukti SET photo_url = '$file_url' WHERE id_trans = '$idTrans'";
						if(mysqli_query($conn,$sql))
						{
							$response = "Berhasil";
						}
					}
					else
					{
						//Kosong lakukan Insert
						//adding the path and name to database
						$sql = "INSERT INTO table_bukti(id_trans,photo_url) VALUES ('$idTrans','$file_url')";
						if(mysqli_query($conn,$sql))
						{
							$response = "Berhasil";
						}
					}										
				}
				catch(Exception $e){
					$response = $e->getMassage();
				}						
				mysqli_close($conn);				
			}
		}
		else if($action == "getPicture")
		{
			if(isset($_POST["idTrans"]))
			{
				$idTrans = $_POST["idTrans"];
				$sql = "SELECT * FROM table_bukti WHERE id_trans='$idTrans'";
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) > 0)
				{
					//Berarti Ada Isi
					while($row = mysqli_fetch_array($result))
					{
						$temp = $row["id_trans"].",".$row["photo_url"];
					}
					echo $temp;				
				}
				else
				{
					echo "Data Empty";
				}
			}			
		}
		else if($action == "deletePicture")
		{
			if(isset($_POST["idTrans"]))
			{
				$idTrans = $_POST["idTrans"];
				$sql = "DELETE FROM table_bukti WHERE id_trans='$idTrans'";
				$result = mysqli_query($conn,$sql);
				if($result)
				{
					echo "Delete Sukses";
					$file = "uploads/".$idTrans.".jpg";
					try{
						if(unlink($file))
							echo "Delete Sukses";
					}catch(Exception $e){
						echo $e->getMassage();
					}
				}
				else
				{
					echo "Delete Gagal";
				}				
			}
			else
			{
				echo "Parameter Tidak Sesuai";
			}
		}
	}
	else
	{
		//Bukan Coba Login
		echo "Parameter Tidak Sesuai";
	}
?>
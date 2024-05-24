
<form method="post" action =" " enctype="multipart/form-data">
<input type="file" name="image" >
<input type ="submit" name="submit" value="Upload File"> 

</form>
<?php 
if(isset($_POST['submit'])){

   print_r($_FILES['image']);
 /$file=$_FILES['image'];
    // echo"<pre>";

    // print_r($file);

    // echo"</pre>";
    $file_name=$file['name'];
    $file_type=$file['type'];
    $file_tmp=$file['tmp_name'];
    $file_error=$file['error'];
    $file_size=$file['size'];
    $ext=array('jpg','png','jpeg','svg');
    $file_n_a=explode('.',$file_name);
    $file_ext=strtolower(end($file_n_a));
        if(in_array($file_ext,$ext)){

            if(move_uploaded_file($file_tmp,$file_name)){

                echo"upload file";
            }else 
                echo" not upload file";
            
        }else echo "not valid ";    

}




?>



    <?php
    include 'db.php';
    if(isset($_POST["Import"])){
     
     
    echo $filename=$_FILES["file"]["tmp_name"];
     $target="upload/";
     $fulltarget=$target.$filename;
	if(move_uploaded_file($_FILES['file']['tmp_name'],$fulltarget))
	{
    echo "Success<br>";
    echo "file id: $filename";
	}
	else
	{
    echo "Failed";
	}
     
     
    if($_FILES["file"]["size"] > 0)
    {
     
    $file = fopen($filename, "r");
    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
     
    //It will insert a row to our subject table from our csv file`
    $sql = "INSERT into ameex_user_detail (`name`,`password`,`first_name`, `last_name`,`mail`,phone)
    values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]')";
    //we are using mysql_query function. it returns a resource on true else False on error
    $result = mysql_query( $sql, $conn );
    if(! $result )
    {
    echo "<script type=\"text/javascript\">
    alert(\"Invalid File:Please Upload CSV File.\");
    window.location = \"design.php\"
    </script>";
     
    }
     
    }
    fclose($file);
    //throws a message if data successfully imported to mysql database from excel file
    echo "<script type=\"text/javascript\">
    alert(\"CSV File has been successfully Imported.\");
    window.location = \"design.php\"
    </script>";
     
     
     
    //close of connection
    mysql_close($conn);
     
     
     
    }
    }	
    ?>	

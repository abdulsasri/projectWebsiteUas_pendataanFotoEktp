<?php 
$con = mysqli_connect("localhost","root","","data_foto_ektp");

if(!$con){
	echo "
        <script>  
             alert('Koneksi Database Error');
        </script>
          ";
}

 ?>
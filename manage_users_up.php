<?php
  //Connect to database
  require'connectDB.php';

    $sql = "SELECT fingerprint_id, nombre, matricula, fingerprint_select FROM users WHERE del_fingerid=0 ORDER BY id DESC";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo '<p class="error">SQL Error</p>';
    }
    else{
      mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
      if (mysqli_num_rows($resultl) > 0){
          while ($row = mysqli_fetch_assoc($resultl)){
            $fingerid = $row['fingerprint_id'];
  ?>        
  
            <TR id="<?php echo $fingerid;?>" class="user_id">
              	<TD>
                  <span>
                  <?php 
                		if ($row['fingerprint_select'] == 1) {
                			echo "<i class='fa fa-check' style='color: green; margin-right:8px'></i>";
                		}
                    
                    echo $fingerid;
                	?>
                  </span>
                </TD>
                <TD><?php echo $row['matricula'];?></TD>
              <TD><?php echo $row['nombre'];?></TD>
            </TR>
<?php
        }   
    }
  }
?>
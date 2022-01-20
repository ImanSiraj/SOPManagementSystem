<?php
 $connection =mysqli_connect('localhost','root','');
 if (!$connection) {
   die("Database connection failed: " .mysqli_error($connection));
 }
 
 $db_select = mysqli_select_db($connection,'db_sfms');
 if (!$db_select) 
 {
   die("Database selection failed: " .mysqli_error($db_select));
 }

        $sql = "SELECT * FROM storage";
        $result = mysqli_query($connection,$sql);
        ?>
        <center>
            <table border="2" style="width:1000px;" id="tbl_data">

                <thead>
                    <tr> <h2>Uploaded Image Details </h2>  </tr>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>File</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                            if(mysqli_num_rows($result)== 0 )
                            {
                                    echo "<script>alert('No rows returned');</script>";
                            }
                            else
                            {
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr align=center>";
                                    echo "<td>{$row['store_id']}</td>";
                                    echo "<td>{$row['filename']}</td>";
                                    echo '<td><img style="height:200px;width:300px;" src="data:image/jpg;base64,' . base64_encode( $row['filename'] ) . '" /></td>';
                                    echo"<td>{$row['date_uploaded']}</td>";
                                    echo"</tr>";
                                }
                                mysqli_close($connection);

                            }
                    ?>
                </tbody>
            </table>
        </center>
        <?php
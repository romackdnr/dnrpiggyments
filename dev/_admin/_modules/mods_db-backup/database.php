<?
include   "../../../classes/Database.php";
include   "../../../classes/Connection.php";
include   "../../../classes/AdminAction.php";
include_once "../../../includes/bootstrap.php";
?>
<?
                backup_tables('dnradmin.db.3506263.hostedresource.com','dnradmin','DSAre96FGdd','dnradmin');
                
                
                /* backup the db OR just a table */
                function backup_tables($host,$user,$pass,$name,$tables = '*')
                {
                  
                  $link = mysql_connect($host,$user,$pass);
                  mysql_select_db($name,$link);
                  
                  //get all of the tables
					 if($tables == '*')
					  {
						$tables = array();
						$result = mysql_query('SHOW TABLES');
						while($row = mysql_fetch_row($result))
						{
						  $tables[] = $row[0];
						}
					  }
					  else
					  {
						$tables = is_array($tables) ? $tables : explode(',',$tables);
					  }
                  
                  //cycle through
					   foreach($tables as $table)
					  {
						$result = mysql_query('SELECT * FROM '.$table);
						$num_fields = mysql_num_fields($result);
						
						$return.= 'DROP TABLE '.$table.';';
						$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
						$return.= "\n\n".$row2[1].";\n\n";
						
						for ($i = 0; $i < $num_fields; $i++) 
						{
						  while($row = mysql_fetch_row($result))
						  {
							$return.= 'INSERT INTO '.$table.' VALUES(';
							for($j=0; $j<$num_fields; $j++) 
							{
							  $row[$j] = addslashes($row[$j]);
							  $row[$j] = ereg_replace("\n","\\n",$row[$j]);
							  if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							  if ($j<($num_fields-1)) { $return.= ','; }
							}
							$return.= ");\n";
						  }
						}
						$return.="\n\n\n";
					  }
                  
					  //save file
					  $url = 'dbBackUp/db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';
					  $handle = fopen($url,'w+');
					  
					  fwrite($handle,$return);
					  fclose($handle);  
					  
                ?>     
            <div style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#F00; font-weight:bold; margin:10px 10px">Database successfully Back-up.</div>
            
			<a href="http://www.dogandrooster.net/_em/dnradmin/_admin/_modules/mods_db-backup/<?=$url?>" style="margin:10px 10px;" target="_blank">Download Backup Database</a>     
<? } ?>              

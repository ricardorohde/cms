<?php
    class DBConnection
    {
        function getConnection()
        {
            
            mysql_connect('localhost', 'root', '') or
            die("Could not connect: " . mysql_error());
			
            mysql_select_db('pent_pentaurea') or
            die("Could not select database: " . mysql_error());
			
            mysql_query("SET NAMES 'utf8'");
            mysql_query('SET character_set_connection=utf8');
            mysql_query('SET character_set_client=utf8');
            mysql_query('SET character_set_results=utf8');
        }
    }
?>

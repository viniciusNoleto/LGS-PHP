<?php

    // $sector: The sector where something are being report
    // $author: Who's action are being report
    // $header: Main text for log
    // $body [optional]: Log information list | default: empty array
    // $dir [optional]: Directory where the log will be save. Can be replaced by 'debug' to report bugs | default: 'log'
    function write_log(String $sector, String $author, String $header, Array $body=[], String $dir="log"){

        // Create Log by date and sector
        $log = fopen("$dir/$sector - ".date("d-m-Y").'.log','a');

        // Get actual time
        $time = new DateTime();
        $time->setTimezone(new DateTimeZone('America/Manaus'));
        $time = $time->format("H:i");

        // Write Log
        fwrite($log, "\n$time || $author: $header\n"); // Write header
        if(count($body) > 0) foreach($body as $line) fwrite($log, "> $line\n"); // Write Body List

        // Close .log file
        fclose($log);

    } // Return void 


    // $sector: The sector where you want the read some .log file
    // $date: The day you want to read the .log file
    // $dir [optional]: Directory where you want to find the .log file
    function read_log(String $sector, String $date, String $dir = "log"){

        // Teste if the .log file exists
        if(file_exists("$dir/$sector - $date.log")){

            // Open .log file
            $log = fopen("$dir/$sector - $date.log",'r');
            
            // Create an array with all lines of .log file
            $lines = explode("\n",fread($log, filesize("$dir/$sector - $date.log")));
            
            // Close .log file
            fclose($log);

            // Return lines array
            return $lines;

        }else return []; // Return empty array 

    } // Return Array



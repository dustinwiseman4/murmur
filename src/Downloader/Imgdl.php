<?php

namespace Downloader;

class Imgdl
{
    public function download(): void
    {
        //open csv for read
		$file = fopen("images.csv","r");

		//begin iterating through list
		while (($data = fgetcsv($file)) !== FALSE)
		{
			//variables for current url and directory
			$url = $data[0];	
			$dir = 'images/';
			
			//check for and create directory if needed
			if (!is_dir($dir)) {	
				mkdir($dir);
			}
			
			//initialize connection and setup filename per iteration then save image
			$ch = curl_init($url);
			$filename = basename($url) . '.png';
			$save_loc = $dir . $filename;
			$fp = fopen($save_loc, 'wb');
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);
		}
    }
}

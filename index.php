<?php
	//Cron job to add new news RSS feeds every 5 minutes.
	//To install put the following line in after typing 
	//		
	//		/usr/bin/php /your_server_path/plugins/nags_reporter/index.php "your message here"


	if(!isset($nags_reporter_config)) {
        //Get global plugin config - but only once
		$data = file_get_contents (dirname(__FILE__) . "/config/config.json");
        if($data) {
            $nags_reporter_config = json_decode($data, true);
            if(!isset($nags_reporter_config)) {
                echo "Error: nags_reporter config/config.json is not valid JSON.";
                exit(0);
            }
     
        } else {
            echo "Error: Missing config/config.json in nags_reporter plugin.";
            exit(0);
     
        }
  
  
    }



 	$start_path = $nags_reporter_config['serverPath'];

	echo $start_path;
	$staging = true;		//REMOVE ME ON LIVE
	include_once($start_path . 'config/db_connect.php');	
	
	$define_classes_path = $start_path;     //This flag ensures we have access to the typical classes, before the cls.pluginapi.php is included
	require($start_path . "classes/cls.pluginapi.php");
	
	$api = new cls_plugin_api();
	
	
	if($argc >= 1) {
		$message = strval($argv[1]);
	} else {
		$message = "";
	}
	


	echo $message;
			  
			  
			  
			  
			  

						

	 $shouted = $message;		//guid may not be url for some feeds, may need to have link
	 $your_name = $nags_reporter_config['name'];
	 $whisper_to = "";		//to the whole forum
	 $email = $nags_reporter_config['email'];
	 $ip = "92.27.10.17"; //must be something anything
	 $forum_name = $nags_reporter_config['forum'];


 	 //Get the forum id
     $forum_info = $api->get_forum_id($forum_name);
	
	 //Send the message
	 $api->new_message($your_name, $shouted, $whisper_to, $email, $ip, $forum_info['forum_id'], false);
												
				
					
			
			  

	session_destroy();  //remove session
	
	
	
	
?>
<?php

  $user = $_POST['username'];
	$pass = $_POST['password'];

    //FUNCTION TO GET ALL PROMOTERS FROM TICKETMOB
    $params = array( 'key' => 'es_neYLZ0LWBUeb3ZB',
					'venue' => 'Vanguard',
                );
                
    $client = new SoapClient('http://thecloud.ticketmob.com/ElectroStubAPI/getPromoters.cfc?wsdl');
    $result = $client->__soapCall('listPromoters',$params);
    $obj = simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
    $promoters = get_object_vars($obj);
    $promoters = $promoters['promoter'];
    
    //print_r($promoters);
    for($i=0;$i<count($promoters);$i++){
	    $promoter=get_object_vars($promoters[$i]);
	    $id = $promoter['@attributes']['id'];
	    $firstname = $promoter['firstName'];
	    $lastname = $promoter['lastName'];
	    $email = $promoter['email'];
	    $password = $promoter['password'];
	    $affiliateKey = $promoter['affiliateKey'];
	    $affiliateCode = $promoter['affiliateCode'];
	    $address = $promoter['address'];
	    $city = $promoter['city'];
	    $state = $promoter['state'];
	    $zipcode = $promoter['zipcode'];
	    $country = $promoter['country'];
	    
	    $keys[$i][0] = $email;
	    $keys[$i][1] = $password;	    			    
	    $keys[$i][2] = $id;	    			    
	    $keys[$i][4] = $affiliateKey;	    			    
	    $keys[$i][5] = $firstname;
	    $keys[$i][6] = $lastname;	    
    }     
    
    //END FUNCTION 
    
    //FUNCTION TO FILL AN ARRAY WITH PRMOTER'S INFO
    $status = false;
    
    for($i=0;$i<count($keys);$i++){
	    if($user==$keys[$i][0] and $pass==$keys[$i][1]){
		    $status=true;
		    $pid = $keys[$i][2];
		    $pemail = $keys[$i][0];
		    $pkey = $keys[$i][4];
		    $pfname = $keys[$i][5];
		    $plname = $keys[$i][6];		    
		    break;
	    }
    }
    
    if($status==true){
	    session_start();
	    $time = time();
	    $_SESSION['lanewssid'] = "$pid-$time";
	    $_SESSION['lanewsid'] = "$pid";
	    $_SESSION['lanewsemail'] = $pemail;
	    $_SESSION['lanewsfname'] = $pfname;
	    $_SESSION['lanewslname'] = $plname; 
	    $_SESSION['lanewsaffiliateKey'] = $pkey;
	    $_SESSION['lanewstest'] = "false";
	    
	    header("Location: lanewsletter.php");
	    exit();
    }else{	
	    header("Location: ../lanightclub.html?e=1");
	    exit();
    }

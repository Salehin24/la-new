<?php

class Smsgateway {

    public function send($config = []) {
//        dd($config);
        switch (strtolower($config['apiProvider'])) {

            case 'nexmo':
                return $this->nexmo($config);
                break;
            case 'clickatell':
                return $this->send_clickatell_message($config);
                break;

            default:
                return json_encode(['exception' => 'No api found']);
                break;
        }
    }

    #--------------------------------------
    # For nexmo provider

    public function nexmo($config = []) {
        $url = "https://rest.nexmo.com/sms/json?api_key=" . urlencode($config['username']) . "&api_secret=" . urlencode($config['password']) . "&to=" . urlencode($config['to']) . "&from=" . urlencode($config['from']) . "&text=" . urlencode($config['message']) . "";
        $data = file_get_contents($url);
        return $data;
    }

    #--------------------------------------------       

    public function send_clickatell_message($config = []) {
        $url = "HTTP/S://platform.clickatell.com/messages/http/send?apiKey=" . urlencode($config['username']) . "==&to=" . urlencode($config['to']) . "&content=" . urlencode($config['message']) . "&from=" . urlencode($config['from']) . "";
        $result = $this->_do_api_call($url);
        return $result;
    }

    private function _do_api_call($url) {
        $result = file($url);
        return $result;
    }

    #---------------------------------------

    private $operator = array('11', '12', '13', '14', '15', '16', '17', '18', '19');

    public function validMobile($mobile = null) {
        $mobile = trim($mobile);
        if ($this->checkValidMobileOperator($mobile) != false) {
            $countryCode = substr($mobile, 0, 2);
            if (in_array($countryCode, $this->operator)) {
                $newMobileNo = substr_replace($mobile, "880", 0, 0);
            } elseif ($countryCode == "01") {
                $newMobileNo = substr_replace($mobile, "88", 0, 0);
            } elseif ($countryCode == "80") {
                $newMobileNo = substr_replace($mobile, "8", 0, 0);
            } elseif ($countryCode == "+8") {
                $newMobileNo = substr_replace($mobile, "", 0, 1);
            } else {
                $newMobileNo = $mobile;
            }
            return $newMobileNo;
        }
    }

    protected function checkValidMobileOperator($mobile = null) {
        if (10 <= strlen($mobile) && strlen($mobile) <= 15) {

            if (strlen($mobile) == 10) { /* for 10 digits */
                return in_array(substr($mobile, 0, 2), $this->operator);
            } elseif (strlen($mobile) == 11) { /* for 11 digits */
                return in_array(substr($mobile, 1, 2), $this->operator);
            } elseif (strlen($mobile) == 12) { /* for 12 digits */
                return in_array(substr($mobile, 2, 2), $this->operator);
            } elseif (strlen($mobile) == 13) { /* for 13 digits */
                return in_array(substr($mobile, 3, 2), $this->operator);
            } elseif (strlen($mobile) == 14) { /* for 14 digits */
                return in_array(substr($mobile, 4, 2), $this->operator);
            } elseif (strlen($mobile) == 15) { /* for 15 digits */
                return in_array(substr($mobile, 5, 2), $this->operator);
            }
        } else {
            return false;
        }
    }

    public function template($config = null) {
        $newStr = $config['message'];
        foreach ($config as $key => $value) {
            $newStr = str_replace("%$key%", $value, $newStr);
        }
        return $newStr;
    }

    public function certificatetemplate($config = null) {
        // echo '<pre>'; print_r($config);die();
        $newStr = $config['message'];
        foreach ($config as $key => $value) {
            $newStr = str_replace("[$key]", $value, $newStr);
        }
        return $newStr;
    }
    public function emailtemplate($config = null) {
        // echo '<pre>'; print_r($config);die();
        $newStr = $config['templatebody'];
        foreach ($config as $key => $value) {
            $newStr = str_replace("[$key]", $value, $newStr);
        }
        return $newStr;
    }

    public function send_bdtasksmsgatway($data = array()){
        $get_userinfo = get_userinfo($data['log_id']);
        $message = $data['message'];
        $phone = $get_userinfo->mobile;

        $message2=strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', $message)));
            if(!empty($message) && !empty($phone)){

                    $urltopost = "https://sms.bdtask.com/smsapi";
                $datatopost = array (
                        "api_key"	=> "C200841060d07abfcf6b00.15108031",
                        "type" 		=> 'unicode',
                        "senderid" 	=> "8809612436202",
                        "msg" 		=> trim($message),
                        "contacts" 	=> $phone
                );
                // d($datatopost);
                $ch = curl_init ($urltopost);
                curl_setopt ($ch, CURLOPT_POST, true);
                curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
    
                if($result === false)
                {
                    echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
                    return;
                }
                print_r($result);
                curl_close($ch);
                return $result;
    
            }
    
        }

        // ============ its for ALPHA SMS Gateway ============
        public function send_alphasms($data = null){
            $apikey = 'pNBvPzTC8002Ai2Wc1CyWAt8svm0vcqvAmUBRLvO';
            $get_userinfo = get_userinfo($data['log_id']);
            // dd($get_userinfo);
            $message = $data['message'];
            $phone = $get_userinfo->mobile;
            // https://api.sms.net.bd/sendsms?api_key={YOUR_API_KEY}&msg={YOUR_MSG}&to=8801800000000,8801700000000&schedule=2021-10-13 16:00:52

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sms.net.bd/sendsms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                    'api_key' => $apikey,
                    'msg' => trim($message),
                    'to' => $phone,
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // d($response);
        }

        // ============== its for elitbuzz sms gateway ==================
        public function send_elitbuzzsms($data = null){
        // $senderid = '8809612472604';
        $senderid = 'LEADACADEMY';
        $apikey = 'C200813661af359ecfaa53.01117491';
        
        if($data['type'] == 4 || $data['type'] == 5){
            $get_userinfo = get_userinfo($data['log_id']);
            $phone = $get_userinfo->mobile;
            // d($get_userinfo);
        }elseif($data['type'] == 6){
            $phone = $data['log_id'];
        }
        $message = $data['message'];
        // d($data['type']);
        // d($phone);d('e');
        // dd($message);
        // $sendelitbuzz = 'https://msg.elitbuzz-bd.com/smsapi?api_key='.$apikey.'&type=text&contacts='.$phone.'&senderid='.$senderid.'&msg='.$message.'';
        
        $message2=strtoupper(bin2hex(iconv('UTF-8', 'UCS-2BE', $message)));
            if(!empty($message) && !empty($phone)){

                $urltopost = "https://msg.elitbuzz-bd.com/smsapi";
                $datatopost = array (
                        "api_key"	=> $apikey,
                        "type" 		=> 'unicode',
                        "senderid" 	=> $senderid,
                        "msg" 		=> trim($message),
                        "contacts" 	=> $phone
                );
                // d($datatopost);
                $ch = curl_init ($urltopost);
                curl_setopt ($ch, CURLOPT_POST, true);
                curl_setopt ($ch, CURLOPT_POSTFIELDS, $datatopost);
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
    
                if($result === false)
                {
                    echo sprintf('<span>%s</span>CURL error:', curl_error($ch));
                    return;
                }
                // print_r($result);
                curl_close($ch);
                return $result;
    
            }
        }

}
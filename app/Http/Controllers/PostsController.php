<?php

namespace App\Http\Controllers;
use be\kunstmaan\multichain\MultichainClient;//this is the multichain/php library used, added a few tweaks and stuff
use be\kunstmaan\multichain\MultichainHelper;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Input;

use \Response;
use Carbon\Carbon;

class PostsController extends Controller
{

	public function publishfile(){
		return view('posts.publish');
	}

    public function check(){
        return view('posts.checkfile');
    }
    public function store(Request $request){
$this->validate($request,['email' => 'required','fullname'=> 'required', 'phone' =>'required', 'message' =>'required' ,'file.*' =>'required|file|mimes:pdf,docx,doc']);


//$file=$request->file('filep');
$signature=md5_file($request->file('filep')->path());
$client=new MultichainClient('http://192.168.125.1:2760','multichainrpc','913Zk6d1axxFiD8e65zZR8QNTcYpwR2t79YTFHitYdYy',3);
$clname=$request->input('fullname');
$mail=$request->input('email');
$phone=$request->input('phone');
$message=$request->input('message');
$pubdate=Carbon::now()->toDateTimeString();
$userip=$request->ip();
$dataarray= array("signature"=>$signature,"clname"=>$clname,"mail"=>$mail,"publishdate"=>$pubdate,"userip"=>$userip,"phone"=>$phone,"message"=>$message);
$dataJSON = json_encode($dataarray);
$dataBase64=base64_encode($dataJSON);
$dataHex=bin2hex($dataBase64);
$dataToReturn=array();
//get the transaction ID 
$tx_id=$client->setDebug(true)->executeApi('publish',array("POE",$signature,$dataHex));
$block_info = $client->setDebug(true)->executeApi('getwallettransaction', array($tx_id));
    $confirmations = $block_info['confirmations'];
    if($confirmations == 0){
        $blockhash = "NA";
        $blocktime = "NA";
    }
    else{
        $blockhash = $block_info['blockhash'];
        $blocktime = $block_info['blocktime'];
    }
    $dataToReturn['userip'] = $userip;
    $dataToReturn['signature'] = $signature;
    $dataToReturn['transaction_id'] = $tx_id;
    $dataToReturn['confirmations'] = $confirmations;
    $dataToReturn['blockhash'] = $blockhash;
    $dataToReturn['blocktime'] = $blocktime;
    $dataToReturn['name'] = $clname;
    $dataToReturn['email'] = $mail;
    $dataToReturn['message'] = $message;
    $dataToReturn['phone']=$phone;
    $dataToReturn['timestamp'] = date('g:i A \o\n l jS F Y \(\T\i\m\e\z\o\n\e \U\T\C\)', time());;
    
//$redata=json_encode($dataToReturn);
return view('posts.confirmation')->with('dataToReturn',$dataToReturn)->with('successmsg','Transaction accepted! Your transaction ID is');
}

 public function search(){
    return view('posts.checkfile');
 }
public function file_check(Request $req){
    $this->validate($req,['file.*'=>'required|file|mimes:pdf,docx,doc']);
  $signature=md5_file($req->file('filep')->path());
    $client = new MultichainClient("http://192.168.125.1:2760", 'multichainrpc', '913Zk6d1axxFiD8e65zZR8QNTcYpwR2t79YTFHitYdYy', 3);
 
    $data = $client->setDebug(true)->executeApi('liststreamkeyitems', array("POE", $signature));
    if(empty($data)){ return view('posts.publish')->with('nofile','File does not existed in blockchain. Upload it here.');
}else{
     $data = array_reverse($data);
    
    $dataToReturn = array();
    foreach($data as $key => $value){
        $d = array();
        $d['signature'] = $signature;
        $d['transaction_id'] = $value['txid'];
        $d['confirmations'] = $value['confirmations'];
        $d['blocktime'] = date('g:i A \o\n l jS F Y \(\T\i\m\e\z\o\n\e \U\T\C\)', $value['blocktime']);
        $meta_data = json_decode(base64_decode(hex2bin($value['data'])));
    
        $d['name'] = $meta_data->clname;
        $d['email'] = $meta_data->mail;
        $d['message'] = $meta_data->message;
         $d['phone'] = $meta_data->phone;
          $d['userip'] = $meta_data->userip;
           $d['blockhash'] = null;
        $d['recorded_timestamp_UTC'] = $value['blocktime'];
        $d['timestamp'] = date('g:i A \o\n l jS F Y \(\T\i\m\e\z\o\n\e \U\T\C\)', $value['blocktime']);
       // $dataToReturn[$key] = $d;
    }
   return view('posts.confirmation')->with('dataToReturn',$d)->with('successmsg','Transaction Found! The transaction ID is'); 
}


}

public function generated(){
$client=new MultichainClient('http://192.168.125.1:2760','multichainrpc','913Zk6d1axxFiD8e65zZR8QNTcYpwR2t79YTFHitYdYy',3);
$data = $client->setDebug(true)->executeApi('liststreamitems', array("POE",false,10,-10));
$count=10;
 $data = array_reverse($data);
    $dataReturn = array();
    for($i=0;$i<$count;$i++)
    {
        $d = array();
        $d['tx_id'] = $data[$i]['txid'];
        $d['blocktime'] = date("Y-m-d H:i:s", $data[$i]['blocktime'])." UTC";
        $d['confirmations'] = $data[$i]['confirmations'];
        $dataReturn[$i] = $d;
    }
    



	return view('posts.generatedpoe',compact('dataReturn'));
}
}

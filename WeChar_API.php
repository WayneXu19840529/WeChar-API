<?php
/* 
at 2015 08 30
Writed by xuyingwei
for Notification service send notification message by wechar api
*/

require_once("WeChar_config.php");

$TmpFIle = "Cache_tmp/AccessGToken.tmp";
$TimeStamp = time();
$ExpriesTime = 7200;
$WeCharURL = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=";

class WeCharApi
{

	//申请公众号，获得的企业的ID
	var $CropID;
	//申请公众号，获得的企业secret信息
	var $Secret;
	//申请公众号: 应用的ID号
	var $AppID;
	//公众号部门接收人的ID，全部人使用 @all，如果接收人为多人，可以使用 | 为分隔符
	var $UserID;
	//公众号的部门id，定义了范围，组内成员都可接收到消息
	var $PartyID;
	//公众号的推送信息
	var $Msg;
	//Post URL
	var $PURL;

	function GetWeCharOutPut()
	{
		//进行Curl请求，获得api的json输出内容；
		$GURL = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=".$this->CropID."&corpsecret=".$this->Secret;
		$GJsonOutput = system('/usr/bin/curl -s -G "'.$GURL.'"');
		$GtokenArray = json_decode($GJsonOutput,true);
		return $GtokenArray;
	}

	function GetWeCharGtoken()
	{
		$GArray = $this->GetWeCharOutPut();
		$Gtoken = $GArray['access_token'];
		return $Gtoken;
	}

	function GetWeCharGExpires()
	{
		$GArray = $this->GetWeCharOutPut();
		$Gexpires = $GArray['expires_in'];
		return $Gexpires;
	}

	function PushMessge()
	{
		$Message = '{ "touser": "'.$this->UserID.'", "toparty": "'.$this->PartyID.'", "totag": " ", "msgtype": "text", "agentid": "'.$this->AppID.'", "text":{ "content": "'.$this->Msg.'"}, "safe":"0" }';
		$CurlCommand = "/usr/bin/curl -s --data-ascii '".$Message."' ".$this->PURL;
		system($CurlCommand);
	}
}

function UpdateTmpFIle($TmpFIle,$contents)
{
	// 更新临时文件的内容，格式为 时间戳:$Token值
	file_put_contents($TmpFIle,$contents);
}

?>
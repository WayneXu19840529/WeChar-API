<?php

include_once("WeChar_API.php");
include_once("Wechar_config.php");

# 实例类
$WC = new WeCharApi();
$WC->CropID = $CropID;
$WC->Secret = $Secret;
$WC->AppID = $AppID;
$WC->UserID = $UserID;
$WC->PartyID = $PartyID;
$Gtoken = $WC->GetWeCharGtoken();	
$TmpContent = $TimeStamp.":".$Gtoken;
$WC->PURL = $WeCharURL.$Gtoken;

# 确定更新token
if( is_readable($TmpFIle) == False ){

	UpdateTmpFIle($TmpFIle,$TmpContent);

}else{

	$OldContents = file_get_contents($TmpFIle);

	$OldContentsArray = explode(':', $OldContents);

	$OldTimeStamp = $OldContentsArray[0];

	$KeepTime = $TimeStamp - $OldTimeStamp;

	if( $KeepTime > 7200 )
	{
		UpdateTmpFIle($TmpFIle,$TmpContent);	
	}

}

# 推送内容信息
$WC->Msg = "<BJ_ZW:NAG>huoyun_01::10.10.4.183::Disk::WARNING::DISK WARNING - free space: / 112407 MB (10% inode=95%): /boot 80 MB (86% inode=99%): /dev/shm 16071 MB (100% inode=99%)";
$WC->PushMessge();

?>
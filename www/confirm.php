<?php
/***********************************************
-=Ms Site=-

������: Utils
�����: ������������ ������ <ms@ensk.ru>
��������: ��� �������������
***********************************************/

	require_once('cgi-bin/utils/confirm.class');
    $confirm = new Confirm;

	require_once('cgi-bin/utils/cipher.class');
    $cipher = new Cipher;

	if ( isset($_GET['code']) )
	{
		$code = $cipher->CipherDecode($_GET['code']);

	}
	else $code = '';

	$confirm->ConfirmGenerateImage($code);
?>
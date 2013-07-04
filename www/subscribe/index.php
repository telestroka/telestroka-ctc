<?php
/***********************************************
-=Ms Site=-

������: Subscribe
�����: ������������ ������ <ms@ensk.ru>
��������: ������ ��������
***********************************************/

	//����������� �������� ������
	require_once('../cgi-bin/site.class');
    $site = new Site;
	$site->PAGE = 'subscribe';

	require_once('../cgi-bin/subscribe.class');
    $subscribe = new Subscribe;

	require_once('../cgi-bin/smi.class');
    $smi = new Smi;

	require_once('../cgi-bin/vars/alert.class');
    $alert = new Alert;

	require_once('../cgi-bin/utils/validate.class');
    $validate = new Validate;

	require_once('../cgi-bin/utils/mail.class');
    $mail = new Mail;

	$parent_page = $site->GetParentPage();

	//�������� �� ���������
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		if (
			!isset($_POST['mode']) ||
			!isset($_POST['email'])
		   ) $site->SiteGoTo($parent_page);
	}

	//���������
	$alert_email = $subscribe_email = $subscribe_name = '';
	$result = FALSE;
	$subscribe_mode = 'subscribe';

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$subscribe_email = $_POST['email'];
		$subscribe_name = $_POST['name'];
		$subscribe_mode = $_POST['mode'];

		//email
		if ( !$validate->IsEmail($subscribe_email) ) { $alert_email = $alert->ALERT['email']; $alert->NOVALID = TRUE; }

		//validation
		if ($alert->NOVALID == FALSE)
		{
			if ( $subscribe_mode == 'subscribe' )
			{
				$result = $subscribe->FileAdd($site->PATH_DATA . '/subscribe.dat', $subscribe_email);
				if ($result)
				{
					$message = '����� ' . $subscribe_email . ' (' . $subscribe_name . ') �������� �� �������� ����� ' . $site->NAME_SITE;
					$subject = 'Raportal subscribe';
					$mail->MailMailer($site->EMAIL_OWNER, $subject, $message);
				}
				$result = ($result) ? '�����' . $subscribe_email . ' ������ � ���� ��������. ' : '�����' . $subscribe_email . ' ��� ��� ������ � ���� ������.';
			}
			if ( $subscribe_mode == 'unsubscribe' )
			{
				$result = $subscribe->FileDel($site->PATH_DATA . '/subscribe.dat', $subscribe_email);
				$result=($result)?'����� ' . $subscribe_email . ' �������� �� ���� ��������. ':'����� ' . $subscribe_email . ' �� ������ � ���� ��������.';
			}
			if ( $subscribe_mode == 'check' )
			{
				$status = ' �� ��������';
				$result = $subscribe->FileIsItemExist($site->PATH_DATA . '/subscribe.dat', $subscribe_email);
				if ($result)$status = ' ��������';
				$message = '����� ' . $subscribe_email.$status . ' �� �������� ����� ' . $site->NAME_SITE;
				$subject = '��������� �������� �� �������� ����� ' . $site->NAME_SITE;
				$mail->MailMailer($subscribe_email, $subject, $message);
				$result = '��������� �������� ������� �� ��������� �����';
			}
		}
	}

	require_once($site->PATH_TEMPLATES . '/main.tpl');
?>
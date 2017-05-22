<?php
$pageToken = 'EAADDB1F44uIBAHIoiItjRtaaaZCao1Nzz5f2E8Fhlg3KZCxbg0N1uoqhH192uItgiaP2qr2YMlev4YTJcDpTg49m6qCIEpatS8q9dV5xV43Y43P1SXkWZB00Tp7AEMe6vIPlmmcCrdmyBw5dvshtv9QZBE7ZBAe69n9ZBwG8gsDwZDZD';

if (isset($_GET) && !empty($_GET))
{
	// App verification
	$verifyToken = 'my_token_is_awesome';
	if ($_GET['hub_mode'] === 'subscribe' && $_GET['hub_verify_token'] === $verifyToken)
	{
		echo $_GET['hub_challenge'];
	}
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$body = json_decode(file_get_contents('php://input'), true);

	if ($body['object'] === 'page')
	{
		foreach ($body['entry'] as $entry)
		{
			foreach ($entry['messaging'] as $messaging)
			{
				$sender = $messaging['sender']['id'];
				$recipient = $messaging['recipient']['id'];
				$message = $messaging['message']['text'] . " ($sender|$recipient)";



				$url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $pageToken;

				if ($messaging['message']['text'] === 'login')
				{
					$payload = [
						'recipient' => ['id' => $sender],
						'message' => [
							'attachment' => [
								'type' => 'template',
								'payload' => [
									'template_type' => 'button',
									'text' => 'login button',
									'buttons' => [
										'type' => 'account_linking',
										'url' => 'http://www.example.com/login'
									]
								]
							]
						],
					];
				}
				else
				{

					$payload = [
						'recipient' => ['id' => $sender],
						'message' => [
							'text' => $message
						],
					];
				}
				$options = array(
				    'http' => array(
				        'header'  => "Content-type: application/json\r\n",
				        'method'  => 'POST',
				        'content' => json_encode( $payload )
				    )
				);
				$context  = stream_context_create($options);
				$result = file_get_contents($url, false, $context);

				error_log($result);
			}
		}
	}
}
<?php

// App verification
$verifyToken = 'my_token_is_awesome';
if ($_GET['hub_mode'] === 'subscribe' && $_GET['hub_verify_token'] === $verifyToken)
{
	echo $_GET['hub_challenge'];
}


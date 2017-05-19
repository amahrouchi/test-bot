<?php
echo $_GET['hub_mode'];
echo $_GET['hub_verify_token'];
echo $_GET['hub_challenge'];

if ($_GET['hub']['mode'] === 'subscribe' && $_GET['hub']['verify_token'] === 'my_token_is_awesome')
{
	echo $_GET['hub']['challenge'];
}


<?php
echo $_GET['hub_mode'];

if ($_GET['hub']['mode'] === 'subscribe' && $_GET['hub']['verify_token'] === 'my_token_is_awesome')
{
	echo $_GET['hub']['challenge'];
}


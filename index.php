<?php
var_dump($_GET['hub.mode']);

if ($_GET['hub']['mode'] === 'subscribe' && $_GET['hub']['verify_token'] === 'my_token_is_awesome')
{
	echo $_GET['hub']['challenge'];
}


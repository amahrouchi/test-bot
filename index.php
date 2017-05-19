<?php

if ($_GET['mode'] === 'subscribe' && $_GET['verify_token'] === 'my_token_is_awesome')
{
	echo $_GET['challenge'];
}


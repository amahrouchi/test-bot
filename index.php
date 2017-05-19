<?php
error_log(print_r($_GET['hub'], true), 3, './log');

if ($_GET['hub']['mode'] === 'subscribe' && $_GET['hub']['verify_token'] === 'my_token_is_awesome')
{
	echo $_GET['hub']['challenge'];
}


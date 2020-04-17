<?php
require("$_SERVER[DOCUMENT_ROOT]/bhaggoes/cms");
date_default_timezone_set('Europe/Amsterdam');
session_name(SESSIE_NAME);
ini_set('session.gc_probability', 1);
ini_set('session.gc_divisor', 1);
ini_set('session.gc_maxlifetime', 86400);
ini_set('session.cookie_lifetime', 86400);
ini_set('session.use_trans_sid', 0);
ini_set('session.use_only_cookies', 1);
session_set_cookie_params(mktime(1,1,1,date("m")+1,date("d"),date("Y")),"/",SESSIE_IP);
session_save_path(SESSIE_PATH);
session_start();
?>
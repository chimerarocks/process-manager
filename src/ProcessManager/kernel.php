<?php

define("BASE_PATH", __DIR__ . "/../../../../..");

define("SCRIPTS_PATH", BASE_PATH . "/scripts");

define("CONFIG_PATH", BASE_PATH . "/config");

require_once CONFIG_PATH . "/app.php";

require_once __DIR__ . "/Helpers/scripts.php";

require_once __DIR__ . "/Helpers/env.php";

require_once __DIR__ . "/Helpers/array.php";

require_once __DIR__ . "/Helpers/debug.php";

require_once CONFIG_PATH . "/env.php";

require_once __DIR__ . "/Helpers/services.php";
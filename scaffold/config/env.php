<?php

define("PHANTOMJS_PATH", env("phantomjs","phantomjs"));
define("BASE_URI", env("base_uri", ""));
define("RESOURCES_PATH", env("resources_path", BASE_PATH . '/resources'));
define("LOG_PATH", env("log_path"));
define("HOST", env("host"));
define("RECON_PATH", env("recon_path"));

define("DB_PATHS", env("db_paths", [__DIR__ . "/schema"]));
define("DB_DEV", env("db_dev", true));
define("DB_DRIVER", env("db_driver"));
define("DB_USER", env("db_user"));
define("DB_PASSWORD", env("db_password"));
define("DB_DBNAME", env("db_dbname"));

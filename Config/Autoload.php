<?php

namespace Config;

class Autoload
{
	/* Renderizar los datos en json */
	public function render($data)
	{
		echo json_encode($data, JSON_PRETTY_PRINT);
	}

	public static function run()
	{
		spl_autoload_register(function ($class) {

			$path_file = str_replace("\\", "/", $class) . ".php";

			if (file_exists($path_file)) {
				include_once($path_file);
			} else {
				header("HTTP/1.0 404 Not Found");
				header("Status: 404 Not Found");
				exit();
			}
		});
	}
}

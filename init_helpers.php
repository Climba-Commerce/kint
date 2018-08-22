<?php

if (!function_exists('d')) {
    /**
     * Alias of Kint::dump().
     *
     * @return string
     */
    function d()
    {
        $args = func_get_args();

        return call_user_func_array(array('Kint', 'dump'), $args);
    }

    Kint::$aliases[] = 'd';
}

if (!function_exists('ddd')) {
	/**
	 * Alias of Kint::dump().
	 *
	 * @return string
	 */
	function ddd()
	{
		$args = func_get_args();

		exit(call_user_func_array(array('Kint', 'dump'), $args));
	}

	Kint::$aliases[] = 'ddd';
}

if (!function_exists('s')) {
    /**
     * Alias of Kint::dump(), however the output is in plain text.
     *
     * Alias of Kint::dump(), however the output is in plain htmlescaped text
     * with some minor visibility enhancements added.
     *
     * If run in CLI mode, output is not escaped.
     *
     * To force rendering mode without autodetecting anything:
     *
     * Kint::$enabled_mode = Kint::MODE_PLAIN;
     * Kint::dump( $variable );
     *
     * @return string
     */
    function s()
    {
        if (!Kint::$enabled_mode) {
            return 0;
        }

        $stash = Kint::settings();

        if (Kint::$enabled_mode !== Kint::MODE_TEXT) {
            Kint::$enabled_mode = Kint::MODE_PLAIN;
            if (PHP_SAPI === 'cli' && Kint::$cli_detection === true) {
                Kint::$enabled_mode = Kint::$mode_default_cli;
            }
        }

        $args = func_get_args();
        $out = call_user_func_array(array('Kint', 'dump'), $args);

        Kint::settings($stash);

        return $out;
    }

    Kint::$aliases[] = 's';
}

if (!\function_exists('sd')) {
	/**
	 * Alias of Kint::dump(), however the output is in plain text.
	 *
	 * Alias of Kint::dump(), however the output is in plain htmlescaped text
	 * with some minor visibility enhancements added.
	 *
	 * If run in CLI mode, output is not escaped.
	 *
	 * To force rendering mode without autodetecting anything:
	 *
	 * Kint::$enabled_mode = Kint::MODE_PLAIN;
	 * Kint::dump( $variable );
	 *
	 * @return int|string
	 */
	function sd()
	{
		if (!Kint::$enabled_mode) {
			return 0;
		}

		$stash = Kint::$enabled_mode;

		if (Kint::MODE_TEXT !== Kint::$enabled_mode) {
			Kint::$enabled_mode = Kint::MODE_PLAIN;
			if (PHP_SAPI === 'cli' && true === Kint::$cli_detection) {
				Kint::$enabled_mode = Kint::$mode_default_cli;
			}
		}

		$args = \func_get_args();
		$out = \call_user_func_array(array('Kint', 'dump'), $args);

		Kint::$enabled_mode = $stash;

		return exit($out);
	}

	Kint::$aliases[] = 'sd';
}

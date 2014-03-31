<?php

function getDefaultLocale()
{
	return 'en';
}

function getSupportedLocales()
{
	return array(
		'en' => 'English', 
		'pt-br' => 'Português',
		'es' => 'Español', 
	);
}

function getLocaleArray($current='')
{
	$output = array();

	foreach (getSupportedLocales() as $locale => $description)
	{
		if ($current !== $locale)
		{
			$output[$locale] = $description;
		}
	}

	return $output;
}

function getLocaleDescription($name)
{
	$locales = getLocaleArray();

	return $locales[$name];
}

function getLocale($description = false)
{
	if (!$description)
	{
		//return App::getLocale();
		return Config::get('app.locale');
	}

	$locales = getSupportedLocales();

	return $locales[Config::get('app.locale')];
}

/**
 * link to a named route and append sorting parameters to query string
 *
 * @param  string  $route_name
 * @param  string  $column
 * @param  string  $body
 *
 * @return string
 */
function link_to_sort_route_by_name($route_name, $column, $body)
{
	$input_sort_by = Request::get('sortBy');
	$input_sort_dir = Request::get('sortDirection');

	$direction = 'asc';
	$caret = '';

	if ($column == $input_sort_by)
	{
		$direction = ($input_sort_dir == 'asc') ? 'desc' : 'asc';

		$caret_direction = ($input_sort_dir == 'asc') ? 'up' : 'down';

		$caret = '&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-'.$caret_direction.'"></span>';
	}

	$link = link_to_route($route_name, $body, array('sortBy' => $column, 'sortDirection' => $direction));

	return $link.''.$caret;
}

####### New helpers ##########

/**
 * Display dollar value
 *
 * Displays integers as dollar amounts (example: 3000 returns 30.00)
 *
 * @param int   $value  dollar/cents * 100
 * @param bool  $cents  optional(false): display trailing cents (ex: 30.00)
 * @param bool  $sign   optional(false): prepend output with a "$"
 * @return string
 */
function ddv($value, $cents = false, $sign = false)
{
	if ($cents)
	{
		$value = sprintf("%.2f",($value/100));
	}
	else
	{
		$value = sprintf("%.0f",($value/100));
	}

	return ($sign) ? '$'.$value : $value;
}

/**
 * Select list prepend
 *
 * Prepends a key/value pair to a select list array
 *
 * @param array   $list
 * @param string  $value
 * @param string  $key     optional(0): custom key for output array
 * @return string
 */
function sl_prepend(array $list, $value, $key=0)
{
	return array($key => $value) + $list;
}
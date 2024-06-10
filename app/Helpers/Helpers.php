<?php

use Illuminate\Support\Facades\DB;


if (!function_exists('admin_url')) {
	function admin_url()
	{
		return url('admin');
	}
}
if (!function_exists('formated_date')) {
	function formated_date($datee)
	{
		return date("d/m/Y", strtotime($datee));
	}
}
if (!function_exists('date_formated')) {
	function date_formated($datee)
	{
		return date("d-m-Y", strtotime($datee));
	}
}
if (!function_exists('db_date')) {
	function db_date($datee)
	{
		return date("Y-m-d", strtotime($datee));
	}
}
if (!function_exists('js_date_formate')) {
	function js_date_formate()
	{
		return "dd/mm/yyyy";
	}
}
if (!function_exists('dateTimeCC')) {
	function date_time($time)
	{
		return $newDateTime = formated_date($time) . " " . date('h:i A', strtotime($time));
	}
}
if (!function_exists('time_elapsed_string')) {
	function time_elapsed_string($datetime, $full = false)
	{
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}
if (!function_exists('get_complete_table')) {
	function get_complete_table($table_name = '', $primary_key = '', $where_value = '', $orderby = '', $sorted = '')
	{
		$query = DB::table($table_name);
		$query->where('status', '1');
		if ($primary_key) {
			$query->where($primary_key, $where_value);
		}
		if ($sorted) {
			$query->orderBy($orderby, $sorted);
		} else {
			$query->orderBy('id', 'DESC');
		}
		$data = $query->get();
		return $data;
	}
}
if (!function_exists('get_complete_table_2_where')) {
	function get_complete_table_2_where($table_name = '', $column_name1 = '', $where_value1 = '', $column_name2 = '', $where_value2 = '', $orderby = '', $sorted = '')
	{
		$query = DB::table($table_name);
		$query->where('status', '1');
		if ($column_name1) {
			$query->where($column_name1, $where_value1);
		}
		if ($column_name2) {
			$query->where($column_name2, $where_value2);
		}
		if ($sorted) {
			$query->orderBy($orderby, $sorted);
		} else {
			$query->orderBy('id', 'DESC');
		}
		$data = $query->get();
		return $data;
	}
}
if (!function_exists('get_single_row')) {
	function get_single_row($table_name, $primary_key, $where_value)
	{
		$query = DB::table($table_name)
			->where($primary_key, $where_value)
			->first();
		return $query;
	}
}
if (!function_exists('get_single_value')) {
	function get_single_value($table_name, $where_value, $id)
	{
		$query = DB::table($table_name)
			->select($where_value)
			->where('id', $id)
			->first();
		return $query->$where_value;
	}
}
if (!function_exists('get_section_content')) {
	function get_section_content($meta_tag, $meta_key)
	{
		$query = DB::table('settings')
			->select('meta_value')
			->where('meta_tag', $meta_tag)
			->where('meta_key', $meta_key)
			->first();
		return $query->meta_value;
	}
}
if (!function_exists('permanently_deleted')) {
	function permanently_deleted($table_name, $primary_key, $where_id)
	{
		$query = DB::table($table_name)->where($primary_key, $where_id)->delete();
		return $query;
	}
}
if (!function_exists('soft_deleted')) {
	function soft_deleted($table_name, $primary_key, $where_id)
	{
		$query = DB::table($table_name)->where($primary_key, $where_id)
			->update([
				'is_deleted' => '1',
				'deleted_at' => date('Y-m-d H:i:s'),
			]);
		return $query;
	}
}
if (!function_exists('count_table_records')) {
	function count_table_records($table_name, $status = '')
	{
		$query = DB::table($table_name);
		if ($status) {
			$query->where('status', $status);
		}
		return $query->count();
	}
}
if (!function_exists('count_existing_record')) {
	function count_existing_record($table_name, $primary_key, $where_id)
	{
		$query = DB::table($table_name)->where($primary_key, $where_id)->count();
		return $query;
	}
}
if (!function_exists('count_total_records')) {
	function count_total_records($table_name)
	{
		$query = DB::table($table_name);
		return $query->count();
	}
}

if (!function_exists('check_permissions')) {
	function check_permissions($where_value)
	{
		if (Auth()->user()->type == 0) {
			return 1;
		} else {
			$roles = get_single_value('admin_users', 'permissions', Auth()->user()->id);
			$role = explode(',', $roles);
			if (in_array($where_value, $role)) {
				return 1;
			} else {
				return 0;
			}
		}
	}
}

if (!function_exists('find_records')) {
	function find_records($table_name, $where_value, $column_name)
	{
		$query1 = DB::table($table_name)->where($column_name, trim($where_value))->first();
		if (!empty($query1)) {
			return $query1->id;
		} else {
			$new_id = DB::table($table_name)->insertGetId([
				$column_name => $where_value,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			]);
			return $new_id;
		}
	}
}

if (!function_exists('mapfeaturetype')) {
	function mapfeaturetype($tinyint)
	{
		if ($tinyint == 1) {
			return 'Interior Feature';
		} elseif ($tinyint == 2) {
			return 'Exterior Finish';
		} elseif ($tinyint == 3) {
			return 'Featured Amenities';
		} elseif ($tinyint == 4) {
			return 'Appliances';
		} elseif ($tinyint == 5) {
			return 'Views';
		} elseif ($tinyint == 6) {
			return 'Heating';
		} elseif ($tinyint == 7) {
			return 'Cooling';
		} elseif ($tinyint == 8) {
			return 'Roof';
		} elseif ($tinyint == 9) {
			return 'Sewer-Water Systems';
		} elseif ($tinyint == 10) {
			return 'Extra Features';
		}
	}
}
if (!function_exists('developmentlvl')) {
	function developmentlvl($tinyint)
	{
		if ($tinyint == 1) {
			return 'Under Construction';
		} elseif ($tinyint == 2) {
			return 'Built';
		} elseif ($tinyint == 3) {
			return 'Under Renovation';
		} elseif ($tinyint == 4) {
			return 'Renovated';
		}
	}
}
if (!function_exists('mapListingStatus')) {
	function mapListingStatus($tinyint)
	{
		if ($tinyint == 1) {
			return 'For Sale';
		} elseif ($tinyint == 2) {
			return 'For Rent';
		} elseif ($tinyint == 3) {
			return 'Rented';
		} elseif ($tinyint == 4) {
			return 'Sale Pending';
		} elseif ($tinyint == 4) {
			return 'Sold';
		}
	}
}
if (!function_exists('mapHasSuite')) {
	function mapHasSuite($tinyint)
	{
		if ($tinyint == 1) {
			return 'No';
		} elseif ($tinyint == 2) {
			return 'Yes';
		} else if ($tinyint == 3) {
			return 'Potential';
		}
	}
}
if (!function_exists('mapGarage')) {
	function mapGarage($tinyint)
	{
		// 0: N/A, 1: 1, 2: 2, 3: 3, 4: 4, 5: 5+ 
		if ($tinyint == 0) {
			return 'N/A';
		} elseif ($tinyint == 1) {
			return '1';
		} elseif ($tinyint == 2) {
			return '2';
		} elseif ($tinyint == 3) {
			return '3';
		} elseif ($tinyint == 4) {
			return '4';
		} elseif ($tinyint == 5) {
			return '5+';
		}
	}
}
if (!function_exists('mapGarageType')) {
	function mapGarageType($tinyint)
	{
		// 1: Attached, 2: Detached
		if ($tinyint == 1) {
			return 'Attached';
		} elseif ($tinyint == 2) {
			return 'Detached';
		}
	}
}
if (!function_exists('mapBaseType')) {
	function mapBaseType($tinyint)
	{
		// 1: None, 2: Full, 3: Partial, 4: Crawl, 5: Walkout 
		if ($tinyint == 1) {
			return 'None';
		} elseif ($tinyint == 2) {
			return 'Full';
		} elseif ($tinyint == 3) {
			return 'Partial';
		} elseif ($tinyint == 4) {
			return 'Crawl';
		} elseif ($tinyint == 5) {
			return 'Walkout';
		}
	}
}
if (!function_exists('mapDevLvl')) {
	function mapDevLvl($tinyint)
	{
		if ($tinyint == 1) {
			return 'None';
		} elseif ($tinyint == 2) {
			return '25%';
		} elseif ($tinyint == 3) {
			return '50%';
		} elseif ($tinyint == 4) {
			return '75%';
		} elseif ($tinyint == 5) {
			return 'Complete';
		}
	}
}
if (!function_exists('mapMovePlan')) {
	function mapMovePlan($tinyint)
	{
		// 1: 1 Month, 2: 3 Month, 3: 6 Month, 4: 1 Year, 5: 2+ Years
		if ($tinyint == 1) {
			return '1 Month';
		} elseif ($tinyint == 2) {
			return '3 Month';
		} elseif ($tinyint == 3) {
			return '6 Month';
		} elseif ($tinyint == 4) {
			return '1 Year';
		} elseif ($tinyint == 5) {
			return '2+ Years';
		}
	}
}
if (!function_exists('slugify')) {
	function slugify($title)
	{
		$slug = mb_strtolower(trim($title), 'UTF-8');
		// Replace non-alphanumeric characters with dashes.
		$slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
		// Remove leading and trailing dashes.
		$slug = trim($slug, '-');
		// Replace multiple consecutive dashes with a single dash.
		$slug = preg_replace('/-+/', '-', $slug);
		return $slug;
	}
}
if (!function_exists('NHCodes')) {
	function NHCodes($title, $state, $country)
	{
		$code = '';
		// first letter of each word in $title
		$words = explode(' ', $title);
		foreach ($words as $word) {
			$code .= strtoupper(substr($word, 0, 1));
		}
		$code .= rand(1, 99);
		$check = DB::table('neighborhoods')->where('code', $code)->first();
		if ($check) {
			NHCodes($title, $state, $country);
		} else {
			return $code;
		}
	}
}
if (!function_exists('PropertyCode')) {
	function PropertyCode($neighbor_code, $listing_type)
	{
		// dd($neighbor_code, $listing_type);
		$listing = '';
		if ($listing_type == 1) {
			$listing = 'S';
		} elseif ($listing_type == 2) {
			$listing = 'R';
		} else {
			$listing = 'L';
		}
		$property_code = $neighbor_code . $listing . mt_rand(1000, 9999);
		// check if $property_code already exists as code column in neighborhoods table
		$check = DB::table('properties')->where('code', $property_code)->first();
		if ($check) {
			PropertyCode($neighbor_code, $listing_type);
		} else {
			return $property_code;
		}
	}
}


if (!function_exists('country_select')) {
	function country_select()
	{
		$countries_in_json = [
			"Afghanistan",
			"Albania",
			"Algeria",
			"Andorra",
			"Angola",
			"Antigua & Deps",
			"Argentina",
			"Armenia",
			"Australia",
			"Austria",
			"Azerbaijan",
			"Bahamas",
			"Bahrain",
			"Bangladesh",
			"Barbados",
			"Belarus",
			"Belgium",
			"Belize",
			"Benin",
			"Bhutan",
			"Bolivia",
			"Bosnia Herzegovina",
			"Botswana",
			"Brazil",
			"Brunei",
			"Bulgaria",
			"Burkina",
			"Burundi",
			"Cambodia",
			"Cameroon",
			"Canada",
			"Cape Verde",
			"Central African Rep",
			"Chad",
			"Chile",
			"China",
			"Colombia",
			"Comoros",
			"Congo",
			"Congo {Democratic Rep}",
			"Costa Rica",
			"Croatia",
			"Cuba",
			"Cyprus",
			"Czech Republic",
			"Denmark",
			"Djibouti",
			"Dominica",
			"Dominican Republic",
			"East Timor",
			"Ecuador",
			"Egypt",
			"El Salvador",
			"Equatorial Guinea",
			"Eritrea",
			"Estonia",
			"Eswatini",
			"Ethiopia",
			"Fiji",
			"Finland",
			"France",
			"Gabon",
			"Gambia",
			"Georgia",
			"Germany",
			"Ghana",
			"Greece",
			"Grenada",
			"Guatemala",
			"Guinea",
			"Guinea-Bissau",
			"Guyana",
			"Haiti",
			"Honduras",
			"Hungary",
			"Iceland",
			"India",
			"Indonesia",
			"Iran",
			"Iraq",
			"Ireland {Republic}",
			"Israel",
			"Italy",
			"Ivory Coast",
			"Jamaica",
			"Japan",
			"Jordan",
			"Kazakhstan",
			"Kenya",
			"Kiribati",
			"Korea North",
			"Korea South",
			"Kosovo",
			"Kuwait",
			"Kyrgyzstan",
			"Laos",
			"Latvia",
			"Lebanon",
			"Lesotho",
			"Liberia",
			"Libya",
			"Liechtenstein",
			"Lithuania",
			"Luxembourg",
			"Macedonia",
			"Madagascar",
			"Malawi",
			"Malaysia",
			"Maldives",
			"Mali",
			"Malta",
			"Marshall Islands",
			"Mauritania",
			"Mauritius",
			"Mexico",
			"Micronesia",
			"Moldova",
			"Monaco",
			"Mongolia",
			"Montenegro",
			"Morocco",
			"Mozambique",
			"Myanmar",
			"Namibia",
			"Nauru",
			"Nepal",
			"Netherlands",
			"New Zealand",
			"Nicaragua",
			"Niger",
			"Nigeria",
			"Norway",
			"Oman",
			"Pakistan",
			"Palau",
			"Palestine",
			"Panama",
			"Papua New Guinea",
			"Paraguay",
			"Peru",
			"Philippines",
			"Poland",
			"Portugal",
			"Qatar",
			"Romania",
			"Russian Federation",
			"Rwanda",
			"St Kitts & Nevis",
			"St Lucia",
			"Saint Vincent & the Grenadines",
			"Samoa",
			"San Marino",
			"Sao Tome & Principe",
			"Saudi Arabia",
			"Senegal",
			"Serbia",
			"Seychelles",
			"Sierra Leone",
			"Singapore",
			"Slovakia",
			"Slovenia",
			"Solomon Islands",
			"Somalia",
			"South Africa",
			"South Sudan",
			"Spain",
			"Sri Lanka",
			"Sudan",
			"Suriname",
			"Sweden",
			"Switzerland",
			"Syria",
			"Taiwan",
			"Tajikistan",
			"Tanzania",
			"Thailand",
			"Togo",
			"Tonga",
			"Trinidad & Tobago",
			"Tunisia",
			"Turkey",
			"Turkmenistan",
			"Tuvalu",
			"Uganda",
			"Ukraine",
			"United Arab Emirates",
			"United Kingdom",
			"United States",
			"Uruguay",
			"Uzbekistan",
			"Vanuatu",
			"Vatican City",
			"Venezuela",
			"Vietnam",
			"Yemen",
			"Zambia",
			"Zimbabwe"
		];

		return $countries_in_json;
	}
}

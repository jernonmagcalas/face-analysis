<?php //-->
/*
 * This file is part of the Block package of the Eden PHP Library.
 * (c) 2013-2014 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE
 * distributed with this package.
 */

namespace Eden\Block\Form;

use Eden\Block\Base;
use Eden\Block\Argument;

/**
 * Address Form Block
 *
 * @vendor Eden
 * @package Block
 * @author Christian Blanquera cblanquera@openovate.com
 */
class Address extends Base 
{
	protected $data	= array(
		'address_street_1' => null,
		'address_street_2' => null,
		'address_neighborhood' => null,
		'address_city' => null,
		'address_state'	=> null,
		'address_region' => null,
		'address_postal' => null,
		'address_country' => null,
		'address_phone'	=> null);
	
	protected $required	= array(
		'address_street_1',
		'address_city',
		'address_state',
		'address_region');
	
	protected $show	= array(
		'address_street_1' => true,
		'address_street_2' => true,
		'address_neighborhood' => true,
		'address_city' => true,
		'address_state'	=> true,
		'address_region' => true,
		'address_postal' => true,
		'address_country' => true,
		'address_phone'	=> true);
	
	protected $labels = array(
		'address_street_1' => 'Street',
		'address_street_2' => '',
		'address_neighborhood' => 'Neighborhood',
		'address_city' => 'City',
		'address_state'	=> 'State',
		'address_region' => 'Region',
		'address_postal' => 'Postal',
		'address_country' => 'Country',
		'address_phone'	=> 'Phone');
	
	protected $pattern = null;
	protected $errors = array();
	protected $holders = array();
	protected $neighborhoods = array();
	protected $states = array();
	protected $regions = array();
	protected $countries = array();
	
	/**
	 * Returns a template file
	 * 
	 * @param array data
	 * @return string
	 */
	public function getTemplate() 
	{
		return __DIR__.'/address.phtml';
	}
	
	/**
	 * Returns the template variables in key value format
	 *
	 * @param array data
	 * @return array
	 */
	public function getVariables() 
	{
		if(empty($this->countries)) {
			$this->countries = array(
				'GB' => 'United Kingdom',					'US' => 'United States',
				'AF' => 'Afghanistan',						'AL' => 'Albania',
				'DZ' => 'Algeria',							'AS' => 'American Samoa',
				'AD' => 'Andorra',							'AO' => 'Angola',
				'AI' => 'Anguilla',							'AQ' => 'Antarctica',
				'AG' => 'Antigua And Barbuda',				'AR' => 'Argentina',
				'AM' => 'Armenia',							'AW' => 'Aruba',
				'AU' => 'Australia',						'AT' => 'Austria',
				'AZ' => 'Azerbaijan',						'BS' => 'Bahamas',
				'BH' => 'Bahrain',							'BD' => 'Bangladesh',
				'BB' => 'Barbados',							'BY' => 'Belarus',
				'BE' => 'Belgium',							'BZ' => 'Belize',
				'BJ' => 'Benin',							'BM' => 'Bermuda',
				'BT' => 'Bhutan',							'BO' => 'Bolivia',
				'BA' => 'Bosnia And Herzegowina',			'BW' => 'Botswana',
				'BV' => 'Bouvet Island',					'BR' => 'Brazil',
				'IO' => 'British Indian Ocean Territory',	'BN' => 'Brunei Darussalam',
				'BG' => 'Bulgaria',							'BF' => 'Burkina Faso',
				'BI' => 'Burundi',							'KH' => 'Cambodia',
				'CM' => 'Cameroon',							'CA' => 'Canada',
				'CV' => 'Cape Verde',						'KY' => 'Cayman Islands',
				'CF' => 'Central African Republic',			'TD' => 'Chad',
				'CL' => 'Chile',							'CN' => 'China',
				'CX' => 'Christmas Island',					'CC' => 'Cocos (Keeling) Islands',
				'CO' => 'Colombia',							'KM' => 'Comoros',
				'CG' => 'Congo',							'CD' => 'Congo, The Democratic Republic Of The',
				'CK' => 'Cook Islands',						'CR' => 'Costa Rica',
				'CI' => 'Cote D\'Ivoire',					'HR' => 'Croatia (Local Name: Hrvatska)',
				'CU' => 'Cuba',								'CY' => 'Cyprus',
				'CZ' => 'Czech Republic',					'DK' => 'Denmark',
				'DJ' => 'Djibouti',							'DM' => 'Dominica',
				'DO' => 'Dominican Republic',				'TP' => 'East Timor',
				'EC' => 'Ecuador',							'EG' => 'Egypt',
				'SV' => 'El Salvador',						'GQ' => 'Equatorial Guinea',
				'ER' => 'Eritrea',							'EE' => 'Estonia',
				'ET' => 'Ethiopia',							'FK' => 'Falkland Islands (Malvinas)',
				'FO' => 'Faroe Islands',					'FJ' => 'Fiji',
				'FI' => 'Finland',							'FR' => 'France',
				'FX' => 'France, Metropolitan',				'GF' => 'French Guiana',
				'PF' => 'French Polynesia',					'TF' => 'French Southern Territories',
				'GA' => 'Gabon',							'GM' => 'Gambia',
				'GE' => 'Georgia',							'DE' => 'Germany',
				'GH' => 'Ghana',							'GI' => 'Gibraltar',
				'GR' => 'Greece',							'GL' => 'Greenland',
				'GD' => 'Grenada',							'GP' => 'Guadeloupe',
				'GU' => 'Guam',								'GT' => 'Guatemala',
				'GN' => 'Guinea',							'GW' => 'Guinea-Bissau',
				'GY' => 'Guyana',							'HT' => 'Haiti',
				'HM' => 'Heard And Mc Donald Islands',		'VA' => 'Holy See (Vatican City State)',
				'HN' => 'Honduras',							'HK' => 'Hong Kong',
				'HU' => 'Hungary',							'IS' => 'Iceland',
				'IN' => 'India',							'ID' => 'Indonesia',
				'IR' => 'Iran (Islamic Republic Of)',		'IQ' => 'Iraq',
				'IE' => 'Ireland',							'IL' => 'Israel',
				'IT' => 'Italy',							'JM' => 'Jamaica',
				'JP' => 'Japan',							'JO' => 'Jordan',
				'KZ' => 'Kazakhstan',						'KE' => 'Kenya',
				'KI' => 'Kiribati',							'KP' => 'Korea, Democratic People\'s Republic Of',
				'KR' => 'Korea, Republic Of',				'KW' => 'Kuwait',
				'KG' => 'Kyrgyzstan',						'LA' => 'Lao People\'s Democratic Republic',
				'LV' => 'Latvia',							'LB' => 'Lebanon',
				'LS' => 'Lesotho',							'LR' => 'Liberia',
				'LY' => 'Libyan Arab Jamahiriya',			'LI' => 'Liechtenstein',
				'LT' => 'Lithuania',						'LU' => 'Luxembourg',
				'MO' => 'Macau',							'MK' => 'Macedonia, Former Yugoslav Republic Of',
				'MG' => 'Madagascar',						'MW' => 'Malawi',
				'MY' => 'Malaysia',							'MV' => 'Maldives',
				'ML' => 'Mali',								'MT' => 'Malta',
				'MH' => 'Marshall Islands',					'MQ' => 'Martinique',
				'MR' => 'Mauritania',						'MU' => 'Mauritius',
				'YT' => 'Mayotte',							'MX' => 'Mexico',
				'FM' => 'Micronesia, Federated States Of',	'MD' => 'Moldova, Republic Of',
				'MC' => 'Monaco',							'MN' => 'Mongolia',
				'MS' => 'Montserrat',						'MA' => 'Morocco',
				'MZ' => 'Mozambique',						'MM' => 'Myanmar',
				'NA' => 'Namibia',							'NR' => 'Nauru',
				'NP' => 'Nepal',							'NL' => 'Netherlands',
				'AN' => 'Netherlands Antilles',				'NC' => 'New Caledonia',
				'NZ' => 'New Zealand',						'NI' => 'Nicaragua',
				'NE' => 'Niger',							'NG' => 'Nigeria',
				'NU' => 'Niue',								'NF' => 'Norfolk Island',
				'MP' => 'Northern Mariana Islands',			'NO' => 'Norway',
				'OM' => 'Oman',								'PK' => 'Pakistan',
				'PW' => 'Palau',							'PA' => 'Panama',
				'PG' => 'Papua New Guinea',					'PY' => 'Paraguay',
				'PE' => 'Peru',								'PH' => 'Philippines',
				'PN' => 'Pitcairn',							'PL' => 'Poland',
				'PT' => 'Portugal',							'PR' => 'Puerto Rico',
				'QA' => 'Qatar',							'RE' => 'Reunion',
				'RO' => 'Romania',							'RU' => 'Russian Federation',
				'RW' => 'Rwanda',							'KN' => 'Saint Kitts And Nevis',
				'LC' => 'Saint Lucia',						'VC' => 'Saint Vincent And The Grenadines',
				'WS' => 'Samoa',							'SM' => 'San Marino',
				'ST' => 'Sao Tome And Principe',			'SA' => 'Saudi Arabia',
				'SN' => 'Senegal',							'SC' => 'Seychelles',
				'SL' => 'Sierra Leone',						'SG' => 'Singapore',
				'SK' => 'Slovakia (Slovak Republic)',		'SI' => 'Slovenia',
				'SB' => 'Solomon Islands',					'SO' => 'Somalia',
				'ZA' => 'South Africa',						'GS' => 'South Georgia, South Sandwich Islands',
				'ES' => 'Spain',							'LK' => 'Sri Lanka',
				'SH' => 'St. Helena',						'PM' => 'St. Pierre And Miquelon',
				'SD' => 'Sudan',							'SR' => 'Suriname',
				'SJ' => 'Svalbard And Jan Mayen Islands',	'SZ' => 'Swaziland',
				'SE' => 'Sweden',							'CH' => 'Switzerland',
				'SY' => 'Syrian Arab Republic',				'TW' => 'Taiwan',
				'TJ' => 'Tajikistan',						'TZ' => 'Tanzania, United Republic Of',
				'TH' => 'Thailand',							'TG' => 'Togo',
				'TK' => 'Tokelau',							'TO' => 'Tonga',
				'TT' => 'Trinidad And Tobago',				'TN' => 'Tunisia',
				'TR' => 'Turkey',							'TM' => 'Turkmenistan',
				'TC' => 'Turks And Caicos Islands',			'TV' => 'Tuvalu',
				'UG' => 'Uganda',							'UA' => 'Ukraine',
				'AE' => 'United Arab Emirates',				'UM' => 'United States Minor Outlying Islands',
				'UY' => 'Uruguay',							'UZ' => 'Uzbekistan',
				'VU' => 'Vanuatu',							'VE' => 'Venezuela',
				'VN' => 'Viet Nam',							'VG' => 'Virgin Islands (British)',
				'VI' => 'Virgin Islands (U.S.)',			'WF' => 'Wallis And Futuna Islands',
				'EH' => 'Western Sahara',					'YE' => 'Yemen',
				'YU' => 'Yugoslavia',						'ZM' => 'Zambia',
				'ZW' => 'Zimbabwe');
		}
		
		return array(
			'pattern' => $this->pattern,
			'fields' => $this->show,
			'labels' => $this->labels,
			'data' => $this->data,
			'errors' => $this->errors,
			'holders' => $this->holders,
			'states' => $this->states,
			'regions' => $this->regions,
			'required' => $this->required,
			'neighborhoods' => $this->neighborhoods,
			'countries' => $this->countries);
	}
	
	/**
	 * Prevent rendering of country
	 *
	 * @return Eden\Block\Form\Address
	 */
	public function noCountry() 
	{
		$this->show['address_country'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of neighborhood
	 *
	 * @return Eden\Block\Form\Address
	 */
	public function noNeighborhood() 
	{
		$this->show['address_neighborhood'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of phone
	 *
	 * @return Eden\Block\Form\Address
	 */
	public function noPhone() 
	{
		$this->show['address_phone'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of neighborhood
	 *
	 * @return Eden\Block\Form\Address
	 */
	public function noPostal() 
	{
		$this->show['address_postal'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of region
	 *
	 * @return Eden\Block\Form\Address
	 */
	public function noRegion() 
	{
		$this->show['address_region'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of state
	 *
	 * @return Eden\Block\Form\Address
	 */
	public function noState() 
	{
		$this->show['address_state'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of streets
	 *
	 * @return Eden\Block\Form\Address
	 */
	public function noStreets() 
	{
		$this->show['address_street_1'] = false;
		$this->show['address_street_2'] = false;
		return $this;
	}
	
	/**
	 * Prevent rendering of street 2
	 *
	 * @return Eden\Block\Form\Address
	 */
	public function noStreet2() 
	{
		$this->show['address_street_2'] = false;
		return $this;
	}
	
	/**
	 * Sets the countries list
	 *
	 * @param array
	 * @return Eden\Block\Form\Address
	 */
	public function setCountries(array $countries) 
	{
		$this->countries = $countries;
		return $this;
	}
	
	/**
	 * Sets form data
	 *
	 * @param array|string
	 * @return Eden\Block\Form\Address
	 */
	public function setData($data) 
	{
		if(is_array($data)) {
			$this->data = $data;
		}
		
		$args = func_get_args();
		$this->data[$args[0]] = $args[1];
		
		return $this;
	}
	
	/**
	 * Sets errors
	 *
	 * @param array|string
	 * @return Eden\Block\Form\Address
	 */
	public function setErrors($errors) 
	{
		if(is_array($errors)) {
			$this->errors = $errors;
			return $this;
		}
		
		$args = func_get_args();
		$this->errors[$args[0]] = $args[1];
		
		return $this;
	}
	
	/**
	 * Sets phone pattern
	 *
	 * @param string|array
	 * @return Eden\Block\Form\Address
	 */
	public function setPhonePattern($pattern) 
	{
		$this->pattern = $pattern;
		
		return $this;
	}
	
	/**
	 * Sets place holders
	 *
	 * @param string|array
	 * @return Eden\Block\Form\Address
	 */
	public function setHolders($holders) 
	{
		if(is_array($holders)) {
			$this->holders = $holders;
		}
		
		$args = func_get_args();
		$this->holders[$args[0]] = $args[1];
		
		return $this;
	}
	
	/**
	 * Sets labels
	 *
	 * @param string|array
	 * @return Eden\Block\Form\Address
	 */
	public function setLabels($labels) 
	{
		if(is_array($labels)) {
			$this->labels = $labels;
		}
		
		$args = func_get_args();
		$this->labels[$args[0]] = $args[1];
		
		return $this;
	}
	
	/**
	 * Sets the neighborhood list
	 *
	 * @param array
	 * @return Eden\Block\Form\Address
	 */
	public function setNeighborhoods(array $neighborhoods) 
	{
		$this->neighborhoods = array_values($neighborhoods);
		return $this;
	}
	
	/**
	 * Sets the region list
	 *
	 * @param array
	 * @return Eden\Block\Form\Address
	 */
	public function setRegions(array $regions) 
	{
		$this->regions = array_values($regions);
		return $this;
	}
	
	/**
	 * Sets the required fields
	 *
	 * @param array
	 * @return Eden\Block\Form\Address
	 */
	public function setRequired(array $required) 
	{
		$this->required = array_values($required);
		return $this;
	}
	
	/**
	 * Sets the states list
	 *
	 * @param array
	 * @return Eden\Block\Form\Address
	 */
	public function setStates(array $states) 
	{
		$this->states = array_values($states);
		return $this;
	}
	
	/**
	 * Shows only the specified in the order specified
	 *
	 * @param array
	 * @return Eden\Block\Form\Address
	 */
	public function show(array $fields) 
	{
		$this->show = array();
		
		foreach($fields as $field) {
			$this->show[$field] = true;
		}
		
		return $this;
	}
	
}
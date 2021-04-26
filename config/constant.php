<?php

return [

    'feature_list' => [
        'view'=>'view',
        'add'=>'add',
        'update'=>'update',
        'delete'=>'delete',
        'import'=>'import',
        'export'=>'export',
        'branch'=>'branch',
    ],
    
    'customer_classifications'=>[
        '1'=> 'Pharma',
        '2'=> 'Chemical',
        '3'=> 'Petrochemical',
        '4'=> 'Environment Food',
        '5'=> 'F&F',
        '6' => 'Institute',
        '7' => 'Accademia',
        '8' => 'Dealers',
        '9'=> 'Others',
    ],

    'branch_wise'=>[
        '1'=>'Mumbai',
        '2'=>'Ahmedabad',									
        '3'=>'Bangalore',
        '4'=>'Surat',
        '5'=>'Chennai',
        '6'=>'Pune',
        '7'=>'Chandigarh',
        '8'=>'Goa',
        '9'=>'Hyderabad',
        '10'=>'Indore',
        '11'=>'Kolkata',
        '12'=>'Delhi',
        '13'=>'North-3',
    ],
    
    'regions_id' =>[
        'CENTRAL'=>'CENTRAL', 
        'HARBOUR'=>'HARBOUR',
        'WESTERN'=>'WESTERN'
    ],

    'currency' =>[
        'INR'=>'INR',
        'USD'=>'USD', 
        'EUR'=>'EUR',
        'JPY'=>'JPY',
        'GBP'=>'GBP',
    ],

    'payment_term' =>[
        'Advance Against Proforma Invoice'=>'Advance Against Proforma Invoice',
        'Against PDC'=>'Against PDC', 
        '30 Days from Date of Shipment'=>'30 Days from Date of Shipment',
        '45 Days from Date of Shipment'=>'45 Days from Date of Shipment',
        '60 Days from Date of Shipment'=>'60 Days from Date of Shipment',
        '90 Days from Date of Shipment'=>'90 Days from Date of Shipment',
    ],

    'currencyCodes' =>[
        "BRL" => "R$" , // OR add ₢ Brazilian Real
        "BDT" => "৳", //Bangladeshi Taka
        "CAD" => "C$" , //Canadian Dollar
        "CHF" => "Fr" , //Swiss Franc
        "CRC" => "₡", //Costa Rican Colon
        "CZK" => "Kč" , //Czech Koruna
        "DKK" => "kr" , //Danish Krone
        "EUR" => "€" , //Euro
        "GBP" => "£" , //Pound Sterling
        "HKD" => "$" , //Hong Kong Dollar
        "HUF" => "Ft" , //Hungarian Forint
        "ILS" => "₪" , //Israeli New Sheqel
        "INR" => "₹", //Indian Rupee
        "ILS" => "₪",	//Israeli New Shekel
        "JPY" => "¥" , //also use ¥ Japanese Yen
        "KZT" => "₸", //Kazakhstan Tenge
        "KRW" => "₩",	//Korean Won
        "KHR" => "៛", //Cambodia Kampuchean Riel	
        "MYR" => "RM" , //Malaysian Ringgit 
        "MXN" => "$" , //Mexican Peso
        "NOK" => "kr" , //Norwegian Krone
        "NGN" => "₦",	//Nigerian Naira
        "NZD" => "$" , //New Zealand Dollar
        "PHP" => "₱" , //Philippine Peso
        "PKR" => "₨" , //Pakistani Rupees
        "PLN" => "zł" ,//Polish Zloty
        "SEK" => "kr" , //Swedish Krona 
        "TWD" => "$" , //Taiwan New Dollar 
        "THB" => "฿" , //Thai Baht
        "TRY" => "₺", //Turkish Lira
        "USD" => "$" , //U.S. Dollar
        "VND" => "₫"	//Vietnamese Dong
    ],
      
    'indian_all_states' => [
        '1' => 'Andhra Pradesh',
        '2' => 'Arunachal Pradesh',
        '3' => 'Assam',
        '4' => 'Bihar',
        '5' => 'Chhattisgarh',
        '6' => 'Goa',
        '7' => 'Gujarat',
        '8' => 'Haryana',
        '9' => 'Himachal Pradesh',
        '10' => 'Jammu & Kashmir',
        '11' => 'Jharkhand',
        '12' => 'Karnataka',
        '13' => 'Kerala',
        '14' => 'Madhya Pradesh',
        '15' => 'Maharashtra',
        '16' => 'Manipur',
        '17' => 'Meghalaya',
        '18' => 'Mizoram',
        '19' => 'Nagaland',
        '20' => 'Odisha',
        '21' => 'Punjab',
        '22' => 'Rajasthan',
        '23' => 'Sikkim',
        '24' => 'Tamil Nadu',
        '25'=>	'Telangana',
        '26' => 'Tripura',
        '27' => 'Uttarakhand',
        '28' => 'Uttar Pradesh',
        '29' => 'West Bengal',
        '30' => 'Andaman & Nicobar',
        '31' => 'Chandigarh',
        '32' => 'Dadra and Nagar Haveli',
        '33' => 'Daman & Diu',
        '34' => 'Delhi',
        '35' => 'Lakshadweep',
        '36' => 'Puducherry',
    ],

    'countries' =>[
        "US" => "USA",
        "CA" => "Canada",
        "AF" => "Afghanistan",
        "AL" => "Albania",
        "DZ" => "Algeria",

        "AS" => "American Samoa",
        "AD" => "Andorra",
        "AO" => "Angola",
        "AI" => "Anguilla",
        "AQ" => "Antarctica",
        "AG" => "Antigua and Barbuda",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BA" => "Bosnia and Herzegovina",
        "BW" => "Botswana",
        "BV" => "Bouvet Island",
        "BR" => "Brazil",
        "BN" => "Brunei Darussalam",
        "BG" => "Bulgaria",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",						
        "CV" => "Cape Verde",
        "KY" => "Cayman Islands",
        "CF" => "Central African Republic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CC" => "Cocos (Keeling) Islands",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo",
        "CK" => "Cook Islands",
        "CR" => "Costa Rica",
        "CI" => "Cote d'Ivoire",
        "HR" => "Croatia",
        "CU" => "Cuba",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "DK" => "Denmark",
        "DJ" => "Djibouti",
        "DM" => "Dominica",
        "DO" => "Dominican Republic",
        "TL" => "East Timor",
        "EC" => "Ecuador",
        "EG" => "Egypt",
        "SV" => "El Salvador",
        "GQ" => "Equatorial Guinea",
        "ER" => "Eritrea",
        "EE" => "Estonia",
        "ET" => "Ethiopia",
        "FK" => "Falkland Islands",
        "FO" => "Faroe Islands",
        "FJ" => "Fiji",
        "FI" => "Finland",
        "FR" => "France",
        "GF" => "French Guiana",
        "PF" => "French Polynesia",
        "GA" => "Georgia",
        "GM" => "Gambia",
        "DE" => "Germany",
        "GH" => "Ghana",
        "GR" => "Greece",
        "GL" => "Greenland",
        "GD" => "Grenada",
        "GP" => "Guadeloupe",
        "GU" => "Guam",
        "GT" => "Guatemala",
        "GN" => "Guinea",
        "GW" => "Guinea-Bissau",
        "GY" => "Guyana",
        "HT" => "Haiti",
        "HN" => "Honduras",
        "GG" => "Guernsey",
        "HK" => "Hong Kong",
        "HU" => "Hungary",
        "IS" => "Iceland",
        "IN" => "India",
        "ID" => "Indonesia",
        "IR" => "Iran",
        "IQ" => "Iraq",
        "IE" => "Ireland",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JO" => "Jordan",
        "KZ" => "Kazakhstan",
        "KE" => "Kenya",
        "KI" => "Kiribati",
        "KP" => "North Korea",
        "KR" => "South Korea",
        "KW" => "Kuwait",
        "KG" => "Kyrgyzstan",
        "LV" => "Latvia",
        "LB" => "Lebanon",
        "LS" => "Lesotho",
        "LR" => "Liberia",
        "LY" => "Libya",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MO" => "Macau",
        "MK" => "Macedonia",
        "MG" => "Madagascar",
        "MW" => "Malawi",
        "MY" => "Malaysia",
        "MV" => "Maldives",
        "ML" => "Mali",
        "MT" => "Malta",
        "MH" => "Marshall Islands",
        "MQ" => "Martinique",
        "MR" => "Mauritania",
        "MU" => "Mauritius",
        "YT" => "Mayotte",
        "MX" => "Mexico",
        "FM" => "Micronesia",
        "MD" => "Moldova",
        "MC" => "Monaco",
        "MN" => "Mongolia",
        "MS" => "Montserrat",
        "MA" => "Morocco",
        "MZ" => "Mozambique",
        "MM" => "Myanmar",
        "NA" => "Namibia",
        "NR" => "Nauru",
        "NP" => "Nepal",
        "NL" => "Netherlands",
        "NC" => "New Caledonia",
        "NZ" => "New Zealand",
        "NI" => "Nicaragua",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "NU" => "Niue",
        "NF" => "Norfolk Island",
        "MP" => "Northern Mariana Islands",
        "NO" => "Norway",
        "OM" => "Oman",
        "PK" => "Pakistan",
        "PW" => "Palau",
        "PA" => "PANAMA",
        "PG" => "Papua New Guinea",
        "PY" => "Paraguay",
        "PE" => "Peru",
        "PH" => "Philippines",
        "PN" => "Pitcairn",
        "PL" => "Poland",
        "PT" => "Portugal",
        "PR" => "Puerto Rico",
        "QA" => "Qatar",
        "RE" => "Reunion",
        "RO" => "Romania",
        "RU" => "Russian Federation",
        "RW" => "Rwanda",
        "KN" => "Saint Kitts and Nevis",
        "LC" => "Saint Lucia",
        "WS" => "Samoa",
        "SM" => "San Marino",
        "ST" => "Sao Tome and Principe",
        "SA" => "Saudi Arabia",
        "SN" => "Senegal",
        "SC" => "Seychelles",
        "SL" => "Sierra Leone",
        "SG" => "Singapore",
        "SK" => "Slovakia",
        "SI" => "Slovenia",
        "SB" => "Solomon Islands",
        "SO" => "Somalia",
        "ZA" => "South Africa",
        "ES" => "Spain",
        "LK" => "Sri Lanka",
        "PM" => "St Pierre and Miquelon",
        "SD" => "Sudan",
        "SR" => "Suriname",
        "SZ" => "Swaziland",
        "SE" => "Sweden",
        "CH" => "Switzerland",
        "SY" => "Syrian Arab Republic",
        "TW" => "Taiwan",
        "TJ" => "Tajikistan",
        "TZ" => "Tanzania",
        "TH" => "Thailand",
        "TG" => "Togo",
        "TK" => "Tokelau",
        "TO" => "Tonga",
        "TT" => "Trinidad and Tobago",
        "TN" => "Tunisia",
        "TR" => "Turkey",
        "TM" => "Turkmenistan",
        "TC" => "Turks and Caicos Islands",
        "TV" => "Tuvalu",
        "UG" => "Uganda",
        "UA" => "Ukraine",
        "AE" => "United Arab Emirates",
        "GB" => "United Kingdom",
        "UY" => "Uruguay",
        "UZ" => "Uzbekistan",
        "VU" => "Vanuatu",
        "VE" => "Venezuela",
        "VN" => "VietNam",
        "VI" => "Virgin Islands U.S.",
        "YE" => "Yemen",
        "CD" => "Zaire",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe",
        "AQ" => "Antarctica",
        "BL" => "Bonaire (Netherlands Antilles)",
        "IO" => "British Indian Ocean Territory",
        "IC" => "Canary Islands (Spain)",
        "CX" => "Christmas Island (Australia)",
        "CB" => "Curacao (Netherlands Antilles)",
        "TP" => "East Timor",
        "EN" => "England",
        "TF" => "French Southern Territories",
        "GI" => "Gibraltar",
        "HM" => "Heard Island and McDonald Islands",
        "HO" => "Holland",
        "VA" => "Holy See (Vatican City)",
        "JE" => "Jersey",
        "ME" => "Montenegro",
        "AN" => "Netherlands Antilles",
        "NB" => "Northern Ireland",
        "PS" => "Palestinian Territory, Occupied",
        "GE" => "Republic of Georgia",
        "SS" => "Saba",
        "SH" => "Saint Helena",
        "VC" => "Saint Vincent and the Grenadines",
        "SF" => "Scotland",
        "RS" => "Serbia",
        "NT" => "St. Barthelemy",
        "SJ" => "Svalbard and Jan Mayen",
        "VG" => "Virgin Islands, British",
        "WL" => "Wales",
        "WF" => "Wallis and Futuna",
        "EH" => "Western Sahara",
        "YU" => "Yugoslavia"	
    ],

    'exclude_model'=>[
        'userregister'=>'userregister',
        'settings'=>'settings',
        'quotationdetails'=>'quotationdetails',
        'role'=>'role',
        'orderdetails'=>'orderdetails',
        'qoutationdetails' =>'qoutationdetails',
        'pendingquotation'=>'pendingquotation'
    ],
];

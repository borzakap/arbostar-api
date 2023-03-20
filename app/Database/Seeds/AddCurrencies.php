<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AddCurrencies extends Seeder
{
    public function run()
    {
        $time = new Time('now');
        $datetime = $time->toDateTimeString();
        $data = [
            ['name' => 'United Arab Emirates Dirham', 'iso' => 'AED', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Afghanistan Afghani', 'iso' => 'AFN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Albania Lek', 'iso' => 'ALL', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Armenia Dram', 'iso' => 'AMD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Netherlands Antilles Guilder', 'iso' => 'ANG', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Angola Kwanza', 'iso' => 'AOA', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Argentina Peso', 'iso' => 'ARS', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Australia Dollar', 'iso' => 'AUD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Aruba Guilder', 'iso' => 'AWG', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Azerbaijan Manat', 'iso' => 'AZN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Bosnia and Herzegovina Convertible Mark', 'iso' => 'BAM', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Barbados Dollar', 'iso' => 'BBD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Bangladesh Taka', 'iso' => 'BDT', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Bulgaria Lev', 'iso' => 'BGN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Bahrain Dinar', 'iso' => 'BHD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Burundi Franc', 'iso' => 'BIF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Bermuda Dollar', 'iso' => 'BMD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Brunei Darussalam Dollar', 'iso' => 'BND', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Bolivia Bolíviano', 'iso' => 'BOB', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Brazil Real', 'iso' => 'BRL', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Bahamas Dollar', 'iso' => 'BSD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Bhutan Ngultrum', 'iso' => 'BTN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Botswana Pula', 'iso' => 'BWP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Belarus Ruble', 'iso' => 'BYN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Belize Dollar', 'iso' => 'BZD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Canada Dollar', 'iso' => 'CAD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Congo/Kinshasa Franc', 'iso' => 'CDF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Switzerland Franc', 'iso' => 'CHF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Chile Peso', 'iso' => 'CLP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'China Yuan Renminbi', 'iso' => 'CNY', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Colombia Peso', 'iso' => 'COP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Costa Rica Colon', 'iso' => 'CRC', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Cuba Convertible Peso', 'iso' => 'CUC', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Cuba Peso', 'iso' => 'CUP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Cape Verde Escudo', 'iso' => 'CVE', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Czech Republic Koruna', 'iso' => 'CZK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Djibouti Franc', 'iso' => 'DJF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Denmark Krone', 'iso' => 'DKK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Dominican Republic Peso', 'iso' => 'DOP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Algeria Dinar', 'iso' => 'DZD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Egypt Pound', 'iso' => 'EGP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Eritrea Nakfa', 'iso' => 'ERN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Ethiopia Birr', 'iso' => 'ETB', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Euro Member Countries', 'iso' => 'EUR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Fiji Dollar', 'iso' => 'FJD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Falkland Islands (Malvinas) Pound', 'iso' => 'FKP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'United Kingdom Pound', 'iso' => 'GBP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Georgia Lari', 'iso' => 'GEL', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Guernsey Pound', 'iso' => 'GGP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Ghana Cedi', 'iso' => 'GHS', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Gibraltar Pound', 'iso' => 'GIP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Gambia Dalasi', 'iso' => 'GMD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Guinea Franc', 'iso' => 'GNF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Guatemala Quetzal', 'iso' => 'GTQ', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Guyana Dollar', 'iso' => 'GYD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Hong Kong Dollar', 'iso' => 'HKD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Honduras Lempira', 'iso' => 'HNL', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Croatia Kuna', 'iso' => 'HRK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Haiti Gourde', 'iso' => 'HTG', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Hungary Forint', 'iso' => 'HUF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Indonesia Rupiah', 'iso' => 'IDR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Israel Shekel', 'iso' => 'ILS', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Isle of Man Pound', 'iso' => 'IMP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'India Rupee', 'iso' => 'INR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Iraq Dinar', 'iso' => 'IQD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Iran Rial', 'iso' => 'IRR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Iceland Krona', 'iso' => 'ISK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Jersey Pound', 'iso' => 'JEP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Jamaica Dollar', 'iso' => 'JMD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Jordan Dinar', 'iso' => 'JOD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Japan Yen', 'iso' => 'JPY', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Kenya Shilling', 'iso' => 'KES', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Kyrgyzstan Som', 'iso' => 'KGS', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Cambodia Riel', 'iso' => 'KHR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Comorian Franc', 'iso' => 'KMF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Korea (North) Won', 'iso' => 'KPW', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Korea (South) Won', 'iso' => 'KRW', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Kuwait Dinar', 'iso' => 'KWD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Cayman Islands Dollar', 'iso' => 'KYD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Kazakhstan Tenge', 'iso' => 'KZT', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Laos Kip', 'iso' => 'LAK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Lebanon Pound', 'iso' => 'LBP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Sri Lanka Rupee', 'iso' => 'LKR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Liberia Dollar', 'iso' => 'LRD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Lesotho Loti', 'iso' => 'LSL', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Libya Dinar', 'iso' => 'LYD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Morocco Dirham', 'iso' => 'MAD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Moldova Leu', 'iso' => 'MDL', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Madagascar Ariary', 'iso' => 'MGA', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Macedonia Denar', 'iso' => 'MKD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Myanmar (Burma) Kyat', 'iso' => 'MMK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Mongolia Tughrik', 'iso' => 'MNT', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Macau Pataca', 'iso' => 'MOP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Mauritania Ouguiya', 'iso' => 'MRU', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Mauritius Rupee', 'iso' => 'MUR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Maldives (Maldive Islands) Rufiyaa', 'iso' => 'MVR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Malawi Kwacha', 'iso' => 'MWK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Mexico Peso', 'iso' => 'MXN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Malaysia Ringgit', 'iso' => 'MYR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Mozambique Metical', 'iso' => 'MZN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Namibia Dollar', 'iso' => 'NAD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Nigeria Naira', 'iso' => 'NGN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Nicaragua Cordoba', 'iso' => 'NIO', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Norway Krone', 'iso' => 'NOK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Nepal Rupee', 'iso' => 'NPR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'New Zealand Dollar', 'iso' => 'NZD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Oman Rial', 'iso' => 'OMR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Panama Balboa', 'iso' => 'PAB', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Peru Sol', 'iso' => 'PEN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Papua New Guinea Kina', 'iso' => 'PGK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Philippines Peso', 'iso' => 'PHP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Pakistan Rupee', 'iso' => 'PKR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Poland Zloty', 'iso' => 'PLN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Paraguay Guarani', 'iso' => 'PYG', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Qatar Riyal', 'iso' => 'QAR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Romania Leu', 'iso' => 'RON', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Serbia Dinar', 'iso' => 'RSD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Russia Ruble', 'iso' => 'RUB', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Rwanda Franc', 'iso' => 'RWF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Saudi Arabia Riyal', 'iso' => 'SAR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Solomon Islands Dollar', 'iso' => 'SBD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Seychelles Rupee', 'iso' => 'SCR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Sudan Pound', 'iso' => 'SDG', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Sweden Krona', 'iso' => 'SEK', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Singapore Dollar', 'iso' => 'SGD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Saint Helena Pound', 'iso' => 'SHP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Sierra Leone Leone', 'iso' => 'SLL', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Somalia Shilling', 'iso' => 'SOS', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Seborga Luigino', 'iso' => 'SPL', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Suriname Dollar', 'iso' => 'SRD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'São Tomé and Príncipe Dobra', 'iso' => 'STN', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'El Salvador Colon', 'iso' => 'SVC', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Syria Pound', 'iso' => 'SYP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'eSwatini Lilangeni', 'iso' => 'SZL', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Thailand Baht', 'iso' => 'THB', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Tajikistan Somoni', 'iso' => 'TJS', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Turkmenistan Manat', 'iso' => 'TMT', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Tunisia Dinar', 'iso' => 'TND', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Tonga Pa\'anga', 'iso' => 'TOP', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Turkey Lira', 'iso' => 'TRY', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Trinidad and Tobago Dollar', 'iso' => 'TTD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Tuvalu Dollar', 'iso' => 'TVD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Taiwan New Dollar', 'iso' => 'TWD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Tanzania Shilling', 'iso' => 'TZS', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Ukraine Hryvnia', 'iso' => 'UAH', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Uganda Shilling', 'iso' => 'UGX', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'United States Dollar', 'iso' => 'USD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Uruguay Peso', 'iso' => 'UYU', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Uzbekistan Som', 'iso' => 'UZS', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Venezuela Bolívar', 'iso' => 'VEF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Viet Nam Dong', 'iso' => 'VND', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Vanuatu Vatu', 'iso' => 'VUV', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Samoa Tala', 'iso' => 'WST', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Communauté Financière Africaine (BEAC) CFA Franc BEAC', 'iso' => 'XAF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'East Caribbean Dollar', 'iso' => 'XCD', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'International Monetary Fund (IMF) Special Drawing Rights', 'iso' => 'XDR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Communauté Financière Africaine (BCEAO) Franc', 'iso' => 'XOF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Comptoirs Français du Pacifique (CFP) Franc', 'iso' => 'XPF', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Yemen Rial', 'iso' => 'YER', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'South Africa Rand', 'iso' => 'ZAR', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Zambia Kwacha', 'iso' => 'ZMW', 'created_at' => $datetime, 'updated_at' => $datetime],
            ['name' => 'Zimbabwe Dollar', 'iso' => 'ZWD', 'created_at' => $datetime, 'updated_at' => $datetime],
        ];
        
        $this->db->table('currencies')->insertBatch($data);
    }
}
ALTER TABLE layanan_sub
  ADD COLUMN nama_layanan character varying;

ALTER TABLE layanan
  ADD COLUMN nama_layanan character varying;
  
ALTER TABLE wni_layanan
  ADD COLUMN nama_layanan character varying;
  
ALTER TABLE app_history
   ALTER COLUMN history_time SET DEFAULT now();

/*
create table app_wni (
  id serial NOT NULL,
  full_name character varying,
  alias_name character varying,
  gender character varying,
  birth_city character varying,
  birth_country character varying,
  birth_date date,
  email character varying,
  agamaid smallint,
  statuskawinid smallint,
  jenkelid smallint,
  jenispasporid smallint,
  pkjaan_id integer,
  pkjaan_nama character varying,
  pkjaan_namakantor character varying,
  pkjaan_alamat character varying,
  pkjaan_kota character varying,
  pkjaan_kodepos character varying,
  pkjaan_provinsi character varying,
  pkjaan_negara character varying,
  pkjaan_telepon character varying,
  pkjaan_jinstansi integer,
  paspor_status smallint,
  paspor_nomor character varying,
  paspor_no_register character varying,
  paspor_tpt_keluar character varying,
  paspor_tgl_keluar date,
  paspor_berlaku date,
  pengenal_jenis integer,
  pengenal_nomor character varying,
  pengenal_tgl_keluar date,
  pengenal_tpt_keluar character varying,
  pengenal_berlaku date,
  izin_jenis integer,
  izin_nomor character varying,
  izin_tpt_keluar character varying,
  izin_tgl_keluar date,
  izin_berlaku date,
  aluar_alamat character varying,
  aluar_kota character varying,
  aluar_kodepos character varying,
  aluar_provinsi character varying,
  aluar_negara character varying,
  aluar_telepon character varying,
  aluar_hp character varying,
  aindo_alamat character varying,
  aindo_kota character varying,
  aindo_kodepos character varying,
  aindo_provinsi character varying,
  aindo_telepon character varying,
  aindo_hp character varying,
  kluar_nama character varying,
  kluar_alamat_sama smallint,
  kluar_alamat character varying,
  kluar_kota character varying,
  kluar_kodepos character varying,
  kluar_telepon character varying,
  kluar_hp character varying,
  kluar_hubungan character varying,
  kindo_nama character varying,
  kindo_alamat character varying,
  kindo_kota character varying,
  kindo_kodepos character varying,
  kindo_telepon character varying,
  kindo_hp character varying,
  kindo_alamat_sama smallint,
  kindo_hubungan character varying,
  ayah_ada smallint,
  ayah_nama character varying,
  ayah_wn character varying,
  ayah_tpt_lahir character varying,
  ayah_tgl_lahir date,
  ayah_alamat character varying,
  ayah_kota character varying,
  ayah_kodepos character varying,
  ayah_telepon character varying,
  ayah_hp character varying,
  ibu_ada smallint,
  ibu_nama character varying,
  ibu_wn character varying,
  ibu_tpt_lahir character varying,
  ibu_tgl_lahir date,
  ibu_alamat character varying,
  ibu_kota character varying,
  ibu_kodepos character varying,
  ibu_telepon character varying,
  ibu_hp character varying,
  ibu_alamat_sama smallint,
  pasangan_ada smallint,
  pasangan_hubungan character varying,
  pasangan_nama character varying,
  pasangan_wn character varying,
  pasangan_tpt_lahir character varying,
  pasangan_tgl_lahir date,
  pasangan_alamat character varying,
  pasangan_kota character varying,
  pasangan_kodepos character varying,
  pasangan_telepon character varying,
  pasangan_hp character varying,
  pasangan_alamat_sama smallint,
  ll_jenis_cacat character varying,
  ll_hak_pilih boolean,
  ll_dwi_wn boolean,
  ll_menjadi_wna boolean,
  ll_keterangan character varying,
  ll_tgl_pulang date,
  ll_tgl_tiba date,
  ll_tgl_lapor date,
  ll_keluar boolean,
  last_update timestamp with time zone DEFAULT now(),
  CONSTRAINT app_wni_pkey PRIMARY KEY (id)
)
;
*/

create table app_wni (
  id serial NOT NULL,
  hashid character varying,
  data_wni character varying,
  last_update timestamp with time zone DEFAULT now(),
  CONSTRAINT app_wni_pkey PRIMARY KEY (id)
)
;


create table jenis_instansi (
  id serial,
  nama character varying,
  CONSTRAINT jenis_instansi_pkey PRIMARY KEY (id)
)
;

insert into jenis_instansi(nama) values('Kantor');
insert into jenis_instansi(nama) values('Sekolah');
insert into jenis_instansi(nama) values('Salon');
insert into jenis_instansi(nama) values('Universitas');
insert into jenis_instansi(nama) values('PPPPTK Seni dan Budaya');

delete from country;
INSERT INTO country (countryid, countryname) VALUES (E'AF', E'Afghanistan');
INSERT INTO country (countryid, countryname) VALUES (E'AX', E'Åland Islands');
INSERT INTO country (countryid, countryname) VALUES (E'AL', E'Albania');
INSERT INTO country (countryid, countryname) VALUES (E'DZ', E'Algeria');
INSERT INTO country (countryid, countryname) VALUES (E'AS', E'American Samoa');
INSERT INTO country (countryid, countryname) VALUES (E'AD', E'Andorra');
INSERT INTO country (countryid, countryname) VALUES (E'AO', E'Angola');
INSERT INTO country (countryid, countryname) VALUES (E'AI', E'Anguilla');
INSERT INTO country (countryid, countryname) VALUES (E'AQ', E'Antarctica');
INSERT INTO country (countryid, countryname) VALUES (E'AG', E'Antigua & Barbuda');
INSERT INTO country (countryid, countryname) VALUES (E'AR', E'Argentina');
INSERT INTO country (countryid, countryname) VALUES (E'AM', E'Armenia');
INSERT INTO country (countryid, countryname) VALUES (E'AW', E'Aruba');
INSERT INTO country (countryid, countryname) VALUES (E'AC', E'Ascension Island');
INSERT INTO country (countryid, countryname) VALUES (E'AU', E'Australia');
INSERT INTO country (countryid, countryname) VALUES (E'AT', E'Austria');
INSERT INTO country (countryid, countryname) VALUES (E'AZ', E'Azerbaijan');
INSERT INTO country (countryid, countryname) VALUES (E'BS', E'Bahamas');
INSERT INTO country (countryid, countryname) VALUES (E'BH', E'Bahrain');
INSERT INTO country (countryid, countryname) VALUES (E'BD', E'Bangladesh');
INSERT INTO country (countryid, countryname) VALUES (E'BB', E'Barbados');
INSERT INTO country (countryid, countryname) VALUES (E'BY', E'Belarus');
INSERT INTO country (countryid, countryname) VALUES (E'BE', E'Belgium');
INSERT INTO country (countryid, countryname) VALUES (E'BZ', E'Belize');
INSERT INTO country (countryid, countryname) VALUES (E'BJ', E'Benin');
INSERT INTO country (countryid, countryname) VALUES (E'BM', E'Bermuda');
INSERT INTO country (countryid, countryname) VALUES (E'BT', E'Bhutan');
INSERT INTO country (countryid, countryname) VALUES (E'BO', E'Bolivia');
INSERT INTO country (countryid, countryname) VALUES (E'BA', E'Bosnia & Herzegovina');
INSERT INTO country (countryid, countryname) VALUES (E'BW', E'Botswana');
INSERT INTO country (countryid, countryname) VALUES (E'BR', E'Brazil');
INSERT INTO country (countryid, countryname) VALUES (E'IO', E'British Indian Ocean Territory');
INSERT INTO country (countryid, countryname) VALUES (E'VG', E'British Virgin Islands');
INSERT INTO country (countryid, countryname) VALUES (E'BN', E'Brunei');
INSERT INTO country (countryid, countryname) VALUES (E'BG', E'Bulgaria');
INSERT INTO country (countryid, countryname) VALUES (E'BF', E'Burkina Faso');
INSERT INTO country (countryid, countryname) VALUES (E'BI', E'Burundi');
INSERT INTO country (countryid, countryname) VALUES (E'KH', E'Cambodia');
INSERT INTO country (countryid, countryname) VALUES (E'CM', E'Cameroon');
INSERT INTO country (countryid, countryname) VALUES (E'CA', E'Canada');
INSERT INTO country (countryid, countryname) VALUES (E'IC', E'Canary Islands');
INSERT INTO country (countryid, countryname) VALUES (E'CV', E'Cape Verde');
INSERT INTO country (countryid, countryname) VALUES (E'BQ', E'Caribbean Netherlands');
INSERT INTO country (countryid, countryname) VALUES (E'KY', E'Cayman Islands');
INSERT INTO country (countryid, countryname) VALUES (E'CF', E'Central African Republic');
INSERT INTO country (countryid, countryname) VALUES (E'EA', E'Ceuta & Melilla');
INSERT INTO country (countryid, countryname) VALUES (E'TD', E'Chad');
INSERT INTO country (countryid, countryname) VALUES (E'CL', E'Chile');
INSERT INTO country (countryid, countryname) VALUES (E'CN', E'China');
INSERT INTO country (countryid, countryname) VALUES (E'CX', E'Christmas Island');
INSERT INTO country (countryid, countryname) VALUES (E'CC', E'Cocos (Keeling) Islands');
INSERT INTO country (countryid, countryname) VALUES (E'CO', E'Colombia');
INSERT INTO country (countryid, countryname) VALUES (E'KM', E'Comoros');
INSERT INTO country (countryid, countryname) VALUES (E'CG', E'Congo - Brazzaville');
INSERT INTO country (countryid, countryname) VALUES (E'CD', E'Congo - Kinshasa');
INSERT INTO country (countryid, countryname) VALUES (E'CK', E'Cook Islands');
INSERT INTO country (countryid, countryname) VALUES (E'CR', E'Costa Rica');
INSERT INTO country (countryid, countryname) VALUES (E'CI', E'Côte d’Ivoire');
INSERT INTO country (countryid, countryname) VALUES (E'HR', E'Croatia');
INSERT INTO country (countryid, countryname) VALUES (E'CU', E'Cuba');
INSERT INTO country (countryid, countryname) VALUES (E'CW', E'Curaçao');
INSERT INTO country (countryid, countryname) VALUES (E'CY', E'Cyprus');
INSERT INTO country (countryid, countryname) VALUES (E'CZ', E'Czech Republic');
INSERT INTO country (countryid, countryname) VALUES (E'DK', E'Denmark');
INSERT INTO country (countryid, countryname) VALUES (E'DG', E'Diego Garcia');
INSERT INTO country (countryid, countryname) VALUES (E'DJ', E'Djibouti');
INSERT INTO country (countryid, countryname) VALUES (E'DM', E'Dominica');
INSERT INTO country (countryid, countryname) VALUES (E'DO', E'Dominican Republic');
INSERT INTO country (countryid, countryname) VALUES (E'EC', E'Ecuador');
INSERT INTO country (countryid, countryname) VALUES (E'EG', E'Egypt');
INSERT INTO country (countryid, countryname) VALUES (E'SV', E'El Salvador');
INSERT INTO country (countryid, countryname) VALUES (E'GQ', E'Equatorial Guinea');
INSERT INTO country (countryid, countryname) VALUES (E'ER', E'Eritrea');
INSERT INTO country (countryid, countryname) VALUES (E'EE', E'Estonia');
INSERT INTO country (countryid, countryname) VALUES (E'ET', E'Ethiopia');
INSERT INTO country (countryid, countryname) VALUES (E'FK', E'Falkland Islands');
INSERT INTO country (countryid, countryname) VALUES (E'FO', E'Faroe Islands');
INSERT INTO country (countryid, countryname) VALUES (E'FJ', E'Fiji');
INSERT INTO country (countryid, countryname) VALUES (E'FI', E'Finland');
INSERT INTO country (countryid, countryname) VALUES (E'FR', E'France');
INSERT INTO country (countryid, countryname) VALUES (E'GF', E'French Guiana');
INSERT INTO country (countryid, countryname) VALUES (E'PF', E'French Polynesia');
INSERT INTO country (countryid, countryname) VALUES (E'TF', E'French Southern Territories');
INSERT INTO country (countryid, countryname) VALUES (E'GA', E'Gabon');
INSERT INTO country (countryid, countryname) VALUES (E'GM', E'Gambia');
INSERT INTO country (countryid, countryname) VALUES (E'GE', E'Georgia');
INSERT INTO country (countryid, countryname) VALUES (E'DE', E'Germany');
INSERT INTO country (countryid, countryname) VALUES (E'GH', E'Ghana');
INSERT INTO country (countryid, countryname) VALUES (E'GI', E'Gibraltar');
INSERT INTO country (countryid, countryname) VALUES (E'GR', E'Greece');
INSERT INTO country (countryid, countryname) VALUES (E'GL', E'Greenland');
INSERT INTO country (countryid, countryname) VALUES (E'GD', E'Grenada');
INSERT INTO country (countryid, countryname) VALUES (E'GP', E'Guadeloupe');
INSERT INTO country (countryid, countryname) VALUES (E'GU', E'Guam');
INSERT INTO country (countryid, countryname) VALUES (E'GT', E'Guatemala');
INSERT INTO country (countryid, countryname) VALUES (E'GG', E'Guernsey');
INSERT INTO country (countryid, countryname) VALUES (E'GN', E'Guinea');
INSERT INTO country (countryid, countryname) VALUES (E'GW', E'Guinea-Bissau');
INSERT INTO country (countryid, countryname) VALUES (E'GY', E'Guyana');
INSERT INTO country (countryid, countryname) VALUES (E'HT', E'Haiti');
INSERT INTO country (countryid, countryname) VALUES (E'HN', E'Honduras');
INSERT INTO country (countryid, countryname) VALUES (E'HK', E'Hong Kong SAR China');
INSERT INTO country (countryid, countryname) VALUES (E'HU', E'Hungary');
INSERT INTO country (countryid, countryname) VALUES (E'IS', E'Iceland');
INSERT INTO country (countryid, countryname) VALUES (E'IN', E'India');
INSERT INTO country (countryid, countryname) VALUES (E'ID', E'Indonesia');
INSERT INTO country (countryid, countryname) VALUES (E'IR', E'Iran');
INSERT INTO country (countryid, countryname) VALUES (E'IQ', E'Iraq');
INSERT INTO country (countryid, countryname) VALUES (E'IE', E'Ireland');
INSERT INTO country (countryid, countryname) VALUES (E'IM', E'Isle of Man');
INSERT INTO country (countryid, countryname) VALUES (E'IL', E'Israel');
INSERT INTO country (countryid, countryname) VALUES (E'IT', E'Italy');
INSERT INTO country (countryid, countryname) VALUES (E'JM', E'Jamaica');
INSERT INTO country (countryid, countryname) VALUES (E'JP', E'Japan');
INSERT INTO country (countryid, countryname) VALUES (E'JE', E'Jersey');
INSERT INTO country (countryid, countryname) VALUES (E'JO', E'Jordan');
INSERT INTO country (countryid, countryname) VALUES (E'KZ', E'Kazakhstan');
INSERT INTO country (countryid, countryname) VALUES (E'KE', E'Kenya');
INSERT INTO country (countryid, countryname) VALUES (E'KI', E'Kiribati');
INSERT INTO country (countryid, countryname) VALUES (E'XK', E'Kosovo');
INSERT INTO country (countryid, countryname) VALUES (E'KW', E'Kuwait');
INSERT INTO country (countryid, countryname) VALUES (E'KG', E'Kyrgyzstan');
INSERT INTO country (countryid, countryname) VALUES (E'LA', E'Laos');
INSERT INTO country (countryid, countryname) VALUES (E'LV', E'Latvia');
INSERT INTO country (countryid, countryname) VALUES (E'LB', E'Lebanon');
INSERT INTO country (countryid, countryname) VALUES (E'LS', E'Lesotho');
INSERT INTO country (countryid, countryname) VALUES (E'LR', E'Liberia');
INSERT INTO country (countryid, countryname) VALUES (E'LY', E'Libya');
INSERT INTO country (countryid, countryname) VALUES (E'LI', E'Liechtenstein');
INSERT INTO country (countryid, countryname) VALUES (E'LT', E'Lithuania');
INSERT INTO country (countryid, countryname) VALUES (E'LU', E'Luxembourg');
INSERT INTO country (countryid, countryname) VALUES (E'MO', E'Macau SAR China');
INSERT INTO country (countryid, countryname) VALUES (E'MK', E'Macedonia');
INSERT INTO country (countryid, countryname) VALUES (E'MG', E'Madagascar');
INSERT INTO country (countryid, countryname) VALUES (E'MW', E'Malawi');
INSERT INTO country (countryid, countryname) VALUES (E'MY', E'Malaysia');
INSERT INTO country (countryid, countryname) VALUES (E'MV', E'Maldives');
INSERT INTO country (countryid, countryname) VALUES (E'ML', E'Mali');
INSERT INTO country (countryid, countryname) VALUES (E'MT', E'Malta');
INSERT INTO country (countryid, countryname) VALUES (E'MH', E'Marshall Islands');
INSERT INTO country (countryid, countryname) VALUES (E'MQ', E'Martinique');
INSERT INTO country (countryid, countryname) VALUES (E'MR', E'Mauritania');
INSERT INTO country (countryid, countryname) VALUES (E'MU', E'Mauritius');
INSERT INTO country (countryid, countryname) VALUES (E'YT', E'Mayotte');
INSERT INTO country (countryid, countryname) VALUES (E'MX', E'Mexico');
INSERT INTO country (countryid, countryname) VALUES (E'FM', E'Micronesia');
INSERT INTO country (countryid, countryname) VALUES (E'MD', E'Moldova');
INSERT INTO country (countryid, countryname) VALUES (E'MC', E'Monaco');
INSERT INTO country (countryid, countryname) VALUES (E'MN', E'Mongolia');
INSERT INTO country (countryid, countryname) VALUES (E'ME', E'Montenegro');
INSERT INTO country (countryid, countryname) VALUES (E'MS', E'Montserrat');
INSERT INTO country (countryid, countryname) VALUES (E'MA', E'Morocco');
INSERT INTO country (countryid, countryname) VALUES (E'MZ', E'Mozambique');
INSERT INTO country (countryid, countryname) VALUES (E'MM', E'Myanmar (Burma)');
INSERT INTO country (countryid, countryname) VALUES (E'NA', E'Namibia');
INSERT INTO country (countryid, countryname) VALUES (E'NR', E'Nauru');
INSERT INTO country (countryid, countryname) VALUES (E'NP', E'Nepal');
INSERT INTO country (countryid, countryname) VALUES (E'NL', E'Netherlands');
INSERT INTO country (countryid, countryname) VALUES (E'NC', E'New Caledonia');
INSERT INTO country (countryid, countryname) VALUES (E'NZ', E'New Zealand');
INSERT INTO country (countryid, countryname) VALUES (E'NI', E'Nicaragua');
INSERT INTO country (countryid, countryname) VALUES (E'NE', E'Niger');
INSERT INTO country (countryid, countryname) VALUES (E'NG', E'Nigeria');
INSERT INTO country (countryid, countryname) VALUES (E'NU', E'Niue');
INSERT INTO country (countryid, countryname) VALUES (E'NF', E'Norfolk Island');
INSERT INTO country (countryid, countryname) VALUES (E'KP', E'North Korea');
INSERT INTO country (countryid, countryname) VALUES (E'MP', E'Northern Mariana Islands');
INSERT INTO country (countryid, countryname) VALUES (E'NO', E'Norway');
INSERT INTO country (countryid, countryname) VALUES (E'OM', E'Oman');
INSERT INTO country (countryid, countryname) VALUES (E'PK', E'Pakistan');
INSERT INTO country (countryid, countryname) VALUES (E'PW', E'Palau');
INSERT INTO country (countryid, countryname) VALUES (E'PS', E'Palestinian Territories');
INSERT INTO country (countryid, countryname) VALUES (E'PA', E'Panama');
INSERT INTO country (countryid, countryname) VALUES (E'PG', E'Papua New Guinea');
INSERT INTO country (countryid, countryname) VALUES (E'PY', E'Paraguay');
INSERT INTO country (countryid, countryname) VALUES (E'PE', E'Peru');
INSERT INTO country (countryid, countryname) VALUES (E'PH', E'Philippines');
INSERT INTO country (countryid, countryname) VALUES (E'PN', E'Pitcairn Islands');
INSERT INTO country (countryid, countryname) VALUES (E'PL', E'Poland');
INSERT INTO country (countryid, countryname) VALUES (E'PT', E'Portugal');
INSERT INTO country (countryid, countryname) VALUES (E'PR', E'Puerto Rico');
INSERT INTO country (countryid, countryname) VALUES (E'QA', E'Qatar');
INSERT INTO country (countryid, countryname) VALUES (E'RE', E'Réunion');
INSERT INTO country (countryid, countryname) VALUES (E'RO', E'Romania');
INSERT INTO country (countryid, countryname) VALUES (E'RU', E'Russia');
INSERT INTO country (countryid, countryname) VALUES (E'RW', E'Rwanda');
INSERT INTO country (countryid, countryname) VALUES (E'WS', E'Samoa');
INSERT INTO country (countryid, countryname) VALUES (E'SM', E'San Marino');
INSERT INTO country (countryid, countryname) VALUES (E'ST', E'São Tomé & Príncipe');
INSERT INTO country (countryid, countryname) VALUES (E'SA', E'Saudi Arabia');
INSERT INTO country (countryid, countryname) VALUES (E'SN', E'Senegal');
INSERT INTO country (countryid, countryname) VALUES (E'RS', E'Serbia');
INSERT INTO country (countryid, countryname) VALUES (E'SC', E'Seychelles');
INSERT INTO country (countryid, countryname) VALUES (E'SL', E'Sierra Leone');
INSERT INTO country (countryid, countryname) VALUES (E'SG', E'Singapore');
INSERT INTO country (countryid, countryname) VALUES (E'SX', E'Sint Maarten');
INSERT INTO country (countryid, countryname) VALUES (E'SK', E'Slovakia');
INSERT INTO country (countryid, countryname) VALUES (E'SI', E'Slovenia');
INSERT INTO country (countryid, countryname) VALUES (E'SB', E'Solomon Islands');
INSERT INTO country (countryid, countryname) VALUES (E'SO', E'Somalia');
INSERT INTO country (countryid, countryname) VALUES (E'ZA', E'South Africa');
INSERT INTO country (countryid, countryname) VALUES (E'GS', E'South Georgia & South Sandwich Islands');
INSERT INTO country (countryid, countryname) VALUES (E'KR', E'South Korea');
INSERT INTO country (countryid, countryname) VALUES (E'SS', E'South Sudan');
INSERT INTO country (countryid, countryname) VALUES (E'ES', E'Spain');
INSERT INTO country (countryid, countryname) VALUES (E'LK', E'Sri Lanka');
INSERT INTO country (countryid, countryname) VALUES (E'BL', E'St. Barthélemy');
INSERT INTO country (countryid, countryname) VALUES (E'SH', E'St. Helena');
INSERT INTO country (countryid, countryname) VALUES (E'KN', E'St. Kitts & Nevis');
INSERT INTO country (countryid, countryname) VALUES (E'LC', E'St. Lucia');
INSERT INTO country (countryid, countryname) VALUES (E'MF', E'St. Martin');
INSERT INTO country (countryid, countryname) VALUES (E'PM', E'St. Pierre & Miquelon');
INSERT INTO country (countryid, countryname) VALUES (E'VC', E'St. Vincent & Grenadines');
INSERT INTO country (countryid, countryname) VALUES (E'SD', E'Sudan');
INSERT INTO country (countryid, countryname) VALUES (E'SR', E'Suriname');
INSERT INTO country (countryid, countryname) VALUES (E'SJ', E'Svalbard & Jan Mayen');
INSERT INTO country (countryid, countryname) VALUES (E'SZ', E'Swaziland');
INSERT INTO country (countryid, countryname) VALUES (E'SE', E'Sweden');
INSERT INTO country (countryid, countryname) VALUES (E'CH', E'Switzerland');
INSERT INTO country (countryid, countryname) VALUES (E'SY', E'Syria');
INSERT INTO country (countryid, countryname) VALUES (E'TW', E'Taiwan');
INSERT INTO country (countryid, countryname) VALUES (E'TJ', E'Tajikistan');
INSERT INTO country (countryid, countryname) VALUES (E'TZ', E'Tanzania');
INSERT INTO country (countryid, countryname) VALUES (E'TH', E'Thailand');
INSERT INTO country (countryid, countryname) VALUES (E'TL', E'Timor-Leste');
INSERT INTO country (countryid, countryname) VALUES (E'TG', E'Togo');
INSERT INTO country (countryid, countryname) VALUES (E'TK', E'Tokelau');
INSERT INTO country (countryid, countryname) VALUES (E'TO', E'Tonga');
INSERT INTO country (countryid, countryname) VALUES (E'TT', E'Trinidad & Tobago');
INSERT INTO country (countryid, countryname) VALUES (E'TA', E'Tristan da Cunha');
INSERT INTO country (countryid, countryname) VALUES (E'TN', E'Tunisia');
INSERT INTO country (countryid, countryname) VALUES (E'TR', E'Turkey');
INSERT INTO country (countryid, countryname) VALUES (E'TM', E'Turkmenistan');
INSERT INTO country (countryid, countryname) VALUES (E'TC', E'Turks & Caicos Islands');
INSERT INTO country (countryid, countryname) VALUES (E'TV', E'Tuvalu');
INSERT INTO country (countryid, countryname) VALUES (E'UM', E'U.S. Outlying Islands');
INSERT INTO country (countryid, countryname) VALUES (E'VI', E'U.S. Virgin Islands');
INSERT INTO country (countryid, countryname) VALUES (E'UG', E'Uganda');
INSERT INTO country (countryid, countryname) VALUES (E'UA', E'Ukraine');
INSERT INTO country (countryid, countryname) VALUES (E'AE', E'United Arab Emirates');
INSERT INTO country (countryid, countryname) VALUES (E'GB', E'United Kingdom');
INSERT INTO country (countryid, countryname) VALUES (E'US', E'United States');
INSERT INTO country (countryid, countryname) VALUES (E'UY', E'Uruguay');
INSERT INTO country (countryid, countryname) VALUES (E'UZ', E'Uzbekistan');
INSERT INTO country (countryid, countryname) VALUES (E'VU', E'Vanuatu');
INSERT INTO country (countryid, countryname) VALUES (E'VA', E'Vatican City');
INSERT INTO country (countryid, countryname) VALUES (E'VE', E'Venezuela');
INSERT INTO country (countryid, countryname) VALUES (E'VN', E'Vietnam');
INSERT INTO country (countryid, countryname) VALUES (E'WF', E'Wallis & Futuna');
INSERT INTO country (countryid, countryname) VALUES (E'EH', E'Western Sahara');
INSERT INTO country (countryid, countryname) VALUES (E'YE', E'Yemen');
INSERT INTO country (countryid, countryname) VALUES (E'ZM', E'Zambia');
INSERT INTO country (countryid, countryname) VALUES (E'ZW', E'Zimbabwe');


ALTER TABLE wni_layanan_attch
  ADD COLUMN last_update timestamp with time zone DEFAULT now();

CREATE TABLE app_wni_attch
(
  id serial NOT NULL,
  attch_type_id integer,
  wniid integer,
  nama_layanan character varying,
  wni_layanan_id integer,
  last_update timestamp with time zone DEFAULT now(),
  fileid integer,
  hashid character varying,
  CONSTRAINT wni_attch_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);


INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'check_cekal_reg', NULL, NULL, 0, 1, 0, 'crud', 'check_cekal_reg', 1, NULL, NULL, 1);

ALTER TABLE layanan
  ADD COLUMN viewindex integer;

ALTER TABLE layanan_sub
  ADD COLUMN viewindex integer;
  
delete from layanan_sub;
delete from layanan;

INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (1, 'Penggantian Paspor', 'ganti-paspor', 10);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (2, 'Pembuatan Paspor Baru untuk Anak', 'paspor-baru-anak', 20);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (3, 'Perubahan/Konversi Data di Paspor', NULL, 0);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (6, 'Pelaporan Meninggal', NULL, 0);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (7, 'Lapor Diri', NULL, 30);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (4, 'Pelaporan Keluar dari Belgia untuk Seterusnya (Pulang Habis)', NULL, 110);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (5, 'Pindah Kewarganegaraan', NULL, 120);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (8, 'Registrasi', 'registrasi', 0);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (10, 'Lapor Pernikahan/Cerai', 'nikah_cerai', 40);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (11, 'Layanan Lapor Kelahiran', 'kelahiran', 50);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (12, 'Layanan Lapor Kematian', 'kematian', 60);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (13, 'Layanan Lapor Pindah Alamat', 'pindah_alamat', 70);
INSERT INTO layanan (id, nama, nama_layanan, viewindex) VALUES (9, 'SPLP', 'splp', 80);

SELECT pg_catalog.setval('layanan_id_seq', 13, true);

INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (1, 1, 'Halaman paspor penuh', 'ganti_paspor', 20, NULL, 1);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (2, 1, 'Paspor rusak', 'ganti_paspor', 20, NULL, 2);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (3, 1, 'Paspor habis masa berlaku', 'ganti_paspor', 20, NULL, 3);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (4, 1, 'Paspor hilang', 'paspor_hilang', 40, NULL, 4);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (5, 1, 'Lain-lain', NULL, 40, NULL, 5);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (6, 2, 'Anak yang baru lahir', NULL, 15, NULL, 1);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (7, 2, 'Anak dengan kewarganegaraan ganda yang lahir setelah 1 Agustus 2006', NULL, 15, NULL, 2);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (8, 2, 'Anak dengan kewarganegaraan ganda yang lahir sebelum 1 Agustus 2006', NULL, 15, NULL, 3);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (9, 2, 'Anak lahir di luar nikah', NULL, 15, NULL, 4);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (24, 11, '-', NULL, NULL, NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (20, 7, '-', NULL, NULL, NULL, 1);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (18, 5, '-', NULL, NULL, NULL, 1);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (19, 6, '-', NULL, NULL, NULL, 0);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (17, 4, '-', NULL, NULL, NULL, 1);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (21, 9, '-', NULL, NULL, NULL, 1);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (25, 12, '-', NULL, NULL, NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (26, 13, '-', NULL, NULL, NULL, NULL);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (99, 8, '-', 'update_data', NULL, NULL, 0);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (22, 10, 'Lapor Menikah', NULL, NULL, 'lapor-menikah', 1);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (23, 10, 'Lapor Cerai', NULL, NULL, 'lapor-cerai', 2);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (10, 3, 'Ganti Nama karena menikah', NULL, NULL, NULL, 0);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (11, 3, 'Ganti Nama karena cerai', NULL, NULL, NULL, 0);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (12, 3, 'Ganti Alamat', NULL, NULL, NULL, 0);
INSERT INTO layanan_sub (id, layananid, nama, attach_category, biaya, nama_layanan, viewindex) VALUES (13, 3, 'Ganti Status Pekerjaan', NULL, NULL, NULL, 0);

SELECT pg_catalog.setval('layanan_sub_id_seq', 26, true);

INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'edit_layanan_kelahiran', NULL, NULL, 0, 1, 0, 'crud', 'edit_layanan_kelahiran', 1, NULL, NULL, 1);
INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) VALUES (NULL, 'layanan_kelahiran', NULL, NULL, 0, 1, 0, 'crud', 'layanan_kelahiran', 1, NULL, NULL, 1);

<?php
function db_schema()
{
	$tables = array();

	$tables[] = array(
		'name' => 'banner',
		'field' => array(
			array(
				'name' => 'banner_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'name',
				'type' => 'varchar(64)',
				'not_null' => true
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true
			)
		),
		'primary' => array(
			'banner_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);

	$tables[] = array(
		'name' => 'banner_image',
		'field' => array(
			array(
				'name' => 'banner_image_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'banner_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'language_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'title',
				'type' => 'varchar(64)',
				'not_null' => true
			),
			array(
				'name' => 'link',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'image',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'sort_order',
				'type' => 'int(3)',
				'not_null' => true,
				'default' => '0'
			)
		),
		'primary' => array(
			'banner_image_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
        
        $tables[] = array(
        'name' => 'category',
        'field' => array(
                array(
                        'name' => 'category_id',
                        'type' => 'int(11)',
                        'not_null' => true,
                        'auto_increment' => true
                ),
                array(
                        'name' => 'name',
                        'type' => 'varchar(255)',
                        'not_null' => true
                ),
                array(
                        'name' => 'sort_order',
                        'type' => 'int(3)',
                        'not_null' => true,
                        'default' => '0'
                ),
                array(
                        'name' => 'status',
                        'type' => 'tinyint(1)',
                        'not_null' => true
                ),
                array(
                        'name' => 'date_added',
                        'type' => 'datetime',
                        'not_null' => true
                ),
                array(
                        'name' => 'date_modified',
                        'type' => 'datetime',
                        'not_null' => true
                )
        ),
        'primary' => array(
                'category_id'
        ),
        'engine' => 'InnoDB',
        'charset' => 'utf8',
        'collate' => 'utf8_general_ci'
	);
                
	$tables[] = array(
		'name' => 'country',
		'field' => array(
			array(
				'name' => 'country_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'name',
				'type' => 'varchar(128)',
				'not_null' => true
			),
			array(
				'name' => 'iso_code_2',
				'type' => 'varchar(2)',
				'not_null' => true
			),
			array(
				'name' => 'iso_code_3',
				'type' => 'varchar(3)',
				'not_null' => true
			),
			array(
				'name' => 'address_format',
				'type' => 'text',
				'not_null' => true
			),
			array(
				'name' => 'postcode_required',
				'type' => 'tinyint(1)',
				'not_null' => true
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true,
				'default' => '1'
			)
		),
		'primary' => array(
			'country_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
	
                
	$tables[] = array(
		'name' => 'club',
		'field' => array(
			array(
				'name' => 'club_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'club_name',
				'type' => 'varchar(128)',
				'not_null' => true
			),
                        array(
                                'name' => 'date',
                                'type' => 'date',
                                'not_null' => true
                        ),
                        array(
				'name' => 'president',
				'type' => 'varchar(128)',
				'not_null' => true
			),
                        array(
				'name' => 'mobile',
				'type' => 'int(11)',
				'not_null' => true
			),
                        array(
				'name' => 'email',
				'type' => 'varchar(96)',
				'not_null' => true
			),
			array(
				'name' => 'password',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'website',
				'type' => 'varchar(96)',
				'not_null' => true
			),
                        array(
				'name' => 'image',
				'type' => 'varchar(255)',
				'not_null' => true
			),
                        array(
				'name' => 'ip',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true,
				'default' => '1'
			),
                        array(
				'name' => 'date_added',
				'type' => 'datetime',
				'not_null' => true
			),
			array(
				'name' => 'date_modified',
				'type' => 'datetime',
				'not_null' => true
			)
		),
		'primary' => array(
			'club_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
	
	$tables[] = array(
		'name' => 'event',
		'field' => array(
			array(
				'name' => 'event_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'code',
				'type' => 'varchar(64)',
				'not_null' => true
			),
			array(
				'name' => 'trigger',
				'type' => 'text',
				'not_null' => true
			),
			array(
				'name' => 'action',
				'type' => 'text',
				'not_null' => true
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true,
				'default' => '0'
			),
			array(
				'name' => 'sort_order',
				'type' => 'int(3)',
				'not_null' => true,
				'sort_order' => '1'
			)
		),
		'primary' => array(
			'event_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);

	$tables[] = array(
		'name' => 'information',
		'field' => array(
			array(
				'name' => 'information_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'image',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'sort_order',
				'type' => 'int(3)',
				'not_null' => true,
				'default' => '0'
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true,
				'default' => '1'
			),
			array(
				'name' => 'date_added',
				'type' => 'datetime',
				'not_null' => true
			),
			array(
				'name' => 'date_modified',
				'type' => 'datetime',
				'not_null' => true
			)
		),
		'primary' => array(
			'information_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);

	$tables[] = array(
		'name' => 'information_description',
		'field' => array(
			array(
				'name' => 'information_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'language_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'title',
				'type' => 'varchar(64)',
				'not_null' => true
			),
			array(
				'name' => 'description',
				'type' => 'mediumtext',
				'not_null' => true
			),
			array(
				'name' => 'meta_title',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'meta_description',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'meta_keyword',
				'type' => 'varchar(255)',
				'not_null' => true
			)
		),
		'primary' => array(
			'information_id',
			'language_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);

	$tables[] = array(
		'name' => 'language',
		'field' => array(
			array(
				'name' => 'language_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'name',
				'type' => 'varchar(32)',
				'not_null' => true
			),
			array(
				'name' => 'code',
				'type' => 'varchar(5)',
				'not_null' => true
			),
			array(
				'name' => 'locale',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'image',
				'type' => 'varchar(64)',
				'not_null' => true
			),
			array(
				'name' => 'sort_order',
				'type' => 'int(3)',
				'not_null' => true,
				'default' => '0'
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true
			)
		),
		'primary' => array(
			'language_id'
		),
		'index' => array(
			array(
				'name' => 'name',
				'key' => array(
					'name'
				)
			)
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
        
        $tables[] = array(
		'name' => 'member',
		'field' => array(
			array(
				'name' => 'member_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
                        array(
				'name' => 'club_id',
				'type' => 'int(11)',
				'not_null' => true
			),
                        array(
				'name' => 'date',
				'type' => 'date',
				'not_null' => true
			),
                        array(
				'name' => 'induction',
				'type' => 'int(11)',
				'not_null' => true
			),
                        array(
				'name' => 'unlist',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'net',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'points',
				'type' => 'float',
				'not_null' => true
			),
			array(
				'name' => 'review',
				'type' => 'float',
				'not_null' => true
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true,
				'default' => '1'
			),
			array(
				'name' => 'date_added',
				'type' => 'datetime',
				'not_null' => true
			)
		),
		'primary' => array(
			'member_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
        
        $tables[] = array(
		'name' => 'projects',
		'field' => array(
			array(
				'name' => 'project_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'club_id',
				'type' => 'int(11)',
				'not_null' => true
			),
                        array(
				'name' => 'date',
				'type' => 'date',
				'not_null' => true
			),
			array(
				'name' => 'title',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'description',
				'type' => 'text',
				'not_null' => true
			),
			array(
				'name' => 'amount',
				'type' => 'float',
				'not_null' => true
			),
			array(
				'name' => 'no_of_beneficiary',
				'type' => 'int',
				'not_null' => true
			),
			array(
				'name' => 'review',
				'type' => 'float',
				'not_null' => true
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true,
				'default' => '1'
			),
			array(
				'name' => 'date_added',
				'type' => 'datetime',
				'not_null' => true
			)
		),
		'primary' => array(
			'project_id',
		),

		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
        
        $tables[] = array(
		'name' => 'project_image',
		'field' => array(
			array(
				'name' => 'project_image_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'project_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'image',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'sort_order',
				'type' => 'int(3)',
				'not_null' => true,
				'default' => '0'
			)
		),
		'primary' => array(
			'project_image_id',
		),

		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
        
        $tables[] = array(
		'name' => 'project_to_category',
		'field' => array(
			array(
				'name' => 'project_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'category_id',
				'type' => 'int(11)',
				'not_null' => true
			)
		),
		'primary' => array(
			'project_id',
			'category_id'
		),

		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
        
	$tables[] = array(
		'name' => 'session',
		'field' => array(
			array(
				'name' => 'session_id',
				'type' => 'varchar(32)',
				'not_null' => true
			),
			array(
				'name' => 'data',
				'type' => 'text',
				'not_null' => true
			),
			array(
				'name' => 'expire',
				'type' => 'datetime',
				'not_null' => true
			)
		),
		'primary' => array(
			'session_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);

	$tables[] = array(
		'name' => 'setting',
		'field' => array(
			array(
				'name' => 'setting_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'store_id',
				'type' => 'int(11)',
				'not_null' => true,
				'default' => '0'
			),
			array(
				'name' => 'code',
				'type' => 'varchar(128)',
				'not_null' => true
			),
			array(
				'name' => 'key',
				'type' => 'varchar(128)',
				'not_null' => true
			),
			array(
				'name' => 'value',
				'type' => 'text',
				'not_null' => true
			),
			array(
				'name' => 'serialized',
				'type' => 'tinyint(1)',
				'not_null' => true
			)
		),
		'primary' => array(
			'setting_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
        
        $tables[] = array(
		'name' => 'trf',
		'field' => array(
			array(
				'name' => 'trf_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
                        array(
				'name' => 'club_id',
				'type' => 'int(11)',
				'not_null' => true
			),
                        array(
				'name' => 'date',
				'type' => 'date',
				'not_null' => true
			),
                        array(
				'name' => 'amount_inr',
				'type' => 'float',
				'not_null' => true
			),
                        array(
				'name' => 'exchange_rate',
				'type' => 'float',
				'not_null' => true
			),
                        array(
				'name' => 'amount_usd',
				'type' => 'float',
				'not_null' => true
			),
			array(
				'name' => 'review',
				'type' => 'float',
				'not_null' => true
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true,
				'default' => '1'
			),
			array(
				'name' => 'date_added',
				'type' => 'datetime',
				'not_null' => true
			)
		),
		'primary' => array(
			'trf_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
        
	$tables[] = array(
		'name' => 'unique_visitor',
		'field' => array(
			array(
				'name' => 'date',
				'type' => 'date',
				'not_null' => true
			),
			array(
				'name' => 'ip',
				'type' => 'text',
				'not_null' => true
			),
			array(
				'name' => 'url',
				'type' => 'text',
				'not_null' => true
			),
			array(
				'name' => 'referer',
				'type' => 'text',
				'not_null' => true
			),
			array(
				'name' => 'view',
				'type' => 'int(11)',
				'not_null' => true,
				'default' => '1'
			),
			array(
				'name' => 'date_added',
				'type' => 'datetime',
				'not_null' => true
			)
		),
		'primary' => array(
			'unique_visitor_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);

	$tables[] = array(
		'name' => 'user',
		'field' => array(
			array(
				'name' => 'user_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'user_group_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'login_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'image',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'name',
				'type' => 'varchar(20)',
				'not_null' => true
			),
			array(
				'name' => 'username',
				'type' => 'varchar(45)',
				'not_null' => true
			),
			array(
				'name' => 'designation',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'email',
				'type' => 'varchar(96)',
				'not_null' => true
			),
			array(
				'name' => 'password',
				'type' => 'varchar(255)',
				'not_null' => true
			),
			array(
				'name' => 'salt',
				'type' => 'varchar(9)',
				'not_null' => true
			),
			array(
				'name' => 'code',
				'type' => 'varchar(40)',
				'not_null' => true
			),
			array(
				'name' => 'ip',
				'type' => 'varchar(40)',
				'not_null' => true
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true
			),
			array(
				'name' => 'deleted',
				'type' => 'tinyint(1)',
				'not_null' => true
			),
			array(
				'name' => 'date_added',
				'type' => 'datetime',
				'not_null' => true
			),
			array(
				'name' => 'date_modified',
				'type' => 'datetime',
				'not_null' => true
			)
		),
		'primary' => array(
			'user_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);

	$tables[] = array(
		'name' => 'user_group',
		'field' => array(
			array(
				'name' => 'user_group_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'name',
				'type' => 'varchar(64)',
				'not_null' => true
			),
			array(
				'name' => 'permission',
				'type' => 'text',
				'not_null' => true
			)
		),
		'primary' => array(
			'user_group_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);
        
        $tables[] = array(
		'name' => 'user_to_club',
		'field' => array(
			array(
				'name' => 'user_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'club_id',
				'type' => 'int(11)',
				'not_null' => true
			)
		),
		'primary' => array(
			'user_id',
			'club_id'
		),
		'index' => array(
			array(
				'name' => 'club_id',
				'key' => array(
					'club_id'
				)
			)
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);

	$tables[] = array(
		'name' => 'zone',
		'field' => array(
			array(
				'name' => 'zone_id',
				'type' => 'int(11)',
				'not_null' => true,
				'auto_increment' => true
			),
			array(
				'name' => 'country_id',
				'type' => 'int(11)',
				'not_null' => true
			),
			array(
				'name' => 'name',
				'type' => 'varchar(128)',
				'not_null' => true
			),
			array(
				'name' => 'code',
				'type' => 'varchar(32)',
				'not_null' => true
			),
			array(
				'name' => 'status',
				'type' => 'tinyint(1)',
				'not_null' => true,
				'default' => '1'
			)
		),
		'primary' => array(
			'zone_id'
		),
		'engine' => 'InnoDB',
		'charset' => 'utf8',
		'collate' => 'utf8_general_ci'
	);

	return $tables;
}

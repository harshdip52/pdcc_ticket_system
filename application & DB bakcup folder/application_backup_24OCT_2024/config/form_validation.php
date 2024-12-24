<?php
$config = array( 
	'new_item_list' => array(
		 array(
			'field' => 'item_name',
			'label' => 'Item name',
			'rules' => 'required'
		),array(
			'field' => 'brand_id',
			'label' => 'brand ',
			'rules' => 'required'
		),array(
			'field' => 'cat_id',
			'label' => 'category Id',
			'rules' => 'required' 
		),array(
			'field' => 'sub_cat_id',
			'label' => 'Sub category',
			'rules' => 'required'
		),
	), 

	'edit_inventory' => array(
		array(
			'field' => 'id',
			'label' => 'id',
			'rules' => 'required'
		)
		),

	'assign_inventory' => array(
		array(
			'field' => 'taluka_id',
			'label' => 'Taluka',
			'rules' => 'required'
		)
		),


	'add_item' => array(
		array(
			'field' => 'cat_id',
			'label' => 'cat',
			'rules' => 'required'
		),
		array(
			'field' => 'sub_cat_id',
			'label' => 'sub_cat_id',
			'rules' => 'required'
		),
		array(
			'field' => 'item_name',
			'label' => 'item_name',
			'rules' => 'required'
		),

		),

	'add_taluka' => array
	(
		array
		(
			'field' => 'taluka_name',
			'label' => 'Taluka',
			'rules' => 'required'
		)
	),

	'add_zone' => array
	(
		array
		(
			'field' => 'taluka_id',
			'label' => 'Taluka',
			'rules' => 'required'
		),
		array
		(
			'field' => 'zone_name',
			'label' => 'Taluka',
			'rules' => 'required'
		)
	),

	'add_branch' => array
	(
		array
		(
			'field' => 'taluka_id',
			'label' => 'Taluka',
			'rules' => 'required'
		),
		array
		(
			'field' => 'zone_id',
			'label' => 'Zone',
			'rules' => 'required'
		),
		array
		(
			'field' => 'branch_name',
			'label' => 'Branch name',
			'rules' => 'required'
		),
	),

	'add_brand' => array
	(
		array
		(
			'field' => 'brand_name',
			'label' => 'Brand',
			'rules' => 'required'
		) 
	),
	'add_category' => array
	(
		array
		(
			'field' => 'cat_name',
			'label' => 'Brand',
			'rules' => 'required'
		) 
	),

	'add_sub_category' => array
	(
		array
		(
			'field' => 'cat_id',
			'label' => 'Brand',
			'rules' => 'required'
		),
		array
		(
			'field' => 'sub_cat_name',
			'label' => 'Brand',
			'rules' => 'required'
		) 

	),

	'users' => array
	(
		array
		(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required'
		),
		array
		(
			'field' => 'mobile',
			'label' => 'mobile',
			'rules' => 'required'
		), 
		 
		array
		(
			'field' => 'role',
			'label' => 'role',
			'rules' => 'required'
		) 
	),

	'login' => array(
		array(
			'field' => 'username',
			'label' => 'username',
			'rules' => 'required'
		),
		array(
			'field' => 'password',
			'label' => 'password',
			'rules' => 'required'
		)
		),

	'newTicket' => array(
		array(
			'field' => 'ticket_title',
			'label' => 'Ticket Title',
			'rules' => 'required'
		)
		// array(
		// 	'field' => 'description',
		// 	'label' => 'Description',
		// 	'rules' => 'required'
		// )
		),

	'ticketReplybySupport' => array(
		array(
			'field' => 'ticket_id',
			'label' => 'ticket_id',
			'rules' => 'required'
		),
		 
		),

	'ticketQuery' => array(
		array(
			'field' => 'ticket_query',
			'label' => 'remark',
			'rules' => 'required'
		),
		 
		),


	'ticketTitle' => array(
		array(
				'field' => 'cat_id',
				'label' => 'remark',
				'rules' => 'required'
			),

		array(
				'field' => 'sub_cat_id',
				'label' => 'remark',
				'rules' => 'required'
			),

		array(
				'field' => 'ticket_title',
				'label' => 'remark',
				'rules' => 'required'
			),
		),


	'create_inventory' => array(
		array(
				'field' => 'cat_id',
				'label' => 'remark',
				'rules' => 'required'
			),

		array(
				'field' => 'sub_cat_id',
				'label' => 'remark',
				'rules' => 'required'
			), 
		),

		'call_logs' => array(
		array(
				'field' => 'call_from',
				'label' => 'Call form',
				'rules' => 'required'
			),

		array(
				'field' => 'call_to',
				'label' => 'Call to',
				'rules' => 'required'
			), 
		),
 
 
 
);
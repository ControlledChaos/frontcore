<?php
/**
 * ACF fields for full-screen and wide featured image
 * header templates and theme options.
 *
 * @package    Front_Core
 * @subpackage Vendor/ACF
 * @category   Fields
 * @since      1.0.0
 */

$fields = apply_filters( 'fct_acf_featured_image_fields', [
	'key'    => 'group_673d6a219de90',
	'title'  => __( 'Featured Image Header', 'front-core' ),
	'fields' => [
		[
			'key'               => 'field_673d6a9bd93d0',
			'label'             => __( 'Title over Featured Image', 'front-core' ),
			'name'              => 'fct_cover_image_title',
			'type'              => 'text',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => [
				'width' => '50',
				'class' => '',
				'id'    => '',
			],
			'acf-column-enabled'    => 0,
			'acf-column-post_types' => '',
			'acf-column-taxonomies' => [
				0  => 'category',
				1  => 'post_tag',
				2  => 'link_category',
				3  => 'wp_pattern_category',
				4  => 'event-tags',
				5  => 'event-categories',
				6  => 'acf-field-group-category',
				7  => 'jobpost_category',
				8  => 'jobpost_job_type',
				9  => 'jobpost_location',
				10 => 'jobpost_tag',
				11 => 'menu_type',
				12 => 'menu_side',
				13 => 'media_type',
			],
			'default_value' => '',
			'placeholder'   => '',
			'prepend'       => '',
			'append'        => '',
			'maxlength'     => '',
			'acfe_field_group_condition' => 0,
		],
		[
			'key'               => 'field_673dfd1d0e1a0',
			'label'             => __( 'Description over Featured Image', 'front-core' ),
			'name'              => 'fct_cover_image_description',
			'type'              => 'text',
			'instructions'      => '',
			'required'          => 0,
			'conditional_logic' => 0,
			'wrapper'           => [
				'width' => '50',
				'class' => '',
				'id'    => '',
			],
			'acf-column-enabled'    => 0,
			'acf-column-post_types' => '',
			'acf-column-taxonomies' => [
				0  => 'category',
				1  => 'post_tag',
				2  => 'link_category',
				3  => 'wp_pattern_category',
				4  => 'event-tags',
				5  => 'event-categories',
				6  => 'acf-field-group-category',
				7  => 'jobpost_category',
				8  => 'jobpost_job_type',
				9  => 'jobpost_location',
				10 => 'jobpost_tag',
				11 => 'menu_type',
				12 => 'menu_side',
				13 => 'media_type',
			],
			'default_value' => '',
			'placeholder'   => '',
			'prepend'       => '',
			'append'        => '',
			'maxlength'     => '',
			'acfe_field_group_condition' => 0,
		],
	],
	'location' => [
		[
			[
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'page',
			],
			[
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => FCT_TMPL_DIR . '/featured-full-no-sidebar.php',
			],
		],
		[
			[
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'page',
			],
			[
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => FCT_TMPL_DIR . '/featured-full.php',
			],
		],
		[
			[
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'page',
			],
			[
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => FCT_TMPL_DIR . '/featured-wide.php',
			],
		],
		[
			[
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'page',
			],
			[
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => FCT_TMPL_DIR . '/featured-wide-no-sidebar.php',
			],
		],
	],
	'menu_order'      => 0,
	'position'        => 'acf_after_title',
	'style'           => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen'  => '',
	'active'          => true,
	'description'     => '',
	'acfe_autosync'   => [
		0 => 'json',
	],
	'acfe_form' => 0,
	'acfe_display_title' => '',
	'acfe_meta' => '',
	'acfe_note' => '',
] );

acf_add_local_field_group( $fields );

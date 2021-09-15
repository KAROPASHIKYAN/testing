<?php
/**
 * Plugin Name: Testing
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

add_action( 'init', 'myplugin_setup_post_type' );
function myplugin_setup_post_type(){
	

		$args = array('public'    => true,
	              'supports'  => array('title'),
	              'label'    => 'Quiz',
	              'map_meta_cap'      => true,
	              'rewrite'           => array(
		              'slug'       => 'quiz',
		              'with_front' => false,
		              'pages'      => false
	              )

	);
	register_post_type('quiz', $args);
}

add_filter( 'template_include', 'my_template' );
function my_template($template){

	global $post;
	if( $post->post_type == 'quiz' ){
		return wp_normalize_path( WP_PLUGIN_DIR ) . '/testing/single-quiz.php';
	}
}


add_action('init', 'acf_quiz');
//ACF
	function acf_quiz(){		
			if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_6140a469eb3ba',
	'title' => 'Quiz',
	'fields' => array(
		array(
			'key' => 'field_6140a493e6198',
			'label' => 'Quizes',
			'name' => 'quizes',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'block',
			'button_label' => 'Add question',
			'sub_fields' => array(
				array(
					'key' => 'field_6140a4e3e6199',
					'label' => 'Question',
					'name' => 'question',
					'type' => 'textarea',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => '',
					'rows' => 4,
					'new_lines' => 'br',
					'translations' => 'translate',
				),
				array(
					'key' => 'field_6140a55bbeecd',
					'label' => 'Answers',
					'name' => 'answers',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => '',
					'min' => 0,
					'max' => 0,
					'layout' => 'block',
					'button_label' => 'Add answer',
					'sub_fields' => array(
						array(
							'key' => 'field_6140a63cbeece',
							'label' => 'Answer',
							'name' => 'answer',
							'type' => 'text',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '75',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'maxlength' => '',
							'translations' => 'translate',
						),
						array(
							'key' => 'field_6140a6d4beecf',
							'label' => 'Correct',
							'name' => 'correct',
							'type' => 'true_false',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '25',
								'class' => '',
								'id' => '',
							),
							'message' => 'This answer is correct?',
							'default_value' => 0,
							'ui' => 1,
							'ui_on_text' => 'Yes',
							'ui_off_text' => 'No',
							'translations' => 'sync',
						),
					),
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'quiz',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;
}	
//ACF end

register_activation_hook( __FILE__, 'myplugin_install' ); 
function myplugin_install(){
	// Запускаем функцию регистрации типа записи
	myplugin_setup_post_type();
	acf_quiz();
	my_template();

	// Сбрасываем настройки ЧПУ, чтобы они пересоздались с новыми данными
	flush_rewrite_rules();
}








register_deactivation_hook( __FILE__, 'myplugin_deactivation' );
function myplugin_deactivation() {
	// Тип записи не регистрируется, а значит он автоматически удаляется - его не нужно удалять как-то еще.

	// Сбрасываем настройки ЧПУ, чтобы они пересоздались с новыми данными
	flush_rewrite_rules();
}
add_action('wp_enqueue_scripts', function(){
	wp_enqueue_script('jquery');
	wp_enqueue_script(
			'quiz',
			plugins_url( 'js/script.js', __FILE__ ),
			array( 'jquery' ),
			null,
			true
		);
wp_enqueue_style('quiz',plugins_url( 'css/style.css', __FILE__ ),);
});


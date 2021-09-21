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

add_filter('single_template', 'my_single_template');
function my_single_template($single) {

	global $post;

	if ( $post->post_type == 'quiz' ) {
		$tpl = plugin_dir_path(__FILE__). 'single-quiz.php';
		return wp_normalize_path($tpl);
	}

	return $single;
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

add_action('wp_enqueue_scripts', 'my_assets' );

function my_assets(){

	wp_deregister_script('jquery');
	wp_register_script('jquery', plugins_url( 'js/jquery-3.6.0.min.js', __FILE__ ),array(), null, true );
	wp_enqueue_script('jquery');
	wp_enqueue_script('quiz', plugins_url( 'js/script.js', __FILE__ ),array( 'jquery' ), null, true);
	wp_enqueue_style('quiz', plugins_url( 'css/style.css', __FILE__ ));
	wp_dequeue_style('app');
	wp_dequeue_script('app');
	wp_localize_script('quiz', 'my_plugin', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
	));
}
add_action('wp_ajax_quizes', 'quizes');
add_action('wp_ajax_nopriv_quizes', 'quizes');

function quizes(){
	$post_id = $post->ID;
	$acf_fields = get_fields($post_id);
	$quizes = $acf_fields['quizes'];
	//$quizes = get_field('quizes');
	$result = [];
	$data = $_POST['data'];
	if(!empty($quizes)):
		foreach($quizes as $key => $question):
			foreach($question['answers'] as $a_key=>$answer):
				array_push($result, [
					'question_id' => $key,
					 'answer_id' => $a_key == $data[$key]['answer_id'] ? $a_key : '',
					  'correct' => $answer['correct'] ==1 ? $a_key : ''
					]); 
			endforeach;
		endforeach;
	endif;
	exit(json_encode($result));
}

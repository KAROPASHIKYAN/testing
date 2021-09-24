<?php
/**
 * Plugin Name: Testing
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
//creation of post types
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

	$args = array('public'    => true,
          'supports'  => array('title'),
          'label'    => 'Quiz result',
          'map_meta_cap'      => true,
          'rewrite'           => array(
              'slug'       => 'quiz_result',
              'with_front' => false,
              'pages'      => false
          )

	);
	register_post_type('quiz_result', $args);
}
 //creation template for quizes
add_filter('single_template', 'my_single_template');
function my_single_template($single) {

	global $post;

	if ( $post->post_type == 'quiz' ) {
		$tpl = plugin_dir_path(__FILE__). 'single-quiz.php';
		return wp_normalize_path($tpl);
	}

	return $single;
}

//ACF for post types
add_action('init', 'acf_quiz');

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

		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_614c3e74e2ec9',
				'title' => 'Quiz result',
				'fields' => array(
					array(
						'key' => 'field_614c3e82ba06e',
						'label' => 'User IP',
						'name' => 'user_ip',
						'type' => 'text',
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
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'translations' => 'translate',
					),
					array(
						'key' => 'field_614c3fabba06f',
						'label' => 'Quiz title',
						'name' => 'quiz_title',
						'type' => 'text',
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
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'translations' => 'translate',
					),
					array(
						'key' => 'field_614c3fc5ba070',
						'label' => 'Q&A',
						'name' => 'results',
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
						'button_label' => 'Add result',
						'sub_fields' => array(
							array(
								'key' => 'field_614c400cba071',
								'label' => 'Question',
								'name' => 'question',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '50',
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
								'key' => 'field_614c401fba072',
								'label' => 'Answer',
								'name' => 'answer',
								'type' => 'number',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '50',
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
						),
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'quiz_result',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'acf_after_title',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));

			endif;		
}	

	//scripts & styles
add_action('wp_enqueue_scripts', 'my_assets' );

function my_assets(){

	wp_deregister_script('jquery');
	wp_register_script('jquery', plugins_url( 'js/jquery-3.6.0.min.js', __FILE__ ),array(), null, true );
	wp_enqueue_script('jquery');
	wp_enqueue_script('ajaxHandle', plugins_url( 'js/script.js', __FILE__ ),array( 'jquery' ), null, true);
	wp_enqueue_style('quiz', plugins_url( 'css/style.css', __FILE__ ));
	wp_localize_script( 
    'ajaxHandle', 	
    'ajax_object', 
    array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) 
  );
}
add_action('wp_ajax_wl_quizes', 'wl_quizes');
add_action('wp_ajax_nopriv_wl_quizes', 'wl_quizes');

function get_the_user_ip() {
     if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
          
          $ip = $_SERVER['HTTP_CLIENT_IP'];
     } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
          
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
     } else {
          $ip = $_SERVER['REMOTE_ADDR'];
     }
     return apply_filters( 'edd_get_ip', $ip );
 }
 //AJAX
function wl_quizes(){
	
	$data = $_POST;

	$post_id = sanitize_text_field( $data['post_id'] );
	$count = sanitize_text_field( $data['count'] );
	
	$test_return = [];
	$quizes = get_field('quizes', $post_id);
	$result = [];
	$compare = 0;

	for ($i=1; $i <= $count ; $i++): 
		$name = 'q'.$i;
		$ans[$i] = intval(sanitize_text_field($data[$name]));
	endfor;
	//Correct answers
	foreach ($quizes as $key => $question):
		foreach ($question['answers'] as $a_key => $answer):
				//$result[$key] = [$answer];
			if ( $answer['correct'] == 1) {
				$result[$key+1] = $a_key;
			}
		endforeach;
	endforeach;
	//Count correct answers
	$length = count($result);
	for ($i = 1; $i<=$length; $i++):
		if ($result[$i] == $ans[$i]):
			$compare++;
		endif;

	endfor;
	//Count correct answers in %
	$results_percent = intval(($compare / $length)*100);

	$test_return['$question'] = $quizes;
	$test_return['data'] = $data;
	$test_return['length'] = $length;
	$test_return['answer'] = $ans;
	$test_return['result'] = $result;
	$test_return['results'] = $compare;
	$test_return['results_percent'] = $results_percent . '%';



	//TODO проверить количество правильных ответов +
	$ip = get_the_user_ip();
	$date = date('j F Y H:i:s');
	$title = get_the_title($post_id);
	$new_post_title = sanitize_text_field($title .' '. $ip . ' ' . $date);

	$new_post = array(                                                 
	'post_title'     => $new_post_title,                                                   
	'post_type'      => 'quiz_result',
	'post_status'    => 'publish'
	);
	$result_post_id = wp_insert_post($new_post);
	//TODO create post+
	//TODO return result_id+
	
	$test_return['result_post_id'] = $result_post_id;

	update_field( "field_614c3e82ba06e", $ip, $result_post_id );

	$field_key = "field_614c3fabba06f";
	$valuew = $title;
	update_field( $field_key, $valuew, $result_post_id );



 $arr[] = [];
	foreach ($ans as $key => $answer):
		$field_key = "field_614c3fc5ba070";
		$values[$key]['question'] = $key;  
		$values[$key]['answer'] = $answer;  
	endforeach;
		update_field( $field_key, $values, $result_post_id );

	$test_return['value'] = $values;
	
	//TODO insert acf+

	if ($results_percent >= 80):
		$test_return['pass'] = true;
	else:
		$test_return['fail'] = true;
	endif;
	//TODO проверить если ответов больше 80%:

	//TODO redirect to $_GET ?quiz_result=result_id
	
	//TODO  если меньше 80%
	//TODO redirect to $_GET ?restart


	exit(json_encode($test_return));
	
}

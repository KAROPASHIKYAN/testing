<?php

global $post;
$post_id = $post->ID;
$acf_drochepilovo = get_fields($post_id);
$quizes = $acf_drochepilovo['quizes'];
$result_post_type = get_post_type( $_GET['wl_result'] );



?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php the_title();?></title>
		<?php wp_head();?>
	</head>
	<body>
<!-- //TODO if $_GET['quiz_result']  -->

<!-- //TODO elseif GET ?restart  -->

<!-- else -->
		<?php if(!empty($quizes)):?>
			<form id="quizes" method="post" action="" class="<?php echo empty($_GET['wl_result']) ? 'active': 'inactive'; ?>">
				<input type="hidden" name="action" value="wl_quizes">
				<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
				<input type="hidden" name="count" value="<?php echo count($quizes); ?>">

				<?php foreach ($quizes as $key => $quiz): ?>
				<div class="quiz <?php echo $key == 0 ? 'active' : 'inactive' ;?>">
					<div class="quiz-questions">
						<div class="quiz-questions-item">
							<div class="quiz-questions-item__question"><p><?php echo $quiz['question']; ?></p></div>
							<ul class="quiz-questions-item__answers">
								<?php foreach($quiz['answers'] as $value => $answer):?>
								<li>
									<label>
										<input type="radio" name="q<?php echo $key+1; ?>" value="<?php echo $value; ?>">
										<?php echo $answer['answer']; ?>
									</label>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="quiz-indicator"><span class="current"><?php echo ++$key?></span><?php echo '/' . (array_key_last($quizes)+1);?></div>
					<div class="quiz-contorls"></div>
						<span class="btn-prev inactive">Back</span>
						<?php if ($key < count($quizes)): ?>
							<span class="btn-next disabled" disabled>Next</span>
						<?php else: ?>
							<button class="btn-next disabled" type="submit">Submit</button>
								
						<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</form>
		<?php endif; ?>
		<?php
		 if (!empty($_GET['wl_result'])): 
			$result_post_id = $_GET['wl_result'];
			$acf_field = get_fields(intval($result_post_id));
			$results = $acf_field['results'];
			//var_dump($acf_field);
			?>
			<?php foreach ($quizes as $key => $quiz): ?>
					<div class="quiz-results">
						<div class="quiz-questions">
							<div class="quiz-questions-item">
								<div class="quiz-questions-item__question"><p><?php echo $quiz['question']; ?></p></div>
								<ul class="quiz-questions-item__answers">
									<?php foreach($quiz['answers'] as $value => $answer):?>
									<li>
										<p class="<?php if ($results[$value]['answer'] == ($answer['correct']==1 ? $value : '')): ?>
										<?php echo 'correct'; ?>
										<?php elseif ($results[$value]['answer'] == ($answer['correct']!==1 ? $value : '')):?>
										<?php echo 'incorrect'; ?>
										<?php endif; ?>">
											<?php echo $answer['answer']; ?>
										</p>	
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
						</div>
			<?php endforeach; ?>
		<?php endif; ?>
			
		</div>
		<div class="result inactive">
			<span class="btn-reset">Restart</span>
		</div>		
		<?php wp_footer(); ?>
	</body>
</html>
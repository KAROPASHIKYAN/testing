<?php

global $post;
$post_id = $post->ID;
$acf_fields = get_fields($post_id);
$quizes = $acf_fields['quizes'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php the_title();?></title>
		<?php wp_head();?>
	</head>
	<body <?php echo body_class() ?>>
<!-- //TODO if $_GET['quiz_result']  -->

<!-- //TODO elseif GET ?restart  -->

<!-- else -->

		
		
		
		<?php
		 if (!empty($_GET['wl_result'])): 
			$result_post_id = $_GET['wl_result'];
			$acf_result_field = get_fields(intval($result_post_id));
			$results = $acf_result_field['results'];

			//var_dump($acf_field);
			?>
			<?php if(!empty($_GET['restart'])): ?>
			<div class="result <?php echo empty($_GET['restart']) ? ' inactive': ' active'; ?>">
				<h1>Try again</h1>
				<span class="btn-reset">Restart</span>
			</div>
			<?php endif; ?>
			<?php foreach ($quizes as $key => $quiz): ?>
					<div class="quiz-results">
						<div class="quiz-questions">
							<div class="quiz-questions-item">
								<div class="quiz-questions-item__question"><p><?php echo $quiz['question']; ?></p></div>
								<ul class="quiz-questions-item__answers">
									<?php foreach($quiz['answers'] as $value => $answer):?>
									<li>
										<p 
											<?php if ($results[$key]['answer'] ==  $value && $answer['correct'] == true): ?>
												<?php echo 'class="correct"'; ?>
											<?php elseif ($results[$key]['answer'] !==  $value && $answer['correct'] == true): ?>
												<?php echo 'class="correct"'; ?>
											<?php elseif ($results[$key]['answer'] == $value && $answer['correct'] !== true): ?>
												<?php echo 'class="incorrect"'; ?>
											<?php endif; ?>>
											<?php echo $answer['answer']; ?>
										</p>	
									</li>
								<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
			<?php endforeach; ?>
					<?php else: ?>	
			<?php if(!empty($quizes)):?>
				<form id="quizes" method="post" action="" class="<?php echo empty($_GET['wl_result']) ? 'active': 'inactive'; ?>">
					<input type="hidden" name="action" value="wl_quizes">
					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
					<input type="hidden" name="count" value="<?php echo count($quizes); ?>">

					<?php foreach ($quizes as $key => $quiz): ?>

					<div class="quiz <?php echo $key == 0 && empty($_GET['wl_result']) ? 'active' : 'inactive' ;?>">
						<div class="quiz-indicator"><p><span class="current">Question <?php echo ++$key?></span><?php echo ' of ' . (array_key_last($quizes)+1);?></p>
						</div>
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
					</div>
					<?php endforeach; ?>
						
						<div class="quiz-contorls">
							<span class="btn-prev inactive">Back</span>
								<span class="btn-next disabled" disabled>Next</span>
								<button class="btn-next d-none disabled" type="submit">Submit</button>
						</div>
				</form>
			<?php endif; ?>	
		<?php endif; ?>	
		<?php wp_footer(); ?>
	</body>
</html>
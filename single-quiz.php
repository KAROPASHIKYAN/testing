<?php
$quizes = get_field('quizes');
//echo '<pre>';
//print_r($quizes);
//echo '</pre>';

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php the_title();?></title>
		<?php wp_head();?>
	</head>
	<body>
		<?php 
		/*echo '<pre>';
		print_r($quizes);
		echo '</pre>';*/
		?>
		<?php if(!empty($quizes)):?>
			<?php foreach ($quizes as $key => $quiz): ?>
				<div class="quiz <?php echo $key==0 ? 'active' : 'inactive' ;?>">
					<div class="quiz-questions">
						<div class="quiz-questions-item">
							<div class="quiz-questions-item__question"><p><?php echo $quiz['question']; ?></p></div>
							<ul class="quiz-questions-item__answers">
								<?php foreach($quiz['answers'] as $value => $answer):?>
								<li>
									<label>
										<input type="radio" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
										<?php echo $answer['answer']; ?>
									</label>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>
					<div class="quiz-indicator"><?php echo ++$key . '/' . (array_key_last($quizes)+1);?></div>
					<div class="quiz-contorls"></div>
						<button class="btn-prev inactive">Back</button>
						<button class="btn-next" disabled>Next</button>
					
				</div>
			<?php endforeach; ?>
		<?php endif; ?>	
		<div class="result inactive">
			<button class="btn-reset">Restart</button>
			<!--<button class="btn-submit">Submit</button>-->	
			<?php if(!empty($quizes)):?>
				<?php foreach ($quizes as $quiz): ?>
					<div class="quiz-results">
						<div class="quiz-results-item">
							<div class="quiz-results-item__question"><?php echo $quiz['question']; ?></div>
							<ul class="quiz-results-item__answers">
								<?php foreach($quiz['answers'] as $answer):?>
									<li><?php echo $answer['answer']; ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>		
		<?php wp_footer(); ?>
	</body>
</html>
<?php
$quizes = get_field('quizes');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php the_title();?></title>
		<?php wp_head();?>
	</head>
	<body>
		<?php if(!empty($quizes)):?>
			<?php foreach ($quizes as $key => $quiz): ?>
				<div class="quiz <?php echo $key==0 ? 'active' : 'inactive' ;?>">
					<div class="quiz-questions">
						<div class="quiz-questions-item">
							<div class="quiz-questions-item__question"><p><?php echo $quiz['question']; ?></p></div>
							<ul class="quiz-questions-item__answers">
								<?php foreach($quiz['answers'] as $answer):?>
								<li>
									<label>
										<input type="radio" name="<?php echo $key; ?>">
										<?php echo $answer['answer']; ?>
									</label>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>
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
					<div class="quiz-indicator">1/10</div>
					<div class="quiz-contorls"></div>
						<button class="btn-prev">Back</button>
						<button class="btn-next">Next</button>
						<button class="btn-restart">Restart</button>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>	


		<?php wp_footer(); ?>
	</body>
</html>
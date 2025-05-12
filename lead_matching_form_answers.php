<style>
 
	.answer_style {
		border-radius: 30px !important;
		margin-bottom: 10px !important;
	}

	.contentAnswer {
		border-style: solid;
		border-color: #dedede;
		padding: 10px !important;
		-webkit-box-shadow: 0 0 50px 0 rgb(0 0 0 / 15%);
		-moz-box-shadow: 0 0 50px 0 rgba(5, 2, 2, 0.15);
		-ms-box-shadow: 0 0 50px 0 rgba(0, 0, 0, 0.15);
		box-shadow: 0 0 50px 0 rgb(0 0 0 / 15%);
		display: block;
		-webkit-transition: 0.5s;
		-o-transition: 0.5s;
		transition: 0.5s;
		margin-bottom: 1.5em;
	}
	
	.question-div{
		border: 1px solid #ccc;
		border-radius: 4px;		
		
	}
	
	.m-t-10{
		margin-top: 10px !important;
	}
	.m-t-5{
		margin-top: 5px !important;
	}
	
	.m-b-10{
		margin-bottom: 10px !important;
	}
	.m-b-5{
		margin-bottom: 5px !important;
	}	



</style>

<?
    //$in_session = getUser($_COOKIE['userid'], $w);
    //if ($_COOKIE['editmode'] != null) {
    //    $admin_mode = $_COOKIE['editmode'];
    //} else {
    //    $admin_mode = 1;
    //}
    // CALL QUESTIONS 
    $select = "SELECT * FROM `lead_matching_questions` ORDER BY `question_order` ASC ";
    $sql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);
    $questions_array = array();
    while ($data = mysql_fetch_assoc($sql)) {
        $questions_array[] = $data;
    }

    $select = "SELECT * FROM `lead_matching_answers`";
    $sql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);
    $answers_array = array();
    while ($data = mysql_fetch_assoc($sql)) {
        $answersAll_array[] = $data;
    }
    ?>

    <? 
	foreach ($questions_array as $question) { 
	?>
        <?
        $answers_array = array();
        $select = "SELECT * FROM `lead_matching_answers` WHERE `question_id` =   $question[question_id] ORDER BY answer_id ASC;";
        $sql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);
        $answers_array = array();
        while ($data = mysql_fetch_assoc($sql)) {
            $answers_array[] = $data;
        }
        ?>

		
			<? 
			if (count($answers_array) != 0) {
				if ($question['question_type'] == 'checkbox') { //checkbox
				?>
				<div class="form-group question-div">
					<div class="row">
						<div class="col-sm-12 m-t-5 m-b-5">
							<div class="col-sm-12 m-b-5">
								<span class="" style="width: 100%; color: #555;"><?= $question['question'] ?> </span>
							</div>
							<div class="col-sm-12">							
								<?
								foreach ($answers_array as $answer) { 
								?>						
								<div class="col-sm-6">						
									<input class="check ckeck_answer" type="checkbox" name="lead_matching_answer_ids[]" value="<?= $answer['answer_id'] ?>" id="answer<?= $answer['answer_id'] ?>" />
									<span style=" color: #979797;"><?= $answer['answer'] ?></span>
								</div>									
								<? 
								}
							?>
							</div>
						</div>
					</div>
				</div>
				<?
				} else { //dropdown 
					?>
				<div  class="form-group">
					<select class="form-control" name="lead_matching_answer_ids[]" title="Select an option">
						<option><?= $question['question'] ?></option>
						<? 
					foreach ($answers_array as $answer) {
						?>
						<option value="<?= $answer['answer_id'] ?>"><?= $answer['answer'] ?></option>
						<? 
					} 
						?>
					</select>	
				</div>	
					<? 
				}
				?>		
			<?
			}
			?>
	<?		
	} 
	?>

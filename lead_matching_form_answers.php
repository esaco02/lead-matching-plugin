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

</style>

<?
    $in_session = getUser($_COOKIE['userid'], $w);
    if ($_COOKIE['editmode'] != null) {
        $admin_mode = $_COOKIE['editmode'];
    } else {
        $admin_mode = 1;
    }
    // CALL QUESTIONS 
    $select = "SELECT * FROM `lead_matching_questions` ORDER BY `question_order` ASC ";
    $sql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);
    $questions_array = array();
    while ($data = mysql_fetch_assoc($sql)) {
        $questions_array[] = $data;
    }
    $answers_selected = $in_session['lead_matching_answer_ids'];
    if ($answers_selected != "") {
        $answers_selected = trim($answers_selected, ",");
        $answers_selected = explode(",", $answers_selected);
    } else {
        $answers_selected = array();
    }

    $select = "SELECT * FROM `lead_matching_answers`";
    $sql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);
    $answers_array = array();
    while ($data = mysql_fetch_assoc($sql)) {
        $answersAll_array[] = $data;
    }
    ?>

    <input class="hidden" type="checkbox" checked name="lead_matching_answer_ids[]" value=" " checked>

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

		<div class="form-group">
			<? 
			if (count($answers_array) != 0) {
				if ($question['question_type'] == 'checkbox') { //checkbox
					if ($question['required'] == 1) {
					?>
					<div class="col-sm-3 text-right norpad">
						<label class="control-label bd-text" > <span class="required">* </span><? echo $question['question']; ?> </label>
					</div>
					<? 
					} else { 
					?>
					<div class="col-sm-3 text-right norpad">
						<label class="control-label bd-text" ><? echo $question['question']; ?> </label>
					</div>	
					<? 
					}
				} else {
					//Dropdown
					if ($question['required'] == 1) {
					?>
						<div class="col-sm-3 text-right norpad">
							<label class="control-label bd-text"><span class="required">* </span><? echo $question['question']; ?> </label>
						</div>
					<? 
					} else { 
					?>

						<div class="col-sm-3 text-right norpad">
							<label class="control-label bd-text"><? echo $question['question']; ?> </label>
						</div>
					<? 		
					}
				}
				?>


				<!--Question-->
				<div class="col-sm-9" id="questionContent<? echo $question['question_id'] ?>" style="margin-bottom:15px;">
					<?
					if ($question['question_type'] == 'checkbox') { //checkbox
						foreach ($answers_array as $answer) { 
						?>
							
								<label style="width: 100%;">
									<div class="col-xs-1" style="margin-top: 10px; padding-left: 0px;">
										<?
										if ($question['required'] == 1) { 
										?>
											<input class="check ckeck_answer" type="checkbox" required data-fv-field="<? echo $question['question_variable']; ?>[]" name="<? echo $question['question_variable']; ?>[]" value="<? echo $answer['answer']; ?>" id="<? echo $answer['answer_id']; ?>" <?= in_array($answer['answer_id'], $answers_selected) ? "checked" : ""?> />
											<input class="check hidden" type="checkbox" name="lead_matching_answer_ids[]" value="<? echo $answer['answer_id']; ?>" id="answer<? echo $answer['answer_id']; ?>" <?= in_array($answer['answer_id'], $answers_selected) ? "checked" : ""?>/>
										<? 
										} else { 
										?>
											<input class="check ckeck_answer" type="checkbox" name="<? echo $question['question_variable']; ?>[]" value="<? echo $answer['answer']; ?>" id="<? echo $answer['answer_id']; ?>" <?= in_array($answer['answer_id'], $answers_selected) ? "checked" : ""?>/>
											<input class="check hidden" type="checkbox" name="lead_matching_answer_ids[]" value="<? echo $answer['answer_id']; ?>" id="answer<? echo $answer['answer_id']; ?>" <?= in_array($answer['answer_id'], $answers_selected) ? "checked" : ""?>/>
										<? 
										} 
										?>
									</div>

									<div class="col-xs-11 nopad"  style="margin-top: 5px; padding-left: 0px !important;">
									
									
										<input type="text" value="<?= $answer['answer']; ?>" class=" form-control " readonly="">									
									
										<!--<span style=" color: #979797;"><? echo $answer['answer']; ?></span>-->
									</div>
								</label>
							
						<? 
						}
					} else { //dropdown 
					?>
						<? $dropdown_variable = $in_session[$question['question_variable']]; ?>
						<input value="<? echo ($dropdown_variable != "") ? "$dropdown_variable" : "" ?>" type="text" class="hidden" id="text<? echo $question['question_id']; ?>" name="<? echo $question['question_variable']; ?>[]" />
					
						<div class="styled-select2_" id="<? echo $question['question_id']; ?>">

							<select class="custom_search_filter_multiselect<? echo $question['question_id'] ?> form-control" name="lead_matching_answer_ids[]" title="Select an option" <? echo ($question['required'] == 1) ? "required" : " " ?>>
								<option value=""></option>
								<? 
								foreach ($answers_array as $answer) {
								?>
									<option <?= in_array($answer['answer_id'], $answers_selected) ? "selected" : ""?> value="<? echo $answer['answer_id'] ?>"><? echo $answer['answer']; ?></option>
								<? 
								} 
								?>

							</select>
						</div>
					
					<? 
					}
					?>
				</div>

				<small class="help-block" data-fv-validator="notEmpty" data-fv-for="<? echo $question['question_variable']; ?>" data-fv-result="INVALID" style="display:none;">Required Field</small>
			<? 
			}
			?>
		</div> 
	<?		
	} 
	?>

<input class="hidden" type="checkbox" checked name="lead_matching_answer_ids[]" value=" " checked>

<script>
	const questions_array = <? echo json_encode($questions_array); ?>;
	const answers_array = <? echo json_encode($answersAll_array); ?>;

	$('.ckeck_answer').click(function() {
		id = "answer" + $(this).attr('id');
		element_id = document.getElementById(id);
		if (!element_id.checked) {
			element_id.checked = true;
		} else {
			element_id.checked = false;
		}
	});

</script>
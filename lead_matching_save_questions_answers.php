<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

	/*MULTISELECT*/
	#lead_matching_plugin .select2-container-multi .select2-choices {
		height: auto !important;
		height: 1%;
		margin: 0;
		padding: 0;
		position: relative;
		border: 1px #aaa;
		cursor: text;
		overflow: hidden;
		background-color: #fff0;
		background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, color-stop(1%, #eee), color-stop(15%, #fff0));
		background-image: -webkit-linear-gradient(top, #eee0 1%, #fff0 15%);
		background-image: -moz-linear-gradient(top, #eee 1%, #fff 15%);
		background-image: linear-gradient(top, #eee 1%, #fff 15%);
	}

	.select2-container--default .select2-selection--single {
		border-radius: 0px;
		border-color: #ccc;

	}

	.select2-container-multi.select2-container-active .select2-choices {
		border: 1px solid #5897fb;
		outline: none;
		-webkit-box-shadow: 0 0 5px rgb(0 0 0 / 30%);
		box-shadow: 0 0 0px rgb(0 0 0 / 0%);

	}

	.select2-container .select2-selection--single {
		padding-top: 8px;
		height: 46px;
	}

	.select2-container .select2-selection--single .select2-selection__rendered {
		padding-left: 20px;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
		top: 10px;
	}

	.select2-container--default .select2-selection--multiple {
		background-color: white;
		border: 1px solid #ccc;
		border-radius: 0px !important;
		cursor: text;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		background-color: #e4e4e4;
		border: 1px solid #ccc;
		border-radius: 4px;
		cursor: default;
		float: left;
		margin-right: 5px;
		margin-top: 5px;
		padding: -1px;
	}

	.select2-container {
		box-sizing: border-box;
		display: inline-block;
		margin: 0;
		position: relative;
		vertical-align: middle;
		width: 100% !important;
		display: inline-table;
		border-color: #ededed;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice__display {
		cursor: default;
		padding-left: 17px !important;
		padding-right: 5px;
	}

	.select2-search {
		display: contents !important;
		width: 100%;
		min-height: 26px;
		margin: 0;
		padding-left: 4px;
		padding-right: 4px;
		position: relative;
		z-index: 10000;
		white-space: nowrap;
	}

	.select2-container .select2-selection--multiple .select2-selection__rendered {
		display: block !important;
		overflow: hidden;
		padding-left: 8px;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	.select2-container--default .select2-search--inline .select2-search__field {
		height: 34px !important;
		padding: 10px 16px !important;
		font-size: 16px !important;
		line-height: 1 !important;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		background-color: #f4f4f4 !important;
		border: 1px solid #fff !important;
		border-radius: 0px !important;
		cursor: default;
		float: left;
		margin-right: 5px;
		margin-top: 5px;
		padding: 0 5px;
	}

	.select2-choice {
		border-radius: 10px !important;
		background-color: rgba(255, 255, 255, .20);
		border: 0;
	}

	.select2-dropdown-open .select2-choice {
		border-radius: 10px 10px 0 0 !important;
	}

	.select2-choices {
		border-color: white;
	}

	.select2-drop {
		padding-top: 5px;
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
    $answers_selected = $in_session['filters_answers_id'];
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

    <input class="hidden" type="checkbox" checked name="filters_answers_id[]" value=" " checked>

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
									<div class="col-xs-1" style="margin-top: 5px; padding-left: 0px;">
										<?
										if ($question['required'] == 1) { 
										?>
											<input class="check ckeck_answer" type="checkbox" required data-fv-field="<? echo $question['question_variable']; ?>[]" name="<? echo $question['question_variable']; ?>[]" value="<? echo $answer['answer']; ?>" id="<? echo $answer['answer_id']; ?>" />
											<input class="check hidden" type="checkbox" name="filters_answers_id[]" value="<? echo $answer['answer_id']; ?>" id="answer<? echo $answer['answer_id']; ?>" />
										<? 
										} else { 
										?>
											<input class="check ckeck_answer" type="checkbox" name="<? echo $question['question_variable']; ?>[]" value="<? echo $answer['answer']; ?>" id="<? echo $answer['answer_id']; ?>" />
											<input class="check hidden" type="checkbox" name="filters_answers_id[]" value="<? echo $answer['answer_id']; ?>" id="answer<? echo $answer['answer_id']; ?>" />
										<? 
										} 
										?>
									</div>

									<div class="col-xs-11 nopad">
									
									
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

							<select class="custom_search_filter_multiselect<? echo $question['question_id'] ?> form-control" name="filters_answers_id[]" title="Select an option" <? echo ($question['required'] == 1) ? "required" : " " ?>>
								<? 
								foreach ($answers_array as $answer) {
									if (in_array($answer['answer_id'], $answers_selected)) { 
								?>
										<option selected value="<? echo $answer['answer_id'] ?>"><? echo $answer['answer']; ?></option>
									<? 
									} else {
									?>
										<option value="<? echo $answer['answer_id'] ?>"><? echo $answer['answer']; ?></option>    
									<? 
									}
									?>
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

<input class="hidden" type="checkbox" checked name="filters_answers_id[]" value=" " checked>

<script>
	const questions_array = <? echo json_encode($questions_array); ?>;
	const answers_array = <? echo json_encode($answersAll_array); ?>;
	answers_array
	/*
	$(document).ready(function() {
		questions_array.map(function(element) {
			if (element.question_type == 'dropdown') {
				$(".custom_search_filter_multiselect" + element.question_id).select2({
					placeholder: "Select an option",
					allowClear: true
				});
			}
		});

	});
	*/
	$('.ckeck_answer').click(function() {
		id = "answer" + $(this).attr('id');
		element_id = document.getElementById(id);
		if (!element_id.checked) {
			element_id.checked = true;
		} else {
			element_id.checked = false;
		}
	});
	$('.styled-select2').change(function() {
		var id = $(this).attr("id");
		let selected = $("#questionContent" + id).find(".custom_search_filter_multiselect" + id).select2("val");
		var text = "";

		answers_array.map(function(element) {
			if (selected.includes(element.answer_id)) {
				text += element.answer + ",";
			}
		});
		$("#text" + id).val(text);
		console.log($("#text" + id).val());

	});

</script>
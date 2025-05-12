<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.3.1/css/rowReorder.dataTables.css" />

<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.js"></script>
<?

// CALL QUESTIONS OF THIS MEMBERSHIP
$select = "SELECT * FROM `lead_matching_questions` ORDER BY `question_order`";
$sql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);
$questions_array = array();
$question_variables_array = array();
while ($data = mysql_fetch_assoc($sql)) {
  $question_variables_array[] = $data['question_variable'];
  $questions_array[] = $data;
}

?>
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
      padding: 0px !important;
  }

  #lead_matching_plugin h1 {
      font-size: 45px;
      font-weight: 800;
  }

  #lead_matching_plugin div.search_box_style {
      background-color: #253342;
      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 20px;
      padding-right: 20px;
  }

  #lead_matching_plugin .nohpad {
      padding-left: 0 !important;
      padding-right: 0 !important;
  }

  #lead_matching_plugin .btn {
      border-radius: 0;
  }

  #lead_matching_plugin button.btn.btn_plugin_settings {
      background-color: #2E3F50;
      margin-top: 35px;
  }

  #lead_matching_plugin button.btn.btn_plugin_settings:hover {
      box-shadow: 0 0 20px rgb(0 0 0 / 15%) inset;
  }

  #lead_matching_plugin button.btn.btn_plugin_settings:hover>i {
      color: #f9d78f !important;
      transform: rotate(45deg);
  }

  #lead_matching_plugin button.btn.btn_plugin_settings label {
      margin-bottom: 0;
      cursor: pointer;
      color: #EEEEEE;
  }

  #lead_matching_plugin button.btn.btn_plugin_settings i {
      color: #8899A7;
      font-size: 16px;
      margin-right: 4px;
      transition: transform 0.7s;
  }

  #lead_matching_plugin button.btn.btn_search_subscription {
      background-color: #4B6580;
      color: white;
      height: 56px;
  }

  #lead_matching_plugin input.input_error {
      box-shadow: inset 0 0 5px 0 #d9534fb5;
      border-color: #d9534f8a;
  }

  /* TABLE STYLES */
  #lead_matching_plugin table.table thead tr th {
      background-color: #253342 !important;
      color: white;
  }

  #lead_matching_plugin table.table tbody tr td {
      font-size: 15px;
  }

  #lead_matching_plugin table.table tbody tr td:nth-of-type(2) {
      max-width: 300px;
  }

  #lead_matching_plugin .fa.fa-trash {
      color: #d9534f;
      cursor: pointer
  }

  /* MODAL STYLE */
  #lead_matching_plugin .body_modal {
      margin-top: 10%;
      background-color: white;
      border-radius: 0px;
  }

  #lead_matching_plugin .title_modal {
      background-color: #253342;
      color: white;
      font-weight: 600;
      text-align: center;
  }

  #lead_matching_plugin .title_modal button {
      color: white;
  }

  .questions_container {
      margin-bottom: 20px;
  }

  .questions_container .add_question_content {
      margin-top: 25px;
  }

  .questions_container .add_question_content .add_question_head {
      background-color: #253342;
      color: white;
      padding-top: 15px;
      padding-bottom: 15px;
      font-size: 15px;
  }

  .questions_container .add_question_content .add_question_head label {
      margin-bottom: 0;
  }

  .questions_container .add_question_content .add_question_head .fa-times {
      margin-top: 3px;
  }

  .questions_container .add_question_content .add_question_body {
      padding-top: 15px;
      padding-bottom: 15px;
      background-color: #EEEEEE;
  }

  .questions_container .add_question_content .add_question_body label {
      color: #253342;
      font-size: 13px;
  }

  .questions_container .add_question_content .add_question_body .answers_container .btn.remove_add_answer {
      height: 36px;
      padding: 10px 0px !important;
  }

  .questions_container .add_question_content .add_question_body .answers_container .btn.remove_add_answer .fa-times,
  .questions_container .add_question_content .add_question_body .answers_container .btn.remove_update_answer .fa-times {
      color: #d9534f;
  }

  .questions_container .add_question_content .add_question_body .answers_container input[type="checkbox"] {
      margin-top: 12px;
  }

  #lead_matching_plugin .addBotton {
      border-radius: 0px;
  }

  #lead_matching_plugin .btn-answer {
      margin-bottom: 10px;
      background-color: #eeeeee;
      border-color: #eeeeee;
      color: #253342;
  }

  #lead_matching_plugin .btn-answerdelete {
      margin-bottom: 10px;
      background-color: #eeeeee;
      border-color: #eeeeee;
      color: red;
  }

  #lead_matching_plugin .btn-answerdelete:hover {
      margin-bottom: 10px;
      background-color: #eeeeee;
      border-color: #eeeeee;
      color: red;
  }

  #lead_matching_plugin .btn-answer:hover {
      margin-bottom: 10px;
      background-color: #eeeeee;
      border-color: #eeeeee;
      color: #253342;
  }

  /* END MODAL STYLE */

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

  #lead_matching_plugin .select2-container--default .select2-selection--single {
      border-radius: 0px;
      border-color: #ccc;

  }

  .select2-container-multi.select2-container-active .select2-choices {
      border: 1px solid #5897fb;
      outline: none;
      -webkit-box-shadow: 0 0 5px rgb(0 0 0 / 30%);
      box-shadow: 0 0 0px rgb(0 0 0 / 0%);

  }

  #lead_matching_plugin .select2-container .select2-selection--single {
      padding-top: 8px;
      height: 46px;
  }

  #lead_matching_plugin .select2-container .select2-selection--single .select2-selection__rendered {
      padding-left: 20px;
  }

  #lead_matching_plugin .select2-container--default .select2-selection--single .select2-selection__arrow {
      top: 10px;
  }

  #lead_matching_plugin .select2-container--default .select2-selection--multiple {
      background-color: white;
      border: 1px solid #ccc;
      border-radius: 0px !important;
      cursor: text;
  }

  #lead_matching_plugin .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #e4e4e4;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: default;
      float: left;
      margin-right: 5px;
      margin-top: 5px;
      padding: -1px;
  }

  #lead_matching_plugin .select2-container {
      box-sizing: border-box;
      display: inline-block;
      margin: 0;
      position: relative;
      vertical-align: middle;
      width: 100% !important;
      display: inline-table;
      border-color: #ededed;
  }

  #lead_matching_plugin .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
      cursor: default;
      padding-left: 17px !important;
      padding-right: 5px;
  }

  #lead_matching_plugin .select2-search {
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

  #lead_matching_plugin .select2-container .select2-selection--multiple .select2-selection__rendered {
      display: block !important;
      overflow: hidden;
      padding-left: 8px;
      text-overflow: ellipsis;
      white-space: nowrap;
  }

  #lead_matching_plugin .select2-container--default .select2-search--inline .select2-search__field {
      height: 34px !important;
      padding: 10px 16px !important;
      font-size: 16px !important;
      line-height: 1 !important;
  }



  #lead_matching_plugin .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #f4f4f4 !important;
      border: 1px solid #fff !important;
      border-radius: 0px !important;
      cursor: default;
      float: left;
      margin-right: 5px;
      margin-top: 5px;
      padding: 0 5px;
  }



  #lead_matching_plugin .select2-choice {
      border-radius: 10px !important;
      background-color: rgba(255, 255, 255, .20);
      border: 0;
  }

  #lead_matching_plugin .select2-dropdown-open .select2-choice {
      border-radius: 10px 10px 0 0 !important;
  }

  #lead_matching_plugin .select2-choices {
      border-color: white;
  }

  .select2-drop {
      padding-top: 5px;
  }

  .checkbox-sub-category{
      margin-left: 16px; 
  }
  .checkbox-sub-sub-category{
      margin-left: 16px; 
  }

  #member-cat-table{
      margin-bottom: 0px !important;
      background: #fff;
  }

  .first-column{
      width: 50%;
  }
  .second-column{
      width: 50%;
  }

  .col-order{
      cursor: move;
  }

  
  
</style>
<div id="lead_matching_plugin" class="col-md-12">
  <!-- TITLE -->
  <div class="col-md-12 nohpad" style="margin-bottom: 55px;">
      <div class="col-md-10">
          <h1>Lead Matching Plugin</h1>
      </div>
  </div>
  
  <!-- TOP ROW SEARCH -->
  <div class="col-md-12" style="margin-bottom: 35px;">

      <div class="col-md-12 col-sm-12 col-xs-12 nohpad">
          <?

          ?>
          <a class="btn btn-primary btn-lg pull-right" data-toggle="modal" data-target="#addQuestions">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
              Add Question
          </a>
          <?

          ?>
      </div>

  </div>	
  
  
  <!-- TABLE -->

  
  <div class="col-md-12">

          <table class="table text-center table-bordered table-striped dataTable dtr-inline" id="tableQuestions">
            <thead>
              <tr>
                  <th>Order</th>
                  <th>Question</th>
                  <th>Question Label</th>
                  <th>Type</th>
                  <th>Required</th>
                  <th>Edit</th>
                  <th>Delete</th>
              </tr>
                
                              
                
                
            </thead>
          <tbody>
<?php
foreach($questions_array as $question){
  
                  // CALL ANSWERS OF THIS QUESTION
                  $select = "SELECT * FROM `lead_matching_answers` WHERE `question_id` = " . $question['question_id'] . " ORDER BY `answer`";
                  $sql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);
                  $answers_array = array();
                  while ($data = mysql_fetch_assoc($sql)) {
                      $answers_array[] = $data;
                  }	
  
  
  
  
?>
              
                          <!-- UPDATE QUESTION MODAL -->
                          <div class="modal fade" id="update_questions<? echo $question['question_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content body_modal">
                                      <div class="modal-header title_modal container-fluid">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                          <h4 class="modal-title">Update Question</h4>
                                      </div>
                                      <div class="modal-body">
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <div class="col-md-12">
                                                      <button class="btn btn-success update_question_btn pull-right" value="<? echo $question['question_id']; ?>">Save Changes</button>
                                                  </div>
                                                  <div class="questions_container update_question_container col-md-12 nohpad">
                                                      <div class="col-md-12 add_question_content" question_id="<? echo $question['question_id']; ?>">
                                                          <!-- QUESTION TITLE -->
                                                          <div class="col-md-12 add_question_head">
                                                              <label>Question</label>
                                                          </div>
                                                          <div class="col-md-12 add_question_body">
                                                              <!-- QUESTION TYPE -->
                                                              <div class="form-group col-sm-6">
                                                                  <label>Select a type of question</label>
                                                                  <div class="radio">
                                                                      <label><input type="radio" name="update_question_type<? echo $question['question_id']; ?>" value="checkbox" <? echo ($question['question_type'] == "checkbox") ? "checked" : ""; ?>> Checkbox</label>
                                                                  </div>
                                                                  <div class="radio">
                                                                      <label><input type="radio" name="update_question_type<? echo $question['question_id']; ?>" value="dropdown" <? echo ($question['question_type'] == "dropdown") ? "checked" : ""; ?>> Dropdown</label>
                                                                  </div>
                                                              </div>
                                                              <!-- REQUIRED QUESTION -->
                                                              <div class="form-group col-sm-6">
                                                                  <label>Required</label>
                                                                  <div class="col-md-12 nohpad">
                                                                      <label class="switch">
                                                                          <input type="checkbox" class="update_question_required_input" <? echo ($question['required'] == "1") ? "checked" : ""; ?>>
                                                                          <span class="slider"></span>
                                                                      </label>
                                                                  </div>
                                                              </div>                                                                                                                            
                                                              <!-- QUESTION -->
                                                              <div class="form-group col-md-12">
                                                                  <label>Question:</label>
                                                                  <input type="text" class="form-control update_question_input" value="<? echo $question['question']; ?>" placeholder="Type a question...">
                                                              </div>
                                                              <!-- QUESTION LABEL -->
                                                              <div class="form-group col-md-6">
                                                                  <label>Question Label:</label>
                                                                  <input type="text" class="form-control update_question_label_input" question_id="<? echo $question['question_id']; ?>" value="<? echo $question['question_label']; ?>" placeholder="Label">
                                                              </div>
                                                              <!-- QUESTION VARIABLE -->
                                                              <div class="form-group col-md-6">
                                                                  <label>Database Variable:</label>
                                                                  <input type="text" class="form-control update_question_variable_input" question_id="<? echo $question['question_id']; ?>" og_variable="<? echo $question['question_variable']; ?>" value="<? echo $question['question_variable']; ?>" placeholder="Variable">
                                                              </div>
                                                              <!-- ANSWERS -->
                                                              <div class="col-md-12">
                                                                  <label>Answers</label>
                                                                  <button class="btn add_answer_btn" question_id="<?= $question['question_id']; ?>"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                  <div class="col-md-12 nohpad answers_container" question_id="<?= $question['question_id']; ?>">
                                                                      <?
                                                                      $answers_counter = 0;
                                                                      foreach ($answers_array as $answer) {
                                                                      ?>
                                                                          <div class="col-md-12 nohpad form-group update_answer_input_group_container">
                                                                              <div class="col-md-11 nohpad">
                                                                                  <input type="text" class="form-control update_question_answer_input" value="<?= $answer['answer']; ?>" answer_id="<? echo $answer['answer_id']; ?>" placeholder="Answer">
                                                                              </div>
                                                                              <div class="col-md-1 nohpad">
                                                                                  <?
                                                                                  if ($answers_counter > 1) {
                                                                                  ?>
                                                                                      <button class="btn remove_update_answer"><i class="fa fa-times" aria-hidden="true"></i></button>
                                                                                  <?
                                                                                  }
                                                                                  $answers_counter++;
                                                                                  ?>
                                                                              </div>
                                                                          </div>

                                                                      <?
                                                                      }
                                                                      ?>
                                                                  </div>
                                                              </div>
                                                          </div>

                                                      </div>
                                                  </div>
                                                  <div class="col-md-12">
                                                      <button class="btn btn-success btn-block btn-lg update_question_btn" value="<? echo $question['question_id']; ?>">Save Changes</button>
                                                  </div>
                                              </div>
                                          </div>

                                      </div>
                                  </div>
                              </div>
                          </div>   

                                
              
              <tr class="order-rows" data-order="<?= $question['question_order']?>" data-id="<?= $question['question_id']?>">
                  <td class="col-order"><?= $question['question_order']?></td>
                  <td><?= $question['question']?></td>
                  <td><?= $question['question_label']?></td>
                  <td><?= $question['question_type']?></td>
                  <td><?= $question['required'] ? 'Yes' : 'No'?></td>
                  
                  <!-- EDIT -->
                  <td class="text-center">
                      <a data-toggle="modal" href="#update_questions<? echo $question['question_id']; ?>" question_id="<? echo $question['question_id']; ?>">
                          <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                      </a>                         
                  </td>

                  <!-- DELETE -->
                  <td class="text-center"><i class="fa fa-trash fa-2x delete_question" aria-hidden="true" question_id="<?= $question['question_id']?>"></i></td>					
                  
                  
              </tr>	
              
              
<?php
}					
?>
              
              
          </tbody>		
          </table>

  </div>
  

  
</div>

<!-- ADD QUESTION MODAL -->
<div class="modal fade" id="addQuestions" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content body_modal">
          <div class="modal-header title_modal container-fluid">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="modalLabelSmall">Add New Question</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="col-md-12">
                          <button class="btn btn-success save_new_questions_btn pull-right">Save Changes</button>
                      </div>
                      <div id="questions_container" class="questions_container col-md-12 nohpad">
                          <div class="col-md-12 add_question_content" question_n="1">
                              <!-- QUESTION TITLE -->
                              <div class="col-md-12 add_question_head">
                                  <label>Question</label>
                                  <!-- <i class="fa fa-times pull-right remove_add_question" aria-hidden="true" question_n="1"></i> -->
                              </div>
                              <div class="col-md-12 add_question_body">
                                  <!-- QUESTION TYPE -->
                                  <div class="form-group col-md-6">
                                      <label>Select a type of question</label>
                                      <div class="radio">
                                          <label><input type="radio" name="question_type1" value="checkbox">Checkbox</label>
                                      </div>
                                      <div class="radio">
                                          <label><input type="radio" name="question_type1" value="dropdown">Dropdown</label>
                                      </div>
                                  </div>

                                  <!-- REQUIRED QUESTION -->
                                  <div class="form-group col-md-6">
                                      <label>Required</label>
                                      <div class="col-md-12 nohpad">
                                          <label class="switch">
                                              <input type="checkbox" class="add_new_question_required_input">
                                              <span class="slider"></span>
                                          </label>
                                      </div>
                                  </div>

                                  <!-- QUESTION -->
                                  <div class="form-group col-md-12">
                                      <label>Question:</label>
                                      <input type="text" class="form-control add_new_question_input" placeholder="Type a question...">
                                  </div>
                                  <!-- QUESTION LABEL -->
                                  <div class="form-group col-md-6">
                                      <label>Question Label:</label>
                                      <input type="text" class="form-control add_new_question_label_input" question_n="1" placeholder="Label">
                                  </div>
                                  <!-- QUESTION VARIABLE -->
                                  <div class="form-group col-md-6">
                                      <label>Database Variable:</label>
                                      <input type="text" class="form-control add_new_question_variable_input" question_n="1" placeholder="Variable">
                                  </div>
                                  <!-- ANSWERS -->
                                  <div class="col-md-12">
                                      <label>Answers</label>
                                      <button class="btn add_answer_btn" question_n="1"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                      <div class="nohpad answers_container" question_n="1">
                                          <div class="row nohpad form-group answer_input_group_container">
                                              <div class="col-md-11 nohpad">
                                                  <input type="text" class="form-control add_new_question_answer_input" placeholder="Answer">
                                              </div>
                                              <div class="col-md-1 nohpad">
                                                  <!-- <button class="btn remove_add_answer"><i class="fa fa-times" aria-hidden="true"></i></button> -->
                                              </div>
                                          </div>
                                          <div class="row nohpad form-group answer_input_group_container">
                                              <div class="col-md-11 nohpad">
                                                  <input type="text" class="form-control add_new_question_answer_input" placeholder="Answer">
                                              </div>
                                              <div class="col-md-1 nohpad">
                                                  <!-- <button class="btn remove_add_answer"><i class="fa fa-times" aria-hidden="true"></i></button> -->
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                      <div class="col-md-12">
                          <button class="btn btn-success btn-block btn-lg save_new_questions_btn">Save Changes</button>
                      </div>
                  </div>
              </div>

          </div>
      </div>
  </div>
</div>

<script>
  
$(document).ready(function() {

  var table = $('#tableQuestions').DataTable({	  
      rowReorder: true,
      searching: false ,
      paging: false,
      bPaginate: false 
  });

  const tbody = document.getElementById("choicesListTbodyADD");
  const btnAdd = document.querySelector("button");
  const inputChoices = document.querySelector("input");
  //var count = 1;

  
  
  table.on('row-reorder', function (e, diff, edit) {
      //console.log("reordered...");
      
      var possition = 1;
      var arr_order = [];
      jQuery(".order-rows").each(function(){
          //console.log(counter);
          //console.log(jQuery(this).data("id"));
          arr_order.push([jQuery(this).data("id"), possition]);
          possition++;

      });	
      
      let params = {
          action: 'update_order',
          arr_order: arr_order
      };		
              
      $.post('/api/data/html/get/data_widgets/widget_name?name=lead_matching_plugin_engine', params, function(data) {}).done(function(data) {
          //swal("Success!", "Changes Saved!", "success");
          //location.reload();
          //console.log(data);
      });		
      
      console.log(arr_order);
      
      
  });	
  
  
  
  
  /* -------- ADD QUESTION MODAL -------- */
  const question_variables_array = <? echo json_encode($question_variables_array); ?>;
  var question_counter = question_variables_array.length + 1;

  
  
  /* ADD NEW ANSWER */
  $("#questions_container").delegate(".add_answer_btn", "click", function() {
      let question_n = $(this).attr('question_n');
      console.log("clcked");

      let html = '<div class="row nohpad form-group answer_input_group_container">';
      html += '<div class="col-md-11 nohpad">';
      html += '<input type="text" class="form-control add_new_question_answer_input" placeholder="Answer">';
      html += '</div>';
      html += '<div class="col-md-1 nohpad">';
      html += '<button class="btn remove_add_answer"><i class="fa fa-times" aria-hidden="true"></i></button>';
      html += '</div>';
      $(".answers_container[question_n=" + question_n + "]").append(html);
  });
  /* DELETE ANSWER */
  $("#questions_container").delegate(".remove_add_answer", "click", function() {
      $(this).parent().parent().remove();
  });	
  
  
  /* SAVE NEW QUESTIONS */
  $(".save_new_questions_btn").click(function() {
      swal({
          imageUrl: '/images/bars-loading.gif',
          title: "Saving Changes",
          text: "Please wait...",
          imageAlt: 'Loading',
          timer: 1000000,
          allowOutsideClick: false,
          showConfirmButton: false,
          closeOnConfirm: false
      });

      /* VARIABLES */
      let questions_flag = true;
      let question_variables_flag = true;
      let questions_array = [];
      let answers_array;
      let question_variables_inputs_array = [];
      let question_type_input;
      let question_input;
      let question_order;
      let question_required;
      let question_label_input;
      let question_variable_input;
      let question_n;
      let answer;

      
      
      
      //var array = $.map($('input[name="member_categories[]"]:checked'), function(c){return c.value; })

      /* ITERATE EACH QUESTION BOX */
      $("#questions_container .add_question_content").each(function() {
          /* VALUES OF QUESTION INPUTS OF THIS BOX */
          question_n = $(this).attr("question_n");
          question_type_input = $(this).find("input[name=question_type" + question_n + "]:checked").val();
          visibility_type = $(this).find("input[name=add_question_enable_public" + question_n + "]:checked").val();
          question_input = $(this).find("input.add_new_question_input").val();
          
          if (!question_input) {
              questions_flag = false;
          }

          question_required = ($(this).find("input.add_new_question_required_input").prop("checked")) ? "1" : "0";
          
          question_label_input = $(this).find("input.add_new_question_label_input").val();
          
          if (!question_label_input) {
              questions_flag = false;
          }
          
          question_variable_input = $(this).find("input.add_new_question_variable_input").val();
          
          if (!question_variable_input) {
              questions_flag = false;
          } else {
              if (question_variables_array.includes(question_variable_input)) {
                  question_variables_flag = false;
                  $(this).find("input.add_new_question_variable_input").addClass("input_error");
              }
              if (question_variables_inputs_array.includes(question_variable_input)) {
                  question_variables_flag = false;
                  $(this).find("input.add_new_question_variable_input").addClass("input_error");
              }
          }

          
          //$('.category').select2("val");

          answers_array = [];

          /* VALUES OF ANSWER INPUTS OF THIS BOX */
          $(this).find(".answers_container .answer_input_group_container").each(function() {
              answer = $(this).find("input.add_new_question_answer_input").val();
              if (answer) {
                  /* ADD TO ARRAY OF ANSWERS */
                  answers_array.push({
                      answer: answer
                  });
              }
          });
        

          if (answers_array.length < 2) {
              questions_flag = false;
          }

          /* ADD TO ARRAY OF QUESTIONS */
          questions_array.push({
              question: question_input,
              question_order: question_counter,
              question_required: question_required,
              question_label: question_label_input,
              question_variable: question_variable_input,
              question_type: question_type_input,
              answers: answers_array
          });

          question_variables_inputs_array.push(question_variable_input);

      });

      let params = {
          action: 'add_questions',
          questions: questions_array
      };
      console.log(params);

      if (questions_flag) {
          if (question_variables_flag) {
              $.post('/api/data/html/get/data_widgets/widget_name?name=lead_matching_plugin_engine', params, function(data) {}).done(function(data) {
                  swal("Success!", "Changes Saved!", "success");
                  location.reload();
                  console.log(data);
              });
          } else {
              swal("Error!", "Some question variables are duplicated", "error");
          }
      } else {
          swal("Error!", "There are some fields emtpy", "error");
      }

  });
  /* ---------- END ADD QUESTION MODAL ---------- */	
      
  

  
  /* DELETE A QUESTION */
  $("#lead_matching_plugin .delete_question").click(function() {

      let question_id = $(this).attr('question_id');

      swal({
              title: "Are you sure?",
              text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: '#1992CB',
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Yes, delete it!",
              cancelButtonText: "No, cancel!",
          },
          function() {
              swal({
                  imageUrl: '/images/bars-loading.gif',
                  title: "Deleting",
                  text: "Please wait...",
                  imageAlt: 'Loading',
                  timer: 1000000,
                  allowOutsideClick: false,
                  showConfirmButton: false,
                  closeOnConfirm: false
              });

              let params = {
                  action: 'delete_question',
                  question_id: question_id
              }

              console.log(params);

              $.post('/api/data/html/get/data_widgets/widget_name?name=lead_matching_plugin_engine', params, function(data) {}).done(function(data) {
                  if(data == "deleted"){
                      swal("Success!", "Deleted!", "success");
                      console.log(data);
                      location.reload();						
                  }
              });
          }
      );
  });	
  
  
  /*UPDATE MODAL*/
  
  /* ADD NEW ANSWER */
  $(".update_question_container").delegate(".add_answer_btn", "click", function() {
      let question_id = $(this).attr('question_id');

      let html = '<div class="col-md-12 nohpad form-group update_answer_input_group_container">';
      html += '<div class="col-md-11 nohpad">';
      html += '<input type="text" class="form-control update_question_answer_input" placeholder="Answer">';
      html += '</div>';
      html += '<div class="col-md-1 nohpad">';
      html += '<button class="btn remove_update_answer"><i class="fa fa-times" aria-hidden="true"></i></button>';
      html += '</div>';
      $(".answers_container[question_id=" + question_id + "]").append(html);
  });
  /* DELETE ANSWER */
  $(".update_question_container").delegate(".remove_update_answer", "click", function() {
      $(this).parent().parent().remove();
  });	
  
  
  
  /* REMOVE THE ERROR CLASS WHEN TYPE ON QUESTION VARIABLE INPUT */
  $("#questions_container").delegate("input.add_new_question_variable_input", "keydown", function() {
      if ($(this).hasClass("input_error")) {
          $(this).removeClass("input_error");
      }
  });

  /* AUTO GENERATE QUESTION VARIABLE BASED ON QUESTION LABEL */
  $("#questions_container").delegate("input.add_new_question_label_input", "keydown", function(key_event) {
      let label_value = $(this).val();
      let question_n = $(this).attr("question_n");

      label_value += (key_event.key.length === 1) ? key_event.key : "";
      if (key_event.key == "Backspace") {
          label_value = label_value.slice(0, -1);
      }

      label_value = label_value.replace(/ /g, "_");
      label_value = label_value.replace(/\W/g, "");
      label_value = label_value.replace(/[0-9]/g, "");

      if (label_value.length < 20) {
          $("input.add_new_question_variable_input[question_n=" + question_n + "]").val(label_value);
      }
  });	
  
  
  
  
  
  $(".update_question_btn").click(function() {
      swal({
          imageUrl: '/images/bars-loading.gif',
          title: "Saving Changes",
          text: "Please wait...",
          imageAlt: 'Loading',
          timer: 1000000,
          allowOutsideClick: false,
          showConfirmButton: false,
          closeOnConfirm: false
      });

      let question_id = $(this).val();
      let question_flag = true;
      let variable_flag = true;
      let answers_array = [];
      let answer_id;
      let answer_value;


      let question_type = $("#update_questions" + question_id).find('input[name="update_question_type' + question_id + '"]:checked').val();
      if (!question_type) {
          question_flag = false;
      }

      let question_required = ($("#update_questions" + question_id).find(".update_question_required_input").prop("checked")) ? "1" : "0";
      if (!question_required) {
          question_flag = false;
      }
      
      let question_content = $("#update_questions" + question_id).find(".update_question_input").val();
      if (!question_content) {
          question_flag = false;
      }
      let question_label = $("#update_questions" + question_id).find(".update_question_label_input").val();
      if (!question_label) {
          question_flag = false;
      }
      let question_variable = $("#update_questions" + question_id).find(".update_question_variable_input").val();
      if (!question_variable) {
          question_flag = false;
      }
      let og_variable = $("#update_questions" + question_id).find(".update_question_variable_input").attr("og_variable");
      if (question_variable != og_variable && question_variables_array.includes(question_variable)) {
          variable_flag = false;
      }

      $("#update_questions" + question_id).find(".update_answer_input_group_container").each(function() {
          answer_id = ($(this).find("input.update_question_answer_input").attr("answer_id")) ? $(this).find("input.update_question_answer_input").attr("answer_id") : '0';
          answer_value = $(this).find("input.update_question_answer_input").val();
          if (answer_value) {
              answers_array.push({
                  answer_id: answer_id,
                  answer_value: answer_value
              });
          }
      });
         

      if (answers_array.length < 2) {
          question_flag = false;
      }

      let question = {
          question_id: question_id,
          question: question_content,
          question_required: question_required,
          question_type: question_type,
          question_label: question_label,
          question_variable: question_variable,
          answers: answers_array           
      }

      let params = {
          action: "update_question",
          question: question
      };
      console.log(params);

      if (question_flag) {
          if (variable_flag) {
              $.post('/api/data/html/get/data_widgets/widget_name?name=lead_matching_plugin_engine', params, function(data) {}).done(function(data) {
                  swal("Success!", "Changes Saved!", "success");
                  location.reload();
                  console.log(data);
              });
          } else {
              swal("Error!", "Some question variables are duplicated", "error");
          }
      } else {
          swal("Error!", "There are some fields emtpy", "error");
      }

  });

  /* ---------- END UPDATE QUESTION MODAL ---------- */	
  
  
  
});	
  
  
  
  
  


  
  

  
</script>


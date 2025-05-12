<?

$action = $_POST['action'];
$question_id = $_POST['question_id'];

switch ($action) {

    case 'add_questions':
        $questions = $_POST['questions'];
        $debug_array = array();
        $debug_array[] = "add_questions";

        foreach ($questions as $question) {
            // CALL THE AUTO INCREMENT CURRENT NUMBER
            $select = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'lead_matching_questions'";
            $mysql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);
            if ($data = mysql_fetch_assoc($mysql)) {
                $auto_increment_id = $data['AUTO_INCREMENT'];
            } else {
                $auto_increment_id = 0;
            }

            // INSERT THIS NEW QUESTION
            $insert = "INSERT INTO `lead_matching_questions` ( `question`, `question_variable`, `question_label`, `question_type`, `question_order`, `required`) 
            VALUES (
                '" . $question['question'] . "', 
                '" . $question['question_variable'] . "', 				
                '" . $question['question_label'] . "', 
                '" . $question['question_type'] . "', 
                '" . $question['question_order'] . "', 
                '" . $question['question_required'] . "'
                )";
                
            mysql(brilliantDirectories::getDatabaseConfiguration('database'), $insert);
            $debug_array[] = $insert;

            // VERIFY IF THE NEW QUESTION EXIST BEFORE THIS INSERT
            $select = "SELECT * FROM `lead_matching_questions` WHERE `question_variable` = '" . $question['question_variable'] . "'";
            $mysql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);

            if ($data = mysql_fetch_assoc($mysql)) {
                if ($data['question_id'] == $auto_increment_id) {

                    // ADD QUESTION COLUMN TO users_data
                    $select = "SELECT `".$question['question_variable']."` FROM `users_data` LIMIT 1";
                    $mysql = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $select);
                    if(!$users_data_column_question = mysql_fetch_assoc($mysql)) {
                        $alter_table = "ALTER TABLE `users_data` ADD `".$question['question_variable']."` TEXT NOT NULL";
                        mysql(brilliantDirectories::getDatabaseConfiguration('database'), $alter_table);
                        $debug_array[] = $alter_table;
                    }

                    // IF THE QUESTION IS SUCCESFULLY INSERTED
                    foreach ($question['answers'] as $answer) {
                        // INSERT ANSWERS
                        $insert = "INSERT INTO `lead_matching_answers` (`answer`, `question_id`) VALUES ('" . $answer['answer'] . "', '" . $auto_increment_id . "')";
                        mysql(brilliantDirectories::getDatabaseConfiguration('database'), $insert);
                        $debug_array[] = $insert;
                    }
                }
            }
        }

        return json_encode($debug_array);
    break;

	
    case 'delete_question':
	
	
        $update = "UPDATE `lead_matching_questions` SET `question_order`= `question_order` - 1  WHERE `question_order` > (SELECT `question_order` from `lead_matching_questions` WHERE `question_id` = " . $question_id . ")";
	
        mysql(brilliantDirectories::getDatabaseConfiguration('database'), $update);
	
	
        $delete = "DELETE FROM `lead_matching_questions` WHERE `question_id` = " . $question_id;
        mysql(brilliantDirectories::getDatabaseConfiguration('database'), $delete);

        $delete = "DELETE FROM `lead_matching_answers` WHERE `question_id` = " . $question_id;
        mysql(brilliantDirectories::getDatabaseConfiguration('database'), $delete);
	
	

        return 'deleted';
    break;	
	
    case 'update_order':
	
		$arr_order = $_POST['arr_order'];
		if($arr_order){
			foreach($arr_order as $value){
        		$update = "UPDATE `lead_matching_questions` SET `question_order`= " . $value[1]. " WHERE `question_id` = ". $value[0];
        		mysql(brilliantDirectories::getDatabaseConfiguration('database'), $update);				
				
			}
		}
	

        return json_encode('updated');
    break;	
	
	
    case 'update_question':

        $debug_array = array();
        $question = $_POST['question'];

        $question_id = $question['question_id'];
        $question_content = $question['question'];
        $question_required = $question['question_required'];
        $question_type = $question['question_type'];
        $question_label = $question['question_label'];
        $question_variable = $question['question_variable'];
        $answers = $question['answers'];
       

        // UPDATE QUESTION COLUMNS
        $update = "UPDATE `lead_matching_questions` SET 
        `question` = '$question_content',
        `question_label` = '$question_label', 
        `question_type` = '$question_type', 
        `question_variable` = '$question_variable', 
        `required` = '$question_required'       
        WHERE `question_id` = $question_id";

        mysql(brilliantDirectories::getDatabaseConfiguration('database'), $update);
        $debug_array[] = $update;

        $insert_answer_values = "";
        $delete_answers_id = "";
        foreach ($answers as $val) {
            // IF ANSWER EXIST BEFORE, IT HAS ID
            if ($val['answer_id']) {
                // SO IS UPDATED
                $update = "UPDATE `lead_matching_answers` SET `answer` = '" . $val['answer_value'] . "' WHERE `answer_id` = " . $val['answer_id'];
                mysql(brilliantDirectories::getDatabaseConfiguration('database'), $update);
                $debug_array[] = $update;

                // BUILDING DELETE QUERY
                $delete_answers_id .= " AND `answer_id` != '" . $val['answer_id'] . "'";
            } else {
                // BUILDING INSERT QUERY
                $insert_answer_values .= ", ('" . $val['answer_value'] . "', $question_id)";
            }
        }

        if ($delete_answers_id) {
            // DELETE ANSWERS OF THIS QUESTION THAT IS NOT IN THE DELETE QUERY VARIABLE
            $delete_answers_id = trim($delete_answers_id, " AND ");
            $delete = "DELETE FROM `lead_matching_answers` WHERE `question_id` = $question_id AND ($delete_answers_id)";
            mysql(brilliantDirectories::getDatabaseConfiguration('database'), $delete);
            $debug_array[] = $delete;
        }

        if ($insert_answer_values) {
            // INSERT ANSWERS THAT DOESN'T EXIST BEFORE
            $insert_answer_values = trim($insert_answer_values, ", ");
            $insert = "INSERT INTO `lead_matching_answers` (`answer`, `question_id`) VALUES $insert_answer_values";
            mysql(brilliantDirectories::getDatabaseConfiguration('database'), $insert);
            $debug_array[] = $insert;
        }

        return json_encode($debug_array);
	
    break;	

    default:
        return json_encode('error');
    break;
}

?>

<?php
require_once('../../includes/initialize.php');
if(!$session->is_loged_in()){ redirect_to("login.php"); } 

$subject = $_GET['subject'];
	if(!$subject){
		redirect_to("manage_test.php");
	}	

$subj = group_Subject::find_by_id($subject);

	if(!$subj->id){
		redirect_to("manage_test.php");
	} else {
		$stud = group_Subject::find_by_id($subj->id);
		$groups = Groups::find_all();
    }	


    if(isset($_POST['submit_group_name'])){
		$subj->group_name = !empty($_POST['group_name']) ? $_POST['group_name'] : $subj->group_name;
		$subj->update();
		redirect_to("select_questions_for_group.php?subject={$subject}");
	}



	if(isset($_POST['submit_subj_time'])){
		if((int)$_POST['subj_time']){
		if($_POST['subj_time'] >= 60){
			$time = 59 * 60;
		} else {
			$time = (int)$_POST['subj_time'] *60;
		}
		$subj->time = !empty($_POST['subj_time']) ? (int)$time : $subj->time;
		$subj->update();
		redirect_to("select_questions_for_group.php?subject={$subject}");
		}
	}


	if(isset($_POST['submit_subj_name'])){
		$subj->name = !empty($_POST['subj_name']) ? $_POST['subj_name'] : $subj->name;
		$subj->update();
		redirect_to("select_questions_for_group.php?subject={$subject}");
	}


?>

<?php include_layout_template('admin_header.php'); ?>
<script type="text/javascript">

	window.onload = function() {
	document.getElementById("mainBox").addEventListener('click', invisBox1Open);
	document.getElementById("invisBox1Close").addEventListener('click', invisBox1Closet);
	document.getElementById("timeBox").addEventListener('click', invisBox2Open);
	document.getElementById("invisBox2Close").addEventListener('click', invisBox2Closet);
	document.getElementById("group_sel_test").addEventListener('click', invisBox3Open);
	document.getElementById("invisBox3Close").addEventListener('click', invisBox3Closet);
	};

	function invisBox1Open(){
		var invisBox1=document.getElementById("invisBox1").style;
 		var invisBox2=document.getElementById("invisBox2").style;
		invisBox1.display="block";
		invisBox2.display="none";
 	};

 	function invisBox1Closet(){
		var obj=document.getElementById("invisBox1").style;
		obj.display="none";
 	};	

 	function invisBox2Open(){
		var obj=document.getElementById("invisBox2").style;
		obj.display="block";
 	};

 	function invisBox2Closet(){
		var obj=document.getElementById("invisBox2").style;
		obj.display="none";
 	};

 	function invisBox3Open(){
		var obj=document.getElementById("invisBox3").style;
		obj.display="block";
 	};

 	function invisBox3Closet(){
		var obj=document.getElementById("invisBox3").style;
		obj.display="none";
 	};

</script>
<a href="list_group_test.php">&laquo; Назад</a> <br/><br/>	

<table>
<tr><th style="text-align: left; width: 600px;"><?php 
	$results = Subjects::find_all();
    echo "<ul type=\"none\">";
    foreach ($results as $result):
      $output  = "<li>";
      $output .= "<h2>";
      $output .= htmlentities($result->name);
      $tests = Tests::find_tests_for_subject($result->id);
      foreach ($tests as $test):
        $output .= "</h2><ul><li>";
        $output .= "<a href=\"create_group_test.php?test=";
        $output .= urlencode($test->id);
        $output .= "&subject={$_GET['subject']}";
        $output .= "\">";
        $output .= htmlentities($test->question);
        $output .= "</a></li></ul><br>";
      endforeach;
      $output .="</li><br>";
      echo $output;
    endforeach;
    echo "</ul>";
 ?></th>

<th style="width: 400px;">
	<br>
	<div id="group_sel_test">Название группы: 
		<?php echo  htmlentities($stud->group_name); ?>
	</div>
	<br>
	<div id="invisBox3">
		<div id="invisBox3Close">x</div>

	<form method="POST" action="select_questions_for_group.php?subject=<?php echo urlencode($subj->id); ?>">
					<select name="group_name" id="groupName">
		<?php
			foreach ($groups as $group) {
				$output  = "<option";
				$output .= " value=\"";
				$output .= htmlentities($group->group_name);
				$output .= "\" >";
				$output .= htmlentities($group->group_name);
				$output .= "</option>";
				echo $output;
			}
		?>
	</select><br><br>

	<input type="submit" name="submit_group_name" value="Сохранить" id="submit_group_name">
	</form>
	</div>
	<div id="mainBox">Название теста:
	<?php echo htmlentities($subj->name); ?>
	</div>
	<div id="invisBox1">
	<div id="invisBox1Close">x</div>
	<form method="POST" action="select_questions_for_group.php?subject=<?php echo urlencode($subj->id); ?>"><br><br>
	<input type="text" name="subj_name" value="<?php echo htmlentities($subj->name); ?>" id="inp_subj_name"><br><br>
	<input type="submit" name="submit_subj_name" value="Сохранить" id="submit_subj_name">
	</form>
    </div><br>
   <div id="timeBox">Время на проведение теста:
   <?php echo htmlentities($subj->time) / 60 . " мин"; ?>
   </div>
   <div id="invisBox2">
    <div id="invisBox2Close" >x</div>
	<form method="POST" action="select_questions_for_group.php?subject=<?php echo urlencode($subj->id); ?>"><br>
	<input type="text" name="subj_time"	value="<?php echo htmlentities($subj->time) / 60; ?>" id="inp_subj_time">мин<br><br>
	<input type="submit" name="submit_subj_time" value="Сохранить" id="submit_subj_time">
	</form>
  </div><br>
    <a href="delete_all_group_test.php?id=<?php echo urlencode($subj->id); ?>"><br><br>
    		Вопросы для тестирования:</a><br><br>
	<?php
	$results = group_Test::find_by_subject_id($subject); 
	if(isset($results)){
		foreach($results as $result){
			$output = htmlentities($result->question);
			$output .= "<br>";
			$output .= "<div id=\"delete_select_test\">";
			$output .= "<a href=\"delete_group_test.php?id=";
			$output .= urlencode($result->id);
			$output .= "\">";
			$output .= "Удалить</a><br><br><br></div>";
			echo $output;
		}
	}
?></th>
</tr>

</table>	


<?php include_layout_template('admin_footer.php'); ?>
<?php
$con = mysqli_connect('localhost','root');
   	mysqli_select_db($con,'quizdatabases');
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style type="text/css">
	.animateuse{
			animation: leelaanimate 0.5s infinite;
		}

@keyframes leelaanimate{
			0% { color: red },
			10% { color: yellow },
			20%{ color: blue }
			40% {color: green },
			50% { color: pink }
			60% { color: orange },
			80% {  color: black },
			100% {  color: brown }
		}
</style>

   </head>
   <body>
     <div class="container text-center" >
     	<br><br>
    	<h1 class="text-center text-success text-uppercase animateuse" > </h1>
    	<br><br><br><br>
      <table class="table text-center table-bordered table-hover">
      	<tr>
      		<th colspan="2" class="bg-dark"> <h1 class="text-white"> Results </h1></th>
      		
      	</tr>
      	<tr>
		      	<td>
		      		Questions Attempted
		      	</td>

	         <?php
         $counter = 0;
         $Resultans = 0;
            if(isset($_POST['submit'])){
            if(!empty($_POST['quizcheck'])) {
            // Counting number of checked checkboxes.
            $checked_count = count($_POST['quizcheck']);
            // print_r($_POST);
            ?>

        	<td>
            <?php
            echo "Out of 5, You have attempt ".$checked_count." option."; ?>
            </td>
        
          	
             <?php
            // Loop to store and display values of individual checked checkbox.
            $selected = $_POST['quizcheck'];
            error_reporting(0);
            $q1= " select ans_id from question ";
            $ansresults = mysqli_query($con,$q1);
            $i = 1;
            while($rows = mysqli_fetch_array($ansresults)) {
				if($j<6){
              //print_r($rows);
            	$flag = $rows['ans_id'] == $selected[$i];
            	
            			if($flag){
            				 echo "correct ans is ".$rows['ans_id']."<br>";				
            				$counter++;
            				$Resultans++;
            				//echo "Well Done! your ". $counter ." answer is correct <br><br>";
            			}else{
            				$counter++;
            				//echo "Sorry! your ". $counter ." answer is innncorrect <br><br>";
            			}					
            		$i++;		
            	}
				}
            	?>
            	
    		
    		<tr>
    			<td>
    				Your Total score
    			</td>
    			<td colspan="2">
	    	<?php 
				
	            echo " Your score is ". $Resultans.".";
				switch ($Resultans) {
				case 1:
				echo "Poor";
				break;
				case 2:
				echo "Bad";
				break;
				case 3:
				echo "Good";
				break;
				case 4:
				echo "Strong";
				break;
				case 5:
				echo "Very Strong";
				break;
				default:
				echo "";
				}
				
	            }
	            else{
	            echo "<b>Please Select Atleast One Option.</b>";
	            }
	            } 
	          ?>
	          </td>
            </tr>

            <?php 

            
            $finalresult = " insert into user(totalques, anscorrect) values ('5','$Resultans') ";
            $queryresult= mysqli_query($con,$finalresult); 
            // if($queryresult){
            // 	echo "successssss";
            // }
            ?>


      </table>

      </div>
   </body>
</html>














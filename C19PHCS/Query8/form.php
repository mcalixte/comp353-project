<?php require_once '../database.php';
session_start();
                                                    
if (isset($_POST["submit"])) {
    if(!empty($_POST['date_time'])){      
        $Symptom_tuple = $conn->prepare('INSERT INTO C19PHCS.symptom_history(date_time,person,fever,cough,breath_difficulty,taste_loss, nausea, stomach_aches,vomitting,headache,muscle_pain,diarrhea,sore_throat,other)
                                        VALUES (:date_time,:person,:fever,:cough,:breath, :taste_loss, :nausea, :stomache, :vomitting,:headache,:muscle,:diarrhea,:throat,:other);');   
                                        
        $Symptom_tuple->bindParam(':date_time', $_POST["date_time"]);
        $Symptom_tuple->bindParam(':person',$_SESSION['user']);
        if (isset($_POST["fever"]))
            $Symptom_tuple->bindParam(':fever', $_POST["fever"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':fever',$var);
        }
        if (isset($_POST["cough"]))       
            $Symptom_tuple->bindParam(':cough', $_POST["cough"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':cough',$var);
        }
        if (isset($_POST["breath"]))      
            $Symptom_tuple->bindParam(':breath', $_POST["breath"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':breath',$var);
        }
        if (isset($_POST["taste_loss"]))      
            $Symptom_tuple->bindParam(':taste_loss', $_POST["taste_loss"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':taste_loss',$var);
        }
        if (isset($_POST["nausea"]))      
            $Symptom_tuple->bindParam(':nausea', $_POST["nausea"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':nausea',$var);
        }
        if (isset($_POST["stomache"]))      
            $Symptom_tuple->bindParam(':stomache', $_POST["stomache"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':stomache',$var);
        }        
        if (isset($_POST["vomitting"]))      
            $Symptom_tuple->bindParam(':vomitting', $_POST["vomitting"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':vomitting',$var);
        }
        if (isset($_POST["headache"]))      
            $Symptom_tuple->bindParam(':headache', $_POST["headache"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':headache',$var);
        }
        if (isset($_POST["muscle"]))       
            $Symptom_tuple->bindParam(':muscle', $_POST["muscle"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':muscle',$var);
        }
        if (isset($_POST["diarrhea"]))      
            $Symptom_tuple->bindParam(':diarrhea', $_POST["diarrhea"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':diarrhea',$var);
        }
        if (isset($_POST["throat"]))      
            $Symptom_tuple->bindParam(':throat', $_POST["throat"]);
        else{
            $var = 0;
            $Symptom_tuple->bindParam(':throat',$var);
        }
        if (isset($_POST["other"]))      
            $Symptom_tuple->bindParam(':other', $_POST["other"]);
        else{
            $var = "";
            $Symptom_tuple->bindParam(':other',$var);
        }
        if ($Symptom_tuple->execute()){
            header("Location: ../");
            echo "executed";
        }
        else{
            echo"false";
        }
    }
    else{
        echo "Date is required";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill form</title>
</head>

<body>
    <h1>Symptom Form</h1>
    <form action="" method="post">
    <label for="date_time">Date-time(yyyy-mm-dd hh:mm:ss)</label><br>
    <input type="text" name="date_time" id="date" > <br/>
    <input type="checkbox" id="sympt1" name="fever" value="1">
    <label for="fever"> fever (temperature exceeding 38.1 degrees Celsius or 100.6 degrees Fahrenheit)</label><br>
    <input type="checkbox" id="sympt2" name="cough" value="1">
    <label for="cough">cough</label><br>
    <input type="checkbox" id="sympt3" name="breath" value="1">
    <label for="breath">shortness of breath or difficulty breathing,</label><br>
    <input type="checkbox" id="sympt4" name="taste_loss" value="1">
    <label for="taste-loss"> loss of taste and smell.</label><br>
    <input type="checkbox" id="sympt5" name="nausea" value="1">
    <label for="nausea"> nausea.</label><br>
    <input type="checkbox" id="sympt6" name="stomache" value="1">
    <label for="stomache"> stomache aches.</label><br>
    <input type="checkbox" id="sympt7" name="vomitting" value="1">
    <label for="vomitting"> vomitting.</label><br>
    <input type="checkbox" id="sympt8" name="headache" value="1">
    <label for="headache"> headache.</label><br>
    <input type="checkbox" id="sympt9" name="muscle" value="1">
    <label for="muscle"> muscle pain.</label><br>
    <input type="checkbox" id="sympt10" name="diarrhea" value="1">
    <label for="diarrhea"> diarrhea.</label><br>
    <input type="checkbox" id="sympt11" name="throat" value="1">
    <label for="throat"> sore throat.</label><br>
    <label for="other">Other</label><br>
    <input type="text" name="other" id="other" > <br/>
    <input type="submit" value="Submit Form" name="submit"/>
    </form>
    <a href="./">Back to list</a>
</body>

</html>
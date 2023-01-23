<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <?php

        // connect to mySQL database using PHP PDO Object
        $dbName = getenv('DB_NAME'); 
        $dbUser = getenv('DB_USER'); 
        $dbPassword = getenv('DB_PASSWORD'); 
        $dbHost = getenv('DB_HOST'); 
        
        $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword); 

        // the following tells PDO we want it to throw Exceptions for every error.
        // this is far more useful than the default mode of throwing php errors
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        

        // prepare and execute the select statements
        $sqlStatement = $dbConnection->query("select * from books");

        echo '<div class="container-fluid p-5">';

            echo '<div class="h3">My favourite Books</div>';
            echo '<table class="table table-striped">';
        
                // print header area automatically 
                $columnCount = $sqlStatement->columnCount();
                echo "<thead>";
                    echo "<tr>";

                        for ($counter = 0; $counter < $columnCount; $counter ++) {
                            $columnInfo = $sqlStatement->getColumnMeta($counter);
                            $columnName = $columnInfo['name'];
                            echo "<th>$columnName</th>"; 
                        }
                        
                    echo '</tr>';    
                echo "</thead>";
                // end print header area

                // print row values of select statement result
                echo "</body>";            

                    while ($row = $sqlStatement->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        foreach ($row as $columnName => $value) {
                            echo "<td>$value</td>";
                        }
                        echo '</tr>';                    ;
                    }

                echo "</body>";                

            echo '</table>';        
        echo '</div>';        

        /*
            // prepare the statement. the placeholders allow PDO to handle substituting
            // the values, which also prevents SQL injection
            $stmt = $dbConnection->prepare("SELECT * FROM product WHERE productTypeId=:productTypeId AND brand=:brand");

            // bind the parameters
            $stmt->bindValue(":productTypeId", 6);
            $stmt->bindValue(":brand", "Slurm");        
        */


        /*
            $query  = $connection->query("SELECT * from Question");
            $questions = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($questions as $question) {
                $subQuery  = $connection->prepare("SELECT * from Answer where Answer.QuestionId = ?");
                $subQuery->bindValue(1, $question['Id']);
                $subQuery->execute(); 
                $answers = $subQuery->fetchAll(PDO::FETCH_ASSOC);
                $question['answers'] = $answers;
                print "<pre/>";            
                print_r($question);
                //print_r($question['answers'][0]);
            }    

            print "<h1>Example with FETCH_NUM</h1>";

            $query  = $connection->query("SELECT * from Question");
            $questions = $query->fetchAll(PDO::FETCH_NUM);
            foreach($questions as $question) {
                print "<pre/>";            
                print_r($question);
            }    

            print "<h1>Example with FETCH_BOTH</h1>";

            $query  = $connection->query("SELECT * from Question");
            $questions = $query->fetchAll(PDO::FETCH_BOTH);
            foreach($questions as $question) {
                print "<pre/>";            
                print_r($question);
            }      
        */


        /*
        //this section will select all the tables in your database.
        //if there are any tables, they will be displayed as a list, otherwise there will be an error message

        $dbConnection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);

        $query      = $dbConnection->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = '" . DB_NAME . "'");
        $tables     = $query->fetchAll(PDO::FETCH_COLUMN);

        
        if (empty($tables)) {
            echo "<p class='center'>There are no tables in database <code>" . DB_NAME . "</code>.</p>";
        } else {
            echo '<p class="center">Database <code>demo</code> contains the following tables:</p>';
            echo '<ul class="center">';
            foreach ($tables as $table) {
                echo "<li>{$table}</li>";
            }
            echo '</ul>';
        }

      

        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

          */




    ?>
    
</body>
</html>
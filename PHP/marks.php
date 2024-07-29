<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Paragraph Similarity Checker</title>
<link rel="stylesheet" href= 
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> 

<link rel="stylesheet" href="style.css">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }
    .container {
        position: absolute;
        top:120px;
        left:450px;
      width:40%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 30px 0 rgb(235, 239, 10); 
    }
    h2 {
        text-align: center;
        color: #333;
    }
    form {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }
    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
    #similarityScore {
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
    }

    #background-video {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1; /* Make sure the video stays behind other content */
    object-fit: cover; /* Cover the entire viewport */
  }

  /* Additional styling for content */
  .content {
    position: relative;
    z-index: 1; /* Place content above the video */
    color: #fff;
    text-align: center;
    padding: 50px;
  }


  
#h{
    color: #eff3f4;
}

img
{

width: 10%;
height: 100%;
position: absolute;
left: 0px;
top: 0px;

}

#v
{
    position: absolute;
    left: 750px;
    font-family: sans-serif;
  text-transform: uppercase;
  font-size: 2.3em;
  letter-spacing: 4px;
  overflow: hidden;
  background: linear-gradient(90deg, #000, #fff, #000);
  background-repeat: no-repeat;
  background-size: 80%;
  animation: animate 3s linear infinite;
  -webkit-background-clip: text;
  -webkit-text-fill-color: rgba(1, 149, 67, 0);
}

@keyframes animate {
  0% {
    background-position: -500%;
  }
  100% {
    background-position: 500%;
  }
}

</style>
</head>
<body>

<video id="background-video" autoplay muted loop>
        <source src="video4.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>


      <nav>
        <div class="nav-bar">
            <i id="pp" class='bx bx-menu sidebarOpen' ></i>
            <span class="logo navLogo"><a href="#"><img src="1c.png" alt=""></a></span> 
            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="#">CodingLab</a></span>
                    <i id="pp" class='bx bx-x siderbarClose'></i>
                </div>
                <ul class="nav-links">
                    <li><a href="demo.html"><i  id="h"class="fas fa-home"></i>&nbsp;Home</a></li> 
                    <li><a href="about.html"><i id="h" class="fas fa-user"></i>&nbsp;About</a></li>
                    
                    <li><a href="services.html"><i id="h" class="fas fa-cog"></i>&nbsp;Services</a></li>
                    <li><a href="contact.html"><i id="h" class="fas fa-envelope"></i>&nbsp;Contact</a></li>

                    <li id="v">VIVA-EVAL </li>
                    
                </ul>
            </div>
            <div class="darkLight-searchBox">
                <div class="dark-light">
                    <i id="pp" class='bx bx-moon moon'></i>
                    <i id="pp" class='bx bx-sun sun'></i>
                </div>
                <div class="searchBox">
                   <div class="searchToggle">
                    <i id="pp" class='bx bx-x cancel'></i>
                    <i id="pp" class='bx bx-search search'></i>
                   </div>
                    <div class="search-field">
                        <input type="text" placeholder="Search...">
                        <i id="pp" class='bx bx-search'></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

<div class="container">
    <h2>!! CHECK YOUR MARKS HERE !!</h2>

    <form method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id">

        <label for="branch">Branch:</label>
        <input type="text" id="branch" name="branch">

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject">

     <center>   <button type="submit" name="submit">Calculate Marks</button> </center>
       
    </form>

   <center> <button type="button" onclick="window.location.href='demo.html';">Go to Home</button> </center>

    <div id="similarityScore">
        <?php
        // Database connection
        include 'student_con.php';

        function levenshteinDistance($str1, $str2) {
            $len1 = strlen($str1);
            $len2 = strlen($str2);

            $matrix = [];
            for ($i = 0; $i <= $len1; $i++) {
                $matrix[$i] = [];
                for ($j = 0; $j <= $len2; $j++) {
                    if ($i == 0) {
                        $matrix[$i][$j] = $j;
                    } elseif ($j == 0) {
                        $matrix[$i][$j] = $i;
                    } else {
                        $cost = ($str1[$i - 1] != $str2[$j - 1]) ? 1 : 0;
                        $matrix[$i][$j] = min(
                            $matrix[$i - 1][$j] + 1,
                            $matrix[$i][$j - 1] + 1,
                            $matrix[$i - 1][$j - 1] + $cost
                        );
                    }
                }
            }

            return $matrix[$len1][$len2];
        }

        function calculateTF($sentence) {
            $words = preg_split('/\s+/', $sentence, -1, PREG_SPLIT_NO_EMPTY);
            $wordCount = array_count_values($words);
            $tf = array();
            $totalWords = count($words);
            
            foreach ($wordCount as $word => $count) {
                $tf[$word] = $count / $totalWords;
            }
            
            return $tf;
        }
        
        // Function to calculate IDF
        function calculateIDF($sentences) {
            $idf = array();
            $totalSentences = count($sentences);
            
            foreach ($sentences as $sentence) {
                $words = preg_split('/\s+/', $sentence, -1, PREG_SPLIT_NO_EMPTY);
                $words = array_unique($words);
                
                foreach ($words as $word) {
                    if (!isset($idf[$word])) {
                        $count = 0;
                        foreach ($sentences as $s) {
                            if (strpos($s, $word) !== false) {
                                $count++;
                            }
                        }
                        $idf[$word] = log($totalSentences / $count);
                    }
                }
            }
            
            return $idf;
        }
        
        // Function to calculate TF-IDF
        function calculateTFIDF($tf, $idf) {
            $tfidf = array();
            
            foreach ($tf as $word => $tfValue) {
                $tfidf[$word] = $tfValue * $idf[$word];
            }
            
            arsort($tfidf);
            
            return $tfidf;
        }

        if(isset($_POST['submit'])){
            // Retrieve the ID, branch, and subject from the form submission
            $id = $_POST['id'];
            $branch = $_POST['branch'];
            $subject = $_POST['subject'];

            // Fetch data from the database based on provided ID, branch, and subject
            $sql = "SELECT result, answer FROM `check` WHERE id = '$id' AND branch = '$branch' AND subject = '$subject'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $answer = $row['answer'];
                $result_text = $row['result'];
                
                // Apply TF-IDF algorithm to extract top 20 keywords
                $sentences = array($answer, $result_text);
                $idf = calculateIDF($sentences);
                $tf = calculateTF($answer);
                $tfidf = calculateTFIDF($tf, $idf);
                $keywords = array_keys(array_slice($tfidf, 0, 20));
                
                // Calculate the percentage of matching keywords
                $matching_keywords = 0;
                foreach($keywords as $keyword) {
                    if(strpos($result_text, $keyword) !== false) {
                        $matching_keywords++;
                    }

                    
                }

                if (!empty($keywords)) {
                    $percentage_matching = ($matching_keywords / count($keywords)) * 100;
                    echo "Percentage of matching keywords: " . $percentage_matching . "%<br>";

                    // Calculate the Levenshtein distance
                    $distance = levenshteinDistance($result_text, $answer);

                    // Scale the similarity score to a range of 0 to 10
                    $similarity = 10 * (1 - ($distance / max(strlen($result_text), strlen($answer))));

                    // Output the similarity score
                    echo "Similarity Score (out of 10): " . number_format($similarity, 2) . "<br>";

                    // Assign marks based on percentage
                    if ($percentage_matching >= 0 && $percentage_matching <= 5) {
                        $percentage_marks = 2;
                    } elseif ($percentage_matching > 5 && $percentage_matching <= 10) {
                        $percentage_marks = 2.5;
                    } elseif ($percentage_matching > 10 && $percentage_matching <= 15) {
                        $percentage_marks = 3;
                    } elseif ($percentage_matching > 15 && $percentage_matching <= 20) {
                        $percentage_marks = 3.5;
                    } elseif ($percentage_matching > 20 && $percentage_matching <= 25) {
                        $percentage_marks = 4;
                    } elseif ($percentage_matching > 25 && $percentage_matching <= 30) {
                        $percentage_marks = 4.5;
                    } elseif ($percentage_matching > 30 && $percentage_matching <= 35) {
                        $percentage_marks = 5.5;
                    } elseif ($percentage_matching > 35 && $percentage_matching <= 40) {
                        $percentage_marks = 6.5;
                    } elseif ($percentage_matching > 40 && $percentage_matching <= 45) {
                        $percentage_marks = 7;
                    } elseif ($percentage_matching >45 && $percentage_matching <= 50) {
                        $percentage_marks = 7.5;
                    } elseif ($percentage_matching > 50 && $percentage_matching <= 60) {
                        $percentage_marks = 8;
                    } elseif ($percentage_matching > 60 && $percentage_matching <= 70) {
                        $percentage_marks = 8.5;
                    } else {
                        $percentage_marks = 10;
                    }

                    // Assign marks based on similarity score
                    if ($similarity >= 0 && $similarity <= 0.5) {
                        $marks = 2;
                    } elseif ($similarity > 0.5 && $similarity <= 1) {
                        $marks = 3;
                    } elseif ($similarity > 1 && $similarity <= 1.5) {
                        $marks = 4;
                    } elseif ($similarity > 1.5 && $similarity <= 2) {
                        $marks = 5;
                    } elseif ($similarity > 2 && $similarity <= 2.5) {
                        $marks = 5.5;
                    } elseif ($similarity > 2.5 && $similarity <= 3) {
                        $marks = 6.5;
                    } elseif ($similarity > 3 && $similarity <= 3.5) {
                        $marks = 7;
                    } elseif ($similarity > 3.5 && $similarity <= 4) {
                        $marks = 7.5;
                    } elseif ($similarity > 4 && $similarity <= 4.5) {
                        $marks = 8;
                    } elseif ($similarity > 4.5 && $similarity <= 5) {
                        $marks = 8.5;
                    } elseif ($similarity > 5 && $similarity <= 5.5) {
                        $marks = 9;
                    } else {
                        $marks = 9.5;
                    }

                    // Calculate total marks
                    $total_marks = ($percentage_marks + $marks) / 2;
                    
                    // Insert or update total marks into the database
                    $sql_insert = "UPDATE `check` SET marks = '$total_marks' WHERE id = '$id' AND branch = '$branch' AND subject = '$subject'";
                    $result_insert = $con->query($sql_insert);
                    if ($result_insert === TRUE) 
                    {
                        echo "Total Marks " ;
                        echo $total_marks ;
                    }
                
                    
                     else {
                        // If update fails, try to insert
                        $sql_insert = "INSERT INTO `check` (id, branch, subject, marks) VALUES ('$id', '$branch', '$subject', '$total_marks') ";
                        if ($con->query($sql_insert) === TRUE) {
                            echo "Total Marks successfully stored in the database.";
                        } 
                        else {
                            echo "Error: " . $sql_insert . "<br>" . $con->error;
                        }
                    }
                } else {
                    echo "No keywords found for comparison.<br>";
                }
            } else {
                // If no data found, output error message
                echo "No data found for the provided ID, branch, and subject.";
            }
        }

        // Close the database connection
        $con->close();
        ?>
    </div>
</div>

</body>
</html>

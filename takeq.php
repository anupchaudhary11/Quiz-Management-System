<html>
<head>
    <title>
        Quiz Management System
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
require_once 'sql.php';
                $conn = mysqli_connect($servername, $username, $password, $dbname);if (!$conn) {
    echo "<script>alert(\"Database error retry after some time !\")</script>";
}
?>
<style>
    li {
        margin: 1.5vw;
        font-size: 1rem !important;
        font-weight: 2vw !important;
    }

    ul {
        list-style: none;
        width: auto !important;
    }

    .navbar {
        background-color:#fff !important;
        font-size: 1.5vw;
        position: fixed;
    }

    .navbar>ul>li:hover {
        color: #042A38;
        text-decoration: underline;
        font-weight: bold;
        cursor: default;
        cursor: pointer;

    }
    
    .navbar>ul>li>a:hover {
        color: #042A38;
        text-decoration: underline;
        font-weight: bold !important;
    }

    a {
        text-decoration: none;
        color: #042A38;
    }
    .prof{
            top: 5vw;
            position: fixed;
            width: 35vw !important;
            height:15vw !important;
            margin-left: 34vw !important;
            margin-right: 20vw !important;
            background-color: #fff !important;
            border-radius: 10px;
            margin-top: 0.5rem;
            z-index: 1;
            padding: 1vw;
            padding-left: 1vw;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        img{
            width: 100%;
            display:block;
            object-fit: cover;
        }

        .container1{

            color: #042A38;
            font-size:15px;
            line-height: 0.3rem;
            grid-column:1;
        }
        .container2{
            width:6rem;
            height:6rem;
            border-radius: 50%;
            overflow: hidden;
            margin-left: 3rem;  
            margin-top: 3.5rem;
            border: 0.1rem solid black;
            grid-column: 2;
        }
        #score{
            top: 3vw;
            position: fixed;
            width: 50vw !important;
            margin-left: 25vw !important;
            margin-right: 25vw !important;
            background-color: #fff!important;
            display: none !important;
            border-radius: 10px;
            margin-top: 2vw;
            z-index: 1;
            padding: 1vw;
            padding-left: 2vw;
            color: #042A38;
        }
        input{
            margin:1vw;
        }
    @media screen and (max-width: 450px) {
        .navbar {
            display: initial !important;

        }

        .navbar>ul {
            display: initial !important;
            left: 25vw !important;
            text-align: center;
            right: 25vw !important;
        }

        .navbar>ul>li {
            background-color: orange !important;
        }

        section {
            text-align: center;
            margin-top: 0 !important;
            background-color: orange !important;
            width: 100vw;
            margin: 0 !important;
        }
        p{
            color:#042A38 !important;
        }
        
    }
    #btn{
     
        height: 3vw;width: 10vw;font-family: 'Roboto', sans-serif;font-weight:bolder;border-radius: 10px;border: 2px solid black;background-color: lightblue;
    }
    table{
        width: 90vw;
        margin-left: 5vw;
        margin-right: 5vw;
        align-content: center;
        border: 1px solid black;
    }
    thead{
        font-weight:900;
        font-size: 1.5vw;
    }
    td{
        width: auto;
        border: 1px solid black;
        text-align: center;
        height: 4vw;
        font-weight: bold;
   }
    #tq{
        text-decoration: underline;
    }
    #sc{
        width: 100% !important;
        margin: 0%;
        color: #042A38;
            }
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background:rgb(104, 155, 233);
        }
        
        .quiz-container {
            margin: 4vw 10vw;
            width: 80vw;
            background: Baby Blue;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        /* Question Styles */
        .question {
            display: none;
            margin-bottom: 20px;
            transition: opacity 0.3s ease;
        }

        .question.active {
            display: block;
            opacity: 1;
        }

        .question.hidden {
            display: none !important;
            opacity: 0;
        }

        /* Options Styles */
        .options {
            margin-top: 15px;
        }

        .options label {
            display: block;
            padding: 15px;
            margin: 5px 0;
            background: #e3f2fd;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            font-size: 1.1rem;
            color: #042A38;
            border: 1px solid #b3e5fc;
        }

        .options label:hover {
            background: #bbdefb;
            transform: translateX(5px);
        }

        .options input[type="radio"] {
            margin-right: 10px;
            vertical-align: middle;
        }

        /* Navigation Buttons */
        .nav-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background: #007bff;
            color: white;
            font-size: 1rem;
            transition: background 0.3s, transform 0.2s;
        }

        .btn:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .btn:disabled {
            background: #cccccc;
            cursor: not-allowed;
        }

        /* Submit Button (Green) */
        #submitBtn {
            display: none;
            background: #28a745;
        }

        #submitBtn:hover {
            background: #218838;
        }

        /* Score Popup */
        #scorePopup {
            display: none;
            position: fixed;
            top: 50%;
            left: 35%;
            transform: translateX(-50%, -50%);
            background:White;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            width: 80vw;
            max-width: 500px;
            text-align: center;
        }

        #scorePopup h2 {
            margin: 0 0 10px;
            color: #28a745;
            font-size: 1.5rem;
        }

        #scorePopup p {
            margin: 10px 0;
            font-size: 1.1rem;
            color: #042A38;
        }

        #scorePopup .btn {
            background: #007bff;
            margin-top: 15px;
        }

        #scorePopup .btn:hover {
            background: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .quiz-container {
                width: 90vw;
                margin: 5vw;
            }

            .btn {
                padding: 8px 15px;
                font-size: 0.9rem;
            }

            #scorePopup {
                width: 90vw;
                max-width: 90vw;
            }
        }
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&display=swap" rel="stylesheet">
<body style="margin: 0 !important;height:auto;font-weight: bolder !important;font-family: 'Roboto', sans-serif;color: #fff">
    <div style="background-color:rgb(25, 131, 170);height: auto;">
    <div class="navbar" style="display: grid;width: 85%;height:3rem;color:#042A38;position:fixed;border-radius:10rem;margin-top:1.5rem;margin-left:6.5rem;font-weight:bolder;">
    <section style="margin-left: 3rem; height:3rem; display:grid; padding-top: 8px; padding-bottom: 3px; font-size: 1.5rem; font-family: 'Libre Baskerville', serif;">
    <a href="" style="text-decoration: none; color: inherit;">Quiz Management System</a>
    <ul style="display: inline-flex;padding: 0 !important;margin-top: 0;float: right;right: 10rem;top:0.8rem;position: fixed;width: 50vw;">
                <li><a href="homestud.php" class="login-button" style="text-decoration: none; color: inherit;">Dashboard</a></li>
                <li onclick="prof()">Profile</li>
                <li onclick="prof()">Profile</li>
                <li onclick="score()">Score</li>
                <li onclick="lo()">Sign Out</li>
            </ul>
        </div><br><br>
        <?php
        $type1 = $_SESSION["type"];
        $username1 = $_SESSION["username"];
        $sql = "select * from " . $type1 . " where mail='{$username1}'";
        $res =   mysqli_query($conn, $sql);
        if ($res == true) {
            global $dbmail, $dbpw;
            while ($row = mysqli_fetch_array($res)) {
                $dbmail = $row['mail'];
                $dbname = $row['name'];
                $dbusn = $row['usn'];
                $dbphno = $row['phno'];
                $dbgender = $row['gender'];
                $dbdob = $row['DOB'];
                $dbdept = $row['dept'];
            }
        }
        ?>
        <body>
        <div class="quiz-container">
        <?php
        if (isset($_GET["qid"])) {
            $qid = mysqli_real_escape_string($conn, $_GET["qid"]); // Basic sanitization
            // Use prepared statement for security
            $sql = "SELECT * FROM questions WHERE quizid = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $qid);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            if ($res) {
                $count = mysqli_num_rows($res);
                if ($count == 0) {
                    echo "<p>No questions found under this quiz. Please check back later.</p>";
                } else {
                    echo "<form id='quizForm' method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?qid=" . urlencode($qid) . "'>";
                    $i = 1;
                    $answers = [];

                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<div class='question' id='q$i'>";
                        echo "<h3>$i. " . htmlspecialchars($row["qs"]) . "</h3>"; // Prevent XSS
                        $options = array($row["op1"], $row["op2"], $row["op3"], $row["op4"]);
                        shuffle($options);
                        $answers[$i] = $row["answer"];

                        echo "<div class='options'>";
                        foreach ($options as $option) {
                            echo "<label><input type='radio' name='ans$i' value='" . htmlspecialchars($option) . "'> " . htmlspecialchars($option) . "</label>";
                        }
                        echo "</div>";
                        echo "</div>";
                        $i++;
                    }

                    echo "<div class='nav-buttons'>";
                    echo "<button type='button' class='btn' id='prevBtn' onclick='navigate(-1)' disabled>Previous</button>";
                    echo "<button type='button' class='btn' id='nextBtn' onclick='navigate(1)'>Next</button>";
                    echo "<button type='submit' class='btn' id='submitBtn' name='submit' style='display:none;'>Submit</button>";
                    echo "</div>";
                    echo "</form>";

                    // Score and thank-you popup
                    echo "<div id='scorePopup'>";
                    echo "<h2>Your Results</h2>";
                    echo "<p id='scoreText'></p>";
                    echo "<p id='thankYouMessage' style='display: none;'>Thank you for participating in our Quiz Management System! We value your engagement.</p>";
                    echo "<button class='btn' id='closeBtn' onclick='closePopup()'>Close</button>";
                    echo "</div>";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // Handle form submission
            if (isset($_POST["submit"])) {
                $score = 0;
                for ($i = 1; $i <= $count; $i++) {
                    if (isset($_POST["ans$i"]) && trim($_POST["ans$i"]) == trim($answers[$i])) {
                        $score++;
                    }
                }

                // Use prepared statement for inserting score
                $stmt = mysqli_prepare($conn, "INSERT INTO score(score, mail, quizid, totalscore) VALUES(?, ?, ?, ?)");
                mysqli_stmt_bind_param($stmt, "issi", $score, $dbmail, $qid, $count);
                $res = mysqli_stmt_execute($stmt);

                if ($res) {
                    echo "<script>
                        // Hide all questions and navigation after submission
                        document.querySelectorAll('.question').forEach(q => q.classList.add('hidden'));
                        document.querySelector('.nav-buttons').style.display = 'none';

                        // Show score and thank-you message in popup
                        const scoreText = document.getElementById('scoreText');
                        const thankYouMessage = document.getElementById('thankYouMessage');
                        const closeBtn = document.getElementById('closeBtn');
                        if (scoreText && thankYouMessage && closeBtn) {
                            scoreText.innerText = 'You scored $score out of $count';
                            scoreText.style.display = 'block';
                            thankYouMessage.style.display = 'block';
                            closeBtn.style.display = 'block';
                            document.getElementById('scorePopup').style.display = 'block';
                        } else {
                            console.error('Popup elements not found in DOM.');
                        }
                    </script>";
                } else {
                    echo "<script>alert('Error updating score: " . mysqli_error($conn) . "');</script>";
                }
                // Only close the statement here if it was successfully prepared and executed
                if ($stmt) {
                    mysqli_stmt_close($stmt);
                }
            }
            // Close the connection here, after all statement operations
            mysqli_close($conn);
        }
        ?>
    </div>

    <script>
        // Initialize variables for navigation
        let currentQuestion = 1;
        const totalQuestions = <?php echo isset($count) ? $count : 0; ?>; // Default to 0 if $count is not set

        // DOM content loaded event to ensure elements are available
        document.addEventListener('DOMContentLoaded', function() {
            // Show the first question if it exists
            const firstQuestion = document.getElementById('q1');
            if (firstQuestion) {
                firstQuestion.classList.add('active');
            } else {
                console.warn('First question (q1) not found in DOM.');
            }

            // Ensure form submission works without JavaScript interference
            const form = document.getElementById('quizForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Allow the form to submit to PHP naturally
                    console.log('Form submission triggered, processing via PHP...');
                });
            } else {
                console.error('Quiz form not found in DOM.');
            }
        });

        // Navigate between questions
        function navigate(direction) {
            // Validate navigation boundaries
            if (direction === -1 && currentQuestion === 1) return; // Prevent going before first question
            if (direction === 1 && currentQuestion === totalQuestions) return; // Prevent going after last question

            const current = document.getElementById('q' + currentQuestion);
            const next = document.getElementById('q' + (currentQuestion + direction));

            // Check if elements exist before manipulating
            if (current && next) {
                current.classList.remove('active');
                currentQuestion += direction;
                next.classList.add('active');

                // Update button states
                document.getElementById('prevBtn').disabled = currentQuestion === 1;
                document.getElementById('nextBtn').style.display = currentQuestion === totalQuestions ? 'none' : 'block';
                document.getElementById('submitBtn').style.display = currentQuestion === totalQuestions ? 'block' : 'none';
            } else {
                console.error('Question navigation error: Question element not found.');
            }
        }

        // Close the score popup and redirect to homestud.php
        function closePopup() {
            const popup = document.getElementById('scorePopup');
            if (popup) {
                popup.style.display = 'none';
                window.location.href = 'homestud.php'; // Redirect to home page immediately
            } else {
                console.error('Score popup not found in DOM.');
            }
        }
    </script>
</body>
</html>
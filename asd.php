<!DOCTYPE html>
<html>
<head>
    <title>Examination Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Examination Dashboard</h1>
    </header>

    <main>
        <section class="overview">
            <h2>Exam Overview</h2>
            <!-- Display overall exam details, statistics, etc. -->
            <p>Total Questions: 10</p>
            <p>Duration: 60 minutes</p>
            <!-- Add more relevant exam details here -->
        </section>

        <section class="questions">
            <h2>Answer Questions</h2>
            <!-- Questions and answer choices -->
            <div class="question" id="question1">
                <h3>Question 1: What is the capital of France?</h3>
                <input type="radio" name="q1" value="paris"> Paris<br>
                <input type="radio" name="q1" value="london"> London<br>
                <input type="radio" name="q1" value="berlin"> Berlin<br>
                <input type="radio" name="q1" value="rome"> Rome<br>
            </div>

            <div class="question" id="question2">
                <h3>Question 2: Who painted the Mona Lisa?</h3>
                <input type="radio" name="q2" value="vangogh"> Vincent van Gogh<br>
                <input type="radio" name="q2" value="davinci"> Leonardo da Vinci<br>
                <input type="radio" name="q2" value="picasso"> Pablo Picasso<br>
                <input type="radio" name="q2" value="rembrandt"> Rembrandt<br>
            </div>

            <!-- More questions can be added similarly -->
        </section>

        <button onclick="gradeExam()">Submit</button>

        <section class="results" id="examResults">
            <!-- Display exam results here -->
        </section>
    </main>

    <script src="dashboard.js"></script>
</body>
</html>


<style>
    /* Basic styling for the dashboard elements */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: white;
    padding: 20px;
    text-align: center;
}

main {
    padding: 20px;
}

.overview, .questions, .results {
    margin-bottom: 20px;
}

.question {
    margin-bottom: 15px;
}

</style>

<script>
    function gradeExam() {
    const q1Answer = document.querySelector('input[name="q1"]:checked').value;
    const q2Answer = document.querySelector('input[name="q2"]:checked').value;

    let correctAnswers = 0;
    let incorrectAnswers = 0;

    if (q1Answer === 'paris') {
        correctAnswers++;
    } else {
        incorrectAnswers++;
    }

    if (q2Answer === 'davinci') {
        correctAnswers++;
    } else {
        incorrectAnswers++;
    }

    const examResults = document.getElementById('examResults');
    examResults.innerHTML = `
        <h2>Results</h2>
        <p>Correct Answers: ${correctAnswers}</p>
        <p>Incorrect Answers: ${incorrectAnswers}</p>
    `;
}

</script>
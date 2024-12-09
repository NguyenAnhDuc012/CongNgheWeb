<?php
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$all_questions = [];
$current_question = [];
$answers = [];

foreach ($questions as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            $all_questions[] = $current_question;
        }
        $current_question = [$line];
    } elseif (strpos($line, "Đáp án:") === 0) {
        $answer = trim(substr($line, strpos($line, ":") + 1));
        $answers[] = $answer;
    } else {
        $current_question[] = $line;
    }
}
if (!empty($current_question)) {
    $all_questions[] = $current_question;
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trắc Nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Bài Trắc Nghiệm</h2>
        <form action="result.php" method="POST">
            <?php
            $number = 1;
            foreach ($all_questions as $question) {
            ?>
                <div class="card mb-4">
                    <div class="card-header">
                        <strong><?php echo $question[0]; ?></strong>
                    </div>
                    <div class="card-body">
                        <?php
                        for ($i = 1; $i <= 4; $i++) {
                            $answer = substr($question[$i], 0, 1); // A, B, C, D
                        ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question<?php echo $number; ?>" value="<?php echo $answer; ?>" id="question<?php echo $number . $answer; ?>">
                                <label class="form-check-label" for="question<?php echo $number . $answer; ?>"><?php echo $question[$i]; ?></label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            <?php
                $number++;
            }
            ?>
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </form>

    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Enter Your Name & Text</h1>

    <form id="textForm" class="form1" method="post" action="backend.php">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name">
            <small id="nameerr" class="error-msg"></small>
        </div>

        <div class="form-group">
            <label for="text">Text:</label>
            <input type="text" id="text" name="text">
            <small id="texterr" class="error-msg"></small>
        </div>

        <button type="submit" id="submit">Submit</button>
    </form>

    <div id="results"></div>

    <script src="./script.js"></script>
</body>
</html>

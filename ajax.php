<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <label for="day">select day of week</label>
    <select name="day" id="day" onchange="displayFullName()">
        <option value="sunday">sunday</option>
        <option value="monday">monday</option>
        <option value="tuesday">tuesday</option>
        <option value="wednesday">wednesday</option>
        <option value="thuesday">thursday</option>
        <option value="friday">friday</option>
        <option value="saturday">saturday</option>
    </select>
    <div id="result"></div>
    <script>
        function displayFullName() {
            var request = new XMLHttpRequest();
            let day = document.querySelector('#day').value;
            request.open("GET", `test.php?day=${day}`);

            request.send();
            request.onload = function () {
                document.getElementById("result").innerHTML = this.responseText;
            }
        }
    </script>
   
</body>

</html>

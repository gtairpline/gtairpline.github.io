<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="makecoffee.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="styelsheet.css" rel="stylesheet"> </head>

<body>
    <div class="wrapper">
        <div id="amountToMake">
            <form action="http://192.168.1.102:8000/web/index.php" id="form" method="post">
                <h1>How many cups would you like to make?</h1>
                <input type="submit" name="cups" value="1" />
                <input type="submit" name="cups" value="2" />
                <input type="submit" name="cups" value="3" />
                <input type="submit" name="cups" value="4" />
                <input type="submit" name="cups" value="5" />
                <input type="submit" name="cups" value="6" /> </form>
        </div>
        <div id="instructions" style="display:none">
            <h1 id="steps">Instructions will appear here!</h1>
            <input type="submit" id="done" value="Done" style="display: inline-block" />
            <input type="submit" id="timer" value="Start" style="display: none" /> </div>
        <script>
            $('form').submit(function (e) {
                $('#amountToMake').hide();
                $('#instructions').show();
                e.preventDefault();
            });
            var el = document.getElementById('steps');
            el.textContent = "Heat water to 95C";
            $('#done').click(function () {
                el.textContent = "Pre-wet filter thoroughly and discard water";
                $('#done').click(function () {
                    el.textContent = "Add {}g of Coffee".format(defaultCoffee * <?php echo $_POST['cups'] ?>);
                    $('#done').click(function () {
                        el.textContent = "Pour {0}g of Water onto Coffee grounds".format(bloomWater * <?php echo $_POST['cups'] ?>);
                        $('#done').click(function () {
                            $('#timer').show();
                            $('#done').hide();
                            el.textContent = "Wait {} seconds. Press Start for timer".format(bloomTime);
                            $('#timer').click(function () {
                                countdownBloom();
                                $('#timer').hide();
                            });
                            $('#done').click(function () {
                                $('#done').show();
                                el.textContent = "Add remaining {}g of Water to Coffee".format(brewWater);
                                $('#timer').hide();
                                $('#done').click(function () {
                                    el.textContent = "Wait {} seconds. Press Start for timer".format(brewTime);
                                    $('#timer').show();
                                    $('#done').hide();
                                    $('#timer').click(function() {
                                        countdownBrew();
                                        $('#done').hide();
                                    });
                                    $('#done').click(function () {
                                        el.textContent = "Done! Remove filter and enjoy your Coffee :)";
                                        $('#timer').hide();
                                    });
                                });
                            });
                        });
                    });
                });
            });
        </script>
    </div>
</body>

</html>
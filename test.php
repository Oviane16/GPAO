
<html>
<head>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript">

        function tester(){
            $.ajax({
                url: 'test2.php',
                method: 'post',
                data: {
                    'fichier': $('[name="fichier"]').val(),
                },
                dataType: 'json',
                success: function (data) {
                    if (data.tache == false) {

                        alert('ok');
                        return;
                    }

                }
            })};
    </script>
</head>
<body>
<input type="file" name="fichier"  onchange="tester()">

</body>
</html>
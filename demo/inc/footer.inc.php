<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/materialize.min.js"></script>
<script src="assets/js/scripts.js"></script>

<?php if ( isset($_GET["upload"] ) && $_GET["upload"] == "success"){ ?>

    <style>
        .toast{
            background: #26a69a;
        }

    </style>
    <script>

        Materialize.toast('Fichier téléchargé', 3000); // 'rounded' is the class I'm applying to the toast

    </script>

    <?php } if ( isset($_GET["upload"] ) && $_GET["upload"] == "error" && !isset($_GET["message"] )){ ?>

    <style>
        .toast{
            background: #e57373;
        }

    </style>

    <script>

        Materialize.toast('<span id="dialog-error">Il manque le fichier !</span>', 3000);// 'rounded' is the class I'm applying to the toast

    </script>
    <?php
} if ( isset($_GET["upload"]) && $_GET["upload"] == "error" &&  isset($_GET["message"]) ) { ?>
    <style>
        .toast{
            background: #e57373;
        }

    </style>

    <script>

        Materialize.toast('<span id="dialog-error">' + <?php echo '"'.$_GET["message"].'"'; ?> + '</span>', 3000);// 'rounded' is the class I'm applying to the toast

    </script>
    <?php
}
?>
</body>
</html>
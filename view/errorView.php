<?php $title = 'Error!';


ob_start(); ?>
        
<body>
    
    <div class="error">
        <p><?= $errorMessage ?></p>
    </div>

</body>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo URLROOT; ?>css/pdc.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>css/shared.css">

    <title>Testing View</title>
    <style>
        .maind {
            display: flex;
        }
    </style>
</head>

<body>
    <h2>
        THIS IS TEST VIEW
    </h2>
    <h2><?php 
    
    //echo $data['interests-list'];
        echo $data['experience-list'];

        echo $data['qualification-list'];
        // echo $data['extracurricular-list']; ?></h2>


</body>

</html>
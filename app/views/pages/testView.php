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
    <h2><?php echo $data['url']; ?></h2>

    <form action="<?php echo URLROOT . "profiles/test" ?> ">
        <input type="file" id="myFile" name="my_file">
        <button type="submit">submit</button>
    </form>

    <div class="common-status display-flex-row yellow-status-font ">

        <span class="common-status-span yellow-status">
        </span>
        Active
    </div>

</body>

</html>
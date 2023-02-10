<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing View</title>
</head>
<body>
    <h2>
    THIS IS TEST VIEW
    </h2>
    <h4><?php echo $data['data']; ?></h4>

<?php 
// foreach($allrows as $row){
//     echo '<h4>'.$row->email .'</h4>';
// }


?>
    <form action="<?php echo URLROOT . "pdc/test" ?> "  method = "POST">

    <textarea name="invitation_body" id="invitation_body" cols="30" rows="10"></textarea>
    <button type="submit">submit</button>
    </form>
</body>
</html>
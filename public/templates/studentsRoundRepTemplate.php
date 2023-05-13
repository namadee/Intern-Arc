<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Report</title>
    <style>
        * {
            font-family: sans-serif;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            color: #212121;
        }

        body {
            padding: 20px;
        }


        table {
            margin: auto;
            width: 100%;
            text-align: center;
            margin-top: 15px;
        }

        th {
            background-color: #f17300;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: 400;
            color: #ffffff;
        }

        tr {
            background-color: #efeff3;
        }

        td {
            padding: 5px 10px;
        }

        h3,
        h4 {
            text-align: center;
        }

        span {
            font-weight: bold;
        }
        p {
      
            margin: auto;
            margin-top: 15px;
            text-align: center;
        }
        i {
            font-size: 10px;
            
        }
    </style>
</head>

<body>
<i>Generated at : <?= $currentDateTime ?></i>

    <div>
        <div>
            <div>
                <h3>University of Colombo School of Computing</h3>
            </div>
            <div>
            
                <h4>Summary of <span><?= $stream ?></span> student applications in Round <span><?= $round ?></span> of the <?= $batchYear ?> batch year</h4>
                <p>Total <span><?= $stream ?></span> Students :<span><?= $studentRequestsCount ?> Students</span></p>
                <p>Total Recruited <span><?= $stream ?></span> Students :<span><?= $studentRequestsRecruitedCount ?> Students</span></p>

            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <th>Registration Number</th>
                    <th>Index Number</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($studentList as $student) : ?>
                    <tr>
                        <td style="<?php echo ($student->recruit_status == 'recruited') ? 'background-color: #dff2bf;' : ''; ?>"><?= $student->username ?></td>
                        <td style="<?php echo ($student->recruit_status == 'recruited') ? 'background-color: #dff2bf;' : ''; ?>"><?= $student->email ?></td>
                        <td style="<?php echo ($student->recruit_status == 'recruited') ? 'background-color: #dff2bf;' : ''; ?>"><?= $student->registration_number ?></td>
                        <td style="<?php echo ($student->recruit_status == 'recruited') ? 'background-color: #dff2bf;' : ''; ?>"><?= $student->index_number ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</body>

</html>
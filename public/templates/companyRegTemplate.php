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
    </style>
</head>

<body>
<i><?= $currentDateTime ?></i>

    <div>
        <div>
            <div>
                <h3>University of Colombo School of Computing</h3>
            </div>
            <div>
                <h4><?= $yearLabel ?></h4>
                <p>Total Count is <span><?= $count ?> Companies</span></p>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Contact Person</th>
                    <th>Contact Email</th>
                    <th>Registered Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allCompanies as $company) : ?>
                    <tr>
                        <td><?= $company->company_name ?></td>
                        <td><?= $company->username ?></td>
                        <td><?= $company->email ?></td>
                        <td><?= $company->created_at ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</body>

</html>
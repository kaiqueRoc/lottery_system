<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado dos Tickets</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            background-color: #fafafa;
        }
        td strong {
            color: #ff6347;
        }
    </style>
</head>
<body>

<h1>Resultado dos Tickets</h1>

<table>
    <thead>
    <tr>
        <th>Ticket</th>
        <th>Matches</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $result): ?>
        <tr>
            <td>
                <?php
                $ticketNumbers = array_map(function ($number) use ($result) {
                    return in_array($number, $result['matches']) ? "<strong>{$number}</strong>" : $number;
                }, $result['ticket']);
                echo implode(', ', $ticketNumbers);
                ?>
            </td>
            <td><?php echo implode(', ', $result['matches']); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>

<?php

namespace Helpers;

class HtmlRendererHelpers
{
    public static function renderTicketsTable(array $results): string
    {
        $tableRows = array_map(function ($result) {
            $ticketNumbers = array_map(fn ($num) => in_array($num, $result['matches']) ? "<strong>{$num}</strong>" : $num, $result['ticket']);

            return sprintf(
                '<tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">%s</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">%s</td>
                </tr>',
                implode(', ', $ticketNumbers),
                implode(', ', $result['matches'])
            );
        }, $results);

        return sprintf(
            '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Resultado dos Tickets</title>
                <style>
                    table { width: 100%%; border-collapse: collapse; margin-top: 20px; }
                    table, th, td { border: 1px solid #ddd; }
                    th, td { padding: 8px; text-align: center; }
                    th { background-color: #f2f2f2; }
                    td { background-color: #fafafa; }
                    td strong { color: #ff6347; }
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
                        %s
                    </tbody>
                </table>
            </body>
            </html>',
            implode('', $tableRows)
        );
    }
}

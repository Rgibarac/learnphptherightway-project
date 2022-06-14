<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th, table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th, tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }

    </style>
</head>
<body>
<?php if(!empty($transactions)): ?>
    <table>
        <thead>
        <tr>
            <th>Date</th>
            <th>Check #</th>
            <th>Description</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
            <?php $expence=0; $income=0; ?>
            <?php foreach($transactions as $transaction): ?>
                <tr>
                    <!-- Display logic -->
                    <td><?= htmlspecialchars($transaction[0]) ?></td>
                    <td>
                        <?= ($transaction[1] === 0) ? "" : htmlspecialchars($transaction[1]); ?>
                    </td>
                    <td><?= htmlspecialchars($transaction[2]) ?></td>
                    <td
                        <?php if ($transaction[3][0] == "-"): ?>
                            style='color: red;'
                        <?php else: ?>
                            style='color: green;'
                        <?php endif; ?>
                    >
                        <?php if($transaction[3][0] !== "-"): ?>
                            $<?= htmlspecialchars((float)(trim(str_replace( ',', '',$transaction[3]),"-$"))); ?>
                            <?php $income=$income+htmlspecialchars((float)(trim(str_replace( ',', '',$transaction[3]),"-$"))) ?>
                        <?php else: ?>
                            -$<?= htmlspecialchars(abs((float)trim(str_replace( ',', '',$transaction[3]),"-$"))); ?>
                            <?php $expence=$expence+htmlspecialchars(abs((float)trim(str_replace( ',', '',$transaction[3]),"-$"))) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
        <tr>
            <th colspan="3">Total Income:</th>
            <td>
                $<?=$income ?>

            </td>
        </tr>
        <tr>
            <th colspan="3">Total Expense:</th>
            <td>
                -$<?=$expence;?>
            </td>
        </tr>
        <tr>
            <th colspan="3">Net Total:</th>
            <td>
                $<?= $income-$expence;?>
            </td>
        </tr>
        </tfoot>
    </table>
</body>
</html>

<?php
// Hardcoded exchange rates
$exchangeRates = [
    'USD' => [
        'USD' => 1,
        'EUR' => 0.85,
        'GBP' => 0.73
    ],
    'EUR' => [
        'USD' => 1.18,
        'EUR' => 1,
        'GBP' => 0.86
    ],
    'GBP' => [
        'USD' => 1.37,
        'EUR' => 1.16,
        'GBP' => 1
    ]
    // Add more currencies and their exchange rates as needed
];

$convertedAmount = null;
$amount = null;
$fromCurrency = null;
$toCurrency = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST["amount"];
    $fromCurrency = $_POST["from-currency"];
    $toCurrency = $_POST["to-currency"];

    if (isset($exchangeRates[$fromCurrency][$toCurrency])) {
        $exchangeRate = $exchangeRates[$fromCurrency][$toCurrency];
        $convertedAmount = $amount * $exchangeRate;
    } else {
        $convertedAmount = "Conversion rate not available";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="converter-container">
        <h1>Currency Converter</h1>
        <form method="post">
            <div class="form-group">
                <label for="amount">Enter the amount:</label>
                <input type="number" step="any" id="amount" name="amount" value="<?php echo isset($amount) ? $amount : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="from-currency">From Currency:</label>
                <select id="from-currency" name="from-currency" required>
                    <option value="USD" <?php echo (isset($fromCurrency) && $fromCurrency == 'USD') ? 'selected' : ''; ?>>USD</option>
                    <option value="EUR" <?php echo (isset($fromCurrency) && $fromCurrency == 'EUR') ? 'selected' : ''; ?>>EUR</option>
                    <option value="GBP" <?php echo (isset($fromCurrency) && $fromCurrency == 'GBP') ? 'selected' : ''; ?>>GBP</option>
                </select>
            </div>
            <div class="form-group">
                <label for="to-currency">To Currency:</label>
                <select id="to-currency" name="to-currency" required>
                    <option value="EUR" <?php echo (isset($toCurrency) && $toCurrency == 'EUR') ? 'selected' : ''; ?>>EUR</option>
                    <option value="GBP" <?php echo (isset($toCurrency) && $toCurrency == 'GBP') ? 'selected' : ''; ?>>GBP</option>
                    <option value="USD" <?php echo (isset($toCurrency) && $toCurrency == 'USD') ? 'selected' : ''; ?>>USD</option>
                </select>
            </div>
            <button type="submit">Convert</button>
            <?php if (isset($convertedAmount)): ?>
                <div class="result">
                    <p>Converted Amount: <?php echo $convertedAmount; ?> <?php echo $toCurrency; ?></p>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>

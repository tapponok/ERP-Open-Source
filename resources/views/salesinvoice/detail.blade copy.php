<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Blue Invoice</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #f0f5f5;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #3498db;
            color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 1.8em;
        }

        header img {
            max-width: 150px;
            height: auto;
            margin-left: 20px;
        }

        header p {
            margin: 0;
            font-size: 1em;
        }

        main {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        .total {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            background-color: #3498db;
            color: #fff;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
        }

        .notes {
            background-color: #6cb2eb;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            flex-grow: 3;
            margin-right: 20px;
        }

        .total p {
            font-size: 1.5em;
            margin: 10px 0;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            flex-basis: 25%;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .invoice-details-left,
        .invoice-details-right {
            flex: 1;
        }

        .invoice-details-right {
            text-align: right;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            color: #555;
            padding: 10px;
            background-color: #f0f5f5;
            border-top: 1px solid #ddd;
        }

        footer p {
            margin: 5px 0;
        }

        /* Remove border for Invoice To and Invoice Details */
        .invoice-details, .invoice-details-left, .invoice-details-right {
            border: none;
        }
    </style>
</head>

<body>

    <header>
        <h1>Modern</h1>
        <img src="path/to/your/logo.png" alt="Your Logo">
        <p>Date: January 21, 2024</p>
    </header>

    <main>
        <table>
            <tr>
                <td>
                    <h2>Invoice To:</h2>
                    <p><strong>Name:</strong> John Doe</p>
                    <p><strong>Address:</strong> 123 Main St, Cityville</p>
                    <p><strong>Email:</strong> john.doe@example.com</p>
                </td>
                <td>
                    <h2>Invoice Details:</h2>
                    <p><strong>Invoice Number:</strong> 12345</p>
                    <p><strong>Sales Order Number:</strong> 67890</p>
                    <p><strong>Date:</strong> January 21, 2024</p>
                    <p><strong>Due Date:</strong> February 5, 2024</p>
                </td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Item 1</td>
                    <td>2</td>
                    <td>$10.00</td>
                    <td>$20.00</td>
                </tr>
                <tr>
                    <td>Item 2</td>
                    <td>1</td>
                    <td>$15.00</td>
                    <td>$15.00</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            <div class="notes">
                <h2>Notes</h2>
                <p>Please make the payment within 15 days.</p>
            </div>
            <p>Total: <span>$35.00</span></p>
        </div>

        <footer>
            <p>Thank you for your business!</p>
        </footer>
    </main>

</body>

</html>

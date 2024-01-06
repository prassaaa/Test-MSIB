<!-- application/views/add_coupon_view.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coupon</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <?php echo form_open('home/add_coupon'); ?>

    <label for="code">Kode Kupon : </label>
    <input type="text" name="code" required>

    <label for="start_date">Discount Harga :</label>
    <input type="text" name="credit" required>

    <label for="expired_date">Expired Date :</label>
    <input type="date" name="expired_date" required>

    <button type="submit">Add Coupon</button>
    <br/>
    <br/>
    <a href="generateVoucher">kembali</a>

    <?php echo form_close(); ?>


   
    
</body>


</html>

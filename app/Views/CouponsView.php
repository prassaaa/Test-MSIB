<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .green-background {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        .cart-wrap {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .cart-total h3 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .n-subtotal,
        .n-total {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .text-muted {
            color: #6c757d;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <form action="<?= base_url('home/generateVoucher') ?>" method="post">
            <?php
            $hargaSetelahDiskon = $is_used ? $harga - $coupon_credit : $harga;
            ?>
            <button type="button" class="btn btn-primary" onclick="createCoupon()">Create Kupon</button>

<script>
    function createCoupon() {
        window.location.href = '<?= base_url('home/add_coupon') ?>';
    }
</script>

            <div class="row">
        
            <?php if ($harga >= 2000000) : ?>
                    <div class="col-md-6 mb-4">
                        <div class="cart-wrap ftco-animate">
                            <h3>Kode Kupon</h3>
                            <p>Punya kode kupon? Gunakan kupon kamu untuk mendapatkan potongan harga menarik.</p>

                            <div class="form-group">
                                <label for="code">Kode :</label>
                                <input id="code" name="coupon_code" type="text" class="form-control" placeholder="">
                            </div>
                            <p class="text-success">Terima kasih! Subtotal Anda melebihi Rp.2.000.000<br />Anda Bisa Memasukan Kode Kupon.</p>

                        </div>
                    </div>
                <?php else : ?>
                    <div class="col-md-6 mb-4">
                        <div class="cart-wrap ftco-animate">
                            <p class="text-danger">Maaf, Subtotal Anda kurang dari Rp.2.000.000 <br /> Kode Kupon tidak tersedia.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-md-6 mb-4">
                    <div class="cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Rincian Keranjang</h3>
                            <p class="d-flex">
                                <span class="text-muted" style="font-size: 20px;">Suptotal :</span>
                                <span class="ml-auto n-subtotal">Rp <?= number_format($harga, 0, ',', '.') ?></span>
                            </p>

                            <p class="<?= $is_used ?>">
                                <span class="text-muted" style="font-size: 20px;">Kupon : <?= $coupon_code ?></span>
                            </p>

                            <p>
                                <span class="text-muted" style="font-size: 20px;">Discount kupon : <?= $discount ?></span>
                            </p>
                          <!-- Add this section to display the expiration date -->
<p>
    <span class="text-muted" style="font-size: 20px;">Berlaku hingga : <?= $expired_date ? date('d F Y', strtotime($expired_date)) : ''; ?></span>
</p>

                            <hr>
                            <p class="d-flex total-price">
                                <span class="text-muted" style="font-size: 20px;">Total :</span>
                                <span class="ml-auto n-total">Rp <?= number_format($hargaSetelahDiskon, 0, ',', '.') ?></span>
                            </p>
                        </div>
                        <p class="text-right"><button type="submit" class="btn btn-primary px-4">Checkout</button></p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Optional: Add Bootstrap JS and Popper.js if needed -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>

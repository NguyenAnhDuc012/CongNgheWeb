<?php include 'flowers.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h1>14 loại hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè</h1>
            <?php foreach ($flowers as $flower): ?>
                <div class="flower mt-3">
                    <span style="font-weight: bold;"><?php echo $flower['id']; ?> - <?php echo $flower['name']; ?></span>
                    <p class="mt-2"><?php echo $flower['description']; ?></p>
                    <?php foreach ($flower['images'] as $image): ?>
                        <img src="<?php echo $image; ?>" alt="<?php echo $flower['name']; ?>" style="max-width: 100%; height: auto; margin-top: 24px;">
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="col-md-3"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>
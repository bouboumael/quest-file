<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_FILES['avatar']['tmp_name'] !== '') {
        $extensionsAuthorized = ['jpg', 'jpeg', 'png', 'webp'];
        $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $maxFileSize = 1000000;

        $uploadDir = 'public/uploads/';

        $uploadFile = $uploadDir . uniqid() . '_' . basename($_FILES['avatar']['name']);

        var_dump($_FILES, $uploadFile);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>file quest</title>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="col-6">
            <?php if (!isset($user)) : ?>
                <div class="card-user col-12 col-sm-10 offset-sm-1 col-lg-8 offset-lg-2">
                    <div class="card-picture-user" class="col-12"><img src="/assets/images/klipartz.com.png" alt=""></div>
                    <div class="card-header-user">sssss</div>
                    <div class="card-body-user">ssssss</div>
                </div>
            <?php endif ?>
            <form action="" method="post" enctype="multipart/form-data" class="mt-5">
                <div class="mb-3">
                    <label for="lastname" class="form-label">Lastname</label>
                    <input type="text" name="lastname" id="lastname" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="firstname" class="form-label">Firstname</label>
                    <input type="text" name="firstname" id="firstname" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="adress" class="form-label">Adress</label>
                    <input type="text" name="adress" id="adress" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="sex" class="form-label">Sex</label>
                    <select name="sex" id="sex" class="form-select">
                        <option value="F">Femelle</option>
                        <option value="M">Male</option>
                    </select>
                </div>
                <label for="hair" class="form-label">Choice Hair</label>
                <select name="hair" id="hair" class="form-select">
                    <option value="none">None</option>
                    <option value="ginger">Ginger</option>
                    <option value="blond">Blond</option>
                    <option value="Dark">Dark blond</option>
                </select>
                <div class="mb-3">
                    <label for="avatar" class="form-label">Upload your avatar</label>
                    <input class="form-control" type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>
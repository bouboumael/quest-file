<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];
    $dataForm = array_map('trim', $_POST);
    foreach ($dataForm as $inputName => $inputValue) {
        if (empty($dataForm[$inputName])) {
            $errors[] = 'Le champ ' . $inputName . ' ne doit pas être vide.';
        }
    }

    if ($_FILES['avatar']['tmp_name'] !== '') {
        $dataFile = $_FILES;
        $extensionsAuthorized = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $extension = pathinfo($dataFile['avatar']['name'], PATHINFO_EXTENSION);
        $maxFileSize = 1000000;

        $uploadDir = 'uploads/';

        $uploadFile = $uploadDir . uniqid() . '_' . basename($dataFile['avatar']['name']);

        if (!in_array($extension, $extensionsAuthorized)) {
            $errors[] = 'Veuillez sélectionner une image de type Jpg/Jpeg/Png/webp/gif !';
        }

        if (file_exists($dataFile['avatar']['tmp_name']) && filesize($dataFile['avatar']['tmp_name']) > $maxFileSize) {
            $errors[] = "Votre fichier doit faire moins de 1M !";
        }
    }

    if (empty($errors)) {
        move_uploaded_file($dataFile['avatar']['tmp_name'], $uploadFile);
        header("location: /?lastname={$dataForm['lastname']}&firstname={$dataForm['firstname']}&adress={$dataForm['adress']}&sex={$dataForm['sex']}&hair={$dataForm['hair']}&picture={$uploadFile}");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['lastname'])) {
    $formValues = $_GET;
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
    <div class="container d-flex justify-content-center mt-5">
        <div class="col-12 col-sm-10 col-md-6">
            <div class="card-user col-12 col-lg-10 offset-lg-1 col-xl-8 offset-lg-2">
                <?php if (isset($formValues['picture'])) : ?>
                    <div class="card-picture-user" class="col-12"><img src="<?= $formValues['picture'] ?? '' ?>" alt=""></div>
                <?php endif ?>
                <div class="card-header-user">
                    <h1>TAXICAB<br>LICENSE</h1>
                </div>
                <div class="card-body-user">
                    <?php if (isset($_GET['lastname'])) : ?>
                        <p><?= htmlentities($_GET['lastname']) . ' ' .  htmlentities($_GET['firstname']) ?></p>
                        <p><?= htmlentities($_GET['adress']) ?></p>
                        <p>SEX: <?= htmlentities($_GET['sex']) ?></p>
                        <p>HAIR: <?= htmlentities($_GET['hair']) ?></p>
                    <?php endif ?>
                </div>
            </div>
            <div class="mt-5">
                <?php if (!empty($errors)) : ?>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
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
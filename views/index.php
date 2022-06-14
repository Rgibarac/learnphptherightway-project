<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload</title>
</head>
<body>
<div class="container">
    <form class="upload_form" action="/upload" enctype='multipart/form-data' method="POST">
        <input type="file"
               id="FileUpload" name="file[]" multiple
               accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
        >
        <button class="transaction-form__submit" type="submit">Upload</button>
    </form>
    <?php if (isset($error)): ?>
        <p class="transaction__error"><?= $error; ?></p>
    <?php endif; ?>
</div>
</body>
</html>
<?php

use thiagoalessio\TesseractOCR\TesseractOCR;

require 'vendor/autoload.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $myCroppedImages = array_keys($_POST);
    $myText = [];

    for ($i = 1; $i <= substr(end($myCroppedImages), -1, 1); $i++) {
        if (!isset($_POST['image-' . $i])) continue;
        // echo $i . "<br />";
        $data_url = $_POST['image-' . $i];
        list($type, $data) = explode(';', $data_url);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $path = 'uploads/' . date('ymdhmis') . '.jpg';
        $myImgPath = file_put_contents($path, $data);
        $myText[] = (new TesseractOCR($path))->langue('eng')->run();
        unlink($path);
    }
} else header("Location: index.php");
include('partials/header.php');
?>
<main class="container py-5">
    <a href="/abdelaziz" class="btn btn-primary text-light mb-3 border-0">back to home</a>
    <section class="row">
        <?php foreach ($myText as $item) { ?>
            <div class="col-12 col-md-6 col-lg-4 col-xxl-3 px-3">
                <div class="alert alert-dark py-4 text-result shadow">
                    <pre><?= $item ?></pre>
                </div>
            </div>
        <?php } ?>
    </section>
</main>

<?php
include('partials/footer.php');
?>
<?php
use thiagoalessio\TesseractOCR\TesseractOCR;
require 'vendor/autoload.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $myText = [];
    for($i = 1; $i < count($_POST); $i++) {
        if (!$_POST['image-' . $i]) continue; 
        $data_url = $_POST['image-' . $i];
        list($type, $data) = explode(';', $data_url);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        $path = 'uploads/'. date('ymdhmis') .'.jpg';
        file_put_contents($path, $data);
        $myText[] = (new TesseractOCR($path))->langue('eng')->run();
    }
} else header("Location: index.php");
include('partials/header.php');
?>
<main class="container py-5">
<a  href="/abdelaziz" class="btn btn-primary text-light mb-3 border-0">back to home</a>
    <section class="row">
        <?php foreach($myText as $item) { ?>
        <col-4 class="col-4 px-3">
            <div class="alert alert-dark py-4 text-result shadow">
                <pre><?= $item ?></pre>
            </div>
        </col-4>
        <?php } ?>
    </section>
</main>

<?php
include('partials/footer.php');
?>
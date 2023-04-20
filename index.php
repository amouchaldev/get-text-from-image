<?php
include('partials/header.php');
?>
<main class="container py-5">
    <!-- input file -->
    <form action="result.php" enctype="multipart/form-data" method="POST">
        <!-- leftbox -->
        <div class="box-2 bg-primary p-2 rounded d-none">
            <div class="result"></div>
        </div>
        <!--rightbox-->
        <div class="box-2 img-result d-flex justify-content-start align-items-start bg-primary my-3 rounded p-2 shadow d-none">
        </div>
        <!-- input file -->
        <div class="box bg-white p-4 rounded shadow mt-5">
            <div class="options hide">
                <label> Width</label>
                <input type="number" class="img-w" value="1000" min="100" max="1200" />
            </div>
            <!-- save btn -->
            <button class="btn btn-primary save position-fixed top-50 start-0 d-none cut-img" type="button"><i class="fa-solid fa-scissors"></i></button>
            <!-- download btn -->
            <button class="btn btn-primary d-none convert" id="convert-img">convert</button>

            <div class="box m-0 p-0 mt-4">
                <h2 class="mb-3">Upload ,Crop and convert.</h2>
                <input type="file" id="file-input" class="form-control" accept="image/png" />
            </div>
        </div>
    </form>
</main>

<?php
include('partials/footer.php')
?>
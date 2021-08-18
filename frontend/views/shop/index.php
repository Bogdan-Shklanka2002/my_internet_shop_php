<?php



?>


<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
  <ol class="carousel-indicators">
        <?php for($i = 0; $i< count($images_array); $i++){
            if($i == 0){ ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <?php } else{ ?>    
                <li data-target="#carouselExampleIndicators" data-slide-to="<?=$i?>" class=""></li>
            <?php } ?>
        <?php } ?>
  </ol>
  <div class="carousel-inner w-100">
        <?php foreach($images_array as $image){
            if($image == $images_array[0]){ ?>
                <div class="carousel-item active">
                    <img src=<?="../" . $image?> class="d-block w-100" data-interval='1500' height="600" >
                </div>
            <?php } else{ ?>
                <div class="carousel-item">
                    <img src=<?="../" . $image?> class="d-block w-100" data-interval='1500`' height="600">
                </div>
           <?php } ?>   
        <?php } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container-md d-flex">
    <div class="row">
        <?php foreach($products_array as $product){ ?>
            <div class="col-md-4">
                <div class="card m-3" style="width: 18rem;">
                    <img src=<?= $product['image']?> class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$product['title']?></h5>
                        <p class="card-text"><?= $product['description']?></p>
                        <div class='d-flex justify-content-between'>
                            <a href="#" class="btn btn-primary">More info</a>
                            <h4 class='card-text'><?=$product['price']?></h4>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php foreach($products_array as $product){ ?>
            <div class="col-md-4">
                <div class="card m-3" style="width: 18rem;">
                    <img src=<?= $product['image']?> class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?=$product['title']?></h5>
                        <p class="card-text"><?= $product['description']?></p>
                        <a href="#" class="btn btn-primary">More info</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    
</div>
        

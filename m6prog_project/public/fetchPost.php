<?php

$data = file_get_contents('php://input');

$json = json_decode($data);

?>

<section>
    <h1>you searched</h1>
    <p>max price:<span><?echo $json -> maxPrice;?></span></p>
    <p>article:<span><?echo $json -> article;?></span></p>
</section>
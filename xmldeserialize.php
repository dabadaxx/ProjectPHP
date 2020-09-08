<?php

$xmlObject = simplexml_load_string('<flight>
<flightNo>YOW188 </flightNo>
<destination>YOW </destination>
<departing>Croatia</departing>
<passengers>278</passengers>
<arrivalDate>1578655508</arrivalDate>
</flight>');

var_dump($xmlObject);

?>
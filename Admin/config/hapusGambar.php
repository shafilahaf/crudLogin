<?php

function hapusGambar($image, $target){
    unlink("../../upload" . $target . "/" . $image);
    unlink("../../upload/thumbs/". $target. "/" . $image);
}

?>

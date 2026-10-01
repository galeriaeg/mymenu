<?php
function converterImagem($imagemOriginal, $imagemFinal, $qualidade) {
    // jpg, png, gif or bmp
    $exploded = explode('.',$imagemOriginal);
    $ext = $exploded[count($exploded) - 1]; 

    if (preg_match('/jpg|jpeg/i',$ext))
        $imagemTmp=imagecreatefromjpeg($imagemOriginal);
    else if (preg_match('/png/i',$ext))
        $imagemTmp=imagecreatefrompng($imagemOriginal);
    else if (preg_match('/gif/i',$ext))
        $imagemTmp=imagecreatefromgif($imagemOriginal);
    else if (preg_match('/bmp/i',$ext))
        $imagemTmp=imagecreatefrombmp($imagemOriginal);
    else
        return 0;

   // O parâmetro "qualidade" é um valor de 0 (baixa) até 100 (alta)
   imagejpeg($imagemTmp, $imagemFinal, $qualidade);
   imagedestroy($imagemTmp);

   return 1;
}
?>
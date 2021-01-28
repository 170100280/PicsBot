<?php
require_once "AcaAmUtil.php";

CONST URL = "https://wallpaperscraft.com/";
CONST URL_CAT = "https://wallpaperscraft.com/catalog/";

class wallpaperscraftBot {

    public function __construct()
    {
        $this->buscarCategorias();
        $this->buscarImagensPorCategoria();
    }//__construct

    public function buscarCategorias()
    {

        $strHtml = AcaAmUtil::consumeUrl(URL);

        $as = AcaAmUtil::extractHyperlinksFromHtmlSourceCode($strHtml);

        $asForImages = AcaAmUtil::filterHyperlinksKeepingOnlyThoseWithHrefsEndingIn(
            $as,
            AcaAmUtil::CATEGORIA_FILTERS
        );

        return $asForImages;
    }//buscarCategorias


    //função para recolher as imagens de acordo com a categoria escolhida
    function buscarImagensPorCategoria(){

        if(!isset($_POST['submit']))
        {            
            $selectOption = $_POST['categorias']?? '';
            //Cars != cars
            $strCategory=strtolower($selectOption);
            //echo "<h2>$strCategory</h2>";
            $linkComCategoria=URL_CAT.$strCategory;
            // echo $linkComCategoria;
         } else{
            echo " <br>Não foi escolhida categoria";
        }//if
        
        $strHtmlImagens = AcaAmUtil::consumeUrl($linkComCategoria);

        $aSrcs=[];
        $aRet=[];
        $oDomImagens = new DOMDocument();

        if ($oDomImagens)
        {
            //@ - "silencer"
            @$oDomImagens->loadHTML($strHtmlImagens);

            $xpath = new DomXPath($oDomImagens);
            $nodeList = $xpath->query("//ul[@class='wallpapers__list ']");

            if($nodeList->count() == 0){
                //echo "<br> Nada foi escolhido";
            }else
            {
                $node = $nodeList->item(0)->childNodes;//->childNodes->item(1);//->getAttribute('href');
                $lengthNode=$nodeList->item(0)->childNodes->length;
               
                for ($i=0; $i+1 <= $lengthNode ; $i++)
                {
                    if($node->item($i)->childNodes->item(1)!=NULL)
                    {
                        $srcIMG=$node->item($i)->childNodes->item(1)->childNodes->item(1)->childNodes->item(1)->getAttribute("src");
                        $aSrcs[]= $srcIMG;
                    }//if
                }//for
            }//if
        }//if 
        return $aSrcs;
    }//buscarImagensPorCategoria

}//wallpaperscraftBot

$tes =new wallpaperscraftBot();
?>




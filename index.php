<?php
require_once "AcaAmUtil.php";

CONST URL = "https://wallpaperscraft.com/";
CONST URL_CAT = "https://wallpaperscraft.com/catalog/";

class wallpaperscraftBot {
      
        public function __construct(){

        $this->buscarCategorias();
        $this->buscarImagensPorCategoria();
        
        }


    public function buscarCategorias(){

            $strHtml = AcaAmUtil::consumeUrl(URL);
            
        $oDom = new DOMDocument();
        if ($oDom){
            //@ - "silencer"
            @$oDom->loadHTML($strHtml);
            $xpath = new DomXPath($oDom);
            $nodeList = $xpath->query("//ul[@class='filters__list JS-Filters']");
            $node = $nodeList->item(0)->nodeValue;
            $strCategorias=$node;                
            $words = preg_replace('/[0-9]+/', '', $strCategorias);                        
            $aCategorias=explode(" ",$words);
            //por ter "limpando todos os numeros, foi necessario adicionar a esta categoria o 3 para formar 3D
            $aCategorias[44]="3".$aCategorias[44];

          /*  echo "<form method=\"post\" action=\"\" class=\"selectorForm\">
            <label for=\"categorias\">Escolha uma categoria</label>
            <select name=\"categorias\" id=\"categorias\">";

            foreach ($aCategorias as $key => $value ) {
                if (empty($value) || !trim($value)) {
                    unset($aCategorias[$key]);
                    continue;
                } 
               
                $finalValue=preg_replace('/\s+/', '', $value);

                echo"<option value=\"$finalValue\">$finalValue</option>";              
                                      
            }//foreach
            
            echo "</select>
                    <br><br>
                    <input type=\"submit\" value=\"Submit\">
                </form>";   */
        }//if
        return $aCategorias;
         
    }//buscarCategorias



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
        }
        
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
                echo "<br> Nada foi escolhido";
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
                            
                            //echo "index.php -> <br>";
                            //var_dump($aSrcs);
                        }//if                      
                           
                    }//for
                    
                              
            }//if
        }//if 
        return $aSrcs;
    }//buscarImagensPorCategoria


    

}//wallpaperscraftBot
$tes =new wallpaperscraftBot();

?>




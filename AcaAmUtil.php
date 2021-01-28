<?php

class AcaAmUtil
{

    const BOT_SIGNATURE = "For educational tests only";

    // função para consumo de um URL
    public static function consumeUrl($pUrl)
    {
        $ch = curl_init($pUrl);
        if ($ch) {
            curl_setopt(
                $ch,
                CURLOPT_HTTPGET,
                true
            );

            curl_setopt(
                $ch,
                CURLOPT_SSL_VERIFYPEER,
                true
            );

            curl_setopt(
                $ch,
                CURLOPT_USERAGENT,
                self::BOT_SIGNATURE
            );

            curl_setopt(
                $ch,
                CURLOPT_RETURNTRANSFER,
                true
            );

            curl_setopt(
                $ch,
                CURLOPT_BINARYTRANSFER, //deprecated
                true
            );

            curl_setopt(
                $ch,
                CURLOPT_ENCODING,
                ""
            );

            $bin = curl_exec($ch);

            return $bin;
        }//if
        return false;
    }//consumeUrl

    /********************/

    const KEY_HREF = "HREF";
    const KEY_ANCHOR = "ANCHOR";

    public static function extractHyperlinksFromHtmlSourceCode(
        string $pStrHtmlSourceCode
    ) /*: array */
    {
        $aRet = [];
        $oDom = new DOMDocument();

        if ($oDom) {
            @$oDom->loadHTML($pStrHtmlSourceCode);

            $as = $oDom->getElementsByTagName('a');

            foreach ($as as $someAElement) {
                $strAnchor = trim($someAElement->nodeValue);
                $strHref = trim($someAElement->getAttribute('href'));

                $aPair = [
                    self::KEY_HREF => $strHref,
                    self::KEY_ANCHOR => $strAnchor
                ];

                $aRet[] = $aPair;
            }//foreach
        }//if
        return $aRet;
    }//extractHyperlinksFromHtmlSourceCode

    /********************/

    const CATEGORIA_FILTERS = "/catalog/";

    const KEY_CATEGORIA = "CATEGORIA";
    const KEY_URL_CATEGORIA = "URL";

    const URL_CAT = "https://wallpaperscraft.com/catalog/";

    public static function filterHyperlinksKeepingOnlyThoseWithHrefsEndingIn(
        $paHyperlinksAsPairsAnchorsHref
    )
    {
        $aRet = [];

        foreach (
            $paHyperlinksAsPairsAnchorsHref
            as
            $aPair
        ) {
            $strAnchor = $aPair[self::KEY_ANCHOR];
            $strHref = $aPair[self::KEY_HREF];

            $bHrefEndsInAtLeastOneOfTheFilters =
                self::stringStartInConst(
                    $strHref,
                    self::CATEGORIA_FILTERS
                );

            $iCategoriaFil = strlen(self::CATEGORIA_FILTERS);

            if ($bHrefEndsInAtLeastOneOfTheFilters) {
                $strHref =
                    substr(
                        $strHref,
                        $iCategoriaFil
                    );

                //$aPair[self::KEY_HREF] = $strHref;

                $strURL = URL_CAT . $strHref;

                $aPair = [
                    self::KEY_CATEGORIA => $strHref
                ];
                $aRet[] = $aPair;
            }//if
        }//foreach

        return $aRet;
    }//filterHyperlinksKeepingOnlyThoseWithHrefsEndingIn


    public static function stringStartInConst(
        string $pStr,
        string $strConst,
        bool $pbCaseInsensitive = true
    )
    {

        if ($pbCaseInsensitive) {
            $iWhereDoesTheTerminationOccur =
                strripos($pStr, $strConst);
        } else {
            $iWhereDoesTheTerminationOccur =
                strrpos($pStr, $strConst);
        }//if

        $bTerminationOccurs =
            $iWhereDoesTheTerminationOccur !== false;

        if ($bTerminationOccurs) {
            $bExactlyAtTheEnd =
                strlen($strConst)
                ===
                $iWhereDoesTheTerminationOccur;
            if ($bExactlyAtTheEnd) return true;
        }//if

        if ($bTerminationOccurs) {
            $bExactlyAtTheEnd =
                strlen($strConst)
                ===
                (
                    $iWhereDoesTheTerminationOccur
                    +
                    strlen($strConst)
                );
            if ($bExactlyAtTheEnd) return true;
        }//if

        return false;
    }//stringEndsInOneOfTheFollowing
}//AcaAmUtil
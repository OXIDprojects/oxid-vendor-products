<?php

/**
 * Class agvendorproducts_oxvendor
 * Results will be locally cached, this might lead to unexpected results
 * if called multiple times for the same vendor. Maybe we can adress that later
 */

class agvendorproducts_oxvendor extends agvendorproducts_oxvendor_parent {

    protected $_oArtList;
    protected $_oRandomArtList;

    public function getArticles($iCount = 5, $iPage = 0)
    {
        if ($this->_oArtList === null)
        {
            $this->_oArtList = oxNew(\OxidEsales\Eshop\Application\Model\ArticleList::class);
            $this->_oArtList->setSqlLimit($iCount * $iPage, $iCount);

            // load the articles
            $this->_iNrOfArticles = $this->_oArtList->loadVendorArticles($this->getId(), $this);
        }
        return $this->_oArtList;
    }

    public function getRandomArticles($iCount = 5)
    {
        if ($this->_oRandomArtList === null)
        {
            $this->_oRandomArtList = oxNew(\OxidEsales\Eshop\Application\Model\ArticleList::class);
            $this->_oRandomArtList->setSqlLimit($iCount, $iCount);
            $this->_oRandomArtList->setCustomSorting('RAND()');

            // load the articles
            $this->_iNrOfArticles = $this->_oRandomArtList->loadVendorArticles($this->getId(), $this);
        }
        return $this->_oRandomArtList;
    }

}
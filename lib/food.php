<?php
class Food
{
    private $id=null;
    private $tgtdate = null;
    private $tgtcategory = null;
    private $tgtitem = null;
    private $tgtprice = null;
    private $tgtquantity = null;
    private $tgtcalory = null;
    private $tgtstock = null;

    public function save()
    {
        $queryDaily = new QueryFood();
        $queryDaily->setData($this);
        $queryDaily->save();
    }

    public function delete($id)
    {
        $queryDaily = new QueryFood();
        $queryDaily->setData($this);
        $queryDaily->delete($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDate()
    {
        return $this->tgtdate;
    }

    public function getCategory()
    {
        return $this->tgtcategory;
    }

    public function getItem()
    {
        return $this->tgtitem;
    }

    public function getPrice()
    {
        return $this->tgtprice;
    }

    public function getQuantity()
    {
        return $this->tgtquantity;
    }

    public function getCalory()
    {
        return $this->tgtcalory;
    }

    public function getStock()
    {
        return $this->tgtstock;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDate($tgtdate)
    {
        $this->tgtdate = $tgtdate;
    }

    public function setCategory($tgtcategory)
    {
        $this->tgtcategory = $tgtcategory;
    }

    public function setItem($tgtitem)
    {
        $this->tgtitem = $tgtitem;
    }

    public function setPrice($tgtprice)
    {
        $this->tgtprice = $tgtprice;
    }

    public function setQuantity($tgtquantity)
    {
        $this->tgtquantity = $tgtquantity;
    }

    public function setCalorie($tgtcalory)
    {
        $this->tgtcalory = $tgtcalory;
    }

    public function setStock($tgtstock)
    {
        $this->tgtstock = $tgtstock;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
}

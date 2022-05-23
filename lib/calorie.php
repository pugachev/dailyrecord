<?php
class Calorie
{
    private $id=null;
    private $tgtdate = null;
    private $tgtcategory = null;
    private $tgtitem = null;
    private $tgtquantity = null;

    public function save()
    {
        $queryDaily = new QueryCalorie();
        $queryDaily->setCalorie($this);
        $queryDaily->save();
    }

    public function delete()
    {
        $queryDaily = new QueryCalorie();
        $queryDaily->setCalorie($this);
        $queryDaily->delete();
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

    public function getQuantity()
    {
        return $this->tgtquantity;
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

    public function setQuantity($tgtquantity)
    {
        $this->tgtquantity = $tgtquantity;
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

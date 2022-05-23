<?php
/**
 * 購入した食費を記録する
 * その際に購入した食料品のカロリーも記録する
 */
class QueryStock extends connect
{
    private $food;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * stockfoodsの残個数を取得する
     */
    public function getStock($tgtcategory,$tgtitem)
    {
        $tmpstock=0;

        try
        {
            //stockfoodsから該当する食品の現在数を取得する
            $stmt = $this->dbh->prepare("SELECT tgtquantity FROM stockfoods WHERE tgtcategory=:tgtcategory AND tgtitem=:tgtitem");
            $stmt->bindParam(':tgtcategory', $tgtcategory, PDO::PARAM_STR);
            $stmt->bindParam(':tgtitem', $tgtitem, PDO::PARAM_STR);
            // $stmt->debugDumpParams();
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //現在の在庫数を取得する
            if(!empty($results))
            {
                $tmpstock = $results[0]['tgtquantity'];
            }
            else
            {
                $tmpstock = 0;
            }
            
        }
        catch (Exception $e) 
        {
            // Exceptionが発生したら表示して終了
            exit($e->getMessage());
        }

        return $tmpstock;
    }

    /**
     * stockfoodsの残個数を更新(追加)する
     */
    public function addStock($tgtcategory,$tgtitem,$tmpcnt)
    {
        try
        {
            //対象アイテムが存在している場合は残個数をアップデート
            if($this->isCateItemCheck($tgtcategory,$tgtitem))
            {
                //現在の在庫数を取得する
                $tmpstock=$this->getStock($tgtcategory,$tgtitem);
                //在庫数を足し込む
                $tmpstock += $tmpcnt;
                //最新在庫数にアップデートする
                $stmt = $this->dbh->prepare("UPDATE stockfoods SET tgtquantity=:tgtquantity,updated_at=NOW() WHERE tgtcategory=:tgtcategory AND tgtitem=:tgtitem");

            }
            //対象アイテムが存在していない場合は新規挿入
            else
            {
                $tmpstock=$tmpcnt;
                $stmt = $this->dbh->prepare("INSERT INTO stockfoods (tgtcategory, tgtitem,tgtquantity,created_at, updated_at) VALUES (:tgtcategory, :tgtitem, :tgtquantity,NOW(), NOW())");
            }
            $stmt->bindParam(':tgtcategory', $tgtcategory, PDO::PARAM_STR);
            $stmt->bindParam(':tgtitem', $tgtitem, PDO::PARAM_STR);
            $stmt->bindParam(':tgtquantity', $tmpstock, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch (Exception $e) 
        {
            // Exceptionが発生したら表示して終了
            exit($e->getMessage());
        }
    }

        /**
     * stockfoodsの残個数を更新(減らす)する
     */
    public function reduceStock($tgtcategory,$tgtitem,$tmpcnt)
    {
        try
        {
            //現在の在庫数を取得する
            $tmpstock=$this->getStock($tgtcategory,$tgtitem);
            //在庫数を足し込む
            if(intval($tmpstock)>0 && (intval($tmpstock)-intval($tmpcnt))){
                $tmpstock = intval($tmpstock) - intval($tmpcnt);
            }else{

            }
            
            // print_r($tmpstock.'   '.$tmpcnt);
            //最新在庫数にアップデートする
            $stmt = $this->dbh->prepare("UPDATE stockfoods SET tgtquantity=:tgtquantity,updated_at=NOW() WHERE tgtcategory=:tgtcategory AND tgtitem=:tgtitem");
            $stmt->bindParam(':tgtcategory', $tgtcategory, PDO::PARAM_STR);
            $stmt->bindParam(':tgtitem', $tgtitem, PDO::PARAM_STR);
            $stmt->bindParam(':tgtquantity', $tmpstock, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch (Exception $e) 
        {
            // Exceptionが発生したら表示して終了
            exit($e->getMessage());
        }
    }

    /**
     * 対象の分類と項目が存在するかチェック
     */
    public function isCateItemCheck($tgtcategory,$tgtitem)
    {
        $ret=false;
        try
        {
            //stockfoodsから該当する食品の現在数を取得する
            $stmt = $this->dbh->prepare("SELECT count(*) FROM stockfoods WHERE tgtcategory=:tgtcategory AND tgtitem=:tgtitem");
            $stmt->bindParam(':tgtcategory', $rcvCategory, PDO::PARAM_STR);
            $stmt->bindParam(':tgtitem', $rcvItem, PDO::PARAM_STR);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //現在の在庫数を取得する
            if(!empty($results))
            {
                $tmpstock = true;
            }
            else
            {
                $tmpstock = false;
            }
        }
        catch (Exception $e) 
        {
            // Exceptionが発生したら表示して終了
            exit($e->getMessage());
        }

        return $ret;
    }


}
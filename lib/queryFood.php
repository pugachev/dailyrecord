<?php
include 'lib/queryStock.php';
/**
 * 購入した食費を記録する
 * その際に購入した食料品のカロリーも記録する
 */
class QueryFood extends connect
{
    private $food;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * データクラスを本クラスに保持する
     */
    public function setData(Food $food)
    {
        $this->food = $food;
    }

    /**
     * 入力データの新規作成/修正
     */
    public function save()
    {
        $tmpstock = "";

        $rcvId = $this->food->getId();
        $rcvDate = $this->food->getDate();
        $rcvCategory = $this->food->getCategory();
        $rcvItem = $this->food->getItem();
        $rcvPrice = $this->food->getPrice();
        $rcvQuantity = $this->food->getQuantity();
        $rcvCalory = $this->food->getCalory();

        try 
        {
            /**
             * stockデータの修正(追加)
             */
            $stock = new QueryStock();
            $stock->addStock($rcvCategory,$rcvItem,$rcvQuantity);

            /**
             * Dailyデータの登録 or 修正
             */
            //画面からIDを受け取った際は上書き
            if(!empty($rcvId)) 
            {
                $id = $rcvId;
                $stmt = $this->dbh->prepare("UPDATE spendingfoods SET tgtdate=:tgtdate, tgtcategory=:tgtcategory, tgtitem=:tgtitem, tgtprice=:tgtprice, tgtquantity=:tgtquantity,tgtcalory=:tgtcalory,updated_at=NOW() WHERE id=:id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            }
            //画面からIDを受け取らない場合は新規作成
            else 
            {
                $stmt = $this->dbh->prepare("INSERT INTO spendingfoods (tgtdate, tgtcategory, tgtitem, tgtprice, tgtquantity,tgtcalory,tgtstatus,created_at, updated_at) VALUES (:tgtdate, :tgtcategory, :tgtitem, :tgtprice,:tgtquantity,:tgtcalory,:tgtstatus, NOW(), NOW())");
            }
            $stmt->bindParam(':tgtdate', $rcvDate, PDO::PARAM_STR);
            $stmt->bindParam(':tgtcategory', $rcvCategory, PDO::PARAM_STR);
            $stmt->bindParam(':tgtitem', $rcvItem, PDO::PARAM_STR);
            $stmt->bindParam(':tgtprice', $rcvPrice, PDO::PARAM_INT);
            $stmt->bindParam(':tgtquantity', $rcvQuantity, PDO::PARAM_INT);
            $stmt->bindParam(':tgtcalory', $rcvCalory, PDO::PARAM_INT);
            $stmt->bindValue(':tgtstatus', true, PDO::PARAM_BOOL);
            // $stmt->debugDumpParams();
            $stmt->execute();



        } 
        catch (Exception $e) 
        {
            // Exceptionが発生したら表示して終了
            exit($e->getMessage());
        }
    }

    /**
     * データの削除
     */
    public function delete($id)
    {
        try
        {
            $stmt = $this->dbh->prepare("delete from spendingfoods WHERE id=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch (Exception $e)
        {
            // Exceptionが発生したら表示して終了
            exit($e->getMessage());
        }
    }

    /**
     * 該当商品のカロリーを取得する
     */
    public function getCalory($rcvCategory,$rcvItem)
    {
        $tmpcalorie =0;
        try
        {
            //stockfoodsから該当する食品の現在数を取得する
            $stmt = $this->dbh->prepare("SELECT tgtcalory FROM spendingfoods WHERE tgtcategory=:tgtcategory AND tgtitem=:tgtitem");
            $stmt->bindParam(':tgtcategory', $rcvCategory, PDO::PARAM_STR);
            $stmt->bindParam(':tgtitem', $rcvItem, PDO::PARAM_STR);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //現在の在庫数を取得する
            $tmpcalorie = $results[0]['tgtcalory'];
        }
        catch (Exception $e) 
        {
            // Exceptionが発生したら表示して終了
            exit($e->getMessage());
        }

        return $tmpcalorie;
    }
}
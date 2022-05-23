<?php
// include 'lib/queryStock.php';
include 'lib/queryFood.php';
/**
 * 接種したカロリーを記録する
 * その際に消費した食品の数量を減らす
 */
class QueryCalorie extends connect
{
    private $calorie;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * データクラスを本クラスに保持する
     */
    public function setCalorie(Calorie $calorie)
    {
        $this->calorie = $calorie;
    }

    /**
     * 入力データの新規作成/修正
     */
    public function save()
    {
        $rcvId = $this->calorie->getId();
        $rcvDate = $this->calorie->getDate();
        $rcvCategory = $this->calorie->getCategory();
        $rcvItem = $this->calorie->getItem();
        $rcvQuantity = $this->calorie->getQuantity();

        try 
        {
            /**
             * stockデータの修正(減らす)
             */
            $stock = new QueryStock();
            $stock->reduceStock($rcvCategory,$rcvItem,$rcvQuantity);

            /**
             * spendingfoodsから該当のデータのカロリーを取得する
             */
            $calorie = new QueryFood();
            $tmpcalorie = $calorie->getCalory($rcvCategory,$rcvItem);

            //今回取得した合計カロリーを計算する
            $totalcalorie = $rcvQuantity*$tmpcalorie;



            //画面からIDを受け取った際は上書き
            if(!empty($rcvId)) 
            {
                $id = $rcvId;
                $stmt = $this->dbh->prepare("UPDATE intakecalorie SET tgtdate=:tgtdate, tgtcategory=:tgtcategory, tgtitem=:tgtitem, tgtcalorie=:tgtcalorie,updated_at=NOW() WHERE id=:id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            }
            //画面からIDを受け取らない場合は新規作成
            else 
            {
                $stmt = $this->dbh->prepare("INSERT INTO intakecalorie (tgtdate, tgtcategory, tgtitem, tgtcalorie,created_at, updated_at) VALUES (:tgtdate, :tgtcategory, :tgtitem, :tgtcalorie,NOW(), NOW())");
            }
            $stmt->bindParam(':tgtdate', $rcvDate, PDO::PARAM_STR);
            $stmt->bindParam(':tgtcategory', $rcvCategory, PDO::PARAM_STR);
            $stmt->bindParam(':tgtitem', $rcvItem, PDO::PARAM_STR);
            $stmt->bindParam(':tgtcalorie', $totalcalorie, PDO::PARAM_INT);
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
}
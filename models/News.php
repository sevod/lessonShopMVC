<?php


class News
{
    /**
     * Returns single news item with specified id
     * @param integer $id
     */
    public static function getNewsItemByID($id)
    {

        $db = Db::getConnection();

        $newsList = array();

        $result = $db->query('SELECT * '
            . ' FROM news '
            . ' WHERE id = ' . $id);

        //настраиваем как отображать данные из запроса функцией fetch
        //$result->setFetchMode(PDO::FETCH_NUM);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $newsItem = $result->fetch();
        return $newsItem;
    }

    /**
     * Returns an array of news items
     */
    public static function getNewsList()
    {

        $db = Db::getConnection();

        $newsList = array();

        $result = $db->query('SELECT id, title, date, short_content, author_name'
            . ' FROM news '
            . ' ORDER BY date DESC '
            . ' LIMIT 10');

        $i = 0;
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $newsList[$i]['author_name'] = $row['author_name'];
            $i++;

//            echo '<pre>';
//            print_r($row);
//            echo '</pre>';
        }
        return $newsList;


//        echo "getNewsList";
    }

}
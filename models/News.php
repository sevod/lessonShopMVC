<?php


class News
{
    /**
     * Returns single news item with specified id
     * @param integer $id
     */
    public static function getNewsItemByID($id)
    {
        //Запрос к БД
        echo "getNewsItemByID";
    }

    /**
     * Returns an array of news items
     */
    public static function getNewsList()
    {
        //запрос к БД
        echo "getNewsList";
    }

}
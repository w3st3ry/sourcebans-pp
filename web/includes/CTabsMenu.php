<?php
class CTabsMenu
{
    private $menuItems = array();

    public function addMenuItem($title, $ids, $description = "", $url = "", $external = false)
    {
        $curItem = array();
        $curItem['title'] = $title;
        $curItem['desc'] = $description;
        $curItem['url'] = $url;
        $curItem['external'] = $external;
        $curItem['id'] = $ids;
        array_push($this->menuItems, $curItem);
    }

    public function outputMenu()
    {
        $var = $this->menuItems;
        include TEMPLATES_PATH . "/admin.detail.navbar.php";
    }

    public function getMenuArray()
    {
        return $this->menuItems;
    }
}

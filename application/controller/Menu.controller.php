<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use \Glial\Synapse\Controller;
use \Glial\I18n\I18n;
use \Application\Model\IdentifierDefault\MenuGroup;

define('MENU_TABLE', 'menu');
define('MENUGROUP_TABLE', 'menu_group');

// Fields Settings
define('MENU_ID', 'id');
define('MENU_PARENT', 'parent_id');
define('MENU_TITLE', 'title');
define('MENU_URL', 'url');
define('MENU_CLASS', 'class');
define('MENU_POSITION', 'position');
define('MENU_GROUP', 'group_id');

define('MENUGROUP_ID', 'id');
define('MENUGROUP_TITLE', 'title');

class Tree
{

    /**
     * variable to store temporary data to be processed later
     *
     * @var array
     */
    var $data;

    /**
     * Add an item
     *
     * @param int $id 			ID of the item
     * @param int $parent 		parent ID of the item
     * @param string $li_attr 	attributes for <li>
     * @param string $label		text inside <li></li>
     */
    function add_row($id, $parent, $li_attr, $label)
    {
        $this->data[$parent][] = array('id' => $id, 'li_attr' => $li_attr, 'label' => $label);
    }

    /**
     * Generates nested lists
     *
     * @param string $ul_attr
     * @return string
     */
    function generate_list($ul_attr = '')
    {
        return $this->ul(0, $ul_attr);
    }

    /**
     * Recursive method for generating nested lists
     *
     * @param int $parent
     * @param string $attr
     * @return string
     */
    function ul($parent = 0, $attr = '')
    {
        static $i = 1;
        $indent = str_repeat("\t\t", $i);
        if (isset($this->data[$parent])) {
            if ($attr) {
                $attr = ' ' . $attr;
            }
            $html = "\n$indent";
            $html .= "<ul$attr>";
            $i++;
            foreach ($this->data[$parent] as $row) {
                $child = $this->ul($row['id']);
                $html .= "\n\t$indent";
                $html .= '<li' . $row['li_attr'] . '>';
                $html .= $row['label'];
                if ($child) {
                    $i--;
                    $html .= $child;
                    $html .= "\n\t$indent";
                }
                $html .= '</li>';
            }
            $html .= "\n$indent</ul>";
            return $html;
        } else {
            return false;
        }
    }

    /**
     * Clear the temporary data
     *
     */
    function clear()
    {
        $this->data = array();
    }

}

class Menu extends Controller
{

    function diplay($group_id, $attr = '')
    {
        global $db;
        $tree = new Tree;




        $sql = sprintf(
                'SELECT * FROM %s WHERE group_id = %s ORDER BY %s, %s', MENU_TABLE, $group_id, MENU_PARENT, MENU_POSITION
        );

        $db = $this->di['db']->sql('default');


        $res = $db->sql_query($sql);


        while ($row = $db->sql_fetch_array($res)) {


            $label = '<a href="' . $row[MENU_URL] . '">';
            $label .= $row[MENU_TITLE];
            $label .= '</a>';

            $li_attr = '';
            if ($row[MENU_CLASS]) {
                $li_attr = ' class="' . $row[MENU_CLASS] . '"';
            }
            $tree->add_row($row[MENU_ID], $row[MENU_PARENT], $li_attr, $label);
        }
        $menu = $tree->generate_list($attr);
        return $menu;
    }

    function index()
    {

        $this->addJavascript(array("jquery-latest.min.js", "jquery-ui-1.10.3.custom.min.js", "jquery.mjs.nestedSortable.js", "menu.js", "bootstrap.min.js"));
        //$data['menu'] = $this->diplay(1);


        $data['menum'] = $this->menuManager(1);


        $this->set('data', $data);
    }

    public function menuManager($id_group = 1)
    {


        $db = $this->di['db']->sql('default');

        $sql = sprintf('SELECT * FROM %s WHERE %s = %s ORDER BY %s, %s', MENU_TABLE, MENU_GROUP, $id_group, MENU_PARENT, MENU_POSITION);

        $menu = $db->sql_fetch_yield($sql);
        $data['menu_ul'] = '<ul id="easymm"></ul>';
        if ($menu) {

            //include _DOC_ROOT . 'includes/tree.php';
            $tree = new Tree;

            foreach ($menu as $row) {
                $tree->add_row(
                        $row[MENU_ID], $row[MENU_PARENT], ' id="menu-' . $row[MENU_ID] . '" class="sortable"', $this->get_label($row)
                );
            }

            $data['menu_ul'] = $tree->generate_list('id="easymm"');
        }
        $data['group_id'] = $id_group;
        $data['group_title'] = $db->sql_fetch_all(sprintf('SELECT %s FROM %s WHERE %s = %s', MENUGROUP_TITLE, MENUGROUP_TABLE, MENUGROUP_ID, $id_group))[0];
        $data['menu_groups'] = $db->sql_fetch_all(sprintf('SELECT %s, %s FROM %s', MENUGROUP_ID, MENUGROUP_TITLE, MENUGROUP_TABLE))[0];


        return $data;
    }

    /**
     * Get label for list item in menu manager
     * this is the content inside each <li>
     *
     * @param array $row
     * @return string
     */
    private function get_label($row)
    {
        $label = '<div class="ns-row">' .
                '<div class="ns-title">' . $row[MENU_TITLE] . '</div>' .
                '<div class="ns-url">' . $row[MENU_URL] . '</div>' .
                '<div class="ns-class">' . $row[MENU_CLASS] . '</div>' .
                '<div class="ns-actions">' .
                '<a href="#" class="" title="Edit">' .
                '<span class="glyphicon glyphicon-cog"></span>' .
                '</a>' .
                '<a href="#" class="delete-menu" title="Delete">' .
                '<span class="glyphicon glyphicon-remove">' .
                '</a>' .
                '<input type="hidden" name="menu_id" value="' . $row[MENU_ID] . '">' .
                '</div>' .
                '</div>';
        return $label;
    }

    /**
     * new save position method
     */
    public function save_position()
    {
        $this->layout_name = false;
        $this->layout = false;
        $this->view = false;
        $this->is_ajax = true;

        if (!empty($_POST)) {
            file_put_contents("gg.txt", json_encode($_POST['menu']));

            debug($_POST);
            //adodb_pr($menu);
            $menu = $_POST['menu'];

            foreach ($menu as $k => $v) {
                if ($v == 'null') {
                    $menu2[0][] = $k;
                } else {
                    $menu2[$v][] = $k;
                }
            }
            
            debug($menu2);

            $success = 0;
            if (!empty($menu2)) {
                foreach ($menu2 as $k => $v) {
                    $i = 1;
                    foreach ($v as $v2) {
                        $data[MENU_PARENT] = $k;
                        $data[MENU_POSITION] = $i;
                        
                        
                        
                        
                        if ($this->update(MENU_TABLE, $data, MENU_ID . ' = ' . $v2)) {
                            $success++;
                        }
                        $i++;
                    }
                }
            }
        }
    }

    function update($table_name, $data, $where)
    {
        return $this->AutoExecute($table_name, $data, 'UPDATE', $where);
    }

    function AutoExecute($table_name, $data, $action = 'INSERT', $where = '')
    {
        
        debug($data);
        
        switch ($action) {
            case 'INSERT': $sql = 'INSERT INTO ';
                break;
            case 'UPDATE': $sql = 'UPDATE ';
                break;
        }
        $sql .= $table_name;
        $sql .= ' SET ';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = $value[0];
            } else {
                $value = $this->quote_smart($value);
            }
            $d[] = "$key = $value";
        }
        $sql .= implode(', ', $d);
        if ($action == 'UPDATE') {
            $sql .= " WHERE $where";
        }

        echo $sql.PHP_EOL;
        //$this->Execute($sql);
        //return $this->result;
    }

    function quote_smart($value)
    {
        // Stripslashes
        if (get_magic_quotes_gpc()) {
            $value = stripslashes($value);
        }
        // Quote if not a number or a numeric string
        if (!is_numeric($value)) {
            $value = "'" . mysql_real_escape_string($value) . "'";
        }
        return $value;
    }

    function Execute($sql)
    {
        $this->result = mysql_query($sql, $this->link);
        if (!$this->result) {
            die('Invalid query: ' . mysql_error());
        }
        return $this->result;
    }

}

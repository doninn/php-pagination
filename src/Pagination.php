<?php
/*
 * Pagination view PHP Class
 * https://github.com/doninn/php-pagination
 *
 * @copyright 2017, Anton Stepanov
 * http://www.doninn.com
 * http://naprimerax.org
 *
 * Licensed under the MIT license:
 * https://opensource.org/licenses/MIT
 */

namespace renders\pagination;


class Pagination
{

    /**
     * @var integer     current page index, starting from 1
     * @var integer     total number of pages
     */
    public $page_index, $pages_count;

    /**
     * @var string      pagination links url
     */
    public $url;

    /**
     * @var string      pagination links query params
     */
    public $query = array();

    /**
     * @var string      pagination page param name
     */
    public $param_name = "p";

    /**
     * @var integer     max number of visible buttons
     */
    public $pages_visible = 11;

    /**
     * @var integer     number of visible buttons before hiding
     */
    public $pages_visible_begin = 2;

    /**
     * @var integer     number of visible buttons after hiding
     */
    public $pages_visible_end = 2;

    /**
     * @var string      "previous" button content
     */
    public $prev_html = "&laquo;";

    /**
     * @var string      "next" button content
     */
    public $next_html = "&raquo;";

    /**
     * @var string      hidden buttons symbol
     */
    public $intermediate_html = "...";

    /**
     * @var string      css class name for disabled list item
     */
    public $disabled_class = "disabled";

    /**
     * @var string      css class name for active list item
     */
    public $active_class = "active";

    /**
     * @var string      css class name for pagination ul tag
     */
    public $ul_class = "pagination";

    public function __construct($page_index, $pages_count, $url, $param_name = "p", $pages_visible = 11, $pages_visible_begin = 2, $pages_visible_end = 2)
    {
        $this->page_index = $page_index;
        $this->pages_count = $pages_count;
        $this->url = $url;
        $this->param_name = $param_name;
        $this->pages_visible = $pages_visible;
        $this->pages_visible_begin = $pages_visible_begin;
        $this->pages_visible_end = $pages_visible_end;
    }

    /**
     * @return string
     */
    public function Render()
    {
        $code = "<ul class=\"{$this->ul_class}\">".(($this->page_index <= 1) ?
                $this->GetLiLabeledWithClass(1, $this->prev_html, $this->disabled_class) :
                $this->GetLiLabeled($this->page_index - 1, $this->prev_html));
        if ($this->pages_count > $this->pages_visible)
        {
            $i = 0;
            if ($this->page_index > ($this->pages_visible - $this->pages_visible_begin - 1))
            {
                for ($i = 1; $i <= $this->pages_visible_begin; $i++)
                {
                    $code .= $this->GetLi($i);
                }
                $i++;
            }
            $interval = $this->pages_visible - $i - $this->pages_visible_end;
            $j = $this->pages_count - $interval;
            if ($this->page_index < $j)
            {
                $k = 1;
                if ($i == 0)
                {
                    for (; $k < $interval; $k++)
                    {
                        $code .= $this->GetLiClickable($k);
                    }
                }
                else
                {
                    $code .= $this->GetLiLabeled($i - 1, $this->intermediate_html);
                    for ($k = $this->page_index - intval($interval / 2.0), $m = 0; $m < $interval; $m++, $k++)
                    {
                        $code .= $this->GetLiClickable($k);
                    }
                    $k = $this->pages_count - $this->pages_visible_end;
                }
                $code .= $this->GetLiLabeled($k, $this->intermediate_html);
                $k = $this->pages_count - $this->pages_visible_end + 1;
                for (; $k <= $this->pages_count; $k++)
                {
                    $code .= $this->GetLi($k);
                }
            }
            else
            {
                $code .= $this->GetLiLabeled($j - 1, $this->intermediate_html);
                for (; $j <= $this->pages_count; $j++)
                {
                    $code .= $this->GetLiClickable($j);
                }
            }
        }
        else
        {
            for ($i = 1; $i <= $this->pages_count; $i++)
            {
                $code .= $this->GetLiClickable($i);
            }
        }
        $code .= (($this->page_index >= $this->pages_count) ?
                $this->GetLiLabeledWithClass($this->pages_count, $this->next_html, $this->disabled_class) :
                $this->GetLiLabeled($this->page_index + 1, $this->next_html))."</ul>";
        return $code;
    }

    public function GetUrl($index)
    {
        $query_string = http_build_query(array_merge($index == 1 ? array() : array($this->param_name => $index), $this->query));

        if ($query_string)
        {
            return ((mb_strpos($this->url, '?') === false) ?
                $this->url.'?'.$query_string :
                $this->url.'&'.$query_string);
        }
        return $this->url;
    }

    protected function GetLi($index)
    {
        return "<li><a href=\"{$this->GetUrl($index)}\">$index</a></li>";
    }

    protected function GetLiWithClass($index, $class)
    {
        return "<li class=\"$class\"><a href=\"{$this->GetUrl($index)}\">$index</a></li>";
    }

    protected function GetLiLabeled($index, $label)
    {
        return "<li><a href=\"{$this->GetUrl($index)}\">$label</a></li>";
    }

    protected function GetLiLabeledWithClass($index, $label, $class)
    {
        return "<li class=\"$class\"><a href=\"{$this->GetUrl($index)}\">$label</a></li>";
    }

    protected function GetLiClickable($index)
    {
        return ($index == $this->page_index) ? $this->GetLiWithClass($index, $this->active_class) : $this->GetLi($index);
    }
}

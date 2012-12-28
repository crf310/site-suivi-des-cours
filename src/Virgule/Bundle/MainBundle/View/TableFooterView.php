<?php
namespace Virgule\Bundle\MainBundle\View;

use Pagerfanta\PagerfantaInterface;
use Pagerfanta\View\ViewInterface;

class TableFooterView implements ViewInterface 
{
    /**
     * {@inheritdoc}
     */
    public function render(PagerfantaInterface $pagerfanta, $routeGenerator, array $options = array())
    {
        $options = array_merge(array(
            'proximity'          => 10,
            'previous_message'   => 'Précédente',
            'next_message'       => 'Suivante',
            'css_disabled_class' => 'disabled',
            'css_dots_class'     => 'dots',
            'css_current_class'  => 'current',
            'colspan_left'       => 2,
            'colspan_middle'       => 2,
            'colspan_right'       => 2
        ), $options);

        $currentPage = $pagerfanta->getCurrentPage();

        $startPage = $currentPage - $options['proximity'];
        $endPage = $currentPage + $options['proximity'];

        if ($startPage < 1) {
            $endPage = min($endPage + (1 - $startPage), $pagerfanta->getNbPages());
            $startPage = 1;
        }
        if ($endPage > $pagerfanta->getNbPages()) {
            $startPage = max($startPage - ($endPage - $pagerfanta->getNbPages()), 1);
            $endPage = $pagerfanta->getNbPages();
        }

        $pages = array();
        $pages[] = sprintf('<td class="nav_left" colspan="%s">', $options['colspan_left']);
        // previous
        if ($pagerfanta->hasPreviousPage()) {
            $pages[] = array($pagerfanta->getPreviousPage(), $options['previous_message']);
        } else {
            $pages[] = sprintf('<span class="%s">%s</span>', $options['css_disabled_class'], $options['previous_message']);
        }
        $pages[] = sprintf('</td>');
        
        $pages[] = sprintf('<td  class="nav_middle" colspan="%s">', $options['colspan_middle']);
        // first
        if ($startPage > 1) {
            $pages[] = array(1, 1);
            if (3 == $startPage) {
                $pages[] = array(2, 2);
            } elseif (2 != $startPage) {
                $pages[] = sprintf('<span class="%s">...</span>', $options['css_dots_class']);
            }
        }
        // pages
        for ($page = $startPage; $page <= $endPage; $page++) {
            if ($page == $currentPage) {
                $pages[] = sprintf('<span class="%s">%s</span>&nbsp;', $options['css_current_class'], $page);
            } else {
                $pages[] = array($page, $page);
            }
        }

        // last
        if ($pagerfanta->getNbPages() > $endPage) {
            if ($pagerfanta->getNbPages() > ($endPage + 1)) {
                if ($pagerfanta->getNbPages() > ($endPage + 2)) {
                    $pages[] = sprintf('<span class="%s">...</span>', $options['css_dots_class']);
                } else {
                    $pages[] = array($endPage + 1, $endPage + 1);
                }
            }

            $pages[] = array($pagerfanta->getNbPages(), $pagerfanta->getNbPages());
        }
        
        if ($pagerfanta->getNbResults() > 1) {
            $pages[] = '&nbsp;(' . $pagerfanta->getNbResults() . ' résultats)' ;
        } else {
            $pages[] = '&nbsp;(' .  $pagerfanta->getNbResults() . ' résultat)';
        }
        $pages[] = sprintf('</td>');

        $pages[] = sprintf('<td  class="nav_right" colspan="%s">', $options['colspan_right']);
        // next
        if ($pagerfanta->hasNextPage()) {
            $pages[] = array($pagerfanta->getNextPage(), $options['next_message']);
        } else {
            $pages[] = sprintf('<span class="%s">%s</span>', $options['css_disabled_class'], $options['next_message']);
        }
        $pages[] = sprintf('</td>');
        
        // process
        $pagesHtml = '';
        foreach ($pages as $page) {
            if (is_string($page)) {
                $pagesHtml .= $page;
            } else {
                $pagesHtml .= '<a href="'.$routeGenerator($page[0]).'">'.$page[1].'</a>&nbsp;';
            }
        }

        return '<nav>'.$pagesHtml.'</nav>';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'default';
    }
}

/*

CSS:

.pagerfanta {
}

.pagerfanta a,
.pagerfanta span {
    display: inline-block;
    border: 1px solid blue;
    color: blue;
    margin-right: .2em;
    padding: .25em .35em;
}

.pagerfanta a {
    text-decoration: none;
}

.pagerfanta a:hover {
    background: #ccf;
}

.pagerfanta .dots {
    border-width: 0;
}

.pagerfanta .current {
    background: #ccf;
    font-weight: bold;
}

.pagerfanta .disabled {
    border-color: #ccf;
    color: #ccf;
}

COLORS:

.pagerfanta a,
.pagerfanta span {
    border-color: blue;
    color: blue;
}

.pagerfanta a:hover {
    background: #ccf;
}

.pagerfanta .current {
    background: #ccf;
}

.pagerfanta .disabled {
    border-color: #ccf;
    color: #cf;
}

*/

<?php

/**
 * http://html5doctor.com/cite-and-blockquote-reloaded/
 */
kirbytext::$tags['blockquote'] = array (
    'attr' => array(
        'lang',
        'cite',
        'link'
    ),
    'html' => function($tag) {

        $quote = $tag->attr('blockquote');
        $lang  = $tag->attr('lang');
        $cite  = $tag->attr('cite');
        $link  = $tag->attr('link');

        $quoteTag = new Brick('blockquote');
        $quoteTag->attr('lang', $lang);
        $quoteTag->append(kirbytext($quote));

        $cite = $cite ?: preg_replace('/^https?:\/\//i', null, $link);

        if ( ! $cite) return $quoteTag;

        if ($link) {
            $linkTag = new Brick('a');
            $linkTag->attr('href', $link);
            $linkTag->append($cite);
        }
    
        $citeTag = new Brick('cite');
        $citeTag->append(isset($linkTag) ? $linkTag : $cite);

        $quoteTag->append($citeTag);

        return $quoteTag;
    }
);

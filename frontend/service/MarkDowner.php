<?php
/**
 * Created by PhpStorm.
 * User: admin-mxp
 * Date: 2019/6/26
 * Time: 14:34
 */

namespace frontend\service;

use Parsedown;
use League\HTMLToMarkdown\HtmlConverter;

class MarkDowner
{
    /**
     * @var HtmlConverter
     */
    protected $htmlConverter;

    /**
     * @var Parsedown
     */
    protected $markdownConverter;

    /**
     * Markdowner constructor.
     */
    public function __construct()
    {
        $this->htmlConverter = new HtmlConverter();

        $this->markdownConverter = new Parsedown();
    }

    /**
     * Convert Markdown To Html.
     *  markdown转换html
     * @param $markdown
     * @return string
     */
    public function convertMarkdownToHtml($markdown)
    {
        return $this->markdownConverter->setMarkupEscaped(true)->setBreaksEnabled(true)->text($markdown);
    }

    /**
     * Convert Html To Markdown.
     *  html转换markdown
     * @param $html
     * @return string
     */
    public function convertHtmlToMarkdown($html)
    {
        return $this->htmlConverter->convert($html);
    }
}
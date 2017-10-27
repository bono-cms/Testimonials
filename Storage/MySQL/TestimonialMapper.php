<?php

/**
 * This file is part of the Bono CMS
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Testimonials\Storage\MySQL;

use Testimonials\Storage\TestimonialMapperInterface;
use Cms\Storage\MySQL\AbstractMapper;
use Krystal\Db\Sql\RawSqlFragment;

final class TestimonialMapper extends AbstractMapper implements TestimonialMapperInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return self::getWithPrefix('bono_module_testimonials');
    }

    /**
     * {@inheritDoc}
     */
    public static function getTranslationTable()
    {
        return TestimonialTranslationMapper::getTableName();
    }

    /**
     * Returns shared columns to be selected
     * 
     * @return array
     */
    private function getColumns()
    {
        return array(
            self::getFullColumnName('id'),
            self::getFullColumnName('order'),
            self::getFullColumnName('published'),
            TestimonialTranslationMapper::getFullColumnName('lang_id'),
            TestimonialTranslationMapper::getFullColumnName('author'),
            TestimonialTranslationMapper::getFullColumnName('content')
        );
    }

    /**
     * Fetches author's name by their associated id
     * 
     * @param string $id
     * @return string
     */
    public function fetchAuthorById($id)
    {
        return $this->findColumnByPk($id, 'author');
    }

    /**
     * Updates published state by associated id
     * 
     * @param string $id
     * @param string $published The state
     * @return boolean
     */
    public function updatePublishedById($id, $published)
    {
        return $this->updateColumnByPk($id, 'published', $published);
    }

    /**
     * Updates sorting order by associated id
     * 
     * @param string $id
     * @param string $order New sorting order
     * @return boolean
     */
    public function updateOrderById($id, $order)
    {
        return $this->updateColumnByPk($id, 'order', $order);
    }

    /**
     * Fetches testimonial data by its associated id
     * 
     * @param string $id Testimonial id
     * @param boolean $withTranslations Whether to fetch translations or not
     * @return array
     */
    public function fetchById($id, $withTranslations)
    {
        return $this->findEntity($this->getColumns(), $id, $withTranslations);
    }

    /**
     * Fetches all testimonials
     * 
     * @param boolean $published Whether to fetch only published ones
     * @return array
     */
    public function fetchAll($published)
    {
        $db = $this->createEntitySelect($this->getColumns())
                   // Language ID constraint
                   ->whereEquals(TestimonialTranslationMapper::getFullColumnName('lang_id'), $this->getLangId());

        if ($published === true) {
            $db->andWhereEquals(self::getFullColumnName('published'), '1')
               ->orderBy(new RawSqlFragment('`order`, CASE WHEN `order` = 0 THEN `id` END DESC'));
        } else {
            $db->orderBy(self::getFullColumnName('id'))
               ->desc();
        }

        return $db->queryAll();
    }
}

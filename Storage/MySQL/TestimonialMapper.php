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

final class TestimonialMapper extends AbstractMapper implements TestimonialMapperInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return 'bono_module_testimonials';
    }

    /**
     * Fetches all testimonials
     * 
     * @param boolean $published Whether to fetch only published ones
     * @return array
     */
    public function fetchAll($published)
    {
        $db = $this->db->select('*')
                       ->from(self::getTableName())
                       ->whereEquals('lang_id', $this->getLangId());

        if ($published === true) {
            $db->andWhereEquals('published', '1');
        }

        return $db->queryAll();
    }

    /**
     * Adds a testimonial
     * 
     * @param array $data Data to be inserted
     * @return boolean
     */
    public function update(array $data)
    {
        return $this->persist($data);
    }

    /**
     * Adds a testimonial
     * 
     * @param array $data Data to be inserted
     * @return boolean
     */
    public function insert(array $data)
    {
        return $this->persist($this->getWithLang($data));
    }

    /**
     * Fetches a testimonial by its associated id
     * 
     * @param string $id
     * @return array
     */
    public function fetchById($id)
    {
        return $this->findByPk($id);
    }

    /**
     * Deletes a testimonial by its associated id
     * 
     * @param string $id
     * @return boolean
     */
    public function deleteById($id)
    {
        return $this->deleteByPk($id);
    }
}

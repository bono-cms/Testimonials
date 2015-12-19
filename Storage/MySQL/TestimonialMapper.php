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
     * @param boolnean $published Whether to fetch only published ones
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
}

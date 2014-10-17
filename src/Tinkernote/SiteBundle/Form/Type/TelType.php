<?php

namespace Tinkernote\SiteBundle\Form\Type;

use Symfony\Component\Form\AbstractType;


class TelType extends AbstractType
{
    /**
     * @author  Joe Sexton <joe@webtipblog.com>
     * @return  string
     */
    public function getName()
    {
        return 'tel';
    }

    /**
     * @author  Joe Sexton <joe@webtipblog.com>
     * @return  string
     */
    public function getParent()
    {
        return 'number';
    }
}
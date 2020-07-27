<?php

namespace App\Service;

use App\Entity\QuoteType;

class QuoteTypeService extends AbstractService
{

    /**
     * Creates new QuoteType entity
     * 
     * @param string $type
     * @return QuoteType
     */
    public function create(string $type): QuoteType
    {
        $quoteType = new QuoteType;
        $quoteType->setType($type);

        $this->em->persist($quoteType);
        $this->em->flush();

        return $quoteType;
    }

}

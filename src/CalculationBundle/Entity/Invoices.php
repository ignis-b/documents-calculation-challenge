<?php

namespace CalculationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invoices
 *
 * @ORM\Table(name="invoices")
 * @ORM\Entity(repositoryClass="CalculationBundle\Repository\InvoicesRepository")
 */
class Invoices
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="customer", type="string", length=255)
     */
    private $customer;

    /**
     * @var int
     *
     * @ORM\Column(name="vat_number", type="integer")
     */
    private $vatNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="document_number", type="integer")
     */
    private $documentNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="smallint", nullable=true)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="parent_document", type="integer", nullable=true)
     */
    private $parentDocument;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", nullable=true, length=255)
     */
    private $currency;

    /**
     * @var int
     *
     * @ORM\Column(name="total", type="integer", nullable=true)
     */
    private $total;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customer
     *
     * @param string $customer
     *
     * @return Invoices
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return string
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set vatNumber
     *
     * @param integer $vatNumber
     *
     * @return Invoices
     */
    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;

        return $this;
    }

    /**
     * Get vatNumber
     *
     * @return int
     */
    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    /**
     * Set documentNumber
     *
     * @param integer $documentNumber
     *
     * @return Invoices
     */
    public function setDocumentNumber($documentNumber)
    {
        $this->documentNumber = $documentNumber;

        return $this;
    }

    /**
     * Get documentNumber
     *
     * @return int
     */
    public function getDocumentNumber()
    {
        return $this->documentNumber;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return Invoices
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set parentDocument
     *
     * @param integer $parentDocument
     *
     * @return Invoices
     */
    public function setParentDocument($parentDocument)
    {
        $this->parentDocument = $parentDocument;

        return $this;
    }

    /**
     * Get parentDocument
     *
     * @return int
     */
    public function getParentDocument()
    {
        return $this->parentDocument;
    }

    /**
     * Set currency
     *
     * @param string $currency
     *
     * @return Invoices
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Invoices
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }
}


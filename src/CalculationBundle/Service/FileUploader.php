<?php
    
namespace CalculationBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use CalculationBundle\Entity\Invoices;

class FileUploader
{
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }
    public function upload(UploadedFile $file) {
        try {
            if (($handle = fopen($file->getPathname(), "r")) !== false) {

                $count = 0;
                $batchSize = 1000;
                while (($data = fgetcsv($handle, 0, ",")) !== false) {
                    $count++;
                    $entity = new Invoices();

                    $entity->setCustomer($data[0]);
                    $entity->setVatNumber($data[1]);
                    $entity->setDocumentNumber($data[2]);
                    $entity->setType($data[3]);
                    $entity->setParentDocument($data[4]);
                    $entity->setCurrency($data[5]);
                    $entity->setTotal($data[6]);
    
                    $this->em->persist($entity);
        
                    if (($count % $batchSize) === 0 ) {
                        $this->em->flush();
                        $this->em->clear();
                    }
                }
                $this->em->flush();
                $this->em->clear();
            }
        }
        catch (\Exception $e) {
            throw $e;
        }
        finally {
            fclose($handle);
        }
        
        return $file;
    }
}
<?php

namespace CalculationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class FileCsvUploadForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('upload_file', FileType::class, [
              'label' => false,
              'mapped' => false,
              'required' => true,
              'constraints' => [
               new File([
                'mimeTypes' => [
                 'text/x-comma-separated-values',
                 'text/comma-separated-values',
                 'text/x-csv',
                 'text/csv',
                 'text/plain',
                 'application/octet-stream',
                 'application/vnd.ms-excel',
                 'application/x-csv',
                 'application/csv',
                 'application/excel',
                 'application/vnd.msexcel',
                 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                ],
                'mimeTypesMessage' => "This document isn't valid format.",
               ])
              ],
            ])
            ->add('send', SubmitType::class, ['label' => 'Create Task']);
    }
}
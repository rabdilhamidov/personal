<?php

namespace Demos\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class BlogPostAdmin extends Admin
{

    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', null, array('required' => true, 'label' => 'Название'))
            ->add('titleEn', null, array('required' => true, 'label' => 'Название (EN)'))
            ->add('slug', null, array('required' => true, 'label' => 'Слаг'))
            ->add('category', null, array('class' => 'Demos\BlogBundle\Entity\BlogCategory', 'property' => 'title', 'required' => true))
            ->add('image', 'sonata_type_model_list', array('required' => false, 'label' => 'Изображение'), array())
            ->add('sort', null, array('label' => 'Индекс сортировки'))
            ->add('user', null, array('class' => 'Demos\BlogBundle\Entity\User', 'property' => 'username', 'required' => true, 'label' => 'Автор'))
            ->add('body', null, array('label' => 'Текст'))
            ->add('bodyEn', null, array('label' => 'Текст (EN)'))

            // ->add('created_date', 'text', array('label' => 'Created date', 'required' => false))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title')
            ->add('user', null, array('class' => 'Demos\BlogBundle\Entity\User', 'property' => 'username'))
            ->add('category', null, array('class' => 'Demos\BlogBundle\Entity\BlogCategory', 'property' => 'title'))
            ->add('slug')
            ->add('image')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        	->addIdentifier('id')
            ->addIdentifier('title')
            ->addIdentifier('titleEn')
            ->add('slug')
            ->add('category')
            ->add('sort')
            ->add('image', null, array('template' => 'ApplicationSonataAdminBundle:CRUD:list_orm_many_to_one.html.twig', 'link_parameters' => array('context' => 'default')))
            ->add('updated_date', 'datetime', array('format' => "dd-MM-yyyy HH:mm:ss", 'template' => 'ApplicationSonataAdminBundle:CRUD:list_datetime.html.twig'))
            // add custom action links
            ->add('_action', 'actions', array(
                'actions' => array(
                    'delete' => array(),
                )
            ))
        ;
    }


    /**
     * Default Datagrid values
     *
     * @var array
     */
    protected $datagridValues = array(
        '_page' => 1,            // display the first page (default = 1)
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'updated_date'  // name of the ordered field
                                 // (default = the model's id field, if any)

        // the '_sort_by' key can be of the form 'mySubModel.mySubSubModel.myField'.
    );

}

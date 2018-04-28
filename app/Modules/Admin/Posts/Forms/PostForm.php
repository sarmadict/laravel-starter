<?php

namespace App\Modules\Admin\Posts\Forms;


use App\Http\Forms\Admin\AdminBaseForm;
use App\Models\Accounts\User;
use App\Models\Categories\Category;
use App\Types\General\Category as CategoryType;
use App\Types\Blog\PostStatus;

class PostForm extends AdminBaseForm
{
    public function buildForm()
    {
        parent::buildForm();

        $this->add('title', 'text', [
            'label' => trans('admin.posts.fields.title'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.posts.elements.title'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('slug', 'text', [
            'label' => trans('admin.posts.fields.slug'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.posts.elements.slug'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('content', 'textarea', [
            'label' => trans('admin.posts.fields.content'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'class' => 'form-control editor',
                'placeholder' => trans('admin.posts.elements.content'),
            ],
            'widget_prefix' => '<div class="col-md-9">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('excerpt', 'textarea', [
            'label' => trans('admin.posts.fields.excerpt'),
            'label_attr' => [
                'class' => 'col-md-3 control-label',
            ],
            'attr' => [
                'class' => 'form-control area-animated',
                'placeholder' => trans('admin.posts.elements.excerpt'),
            ],
            'widget_prefix' => '<div class="col-md-9"><div class="note-editor">',
            'widget_suffix' => '</div></div>',
        ]);

        $this->add('category_id', 'choice', [
            'label' => trans('admin.posts.fields.category_id'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'class' => 'form-control col-md-12 select2 select2-regular',
            ],
            'choices' => $this->getCategoryIds()
        ]);

        $this->add('user_id', 'choice', [
            'label' => trans('admin.posts.fields.user_id'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'class' => 'form-control col-md-12 select2 select2-regular',
            ],
            'choices' => $this->getUserIds()
        ]);

        $this->add('status', 'choice', [
            'label' => trans('admin.posts.fields.status'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'class' => 'form-control col-md-12 select2 select2-regular',
            ],
            'choices' => $this->getStatuses()
        ]);

        $this->add('user_name', 'text', [
            'label' => trans('admin.posts.fields.user_name'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.posts.elements.user_name'),
            ],
        ]);

        $this->add('image_path', 'text', [
            'label' => trans('admin.posts.fields.image_path'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.posts.elements.image_path'),
            ],
        ]);

        $this->add('published_at', 'text', [
            'label' => trans('admin.posts.fields.published_at'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.posts.elements.published_at'),
            ],
        ]);

        $this->add('expired_at', 'text', [
            'label' => trans('admin.posts.fields.expired_at'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.posts.elements.expired_at'),
            ],
        ]);
        $this->add('meta_keywords', 'choice', [
            'label' => trans('admin.posts.fields.meta_keywords'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'class' => 'form-control col-md-12 select2 select2-tags',
            ],
            'multiple' => true,
            'choices' => $this->getMetaKeywords(),
        ]);

        $this->add('meta_description', 'text', [
            'label' => trans('admin.posts.fields.meta_description'),
            'label_attr' => [
                'class' => 'control-label',
            ],
            'attr' => [
                'placeholder' => trans('admin.posts.elements.meta_description'),
            ],
        ]);

        $this->add('hits', 'static', [
            'label' => trans('admin.posts.fields.hits'),
            'label_attr' => [
                'class' => 'control-label col-md-8',
            ],
            'attr' => [
                'class' => 'form-control-static',
            ],
            'widget_prefix' => '<div class="col-md-4">',
            'widget_suffix' => '</div>',
        ]);

        $this->add('likes_count', 'static', [
            'label' => trans('admin.posts.fields.likes_count'),
            'label_attr' => [
                'class' => 'control-label col-md-8',
            ],
            'attr' => [
                'class' => 'form-control-static',
            ],
            'widget_prefix' => '<div class="col-md-4">',
            'widget_suffix' => '</div>',
        ]);
    }

    protected function getCategoryIds()
    {
        return Category::query()->ofType(CategoryType::POST)->pluck('title', 'id')->toArray();
    }

    protected function getMetaKeywords()
    {
        $model = $this->getModel();

        $items = old('meta_keywords', $model ? $model->meta_keywords : []);

        return array_combine($items, $items);
    }

    protected function getUserIds()
    {
        return User::query()->get()->pluck('display_name', 'id')->toArray();
    }

    protected function getStatuses()
    {
        return PostStatus::flipTrans('admin.posts.elements.status_');
    }
}
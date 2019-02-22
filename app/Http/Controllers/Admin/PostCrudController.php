<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\CrudPanel;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PostRequest as StoreRequest;
use App\Http\Requests\PostRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

/**
 * Class PostCrudControllerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Post');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/posts');
        $this->crud->setEntityNameStrings('post', 'posts');
        $this->crud->with('user', 'category', 'tags');

        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        $this->crud->removeColumns(['slug', 'attachment', 'preview', 'body']);
        $this->crud->removeFields(['slug', 'user_id', 'attachment']);


        $this->crud->addField([  // Select2
           'label' => "Category",
           'type' => 'select2',
           'name' => 'category_id', // the db column for the foreign key
           'entity' => 'category', // the method that defines the relationship in your Model
           'attribute' => 'name', // foreign key attribute that is shown to user
           'model' => "App\Category" // foreign key model
        ]);

        $this->crud->addField([       // SelectMultiple = n-n relationship (with pivot table)
            'label' => "Tags",
            'type' => 'select2_multiple',
            'name' => 'tags', // the method that defines the relationship in your Model
            'entity' => 'tags', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Tag", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        ]);

        $this->crud->addField([ // image
            'label' => "Article cover",
            'name' => "cover",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 0, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            # 'prefix' => '/storage/' // in case you only store the filename in the database, this text will be prepended to the database value
        ]);


        $this->crud->addField([   // CKEditor
            'name' => 'preview',
            'label' => 'Article',
            'type' => 'ckeditor',
            // optional:
            // 'extra_plugins' => ['oembed', 'widget', 'justify']
        ]);

        $this->crud->addField([   // CKEditor
            'name' => 'body',
            'label' => 'Article',
            'type' => 'ckeditor',
            // optional:
            // 'extra_plugins' => ['oembed', 'widget', 'justify']
        ]);

        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Category", // Table column heading
           'type' => "select",
           'name' => 'category_id', // the column that contains the ID of that connected entity;
           'entity' => 'category', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\Category", // foreign key model
        ]);

        $this->crud->addColumn([
           // 1-n relationship
           'label' => "Author", // Table column heading
           'type' => "select",
           'name' => 'user_id', // the column that contains the ID of that connected entity;
           'entity' => 'user', // the method that defines the relationship in your Model
           'attribute' => "name", // foreign key attribute that is shown to user
           'model' => "App\User", // foreign key model
        ]);

        $this->crud->addColumn([
           'name' => 'cover', // The db column name
           'label' => "Cover", // Table column heading
           'type' => 'image',
            // 'prefix' => 'folder/subfolder/',
            // optional width/height if 25px is not ok with you
            // 'height' => '30px',
            // 'width' => '30px',
        ]);

        // add asterisk for fields that are required in PostCrudControllerRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}

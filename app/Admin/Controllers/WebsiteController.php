<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Website;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class WebsiteController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Website(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('host');
            $grid->column('app_name');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Website(), function (Show $show) {
            $show->field('id');
            $show->field('host');
            $show->field('app_name');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Website(), function (Form $form) {
            $form->display('id');
            $form->text('host');
            $form->text('app_name');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}

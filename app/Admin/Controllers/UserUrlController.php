<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\UserUrl;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserUrlController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new UserUrl(), function (Grid $grid) {
            $grid->column('id')->sortable();
//            $grid->column('device_id');
            $grid->column('app_name')->using(UserSsrController::app_names());
            $grid->column('url');
            $grid->column('name');
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
        return Show::make($id, new UserUrl(), function (Show $show) {
            $show->field('id');
//            $show->field('device_id');
            $show->field('app_name');
            $show->field('url');
            $show->field('name');
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
        return Form::make(new UserUrl(), function (Form $form) {
            $form->display('id');
//            $form->text('device_id');
            $form->select('app_name')->options(UserSsrController::app_names());
            $form->text('url');
            $form->text('name');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}

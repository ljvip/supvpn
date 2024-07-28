<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\UserCc;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserCcController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new UserCc(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('device_id');
            $grid->column('app_name');
            $grid->column('times');
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
        return Show::make($id, new UserCc(), function (Show $show) {
            $show->field('id');
            $show->field('device_id');
            $show->field('times');
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
        return Form::make(new UserCc(), function (Form $form) {
            $form->display('id');
            $form->text('device_id');
            $form->text('app_name');
            $form->text('times');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}

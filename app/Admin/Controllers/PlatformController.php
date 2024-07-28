<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Platform;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class PlatformController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Platform(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('app_name');
            $grid->column('status')->using(self::statusArr());
//            $grid->column('ssrs')->limit(50,"...");
//            $grid->column('urls')->width("100px");
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
        return Show::make($id, new Platform(), function (Show $show) {
            $show->field('id');
            $show->field('app_name');
            $show->field('status');
            $show->field('ssrs');
            $show->field('urls');
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
        return Form::make(new Platform(), function (Form $form) {
            $form->display('id');
            $form->text('app_name');
            $form->radio('status')->options(self::statusArr())->default(1);
//            $form->text('ssrs');
//            $form->text('urls');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    public static  function statusArr(){
        return [1=>'启用',0=>'禁用'];
    }
}

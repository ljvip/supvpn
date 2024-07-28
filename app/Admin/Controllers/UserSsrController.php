<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\UserSsr;
use App\Models\Platform;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class UserSsrController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new UserSsr(), function (Grid $grid) {
            $grid->column('id')->sortable();
//            $grid->column('device_id');
            $grid->column('app_name')->using(self::app_names());
            $grid->column('ssr')->limit(100,'...');
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
        return Show::make($id, new UserSsr(), function (Show $show) {
            $show->field('id');
            $show->field('device_id');
            $show->field('ssr');
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
        return Form::make(new UserSsr(), function (Form $form) {
            $form->display('id');
//            $form->text('device_id');
            $form->select('app_name')->options(self::app_names());
            $form->text('ssr');
            $form->text('name');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    public static function  app_names(){
        $platforms=Platform::where('status',1)->get();
        $data=[];
        foreach ($platforms as $p){
            $data[$p->id]=$p->app_name;
        }
        return $data;
    }
}

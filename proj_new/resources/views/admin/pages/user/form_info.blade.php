@php
Use  App\Helpers\Form as FormTemplate; 
Use  App\Helpers\Template;    

$formInputAttr = config('zvn.template.form_input');
$formLabelAttr = config('zvn.template.form_label');
$inputHiddenID = Form::hidden('id', $item['id']);
$inputHiddenAvatar = Form::hidden('avatar_current', $item['avatar']);
$inputHiddenTask = Form::hidden('task','edit-info');

$statusValue = ['default'=>'Select Status', 'active'=>config('zvn.template.status.active.name'), 'inactive'=>config('zvn.template.status.inactive.name')];

$elements = [
[
'label'   =>Form::label('username', 'username',   $formLabelAttr),
'element' =>Form::text('username', $item['username'],   $formInputAttr),
], 
[
'label'   =>Form::label('fullname', 'fullname',  $formLabelAttr),
'element' =>Form::text('fullname', $item['fullname'], $formInputAttr),
],  
[
'label'   =>Form::label('email', 'email', $formLabelAttr),
'element' =>Form::text('email', $item['email'],$formInputAttr),
], 
[
'label'   =>Form::label('status', 'status', $formLabelAttr),
'element' =>Form::select('status',$statusValue,$item['status'],$formInputAttr),
], 
[
'label'   =>Form::label('avatar', 'avatar',$formLabelAttr),
'element' =>Form::file('avatar', $formInputAttr),
'avatar' =>(!empty($item['id'])) ? Template::showItemsThumb($controllerName,$item['avatar'],$item['username']) : null, 'type'=>'avatar'
],
[
'element'   =>$inputHiddenID.$inputHiddenAvatar.$inputHiddenTask.Form::submit('Save', ['class' => 'btn btn-success']),
'type' =>'btn-submit'
]
];
@endphp

<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title',['title'=>'Form edit info'])
        <div class="x_content">
            <br>
             {!! Form::open([
                'method'         => 'POST',
                'url'            => route("$controllerName/change-password"),
                'accept-charset' => 'UTF-8',
                'enctype'        => 'multipart/form-data',
                'class'          => 'form-horizontal form-lable-left',
                'id'             => 'main-form' ]) 
                !!}
                {!! FormTemplate::show($elements)!!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

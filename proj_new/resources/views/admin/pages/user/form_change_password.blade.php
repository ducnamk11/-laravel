<!-- {{asset("admin/asset/bootstrap/dist/css/bootstrap.min.css")}}  -->
<!-- asset() sẽ đi vào folder public - >admin.... -->
@php
Use  App\Helpers\Form as FormTemplate; 
Use  App\Helpers\Template;    

$formInputAttr = config('zvn.template.form_input');
$formLabelAttr = config('zvn.template.form_label');

$inputHiddenID = Form::hidden('id', $item['id']);
$inputHiddenTask = Form::hidden('task','change_password');
$elements = [ 
[
'label'   =>Form::label('password', 'password',  $formLabelAttr),
'element' =>Form::password('password',  $formInputAttr),
],
[
'element'   =>$inputHiddenID.$inputHiddenTask.Form::submit('Save', ['class' => 'btn btn-success']),
'type' =>'btn-submit'
]
];
@endphp
<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
        @include('admin.templates.x_title',['title'=>'Form Change Password'])
        <div class="x_content">
            <br>
            <!-- cấu hÌNH LẠI FORM -->
            {!! Form::open([
                'method'         => 'POST',
                'url'            => route("$controllerName/change-password"),
                'accept-charset' => 'UTF-8',
                'enctype'        => 'multipart/form-data',
                'class'            => 'form-horizontal form-lable-left',
                'id'            => 'main-form' ]) 
                !!}
                {!! FormTemplate::show($elements)!!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>

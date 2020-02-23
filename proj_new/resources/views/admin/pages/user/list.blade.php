@php
use App\Helpers\Template as Template;
use App\Helpers\Hightlight as Hightlight;
@endphp
<div class="x_content">
    <div class="table-responsive">
        <!-- $items từ slider controller - >view-->
        <table class="table table-striped jambo_table bulk_action">
            <thead>
                <tr class="headings">
                    <th class="column-title">#</th>
                    <th class="column-title">Content</th>
                    <th class="column-title">avartar</th>
                    <th class="column-title">Level</th>
                    <th class="column-title">status</th>
                    <th class="column-title">Tạo mới</th>
                    <th class="column-title">Chỉnh sửa</th>
                    <th class="column-title">Hành động</th>
                </tr>
            </thead>
            <tbody> @if (count($items) >0) 
                @foreach ($items as $key=>$val)
                @php
                $index           = $key+1;
                $class           = ($index%2==0) ? 'even' :'odd'; 
                $id              = $val['id'] ;
                $userName        = Hightlight::show($val['username'],$params['search'],'username');
                $email           = Hightlight::show($val['email'],$params['search'],'email');
                $fullname        = Hightlight::show($val['fullname'],$params['search'],'fullname');
                $level           = Template::showItemsSelect($controllerName,$id,$val['level'],'level');
                $status          = Template::showItemsStatus($controllerName,$id,$val['status']);
                $avatar          = Template::showItemsThumb($controllerName,$val['avatar'],$val['avatar']);
                $createdHistory  = Template::showItemsHistory($val['created_by'],$val['created']);
                $modifiedHistory = Template::showItemsHistory($val['modified_by'],$val['modified']);
                $listBtnAction   = Template::showButtonAction($controllerName,$id);
                $thumb           = Template::showItemsThumb($controllerName,$val['thumb'],$val['name']);
                @endphp
                <tr class="{{$class}} pointer">
                 <td> {{$index}}</td>
                 <td width="20%">
                    <p><strong>userName: </strong>{!!$userName!!}</p>
                    <p><strong>fullname: </strong>{!!$fullname!!}</p>
                    <p><strong>email: </strong>{!!$email!!}</p>
                </td>
                <td> <p style="width:50px">{!! $avatar!!}</p></td>
                <td>{!! $level!!}</td>
                <td>{!! $status!!}</td>
                <td>{!! $createdHistory!!}</td>
                <td>{!! $modifiedHistory!!}</td>
                <td width="18%" class="last">{!! $listBtnAction!!}   </td>
            </tr>
            @endforeach
            @else @include('admin.templates.list_empty',['colspan'=>10])
            <!-- chỉ số colspan phụ thuộc vào số cột -->
            @endif
        </tbody>
    </table>
</div>
</div>